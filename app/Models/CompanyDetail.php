<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_logo',
        'company_name',
        'company_email',
        'company_phone',
        'company_phone_alternate',
        'company_website',
        'company_account_type',
        'company_account_no',
        'company_account_holder',
        'company_account_ifsc',
        'company_account_branch',
        'company_account_vpa',
        'billing_tax_percentage',
        'company_address_street',
        'company_address_city',
        'company_address_pincode',
        'company_address_state',
        'company_address_country',
        'company_social_media_facebook',
        'company_social_media_twitter',
        'company_social_media_instagram',
        'company_social_media_linkedin',
        'company_social_media_youtube',
        'company_gst_number',
    ];
}