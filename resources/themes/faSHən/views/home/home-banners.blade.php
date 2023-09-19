@php
$banners = app('Rastventure\Core\Repositories\ThemeBannersRepository');
$firstBannerObj = $banners->where('banner_number', '=', 1)->first();
$secondBannerObj = $banners->where('banner_number', '=', 2)->first();
$thirdBannerObj = $banners->where('banner_number', '=', 3)->first();
$forthBannerObj = $banners->where('banner_number', '=', 4)->first();
@endphp
<div class="container">
	<div class="row">
		<div class="col-md-7">
			<a href="#" class="banner-wrap">
				<div class="banner style-17 autosize-text image-hover-scale" data-fontratio="4.6">
					@if(isset($firstBannerObj->image_url))
					<img src="{{ Storage::url($firstBannerObj->image_url) }}" alt="Banner">
					@else
					<img src="{{ bagisto_asset('images/banners/banner-17.jpg') }}" alt="Banner">
					@endif

					@if(isset($firstBannerObj->content))
					{!! $firstBannerObj->content !!}
					@else
					<div class="banner-caption vertb horl">
						<div class="vert-wrapper">
							<div class="vert">
								<div class="text-1">Fashion collection</div>
								<div class="text-2 text-hoverslide" data-hcolor="#ffffff"><span><span class="text">Underwear</span><span class="hoverbg"></span></span>
								</div>
								<div class="text-3">To take a trivial example, which of us ever undtakes
									<br> laborious physical exercise
								</div>
							</div>
						</div>
					</div>
					@endif
				</div>
			</a>
			<a href="#bannerLink" class="banner-wrap">
				<div class="banner style-18 autosize-text image-hover-scale" data-fontratio="4.6">
					@if(isset($secondBannerObj->image_url))
					<img src="{{ Storage::url($secondBannerObj->image_url) }}" alt="Banner">
					@else
					<img src="{{ bagisto_asset('images/banners/banner-18.jpg') }}" alt="Banner">
					@endif

					@if(isset($secondBannerObj->content))
					{!! $secondBannerObj->content !!}
					@else
					<div class="banner-caption vertl horl">
						<div class="vert-wrapper">
							<div class="vert">
								<div class="text-1">BIG STATMENT</div>
								<div class="text-2">AWESOME BRA</div>
								<div class="banner-btn text-hoverslide" data-hcolor="#fff"><span><span class="text">SPECIAL OFFERS</span><span class="hoverbg"></span></span>
								</div>
							</div>
						</div>
					</div>
					@endif
				</div>
			</a>
		</div>
		<div class="col-md-5">
			<a href="#bannerLink" class="banner-wrap">
				<div class="banner style-19 autosize-text image-hover-scale" data-fontratio="4.6">
					@if(isset($thirdBannerObj->image_url))
					<img src="{{ Storage::url($thirdBannerObj->image_url) }}" alt="Banner">
					@else
					<img src="{{ bagisto_asset('images/banners/banner-19.jpg') }}" alt="Banner">
					@endif

					@if(isset($thirdBannerObj->content))
					{!! $thirdBannerObj->content !!}
					@else
					<div class="banner-caption vertb horl">
						<div class="vert-wrapper">
							<div class="vert">
								<div class="text-1">FASHION NIGHT</div>
								<div class="text-2">HAS ARRIVED</div>
							</div>
						</div>
					</div>
					@endif
				</div>
			</a>
			<a href="#bannerLink" class="banner-wrap">
				<div class="banner style-20 autosize-text image-hover-scale" data-fontratio="4.6">
					@if(isset($forthBannerObj->image_url))
					<img src="{{ Storage::url($forthBannerObj->image_url) }}" alt="Banner">
					@else
					<img src="{{ bagisto_asset('images/banners/banner-20.jpg') }}" alt="Banner">
					@endif

					@if(isset($forthBannerObj->content))
					{!! $forthBannerObj->content !!}
					@else
					<div class="banner-caption vertb horr">
						<div class="vert-wrapper">
							<div class="vert">
								<div class="text-1">Always Up To Date<span class="text-corner"></span></div>
								<div class="text-2">URBAN CLOTHING</div>
							</div>
						</div>
					</div>
					@endif
				</div>
			</a>
		</div>
	</div>
</div>