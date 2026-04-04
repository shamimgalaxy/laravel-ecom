<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    
    public function index()
    {
        
        return view('admin.order.index',['orders'=> Order::orderBy('id', 'desc')->get()]);
    }

    // Using Route Model Binding (Order $order) simplifies the code
    public function detail($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.detail', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.edit', compact('order'));
    }

public function update(Request $request, $id)
{
    // 1. Find the order
    $order = Order::findOrFail($id);

    // 2. Validate - this will send you back if delivery_address is missing
    $request->validate([
        'delivery_address' => 'required|string|max:500',
        'order_status'     => 'required|string',
    ]);

    // 3. Update fields
    $order->delivery_address = $request->delivery_address;
    $order->order_status     = $request->order_status;
    
    // Keeping status columns in sync
    $order->delivery_status  = $request->order_status;
    $order->payment_status   = $request->order_status;

    // 4. Save to DB
    $order->save();

    // 5. Redirect using the 'msg' key to match your Blade file
    return redirect()->route('admin.all-order')->with('msg', 'Order updated successfully!');
}

    public function showInvoice(Order $order)
    {
        return view('admin.order.invoice', compact('order'));
    }

    public function printInvoice(Order $order)
    {
        return view('admin.order.print-invoice', compact('order'));
    }

    public function delete(Order $order)
    {
        $order->delete();
        return back()->with('message', 'Order deleted successfully.');
    }
}