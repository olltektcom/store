<?php

namespace Rastventure\RecentlyPurchased\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use \Webkul\Theme\ViewRenderEventManager;

class RecentlyPurchasedServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {


        /*$this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'recentlypurchased');*/

        $this->publishes([
            __DIR__ . '/../../publishable/assets' => public_path('themes/default/assets'),
        ], 'public');

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'recentlypurchased');



        $this->app->register(EventServiceProvider::class);


    }

    /**
    * Register services.
    *
    * @return void
    */
    public function register()
    {

        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/system.php', 'core'
        );
    }
    /**
     * Register package config.
     *
     * @return void
     */
    protected function registerConfig()
    {

    }
}