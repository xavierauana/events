<?php

namespace App\Providers;

use Acme\Composers\back\GenerateFormComposer;
use Acme\Composers\front\FrontPagesComposer;
use Acme\Composers\partials\FrontPartialsComposer;
use Illuminate\Support\ServiceProvider;

class ComposerBindingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer([
            GenerateFormComposer::class => ['contents.single'],
            FrontPartialsComposer::class => ['front.partials.*'],
            FrontPagesComposer::class => ['front.pages.*'],
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
