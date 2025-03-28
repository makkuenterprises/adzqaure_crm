<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    protected $fillable = ['employee_id',	'group_id',	'campaign_id',	'name',	'email',	'phone',	'address',	'status',	'created_at',	'updated_at'];
}