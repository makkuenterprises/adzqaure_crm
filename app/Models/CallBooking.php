<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'scheduled_at',
        'topic',
        'status',
        'employee_remarks',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
