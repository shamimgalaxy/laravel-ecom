<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productt;
use Overtrue\LaravelShoppingCart\Facade as ShoppingCart;

class CartController extends Controller
{
    private $product;
    public function index(Request $request, $id){
       $product = Productt::findOrFail($id);
    
    
    ShoppingCart::add(
      $product->id,
      $product->name,
      $request->qty ?? 1,
      $product->selling_price,
      ['image' => $product->image, 'type' => $product->category->name, 'brand' => $product->brand->name]
    );
        return redirect()->route('show-cart')->with('message', 'Product added to cart successfully');
    }

    public function show(){
        
        return view('website.cart.index',[
           'cart_items'=>ShoppingCart::all()]);
    }

    public function remove($id){
        ShoppingCart::remove($id);
        return redirect()->route('show-cart')->with('message', 'Item removed from cart successfully');
    }
    
    public function update(Request $request, $id){
        ShoppingCart::update($id, ['qty' => $request->qty]);
        return redirect()->route('show-cart')->with('message', 'Cart item updated successfully');
    }
    //end function
}
