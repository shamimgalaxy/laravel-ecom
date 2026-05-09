<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Events\ChatMessageSent;

class AdminChatController extends Controller
{
    public function index()
    {
        $conversations = Message::where('from_type', 'customer')
            ->select('from_id')
            ->distinct()
            ->get()
            ->map(function ($msg) {
                $latest = Message::where('from_id', $msg->from_id)
                    ->orWhere('to_id', $msg->from_id)
                    ->latest()
                    ->first();

                $unread = Message::where('from_id', $msg->from_id)
                    ->where('is_read', false)
                    ->count();

                return [
                    'customer_id'    => $msg->from_id,
                    'latest_message' => $latest->message,
                    'latest_time'    => $latest->created_at->diffForHumans(),
                    'unread_count'   => $unread,
                ];
            });

        $admin = User::where('role', 'admin')->first();

        return view('admin.chat.index', compact('conversations', 'admin'));
    }

    public function getMessages($customerId)
    {
        Message::where('from_id', $customerId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $messages = Message::where(function ($q) use ($customerId) {
                $q->where('from_id', $customerId)
                  ->where('from_type', 'customer');
            })
            ->orWhere(function ($q) use ($customerId) {
                $q->where('to_id', $customerId)
                  ->where('from_type', 'admin');
            })
            ->orderBy('created_at')
            ->get()
            ->map(fn($m) => [
                'id'         => $m->id,
                'message'    => $m->message,
                'from_type'  => $m->from_type,
                'time'       => $m->created_at->format('h:i A'),
                'created_at' => $m->created_at->toISOString(),
            ]);

        return response()->json(['messages' => $messages]);
    }

  public function sendMessage(Request $request)
{
    $request->validate([
        'message'     => 'required|string|max:500',
        'customer_id' => 'required',
    ]);

    $admin = User::where('role', 'admin')->first();

    $message            = new Message();
    $message->from_id   = $admin->id;
    $message->to_id     = $request->customer_id;
    $message->from_type = 'admin';
    $message->message   = $request->message;
    $message->save();

    // ✅ This was missing — broadcasts to customer's widget in real time
    broadcast(new ChatMessageSent(
        message:     $message->message,
        sender:      'admin',
        created_at:  $message->created_at->toISOString(),
        customer_id: $request->customer_id
    ));

    return response()->json([
        'status'      => 'success',
        'message'     => $message->message,
        'created_at'  => $message->created_at->toISOString(),
        'customer_id' => $request->customer_id,
    ]);
}
}