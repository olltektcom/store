<?php

Route::group([
    'prefix'        => 'admin/themesettings',
    'middleware'    => ['web', 'admin']
], function () {

    Route::get('banner', 'Rastventure\Core\Http\Controllers\Admin\CoreSettingsController@banner')->defaults('_config', [
        'view' => 'rastventure::admin.banners.index',
    ])->name('admin.themesettings.banner');

    Route::post('create', 'Rastventure\Core\Http\Controllers\Admin\CoreSettingsController@store')->defaults('_config', [
        'redirect' => 'admin.themesettings.banner',
    ])->name('admin.themesettings.store');
});
