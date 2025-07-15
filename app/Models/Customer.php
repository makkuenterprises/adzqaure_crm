<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // ✅ THIS
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Authenticatable // ✅ EXTENDS Authenticatable
{
    use HasFactory;
}

