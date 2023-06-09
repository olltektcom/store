<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColorToProductFlatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_flat', function (Blueprint $table) {
            $table->integer('color')->nullable();
            $table->string('color_label')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_flat', function (Blueprint $table) {
            $table->dropColumn('color');
            $table->dropColumn('color_label');
        });
    }
}
