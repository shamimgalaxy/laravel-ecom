<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer; 
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CustomerAuthController extends Controller
{
    public function index() {
        return view('customer.index');
    }

    public function login(Request $request) {
        // 1. Validate the input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $customer = Customer::where('email', $request->email)->first();

        if ($customer && Hash::check($request->password, $customer->password)) {
            // 2. Store session data
            Session::put('customer_id', $customer->id);
            Session::put('customer_name', $customer->name);

            // 3. Redirect to the actual dashboard route
            return redirect()->route('customer.dashboard')->with('message', 'Login successful!');
        } else {
            return back()->with('error', 'Invalid email or password');
        }
    }

public function register(Request $request) {
    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:customers,email',
        'password' => 'required|min:6',
        'mobile'   => 'required' 
    ]);

    // Create the customer
    $customer = Customer::newCustomer($request);

    // LOG THEM IN IMMEDIATELY
    Session::put('customer_id', $customer->id);
    Session::put('customer_name', $customer->name);

    // Use route name, not URL path if using route()
    return redirect()->route('customer.dashboard')->with('message', 'Registration successful!');
}
    public function logout() {
        Session::forget(['customer_id', 'customer_name']);
       
        return redirect('/')->with('message', 'Logged out successfully');
    }

    public function dashboard(){
       
        if(!Session::has('customer_id')){
            return redirect()->route('customer.login');
        }
        return view('customer.dashboard');
    }

    public function profile(){
        return view('customer.profile');
    }

    // app/Http/Controllers/CustomerController.php

public function chatSupport()
{
    // Fetch the first user who is an admin
    // Adjust 'is_admin' or 'role' to match your database column
     $admin = user::find(1);

    // Pass the $admin object to the view as the variable '$user'
    return view('customer.chat.index', [
        'user' => $admin 
    ]);
}



    //end fuction
}