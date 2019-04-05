<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Browser_display_name')->nullable();
            $table->string('Browser_id')->nullable();
            $table->string('ConversionMeta_note')->nullable();
            $table->string('ConversionsMobile_affiliate_click_id')->nullable();
            $table->string('ConversionsMobile_affiliate_unique1')->nullable();
            $table->string('ConversionsMobile_affiliate_unique2')->nullable();
            $table->string('ConversionsMobile_affiliate_unique3')->nullable();
            $table->string('ConversionsMobile_affiliate_unique4')->nullable();
            $table->string('ConversionsMobile_affiliate_unique5')->nullable();
            $table->string('ConversionsMobile_device_brand')->nullable();
            $table->string('ConversionsMobile_device_model')->nullable();
            $table->string('ConversionsMobile_device_os')->nullable();
            $table->string('ConversionsMobile_device_os_version')->nullable();
            $table->string('ConversionsMobile_google_aid')->nullable();
            $table->string('ConversionsMobile_google_aid_md5')->nullable();
            $table->string('ConversionsMobile_google_aid_sha1')->nullable();
            $table->string('ConversionsMobile_ios_ifa')->nullable();
            $table->string('ConversionsMobile_ios_ifa_md5')->nullable();
            $table->string('ConversionsMobile_ios_ifa_sha1')->nullable();
            $table->string('ConversionsMobile_mobile_carrier')->nullable();
            $table->string('ConversionsMobile_unknown_id')->nullable();
            $table->string('ConversionsMobile_windows_aid')->nullable();
            $table->string('ConversionsMobile_windows_aid_md5')->nullable();
            $table->string('ConversionsMobile_windows_aid_sha1')->nullable();
            $table->string('Country_name')->nullable();
            $table->string('Goal_name')->nullable();
            $table->string('Offer_name')->nullable();
            $table->string('OfferUrl_id')->nullable();
            $table->string('OfferUrl_name')->nullable();
            $table->string('OfferUrl_preview_url')->nullable();
            $table->string('PayoutGroup_id')->nullable();
            $table->string('PayoutGroup_name')->nullable();
            $table->string('Stat_ad_id')->nullable();
            $table->string('Stat_affiliate_info1')->nullable();
            $table->string('Stat_affiliate_info2')->nullable();
            $table->string('Stat_affiliate_info3')->nullable();
            $table->string('Stat_affiliate_info4')->nullable();
            $table->string('Stat_affiliate_info5')->nullable();
            $table->string('Stat_approved_payout')->nullable();
            $table->string('Stat_conversion_status')->nullable();
            $table->string('Stat_count_approved')->nullable();
            $table->string('Stat_currency')->nullable();
            $table->string('Stat_date')->nullable();
            $table->string('Stat_datetime')->nullable();
            $table->string('Stat_goal_id')->nullable();
            $table->string('Stat_hour')->nullable();
            $table->string('Stat_id')->nullable();
            $table->string('Stat_ip')->nullable();
            $table->string('Stat_is_adjustment')->nullable();
            $table->string('Stat_month')->nullable();
            $table->string('Stat_offer_id')->nullable();
            $table->string('Stat_offer_url_id')->nullable();
            $table->string('Stat_pixel_refer')->nullable();
            $table->string('Stat_refer')->nullable();
            $table->string('Stat_sale_amount')->nullable();
            $table->string('Stat_session_datetime')->nullable();
            $table->string('Stat_session_ip')->nullable();
            $table->string('Stat_source')->nullable();
            $table->string('Stat_user_agent')->nullable();
            $table->string('Stat_week')->nullable();
            $table->string('Stat_year')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations_
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
