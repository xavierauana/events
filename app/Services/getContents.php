<?php
/**
 * Author: Xavier Au
 * Date: 21/7/15
 * Time: 3:57 PM
 */

namespace App\Services;


use App\Contracts\Repositories\ContentInterface;
use App\Contracts\Repositories\PageInterface;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class getContents {
    private $page;
    private $layoutType;
    private $content;


    function __construct($layoutType, $pageId)
    {
        $this->layoutType = $layoutType;
        $this->page = App::make(PageInterface::class)->findOrFail($pageId);
        $this->content = App::make(ContentInterface::class);
    }

    public function getContents()
    {
        $table   = $this->getTable($this->page);
        $this->content->setTable($table);
        $contents = "";
        if($this->layoutType == 'single')
        {
            $contents  = $this->content->wherePageId($this->page->id)->get();
            if(count($contents) == 0){
                $this->createRecords();
                $contents =  $this->content->wherePageId($this->page->id)->get();
            }
        }elseif($this->layoutType == 'structural'){
            $contents = $this->content->distinct()->wherePageId($this->page->id)->orderBy('order')->lists('content_identifier');
        }elseif($this->layoutType == 'channel'){
            $contents = $this->content->distinct()->wherePageId($this->page->id)->orderBy('created_at','desc')->lists('content_identifier');
        }
        return [$contents, $this->page->layout->contentFields];
    }


    /**
     * get the db table which match the page
     * @return string
     */
    private function getTable()
    {
        $table = 'layout_' . strtolower($this->page->layout->displayName);
        return $table;
    }

    /**
     * @param $command
     * @param $table
     *
     * @return void
     */
    private function createRecords()
    {
        $languages = Cache::get('active_languages');
        foreach ($languages as $language) {
            $test = $this->content->wherePageId($this->page->id)->whereLangId($language->id)->get();
            dd($test);
            if(count($test) == 0){
                $this->content->lang_id = $language->id;
                $this->content->page_id = $this->page->id;
                $this->content->save();
            }
        }
    }
}