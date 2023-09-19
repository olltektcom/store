<!-- Theme Header -->
<header class="page-header variant-2 fullboxed sticky smart">
    <div class="navbar">
        <div class="container">
            <!-- Menu Toggle -->
            <div class="menu-toggle"><a href="#" class="mobilemenu-toggle"><i class="icon icon-menu"></i></a></div>
            <!-- /Menu Toggle -->
            <!-- Header Cart -->
            @include('shop::checkout.cart.mini-cart')
            <!-- /Header Cart -->
            <!-- Header Links -->
            <div class="header-links">
                <!-- Header Language -->
                @php
                $currentLanguage = app()->getLocale()
                @endphp
                <div class="header-link header-select dropdown-link header-language">
                    <a href="#">
                        @if (!empty($currentLanguage))
                        <img src="{{ bagisto_asset('images/flags/'.$currentLanguage.'.png') }}" />
                        @elseif (app()->getLocale() == 'en')
                        <img src="{{ bagisto_asset('images/flags/en.png') }}" />
                        @endif
                    </a>
                    <ul class="dropdown-container">
                        @foreach (core()->getCurrentChannel()->locales as $locale)
                        @if (isset($serachQuery))
                        <li class="active">
                            <!--  -->
                            <a href="?{{ $serachQuery }}&locale={{ $locale->code }}"><img src="{{ bagisto_asset('images/flags/'.$locale->code.'.png') }}" alt />{{ $locale->name }}</a>
                        </li>
                        @else
                        <li class="active">
                            <!-- $locale->code -->
                            <a href="?locale={{ $locale->code }}"><img src="{{ bagisto_asset('images/flags/'.$locale->code.'.png') }}" alt />{{ $locale->name }}</a>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
                <!-- /Header Language -->
                <!-- Header Currency -->
                {!! view_render_event('bagisto.shop.layout.header.currency-item.before') !!}
                @if (core()->getCurrentChannel()->currencies->count() > 1)
                <div class="header-link header-select dropdown-link header-currency">
                    <a href="#">{{ core()->getCurrentCurrencyCode() }}</a>
                    <ul class="dropdown-container">
                        @foreach (core()->getCurrentChannel()->currencies as $currency)
                        @if (isset($serachQuery))
                        <li class="active"><a href="?{{ $serachQuery }}&currency={{ $currency->code }}">{{ $currency->code }}</a></li>
                        @else
                        <li><a href="?currency={{ $currency->code }}">{{ $currency->code }}</a></li>
                        @endif
                        @endforeach
                    </ul>
                </div>
                @endif
                {!! view_render_event('bagisto.shop.layout.header.currency-item.after') !!}
                <!-- /Header Currency -->
                <!-- Header Account -->
                @include('shop::customers.session.login')
                <!-- /Header Account -->
                @php
                $showWishlist = core()->getConfigData('general.content.shop.wishlist_option') == "1" ? true : false;
                @endphp
                @if ($showWishlist)
                <div class="header-link header-wishlist">
                    <a href="{{ route('customer.wishlist.index') }}" class="wishlist-link" title="Wishlist"><i class="icon icon-heart"></i></a>
                </div>
                @endif
                @php
                $showCompare = core()->getConfigData('general.content.shop.compare_option') == "1" ? true : false
                @endphp
                @if ($showCompare)
                <div class="header-link header-compare">
                    <a class="compare-link" @auth('customer') href="{{ route('velocity.customer.product.compare') }}" @endauth @guest('customer') href="{{ route('velocity.product.compare') }}" @endguest title="Compare">
                        <span class="name">
                            <!-- <img src="{{ bagisto_asset('images/compare_arrows.png') }}" alt="{{ __('velocity::app.customer.compare.text') }}" /> -->
                            <i class="icon icon-balance"></i>
                        </span>

                    </a>
                </div>
                @endif
            </div>
            <!-- /Header Links -->
            <!-- Header Search -->
            <div class="header-link header-search header-search">
                <div class="exp-search">
                    <form role="search" action="{{ route('shop.search.index') }}" method="GET">
                        <input class="exp-search-input " placeholder="Search here ..." type="text" name="term">
                        <input class="exp-search-submit" type="submit" value="">
                        <span class="exp-icon-search"><i class="icon icon-magnify"></i></span>
                        <span class="exp-search-close"><i class="icon icon-close"></i></span>
                    </form>
                </div>
            </div>
            <?php
            $term = request()->input('term');

            if (!is_null($term)) {
                $serachQuery = 'term=' . request()->input('term');
            }
            ?>
            <!-- /Header Search -->
            <!-- Logo -->
            <div class="header-logo">
                <a href="{{ route('shop.home.index') }}">
                    @if ($logo = core()->getCurrentChannel()->logo_url)
                    <img class="logo" src="{{ $logo }}" />
                    @else
                    <img class="logo" src="{{ bagisto_asset('images/fashion-logo.png') }}" />
                    @endif
                </a>
            </div>
            <!-- /Logo -->
            <!-- Mobile Menu -->
            @include('shop::layouts.header.nav-menu.mobilenavmenu')
            <!-- /Mobile Menu -->
            <!-- Mega Menu -->
            <div class="megamenu fadein blackout">
                @include('shop::layouts.header.nav-menu.navmenu')
            </div>
            <!-- /Mega Menu -->
        </div> <!-- /container -->
    </div> <!-- /navbar -->

</header>
<!-- /Theme Header -->