<?php

namespace App\Listeners;

use App\Contracts\Repositories\LanguageInterface;
use App\Contracts\Repositories\PageInterface;
use App\Contracts\Repositories\SettingInterface;
use App\Events\RefreshCache;
use App\Page;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class RefreshCacheEventListener
{

    /**
     * Create the event listener.
     *
     * @param \App\Contracts\Repositories\PageInterface     $page
     * @param \App\Contracts\Repositories\LanguageInterface $language
     * @param \App\Contracts\Repositories\SettingInterface  $setting
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  RefreshCache  $event
     * @return void
     */
    public function handle(RefreshCache $event)
    {

        if($event->object == 'page')
        {
            $this->refreshPage();
        }
        if($event->object == 'language')
        {
            $this->refreshLanguage();
        }
        if($event->object == 'settings')
        {
            $this->refreshSetting();
        }
    }

    /**
     * @param \App\Contracts\Repositories\PageInterface $page
     **/
    private function refreshPage()
    {
        $page = App::make(PageInterface::class);
            Cache::forget('pages');
            Cache::rememberForever('pages', function ()use($page){
                return $page->whereActive(true)->get();
            });
    }

    private function refreshLanguage()
    {
        $language = App::make(LanguageInterface::class);

        $key = 'default_language';
        Cache::forget($key);
        Cache::rememberForever($key,function()use($language){
            return $language->whereDefault(1)->firstOrFail();
        });

        $key = 'active_languages';
        Cache::forget($key);
        Cache::rememberForever($key,function()use($language){
            return $language->whereActive(1)->get();
        });
    }

    private function refreshSetting()
    {
        $setting = App::make(SettingInterface::class);
        $key = 'default_role';
        Cache::forget($key);
    }
}
