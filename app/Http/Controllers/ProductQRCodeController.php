<?php

namespace App\Http\Controllers;

use Modules\Product\Entities\Product;
use Illuminate\Http\Request;

class ProductQRCodeController extends Controller
{
    /**
     * Get QR Code URL untuk product
     */
    public function getQrUrl($productCode)
    {
        $product = Product::where('product_code', $productCode)->first();

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => "Produk dengan code '{$productCode}' tidak ditemukan!"
            ], 404);
        }

        // Generate QR URL
        $qrUrl = url("/qr/{$product->product_code}");

        return response()->json([
            'success' => true,
            'product' => [
                'id' => $product->id,
                'code' => $product->product_code,
                'name' => $product->product_name,
                'price' => $product->product_price,
                'barcode' => $product->product_barcode_symbology
            ],
            'qr_url' => $qrUrl,
            'qr_full_url' => $qrUrl  // Sama dengan di atas
        ]);
    }

    /**
     * Display QR code page untuk testing
     */
    public function show($productCode)
    {
        $product = Product::where('product_code', $productCode)->first();

        if (!$product) {
            abort(404, "Produk tidak ditemukan!");
        }

        $qrUrl = url("/qr/{$product->product_code}");

        return view('qrcode.show', [
            'product' => $product,
            'qrUrl' => $qrUrl
        ]);
    }
}
