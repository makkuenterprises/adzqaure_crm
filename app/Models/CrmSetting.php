<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmSetting extends Model
{
    use HasFactory;

    protected $table = 'crm_settings';  // Ensure this matches your table name

    // If you're not using `$fillable`, you can use `$guarded`
    protected $guarded = [];  // Allow all fields to be updated

    // OR you can specify specific columns that should not be mass-assignable
    // protected $guarded = ['id'];  // Example: protect the ID field from mass-assignment

    // Relationships (if any)
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    // Additional Methods or Scopes can go here
}


