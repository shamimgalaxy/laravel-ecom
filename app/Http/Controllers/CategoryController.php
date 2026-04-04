<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        return view('admin.category.index');
    }

    public function add(){
        return view('admin.category.add');
    }

    public function manage() {
        $categories = Category::all(); 
        return view('admin.category.manage', compact('categories'));
    }

    public function create(Request $request){
        Category::newCategory($request);
        return redirect()->back()->with('message', 'Category created successfully!');
    }

    public function edit($id){
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

   public function update(Request $request, $id){
    Category::updatedCategory($request, $id);
    return redirect()->route('category.manage')->with('message', 'Category updated successfully');
}
    public function delete($id)
{
    Category::deleteCategory($id);
    return redirect()->back()->with('message', 'Category deleted successfully!');
}

//end function
}