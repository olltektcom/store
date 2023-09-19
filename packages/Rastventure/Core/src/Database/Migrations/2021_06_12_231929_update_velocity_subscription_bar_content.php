<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateVelocitySubscriptionBarContent extends Migration
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
                        ['subscription_bar_content' => '<h3><span class="custom-color">Latest</span> Theme updates</h3>
                        <div class="news-item">
                        <div class="news-date">06.06.21</div>
                        <h4 class="news-title">Lorem Ipsum is simply dummy text</h4>
                        <div class="news-text">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        <p><a href="#" class="readmore">Read more</a></p>
                        </div>
                        </div>
                        <div id="gtx-trans" style="position: absolute; left: 9px; top: 36.575px;">
                        <div class="gtx-trans-icon"></div>
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
                        ['subscription_bar_content' => '<div class="social-icons col-lg-6"><a href="https://webkul.com" target="_blank" class="unset" rel="noopener noreferrer"><i class="fs24 within-circle rango-facebook" title="facebook"></i> </a> <a href="https://webkul.com" target="_blank" class="unset" rel="noopener noreferrer"><i class="fs24 within-circle rango-twitter" title="twitter"></i> </a> <a href="https://webkul.com" target="_blank" class="unset" rel="noopener noreferrer"><i class="fs24 within-circle rango-linked-in" title="linkedin"></i> </a> <a href="https://webkul.com" target="_blank" class="unset" rel="noopener noreferrer"><i class="fs24 within-circle rango-pintrest" title="Pinterest"></i> </a> <a href="https://webkul.com" target="_blank" class="unset" rel="noopener noreferrer"><i class="fs24 within-circle rango-youtube" title="Youtube"></i> </a> <a href="https://webkul.com" target="_blank" class="unset" rel="noopener noreferrer"><i class="fs24 within-circle rango-instagram" title="instagram"></i></a></div>'
                            ]
            );
    }
}
