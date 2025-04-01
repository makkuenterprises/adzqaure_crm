<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmSetting extends Model
{
    use HasFactory;

    protected $table = 'crm_settings';

    // protected $guarded = [];

    protected $fillable = ['crm_name', 'round_logo', 'text_logo', 'favicon'];



    // Relationships (if any)
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    // Additional Methods or Scopes can go here
}