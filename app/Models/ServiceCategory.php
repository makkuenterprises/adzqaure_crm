<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;
    protected $table = 'service_categories';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'status'];

    public function services()
{
    return $this->hasMany(\App\Models\Service::class, 'service_category_id');
}
}
