<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Session; 


class ChatController extends Controller
{
    public function index()
{
    // Assign the result to $user
    $user = User::where('id', 1)->firstOrFail();

    
    return view('customer.chat.chat-support', compact('user'));
}




    public function sendMessage(Request $request)
    {
        // 1. Validate incoming data
        $request->validate([
            'message' => 'required',
            'receiver_id' => 'required'
        ]);

        // 2. Save the message to your database
        // Adjust column names based on your actual database table
        $message = new Message(); 
        $message->from_id = Session::get('customer_id'); 
        $message->to_id   = $request->receiver_id;
        $message->message = $request->message;
        $message->save();

        // 3. Return a JSON response for the AJAX 'success' callback
        return response()->json([
            'status' => 'success',
            'message' => $request->message
        ]);
    }
    public function fetchMessage(Request $request){
        return view('customer.chat.fetch');
    }
    public function chatSupport() {
    $customerId = Session::get('customer_id');
    // Make sure you are fetching messages where the customer is either the sender OR receiver
    $messages = Message::where('from_id', $customerId)
                    ->orWhere('to_id', $customerId)
                    ->get();
    $user = User::where('role', 'admin')->first(); // Or however you define your admin

    return view('website.customer.chat', compact('messages', 'user'));
}



   //end function
}