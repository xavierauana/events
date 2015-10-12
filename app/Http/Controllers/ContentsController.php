<?php

namespace App\Http\Controllers;

use App\Content;
use App\Contracts\Repositories\ContentInterface;
use App\Contracts\Repositories\MediaInterface;
use App\Contracts\Repositories\PageInterface;
use App\Entities\FileHandler;
use App\Services\ParsingContentFile;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ContentsController extends Controller
{
    private $baseRoute = "admin.pages.";
    private $basePage = "contents.";
    private $layoutTypes = ['single', 'structural', 'channel'];
    /**
     * @var
     */
    private $page;
    /**
     * @var \App\Contracts\Repositories\ContentInterface
     */
    private $content;

    /**
     * ContentsController constructor.
     */
    public function __construct(PageInterface $page, ContentInterface $content)
    {
        $this->page = $page;
        $this->content = $content;
    }


    public function showPageContents($pageId)
    {
        $page = $this->page->with("template")->findOrFail($pageId);

        $layoutType = $page->template->type;
        $contents =  $this->content->getContents($page);

        if($layoutType == "single"){
            $languages = $this->languagesWithoutAnyContent($contents);
            $fields = $page->template->contentFields;
            if(count($languages)>0){
                $contents = $this->crateInitialDataSets($page, $languages);
            }
        }else{
            $contents = $contents->unique(function($content){
                return $content->content_identifier;
            });
        }

        return view($this->basePage.$page->template->type, compact("fields", 'contents','pageId', 'layoutType'));
    }

    public function updatePageContents($pageId, Request $request)
    {
        $page = $this->page->with("template")->findOrFail($pageId);
        $table = (new ParsingContentFile())->getLayoutTableName($page->template->file);
        $contentFields = $page->template->contentFields;
        $data = $request->all();
        $dataSets = [];
        foreach($data as $key=>$val){
            if(is_array($val)){
                foreach($val as $index=>$dataVal){
                    $dataSets[$index][$key] = $dataVal;
                }
            }
        }

        // Separate form input file base on language ids

         foreach($dataSets as $formInputs)
        {
            // filter inputs, if there is any upload file,
            // it will save the file to the location and change the input to file link
//            $formInputs = $this->moveUploadFiles($formInputs);

            // this is the part if there is file,
            // there must a file_remove input accompany
            // check the file_remove input and change the file input field accordingly
//            $formInputs = $this->changeFileInputValue($formInputs);

            /**
             * if there is any input name end with "_date"
             * this indicate to change value to SQL timestamp
             */
            $formInputs = $this->changeDateTimeInput($formInputs, $contentFields);


            // this check there is content_id field or not
            // exits mean update content
            // not exits mean create new content
            $keys = array_keys($formInputs);
            if(in_array('content_id',$keys))
            {
                $this->updateRecord($formInputs, $table);
                $message = 'Content has been updated.';
            }else{
                $content = App::make(ContentInterface::class);
                $formInputs["page_id"] = $pageId;
                if($page->template->type !== "single"){
                    $formInputs["content_identifier"] = $request->get("content_identifier");
                }
                $content->createRecord($formInputs, $table);
                $message = 'Content has been created.';
            }
        }
        return redirect()->route($this->baseRoute.'contents',[$pageId])->withMessage($message);
    }

    public function createPageContents($pageId)
    {
        $page = $this->page->findOrFail($pageId);
        $fields = $page->template->contentFields;
        if(! count($fields)>0){
            return redirect()->back()->withMessage("Cannot Create Content (empty content fields)");
        }
        $contents = $this->content->getContents($page);
        $layoutType = $page->template->type;

//        list($contents, $fields) = (new getContents($layoutType, $pageId))->getContents();

        return view($this->basePage.$layoutType."_content_create", compact("fields", 'contents','pageId'));
    }

    public function editPageContents($pageId, $identifier)
    {
        $page = $this->page->findOrFail($pageId);
        $layoutType = $page->template->type;
        if($layoutType != 'single')
        {
            $layout = $page->template->display;
            $layoutTable = (new ParsingContentFile())->getLayoutTableName($page->template->file);
//            $content = new Content($layoutTable);
//            $contents = $content->wherePage_id($page->id)->whereContent_identifier($identifier)->get();
            $this->content->setTable($layoutTable);
            $contents = $this->content->wherePageId($pageId)->whereContentIdentifier($identifier)->get();
            $fields = $page->template->contentFields;
            return view($this->basePage.$layoutType.'_content_edit', compact("fields", 'contents', 'pageId', 'layoutType'));
        }
    }

    public function deletePageContents($pageId, $identifier, Request $request)
    {
        $page = App::make(PageInterface::class)->findOrFail($pageId);
        $layoutTable = (new ParsingContentFile())->getLayoutTableName($page->template->file);
        $layoutType = $page->template->type;
        $object = App::make(ContentInterface::class);
        $object->setTable($layoutTable);
        $contents = $object->wherePage_id($pageId)->whereContent_identifier($identifier)->get();
        foreach($contents as $content)
        {
            $content->setTable($layoutTable);
            $content->delete();
        }
            if($request->ajax())
        {
            return ['response'=>'completed', 'identifier'=>$identifier, 'layoutTalbe'=>$layoutTable, 'collection'=>$contents];
        }
        return view($this->basePage.$layoutType, compact('pageId', 'layoutType'));
    }

    /**
     * @param $languages
     * @param $contents
     * @param $inputs
     *
     * @return array
     */
    private function separateFormInputs($languages, $contents)
    {
        $inputs = [];
        // Separated form input values base on language id
        for ($i = 0; $i < count($languages); $i++) {
            foreach ($contents as $key => $input) {
                if (is_array($input)) {
                    $inputs[$i][$key] = $input[$i];
                } else {
                    $inputs[$i][$key] = $input;
                }
            }
        }
        return $inputs;
    }

    /**
     * If the foam field is a file,
     * it will place the file in the position
     * then change the $formInputs field, change the value from a upload file to a url link which map to the file location
     * if the foam field is not uploadfile, then it will just return the $formInputs array with not modification.
     *
     * @param $value
     * @param $formInputs
     * @param $name
     *
     * @return mixed
     */
    private function moveIfFileUploaded($name, $uploadFile, $formInputs)
    {
        if ($uploadFile instanceof UploadedFile) {
            $fh = new FileHandler();
            $formInputs[$name] = $fh->move($uploadFile);
        }
        return $formInputs;
    }

    /**
     * @param $formInputs
     *
     * @return array
     */
    private function moveUploadFiles($formInputs)
    {
        foreach ($formInputs as $name => $value) {
            // if there is any input type is file
            // move file to proper place and
            $formInputs = $this->moveIfFileUploaded($name, $value, $formInputs);
        }

        return $formInputs;
    }

    /**
     * @param $formInputs
     * @param $table
     *
     * @return \Content
     */
    private function updateRecord($formInputs, $table)
    {
        // remove uncessary fields
        $contentId = $formInputs['content_id'];
        unset($formInputs['content_id']);
        $contentObject = App::make(ContentInterface::class);
        $contentObject->setTable($table);
        $contentRecord = $contentObject->findOrFail($contentId);
        $contentRecord->setTable($table);
        $contentRecord->update($formInputs);
        return $contentObject;
    }

    /**
     * Create a new record
     *
     * @param $pageId
     * @param $formInputs
     * @param $table
     *
     * @return array
     */
    private function createRecord($pageId, $formInputs, $table)
    {
        $formInputs['page_id'] = $pageId;
        unset($formInputs['_token']);
        $contentObject = App::make(ContentInterface::class)->setTable($table);
        if(! $this->contentIdentifierAlreadyExsit($formInputs, $contentObject)){
            foreach ($formInputs as $name => $value) {
                $contentObject->$name = $value;
            }
            $contentObject->save();
            $response = true;
            $message = "Record Created!";
            return [$response, $message];
        }else{
            $response = false;
            $message = "There already has a entry with same 'Content Identifier'. Please change another one";
            return [$response, $message];
        }
    }

    /**
     * Passing the pageId then parse the layout and return the page layout's corresponding DB table
     * @param $pageId
     *
     * @return string
     */
    private function parseDbTableName($pageId)
    {
        $page   = App::make(PageInterface::class)->findOrFail($pageId);
        $layout = strtolower($page->layout->displayName);
        $table  = "layout_$layout";

        return $table;
    }

    /**
     * @param $formInputs
     *
     * @return mixed
     */
    private function changeFileInputValue($formInputs)
    {
        foreach ($formInputs as $name => $value) {
            if (preg_match('/_remove/', $name, $matches)) {
                $testing = preg_split('/_remove/', $name);
                $field   = $testing[0];
                // !$formInputs[$field] means there is a foam input field which match the pattern and its value is null (no input value)
                if (!$formInputs[$field]) {
                    if ($value == 0) {
                        unset($formInputs[$field]);
                    } else {
                        $formInputs[$field] = "";
                    }
                }
                unset($formInputs[$name]);
            }
        }

        return $formInputs;
    }

    /**
     * @param $formInputs
     * @param $contentObject
     *
     * @return mixed
     */
    private function contentIdentifierAlreadyExsit($formInputs, $contentObject)
    {
        $check = $contentObject->whereLangId($formInputs["lang_id"])->whereContentIdentifier($formInputs["content_identifier"])->count();

        return ! $check==0;
    }

    private function changeDateTimeInput($formInputs, $contentFields)
    {
        $templateFields = [];
        foreach($contentFields as $field){
            $templateFields[$field->code] = $field->type;
        }

//        fetch content_fields for the template
//        check the input key is one the those field with datetime input time
//        if so execute the change


        foreach($formInputs as $key=>$entry){
            if( array_has($templateFields, $key) and  $templateFields[$key] == "datetime"){
                $date = date_create_from_format("jS F Y h:i A", $formInputs[$key]);
                $formInputs[$key] = $date->format("Y-m-d H:i:s");
            }
        }
        return $formInputs;
    }

    private function crateInitialDataSets($page, Collection $languages)
    {
        foreach($languages as $language){
            $data['lang_id'] = $language->id;
            $data['page_id'] = $page->id;
            $table = (new ParsingContentFile())->getLayoutTableName($page->template->file);
            $content = App::make(ContentInterface::class);
            $content->createRecord($data, $table);
        }
        $result = $this->content->wherePageId($page->id)->get();
        return $result;
    }

    private function languagesWithoutAnyContent($contents)
    {
        $languages = cache("active_languages");
        $tempArray = [];
        foreach($contents as $content){
            $tempArray[] = $content->lang_id;
        }
        $languageWithoutContent = $languages->reject(function($language)use($tempArray){
            return in_array($language->id, $tempArray);
        });
        return $languageWithoutContent;
    }
}
