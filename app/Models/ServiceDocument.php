<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDocument extends Model
{
    use HasFactory;

    protected $fillable = ['service_id', 'document_name', 'document_file', 'is_required'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}