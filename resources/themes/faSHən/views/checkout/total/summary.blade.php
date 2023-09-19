<div class="order-summary">
    <h3>{{ __('shop::app.checkout.total.order-summary') }}</h3>

    <div class="item-detail">
        <label>
            {{ intval($cart->items_qty) }}
            {{ __('shop::app.checkout.total.sub-total') }}
            {{ __('shop::app.checkout.total.price') }}
        </label>
        <label class="right">{{ core()->currency($cart->base_sub_total) }}</label>
    </div>

    @if ($cart->selected_shipping_rate)
        <div class="item-detail">
            <label>{{ __('shop::app.checkout.total.delivery-charges') }}</label>
            <label class="right">{{ core()->currency($cart->selected_shipping_rate->base_price) }}</label>
        </div>
    @endif

    @if ($cart->gst_total_amout)
    
    @if($gstFlag>0)
        <div class="item-detail">
            <label>{{ __('velocity::app.checkout.sgst') }}</label>
            <label class="right">{{ core()->currency($cart->gst_total_amout/2) }}</label>
        </div>
    <div class="item-detail">
            <label>{{ __('velocity::app.checkout.cgst') }}</label>
            <label class="right">{{ core()->currency($cart->gst_total_amout/2) }}</label>
        </div>
    @elseif ($gstFlag==0)
        <div class="item-detail">
            <label>{{ __('velocity::app.checkout.igst') }}</label>
            <label class="right">{{ core()->currency($cart->gst_total_amout) }}</label>
        </div>
    @endif
    
    @endif

    @if ($cart->base_tax_total>0  && !$cart->gst_total_amout)
        @foreach (Webkul\Tax\Helpers\Tax::getTaxRatesWithAmount($cart, true) as $taxRate => $baseTaxAmount )
        <div class="item-detail">
            <label id="taxrate-{{ core()->taxRateAsIdentifier($taxRate) }}">{{ __('shop::app.checkout.total.tax') }} {{ $taxRate }} %</label>
            <label class="right" id="basetaxamount-{{ core()->taxRateAsIdentifier($taxRate) }}">{{ core()->currency($baseTaxAmount) }}</label>
        </div>
        @endforeach
    @endif

    @if (
        $cart->base_discount_amount
        && $cart->base_discount_amount > 0
    )
        <div
            id="discount-detail"
            class="item-detail">

            <span class="col-8">{{ __('shop::app.checkout.total.disc-amount') }}</span>
            <span class="col-4 text-right">
                -{{ core()->currency($cart->base_discount_amount) }}
            </span>
        </div>
    @endif


    <div class="payable-amount" id="grand-total-detail">
        <label>{{ __('shop::app.checkout.total.grand-total') }}</label>
        <label class="right" id="grand-total-amount-detail">
            {{ core()->currency($cart->base_grand_total+$cart->gst_total_amout) }}
        </label>
    </div>

</div>