<div class="form-container">
    <div class="form-header mb-30">
        <span class="checkout-step-heading">{{ __('shop::app.checkout.onepage.summary') }}</span>
    </div>

    <div class="address-summary">
        @if ($billingAddress = $cart->billing_address)
            <div class="billing-address">
                <div class="card-title mb-20">
                    <b>{{ __('shop::app.checkout.onepage.billing-address') }}</b>
                </div>

                <div class="card-content">
                    <ul>
                        <li class="mb-10">
                            {{ $billingAddress->first_name }} {{ $billingAddress->last_name }}
                        </li>
                        <li class="mb-10">
                            {{ $billingAddress->address1 }},<br/> {{ $billingAddress->state }}
                        </li>
                        <li class="mb-10">
                            {{ core()->country_name($billingAddress->country) }} {{ $billingAddress->postcode }}
                        </li>

                        <span class="horizontal-rule mb-15 mt-15"></span>

                        <li class="mb-10">
                            {{ __('shop::app.checkout.onepage.contact') }} : {{ $billingAddress->phone }}
                        </li>
                    </ul>
                </div>
            </div>
        @endif

        @if ($cart->haveStockableItems() && $shippingAddress = $cart->shipping_address)
            <div class="shipping-address">
                <div class="card-title mb-20">
                    <b>{{ __('shop::app.checkout.onepage.shipping-address') }}</b>
                </div>

                <div class="card-content">
                    <ul>
                        <li class="mb-10">
                            {{ $shippingAddress->first_name }} {{ $shippingAddress->last_name }}
                        </li>
                        <li class="mb-10">
                            {{ $shippingAddress->address1 }},<br/> {{ $shippingAddress->state }}
                        </li>
                        <li class="mb-10">
                            {{ core()->country_name($shippingAddress->country) }} {{ $shippingAddress->postcode }}
                        </li>

                        <span class="horizontal-rule mb-15 mt-15"></span>

                        <li class="mb-10">
                            {{ __('shop::app.checkout.onepage.contact') }} : {{ $shippingAddress->phone }}
                        </li>
                    </ul>
                </div>
            </div>
        @endif

    </div>



    <div class="cart-item-list mt-20">
        @foreach ($cart->items as $item)
            @php
                $images = $item->product->getTypeInstance()->getBaseImage($item);
            @endphp

            <div class="item mb-5" style="margin-bottom: 5px;">
                <div class="item-image">
                    <img src="{{ $images['medium_image_url'] }}" />
                </div>

                <div class="item-details">

                    {!! view_render_event('bagisto.shop.checkout.name.before', ['item' => $item]) !!}

                    <div class="item-title">
                        {{ $item->product->name }}
                    </div>

                    {!! view_render_event('bagisto.shop.checkout.name.after', ['item' => $item]) !!}
                    {!! view_render_event('bagisto.shop.checkout.price.before', ['item' => $item]) !!}

                    <div class="row">
                        <span class="title">
                            {{ __('shop::app.checkout.onepage.price') }}
                        </span>
                        <span class="value">
                            {{ core()->currency($item->base_price) }}
                        </span>
                    </div>

                    {!! view_render_event('bagisto.shop.checkout.price.after', ['item' => $item]) !!}
                    {!! view_render_event('bagisto.shop.checkout.quantity.before', ['item' => $item]) !!}

                    <div class="row">
                        <span class="title">
                            {{ __('shop::app.checkout.onepage.quantity') }}
                        </span>
                        <span class="value">
                            {{ $item->quantity }}
                        </span>
                    </div>

                    {!! view_render_event('bagisto.shop.checkout.quantity.after', ['item' => $item]) !!}
                    <!--                            GST Value-->
                             
    
                    @if ($item->gst_total_value)

                    @if($gstFlag>0)
                        <div class="row col-12">
                            <span class="col-8">{{ __('velocity::app.checkout.sgst_rate') }}</span>
                            <span class="col-4 text-right">{{ $item->gst_total_value/2 }}</span>
                        </div>
                    <div class="row col-12">
                            <span class="col-8">{{ __('velocity::app.checkout.cgst_rate') }}</span>
                            <span class="col-4 text-right">{{ $item->gst_total_value/2 }}</span>
                        </div>
                    @elseif ($gstFlag==0)
                        <div class="row col-12">
                            <span class="col-8">{{ __('velocity::app.checkout.igst_rate') }}</span>
                            <span class="col-4 text-right">{{ $item->gst_total_value }}</span>
                        </div>
                    @endif
                    
                    @endif
                    <!--    GST cost per item-->
                    @if ($item->gst_amount_per_item)
                    @if($gstFlag>0)
                        <div class="row col-12">
                            <span class="col-8">{{ __('velocity::app.checkout.sgst_per_item') }}</span>
                            <span class="col-4 text-right">{{ core()->currency($item->gst_amount_per_item/2) }}</span>
                        </div>
                    <div class="row col-12">
                            <span class="col-8">{{ __('velocity::app.checkout.cgst_per_item') }}</span>
                            <span class="col-4 text-right">{{ core()->currency($item->gst_amount_per_item/2) }}</span>
                        </div>
                    @elseif ($gstFlag==0)
                        <div class="row col-12">
                            <span class="col-8">{{ __('velocity::app.checkout.igst_per_item') }}</span>
                            <span class="col-4 text-right">{{ core()->currency($item->gst_amount_per_item) }}</span>
                        </div>
                    @endif
                    
                    @endif
                    <!--    GST total-->
                    @if ($item->gst_total_amount)
                    @if($gstFlag>0)
                        <div class="row col-12">
                            <span class="col-8">{{ __('velocity::app.checkout.sgst_total') }}</span>
                            <span class="col-4 text-right">{{ core()->currency($item->gst_total_amount/2) }}</span>
                        </div>
                    <div class="row col-12">
                            <span class="col-8">{{ __('velocity::app.checkout.cgst_total') }}</span>
                            <span class="col-4 text-right">{{ core()->currency($item->gst_total_amount/2) }}</span>
                        </div>
                    @elseif ($gstFlag==0)
                        <div class="row col-12">
                            <span class="col-8">{{ __('velocity::app.checkout.igst_total') }}</span>
                            <span class="col-4 text-right">{{ core()->currency($item->gst_total_amount) }}</span>
                        </div>
                    @endif
                    
                    @endif
    
                    <div class="row col-12">
                        <b>{{ core()->currency($item->base_total+$item->gst_total_amount) }}</b>
                    </div>

                    {!! view_render_event('bagisto.shop.checkout.options.before', ['item' => $item]) !!}

                    @if (isset($item->additional['attributes']))
                        <div class="item-options">

                            @foreach ($item->additional['attributes'] as $attribute)
                                <b>{{ $attribute['attribute_name'] }} : </b>{{ $attribute['option_label'] }}</br>
                            @endforeach

                        </div>
                    @endif

                    {!! view_render_event('bagisto.shop.checkout.options.after', ['item' => $item]) !!}
                </div>
            </div>
        @endforeach
    </div>

    <div class="order-description mt-20">
        <div class="pull-left" style="width: 60%; float: left;">
            @if ($cart->haveStockableItems())
                <div class="shipping">
                    <div class="decorator">
                        <i class="icon shipping-icon"></i>
                    </div>

                    <div class="text">
                        {{ core()->currency($cart->selected_shipping_rate->base_price) }}

                        <div class="info">
                            {{ $cart->selected_shipping_rate->method_title }}
                        </div>
                    </div>
                </div>
            @endif

            <div class="payment">
                <div class="decorator">
                    <i class="icon payment-icon"></i>
                </div>

                <div class="text">
                    {{ core()->getConfigData('sales.paymentmethods.' . $cart->payment->method . '.title') }}
                </div>
            </div>

        </div>

        <div class="pull-right" style="width: 40%; float: left;">
            <slot name="summary-section"></slot>
        </div>
    </div>
</div>