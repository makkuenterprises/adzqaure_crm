<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignLead extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function lead()
    {
        // Make sure this relationship points to the correct LeadsManager model
        return $this->belongsTo(LeadsManager::class, 'lead_id');
    }
}
