<div class="cart-wish-wrap">
    <form action="{{ route('cart.add', $product->product_id) }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
        <input type="hidden" name="quantity" value="1">
        <button class="btn add-to-cart" data-product="{{ $product->id }}" {{ $product->isSaleable() ? '' : 'disabled' }}> <i class="icon icon-cart"></i><span>{{ __('shop::app.products.add-to-cart') }}</span> </button>
    </form>

    {{-- @include('shop::products.wishlist') --}}

    @include('shop::products.compare', [
        'productId' => $product->id
    ]) 
</div>