<?php

namespace Rastventure\RecentlyPurchased\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Rastventure\RecentlyPurchased\Models\RecentlyPurchased::class,
    ];
}