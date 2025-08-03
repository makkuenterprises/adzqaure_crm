<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute; // <-- Add this import
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // ===============================================================
    // START: ADD THIS METHOD
    // This is the only change you need to make in this file.
    // ===============================================================

    /**
     * Determines if the admin has a valid WhatsApp connection.
     * This creates the 'is_whatsapp_connected' attribute used in the layout.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function isWhatsappConnected(): Attribute
    {
        return Attribute::make(
            get: fn () => !empty($this->whatsapp_access_token) && !empty($this->whatsapp_business_account_id),
        );
    }

    // ===============================================================
    // END: ADD THIS METHOD
    // ===============================================================
}
