<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Remark extends Model
{
    protected $fillable = ['leads_manager_id', 'comment','type',
        'appointment_date',
        'appointment_time',];

    public function lead()
    {
        return $this->belongsTo(LeadsManager::class, 'leads_manager_id');
    }
}
