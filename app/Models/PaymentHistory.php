<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
   protected $fillable = [
        'bill_id',
        'received_amount',
        'payment_method',
        'notes',
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class, 'bill_id');
    }
}
