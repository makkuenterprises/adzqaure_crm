<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    use HasFactory;
    protected $table = 'payment_settings';

    protected $fillable = [
        'account_type_inr',
        'company_account_number_inr',
        'company_account_holder_inr',
        'company_account_ifsc_inr',
        'company_account_branch_inr',
        'upi_payment_inr',
        'payment_link_inr',

        'company_account_holder_usd',
        'payment_method_usd',
        'ach_routing_number_usd',
        'company_account_number_usd',
        'bank_name_usd',
        'beneficiary_address_usd',

        'account_holder_aud',
        'payment_method_aud',
        'company_account_number_aud',
        'bsb_number_aud',
        'bank_name_aud',
        'beneficiary_address_aud',
    ];

    public $timestamps = true;
}