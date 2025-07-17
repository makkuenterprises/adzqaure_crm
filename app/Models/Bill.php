<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bill extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bills';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function paymentHistories()
    {
        return $this->hasMany(PaymentHistory::class, 'bill_id');
    }


}
