<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use ShoppingCart;

class CheckoutController extends Controller
{
    private $customer, $order;

    public function index()
    {
        $this->customer = Session::has('customer_id') ? Customer::find(Session::get('customer_id')) : null;
        return view('website.checkout.index', ['customer' => $this->customer]);
    }

public function newCashOrder(Request $request)
{
    $request->validate([
        'name'             => 'required|string|min:2|max:255',
        'email'            => 'required|email:rfc,dns|max:255',
        'mobile'           => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
        'delivery_address' => 'required|string|min:10|max:500',
    ]);

    try {
        $order = DB::transaction(function () use ($request) {
            // 1. Resolve Customer
            $customerId = Session::get('customer_id');
            $customer = $customerId ? Customer::find($customerId) : Customer::where('email', $request->email)->first();

            if (!$customer) {
                $customer = Customer::create([
                    'name'     => $request->name,
                    'email'    => $request->email,
                    'mobile'   => $request->mobile,
                    'password' => bcrypt($request->mobile),
                    'nid'      => time(), // Consider if this is really needed as a timestamp
                ]);
            }

            Session::put('customer_id', $customer->id);

            // 2. Create Order & Details
            $order = Order::newOrder($request, $customer->id);
            OrderDetail::newOrderDetail($order->id);

            // 3. Clear Cart
            ShoppingCart::destroy();

            return $order;
        });

        return redirect('/complete-order')->with([
            'message'  => 'Congratulations! Your order has been placed successfully.',
            'order_id' => $order->id
        ]);

    } catch (\Exception $e) {
        // Log the error and tell the user something went wrong
        return back()->with('error', 'Something went wrong while processing your order. Please try again.');
    }
}

    public function completeOrder()
    {
        return view('website.checkout.complete-order');
    }
}