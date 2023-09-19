{!! view_render_event('bagisto.shop.products.add_to_cart.before', ['product' => $product]) !!}



    <button type="submit" data-loading-text='<i class="icon icon-spinner spin"></i><span>Add to cart</span>' class="btn btn-lg btn-loading add-to-buttons" {{ ! $product->isSaleable() ? 'disabled' : '' }}>
        <i class="icon icon-cart"></i><span>{{ __('shop::app.products.add-to-cart') }}</span>
    </button>
    <a href="#" class="btn btn-lg product-details"><i class="icon icon-external-link"></i></a>

{!! view_render_event('bagisto.shop.products.add_to_cart.after', ['product' => $product]) !!}