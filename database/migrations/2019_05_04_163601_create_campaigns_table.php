<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('merchant_id',50)->index();
            $table->string('campaign_name', 200);
            $table->integer('campaign_category_id')->nullable();
            $table->integer('commission_rate')->unsigned()->default(0);
            $table->string('cookie_time', 200)->nullable();
            $table->string('type', 100);
            $table->text('description', 100)->nullable();
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
        Schema::dropIfExists('campaigns');
    }
}
