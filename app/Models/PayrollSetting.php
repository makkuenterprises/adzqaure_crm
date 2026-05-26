<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollSetting extends Model
{
    protected $fillable = ['employee_id', 'basic_salary', 'allowances', 'deductions'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
