<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Remark extends Model
{
    protected $fillable = ['leads_manager_id', 'comment'];

    public function lead()
    {
        return $this->belongsTo(LeadsManager::class, 'leads_manager_id');
    }
}
