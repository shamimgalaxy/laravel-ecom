<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request; // Use Laravel's Request, not Guzzle
use Illuminate\Support\Facades\Session;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'order_date', 'order_timestamp', 'order_total', 
        'tax_total', 'shipping_total', 'delivery_address', 'payment_type','order_status',
        'delivery_status','payment_status',
    ];

   
  public static function newOrder(Request $request, $customerId)
{
    $cart     = session()->get('cart', []);
    $subtotal = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));
    $tax      = ($subtotal * 15) / 100;
    $shipping = 100;

    $order = new self();
    $order->customer_id      = $customerId;
    $order->order_date       = date('Y-m-d');
    $order->order_timestamp  = date('Y-m-d H:i:s');
    $order->order_total      = $subtotal + $tax + $shipping;
    $order->tax_total        = $tax;
    $order->shipping_total   = $shipping;
    $order->delivery_address = $request->delivery_address;
    $order->payment_type     = $request->payment_type ?? 'Cash';
    $order->order_status     = 'Pending';

    $order->save();

    return $order;
}

public function customer(){
   return $this->belongsTo(Customer::class);
}

public function orderDetails(){
    return $this->hasMany(OrderDetail::class);
}

//end function
}