<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;
use Modules\Product\Entities\Product;

class SearchProduct extends Component
{

    public $query;
    public $search_results;
    public $how_many;

    public $product_name, $product_code, $quantity, $price, $unit_price, $sub_total, $product_discount_amount, $product_discount_type, $product_tax_amount;

    public function mount() {
        $this->query = '';
        $this->how_many = 5;
        $this->search_results = Collection::empty();
    }

    public function render() {
        return view('livewire.search-product');
    }

    public function updatedQuery() {
        $this->search_results = Product::where('product_name', 'like', '%' . $this->query . '%')
            ->orWhere('product_code', 'like', '%' . $this->query . '%')
            ->take($this->how_many)->get();
    }

    public function loadMore() {
        $this->how_many += 5;
        $this->updatedQuery();
    }

    public function resetQuery() {
        $this->query = '';
        $this->how_many = 5;
        $this->search_results = Collection::empty();
    }

    public function selectProduct($product) {
        $this->dispatch('productSelected', $product);
    }

    public function createProduct() {
        // Validate the input
        $this->validate([
            'product_name' => 'required|string|max:255',
            'product_code' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'sub_total' => 'nullable|numeric',
            'product_discount_amount' => 'nullable|numeric',
            'product_discount_type' => 'nullable|string',
            'product_tax_amount' => 'nullable|numeric',
        ]);

        // Create the product
        $product = Product::create([
            'product_name' => $this->product_name,
            'product_code' => $this->product_code,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'unit_price' => $this->unit_price,
            'sub_total' => $this->sub_total,
            'product_discount_amount' => $this->product_discount_amount,
            'product_discount_type' => $this->product_discount_type,
            'product_tax_amount' => $this->product_tax_amount,
        ]);

        // Reset input fields after creating the product
        $this->resetInputs();

        $this->dispatch('productCreated', $product);
    }

    private function resetInputs() {
        $this->product_name = '';
        $this->product_code = '';
        $this->quantity = null;
        $this->price = null;
        $this->unit_price = null;
        $this->sub_total = null;
        $this->product_discount_amount = null;
        $this->product_discount_type = null;
        $this->product_tax_amount = null;
    }
}
