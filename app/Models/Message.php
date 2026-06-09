<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'sender_type',
        'message',
        'type',
        'media_url',
        'voice_duration',
    ];

    /**
     * Relate message back to the customer profile
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
