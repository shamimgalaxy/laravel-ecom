<?php

namespace App\Http\Controllers;

use App\Models\Productt;
use Illuminate\Http\Request;
use App\Models\Category;

class MyShopController extends Controller
{
    public function index(){
        return view('website.home.index',[
            
            'products'=>Productt::orderBy('id', 'desc')->take(8)->get(['id', 'category_id', 'name', 'selling_price','image']),
        ]);
    }
    public function category($id){
    return view('website.category.index',[
        // Added 'category_id' to the selection and switched to paginate
        'products' => Productt::where('category_id', $id)
            ->orderBy('id', 'desc')
            ->paginate(12, ['id', 'category_id', 'name', 'selling_price', 'image'])
    ]);
}
    public function detail($id)
{
    $product = Productt::with('otherImages')->findOrFail($id);
    return view('website.detail.index', [
        'product' => $product,
        'other_images' => $product->otherImages ?? [],
    ]);

}



    //end function
}
