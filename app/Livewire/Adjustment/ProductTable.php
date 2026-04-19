<?php

namespace App\Livewire\Adjustment;

use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Product\Entities\Product;

class ProductTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';   
    protected $listeners = [
        'selectedCategory' => 'categoryChanged',
        'showCount'        => 'showCountChanged',
        'productSelected'  => 'productSelected'
    ];

    public $products;
    public $hasAdjustments;
    public $categories;
    public $category_id;
    public $limit = 9;

    public function mount($adjustedProducts = null, $categories) {
        $this->categories = $categories;
        $this->category_id = '';
        $this->products = Product::all();

        if ($adjustedProducts) {
            $this->hasAdjustments = true;
            $this->products = $adjustedProducts;
        } else {
            $this->hasAdjustments = false;
        }
    }

    public function render() {
        return view('livewire.adjustment.product-table', [
            'products' => Product::when($this->category_id, function ($query) {
                return $query->where('category_id', $this->category_id);
            })
            ->paginate($this->limit)
        ]);
        // return view('livewire.adjustment.product-table');
    }

    public function categoryChanged($category_id) {
        $this->category_id = $category_id;
        $this->products = Product::when($this->category_id, function ($query) {
            return $query->where('category_id', $this->category_id);
        })->get();
        $this->resetPage();
    }

    public function productSelected($product) {
        switch ($this->hasAdjustments) {
            case true:
                if (in_array($product, array_map(function ($adjustment) {
                    return $adjustment['product'];
                }, $this->products))) {
                    return session()->flash('message', 'Already exists in the product list!');
                }
                break;
            case false:
                if (in_array($product, $this->products)) {
                    return session()->flash('message', 'Already exists in the product list!');
                }
                break;
            default:
                return session()->flash('message', 'Something went wrong!');
        }

        array_push($this->products, $product);
    }

    public function removeProduct($key) {
        unset($this->products[$key]);
    }

    public function showCountChanged($value) {
        $this->limit = $value;
        $this->resetPage();
    }
}
