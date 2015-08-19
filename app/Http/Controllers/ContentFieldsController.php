<?php

namespace App\Http\Controllers;

use App\ContentField;
use App\Entities\Layout;
use App\Entities\Migration;
use App\Services\ParsingContentFile;
use App\Template;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;

class ContentFieldsController extends Controller
{
    private $contentField;
    private $template;

    /**
     * ContentFieldsController constructor.
     *
     * @param $contentField
     */
    public function __construct(ContentField $contentField, Template $template)
    {
        $this->contentField = $contentField;
        $this->template = $template;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $templates = Template::all();
        return view('back.contentfields.index', compact("templates"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
    }

    /**update
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request, $templateId)
    {
        $rules = $this->createRules($request);
        $this->validate($request, $rules);

        $dateSets = $this->createDataSets($request);

        foreach($dateSets as $data){
            $data['template_id'] = $templateId;
            $this->contentField->create($data);
        }

//        add layout table columns base on newly create fields
        $template = $this->template->with("contentfields")->whereId($templateId)->first();
        $tableName = (new ParsingContentFile())->getLayoutTableName($template->file);
        (new Migration())->addColumns($tableName, $template->contentfields);

        return redirect()->route("admin.templates.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $templateId)
    {
        $rules = $this->createRules($request);
        $this->validate($request, $rules);

        $template = App::make(Template::class)->with("contentfields")->whereId($templateId)->first();
        $dbFieldsCollection = $template->contentfields;
        $dataSets = $this->createDataSets($request);
        $testCase = $dataSets;


//        2 collections are exact same => simple update
//        inputs set contain element db set doesn't => create new
//        db set contain element inputs set doesn't => delete item

//        this check is there any db recored need to delete
        $NeedToDeleteCollection = $dbFieldsCollection->filter(function($field)use($dataSets){
            foreach($dataSets as $index=>$input){
                if($field->id == $input['contentFieldId']) return false;
            }
            return true;
        });

        if(count($NeedToDeleteCollection)>0){
            $tableName = (new ParsingContentFile())->getLayoutTableName($template->file);
            (new Migration())->dropColums($tableName, $NeedToDeleteCollection);
            foreach($NeedToDeleteCollection as $record){
                $record->delete();
            }
        }

//        this check is there any new fields need to add to db
        foreach($testCase as $index=>$set){
            foreach($dbFieldsCollection as $record){
                if($set['contentFieldId'] == $record->id) unset($testCase[$index]);
            }
        }

        if (count($testCase)>0) {
            $tableName = (new ParsingContentFile())->getLayoutTableName($template->file);
            (new Migration())->addColumns($tableName, $testCase);
            foreach($testCase as $inputs){
                unset($inputs["contentFieldId"]);
                $inputs["template_id"] = $templateId;
                $this->contentField->create($inputs);
            }
        }

//        update exsiting record
        $updateDataSet= [];
        foreach($dataSets as $set){
            if($set["contentFieldId"]) $updateDataSet[] = $set;
        }

        $contentFieldsRecords = $this->contentField->whereTemplateId($templateId)->get();
        foreach($contentFieldsRecords as $record){
            foreach($updateDataSet as $inputs){
                if($inputs["contentFieldId"] == $record->id){
                    $tableName = (new ParsingContentFile())->getLayoutTableName($record->template->file);
                    $testArray = $record->toArray();
                    (new Migration())->dropColums($tableName, [$testArray]);
                    (new Migration())->addColumns($tableName, [$inputs]);
                    unset($inputs["contentFieldId"]);
                    $record->update($inputs);
                }
            }
        }

        return redirect()->route("admin.templates.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function check($templateId)
    {
        $template = App::make(Template::class)->with("contentfields")->whereId($templateId)->first();
        if(count($template->contentfields)>0){
            return view("back.contentfields.edit", compact("template"));
        }
        return view("back.contentfields.create", compact("template"));

    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    protected function createRules(Request $request)
    {
        $rules = [];
        $data  = $request->all();
        foreach ($data as $key => $val) {
            if ($key != "pattern" && $key != "_token") {
                if (is_array($val)) {
                    foreach ($val as $index => $val) {
                        if ($key == "display") {
                            $rules["$key.$index"] = "required|max:255";
                        }
                        if ($key == "code") {
                            $rules["$key.$index"] = "required|max:255|alpha_dash";
                        }
                        if ($key == "required") {
                            $rules["$key.$index"] = "required|in:0,1";
                        }
                        if ($key == "type") {
                            $rules["$key.$index"] = "required|in:" . implode(',', array_keys(getContentFieldTypes()));
                        }
                    }
                }
            }
        }

        return $rules;
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    private function createDataSets(Request $request)
    {
        $displayArray     = $request->get('display');
        $codeArray        = $request->get('code');
        $typeArray        = $request->get('type');
        $requiredArray    = $request->get('required');
        $placeholderArray = $request->get('placeholder');
        $patternArray     = $request->get('pattern');

        if($request->has('contentFieldId'))
        {
            $contentFieldIdArray = $request->get("contentFieldId");
            $tempArray = array_map(function ($display, $code, $type, $required, $pattern, $placeholder, $contentFieldId) {
                return [
                    "display"     => $display,
                    "code"        => $code,
                    "type"        => $type,
                    "required"    => $required,
                    "placeholder" => $placeholder,
                    "pattern"     => $pattern,
                    "contentFieldId"     => $contentFieldId
                ];
            }, $displayArray, $codeArray, $typeArray, $requiredArray, $patternArray, $placeholderArray, $contentFieldIdArray);

            return $tempArray;
        }

        $dateSets = array_map(function ($display, $code, $type, $required, $pattern, $placeholder) {
            return [
                "display"     => $display,
                "code"        => $code,
                "type"        => $type,
                "required"    => $required,
                "placeholder" => $placeholder,
                "pattern"     => $pattern,
            ];
        }, $displayArray, $codeArray, $typeArray, $requiredArray, $patternArray, $placeholderArray);

        return $dateSets;


    }
}
