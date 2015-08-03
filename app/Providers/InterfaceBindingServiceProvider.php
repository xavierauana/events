<?php
/**
 * Author: Xavier Au
 * Date: 21/7/15
 * Time: 4:00 PM
 */

namespace App\Providers;


use App\Content;
use App\Contracts\Repositories\ContentInterface;
use App\Contracts\Repositories\LanguageInterface;
use App\Contracts\Repositories\MediaInterface;
use App\Contracts\Repositories\MenuGroupInterface;
use App\Contracts\Repositories\MenuInterface;
use App\Contracts\Repositories\MenuItemInterface;
use App\Contracts\Repositories\PageInterface;
use App\Contracts\Repositories\SettingInterface;
use App\Language;
use App\Media;
use App\Menu;
use App\MenuGroup;
use App\MenuItem;
use App\Page;
use App\Setting;
use Illuminate\Support\ServiceProvider;

class InterfaceBindingServiceProvider extends ServiceProvider{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PageInterface::class, Page::class);
        $this->app->bind(ContentInterface::class, Content::class);
        $this->app->bind(MediaInterface::class, Media::class);
        $this->app->bind(LanguageInterface::class, Language::class);
        $this->app->bind(SettingInterface::class, Setting::class);
        $this->app->bind(MenuInterface::class, Menu::class);
        $this->app->bind(MenuGroupInterface::class, MenuGroup::class);
        $this->app->bind(MenuItemInterface::class, MenuItem::class);
    }
}