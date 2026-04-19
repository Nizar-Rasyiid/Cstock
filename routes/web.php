<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

// QR Code Scanner Routes (public, no auth required)
Route::get('/qr/{productCode}', 'QrCodeController@scan')->name('qr.scan');

// QR Code API Routes (public)
Route::get('/api/qr/{productCode}', 'ProductQRCodeController@getQrUrl')->name('qr.api.get');

Auth::routes(['register' => false]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')
        ->name('home');

    Route::get('/sales-purchases/chart-data', 'HomeController@salesPurchasesChart')
        ->name('sales-purchases.chart');

    Route::get('/current-month/chart-data', 'HomeController@currentMonthChart')
        ->name('current-month.chart');

    Route::get('/payment-flow/chart-data', 'HomeController@paymentChart')
        ->name('payment-flow.chart');
        
    Route::get('/product-group-categories', 'ProductGroupCategoryController@index')->name('product-group-categories.index');

    Route::post('/product-group-categories/store', 'ProductGroupCategoryController@store')->name('product-group-categories.store');

    Route::delete('/product-group-categories/destroy/{id}', 'ProductGroupCategoryController@destroy')->name('product-group-categories.destroy');

    Route::put('/product-group-categories/update/{id}', 'ProductGroupCategoryController@update')->name('product-group-categories.update');

    Route::get('/companies', 'CompanyController@index')->name('companies.index');
    Route::get('/companies/create', 'CompanyController@create')->name('companies.create');
    Route::post('/companies', 'CompanyController@store')->name('companies.store');
    Route::get('/companies/{company}/edit', 'CompanyController@edit')->name('companies.edit');
    Route::put('/companies/{company}', 'CompanyController@update')->name('companies.update');
    Route::delete('/companies/{company}', 'CompanyController@destroy')->name('companies.destroy');

    Route::get('/settings/kop-surat', 'KopController@index');
    Route::post('/settings/kop-surat', 'KopController@update')->name('kop.update');

});

