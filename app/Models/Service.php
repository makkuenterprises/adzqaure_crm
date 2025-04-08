<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_name',
        'service_details',
        'service_category_id',
        'service_price_in_inr',
        'service_price_in_usd',
        'service_price_in_aud',
        'discounted_price',
        'govt_fee_applied',
        'govt_fee',
        'service_status',
        'subscription_duration',
        'documents_required',
        'partner_margin_percentage',
    ];

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }
}