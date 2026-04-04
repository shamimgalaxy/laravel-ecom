<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index() {
        return view('admin.brand.index');
    }

    public function add() {
        $brands = Brand::all();
        // Removed $brands = Brand::all() as it's usually not needed on a 'Create' page
        return view('admin.brand.add', compact('brands'));
    }

    public function manage() {
        // Use latest() to show newest brands first
        $brands=Brand::latest()->get();
        
        return view('admin.brand.manage', compact('brands'));
    }

    public function create(Request $request) {
    // This is what actually triggers the Model code
    Brand::newBrand($request);
    return back()->with('message', 'Brand info saved successfully.');
}

    public function edit($id){
        $brand = Brand::find($id);
        return view('admin.brand.edit', compact('brand'));
    }

   public function update(Request $request, $id){
    Brand::updatedBrand($request, $id);
    return redirect()->route('brand.manage')->with('message', 'Brand updated successfully');
}

 // Inside app\Models\Brand.php

    public function delete($id)
{
    Brand::findOrFail($id)->delete(); 
    return redirect()->back()->with('message', 'Brand deleted successfully!');
}


//end function

}