<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatMessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $sender;
    public $created_at;
    public $customer_id;

    public function __construct($message, $sender, $created_at = null, $customer_id = null)
    {
        $this->message     = $message;
        $this->sender      = $sender;
        $this->created_at  = $created_at ?? now()->toISOString();
        $this->customer_id = $customer_id;
    }

public function broadcastOn(): array
{
    $channels = [
        new \Illuminate\Broadcasting\Channel('chat'), // ← admin listens here
    ];

    if ($this->customer_id) {
        $channels[] = new PrivateChannel('customer-' . $this->customer_id); // ← customer listens here
    }

    return $channels;
}

    public function broadcastAs(): string
    {
        return 'message.sent';
    }

    public function broadcastWith(): array
    {
        return [
            'message'     => $this->message,
            'sender'      => $this->sender,
            'created_at'  => $this->created_at,
            'customer_id' => $this->customer_id,
        ];
    }
}