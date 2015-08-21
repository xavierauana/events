<?php
    /**
     * Author: Xavier Au
     * Date: 12/8/15
     * Time: 3:52 PM
     */

    namespace App\Services;


    use Illuminate\Http\Request;

    class ParseUrl
    {
        public $language;
        public $page;
        public $identifier;
        public $type;
        public $isAjax      = false;
        public $isSearch    = false;
        public $queries     = false;
        private $firstSegmentIsLanguage = false;

        /**
         * ParseUrl constructor.
         */
        public function __construct(Request $request)
        {
            $segments           = $request->segments();
            $segments           = $this->isAjaxApiCall($request, $segments);
            if($this->isSearch($request, $segments)) return;
            $this->language     = $this->setLanguage($segments);
            $this->page         = $this->setPage($segments);
            $this->identifier   = $this->setIdentifier($segments);
        }

        private function setLanguage(array $segments)
        {
            $result = cache("default_language");
            if(isset($segments[0])){
                $languages = cache("active_languages");
                foreach($languages as $language){
                    if($segments[0] == $language->code){
                        $result = $language;
                        $this->firstSegmentIsLanguage = true;
                    }
                }
            }
            return $result;
        }

        private function setPage(array $segments)
        {
            if($this->firstSegmentIsLanguage){
                return $this->findPageObject(1, $segments);
            }else{
                return $this->findPageObject(0, $segments);
            }
        }

        private function setIdentifier(array $segments)
        {
            if($this->firstSegmentIsLanguage){
                return $this->getIdentifier(2, $segments);
            }else{
                return $this->getIdentifier(1, $segments);
            }
        }

        private function findPageObject($index, array $segments){
            $pages = cache("pages");
            if(isset($segments[$index])){
                foreach( $pages as $page){
                    if($segments[$index] == $page->url){
                        $this->type = $page->template->type;
                        return $this->page = $page;
                    }
                }
                abort(404,"page not found");
            }else{
                $page = $pages->filter(function($page){
                    return $page->url == "index";
                })->first();
                $this->type = $page->template->type;
                return $page;
            }
        }

        /**
         * @param array $segments
         *
         * @return null
         */
        private function getIdentifier($index, array $segments)
        {
            if (isset($segments[$index])) {
                return $this->identifier = $segments[$index];
            }
            return null;
        }

        /**
         * @param \Illuminate\Http\Request $request
         * @param                          $segments
         *
         * @return array
         */
        private function isAjaxApiCall(Request $request, $segments)
        {
            if (isset($segments[0]) && $segments[0] == 'api') {
                $segments = array_values(array_splice($segments, 1));
                $request->ajax() ? $this->isAjax = true : abort(405, "method not allowed");

                return $segments;
            }
            return $segments;
        }

        private function isSearch($request, $segments){
            if(isset($segments[0]) && $segments[0] == 'search'){
                $this->isSearch = true;
                $this->queries = $request->query->all();
                return true;
            }
        }
    }