
@inject ('wishListHelper', 'Webkul\Customer\Helpers\Wishlist')

<?php $images = productimage()->getGalleryImages($product);?>

{!! view_render_event('bagisto.shop.products.view.gallery.before', ['product' => $product]) !!}

<div class="cp-spinner cp-round" id="loader"></div>
<!-- Product Gallery -->
<div class="main-image">
    <img src="{{ $images[0]['original_image_url'] }}" class="zoom" alt="" data-zoom-image="{{ $images[0]['original_image_url'] }}" />
    <div class="dblclick-text"><span>Double click for enlarge</span></div>
    <a href="{{ $images[0]['original_image_url'] }}" class="zoom-link"><i class="icon icon-zoomin"></i></a>
</div>
<div class="product-previews-wrapper">
    <div class="product-previews-carousel" id="previewsGallery">
        @foreach($images as $image)
            <a href="#" data-image="{{ $image['original_image_url'] }}" 
                        data-zoom-image="{{ $image['original_image_url'] }}"
                ><img src="{{ $image['original_image_url'] }}" />
            </a>
        @endforeach
    </div>
</div>
<!-- /Product Gallery -->



    

    <!--<product-gallery></product-gallery>-->



{!! view_render_event('bagisto.shop.products.view.gallery.after', ['product' => $product]) !!}

@push('scripts')

    <script type="text/x-template" id="product-gallery-template">
        <div>

            <ul class="thumb-list">
                <li class="gallery-control top" @click="moveThumbs('top')" v-if="(thumbs.length > 4) && this.is_move.up">
                    <span class="overlay"></span>
                    <i class="icon arrow-up-white-icon"></i>
                </li>

                <li class="thumb-frame" v-for='(thumb, index) in thumbs' @mouseover="changeImage(thumb)" :class="[thumb.large_image_url == currentLargeImageUrl ? 'active' : '']" id="thumb-frame">
                    <img :src="thumb.small_image_url"/>
                </li>

                <li class="gallery-control bottom" @click="moveThumbs('bottom')" v-if="(thumbs.length > 4) && this.is_move.down">
                    <span class="overlay"></span>
                    <i class="icon arrow-down-white-icon"></i>
                </li>
            </ul>

            <div class="product-hero-image" id="product-hero-image">
                <img :src="currentLargeImageUrl" id="pro-img" :data-image="currentOriginalImageUrl"/>

                @auth('customer')
                    <a @if ($wishListHelper->getWishlistProduct($product)) class="add-to-wishlist already" @else class="add-to-wishlist" @endif href="{{ route('customer.wishlist.add', $product->product_id) }}">
                    </a>
                @endauth
            </div>

        </div>
    </script>

    <script>
        var galleryImages = @json($images);

        Vue.component('product-gallery', {

            template: '#product-gallery-template',

            data: function() {
                return {
                    images: galleryImages,

                    thumbs: [],

                    currentLargeImageUrl: '',

                    currentOriginalImageUrl: '',

                    counter: {
                        up: 0,
                        down: 0,
                    },

                    is_move: {
                        up: true,
                        down: true,
                    }
                }
            },

            watch: {
                'images': function(newVal, oldVal) {
                    this.changeImage(this.images[0])

                    this.prepareThumbs()
                }
            },

            created: function() {
                this.changeImage(this.images[0])

                this.prepareThumbs()
            },

            methods: {
                prepareThumbs: function() {
                    var this_this = this;

                    this_this.thumbs = [];

                    this.images.forEach(function(image) {
                        this_this.thumbs.push(image);
                    });
                },

                changeImage: function(image) {
                    this.currentLargeImageUrl = image.large_image_url;

                    this.currentOriginalImageUrl = image.original_image_url;

                    if ($(window).width() > 580) {
                        $('img#pro-img').data('zoom-image', image.original_image_url).ezPlus();
                    }
                },

                moveThumbs: function(direction) {
                    let len = this.thumbs.length;

                    if (direction === "top") {
                        const moveThumb = this.thumbs.splice(len - 1, 1);

                        this.thumbs = [moveThumb[0]].concat((this.thumbs));

                        this.counter.up = this.counter.up+1;

                        this.counter.down = this.counter.down-1;

                    } else {
                        const moveThumb = this.thumbs.splice(0, 1);

                        this.thumbs = [].concat((this.thumbs), [moveThumb[0]]);

                        this.counter.down = this.counter.down+1;

                        this.counter.up = this.counter.up-1;
                    }

                    if ((len-4) == this.counter.down) {
                        this.is_move.down = false;
                    } else {
                        this.is_move.down = true;
                    }

                    if ((len-4) == this.counter.up) {
                        this.is_move.up = false;
                    } else {
                        this.is_move.up = true;
                    }
                },
            }
        });

    </script>

    <script>
        $(document).ready(function() {
            if ($(window).width() > 580) {
                $('img#pro-img').data('zoom-image', $('img#pro-img').data('image')).ezPlus();
            }

            var wishlist = " <?php echo $wishListHelper->getWishlistProduct($product);  ?> ";

            $(document).mousemove(function(event) {
                if ($('.add-to-wishlist').length && wishlist != 1) {
                    if (event.pageX > $('.add-to-wishlist').offset().left && event.pageX < $('.add-to-wishlist').offset().left+32 && event.pageY > $('.add-to-wishlist').offset().top && event.pageY < $('.add-to-wishlist').offset().top+32) {

                        $(".zoomContainer").addClass("show-wishlist");

                    } else {
                        $(".zoomContainer").removeClass("show-wishlist");
                    }
                };

                if ($("body").hasClass("rtl")) {
                    $(".zoomWindow").addClass("zoom-image-direction");
                } else {
                    $(".zoomWindow").removeClass("zoom-image-direction");
                }
            });
        })
    </script>

@endpush