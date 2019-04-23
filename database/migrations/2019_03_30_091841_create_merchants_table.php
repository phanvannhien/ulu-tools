<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if( !Schema::hasTable('merchants') )
        Schema::create('merchants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('account', 150)->unique();
            $table->string('account_id', 50)->unique();
            $table->string('email', 200)->unique();
            $table->string('password', 200);
            $table->text('terms')->nullable();
            $table->boolean('agreement_term')->default(1);
            $table->string('company_name')->nullable();
            $table->string('company_tax_code')->nullable();
            $table->string('company_phone',12)->nullable();
            $table->string('company_address',200)->nullable();
            $table->string('company_website',200)->nullable();
            $table->boolean('status')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('merchants');
    }
}
