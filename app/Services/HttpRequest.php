<?php
/**
 * Author: Xavier Au
 * Date: 12/8/15
 * Time: 3:52 PM
 */

namespace App\Services;


use Illuminate\Http\Request;

class HttpRequest
{
    public $language;
    public $page;
    public $baseUrl;
    public $isApiCall = false;
    public $identifier      = null;
    public $isAjax         = false;
    public $requestIsSearching    = false;
    public $queries        = false;
    private $firstSegmentIsLanguage = false;
    private $segments;

    /**
     * $request->isSearching
     * $request->isAjax
     * $request->languageCode
     * $request->layout
     * $request->layoutType
     * $request->identifier
     */
    /**
     * ParseUrl constructor.
     */
    public function __construct(Request $request)
    {
        $this->isAjaxApiCall($request);
        if($this->requestIsSearching($request)) return;
        $this->setLanguage($this->segments);
        $this->setPage($this->segments);
        $this->setIdentifier($this->segments);
    }

    private function setLanguage()
    {
        $theLanguage = cache("default_language");
        if(isset($this->segments[0])){
            $languages = cache("active_languages");
            foreach($languages as $language){
                if($this->segments[0] == $language->code){
                    $theLanguage = $language;
                    $this->firstSegmentIsLanguage = true;
                    $this->baseUrl = $this->segments[1];
                }else{
                    $this->baseUrl = $this->segments[0];
                }
            }
        }
        $this->language = $theLanguage;
    }

    private function setPage()
    {
        $pages = cache("pages");

        $this->firstSegmentIsLanguage? $index = 1: $index = 0;

        if(isset($this->segments[$index])){
            $this->page = $pages->first(function($i, $page)use($index){
                return $this->segments[$index] == $page->url;
            });
            if($this->page){
                $this->baseUrl = $this->segments[$index];
            }else{
                abort(404,"page not found");
            }
        }else{
            $this->page = $pages->first(function($i, $page){
                return $page->url == "index";
            });
            $this->baseUrl = "index";
        }
    }

    private function setIdentifier()
    {
        $this->firstSegmentIsLanguage? $index = 2: $index = 1;
        if (isset($this->segments[$index])) {
            $this->identifier = $this->segments[$index];
        }else{
            $this->identifier =  null;
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param                          $segments
     *
     * @return array
     */
    private function isAjaxApiCall(Request $request)
    {
        $segments = $request->segments();

        if ($this->firstUrlSegmentIsApi($segments)) {

            $request->ajax() ? $this->isAjax = true : abort(405, "method not allowed");

            $this->isApiCall = true;

            $segments = array_values(array_splice($segments, 1));

            $this->segments = $segments;

        }else{

            $this->segments = $segments;

        }

    }

    private function requestIsSearching($request){
        if($this->firstUrlSegmentIsSearch()){
            $this->requestIsSearching = true;
            $this->queries = $request->query->all();
            return true;
        }
    }

    /**
     * @param $segments
     * @return bool
     */
    private function firstUrlSegmentIsApi($segments)
    {
        return isset($segments[0]) && $segments[0] == 'api';
    }/**
 * @return bool
 */private function firstUrlSegmentIsSearch()
{
    return isset($this->segments[0]) && $this->segments[0] == 'search';
}
}