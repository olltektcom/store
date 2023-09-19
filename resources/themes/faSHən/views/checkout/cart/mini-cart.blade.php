<?php $cart = cart()->getCart(); ?>
<!-- Header Cart -->
@if ($cart)
<div class="header-link dropdown-link header-cart variant-1">
    <a href="{{ route('shop.checkout.cart.index') }}">
        <i class="icon icon-cart"></i> <span class="badge">{{ $cart->items->count() }}</span> 
    </a>
    <?php $items = $cart->items; ?>
    <!-- minicart wrapper -->
    <div class="dropdown-container right">
        <!-- minicart content -->
        <div class="block block-minicart">
            <div class="minicart-content-wrapper">
                <div class="block-title">
                    <span>Recently added item(s)</span>
                </div>
                <a class="btn-minicart-close" title="Close">&#10060;</a>
                <div class="block-content">
                    <div class="minicart-items-wrapper overflowed">
                        <ol class="minicart-items">
                        @foreach ($items as $item)
                            <li class="item product product-item">
                                <div class="product">
                                    @php
                                        $images = $item->product->getTypeInstance()->getBaseImage($item);
                                        if (is_null ($item->product->url_key)) {
                                            if (! is_null($item->product->parent)) {
                                                $url_key = $item->product->parent->url_key;
                                            }
                                        } else {
                                            $url_key = $item->product->url_key;
                                        }
                                    @endphp
                                    <a class="product-item-photo" href="{{ route('shop.productOrCategory.index', $url_key) }}" title="Long sleeve overall">
                                        <span class="product-image-container">
                                        <span class="product-image-wrapper">
                                        <img class="product-image-photo" src="{{ $images['small_image_url'] }}" alt="{{ $item->name }}">
                                        </span>
                                        </span>
                                    </a>
                                    <div class="product-item-details">
                                        <div class="product-item-name">
                                            <!-- product name -->
                                            {!! view_render_event('bagisto.shop.checkout.cart-mini.item.name.before', ['item' => $item]) !!}
                                            <a href="{{ route('shop.productOrCategory.index', $url_key) }}">{{ $item->name }}</a>
                                            {!! view_render_event('bagisto.shop.checkout.cart-mini.item.name.after', ['item' => $item]) !!}
                                            <!-- /product name -->
                                            <!-- product attributes -->
                                            {!! view_render_event('bagisto.shop.checkout.cart-mini.item.options.before', ['item' => $item]) !!}
                                            @if (isset($item->additional['attributes']))
                                                <div class="item-options">
                                                    @foreach ($item->additional['attributes'] as $attribute)
                                                        <b>{{ $attribute['attribute_name'] }} : </b>{{ $attribute['option_label'] }}</br>
                                                    @endforeach

                                                </div>
                                            @endif
                                            {!! view_render_event('bagisto.shop.checkout.cart-mini.item.options.after', ['item' => $item]) !!}
                                            <!-- /product attributes -->
                                        </div>
                                        <div class="product-item-qty">
                                            <label class="label">Quantity</label>
                                            {!! view_render_event('bagisto.shop.checkout.cart-mini.item.quantity.before', ['item' => $item]) !!}
                                            <input class="item-qty cart-item-qty" maxlength="12" value="{{ $item->quantity }}">
                                            {!! view_render_event('bagisto.shop.checkout.cart-mini.item.quantity.after', ['item' => $item]) !!}
                                           <!-- <button class="update-cart-item" style="display: none" title="Update">
                                                <span>Update</span>
                                            </button>-->
                                        </div>
                                        <div class="product-item-pricing">
                                            <div class="price-container">
                                                <span class="price-wrapper">
                                                    <span class="price-excluding-tax">
                                                    <span class="minicart-price">
                                                        {!! view_render_event('bagisto.shop.checkout.cart-mini.item.price.before', ['item' => $item]) !!}
                                                        <span class="price">{{ core()->currency($item->base_total) }}</span> 
                                                        {!! view_render_event('bagisto.shop.checkout.cart-mini.item.price.after', ['item' => $item]) !!}
                                                    </span>
                                                </span>
                                                </span>
                                            </div>
                                            <div class="product actions">
                                                <div class="secondary">
                                                    <a href="{{ route('shop.checkout.cart.remove',$item->id) }}" class="action delete" title="Remove item">
                                                        <span>Delete</span>
                                                    </a>
                                                </div>
                                                <div class="primary">
                                                    <a class="action edit" href="{{ route('shop.checkout.cart.index') }}" title="Edit item">
                                                        <span>Edit</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        </ol>
                    </div>
                    <div class="subtotal">
                        <span class="label">
                            <span>Subtotal</span>
                        </span>
                        <div class="amount price-container">
                            <span class="price-wrapper"><span class="price">
                            {{ __('shop::app.checkout.cart.cart-subtotal') }} -
                                {!! view_render_event('bagisto.shop.checkout.cart-mini.subtotal.before', ['cart' => $cart]) !!}
                                {{ core()->currency($cart->base_sub_total) }}
                                {!! view_render_event('bagisto.shop.checkout.cart-mini.subtotal.after', ['cart' => $cart]) !!}
                            </span></span>
                        </div>
                    </div>
                    <div class="actions">
                        <div class="secondary">
                            <a href="{{ route('shop.checkout.cart.index') }}" class="btn btn-alt">
                                <i class="icon icon-cart"></i><span>{{ __('shop::app.minicart.view-cart') }}</span>
                            </a>
                        </div>
                        <div class="primary">
                            <a class="btn" href="{{ route('shop.checkout.onepage.index') }}">
                                <i class="icon icon-external-link"></i><span>{{ __('shop::app.minicart.checkout') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /minicart content -->
    </div>
    <!-- /minicart wrapper -->
</div>
@else
<div class="header-link dropdown-link header-cart variant-1">
    <a href="{{ route('shop.checkout.cart.index') }}">
        <i class="icon icon-cart"></i> <span class="badge">{{ __('shop::app.minicart.zero') }}</span> 
    </a>
</div>
@endif
<!-- /Header Cart -->