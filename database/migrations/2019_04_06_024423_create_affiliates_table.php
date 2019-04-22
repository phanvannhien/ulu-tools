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
        if( !Schema::hasTable('affiliates') )
        Schema::create('affiliates', function (Blueprint $table) {

            $table->increments('id');

            $table->string('userid', 100)->unique(); // id PAP
            $table->string('username', 100)->unique();
            $table->string('password', 100)->nullable();
            $table->string('dob', 100)->nullable();
            $table->boolean('agreement')->nullable();
            $table->string('avatar', 200)->nullable();
            $table->string('full_name', 200);
            $table->string('phone', 12);


            $table->string('company', 200)->nullable();
            $table->string('website', 200)->nullable();

            $table->string('address', 200)->nullable();
            $table->integer('matp')->unsigned()->nullable();
            $table->integer('maqh')->unsigned()->nullable();


            $table->boolean('status')->default(1);
            $table->boolean('locked')->default(0);

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
