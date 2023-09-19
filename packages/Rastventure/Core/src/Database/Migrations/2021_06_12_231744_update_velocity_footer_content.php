<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateVelocityFooterContent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('velocity_meta_data')
				->where('id', '1')
				->update(
                        ['footer_left_content' => '<div class="row">
                                                    <div class="col-md-3 col-lg-3">
                                                    <div class="footer-block collapsed-mobile">
                                                    <div class="title">
                                                    <h4>INFORMATION</h4>
                                                    <div class="toggle-arrow"></div>
                                                    </div>
                                                    <div class="collapsed-content">
                                                    <ul class="marker-list">
                                                    <li><a href="#">About Us</a></li>
                                                    <li><a href="#">Customer Service</a></li>
                                                    <li><a href="#">Privacy Policy</a></li>
                                                    <li><a href="#">Site Map</a></li>
                                                    <li><a href="#">Search Terms</a></li>
                                                    </ul>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3">
                                                    <div class="footer-block collapsed-mobile">
                                                    <div class="title">
                                                    <h4>MY ACCOUNT</h4>
                                                    <div class="toggle-arrow"></div>
                                                    </div>
                                                    <div class="collapsed-content">
                                                    <ul class="marker-list">
                                                    <li><a href="#">About Us</a></li>
                                                    <li><a href="#">Customer Service</a></li>
                                                    <li><a href="#">Privacy Policy</a></li>
                                                    <li><a href="#">Site Map</a></li>
                                                    <li><a href="#">Search Terms</a></li>
                                                    </ul>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3">
                                                    <div class="footer-block collapsed-mobile">
                                                    <div class="title">
                                                    <h4>CUSTOMER CARE</h4>
                                                    <div class="toggle-arrow"></div>
                                                    </div>
                                                    <div class="collapsed-content">
                                                    <ul class="marker-list">
                                                    <li><a href="#">About Us</a></li>
                                                    <li><a href="#">Customer Service</a></li>
                                                    <li><a href="#">Privacy Policy</a></li>
                                                    <li><a href="#">Site Map</a></li>
                                                    <li><a href="#">Search Terms</a></li>
                                                    </ul>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3">
                                                    <div class="footer-block collapsed-mobile">
                                                    <div class="title">
                                                    <h4>CONTACT US</h4>
                                                    <div class="toggle-arrow"></div>
                                                    </div>
                                                    <div class="collapsed-content">
                                                    <ul class="simple-list">
                                                    <li><i class="icon icon-phone"></i>+01 234 567 89</li>
                                                    <li><i class="icon icon-close-envelope"></i><a href="mailto:support@rastventure.com">support@rastventure.com</a></li>
                                                    <li><i class="icon icon-clock"></i>8:00 - 19:00, Monday - Saturday</li>
                                                    </ul>
                                                    <div class="footer-social"><a href="#"><i class="icon icon-facebook-logo icon-circled"></i></a> <a href="#"><i class="icon icon-twitter-logo icon-circled"></i></a> <a href="#"><i class="icon icon-skype-logo icon-circled"></i></a> <a href="#"><i class="icon icon-vimeo icon-circled"></i></a></div>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    </div>'
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
        DB::table('velocity_meta_data')
				->where('id', '1')
				->update(
                        ['footer_left_content' => '<p>We love to craft softwares and solve the real world problems with the binaries. We are highly committed to our goals. We invest our resources to create world class easy to use softwares and applications for the enterprise business with the top notch, on the edge technology expertise.</p>'
                            ]
            );
    }
}
