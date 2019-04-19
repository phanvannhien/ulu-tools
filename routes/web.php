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

Route::group([
    'middleware' => ['auth','affiliate'],
    ], function () {

    Route::get('/', 'Affiliate\AffiliateController@dashboard')->name('affiliate.dashboard');
    Route::group([
        'prefix' => 'affiliate'
    ], function () {

        Route::get('shopee/data-feed', 'Affiliate\ShopeeDataFeedController@dataFeed')->name('shopee.datafeed');

        Route::get('campaign', 'Affiliate\CampaignController@getCampaign')->name('affiliate.campaign');
        Route::get('campaign/{campaign_id}/banners', 'Affiliate\CampaignController@getBanner')->name('affiliate.campaign.banner');

        Route::get('report', 'Affiliate\ReportController@report')->name('affiliate.report');

        Route::get('update-profile', 'Affiliate\AffiliateController@profile')->name('affiliate.profile');

    });


});



Route::group([
    'prefix' => 'merchant'
], function () {

    Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\Auth\LoginController@login')->name('admin.login.submit');

    Route::group([
        'middleware' => 'auth:admin'
    ], function() {

        Route::get('/', 'Admin\HomeController@index')->name('admin.dashboard');

        Route::get('/transaction', 'Admin\TransactionController@index')->name('transaction');
        Route::post('/transaction', 'Admin\TransactionController@import')->name('check.transaction');

        Route::get('configuration', 'Admin\ConfigurationController@index')->name('configuration.index');
        Route::post('configuration', 'Admin\ConfigurationController@store')->name('configuration.store');

        Route::resource('merchant', 'Admin\MerchantController',[
            'only' => ['update','edit','index']
        ]);

        Route::resource('affiliate', 'Admin\AffiliateController',[
            'only' => ['update','edit','index']
        ]);
        Route::get('affiliate-sync', 'Admin\AffiliateController@syncPAP')->name('affiliate.sync');


        Route::get('shopee', 'Admin\ShopeeController@index')->name('shopee.index');
        Route::get('shopee/link/normal-link', 'Admin\ShopeeController@buildlink')->name('shopee.buildlink');
        Route::get('shopee/link/smart-link', 'Admin\ShopeeController@smartLink')->name('shopee.smartlink');

    });




});


