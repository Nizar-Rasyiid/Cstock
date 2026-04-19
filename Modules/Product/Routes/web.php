<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

use Modules\Product\Http\Controllers\BarcodeController;

Route::group(['middleware' => 'auth'], function () {
    //Print Barcode
    Route::get('/products/print-barcode', 'BarcodeController@printBarcode')->name('barcode.print');
    //Product
    Route::resource('products', 'ProductController');
    //Product Category
    Route::resource('product-categories', 'CategoriesController')->except('create', 'show');
    
    Route::post('/category/check_code', 'CategoriesController@checkCategoryCode')->name('category.check_code');
    Route::get('/barcode/print-barcode', [BarcodeController::class, 'print'])->name('barcode.print-barcode');
    Route::get('/barcode/print-barcode-thermal', [BarcodeController::class, 'printThermal'])->name('barcode.print-barcode-thermal');
});

