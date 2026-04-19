<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Product\Entities\Category;
use App\Models\GroupCategory;
use Modules\Product\DataTables\ProductCategoriesDataTable;

class CategoriesController extends Controller
{

    public function index(ProductCategoriesDataTable $dataTable) {
        abort_if(Gate::denies('access_product_categories'), 403);

        $data['group_categories'] = GroupCategory::all();

        return $dataTable->render('product::categories.index', $data);
    }


    public function store(Request $request) {
        abort_if(Gate::denies('access_product_categories'), 403);

        $request->validate([
            'category_code' => 'required|unique:categories,category_code',
            'category_name' => 'required'
        ]);

        Category::create([
            'category_code' => $request->category_code,
            'category_name' => $request->category_name,
            'group_category_id' => $request->group_category_id,
            'company_id' => auth()->user()->company_id,
        ]);

        toast('Product Category Created!', 'success');

        return redirect()->back();
    }


    public function edit($id) {
        abort_if(Gate::denies('access_product_categories'), 403);

        $data['category'] = Category::findOrFail($id);
        $data['group_categories'] = GroupCategory::all();

        return view('product::categories.edit', $data);
    }


    public function update(Request $request, $id) {
        abort_if(Gate::denies('access_product_categories'), 403);

        $request->validate([
            'category_code' => 'required|unique:categories,category_code,' . $id,
            'category_name' => 'required'
        ]);

        Category::findOrFail($id)->update([
            'category_code' => $request->category_code,
            'category_name' => $request->category_name,
            'group_category_id' => $request->group_category_id,
        ]);

        toast('Product Category Updated!', 'info');

        return redirect()->route('product-categories.index');
    }


    public function destroy($id) {
        abort_if(Gate::denies('access_product_categories'), 403);

        $category = Category::findOrFail($id);

        if ($category->products()->exists()) {
            return back()->withErrors('Can\'t delete because there are products associated with this category.');
        }

        $category->delete();

        toast('Product Category Deleted!', 'warning');

        return redirect()->route('product-categories.index');
    }
    
    public function checkCategoryCode(Request $request)
    {
        // Check if the category code already exists
        $exists = Category::where('category_code', $request->code)->exists();

        return response()->json(['exists' => $exists]);
    }
}
