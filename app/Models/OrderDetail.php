<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use ShoppingCart;

class OrderDetail extends Model
{
    use HasFactory;

    // Use guarded OR fillable, usually not both. 
    // Guarded empty is fine for internal admin-style apps.
    protected $guarded = []; 

    public static function newOrderDetail(int $orderId): void
    {
        foreach (ShoppingCart::all() as $item) {
            self::create([
                'order_id'      => $orderId,
                'product_id'    => $item->id,
                'product_name'  => $item->name,
                'product_price' => $item->price,
                'product_qty'   => $item->qty,
            ]);

            // Ensure the item is removed from the cart after being saved
            ShoppingCart::remove($item->__raw_id);
        }
    }
}