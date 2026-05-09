<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Session;

class UpdateCustomerLastSeen
{
    public function handle(Request $request, Closure $next)
    {
        $customerId = Session::get('customer_id');
        if ($customerId && is_numeric($customerId)) {
            Customer::where('id', $customerId)
                    ->update(['last_seen_at' => now()]);
        }
        return $next($request);
    }
}
