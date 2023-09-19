@if (app('Webkul\Product\Repositories\ProductRepository')->getFeaturedProducts()->count())
<!-- Featured Carousel -->
<div class="title">
    <h2>{{ __('shop::app.home.featured-products') }}</h2>
    <div class="carousel-arrows"></div>
</div>
<!-- Featured Carousel Item -->
<div class="blog-carousel">
    <!-- Featured Carousel Item -->
    @foreach (app('Webkul\Product\Repositories\ProductRepository')->getFeaturedProducts() as $product)

    <?php $productBaseImage = productimage()->getProductBaseImage($product); ?>
    <div class="blog-item">
        <a href="{{ route('shop.productOrCategory.index', $product->url_key) }}" class="blog-item-photo"> <img class="product-image-photo" src="{{ $productBaseImage['medium_image_url'] }}" onerror="this.src='{{ asset('vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png') }}'" alt="{{ $product->name }}"> </a>
        <!-- Product Label -->
        <div class="product-item-label label-sale"><span>{{ __('fashion::app.products.featured') }}</span></div>
        <!-- /Product Label -->
        <div class="blog-item-info">
            
            <a href="{{ route('shop.productOrCategory.index', $product->url_key) }}" class="blog-item-title">{{ $product->name }}</a>
            <div class="blog-item-teaser">@include ('shop::products.price', ['product' => $product])</div>
            @include('shop::products.add-buttons', ['product' => $product])
        </div>
    </div>
    @endforeach
    <!-- /Featured Carousel Item -->
</div>
<!-- /Featured Carousel -->
@endif