<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    <title>@yield('page_title')</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="content-language" content="{{ app()->getLocale() }}">

    <link rel="stylesheet" href="{{ bagisto_asset('css/shop.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('vendor/webkul/ui/assets/css/ui.css') }}"> -->
	
	<!-- Vendor -->
	<link href="{{ bagisto_asset('js/vendor/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ bagisto_asset('js/vendor/slick/slick.css') }}" rel="stylesheet">
	<link href="{{ bagisto_asset('js/vendor/swiper/swiper.min.css') }}" rel="stylesheet">
	<link href="{{ bagisto_asset('js/vendor/magnificpopup/dist/magnific-popup.css') }}" rel="stylesheet">
	<link href="{{ bagisto_asset('js/vendor/nouislider/nouislider.css') }}" rel="stylesheet">
	<link href="{{ bagisto_asset('js/vendor/darktooltip/dist/darktooltip.css') }}" rel="stylesheet">
	<link href="{{ bagisto_asset('css/animate.css') }}" rel="stylesheet">

	<!-- Custom -->
	<link href="{{ bagisto_asset('css/style.css') }}" rel="stylesheet">
	<link href="{{ bagisto_asset('css/megamenu.css') }}" rel="stylesheet">
	<link href="{{ bagisto_asset('css/tools.css') }}" rel="stylesheet">



	<!-- Icon Font -->
	<link href="{{ bagisto_asset('fonts/icomoon-reg/style.css') }}" rel="stylesheet">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700|Raleway:100,100i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Roboto:300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
	
    @if ($favicon = core()->getCurrentChannel()->favicon_url)
        <link rel="icon" sizes="16x16" href="{{ $favicon }}" />
    @else
        <link rel="icon" sizes="16x16" href="{{ bagisto_asset('images/favicon.ico') }}" />
    @endif

    @yield('head')

    @section('seo')
        @if (! request()->is('/'))
            <meta name="description" content="{{ core()->getCurrentChannel()->description }}"/>
        @endif
    @show

    @stack('css')

    {!! view_render_event('bagisto.shop.layout.head') !!}

</head>


<body class="boxed" @if (core()->getCurrentLocale()->direction == 'rtl') class="rtl" @endif style="scroll-behavior: smooth;">

    {!! view_render_event('bagisto.shop.layout.body.before') !!}
	

    <div id="app">
		<!-- Page -->
		<div class="page-wrapper">
			<flash-wrapper ref='flashes'></flash-wrapper>
			<div class="main-container-wrapper">

				{!! view_render_event('bagisto.shop.layout.header.before') !!}

				@include('shop::layouts.header.index')

				{!! view_render_event('bagisto.shop.layout.header.after') !!}

				@yield('slider')

				<!-- Page Content -->
				<main class="page-main">

					{!! view_render_event('bagisto.shop.layout.content.before') !!}

					@yield('content-wrapper')

					{!! view_render_event('bagisto.shop.layout.content.after') !!}
					<div class="block fullwidth full-nopad">
						<div class="container">
							<div id="instafeed" class="instagramm-feed-full"></div>
							<div class="instagramm-title">Twitter Feed</div>
						</div>
					</div>
				</main>

			</div>

			{!! view_render_event('bagisto.shop.layout.footer.before') !!}
			<!-- Footer -->
			<footer class="page-footer variant4 fullboxed">
				@include('shop::layouts.footer.footer')
			</footer>
			<!-- /Footer -->
			{!! view_render_event('bagisto.shop.layout.footer.after') !!}

			@if (core()->getConfigData('general.content.footer.footer_toggle'))
				<div class="footer">
					<p style="text-align: center;">
						@if (core()->getConfigData('general.content.footer.footer_content'))
							{{ core()->getConfigData('general.content.footer.footer_content') }}
						@else
							{!! trans('admin::app.footer.copy-right') !!}
						@endif
					</p>
				</div>
			@endif
		</div> <!-- end div: page-wrapper -->
    </div> <!-- end div: wrapper -->

    <script type="text/javascript">
        window.flashMessages = [];

        @if ($success = session('success'))
            window.flashMessages = [{'type': 'alert-success', 'message': "{{ $success }}" }];
        @elseif ($warning = session('warning'))
            window.flashMessages = [{'type': 'alert-warning', 'message': "{{ $warning }}" }];
        @elseif ($error = session('error'))
            window.flashMessages = [{'type': 'alert-error', 'message': "{{ $error }}" }
            ];
        @elseif ($info = session('info'))
            window.flashMessages = [{'type': 'alert-info', 'message': "{{ $info }}" }
            ];
        @endif

        window.serverErrors = [];
        @if(isset($errors))
            @if (count($errors))
                window.serverErrors = @json($errors->getMessages());
            @endif
        @endif
    </script>

    <script type="text/javascript" src="{{ bagisto_asset('js/shop.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/webkul/ui/assets/js/ui.js') }}"></script>

    @stack('scripts')

    {!! view_render_event('bagisto.shop.layout.body.after') !!}

    <div class="modal-overlay"></div>

	<!-- Modal Quick View -->
	<div class="modal quick-view zoom" id="quickView">
		<div class="modal-dialog">
			<div class="modalLoader-wrapper">
				<div class="modalLoader bg-striped"></div>
			</div>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">&#10006;</button>
			</div>
			<div class="modal-content">
				<iframe></iframe>
			</div>
		</div>
	</div>
	<!-- /Modal Quick View -->

	<!-- jQuery Scripts  -->
	<script src="{{ bagisto_asset('js/vendor/bootstrap/bootstrap.min.js') }}"></script>
	<script src="{{ bagisto_asset('js/vendor/swiper/swiper.min.js') }}"></script>
	<script src="{{ bagisto_asset('js/vendor/slick/slick.min.js') }}"></script>
	<script src="{{ bagisto_asset('js/vendor/parallax/parallax.js') }}"></script>
	<script src="{{ bagisto_asset('js/vendor/isotope/isotope.pkgd.min.js') }}"></script>
	<script src="{{ bagisto_asset('js/vendor/magnificpopup/dist/jquery.magnific-popup.js') }}"></script>
	<script src="{{ bagisto_asset('js/vendor/countdown/jquery.countdown.min.js') }}"></script>
	<script src="{{ bagisto_asset('js/vendor/nouislider/nouislider.min.js') }}"></script>
	<script src="{{ bagisto_asset('js/vendor/ez-plus/jquery.ez-plus.js') }}"></script>
	<script src="{{ bagisto_asset('js/vendor/tocca/tocca.min.js') }}"></script>
	<script src="{{ bagisto_asset('js/vendor/bootstrap-tabcollapse/bootstrap-tabcollapse.js') }}"></script>
	<script src="{{ bagisto_asset('js/vendor/scrollLock/jquery-scrollLock.min.js') }}"></script>
	<script src="{{ bagisto_asset('js/vendor/darktooltip/dist/jquery.darktooltip.js') }}"></script>
	<script src="{{ bagisto_asset('js/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
	<script src="{{ bagisto_asset('js/vendor/instafeed/instafeed.min.js') }}"></script>
	<script src="{{ bagisto_asset('js/megamenu.min.js') }}"></script>
	<!--<script src="{{ bagisto_asset('js/tools.min.js') }}"></script>-->
	<script src="{{ bagisto_asset('js/app.js') }}"></script>

</body>

</html>