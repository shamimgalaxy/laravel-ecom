<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    protected $fillable = ['from_id', 'to_id', 'message', 'is_read'];

    // The user who sent the message
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'from_id');
    }

    // The user who receives the message
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'to_id');
    }
}