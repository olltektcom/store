<?php

namespace Rastventure\RecentlyPurchased\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Webkul\Theme\ViewRenderEventManager;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen('bagisto.shop.layout.footer.after', static function(ViewRenderEventManager $viewRenderEventManager) {
            $viewRenderEventManager->addTemplate('recentlypurchased::shop.' . core()->getCurrentChannel()->theme . '.recent');
        });

        Event::listen('bagisto.shop.layout.head', static function(ViewRenderEventManager $viewRenderEventManager) {
            $viewRenderEventManager->addTemplate('recentlypurchased::shop.' . core()->getCurrentChannel()->theme . '.loadproducts');
        });



    }
}