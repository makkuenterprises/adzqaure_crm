<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerGraphic extends Model
{
    use HasFactory;

    protected $table = 'customer_graphics';

    protected $fillable = [
        'customer_id',
        'title',
        'image_path',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
