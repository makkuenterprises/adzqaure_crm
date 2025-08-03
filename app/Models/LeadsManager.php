<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadsManager extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'leads_manager';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'status',
    ];

    // In app/Models/Lead.php
    // public function remarks()
    // {
    //     // Assuming you have a Remark model and a 'remarks' table
    //     return $this->hasMany(Remark::class)->latest(); // 'latest()' shows newest remarks first
    // }

    public function remarks()
{
    return $this->hasMany(Remark::class, 'leads_manager_id');
}

// Add this relationship to your existing Lead model
public function campaignLeads()
{
    return $this->hasMany(CampaignLead::class);
}
}
