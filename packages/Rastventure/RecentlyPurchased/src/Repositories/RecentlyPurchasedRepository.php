<?php

namespace Rastventure\RecentlyPurchased\Repositories;

use Webkul\Core\Eloquent\Repository;
use Webkul\Product\Repositories\ProductFlatRepository;

class RecentlyPurchasedRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Rastventure\RecentlyPurchased\Contracts\RecentlyPurchased';
    }

    /**
     * Returns newly added product
     *
     * @return \Illuminate\Support\Collection
     */
    public function getRecentlyPurchasedProdct()
    {
        $productType = core()->getConfigData('recently_purchased.settings.settings.products_type');
        switch($productType):
            case 'featured':
                return $this->getFeaturedRecentPurchased();
                break;
            case 'new':
                return $this->getNewRecentPurchased();
                break;
            case 'random':
            default:
                return $this->getRandomRecentPurchased();
                break;
        endswitch;
    }

    public function getFeaturedRecentPurchased(){
        $results = app(ProductFlatRepository::class)->scopeQuery(function($query) {
            $channel = request()->get('channel') ?: (core()->getCurrentChannelCode() ?: core()->getDefaultChannelCode());

            $locale = request()->get('locale') ?: app()->getLocale();

            return $query->distinct()
                            ->addSelect('product_flat.*')
                            ->where('product_flat.status', 1)
                            ->where('product_flat.visible_individually', 1)
                            ->where('product_flat.featured', 1)
                            ->where('product_flat.channel', $channel)
                            ->where('product_flat.locale', $locale)
                            ->inRandomOrder();
        })->paginate(20);

        return $results;
    }

    public function getNewRecentPurchased(){
        $results = app(ProductFlatRepository::class)->scopeQuery(function($query) {
            $channel = request()->get('channel') ?: (core()->getCurrentChannelCode() ?: core()->getDefaultChannelCode());

            $locale = request()->get('locale') ?: app()->getLocale();

            return $query->distinct()
                            ->addSelect('product_flat.*')
                            ->where('product_flat.status', 1)
                            ->where('product_flat.visible_individually', 1)
                            ->where('product_flat.new', 1)
                            ->where('product_flat.channel', $channel)
                            ->where('product_flat.locale', $locale)
                            ->inRandomOrder();
        })->paginate(20);

        return $results;
    }

    public function getRandomRecentPurchased(){
        $results = app(ProductFlatRepository::class)->scopeQuery(function($query) {
            $channel = request()->get('channel') ?: (core()->getCurrentChannelCode() ?: core()->getDefaultChannelCode());

            $locale = request()->get('locale') ?: app()->getLocale();

            return $query->distinct()
                            ->addSelect('product_flat.*')
                            ->where('product_flat.status', 1)
                            ->where('product_flat.visible_individually', 1)
                            ->where('product_flat.channel', $channel)
                            ->where('product_flat.locale', $locale)
                            ->inRandomOrder();
        })->paginate(20);

        return $results;
    }
}