<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAffiliatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliates', function (Blueprint $table) {

            $table->string('id', 100)->unique();
            $table->string('refid', 100)->nullable();
            $table->string('userid', 100)->nullable();
            $table->string('username', 100)->nullable();
            $table->string('firstname', 100)->nullable();
            $table->string('lastname', 100)->nullable();
            $table->string('parentuserid', 100)->nullable();
            $table->string('dateinserted', 100)->nullable();
            $table->integer('commission_rate')->unsigned()->default(0);
            $table->string('rstatus',50);
            $table->string('data8',50);

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
        Schema::dropIfExists('affiliates');
    }
}
