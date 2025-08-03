<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = ['dynamic_data' => 'array'];

    public function template()
    {
        return $this->belongsTo(WhatsappTemplate::class, 'whatsapp_template_id');
    }

    public function campaignLeads()
    {
        return $this->hasMany(CampaignLead::class);
    }
}
