<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/','Affiliate\AffiliateController@dashboard')->name('home');

Route::group([
    'middleware' => ['auth'],
    ], function () {

    Route::get('/', 'Affiliate\AffiliateController@dashboard')->name('affiliate.dashboard');
    Route::group([
        'prefix' => 'affiliate'
    ], function () {

        // ajaxs
        Route::get('campaign/{id}/link', 'Affiliate\CampaignController@getLinkHistory')->name('ajax.get.links');



        // Banks
        Route::resource('bank','Affiliate\BankController');
        Route::get('bank/{id}/default','Affiliate\BankController@setDefault')->name('bank.default');

        Route::get('shopee/data-feed', 'Affiliate\ShopeeDataFeedController@dataFeed')->name('shopee.datafeed');

        Route::get('campaign', 'Affiliate\CampaignController@getCampaign')->name('affiliate.campaign');
        Route::get('campaign/{id}/detail', 'Affiliate\CampaignController@getCampaignDetail')->name('affiliate.campaign.show');
        Route::post('campaign/{id}/register', 'Affiliate\CampaignController@registerCampaign')->name('affiliate.campaign.register');
        Route::post('campaign/{id}/create-link', 'Affiliate\CampaignController@createLink')->name('affiliate.campaign.create.link');



        Route::get('report', 'Affiliate\ReportController@report')->name('affiliate.report');
        Route::get('report-click', 'Affiliate\ReportController@reportClick')->name('affiliate.report.click');


        Route::get('update-profile', 'Affiliate\AffiliateController@profile')->name('affiliate.profile');
        Route::post('update-profile', 'Affiliate\AffiliateController@profileSave')->name('affiliate.profile.save');
        Route::get('change-password', 'Affiliate\AffiliateController@changePassword')->name('affiliate.change.password');
        Route::post('change-password', 'Affiliate\AffiliateController@changePasswordSave')->name('affiliate.change.password.save');


    });


});



Route::group([
    'prefix' => 'admin'
], function () {

    Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\Auth\LoginController@login')->name('admin.login.submit');
    Route::post('logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');

    Route::group([
        'middleware' => 'auth:admin'
    ], function() {

        //ajax

        Route::get('ajax/affiliate', 'Admin\AffiliateController@ajaxGetAffiliate')->name('ajax.get.affiliate');
        Route::get('/', 'Admin\HomeController@index')->name('admin.dashboard');

        /**
         * Transaction
         */
        Route::get('/transaction', 'Admin\TransactionController@index')->name('transaction');
        Route::get('/transaction/import', 'Admin\TransactionController@import')->name('admin.transaction.import');
        Route::post('/transaction/import', 'Admin\TransactionController@importSave')->name('admin.transaction.import.save');

        

        /**
         * Traffic
         */

        Route::get('traffic','Admin\TrafficController@index')->name('admin.traffic');

        /**
         * Configurations
         */
        Route::get('configuration', 'Admin\ConfigurationController@index')->name('configuration.index');
        Route::post('configuration', 'Admin\ConfigurationController@store')->name('configuration.store');




        /**
         * Affiliates
         */
        Route::resource('affiliate', 'Admin\AffiliateController',[
            'only' => ['update','edit','index','show']
        ]);
        Route::get('affiliate/{id}/change-password','Admin\AffiliateController@changePassword')
            ->name('admin.affiliate.change.password');
        Route::post('affiliate/{id}/change-password','Admin\AffiliateController@changePasswordSave')
            ->name('admin.affiliate.change.password.save');
        Route::post('affiliate/{affiliate_id}/campaign/{campaign_id}/approved','Admin\AffiliateController@approveCampaign')
            ->name('admin.affiliate.campaign.approved');
        Route::get('affiliate/registered/campaigns','Admin\AffiliateController@registeredCampaign')
            ->name('admin.affiliate.registered.campaign');
        Route::get('affiliate-sync', 'Admin\AffiliateController@syncPAP')->name('affiliate.sync');
        Route::resource('affiliate_level', 'Admin\AffiliateLevelController');
        Route::get('affiliate_level/{id}/set-default', 'Admin\AffiliateLevelController@setDefault')->name('affiliate_level.set.default');


        /**
         * Campaign banners
         */
        Route::resource('campaign_link', 'Admin\CampaignLinkController');
        Route::post('campaign_link/{id}/add-affiliate','Admin\AffiliateController@addAffiliateBanner')
            ->name('admin.add.affiliate.banner');

        Route::post('campaign_link/{id}/remove-affiliate','Admin\AffiliateController@removeAffiliateBanner')
            ->name('admin.remove.affiliate.banner');


        /**
         * Merchants
         */
        Route::resource('merchant', 'Admin\MerchantController');

        /**
         * Campaigns
         */
        Route::resource('campaign', 'Admin\CampaignController');
        Route::get('campaign/{id}', 'Admin\CampaignController@show');
        Route::get('campaign/{id}/affiliate/{aff_id}', 'Admin\CampaignController@affiliateCampaignEdit')->name('admin.aff.campaign');
        Route::post('campaign/{id}/affiliate/{aff_id}', 'Admin\CampaignController@affiliateCampaignSave')->name('admin.aff.campaign.save');


        Route::get('shopee', 'Admin\ShopeeController@index')->name('shopee.index');
        Route::get('shopee/link/normal-link', 'Admin\ShopeeController@buildlink')->name('shopee.buildlink');
        Route::get('shopee/link/smart-link', 'Admin\ShopeeController@smartLink')->name('shopee.smartlink');

    });




});


