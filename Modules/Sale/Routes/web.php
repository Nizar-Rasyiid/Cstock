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

Route::group(['middleware' => 'auth'], function () {

    //POS
    Route::get('/app/pos', 'PosController@index')->name('app.pos.index');
    Route::post('/app/pos', 'PosController@store')->name('app.pos.store');

    //Generate PDF
    Route::get('/sales/pdf/{id}', function ($id) {
        $data['sale'] = \Modules\Sale\Entities\Sale::findOrFail($id);
        $data['customer'] = \Modules\People\Entities\Customer::findOrFail($data['sale']->customer_id);
        $data['kop'] = \App\Models\Kop::where('company_id', Auth::user()->company_id)->first();

        return view('sale::print', $data);
    })->name('sales.pdf');

    // Route::get('/sales/pos/pdf/{id}', function ($id) {
    //     $data['sale'] = \Modules\Sale\Entities\Sale::findOrFail($id);
        
    //     return view('sale::print-pos', $data);
    // })->name('sales.pos.pdf');
    Route::get('/sales/pos/pdf/{id}', 'SaleController@printPos')->name('sales.pos.pdf');

    //Sales
    Route::resource('sales', 'SaleController');

    //Payments
    Route::get('/sale-payments/{sale_id}', 'SalePaymentsController@index')->name('sale-payments.index');
    Route::get('/sale-payments/{sale_id}/create', 'SalePaymentsController@create')->name('sale-payments.create');
    Route::post('/sale-payments/store', 'SalePaymentsController@store')->name('sale-payments.store');
    Route::get('/sale-payments/{sale_id}/edit/{salePayment}', 'SalePaymentsController@edit')->name('sale-payments.edit');
    Route::patch('/sale-payments/update/{salePayment}', 'SalePaymentsController@update')->name('sale-payments.update');
    Route::delete('/sale-payments/destroy/{salePayment}', 'SalePaymentsController@destroy')->name('sale-payments.destroy');
});
