<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ServiceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'service_id',
        'service_request_id', // Allowed mass assignment
        'title',
        'description',
        'budget',             // Allowed mass assignment
        'status',
        'employee_remarks',
        'quotation_id',
    ];

    protected static function booted(): void
    {
        // Auto-generates IDs like "SR0001", "SR0123" on creation
        static::created(function (ServiceRequest $request) {
            $prefix = 'SR';
            $paddedId = str_pad($request->id, 4, '0', STR_PAD_LEFT);
            $serviceRequestId = $prefix . $paddedId;

            // Updates without triggering infinite recursive model loops
            DB::table('service_requests')
                ->where('id', $request->id)
                ->update(['service_request_id' => $serviceRequestId]);
        });
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }
}
