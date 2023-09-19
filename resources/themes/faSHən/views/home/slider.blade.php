<!-- Main Slider -->
<div class="mainSlider fullscreen" data-thumb="true" data-thumb-width="230" data-thumb-height="100">
    <div class="sliderLoader">Loading...</div>
    <!-- Slider main container -->
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <!-- Slides -->
            @if (! empty($sliderData))
                @foreach ($sliderData as $index => $slider)
                    @php
                        $textContent = str_replace("\r\n", '', $slider['content']);
                    @endphp
                        <div class="swiper-slide right" style="background-image: url('{{ url()->to('/') . '/storage/' . $slider['path'] }}')">
                            @php echo $slider['content'] @endphp
                        </div>
                @endforeach
            @else
            <!-- Slides -->
            <div class="swiper-slide right" style="background-image: url('{{ bagisto_asset('images/slider/slide-02.jpg') }}')" data-thumb="{{ bagisto_asset('images/slider/slide-02-thumb.png') }}">
                <div class="wrapper">
                    <div class="text2-1 animate" data-animate="flipInY" data-delay="0"> Fashion </div>
                    <div class="text2-2 animate" data-animate="bounceIn" data-delay="500"> Season sale </div>
                    <div class="text2-3 animate" data-animate="bounceIn" data-delay="1000"> popular brands </div>
                    <div class="text2-4 animate" data-animate="rubberBand" data-delay="1500"> 70% </div>
                    <div class="text2-5 animate" data-animate="hinge" data-delay="2000"> OFF </div>
                </div>
            </div>
            @endif
            <!-- /Slides  -->
        </div>
        <!-- pagination -->
        <div class="swiper-pagination"></div>
        <!-- pagination thumbs -->
        <div class="swiper-pagination-thumbs">
            <div class="thumbs-wrapper">
                <div class="thumbs"></div>
            </div>
        </div>
    </div>
</div>
<!-- /Main Slider -->