<?php

namespace App\Livewire\Barcode;

use Livewire\Component;
use Milon\Barcode\Facades\DNS1DFacade;
use Milon\Barcode\Facades\DNS2DFacade;
use Livewire\WithPagination;
use Modules\Product\Entities\Product;

class ProductTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';   
    protected $listeners = [
        'selectedCategory' => 'categoryChanged',
        'showCount'        => 'showCountChanged'
    ];
    
    public $product;
    public $quantity;
    public $barcodes;
    public $categories;
    public $category_id;
    public $limit = 9;
    public $quantities = [];

    public function mount($categories) {
        $this->product = Product::all();
        $this->categories = $categories;
        $this->category_id = '';
        $this->quantity = 0;
        $this->barcodes = [];
    }

    public function render() {
        $products = Product::when($this->category_id, function ($query) {
            return $query->where('category_id', $this->category_id);
        })->paginate($this->limit);
    
        // Jangan prune quantities - simpan semua dari semua kategori
        // $this->pruneQuantities($products);
    
        return view('livewire.barcode.product-table', [
            'products' => $products
        ]);
        
        // return view('livewire.barcode.product-table');
    }

    public function productSelected(Product $product) {
        $this->product = $product;
        $this->quantity = 0;
        $this->barcodes = [];
    }

    public function categoryChanged($category_id) {
        $this->category_id = $category_id;
        $this->quantity = 0;
        // Jangan reset quantities - tetap simpan data dari kategori lain
        // $this->quantities = [];
        $this->barcodes = [];
        $this->product = Product::when($this->category_id, function ($query) {
            return $query->where('category_id', $this->category_id);
        })->get();
        $this->resetPage();
    }

    public function generateBarcodes() {
        $this->barcodes = [];
        foreach ($this->quantities as $idProduct => $quantity) {
            if ($quantity === "" || $quantity === 0 || $quantity === null || $quantity === "0") continue;
            $product = Product::find($idProduct);
            if ($quantity > 100) {
                return session()->flash('message', 'Max quantity is 100 per barcode generation!');
            }
    
            if (!is_numeric($product->product_code)) {
                return session()->flash('message', 'Can not generate Barcode with this type of Product Code');
            }

            for ($i = 0; $i < $quantity; $i++) {

                $barcode = DNS1DFacade::getBarCodeSVG($product->product_code, $product->product_barcode_symbology, 2, 60, 'black', false);
                $barcodePrinted = DNS1DFacade::getBarCodeSVG($product->product_code, $product->product_barcode_symbology, 1.5, 30, 'black', false);

                // QR code dengan full URL ke Cstock QR endpoint
                $qrUrl = url("/qr/{$product->product_code}");
                $qrcode = DNS2DFacade::getBarcodeSVG($qrUrl, 'QRCODE', 3, 3, 'black', false);
                $qrcodePrinted = DNS2DFacade::getBarcodeSVG($qrUrl, 'QRCODE', 2, 2, 'black', false);

                array_push($this->barcodes, [
                    'product' => $product,
                    'barcode' => $barcode,
                    'barcodePrinted' => $barcodePrinted,
                    'qrcode' => $qrcode,
                    'qrcodePrinted' => $qrcodePrinted,
                ]);
            }
        }
    }

    public function getPdf() {
        session(['barcodes' => $this->barcodes]);
        $this->dispatch('openNewTab', url: route('barcode.print-barcode'));
    }

    public function getThermal() {
        session(['barcodes' => $this->barcodes]);
        $this->dispatch('openNewTab', url: route('barcode.print-barcode-thermal'));
    }

    public function updatedQuantity() {
        $this->barcodes = [];
    }

    public function showCountChanged($value) {
        $this->limit = $value;
        $this->resetPage();
    }

    protected function pruneQuantities($products)
    {
        $visibleProductIds = $products->pluck('id')->toArray();
        $this->quantities = array_filter(
            $this->quantities,
            fn($key) => in_array($key, $visibleProductIds),
            ARRAY_FILTER_USE_KEY
        );
    }
}
