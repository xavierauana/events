<?php

namespace App\Providers;

use App\Contracts\Repositories\LanguageInterface;
use App\Contracts\Repositories\PageInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
//        $pageObject = $this->app->make(PageInterface::class);
//        $languageObject = $this->app->make(LanguageInterface::class);
//        cache()->rememberForever("default_language", function()use($languageObject){
//            try{
//                return $languageObject->whereDefault(1)->first();
//            }finally{
//                $languageObject->id = 1;
//                $languageObject->code = 'en';
//                $languageObject->active = 1;
//                $languageObject->default = 1;
//                $languageObject->display = "English";
//
//                return $languageObject;
//            }
//        });
//        cache()->rememberForever("active_languages", function()use($languageObject){
//            try{
//                return $languageObject->whereActive(1)->get();
//            }finally{
//                $collection = new Collection();
//                $languageObject->id = 1;
//                $languageObject->code = 'en';
//                $languageObject->active = 1;
//                $languageObject->default = 1;
//                $languageObject->display = "English";
//                $collection->add($languageObject);
//                return $collection;
//            }
//        });
//        cache()->rememberForever("pages", function()use($pageObject){
//            return $pageObject->whereActive(1)->with("template")->get();
//        });
//        cache()->forever("timezone", setting("timezone"));
//        cache()->forever("dateTimeFormat", "Do MMMM YYYY hh:mm A");
//        config(["app.locale" => cache("default_language")->code]);
//        config(['app.timezone' => cache("timezone")]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
