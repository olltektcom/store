<?php
    $relatedProducts = $product->related_products()->get();
?>

@if ($relatedProducts->count())

        <div class="title">
            <h2>{{ __('shop::app.products.related-product-title') }}</h2>
            <span class="border-bottom"></span>
        </div>



            @foreach ($relatedProducts as $related_product)

                @include ('shop::products.list.card', ['product' => $related_product])

            @endforeach



@endif