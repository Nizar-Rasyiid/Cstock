<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroupCategory;

class ProductGroupCategoryController extends Controller
{
    
    public function index(){
        $data['categories'] = GroupCategory::all();
        return view('pages/group-category/index', $data);
    }

    public function store(Request $request){
        $category = GroupCategory::create([
            'category_code' => $request->category_code,
            'category_name' => $request->category_name,
            'company_id' => auth()->user()->company_id,
        ]);

        return redirect()->back()->with('OK', 'Berhasil menambahkan kategori baru');
    }

    public function update(Request $request, $id){
        $category = GroupCategory::find($id);
            
        $category->update([
            'category_code' => $request->category_code,
            'category_name' => $request->category_name,
        ]);

        return redirect()->back()->with('OK', 'Berhasil mengupdate kategori');
    }
    
    public function destroy($id){
        $category = GroupCategory::find($id);
        $category->delete();

        return redirect()->back()->with('OK', 'Berhasil menghapus kategori');
    }

}
