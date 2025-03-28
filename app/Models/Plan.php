<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    // In the Plan model
    public function packages()
    {
        return $this->hasMany(Package::class);
    }
}