{!! view_render_event('bagisto.shop.products.list.card.before', ['product' => $product]) !!}


<!-- Product Item -->
@inject ('reviewHelper', 'Webkul\Product\Helpers\Review')
@inject ('toolbarHelper', 'Webkul\Product\Helpers\Toolbar')
{{-- @include('shop::UI.product-quick-view') --}}

@php
    if (isset($checkmode) && $checkmode && $toolbarHelper->getCurrentMode() == "list") {
        $list = true;
    }
@endphp

@php
    $productBaseImage = productimage()->getProductBaseImage($product);
    $totalReviews = $reviewHelper->getTotalReviews($product);
    $avgRatings = ceil($reviewHelper->getAverageRating($product));
@endphp

<?php $productBaseImage = productimage()->getProductBaseImage($product); ?>
<div class="product-item large category1">
    <div class="product-item-inside">
        <div class="product-item-info">
            <!-- Product Photo -->
            <div class="product-item-photo">
                <!-- Product Label -->
                @if ($product->new)
                    <div class="product-item-label label-new"><span>{{ __('shop::app.products.new') }}</span></div>
                @endif
                @if ($product->featured)
                    <div class="product-item-label label-sale"><span>{{ __('fashion::app.products.featured') }}</span></div>
                @endif
                <!-- /Product Label -->
                <!-- product main photo -->
                <!-- product inside carousel -->
                <div class="carousel-inside slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <?php $images = productimage()->getGalleryImages($product); ?>
                        @if(count($images)>0)
                            @php $count=1; @endphp
                            @foreach($images as $image)
                                @php $active = ($count==1)?"active":""; @endphp
                                <div class="item {{ $active }}">
                                    <a href="{{ route('shop.productOrCategory.index', $product->url_key) }}">
                                        <img src="{{ $image['medium_image_url'] }}" data-image="{{ $image['medium_image_url'] }}" alt="{{ $product->name }}">
                                    </a>
                                </div>
                                @php $count++; @endphp
                            @endforeach
                        @endif
                    </div>
                    <a class="carousel-control next"></a>
                    <a class="carousel-control prev"></a>
                </div>
                <!-- /product inside carousel -->
                <!--<a href="quick-view.html" title="Quick View" class="quick-view-link quick-view-btn"> <i class="icon icon-eye"></i><span>Quick View</span></a>-->
                {{-- <product-quick-view-btn :quick-view-details="product"></product-quick-view-btn> --}}
                <!-- /product main photo  -->
                <!-- Product Actions -->
                @include('shop::products.wishlist')
                
                <!-- /Product Actions -->
            </div>
            <!-- /Product Photo -->
            <!-- Product Details -->
            <div class="product-item-details">
                <div class="product-item-name"> 
                    <a class="product-item-link" href="{{ route('shop.productOrCategory.index', $product->url_key) }}" title="{{ $product->name }}">
                            {{ $product->name }}
                    </a>
                </div>
                <div class="product-item-description">{!! $product->short_description !!}</div>
                <div class="price-box">
                    @include ('shop::products.price', ['product' => $product])
                </div>
                <div class="product-item-rating"> 
                    @include ('shop::products.review', ['product' => $product])
                </div>
                @include('shop::products.add-buttons', ['product' => $product])
            </div>
            <!-- /Product Details -->
        </div>
    </div>
</div>
<!-- /Product Item -->


{!! view_render_event('bagisto.shop.products.list.card.after', ['product' => $product]) !!}