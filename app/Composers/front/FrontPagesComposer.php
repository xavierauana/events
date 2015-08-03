<?php
/**
 * Created by PhpStorm.
 * User: adrianexavier
 * Date: 26/5/15
 * Time: 5:01 PM
 */

namespace Acme\Composers\front;


use Content;
use Favorite;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class FrontPagesComposer {
    public function compose($view)
    {
        $layout = substr($view->getName(), strrpos($view->getName(),':')+1);
        $composerData = $this->$layout;
        $view->with(compact('composerData'));
    }

    public function __get($property)
    {
        $method = 'get'.$property;
        if(! method_exists($this,$method)) return null;
        return $this->$method();
    }

    public function getMovie()
    {
        $favorites = new Collection();
        if(Auth::user())
        {
            $favorites = Favorite::whereUserId(Auth::user()->id)->get();
        }
//        $favorites = Favorite::whereUserId(Auth::user()->id)->get();
        return $favorites;
    }
    public function getDashboard()
    {
        $favorites = Favorite::whereUserId(Auth::user()->id)->get();
        $collection = new Collection();
        foreach($favorites as $favorite)
        {
            $content = new Content('layout_movie');
            $object = $content->wherePageId($favorite->page_id)
                        ->whereContentIdentifier($favorite->content_identifier)
                        ->first();
            if($object) $collection->push($object);
        }

        return $collection;
    }

}