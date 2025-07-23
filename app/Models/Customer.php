<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Authenticatable
{
    // Add the Notifiable trait, which is standard for user models
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     * THIS IS THE FIX FOR YOUR ERROR.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'type', // The 'role' you are saving from the form
        'status',
        'profile',
        'gender',
        'phone_alternate',
        'company_name',
        'whatsapp',
        'website',
        'other',
        'street',
        'city',
        'pincode',
        'state',
        'country',
        'google_chat_space_url',
    ];

    /**
     * The attributes that should be hidden for serialization (e.g., for APIs).
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'other' => 'array',
        'status' => 'boolean',
       
    ];

    // ====================================================================
    // YOUR EXISTING RELATIONSHIPS (These are perfectly fine)
    // ====================================================================

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class)->latest();
    }

    public function bills(): HasMany
    {
        return $this->hasMany(Bill::class)->latest('bill_date');
    }

    public function domainHostings(): HasMany
    {
        return $this->hasMany(DomainHosting::class)->orderBy('domain_expiry', 'asc');
    }

    public function passwords(): HasMany
    {
        return $this->hasMany(Password::class);
    }
}
