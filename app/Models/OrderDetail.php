<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function newOrderDetail(int $orderId): void
    {
        $cart = session()->get('cart', []);

        foreach ($cart as $productId => $item) {
            self::create([
                'order_id'      => $orderId,
                'product_id'    => $item['id'],
                'product_name'  => $item['name'],
                'product_price' => $item['price'],
                'product_qty'   => $item['quantity'],
            ]);
        }
    }
}