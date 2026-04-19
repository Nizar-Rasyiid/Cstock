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
    //Generate PDF
    Route::get('/quotations/pdf/{id}', function ($id) {
        $data['quotation'] = \Modules\Quotation\Entities\Quotation::findOrFail($id);
        $data['customer']  = \Modules\People\Entities\Customer::findOrFail($data['quotation']->customer_id);
        $data['kop'] = \App\Models\Kop::where('company_id', Auth::user()->company_id)->first();

        return view('quotation::print', $data);
    })->name('quotations.pdf');

    //Send Quotation Mail
    Route::get('/quotation/mail/{quotation}', 'SendQuotationEmailController')->name('quotation.email');

    //Sales Form Quotation
    Route::get('/quotation-sales/{quotation}', 'QuotationSalesController')->name('quotation-sales.create');

    //quotations
    Route::resource('quotations', 'QuotationController');

    Route::get('/quotation/print-thermal', 'QuotationController@printToThermal')->name('quotation.print-thermal');
});
