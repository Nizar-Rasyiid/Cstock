<?php

namespace App\Livewire\Pos;

use Livewire\Component;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\CategoryGroup;

class Filter extends Component
{
    public $categoryGroups;
    public $categories;
    public $categoryGroup;
    public $category;
    public $products;

    public function mount($categories) {
        $this->categories = $categories;
        $this->categoryGroups = CategoryGroup::withoutGlobalScopes()->get();
    }

    public function render() {
        $availableCategories = $this->categoryGroup 
            ? CategoryGroup::withoutGlobalScopes()->find($this->categoryGroup)?->categories ?? collect([])
            : $this->categories;

        return view('livewire.pos.filter', [
            'categoryGroups' => $this->categoryGroups,
            'availableCategories' => $availableCategories
        ]);
    }

    public function updatedCategoryGroup() {
        $this->category = '';
        $this->dispatch('selectedCategory', '');
    }

    public function updatedCategory() {
        $this->dispatch('selectedCategory', $this->category);
        $this->products = Product::when($this->category, function ($query) {
            return $query->where('category_id', $this->category);
        })->get();
        
        $this->dispatch('clearCart');
        $this->dispatch('productSelectedByCategory', $this->products->toArray());
    }
}
