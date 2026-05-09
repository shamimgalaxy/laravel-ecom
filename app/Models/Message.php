<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; 

class Message extends Model
{
    protected $fillable = ['from_id', 'to_id', 'from_type', 'message', 'is_read'];

    public function isFromCustomer(): bool
    {
        return $this->from_type === 'customer';
    }
} 