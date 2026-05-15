<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productt;

class CartController extends Controller
{
    public function index(Request $request, $id)
    {
        try {
            $product = Productt::findOrFail($id);

            // Handle both JSON (AJAX) and form data
            $data     = $request->json()->all() ?: $request->all();
            $quantity = (int) ($data['qty'] ?? $data['quantity'] ?? 1);
            if ($quantity < 1) $quantity = 1;

            $cart = session()->get('cart', []);

            if (isset($cart[$id])) {
                $cart[$id]['quantity'] += $quantity;
            } else {
                $cart[$id] = [
                    'id'       => $product->id,
                    'name'     => $product->name,
                    'price'    => $product->selling_price,
                    'quantity' => $quantity,
                    'image'    => $product->image,
                ];
            }

            session()->put('cart', $cart);

            $cartCount = array_sum(array_column($cart, 'quantity'));
            $cartTotal = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));

            if ($request->expectsJson()) {
                return response()->json([
                    'success'   => true,
                    'count'     => $cartCount,
                    'total'     => '৳' . number_format($cartTotal, 2),
                    'cart_html' => view('website.includes.cart-items', ['cart' => $cart])->render(),
                ]);
            }

            return redirect()->back()->with('success', 'Added to cart!');

        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                ], 500);
            }
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show()
    {
        $cart     = session()->get('cart', []);
        $subtotal = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));

        return view('website.cart.index', [
            'cart_items' => $cart,
            'subtotal'   => $subtotal,
        ]);
    }

    public function remove(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);

        $cartCount = array_sum(array_column($cart, 'quantity'));
        $cartTotal = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));

        if ($request->expectsJson()) {
            return response()->json([
                'success'   => true,
                'count'     => $cartCount,
                'total'     => '৳' . number_format($cartTotal, 2),
                'cart_html' => view('website.includes.cart-items', ['cart' => $cart])->render(),
            ]);
        }

        return redirect()->route('show-cart')->with('message', 'Item removed from cart successfully');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = (int) $request->qty;
            if ($cart[$id]['quantity'] <= 0) unset($cart[$id]);
        }
        session()->put('cart', $cart);

        return redirect()->route('show-cart')->with('message', 'Cart updated successfully');
    }
}