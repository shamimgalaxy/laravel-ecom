<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\OtherImage;
use App\Models\Productt;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Unit;
use App\Models\Product;

class ProductController extends Controller
{
    private $product;

    public function index(){
        return view('admin.product.index',[
            'categories'=>Category::all(),
            'sub_categories'=>SubCategory::all(),
            'brands'=>Brand::all(),
            'units'=>Unit::all(),
        ]);
    }

    public function add()
    {
        // Fixed: Use Product instead of Productt
        $products = Productt::all(); 
        return view('admin.product.add', compact('products'));
    }

    public function manage() {
        $products = Productt::all(); 
        return view('admin.product.manage', compact('products'));
    }

    public function edit($id)
    {
        $product = Productt::findOrFail($id);
        
        $categories = Category::all(); 
        $sub_categories = SubCategory::all();
        $brands = Brand::all();
        $units = Unit::all();

        return view('admin.product.edit', compact('product', 'categories', 'sub_categories', 'brands', 'units'));
    }

    public function update(Request $request, $id) {
        
        Productt::updatedProduct($request, $id);
        if ($request->hasFile('other_image')) {
            OtherImage::updateOtherImage($request->other_image, $id); 
        }
       
        return redirect()->route('product.manage')->with('message', 'Product updated successfully');
    }

    public function delete($id) {
        Productt::deleteProduct($id);
        OtherImage::where('product_id', $id)->delete();  
        return redirect()->route('product.manage')->with('message', 'Product deleted successfully');
    }

    public function getSubCategoryByCategory(Request $request){
        $sub_categories = SubCategory::where('category_id', $request->category_id)->get();
        return response()->json($sub_categories);
    }

    public function detail($id)
    {
        

        

        return view('admin.product.detail');
    }

    public function create(Request $request){
        Productt::newProduct($request);
        OtherImage::newOtherImage($request->other_image, Productt::latest()->first()->id);
        return redirect()->route('product.add')->with('message', 'Product created successfully');
    }
}