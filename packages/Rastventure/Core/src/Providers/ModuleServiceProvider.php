<?php

namespace Rastventure\Core\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Rastventure\Core\Models\ThemeBanners::class,
    ];
}
