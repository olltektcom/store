@inject ('attributeRepository', 'Webkul\Attribute\Repositories\AttributeRepository')

@inject ('productFlatRepository', 'Webkul\Product\Repositories\ProductFlatRepository')

@inject ('productRepository', 'Webkul\Product\Repositories\ProductRepository')

<?php
    $filterAttributes = $attributes = [];
    $maxPrice = 0;

    if (isset($category)) {
        $filterAttributes = $productFlatRepository->getProductsRelatedFilterableAttributes($category);

        $maxPrice = core()->convertPrice($productFlatRepository->getCategoryProductMaximumPrice($category));
    }

    if (! count($filterAttributes) > 0) {
        $filterAttributes = $attributeRepository->getFilterAttributes();
    }

    foreach ($filterAttributes as $attribute) {
        if ($attribute->code <> 'price') {
            if (! $attribute->options->isEmpty()) {
                $attributes[] = $attribute;
            }
        } else {
            $attributes[] = $attribute;
        }
    }

    $filterAttributes = collect($attributes);
?>

<div class="fixed-wrapper">
    <div class="fixed-scroll">
        <div class="filter-col-header">
            <div class="title">Filters</div>
            <a href="#" class="filter-col-toggle"></a>
        </div>
        {!! view_render_event('bagisto.shop.products.list.layered-nagigation.before') !!}
            <layered-navigation></layered-navigation>

        {!! view_render_event('bagisto.shop.products.list.layered-nagigation.after') !!}
    </div>
</div>

@push('scripts')
    <script type="text/x-template" id="layered-navigation-template">
        <div class="filter-col-content">
            <div class="sidebar-block-top">
                <h2>{{ __('shop::app.products.layered-nav-title') }}</h2>
            </div>

            <filter-attribute-item v-for='(attribute, index) in attributes' :attribute="attribute" :key="index" :index="index" @onFilterAdded="addFilters(attribute.code, $event)" :appliedFilterValues="appliedFilters[attribute.code]">
            </filter-attribute-item>
        </div>
    </script>

    <script type="text/x-template" id="filter-attribute-item-template">
        <div class="sidebar-block collapsed" :class="[active ? 'open openSelected' : '']">

            <div class="block-title">
                @{{ attribute.name ? attribute.name : attribute.admin_name }}

                <span class="remove-filter-link" v-if="appliedFilters.length" @click.stop="clearFilters()">
                    {{ __('shop::app.products.remove-filter-link-title') }}
                </span>

                <div class="toggle-arrow"></div>
            </div>

            <div class="block-content">

                <ul class="category-list" v-if="attribute.type != 'price'">
                    <li class="item" v-for='(option, index) in attribute.options'>

                        <span class="checkbox">
                            <input type="checkbox" :id="option.id" v-bind:value="option.id" v-model="appliedFilters" @change="addFilter($event)"/>
                            <label class="checkbox-view" :for="option.id"></label>
                            @{{ option.label ? option.label : option.admin_name }}
                        </span>

                    </li>
                </ul>

                <div class="price-range-wrapper" v-if="attribute.type == 'price'">

                    <div class="price-values">
                        <div class="pull-left">$<span id="price_from" v-html="sliderConfig.priceFrom"></span></div>
                        <div class="pull-right">$<span id="price_to" v-html="sliderConfig.priceTo"></span></div>
                    </div>
                    <vue-slider
                        ref="slider"
                        v-model="sliderConfig.value"
                        :process-style="sliderConfig.processStyle"
                        :tooltip-style="sliderConfig.tooltipStyle"
                        :max="sliderConfig.max"
                        :lazy="true"
                        @change="priceRangeUpdated($event)"
                    ></vue-slider>
                </div>

            </div>

        </div>
    </script>

    <script>
        Vue.component('layered-navigation', {

            template: '#layered-navigation-template',

            data: function() {
                return {
                    attributes: @json($filterAttributes),

                    appliedFilters: {}
                }
            },

            created: function () {
                var urlParams = new URLSearchParams(window.location.search);

                var this_this = this;

                urlParams.forEach(function (value, index) {
                    this_this.appliedFilters[index] = value.split(',');
                });
            },

            methods: {
                addFilters: function (attributeCode, filters) {
                    if (filters.length) {
                        this.appliedFilters[attributeCode] = filters;
                    } else {
                        delete this.appliedFilters[attributeCode];
                    }

                    this.applyFilter()
                },

                applyFilter: function () {
                    var params = [];

                    for(key in this.appliedFilters) {
                        if (key != 'page') {
                            params.push(key + '=' + this.appliedFilters[key].join(','))
                        }
                    }

                    window.location.href = "?" + params.join('&');
                }
            }
        });

        Vue.component('filter-attribute-item', {
            template: '#filter-attribute-item-template',
            props: [
                'index',
                'attribute',
                'addFilters',
                'appliedFilterValues',
            ],

            data: function() {
                let maxPrice  = @json($maxPrice);

                maxPrice = maxPrice ? ((parseInt(maxPrice) !== 0 || maxPrice) ? parseInt(maxPrice) : 500) : 500;

                return {
                    active: false,
                    appliedFilters: [],
                    sliderConfig: {
                        max: maxPrice,
                        value: [ 0, 0 ],

                        processStyle: {
                            "backgroundColor": "#FF6472"
                        },

                        tooltipStyle: {
                            "borderColor": "#FF6472",
                            "backgroundColor": "#FF6472",
                        },

                        priceTo: 0,
                        priceFrom: 0,
                    }
                }
            },

            created: function () {
                if (!this.index)
                    this.active = false;

                if (this.appliedFilterValues && this.appliedFilterValues.length) {
                    this.appliedFilters = this.appliedFilterValues;
                    if (this.attribute.type == 'price') {
                        this.sliderConfig.value = this.appliedFilterValues;
                        this.sliderConfig.priceFrom = this.appliedFilterValues[0];
                        this.sliderConfig.priceTo = this.appliedFilterValues[1];
                    }

                    this.active = true;
                }
            },

            methods: {
                addFilter: function (e) {
                    this.$emit('onFilterAdded', this.appliedFilters)
                },

                priceRangeUpdated: function (value) {
                    this.appliedFilters = value;
                    this.$emit('onFilterAdded', this.appliedFilters)
                },

                clearFilters: function () {
                    if (this.attribute.type == 'price') {
                        this.sliderConfig.value = [0, 0];
                    }

                    this.appliedFilters = [];

                    this.$emit('onFilterAdded', this.appliedFilters)
                },

                optionClicked: function (id, {target}) {
                    let checkbox = $(`#${id}`);
                    if (checkbox && checkbox.length > 0 && target.type != "checkbox") {
                        checkbox = checkbox[0];
                        checkbox.checked = !checkbox.checked;

                        if (checkbox.checked) {
                            this.appliedFilters.push(id);
                        } else {
                            let idPosition = this.appliedFilters.indexOf(id);
                            if (idPosition == -1)
                                idPosition = this.appliedFilters.indexOf(id.toString());

                            this.appliedFilters.splice(idPosition, 1);
                        }

                        this.addFilter(event);
                    }
                }
            }
        });

    </script>
@endpush
