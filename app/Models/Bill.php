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
     * Add all your columns here so they can be saved via $bill->save() or Bill::create()
     */
    protected $fillable = [
        'customer_id',
        'service_id',
        'package_id',
        'domain_hosting_id',
        'payment_for',
        'items',
        'tax',
        'payment_status',
        'total',
        'discount_percentage',
        'discount_amount',
        'net_payable',
        'received_amount',
        'bill_date',
        'due_date',
        'invoice_currency',
        'bill_note',
        'razorpay_payment_link',
        'razorpay_payment_link_id'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function paymentHistories()
    {
        return $this->hasMany(PaymentHistory::class, 'bill_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Accessor for clean display in the Blade view
     * Usage: {{ $bill->payment_for_display }}
     */
    public function getPaymentForDisplayAttribute()
    {
        // 1. Handle explicit types
        if ($this->payment_for === 'Package') {
            return 'Package: ' . ($this->package?->plan?->name ?? 'N/A');
        }

        if ($this->payment_for === 'Domain Hosting') {
            return 'Domain & Hosting';
        }

        // 2. Fallback: If payment_for is NULL, check if there is a linked service
        if (!empty($this->service_id)) {
            return $this->service?->service_name ?? 'Service Invoice';
        }

        // 3. Absolute fallback
        return 'Manual Invoice';
    }
}
