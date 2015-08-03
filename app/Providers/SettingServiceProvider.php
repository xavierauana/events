<?php

namespace App\Providers;

use App\Contracts\Repositories\LanguageInterface;
use App\Contracts\Repositories\PageInterface;
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
        $pageObject = $this->app->make(PageInterface::class);
        $languageObject = $this->app->make(LanguageInterface::class);
        Cache::rememberForever('default_language', function()use($languageObject){
            return $languageObject->whereDefault(1)->first();
        });
        Cache::rememberForever('active_languages', function()use($languageObject){
            return $languageObject->whereActive(1)->get();
        });
        Cache::rememberForever('pages', function()use($pageObject){
            return $pageObject->whereActive(1)->get();
        });
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
