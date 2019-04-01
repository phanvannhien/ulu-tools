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
    Route::get('/transaction', 'TransactionController@index')->name('transaction')->middleware('merchant');
    Route::post('/transaction', 'TransactionController@check')->name('check.transaction')->middleware('merchant');

    Route::resource('merchant', 'MerchantController');
    Route::post('merchant/login','MerchantController@login' )->name('merchant.login');

});

