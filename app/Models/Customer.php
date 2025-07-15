<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // ✅ THIS
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Authenticatable // ✅ EXTENDS Authenticatable
{
    use HasFactory;

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class)->latest(); // ordering by latest is good practice
    }

    public function bills(): HasMany
    {
        return $this->hasMany(Bill::class)->latest('bill_date'); // Order by bill date
    }

    public function domainHostings(): HasMany
    {
        // Ordering by the soonest expiry date is most useful
        return $this->hasMany(DomainHosting::class)->orderBy('domain_expiry', 'asc');
    }

    public function passwords(): HasMany
    {
        return $this->hasMany(Password::class);
    }
}

