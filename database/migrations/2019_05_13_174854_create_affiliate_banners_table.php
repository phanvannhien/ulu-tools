<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAffiliateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliate_banners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('affiliate_id',50);
            $table->integer('banner_id')->unsigned();

            $table->unique( ['affiliate_id','banner_id'] );

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('affiliate_banners');
    }
}
