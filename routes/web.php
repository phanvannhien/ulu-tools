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

        Route::get('/', 'Admin\HomeController@index')->name('admin.dashboard');

        Route::get('/transaction', 'Admin\TransactionController@index')->name('transaction');
        Route::post('/transaction', 'Admin\TransactionController@import')->name('check.transaction');

        Route::get('configuration', 'Admin\ConfigurationController@index')->name('configuration.index');
        Route::post('configuration', 'Admin\ConfigurationController@store')->name('configuration.store');

        Route::resource('merchant', 'Admin\MerchantController',[
            'only' => ['update','edit','index']
        ]);

        Route::resource('campaign_link', 'Admin\CampaignLinkController');


        Route::resource('affiliate', 'Admin\AffiliateController',[
            'only' => ['update','edit','index','show']
        ]);
        Route::post('affiliate/{affiliate_id}/campaign/{campaign_id}/approved','Admin\AffiliateController@approveCampaign')
            ->name('admin.affiliate.campaign.approved');

        Route::resource('merchant', 'Admin\MerchantController');
        Route::resource('campaign', 'Admin\CampaignController');

        Route::get('affiliate-sync', 'Admin\AffiliateController@syncPAP')->name('affiliate.sync');
        Route::resource('affiliate_level', 'Admin\AffiliateLevelController');
        Route::get('affiliate_level/{id}/set-default', 'Admin\AffiliateLevelController@setDefault')->name('affiliate_level.set.default');
        

        Route::get('shopee', 'Admin\ShopeeController@index')->name('shopee.index');
        Route::get('shopee/link/normal-link', 'Admin\ShopeeController@buildlink')->name('shopee.buildlink');
        Route::get('shopee/link/smart-link', 'Admin\ShopeeController@smartLink')->name('shopee.smartlink');

    });




});


