<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_levels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('level_name', 100);
            $table->bigInteger('total_min')->default(0);
            $table->bigInteger('total_max')->default(0);
            $table->string('level_color', 10);
            $table->string('level_icon',200)->nullable();
            $table->integer('commision_rate')->default(70);
            $table->boolean('is_default')->default(0);
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
        Schema::dropIfExists('user_levels');
    }
}
