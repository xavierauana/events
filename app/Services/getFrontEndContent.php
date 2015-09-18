<?php
/**
 * Author: Xavier Au
 * Date: 9/9/15
 * Time: 5:20 PM
 */

namespace App\Services;


use App\Contracts\Repositories\ContentInterface;
use Illuminate\Support\Facades\App;

class getFrontEndContent
{
    private $contentService;

    /**
     * getFrontEndContent constructor.
     * @param $contentService
     */
    public function __construct()
    {
        $this->contentService = App::make(ContentInterface::class);
    }


    public function getContent($action, HttpRequest $httpRequest)
    {
        if(method_exists($this, $action)){
            return $this->$action($httpRequest);
        }
    }

    private function single(HttpRequest $httpRequest){
        $dbLayoutTable = (new ParsingContentFile())->getLayoutTableName($httpRequest->page->template->file);
        $content = $this->contentService->retrieveContentForFrontEndWithLangId($httpRequest->language->id, $dbLayoutTable)->first();
        return $content;
    }
    private function channel(HttpRequest $httpRequest){
        $table = (new ParsingContentFile())->getLayoutTableName($httpRequest->page->template->file);
        if($httpRequest->identifier){

            $contents = $this->contentService->retrieveChannelContentForFrontEndWithLangId($httpRequest->language->id, $table, $httpRequest->identifier);
            if(!$contents){
                abort(404, $this->message_404);
            }
        }else{
            $contents = $this->contentService->retrieveContentForFrontEndWithLangId($httpRequest->language->id, $table);
        }
        return $contents;
    }
}