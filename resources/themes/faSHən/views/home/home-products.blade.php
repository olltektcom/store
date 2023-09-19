@if (app('Webkul\Product\Repositories\ProductRepository')->getAll()->count())
<div class="container">
    <ul class="filters filters-product style2">
        <li><a  class="filter-label active">Recently released catalog<span class="count"></span></a></li>
        <!--<li><a href="#" class="filter-label" data-filter=".category1">New<span class="count"></span></a></li>
        <li><a href="#" class="filter-label" data-filter=".category2">Featured<span class="count"></span></a></li>-->
    </ul>
    <div class="products-grid-wrapper isotope-wrapper">
        <div class="products-grid isotope four-in-row product-variant-4">
            @foreach (app('Webkul\Product\Repositories\ProductRepository')->getAll() as $product)
                {!! view_render_event('bagisto.shop.products.list.card.before', ['product' => $product]) !!}
                
                @include ('shop::products.list.card', ['product' => $product])
                
                {!! view_render_event('bagisto.shop.products.list.card.after', ['product' => $product]) !!}
            @endforeach
        </div>
    </div>
</div>
@endif
