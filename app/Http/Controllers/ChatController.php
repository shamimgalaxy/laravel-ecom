<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use App\Events\ChatMessageSent;
use Illuminate\Support\Facades\Session;

class ChatController extends Controller
{
    public function index()
    {
        $user = User::where('role', 'admin')->firstOrFail();
        return view('customer.chat.chat-support', compact('user'));
    }

    // ── Customer sends a message ──────────────────────────────
    public function sendMessage(Request $request)
    {
        if ($request->isJson()) {
            $request->merge($request->json()->all());
        }

        $request->validate([
            'message'     => 'required|string',
            'receiver_id' => 'required|integer|exists:users,id',
        ]);

        // Generate or reuse guest session ID
        $customerId = Session::get('customer_id');
        if (!$customerId) {
            $customerId = 'guest_' . uniqid();
            Session::put('customer_id', $customerId);
        }

        // FIX: cast receiver_id to string so both sides of the query
        // use the same type — avoids MySQL type mismatch 500 error
        $message            = new Message();
        $message->from_id   = (string) $customerId;
        $message->to_id     = (string) $request->receiver_id;
        $message->from_type = 'customer';
        $message->message   = $request->message;
        $message->save();

        // Broadcast on BOTH 'chat' channel (admin panel) and
        // 'customer-{id}' channel (widget) — event handles this
        broadcast(new ChatMessageSent(
            message:     $message->message,
            sender:      'customer',
            created_at:  $message->created_at->toISOString(),
            customer_id: $customerId
        ))->toOthers();

        return response()->json([
            'status'      => 'success',
            'message'     => $message->message,
            'created_at'  => $message->created_at->toISOString(),
            'customer_id' => $customerId,
        ]);
    }

    // ── Admin sends a reply ───────────────────────────────────
    // FIX: this method was missing a broadcast — admin replies never
    // reached the customer widget. Now it broadcasts with sender='admin'
    // on the customer-{id} channel so the widget receives it.
    public function adminReply(Request $request)
    {
        $request->validate([
            'message'     => 'required|string',
            'customer_id' => 'required|string',
        ]);

        $admin = User::where('role', 'admin')->firstOrFail();

        $message            = new Message();
        $message->from_id   = (string) $admin->id;
        $message->to_id     = (string) $request->customer_id;
        $message->from_type = 'admin';
        $message->message   = $request->message;
        $message->save();

        // Broadcast on customer-{id} so the widget receives it,
        // and on 'chat' so other admin tabs stay in sync
        broadcast(new ChatMessageSent(
            message:     $message->message,
            sender:      'admin',
            created_at:  $message->created_at->toISOString(),
            customer_id: $request->customer_id
        ))->toOthers();

        return response()->json([
            'status'      => 'success',
            'message'     => $message->message,
            'created_at'  => $message->created_at->toISOString(),
            'customer_id' => $request->customer_id,
        ]);
    }

    // ── Fetch message history ─────────────────────────────────
    public function fetchMessage(Request $request)
    {
        $customerId = Session::get('customer_id');
        $adminId    = (string) $request->receiver_id;

        // FIX: cast both sides to string so MySQL doesn't 500 on
        // comparing varchar guest_xxx with int column values
        $messages = Message::where(function ($q) use ($customerId, $adminId) {
                        $q->where('from_id', (string) $customerId)
                          ->where('to_id', $adminId);
                    })
                    ->orWhere(function ($q) use ($customerId, $adminId) {
                        $q->where('from_id', $adminId)
                          ->where('to_id', (string) $customerId);
                    })
                    ->orderBy('created_at')
                    ->get()
                    ->map(fn($m) => [
                        'id'         => $m->id,
                        'from_id'    => $m->from_id,
                        'message'    => $m->message,
                        'is_read'    => $m->is_read,
                        'from_type'  => $m->from_type,
                        'time'       => $m->created_at->format('h:i A'),
                        'created_at' => $m->created_at->toISOString(),
                    ]);

        return response()->json(['messages' => $messages]);
    }

    public function chatSupport()
    {
        $customerId = Session::get('customer_id');

        $messages = Message::where(function ($q) use ($customerId) {
                        $q->where('from_id', (string) $customerId)
                          ->orWhere('to_id', (string) $customerId);
                    })
                    ->orderBy('created_at')
                    ->get();

        $user = User::where('role', 'admin')->first();

        return view('website.customer.chat', compact('messages', 'user'));
    }
}