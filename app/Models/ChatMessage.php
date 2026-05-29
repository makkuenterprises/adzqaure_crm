<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'sender_type',
        'sender_id',
        'message_type',
        'message',
        'file_path',
        'file_name',
        'is_read',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
