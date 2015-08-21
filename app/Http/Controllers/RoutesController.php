<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\ContentInterface;
use App\Contracts\Repositories\LanguageInterface;
use App\Contracts\Repositories\PageInterface;
use App\Services\LogService;
use App\Services\ParseUrl;
use App\Services\ParsingContentFile;
use App\Template;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class RoutesController extends Controller
{

    // TODO: with lang code structural index
    // TODO: with lang code structural
    // TODO: with lang code structural no page
    // TODO: with lang code structural with identifier
    // TODO: with lang code structural with wrong identifier

    // TODO: without lang code structural index
    // TODO: without lang code structural index
    // TODO: without lang code structural
    // TODO: without lang code structural no page
    // TODO: without lang code structural with identifier
    // TODO: without lang code structural with wrong identifier
    //
    private $contentService;
    private $requestObject;
    private $noSearchResult;

    /**
     * RoutesController constructor.
     *
     * @param $contentService
     */
    public function __construct(ContentInterface $contentService)
    {
        $this->contentService = $contentService;
    }


    public function route(Request $request)
    {
        $this->requestObject = new ParseUrl($request);
        if($this->requestObject->isSearch){

    $t0 = microtime(true);

            $result = $this->parseSearchQuery();

    $t1 = microtime(true);
    $performance = ($t1-$t0)*1000;
    // log search performance
    (new LogService())->log('The search duration is '.$performance.' milisecond', "info" , "searchPerformance");

            if($this->requestObject->isAjax){
                if(count($result)>0){
                    return ["response"=>"completed","result"=>$result];
                }else{
                    return ["response"=>"completed","result"=>null];
                }
            }else{
                return view("front.pages.search",compact("result"));
            }
        }

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

    private function parseSearchQuery()
    {
        $queries = $this->requestObject->queries;
        $contentObject = $this->contentService;
        if( ! count($queries)>0){
            return false;
        }

        if(array_has($queries, "page")){
            $page = cache('pages')->filter(function($cachedPage)use($queries){
               return $cachedPage->url == $queries["page"];
            })->first();
            if(!$page){
                $this->noSearchResult = true;
            } else{
                $tables =[(new ParsingContentFile())->getLayoutTableName($page->template->file)];
                unset($queries['page']);
            }
        }else{
            $uniquie = cache('pages')->unique(function($page){
                return $page->template->file;
            });

            foreach($uniquie as $page){
                $tables[] = (new ParsingContentFile())->getLayoutTableName($page->template->file);
            }
        }



        if($this->noSearchResult){
            return false;
        }

        $key = "search_";
        foreach($tables as $table){
            $key .= $table."_";
        }
        foreach($queries as $key=>$val){
            $key .= $key."_".$val."_";
        }
        if (cache()->has($key)){
            return cache($key);
        }else{
            return cache()->remember($key, 1, function()use($tables, $contentObject, $queries){
                $searchResult = new Collection();
                foreach($tables as $table){
                    $contentObject->setTable($table);
                    foreach($queries as $col=>$val){
                        if($col == "limit"){
                            $val = (int) $val;
                            $contentObject = $contentObject->search($col, $val);
                        }else{
                            $contentObject = $contentObject->search($col, $val);
                        }
                    }
                    $searchResult = $searchResult->merge($contentObject->get()->all());
                }
                return $searchResult;
            });
        }

    }
}
