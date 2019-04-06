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



Auth::routes([
    'register' => false,
    'forgot' => false,
]);


Route::middleware(['auth'])->group(function () {

    Route::get('/', 'HomeController@index')->name('dashboard');


    Route::get('/transaction', 'TransactionController@index')->name('transaction');
    Route::post('/transaction', 'TransactionController@import')->name('check.transaction');


    Route::resource('merchant', 'MerchantController');
    Route::resource('affiliate', 'AffiliateController');
    Route::get('affiliate-sync', 'AffiliateController@syncPAP')->name('affiliate.sync');


    Route::get('shopee', 'ShopeeController@index')->name('shopee.index');

});

