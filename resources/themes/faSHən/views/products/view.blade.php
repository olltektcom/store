@extends('shop::layouts.master')

@section('page_title')
    {{ trim($product->meta_title) != "" ? $product->meta_title : $product->name }}
@stop

@section('seo')
    <meta name="description" content="{{ trim($product->meta_description) != "" ? $product->meta_description : \Illuminate\Support\Str::limit(strip_tags($product->description), 120, '') }}"/>
    <meta name="keywords" content="{{ $product->meta_keywords }}"/>
@stop


@section('content-wrapper')

    {!! view_render_event('bagisto.shop.products.view.before', ['product' => $product]) !!}


    <div class="block">
            <div class="container">
                <ul class="breadcrumbs">
                    <li><span>{{ $product->name }}</span></li>
                </ul>
            </div>
        </div>
    <div class="block product-block product-detail">
        
        <div class="container">
            <div class="row">
                <product-view>
                    <div class="form-container">
                        @csrf()

                        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                        <!-- Product Images -->
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            @include ('shop::products.view.gallery')
                        </div>
                        <!-- /Product Images -->
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="details product-info-block classic">
                                <div class="product-info-top">
                                    <div class="product-sku">SKU: <span>{{ $product->sku }}</span></div>
                                    @include ('shop::products.review', ['product' => $product])
                                </div>
                                <div class="product-name-wrapper">
                                    <h1 class="product-name">{{ $product->name }}</h1>
                                    <div class="product-labels">
                                        @if ($product->new)
                                            <span class="product-label sale">{{ __('shop::app.products.new') }}</span>
                                        @endif
                                        @if ($product->new)
                                            <span class="product-label new">{{ __('shop::app.products.sale') }}</span>
                                        @endif
                                    </div>
                                </div>
  
                                @include ('shop::products.view.stock', ['product' => $product])

                                {!! view_render_event('bagisto.shop.products.view.short_description.before', ['product' => $product]) !!}

                                <div class="product-description">
                                    {!! $product->short_description !!}
                                </div>

                                {!! view_render_event('bagisto.shop.products.view.short_description.after', ['product' => $product]) !!}

                                
                                <div class="product-options">
                                    <!-- options -->
                                    @include ('shop::products.view.configurable-options')

                                    @include ('shop::products.view.downloadable')

                                    @include ('shop::products.view.grouped-products')

                                    @include ('shop::products.view.bundle-options')
                                    <!-- /options -->
                                    <!-- Qty -->
                                    {!! view_render_event('bagisto.shop.products.view.quantity.before', ['product' => $product]) !!}
                                    @if ($product->getTypeInstance()->showQuantityBox())
                                        <quantity-changer></quantity-changer>
                                    @else
                                        <input type="hidden" name="quantity" value="1">
                                    @endif
                                    {!! view_render_event('bagisto.shop.products.view.quantity.after', ['product' => $product]) !!}
                                    <!-- /Qty -->
                                </div>
                                
                                
                                <div class="product-actions">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="product-meta">
                                                <span>@include ('shop::products.wishlist')</span>
                                                {!! view_render_event('bagisto.shop.layout.header.comppare-item.before') !!}
                                                <span>@include('shop::products.compare', ['productId' => $product->id])</span>
                                                {!! view_render_event('bagisto.shop.layout.header.comppare-item.after') !!}
                                            </div>
                                            <div class="social">
                                                <div class="share-button toLeft">
                                                    <span class="toggle">Share</span>
                                                    <ul class="social-list">
                                                        <li>
                                                            <a href="#" class="icon icon-google google"></a>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="icon icon-fancy fancy"></a>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="icon icon-pinterest pinterest"></a>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="icon icon-twitter-logo twitter"></a>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="icon icon-facebook-logo facebook"></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="price">
                                            @include ('shop::products.price', ['product' => $product])
                                            </div>
                                            <div class="actions">
                                                @include('shop::products.add-to-cart', ['product' => $product])
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </product-view>
            </div>
        </div>

        

        

    </div>

    <!-- Description,Specification -->
    <div class="block">
        <div class="tabaccordion">
            <div class="container">
                <!-- Nav tabs -->
                <ul class="nav-tabs product-tab" role="tablist">
                    <li><a href="#Tab1" role="tab" data-toggle="tab">{{ __('shop::app.products.description') }}</a></li>
                    <li><a href="#Tab2" role="tab" data-toggle="tab">{{ __('shop::app.products.specification') }}</a></li>
                    <li><a href="#Tab3" role="tab" data-toggle="tab">{{ __('shop::app.products.reviews-title') }}</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane" id="Tab1">
                        {!! view_render_event('bagisto.shop.products.view.description.before', ['product' => $product]) !!}
                        <p>{!! $product->description !!}</p>
                        {!! view_render_event('bagisto.shop.products.view.description.after', ['product' => $product]) !!}
                    </div>
                    <div role="tabpanel" class="tab-pane" id="Tab2">
                        <p>@include ('shop::products.view.attributes')</p>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="Tab3">
                        <p>@include ('shop::products.view.reviews')</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Description,Specification -->
    <div class="products-grid four-in-row product-variant-5">
        @include ('shop::products.view.related-products')
    </div>

    <div class="products-grid four-in-row product-variant-5">
        @include ('shop::products.view.up-sells')
    </div>


    {!! view_render_event('bagisto.shop.products.view.after', ['product' => $product]) !!}
@endsection

@push('scripts')

    <script type="text/x-template" id="product-view-template">
        <form method="POST" id="product-form" action="{{ route('cart.add', $product->product_id) }}" @click="onSubmit($event)">

            <input type="hidden" name="is_buy_now" v-model="is_buy_now">

            <slot></slot>

        </form>
    </script>

    <script type="text/x-template" id="quantity-changer-template">
    <div class="quantity control-group" :class="[errors.has(controlName) ? 'has-error' : '']">
            <label class="required">{{ __('shop::app.products.quantity') }}</label>

            <button type="button" class="decrease" @click="decreaseQty()">-</button>

            <input :name="controlName" class="control"  :value="qty" :v-validate="validations" data-vv-as="&quot;{{ __('shop::app.products.quantity') }}&quot;" readonly>

            <button type="button" class="increase" @click="increaseQty()">+</button>

            <span class="control-error" v-if="errors.has(controlName)">@{{ errors.first(controlName) }}</span>
        </div>
        
    </script>

    <script>

        Vue.component('product-view', {

            template: '#product-view-template',

            inject: ['$validator'],

            data: function() {
                return {
                    is_buy_now: 0,
                }
            },

            methods: {
                onSubmit: function(e) {
                    if (e.target.getAttribute('type') != 'submit')
                        return;
                    e.preventDefault();

                    var this_this = this;
                    
                    this.$validator.validateAll().then(function (result) {
                        if (result) {
                            this_this.is_buy_now = e.target.classList.contains('buynow') ? 1 : 0;

                            setTimeout(function() {
                                document.getElementById('product-form').submit();
                            }, 0);
                        }
                    });
                }
            }
        });

        Vue.component('quantity-changer', {
            template: '#quantity-changer-template',

            inject: ['$validator'],

            props: {
                controlName: {
                    type: String,
                    default: 'quantity'
                },

                quantity: {
                    type: [Number, String],
                    default: 1
                },

                minQuantity: {
                    type: [Number, String],
                    default: 1
                },

                validations: {
                    type: String,
                    default: 'required|numeric|min_value:1'
                }
            },

            data: function() {
                return {
                    qty: this.quantity
                }
            },

            watch: {
                quantity: function (val) {
                    this.qty = val;

                    this.$emit('onQtyUpdated', this.qty)
                }
            },
            methods: {
                decreaseQty: function() {
                    if (this.qty > this.minQuantity)
                        this.qty = parseInt(this.qty) - 1;

                    this.$emit('onQtyUpdated', this.qty)
                },

                increaseQty: function() {
                    this.qty = parseInt(this.qty) + 1;

                    this.$emit('onQtyUpdated', this.qty)
                }
            }
        });

        /*$(document).ready(function() {
            var addTOButton = document.getElementsByClassName('add-to-buttons')[0];
            document.getElementById('loader').style.display="none";
            addTOButton.style.display="flex";
        });*/

        window.onload = function() {
            var thumbList = document.getElementsByClassName('thumb-list')[0];
            var thumbFrame = document.getElementsByClassName('thumb-frame');
            var productHeroImage = document.getElementsByClassName('product-hero-image')[0];

            if (thumbList && productHeroImage) {

                for(let i=0; i < thumbFrame.length ; i++) {
                    thumbFrame[i].style.height = (productHeroImage.offsetHeight/4) + "px";
                    thumbFrame[i].style.width = (productHeroImage.offsetHeight/4)+ "px";
                }

                if (screen.width > 720) {
                    thumbList.style.width = (productHeroImage.offsetHeight/4) + "px";
                    thumbList.style.minWidth = (productHeroImage.offsetHeight/4) + "px";
                    thumbList.style.height = productHeroImage.offsetHeight + "px";
                }
            }

            window.onresize = function() {
                if (thumbList && productHeroImage) {

                    for(let i=0; i < thumbFrame.length; i++) {
                        thumbFrame[i].style.height = (productHeroImage.offsetHeight/4) + "px";
                        thumbFrame[i].style.width = (productHeroImage.offsetHeight/4)+ "px";
                    }

                    if (screen.width > 720) {
                        thumbList.style.width = (productHeroImage.offsetHeight/4) + "px";
                        thumbList.style.minWidth = (productHeroImage.offsetHeight/4) + "px";
                        thumbList.style.height = productHeroImage.offsetHeight + "px";
                    }
                }
            }
        };
    </script>
@endpush