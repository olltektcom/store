
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="Cache-control" content="no-cache">

        <style type="text/css">
            body, th, td, h5 {
                font-size: 12px;
                color: #000;
            }

            .container {
                padding: 20px;
                display: block;
            }

            .invoice-summary {
                margin-bottom: 20px;
            }

            .table {
                margin-top: 20px;
            }

            .table table {
                width: 100%;
                border-collapse: collapse;
                text-align: left;
                table-layout: fixed;
            }

            .table thead th {
                font-weight: 700;
                border-top: solid 1px #d3d3d3;
                border-bottom: solid 1px #d3d3d3;
                border-left: solid 1px #d3d3d3;
                padding: 5px 10px;
                background: #F4F4F4;
            }

            .table thead th:last-child {
                border-right: solid 1px #d3d3d3;
            }

            .table tbody td {
                padding: 5px 10px;
                border-bottom: solid 1px #d3d3d3;
                border-left: solid 1px #d3d3d3;
                color: #3A3A3A;
                vertical-align: middle;
                font-family: DejaVu Sans; sans-serif;
            }

            .table tbody td p {
                margin: 0;
            }

            .table tbody td:last-child {
                border-right: solid 1px #d3d3d3;
            }

           .sale-summary {
                margin-top: 40px;
                float: right;
            }

            .sale-summary tr td {
                padding: 3px 5px;
                font-family: DejaVu Sans; sans-serif;
            }

            .sale-summary tr.bold {
                font-family: DejaVu Sans; sans-serif;
                font-weight: 700;
            }

            .label {
                color: #000;
                font-weight: 600;
            }

            .logo {
                height: 70px;
                width: 70px;
            }

        </style>
    </head>

    <body style="background-image: none;background-color: #fff;">
        <div class="container">

            <div class="header">
                @if (core()->getConfigData('sales.orderSettings.invoice_slip_design.logo'))
                    <div class="image">
                        <img class="logo" src="{{ Storage::url(core()->getConfigData('sales.orderSettings.invoice_slip_design.logo')) }}"/>
                    </div>
                @endif
                
                <div class="address">
                    <p>
                      <b>{{ core()->getConfigData('sales.orderSettings.invoice_slip_design.address') }} </b>
                    </p>
                </div>
            </div>

            <div class="invoice-summary">

                <div class="row">
                    <span class="label">{{ __('shop::app.customer.account.order.view.invoice-id') }} -</span>
                    <span class="value">{{ $invoice->id }}</span>
                </div>

                <div class="row">
                    <span class="label">{{ __('shop::app.customer.account.order.view.order-id') }} -</span>
                    <span class="value">{{ $invoice->order->increment_id }}</span>
                </div>

                <div class="row">
                    <span class="label">{{ __('shop::app.customer.account.order.view.order-date') }} -</span>
                    <span class="value">{{ core()->formatDate($invoice->order->created_at, 'M d, Y') }}</span>
                </div>

                <div class="table address">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 50%">{{ __('shop::app.customer.account.order.view.bill-to') }}</th>
                                @if ($invoice->order->shipping_address)
                                    <th>{{ __('shop::app.customer.account.order.view.ship-to') }}</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    <p>{{ $invoice->order->billing_address->name }}</p>
                                    <p>{{ $invoice->order->billing_address->address1 }}</p>
                                    <p>{{ $invoice->order->billing_address->city }}</p>
                                    <p>{{ $invoice->order->billing_address->state }}</p>
                                    <p>
                                        {{ core()->country_name($invoice->order->billing_address->country) }}
                                        {{ $invoice->order->billing_address->postcode }}
                                    </p>
                                    {{ __('shop::app.customer.account.order.view.contact') }} : {{ $invoice->order->billing_address->phone }}
                                </td>
                                @php   $originState=Core::getConfigData('sales.shipping.origin.state');$shipping_state=$invoice->order->shipping_address->state; @endphp
                                @if ($invoice->order->shipping_address)
                                    <td>
                                        <p>{{ $invoice->order->shipping_address->name }}</p>
                                        <p>{{ $invoice->order->shipping_address->address1 }}</p>
                                        <p>{{ $invoice->order->shipping_address->city }}</p>
                                        <p>{{ $invoice->order->shipping_address->state }}</p>
                                        <p>{{ core()->country_name($invoice->order->shipping_address->country) }} {{ $invoice->order->shipping_address->postcode }}</p>
                                        {{ __('shop::app.customer.account.order.view.contact') }} : {{ $invoice->order->shipping_address->phone }}
                                    </td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table payment-shipment">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 50%">{{ __('shop::app.customer.account.order.view.payment-method') }}</th>

                                @if ($invoice->order->shipping_address)
                                    <th>{{ __('shop::app.customer.account.order.view.shipping-method') }}</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    {{ core()->getConfigData('sales.paymentmethods.' . $invoice->order->payment->method . '.title') }}
                                </td>

                                @if ($invoice->order->shipping_address)
                                    <td>
                                        {{ $invoice->order->shipping_title }}
                                    </td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table items">
                    <table>
                        <thead>
                            <tr>
                                <th>{{ __('shop::app.customer.account.order.view.SKU') }}</th>
                                <th>{{ __('shop::app.customer.account.order.view.product-name') }}</th>
                                <th>{{ __('shop::app.customer.account.order.view.price') }}</th>
                                <th>{{ __('shop::app.customer.account.order.view.qty') }}</th>
                                <th>{{ __('shop::app.customer.account.order.view.subtotal') }}</th>
<!--                                <th>{{ __('shop::app.customer.account.order.view.tax-amount') }}</th>-->
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
                                <th>{{ __('shop::app.customer.account.order.view.grand-total') }}</th>
                                
                            </tr>
                        </thead>

                        <tbody>

                             @php $nivoiceGrandTotal=0; @endphp
                                    @foreach ($invoice->items as $item)
                                    @php $nivoiceGrandTotal=$nivoiceGrandTotal+ $item->gst_total_amount ; @endphp
                                <tr>
                                    <td>{{ $item->child ? $item->child->sku : $item->sku }}</td>

                                    <td>
                                        {{ $item->name }}

                                        @if (isset($item->additional['attributes']))
                                            <div class="item-options">

                                                @foreach ($item->additional['attributes'] as $attribute)
                                                    <b>{{ $attribute['attribute_name'] }} : </b>{{ $attribute['option_label'] }}</br>
                                                @endforeach

                                            </div>
                                        @endif
                                    </td>

                                    <td>{{ core()->formatPrice($item->price, $invoice->order->order_currency_code) }}</td>

                                    <td>{{ $item->qty }}</td>

                                    <td>{{ core()->formatPrice($item->total, $invoice->order->order_currency_code) }}</td>
                                    
                                    @if($item->tax_amount>0) <td>{{ core()->formatPrice($item->tax_amount, $invoice->order->order_currency_code) }}</td> @endif
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
                                    <td>{{ core()->formatPrice(($item->gst_total_amount+$item->total + $item->tax_amount), $invoice->order->order_currency_code) }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>


                <table class="sale-summary">
                    <tr>
                        <td>{{ __('shop::app.customer.account.order.view.subtotal') }}</td>
                        <td>-</td>
                        <td>{{ core()->formatPrice($invoice->sub_total, $invoice->order->order_currency_code) }}</td>
                    </tr>

                    <tr>
                        <td>{{ __('shop::app.customer.account.order.view.shipping-handling') }}</td>
                        <td>-</td>
                        <td>{{ core()->formatPrice($invoice->shipping_amount, $invoice->order->order_currency_code) }}</td>
                    </tr>
                    @php
                                              if($shipping_state==$originState){
                                                @endphp
                                                <tr>
                                                    <td>{{ __('velocity::app.checkout.sgst') }}
                                                    
                                                    </td>
                                                    <td>-</td>
                                                    <td>
                                                        {{ core()->currency($nivoiceGrandTotal/2) }}
                                                    </td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>{{ __('velocity::app.checkout.cgst') }}
                                                    
                                                    </td>
                                                    <td>-</td>
                                                    <td>
                                                        {{ core()->currency($nivoiceGrandTotal/2) }}
                                                    </td>
                                                </tr>
                                                @php
                                              }
                                              else
                                              {
                                                @endphp
                                                <tr>
                                                    <td>{{ __('velocity::app.checkout.igst') }}
                                                    
                                                    </td>
                                                    <td>-</td>
                                                    <td>
                                                        {{ core()->currency($nivoiceGrandTotal) }}
                                                    </td>
                                                </tr>
                                                @php
                                              }
                                            @endphp
                    @if ($invoice->base_discount_amount > 0)
                        <tr>
                            <td>{{ __('shop::app.customer.account.order.view.discount') }}</td>
                            <td>-</td>
                            <td>{{ core()->formatPrice($invoice->discount_amount, $invoice->order_currency_code) }}</td>
                        </tr>
                    @endif
                    @if($invoice->tax_amount>0)
                    <tr>
                        <td>{{ __('shop::app.customer.account.order.view.tax') }}</td>
                        <td>-</td>
                        <td>{{ core()->formatPrice($invoice->tax_amount, $invoice->order->order_currency_code) }}</td>
                    </tr>
                    @endif
                    <tr class="bold">
                        <td>{{ __('shop::app.customer.account.order.view.grand-total') }}</td>
                        <td>-</td>
                        <td>{{ core()->formatPrice($invoice->grand_total+$nivoiceGrandTotal, $invoice->order->order_currency_code) }}</td>
                    </tr>
                </table>

            </div>

        </div>
    </body>
</html>
