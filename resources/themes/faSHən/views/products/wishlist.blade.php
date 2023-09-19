@inject ('wishListHelper', 'Webkul\Customer\Helpers\Wishlist')


{!! view_render_event('bagisto.shop.products.wishlist.before') !!}

<a
    @if ($wishListHelper->getWishlistProduct($product))
        class="wishlist active"
    @else
        class="wishlist"
    @endif
    id="wishlist-changer"
    style="margin-right: 15px;"
    href="{{ route('customer.wishlist.add', $product->product_id) }}">
    <i class="icon icon-heart"></i><span>Add to Wishlist</span>
</a>

{!! view_render_event('bagisto.shop.products.wishlist.after') !!}