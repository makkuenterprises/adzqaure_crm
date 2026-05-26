<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payslip extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'month',
        'year',
        'basic_salary',
        'allowances',
        'deductions',
        'net_salary',
        'total_days',
        'present_days',
        'absent_days',
        'half_days',
        'paid_leaves',
        'status',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
