<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\ContentInterface;
use App\Contracts\Repositories\MediaInterface;
use App\Contracts\Repositories\PageInterface;
use App\Entities\FileHandler;
use App\Services\getContents;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ContentsController extends Controller
{
    private $baseRoute = "admin.pages.";
    private $basePage = "contents.";
    private $layoutTypes = ['single', 'structural', 'channel'];

    public function showPageContents($pageId, $layoutType)
    {
        if(!in_array($layoutType, $this->layoutTypes)){
            App::abort(403,'Invalid user right');
        }
        $getContentObject = new getContents($layoutType, $pageId);
        list($contents, $fields) = $getContentObject->getContents();

        return view($this->basePage.$layoutType, compact("fields", 'contents','pageId', 'layoutType'));
    }

    public function updatePageContents($pageId, $layoutType, Request $request)
    {
        $table = $this->parseDbTableName($pageId);
        $contents = $request->all();
        $languages = Cache::get('active_languages');

        // Separate form input file base on language ids
        $inputs = $this->separateFormInputs($languages, $contents);
        foreach($inputs as $formInputs)
        {
            // filter inputs, if there is any upload file,
            // it will save the file to the location and change the input to file link
            $formInputs = $this->moveUploadFiles($formInputs);

            // this is the part if there is file,
            // there must a file_remove input accompany
            // check the file_remove input and change the file input field accordingly
            $formInputs = $this->changeFileInputValue($formInputs);

            // this check there is content_id field or not
            // exits mean update content
            // not exits mean create new content
            $keys = array_keys($formInputs);
            if(in_array('content_id',$keys))
            {
                $this->updateRecord($formInputs, $table);
                $message = 'Content has been updated.';
            }else{
                list($response, $message) = $this->createRecord($pageId, $formInputs, $table);
                if(!$response){
                    return Redirect::back()->withMessage($message);
                }
            }
        }
        return Redirect::route($this->baseRoute.'content',[$pageId, $layoutType])->withMessage($message);
    }

    public function createPageContents($pageId, $layoutType)
    {

        if(!in_array($layoutType, $this->$layoutType)){
            App::abort(403,'Invalid user right');
        }
        list($contents, $fields) = new getContents($layoutType, $pageId);
        return view($this->basePage.$layoutType, compact("fields", 'contents','pageId', 'layoutType'));
    }

    public function editPageContents($pageId, $layoutType, $identifier)
    {
        if(strtolower($layoutType) != 'single')
        {
            $page = Page::findOrFail($pageId);
            $layout = $page->layout->displayName;
            $layoutTable = 'layout_'.strtolower($layout);
            $content = new Content($layoutTable);
            $contents = $content->wherePage_id($page->id)->whereContent_identifier($identifier)->get();
            $fields = $page->layout->getContentFields();
            return view($this->basePage.$layoutType.'_content_edit', compact("fields", 'contents', 'pageId', 'layoutType'));
        }
    }

    public function deletePageContents($pageId, $layoutType, $identifier, Request $request)
    {
        $page = App::make(PageInterface::class)->findOrFail($pageId);
        $layoutTable = "layout_".strtolower($page->layout->displayName);
        $object = App::make(ContentInterface::class)->setTable($layoutTable);
        $contents = $object->wherePage_id($pageId)->whereContent_identifier($identifier)->get();
        foreach($contents as $content)
        {
            $record = $content->setTable($layoutTable);
            $record->delete();
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
    private function moveIfFileUploaded($name, $value, $formInputs)
    {
        if ($value instanceof UploadedFile) {
            $fh               = new FileHandler;
            $link = str_replace(public_path(), '', $fh->move($value));
            $formInputs[$name] = $link;
            $mediaRecord = App::make(MediaInterface::class)->whereLink($link)->first();

            if(!$mediaRecord)
            {
                $fields['link'] = $link;
                $fields['name'] = $value->getClientOriginalName();
                $fields['type'] = $value->getClientMimeType();
                App::make(MediaInterface::class)->create($fields);
            }else{
                $mediaRecord->touch();
            }
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
        $contentObject = App::make(ContentInterface::class)->setTable($table);
        $contentRecord = $contentObject->whereId($contentId)->first();
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
        $check = $contentObject->whereLangId($formInputs["lang_id"])->whereContentIdentifier($formInputs["content_identifier"])->count();
        if($check == 0){
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
}
