<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;

class CustomerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $customerId = session('customer_id');

        if (!$customerId) {
            return redirect('/customer-login');
        }

        // ← Log the customer into the auth system
        if (!Auth::guard('customer')->check()) {
            $customer = Customer::find($customerId);
            if (!$customer) {
                return redirect('/customer-login');
            }
            Auth::guard('customer')->setUser($customer);
        }

        return $next($request);
    }
}