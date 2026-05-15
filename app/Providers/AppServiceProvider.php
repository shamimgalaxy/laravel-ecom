<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer([
            'website.includes.header',
            'website.category.index',
            'website.detail.index',
            'website.home.index',
            'website.product.index',
            'website.product.show',
        ], function ($view) {
            $cart       = session()->get('cart', []);
            $cart_count = array_sum(array_column($cart, 'quantity'));
            $cart_total = '৳' . number_format(
                array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart)), 2
            );

            $view->with([
                'categories' => Category::all(),
                'cart_items' => $cart,
                'cart_count' => $cart_count,
                'cart_total' => $cart_total,
            ]);
        });

        View::composer('partials.chat-widget', function ($view) {
            $view->with('adminUser', User::where('role', 'admin')->first());
        });
    }
}