<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\ContentInterface;
use App\Contracts\Repositories\LanguageInterface;
use App\Contracts\Repositories\PageInterface;
use App\Services\getFrontEndContent;
use App\Services\HttpRequest;
use App\Services\ParsingContentFile;
use App\Services\PerformanceLogger;
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
    private $contentService;
    private $getContentService;
    private $httpRequest;
    private $noSearchResult;

    /**
     * RoutesController constructor.
     *
     * @param $contentService
     */
    public function __construct(ContentInterface $contentService)
    {
        $this->getContentService = new getFrontEndContent();
        $this->contentService = $contentService;
    }

    public function route(Request $request, PerformanceLogger $logger)
    {
        $this->httpRequest = new HttpRequest($request);
//        if($this->httpRequest->requestIsSearching){
//
//            $logger->start();
//
//            $result = $this->parseSearchQuery();
//
//            $logger->end();
//
//
//            if($this->httpRequest->isAjax){
//                if(count($result)>0){
//                    return ["response"=>"completed","result"=>$result];
//                }else{
//                    return ["response"=>"completed","result"=>null];
//                }
//            }else{
//                return view("front.pages.search",compact("result"));
//            }
//        }

        if($this->httpRequest->page->template->type == 'single'){
            return $this->getSingleContentAndRenderView();
        }
        if($this->httpRequest->page->template->type == 'channel'){
            return $this->getChannelContentAndRenderView();
        }
        if($this->httpRequest->page->template->type == 'structural'){
            return $this->getStructuralContentAndRenderView();
        }
    }


    private function getSingleContentAndRenderView()
    {
        $content = $this->getContentService->getContent($this->httpRequest->page->template->type, $this->httpRequest);
        if($this->httpRequest->isAjax) return $content;
        return view("front.pages.".$this->httpRequest->page->template->view, compact("content"));
    }

    private function getChannelContentAndRenderView()
    {
        $contents = $this->getContentService->getContent($this->httpRequest->page->template->type, $this->httpRequest);

        if($this->httpRequest->isAjax) return $contents;

        if($this->httpRequest->identifier){
            return view("front.pages.".$this->httpRequest->page->template->view, ['content'=>$contents]);
        }

        return view("front.pages.".$this->httpRequest->page->template->view."_index", compact('contents'));

    }

    private function getStructuralContentAndRenderView()
    {
    }

    private function parseSearchQuery()
    {
        $queries = $this->httpRequest->queries;
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
