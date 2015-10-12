<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Favorite;
use App\Services\PerformanceLogger;
use App\Contracts\Repositories\ContentInterface;
use App\Services\ParsingContentFile;
use App\Services\HttpRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Collection;

class ApisController extends Controller
{
    private $domains;
    private $httpRequest;
    private $noSearchResult;

    /**
     * ApisController constructor.
     * @param $domains
     */
    public function __construct()
    {
        $this->domains = [
            "search", "favorite"
        ];
    }


    public function route(Request $request, PerformanceLogger $logger, $domain, $param1=null, $param2=null)
    {
       if(in_array($domain, $this->domains)){
           if($domain == "favorite" and $request->ajax() and $request->user()){
               if($request->isMethod('post')){
                   return $this->toggleFavorite($request, $param1, $param2);
               }elseif($request->isMethod('get')){
                   return $this->getFavorite($request, $param1, $param2);
               }
           }elseif($domain == "search"){
               $this->httpRequest = new HttpRequest($request);

               $logger->start();

               $result = $this->parseSearchQuery();

               $logger->end();


               if($this->httpRequest->isAjax){
                   if(count($result)>0){
                       return ["response"=>"completed","result"=>$result];
                   }else{
                       return ["response"=>"completed","result"=>null];
                   }
               }else{
                   return view("front.pages.search",compact("result"));
               }
           }
       }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param                          $param1
     * @param                          $param2
     * @return array
     */
    private function toggleFavorite(Request $request, $param1, $param2)
    {
        $favorite = Favorite::whereUserId($request->user()->id)->whereType($param1)->whereContentIdentifier($param2)->first();
        if ($favorite) {
            $favorite->delete();

            return ['response' => 'completed', "result" => false];
        } else {
            Favorite::create([
                                 "user_id"    => $request->user()->id,
                                 "type"       => $param1,
                                 "content_identifier" => $param2
                             ]);

            return ['response' => 'completed', "result" => true];
        }
    }

    private function parseSearchQuery()
    {

        $queries = $this->httpRequest->queries;
        $contentObject = App::make(ContentInterface::class);
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
            $unique = cache('pages')->unique(function($page){
                return $page->template->file;
            });

            foreach($unique as $page){
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

    private function getFavorite($request, $param1, $param2)
    {
        $favorite = Favorite::whereUserId($request->user()->id)->whereType($param1)->whereContentIdentifier($param2)->first();
        if ($favorite) {
            return ['response' => 'completed', "result" => true];
        }
        return ['response' => 'completed', "result" => false];
    }
}
