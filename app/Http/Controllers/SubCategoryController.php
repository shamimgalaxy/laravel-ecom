<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category; 

use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index(){
        return view('admin.sub-category.index');
    }

    public function add(){
        $sub_categories=SubCategory::all();
        $categories=Category::all();
        return view('admin.sub-category.add',compact('sub_categories','categories'));
    }

    public function manage() {
        $sub_categories = SubCategory::all();  
        return view('admin.sub-category.manage', compact('sub_categories'));
    }

    public function create(Request $request) {
    $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name'        => 'required',
    ]);

    SubCategory::newSubCategory($request);
    return redirect()->back()->with('message', 'Sub Category created successfully!');
}

   public function edit($id){
    $subcategory = SubCategory::findOrFail($id);
    $categories  = Category::all(); // Add this line
    return view('admin.sub-category.edit', compact('subcategory', 'categories'));
}

   public function update(Request $request, $id){
    SubCategory::updatedSubCategory($request, $id);
    return redirect()->route('sub-category.manage')->with('message', 'Sub Category updated successfully');
}
    public function delete($id)
{
    // Find the record and delete it
    SubCategory::destroy($id); 

    return redirect()->route('sub-category.manage')->with('message', 'Sub Category deleted successfully');
}
 
}