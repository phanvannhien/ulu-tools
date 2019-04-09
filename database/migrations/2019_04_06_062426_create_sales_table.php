<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if( !Schema::hasTable('sales') )
        Schema::create('sales', function (Blueprint $table) {
            $table->string('t_orderid')->primary();
            $table->string('userid',100); // affiliate
            $table->string('campaignid',100)->nullable();
            $table->string('productid',100)->nullable();
            $table->string('accountid',50)->nullable(); // Merchant
            $table->integer('commission')->nullable()->default(0);
            $table->integer('totalcost')->nullable()->default(0);
            $table->string('rstatus',2)->default('P');
            $table->string('data1',200)->nullable(); // to mapping
            $table->string('data2',200)->nullable();
            $table->string('data3',200)->nullable();
            $table->string('data4',200)->nullable();
            $table->string('data5',200)->nullable();


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
        Schema::dropIfExists('sales');
    }
}
