<?php

namespace App\Http\Controllers;

use App\Services\ParseUrl;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApisController extends Controller
{
    private $requestObject;

    /**
     * ApisController constructor.
     *
     * @param $requestObject
     */
    public function __construct()
    {
    }


    public function route(Request $request)
    {
        $this->requestObject = new ParseUrl($request);
        if($request->ajax()){
            $this->requestObject = new ParseUrl($request);

            if($this->requestObject->type == 'single'){
                return $this->getSingleContentAndRenderView();
            }
            if($this->requestObject->type == 'channel'){
                return $this->getChannelContentAndRenderView();
            }
            if($this->requestObject->type == 'structural'){
                return $this->getStructuralContentAndRenderView();
            }
        }
    }

    private function getSingleContentAndRenderView()
    {
        $table = (new ParsingContentFile())->getLayoutTableName($this->requestObject->page->template->file);
        $content = $this->contentService->retrieveContentForFrontEndWithLangId($this->requestObject->language->id, $table)->first();
        if($this->requestObject->isAjax) return $content;
        return view("front.pages.".$this->requestObject->page->template->view, compact("content"));
    }

    private function getChannelContentAndRenderView()
    {
        $object = $this->requestObject;
        $table = (new ParsingContentFile())->getLayoutTableName($this->requestObject->page->template->file);
        $contents = $this->contentService->retrieveContentForFrontEndWithLangId($this->requestObject->language->id, $table);
        if($this->requestObject->identifier){
            $content = $contents->filter(function($item)use($object){
                if($item->content_identifier == $object->identifier) return true;
            })->first();
            if(count($content)>0){
                if($this->requestObject->isAjax) return $content;
                return view("front.pages.".$this->requestObject->page->template->view, compact('content'));
            }
            abort(404, $this->message_404);
        }
        if($this->requestObject->isAjax) return $contents;
        return view("front.pages.".$this->requestObject->page->template->view."_index", compact('contents'));

    }

    private function getStructuralContentAndRenderView()
    {
    }
}
