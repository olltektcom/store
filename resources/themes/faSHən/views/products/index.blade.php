@extends('shop::layouts.master')

@section('page_title')
    {{ trim($category->meta_title) != "" ? $category->meta_title : $category->name }}
@stop

@section('seo')
    <meta name="description" content="{{ trim($category->meta_description) != "" ? $category->meta_description : \Illuminate\Support\Str::limit(strip_tags($category->description), 120, '') }}"/>
    <meta name="keywords" content="{{ $category->meta_keywords }}"/>
@stop

@section('content-wrapper')
    @inject ('productRepository', 'Webkul\Product\Repositories\ProductRepository')

    <div class="container">
        {!! view_render_event('bagisto.shop.products.index.before', ['category' => $category]) !!}
        <!-- Two columns -->
        <div class="row row-table">

            <!-- Left column -->
			<div class="col-md-3 filter-col fixed aside">
                <div class="filter-container">
                    <div class="fstart"></div>
                    @if (in_array($category->display_mode, [null, 'products_only', 'products_and_description']))
                        @include ('shop::products.list.layered-navigation')
                    @endif
                    <div class="fend"></div>
                </div>
            </div>
            <!-- /Left column -->
            <!-- @if ($category->display_mode == 'description_only') style="width: 100%" @endif -->
            <div class="col-md-9 aside">
                <!-- Category Title -->
                <div class="page-title">
                    <div class="title center">
                        <h1>{!! $category->name !!}</h1>
                    </div>
                </div>
                <!-- /Category Title -->
                <!-- Banners -->
                @if (!is_null($category->image))
                <div class="row">
                    <div class="col-sm-12">
                        <div class="banner style-9 autosize-text image-hover-scale" data-fontratio="6.4">
                            <img src="{{ $category->image_url }}" alt="{{ $category->name }}">
                            <div class="banner-caption vertb">
                                <div class="vert-wrapper">
                                    <div class="vert">
                                        <div class="text-1 text-hoverslide" data-hcolor="#ffffff">
                                            <span><span class="text">{{ $category->name }}</span><span class="hoverbg"></span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <!-- /Banners -->
                <!-- Categories Info -->
                @if (!empty($category->description))
                <div class="info-block">
                    {!! $category->description !!}
                </div>
                @endif
                <!-- Categories Info -->


                @if (in_array($category->display_mode, [null, 'products_only', 'products_and_description']))
                    <?php $products = $productRepository->getAll($category->id); ?>

                    @if ($products->count())

                        @include ('shop::products.list.toolbar')

                        @inject ('toolbarHelper', 'Webkul\Product\Helpers\Toolbar')


                        @if ($toolbarHelper->getCurrentMode() == 'grid')
                            <div class="products-grid three-in-row product-variant-5">
                                @foreach ($products as $productFlat)

                                    @include ('shop::products.list.card', ['product' => $productFlat])

                                @endforeach
                            </div>
                        @else
                            <div class="products-listview three-in-row product-variant-5">
                                @foreach ($products as $productFlat)

                                    @include ('shop::products.list.card', ['product' => $productFlat])

                                @endforeach
                            </div>
                        @endif

                        {!! view_render_event('bagisto.shop.products.index.pagination.before', ['category' => $category]) !!}

                        @include ('shop::products.list.toolbar')

                        @inject ('toolbarHelper', 'Webkul\Product\Helpers\Toolbar')

                        {!! view_render_event('bagisto.shop.products.index.pagination.after', ['category' => $category]) !!}

                    @else

                        <div class="product-list empty">
                            <h2>{{ __('shop::app.products.whoops') }}</h2>

                            <p>
                                {{ __('shop::app.products.empty') }}
                            </p>
                        </div>

                    @endif
                @endif
            </div>
        </div>
        <div class="ymax"></div>
        <!-- /Two columns -->

        {!! view_render_event('bagisto.shop.products.index.after', ['category' => $category]) !!}
    </div>
@stop

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.responsive-layred-filter').css('display','none');
            $(".sort-icon, .filter-icon").on('click', function(e){
                var currentElement = $(e.currentTarget);
                if (currentElement.hasClass('sort-icon')) {
                    currentElement.removeClass('sort-icon');
                    currentElement.addClass('icon-menu-close-adj');
                    currentElement.next().removeClass();
                    currentElement.next().addClass('icon filter-icon');
                    $('.responsive-layred-filter').css('display','none');
                    $('.pager').css('display','flex');
                    $('.pager').css('justify-content','space-between');
                } else if (currentElement.hasClass('filter-icon')) {
                    currentElement.removeClass('filter-icon');
                    currentElement.addClass('icon-menu-close-adj');
                    currentElement.prev().removeClass();
                    currentElement.prev().addClass('icon sort-icon');
                    $('.pager').css('display','none');
                    $('.responsive-layred-filter').css('display','block');
                    $('.responsive-layred-filter').css('margin-top','10px');
                } else {
                    currentElement.removeClass('icon-menu-close-adj');
                    $('.responsive-layred-filter').css('display','none');
                    $('.pager').css('display','none');
                    if ($(this).index() == 0) {
                        currentElement.addClass('sort-icon');
                    } else {
                        currentElement.addClass('filter-icon');
                    }
                }
            });
        });
    </script>
@endpush