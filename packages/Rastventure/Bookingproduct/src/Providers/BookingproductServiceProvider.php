<?php

namespace Rastventure\Bookingproduct\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use Webkul\Theme\ViewRenderEventManager;

class BookingproductServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
         $GOPATH=config('config.default_path');
          
         
         if(!isset($GOPATH)){
             $GOPATH='';
         }
         

        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'fashion');



        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'fashion');

        Event::listen('bagisto.shop.products.view.short_description.after', static function(ViewRenderEventManager $viewRenderEventManager) {
            if (View::exists('fashion::shop.' . core()->getCurrentChannel()->theme . '.products.view.booking')) {
                $viewRenderEventManager->addTemplate('fashion::shop.' . core()->getCurrentChannel()->theme . '.products.view.booking');
            }
        });

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    
}