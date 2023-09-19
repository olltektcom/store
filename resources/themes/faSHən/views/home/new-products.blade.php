@if (app('Webkul\Product\Repositories\ProductRepository')->getNewProducts()->count())
<!-- Deal Carousel -->
<div class="title">
    <h2 class="custom-color">{{ __('shop::app.home.new-products') }}</h2>
    <div class="toggle-arrow"></div>
    <div class="carousel-arrows"></div>
</div>
<div class="collapsed-content">
    <div class="deal-carousel-2 products-grid product-variant-5">
        <!-- Product Item -->
        @foreach (app('Webkul\Product\Repositories\ProductRepository')->getNewProducts() as $product)
        <div class="product-item large">
            <div class="product-item-inside">
                <div class="product-item-info">
                    <!-- Product Photo -->
                    <div class="product-item-photo">
                        <!-- product main photo -->
                        <?php $productBaseImage = productimage()->getProductBaseImage($product); ?>
                        <div class="product-item-gallery-main">
                            <a href="{{ route('shop.productOrCategory.index', $product->url_key) }}"><img class="product-image-photo" src="{{ $productBaseImage['medium_image_url'] }}" onerror="this.src='{{ asset('vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png') }}'" alt="{{ $product->name }}"></a>
                            <!--<a href="{{ route('shop.productOrCategory.index', $product->url_key) }}" title="Quick View" class="quick-view-link quick-view-btn"> <i class="icon icon-eye"></i><span>Quick View</span></a>-->
                        </div>
                        <!-- /product main photo  -->
                        <!-- Product Label -->
                        <div class="product-item-label label-new"><span>{{ __('shop::app.products.new') }}</span></div>
                        <!-- /Product Label -->
                        <!-- Product Actions -->
                        @include('shop::products.wishlist')
                        <!--<div class="product-item-actions">
                            <div class="share-button toBottom">
                                <span class="toggle"></span>
                                <ul class="social-list">
                                    <li>
                                        <a href="#" class="icon icon-google google"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="icon icon-fancy fancy"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="icon icon-pinterest pinterest"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="icon icon-twitter-logo twitter"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="icon icon-facebook-logo facebook"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>-->
                        <!-- /Product Actions -->
                    </div>
                    <!-- /Product Photo -->
                    <!-- Product Details -->
                    <div class="product-item-details">
                        <div class="product-item-name"> <a title="Cover up tunic" href="product.html" class="product-item-link">{{ $product->name }}</a></div>
                        <div class="price-box">@include ('shop::products.price', ['product' => $product])</div>
                        @include('shop::products.add-buttons', ['product' => $product])
                    </div>
                    <!-- /Product Details -->
                </div>
            </div>
        </div>
        @endforeach
        <!-- /Product Item -->
        
    </div>
</div>
<!-- /Deal Carousel -->
@endif