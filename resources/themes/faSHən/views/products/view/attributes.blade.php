@inject ('productViewHelper', 'Webkul\Product\Helpers\View')

{!! view_render_event('bagisto.shop.products.view.attributes.before', ['product' => $product]) !!}

@if ($customAttributeValues = $productViewHelper->getAdditionalData($product))


        <div slot="table-responsive">
            <table class="table table-bordered table-striped">
                <tbody>
                @foreach ($customAttributeValues as $attribute)
                    <tr>
                        @if ($attribute['label'])
                            <td><strong>{{ $attribute['label'] }}</strong></td>
                        @else
                            <td>{{ $attribute['admin_name'] }}</td>
                        @endif
                        @if ($attribute['type'] == 'file' && $attribute['value'])
                            <td>
                                <a  href="{{ route('shop.product.file.download', [$product->product_id, $attribute['id']])}}">
                                    <i class="icon sort-down-icon download"></i>
                                </a>
                            </td>
                        @elseif ($attribute['type'] == 'image' && $attribute['value'])
                            <td>
                                <a href="{{ route('shop.product.file.download', [$product->product_id, $attribute['id']])}}">
                                    <img src="{{ Storage::url($attribute['value']) }}" style="height: 20px; width: 20px;"/>
                                </a>
                            </td>
                        @else
                            <td>{{ $attribute['value'] }}</td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

@endif

{!! view_render_event('bagisto.shop.products.view.attributes.after', ['product' => $product]) !!}