@component('shop::emails.layouts.master')
    <div style="text-align: center;">
        <a href="{{ config('app.url') }}">
            @include ('shop::emails.layouts.logo')
        </a>
    </div>

    <div style="padding: 30px;">
        
        <div style="font-size: 20px;color: #242424;line-height: 30px;margin-bottom: 34px;">
            <span style="font-weight: bold;">
            {{ __('shop::app.mail.order.heading') }}
            </span> <br>

            <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                {{ __('shop::app.mail.order.dear', ['customer_name' => $order->customer_full_name]) }},
            </p>

            <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                {!! __('shop::app.mail.order.greeting', [
                    'order_id' => '<a href="' . route('customer.orders.view', $order->id) . '" style="color: #0041FF; font-weight: bold;">#' . $order->increment_id . '</a>',
                    'created_at' => $order->created_at
                    ])
                !!}
            </p>
        </div>

        <div style="font-weight: bold;font-size: 20px;color: #242424;line-height: 30px;margin-bottom: 20px !important;">
            {{ __('shop::app.mail.order.summary') }}
        </div>

        <div style="display: flex;flex-direction: row;margin-top: 20px;justify-content: space-between;margin-bottom: 40px;">
            @if ($order->shipping_address)
                <div style="line-height: 25px;">
                    <div style="font-weight: bold;font-size: 16px;color: #242424;">
                        {{ __('shop::app.mail.order.shipping-address') }}
                    </div>

                    <div>
                        {{ $order->shipping_address->name }}
                    </div>

                    <div>
                        {{ $order->shipping_address->address1 }}, {{ $order->shipping_address->state }}
                    </div>

                    <div>
                        {{ core()->country_name($order->shipping_address->country) }} {{ $order->shipping_address->postcode }}
                    </div>

                    <div>---</div>

                    <div style="margin-bottom: 40px;">
                        {{ __('shop::app.mail.order.contact') }} : {{ $order->shipping_address->phone }}
                    </div>

                    <div style="font-size: 16px;color: #242424;">
                        {{ __('shop::app.mail.order.shipping') }}
                    </div>

                    <div style="font-weight: bold;font-size: 16px;color: #242424;">
                        {{ $order->shipping_title }}
                    </div>
                </div>
            @endif

            <div style="line-height: 25px;">
                <div style="font-weight: bold;font-size: 16px;color: #242424;">
                    {{ __('shop::app.mail.order.billing-address') }}
                </div>

                <div>
                    {{ $order->billing_address->name }}
                </div>

                <div>
                    {{ $order->billing_address->address1 }}, {{ $order->billing_address->state }}
                </div>

                <div>
                    {{ core()->country_name($order->billing_address->country) }} {{ $order->billing_address->postcode }}
                </div>

                <div>---</div>

                <div style="margin-bottom: 40px;">
                    {{ __('shop::app.mail.order.contact') }} : {{ $order->billing_address->phone }}
                </div>

                <div style="font-size: 16px; color: #242424;">
                    {{ __('shop::app.mail.order.payment') }}
                </div>

                <div style="font-weight: bold;font-size: 16px; color: #242424;">
                    {{ core()->getConfigData('sales.paymentmethods.' . $order->payment->method . '.title') }}
                </div>
            </div>
        </div>

        <div class="section-content">
            <div class="table mb-20">
                <table style="overflow-x: auto; border-collapse: collapse;
                border-spacing: 0;width: 100%">
                    <thead>
                        @php   $originState=Core::getConfigData('sales.shipping.origin.state');$shipping_state=$order->shipping_address->state; @endphp
                        <tr style="background-color: #f2f2f2">
                            <th style="text-align: left;padding: 8px">{{ __('shop::app.customer.account.order.view.SKU') }}</th>
                            <th style="text-align: left;padding: 8px">{{ __('shop::app.customer.account.order.view.product-name') }}</th>
                            <th style="text-align: left;padding: 8px">{{ __('shop::app.customer.account.order.view.price') }}</th>
                            <th style="text-align: left;padding: 8px">{{ __('shop::app.customer.account.order.view.qty') }}</th>
                            @php
                            if($shipping_state==$originState){
                            @endphp
                            <th style="text-align: left;padding: 8px">{{ __('velocity::app.checkout.sgst_rate') }}</th>
                            <th style="text-align: left;padding: 8px">{{ __('velocity::app.checkout.cgst_rate') }}</th>
                            @php
                            }else {
                             @endphp
                            <th style="text-align: left;padding: 8px">{{ __('velocity::app.checkout.igst_rate') }}</th>
                           
                            @php
                            }
                            @endphp
                            
                            
                            @php
                            if($shipping_state==$originState){
                            @endphp
                            <th style="text-align: left;padding: 8px">{{ __('velocity::app.checkout.sgst_per_item') }}</th>
                            <th style="text-align: left;padding: 8px">{{ __('velocity::app.checkout.cgst_per_item') }}</th>
                            @php
                            }else {
                            @endphp
                            <th style="text-align: left;padding: 8px">{{ __('velocity::app.checkout.igst_per_item') }}</th>
                            
                            @php
                            }
                            @endphp
                            
                            @php
                            if($shipping_state==$originState){
                            @endphp
                            <th style="text-align: left;padding: 8px">{{ __('velocity::app.checkout.sgst_total') }}</th>
                            <th style="text-align: left;padding: 8px">{{ __('velocity::app.checkout.cgst_total') }}</th>
                            @php
                            }else {
                            @endphp
                            <th style="text-align: left;padding: 8px">{{ __('velocity::app.checkout.igst_total') }}</th>
                            
                            @php
                            }
                            @endphp
                            
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($order->items as $item)
                            <tr>
                                <td data-value="{{ __('shop::app.customer.account.order.view.SKU') }}" style="text-align: left;padding: 8px">{{ $item->getTypeInstance()->getOrderedItem($item)->sku }}</td>

                                <td data-value="{{ __('shop::app.customer.account.order.view.product-name') }}" style="text-align: left;padding: 8px">
                                    {{ $item->name }}

                                    @if (isset($item->additional['attributes']))
                                        <div class="item-options">

                                            @foreach ($item->additional['attributes'] as $attribute)
                                                <b>{{ $attribute['attribute_name'] }} : </b>{{ $attribute['option_label'] }}</br>
                                            @endforeach

                                        </div>
                                    @endif
                                </td>

                                <td data-value="{{ __('shop::app.customer.account.order.view.price') }}" style="text-align: left;padding: 8px">{{ core()->formatPrice($item->price, $order->order_currency_code) }}
                                </td>

                                <td data-value="{{ __('shop::app.customer.account.order.view.qty') }}" style="text-align: left;padding: 8px">{{ $item->qty_ordered }}</td>
                                                              @php
                            if($shipping_state==$originState){
                            @endphp
                            <td class="">{{ $item->gst_value/2 }}%</td>
                            <td class="">{{ $item->gst_value/2 }}%</td>
                            @php
                            }else {
                            @endphp
                            <td class="">{{ $item->gst_value }}%</td>
                            
                            @php
                            }
                            @endphp
                                
                            @php
                            if($shipping_state==$originState){
                            @endphp
                            <td class="">{{ core()->currency($item->gst_amount_per_item/2) }}</td>
                            <td class="">{{ core()->currency($item->gst_amount_per_item/2) }}</td>
                            @php
                            }else {
                            @endphp
                            <td class="">{{ core()->currency($item->gst_amount_per_item) }}</td>
                            
                            @php
                            }
                            @endphp
                            
                            @php
                            if($shipping_state==$originState){
                            @endphp
                            <td class="">{{ core()->currency($item->gst_total_amount/2) }}</td>
                            <td class="">{{ core()->currency($item->gst_total_amount/2) }}</td>
                            @php
                            }else {
                            @endphp
                            <td class="">{{ core()->currency($item->gst_total_amount) }}</td>
                            
                            @php
                            }
                            @endphp
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div style="font-size: 16px;color: #242424;line-height: 30px;float: right;width: 40%;margin-top: 20px;">
            <div>
                <span>{{ __('shop::app.mail.order.subtotal') }}</span>
                <span style="float: right;">
                    {{ core()->currency($order->sub_total) }}
                </span>
            </div>
            @php
                            if($shipping_state==$originState){
                            @endphp
                            <div>
                <span>{{ __('velocity::app.checkout.sgst') }}</span>
                <span style="float: right;">
                    {{ core()->currency($order->gst_total_amount/2) }}
                </span>
            </div>
                             <div>
                <span>{{ __('velocity::app.checkout.cgst') }}</span>
                <span style="float: right;">
                    {{ core()->currency($order->gst_total_amount/2) }}
                </span>
            </div>
                            
                            @php
                            }else {
                            @endphp
                             <div>
                <span>{{ __('velocity::app.checkout.igst') }}</span>
                <span style="float: right;">
                    {{ core()->currency($order->gst_total_amount) }}
                </span>
            </div>
                            
                            @php
                            }
                            @endphp
            @if ($order->shipping_address)
                <div>
                    <span>{{ __('shop::app.mail.order.shipping-handling') }}</span>
                    <span style="float: right;">
                        {{ core()->formatPrice($order->shipping_amount, $order->order_currency_code) }}
                    </span>
                </div>
            @endif

            @foreach (Webkul\Tax\Helpers\Tax::getTaxRatesWithAmount($order, false) as $taxRate => $taxAmount )
            @if($taxAmount>0)
            <div>
                <span id="taxrate-{{ core()->taxRateAsIdentifier($taxRate) }}">{{ __('shop::app.mail.order.tax') }} {{ $taxRate }} %</span>
                <span id="taxamount-{{ core()->taxRateAsIdentifier($taxRate) }}" style="float: right;">
                    {{ core()->formatPrice($taxAmount, $order->order_currency_code) }}
                </span>
            </div>
            @endif
            @endforeach

            @if ($order->discount_amount > 0)
                <div>
                    <span>{{ __('shop::app.mail.order.discount') }}</span>
                    <span style="float: right;">
                        {{ core()->formatPrice($order->discount_amount, $order->order_currency_code) }}
                    </span>
                </div>
            @endif
            
            <div style="font-weight: bold">
                <span>{{ __('shop::app.mail.order.grand-total') }}</span>
                <span style="float: right;">
                    {{ core()->formatPrice($order->grand_total+$order->gst_total_amount, $order->order_currency_code) }}
                </span>
            </div>
        </div>

        <div style="margin-top: 65px;font-size: 16px;color: #5E5E5E;line-height: 24px;display: inline-block">
            <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                {{ __('shop::app.mail.order.final-summary') }}
            </p>

            <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                {!!
                    __('shop::app.mail.order.help', [
                        'support_email' => '<a style="color:#0041FF" href="mailto:' . config('mail.from.address') . '">' . config('mail.from.address'). '</a>'
                        ])
                !!}
            </p>

            <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                {{ __('shop::app.mail.order.thanks') }}
            </p>
        </div>
    </div>
@endcomponent
