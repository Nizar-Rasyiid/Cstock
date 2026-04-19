<?php

namespace App\Livewire\Pos;

use Livewire\Component;
use Modules\Product\Entities\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class BarcodeScanner extends Component
{
    public $barcode = '';

    public function render() {
        return view('livewire.pos.barcode-scanner');
    }

    public function updatedBarcode() {
        if (trim($this->barcode) === '') {
            return;
        }

        // Cari produk berdasarkan barcode (product_barcode_symbology) atau product_code
        $product = Product::where('product_barcode_symbology', $this->barcode)
            ->orWhere('product_code', $this->barcode)
            ->first();

        if ($product) {
            // Add ke cart
            Cart::instance('sale')->add([
                'id' => $product->id,
                'name' => $product->product_name,
                'qty' => 1,
                'price' => $product->product_price,
                'weight' => 0,
                'options' => ['product' => $product]
            ]);

            // Dispatch event ke cart component
            $this->dispatch('cartUpdated');

            // Show success notification dengan product name
            $this->dispatch('notify', [
                'message' => "✅ {$product->product_name} ditambahkan ke keranjang!",
                'type' => 'success'
            ]);

            // Clear input
            $this->barcode = '';
        } else {
            // Show error notification
            $this->dispatch('notify', [
                'message' => "❌ Produk dengan barcode '{$this->barcode}' tidak ditemukan!",
                'type' => 'error'
            ]);
            $this->barcode = '';
        }
    }
}
