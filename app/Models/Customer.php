<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Better if customers log in
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Customer extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'mobile', 'password', 'nid'];

    /**
     * Create a new customer record.
     */
    public static function newCustomer(Request $request)
    {
        
        $customer = new self();

        $customer->name   = $request->name;
        $customer->email  = $request->email;
        $customer->mobile = $request->mobile;
        $customer->nid    = $request->nid; 

     
        $password = $request->password ?: $request->mobile;
        $customer->password = Hash::make($password);

        $customer->save();

        return $customer;
    }
}