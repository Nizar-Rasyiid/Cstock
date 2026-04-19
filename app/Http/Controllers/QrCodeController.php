<?php

namespace App\Http\Controllers;

use Modules\Product\Entities\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QrCodeController extends Controller
{
    /**
     * Handle QR code scan redirect
     * QR code should contain: https://app.cstock.id/qr/{product_code}
     */
    public function scan($productCode)
    {
        // Jika user belum login, redirect ke login dengan redirect_to_qr parameter
        if (!Auth::check()) {
            return redirect()->route('login')->with([
                'message' => 'Silakan login untuk melanjutkan scan barcode',
                'redirect_to_qr' => $productCode
            ]);
        }

        // Cari produk berdasarkan product_code
        $product = Product::where('product_code', $productCode)->first();

        if (!$product) {
            return redirect()->route('app.pos.index')->with('error', "Produk dengan code '{$productCode}' tidak ditemukan!");
        }

        // Redirect ke POS dengan parameter product untuk auto-add ke cart
        return redirect()->route('app.pos.index')->with([
            'success' => "✅ {$product->product_name} ditambahkan ke keranjang!",
            'scan_product_id' => $product->id,
            'scan_product_code' => $productCode
        ]);
    }
}
