<?php

namespace App\Livewire\Pos;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Product\Entities\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class ProductList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'selectedCategory' => 'categoryChanged',
        'cartUpdated' => '$refresh'
    ];

    public $categories;
    public $category_id;
    public $limit = 12;

    public function mount($categories) {
        $this->categories = $categories;
        $this->category_id = '';
        
        // Check jika ada redirect dari QR code scan
        if (session()->has('scan_product_id')) {
            $productId = session()->get('scan_product_id');
            $product = Product::find($productId);
            
            if ($product) {
                Cart::instance('sale')->add([
                    'id' => $product->id,
                    'name' => $product->product_name,
                    'qty' => 1,
                    'price' => $product->product_price,
                    'weight' => 0,
                    'options' => ['product' => $product]
                ]);
                
                $this->dispatch('cartUpdated');
                $this->dispatch('notify', [
                    'message' => "✅ {$product->product_name} ditambahkan ke keranjang!",
                    'type' => 'success'
                ]);
            }
            
            session()->forget(['scan_product_id', 'scan_product_code', 'success']);
        }
    }

    public function render() {
        return view('livewire.pos.product-list', [
            'products' => Product::when($this->category_id, function ($query) {
                return $query->where('category_id', $this->category_id);
            })
            ->paginate($this->limit)
        ]);
    }

    public function categoryChanged($category_id) {
        $this->category_id = $category_id;
        $this->resetPage();
    }

    public function selectProduct($product) {
        $this->dispatch('productSelected', $product);
    }
}
