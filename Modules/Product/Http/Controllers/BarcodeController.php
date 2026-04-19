<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Product\Entities\Category;

class BarcodeController extends Controller
{

    public function printBarcode() {
        abort_if(Gate::denies('print_barcodes'), 403);
        $product_categories = Category::orderBy('category_name')->get();
        return view('product::barcode.index', compact('product_categories'));
    }
    
    public function print() {
        $barcodes = session('barcodes', []);
        return view('product::barcode.print', ['barcodes' => $barcodes]);
    }

    public function printThermal() {
        $barcodes = session('barcodes', []);
        return view('product::barcode.print-thermal', ['barcodes' => $barcodes]);
    }

}
