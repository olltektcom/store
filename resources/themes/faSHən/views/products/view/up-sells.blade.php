{!! view_render_event('bagisto.shop.products.view.up-sells.after', ['product' => $product]) !!}

<?php
    $productUpSells = $product->up_sells()->get();
?>

@if ($productUpSells->count())

        <div class="title">
            <h2>{{ __('shop::app.products.up-sell-title') }}</h2>
            <span class="border-bottom"></span>
        </div>



            @foreach ($productUpSells as $up_sell_product)

                @include ('shop::products.list.card', ['product' => $up_sell_product])

            @endforeach


@endif

{!! view_render_event('bagisto.shop.products.view.up-sells.after', ['product' => $product]) !!}