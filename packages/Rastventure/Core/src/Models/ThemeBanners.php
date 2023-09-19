<?php

namespace Rastventure\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Rastventure\Core\Contracts\ThemeBanners as ThemeBannersContract;

class ThemeBanners extends Model implements ThemeBannersContract
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'theme_banners';

    protected $guarded = [
        'id',
        'created_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'image_url',
        'link',
        'updated_at',
        'banner_number'
    ];


    /**
     * Get image url for the category image.
     *
     * @return string
     */
    public function image_url()
    {
        if (!$this->image_url) {
            return '';
        }

        return Storage::url($this->image_url);
    }
}
