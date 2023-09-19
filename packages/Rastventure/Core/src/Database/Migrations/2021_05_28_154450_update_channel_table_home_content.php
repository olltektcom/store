<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateChannelTableHomeContent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('channel_translations')
				->where('id', '1')
				->update(
                        ['home_page_content' => '<!-- slider -->
                                        <div class="block fullwidth full-nopad bottom-space">
                                        <div class="container">@include("shop::home.slider")</div>
                                        </div>
                                        <!-- content -->
                                        <div class="block">
                                        <div class="container"><!-- Wellcome text -->
                                        <div class="text-center bottom-space">
                                        <h1 class="size-lg no-padding">WELCOME TO <span class="logo-font custom-color">Fashion</span> STORE</h1>
                                        <div class="line-divider"></div>
                                        <p class="custom-color-alt">Lorem ipsum dolor sit amet, ex eam mundi populo accusamus, aliquam quaestio petentium te cum. <br /> Vim ei oblique tacimates, usu cu iudico graeco. Graeci eripuit inimicus vel eu, eu mel unum laoreet splendide, cu integre apeirian has.</p>
                                        </div>
                                        <!-- /Wellcome text --></div>
                                        </div>
                                        <div class="block">
                                        <div class="container">
                                        <div class="row">
                                        <div class="col-sm-4">
                                        <div class="box style2 bgcolor1 text-center">
                                        <div class="box-icon"><i class="icon icon-truck"></i></div>
                                        <h3 class="box-title">FREE SHIPPING</h3>
                                        <div class="box-text">Free shipping on all orders over $199</div>
                                        </div>
                                        </div>
                                        <div class="col-sm-4">
                                        <div class="box style2 bgcolor2 text-center">
                                        <div class="box-icon"><i class="icon icon-dollar"></i></div>
                                        <h3 class="box-title">MONEY BACK</h3>
                                        <div class="box-text">100% money back guarantee</div>
                                        </div>
                                        </div>
                                        <div class="col-sm-4">
                                        <div class="box style2 bgcolor3 text-center">
                                        <div class="box-icon"><i class="icon icon-help"></i></div>
                                        <h3 class="box-title">ONLINE SUPPORT</h3>
                                        <div class="box-text">Service support fast 24/7</div>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        <div class="block">@include("shop::home.home-products")</div>
                                        <div class="block banners-with-pad">@include("shop::home.home-banners")</div>
                                        <div class="block">@include("shop::home.home-products-slider")</div>'
                            ]
            );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('channel_translations')
				->where('id', '1')
				->update(
            ['home_page_content' => '<p>@include("shop::home.slider") @include("shop::home.featured-products") @include("shop::home.new-products")</p>
                <div class="banner-container">
                <div class="left-banner"><img src="../../../themes/default/assets/images/1.webp" data-src="http://local.bagisto.com/themes/default/assets/images/1.webp" class="lazyload" alt="test" width="720" height="720" /></div>
                <div class="right-banner"><img src="../../../themes/default/assets/images/2.webp" data-src="http://local.bagisto.com/themes/default/assets/images/2.webp" class="lazyload" alt="test" width="460" height="330" /> <img src="../../../themes/default/assets/images/3.webp" data-src="http://local.bagisto.com/themes/default/assets/images/3.webp" class="lazyload" alt="test" width="460" height="330" /></div>
                </div>']
            );
    }
}
