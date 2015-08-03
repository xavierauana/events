<?php
/**
 * Created by PhpStorm.
 * User: adrianexavier
 * Date: 1/4/15
 * Time: 10:15 PM
 */

namespace Acme\Composers\partials;


use Acme\Entities\Layout;
use Content;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class FrontPartialsComposer {

    public function compose($view){
        $defaultLanguage = Cache::get('default_language');

        $viewName = $view->getName();
        $pos = strrpos($viewName,'.');
        $name = substr($viewName,$pos+1);

        if(preg_match('/^submenu_/i', $name))
        {
            $target = preg_split('/^submenu_/i', $name);
            $table = 'layout_'.$target[1];
            if(Schema::hasTable($table))
            {
                $db = new Content($table);
                if(Schema::hasColumn($table, 'order'))
                {
                    $items = $db->language($defaultLanguage->id)->active()->orderBy('order')->get();
                }elseif(Schema::hasColumn($table, 'published_date'))
                {
                    $items = $db->language($defaultLanguage->id)->active()->orderBy('published_date','desc')->get();
                }
                $view->with(compact('items'));
            }
        }

        if($name == 'menu')
        {
            $table = 'menus';
            if(Schema::hasTable($table))
            {
                $db = new Content($table);
                $result = $db->language($defaultLanguage->id)->active()->orderBy('order')->get();
                $groupId = $db->whereType('group')->whereDisplay('Subjects')->first();
                $menuItems = $result->filter(function($item){
                    return $item->group_id == 1;
                });
                $view->with(compact('menuItems'));
            }

        }else{
            $table = 'partial_'.$name;
            if(Schema::hasTable($table))
            {
                $db = new Content($table);
                $content = $db->language($defaultLanguage->id)->active()->first();
                $view->with($table, $content);
            }
        }

        $view;
    }
}