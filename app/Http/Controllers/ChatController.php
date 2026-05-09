<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use App\Models\Customer;
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

        // Reuse session ID or generate guest fallback
        $customerId = Session::get('customer_id');
        if (!$customerId) {
            $customerId = 'guest_' . uniqid();
            Session::put('customer_id', $customerId);
        }
        $customerId = (string) $customerId;

        // ✅ Update last_seen_at for registered customers
        if (is_numeric($customerId)) {
            Customer::where('id', $customerId)->update(['last_seen_at' => now()]);
        }

        $message            = new Message();
        $message->from_id   = $customerId;
        $message->to_id     = (string) $request->receiver_id;
        $message->from_type = 'customer';
        $message->message   = $request->message;
        $message->save();

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

        // ✅ Update last_seen_at when customer loads chat history
        if ($customerId && is_numeric($customerId)) {
            Customer::where('id', $customerId)->update(['last_seen_at' => now()]);
        }

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

    // ── Chat support page ─────────────────────────────────────
    public function chatSupport()
    {
        $customerId = Session::get('customer_id');

        // ✅ Update last_seen_at when customer opens the chat page
        if ($customerId && is_numeric($customerId)) {
            Customer::where('id', $customerId)->update(['last_seen_at' => now()]);
        }

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