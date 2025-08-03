<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::created(function (Employee $employee) {
            // This event runs AFTER the employee has been created and has an ID.

            // Define your prefix
            $prefix = 'ADZ';

            // Pad the employee's auto-incrementing ID with leading zeros to a length of 4
            // For example, if id is 1, it becomes "0001". If id is 123, it becomes "0123".
            $paddedId = str_pad($employee->id, 4, '0', STR_PAD_LEFT);

            // Combine the prefix and the padded ID
            $employeeId = $prefix . $paddedId;

            // Update the employee record with the new employee_id without firing events again
            DB::table('employees')
                ->where('id', $employee->id)
                ->update(['employee_id' => $employeeId]);
        });
    }

    public function roles()
    {
        // Make sure your User/Admin model has this relationship
        return $this->belongsToMany(Role::class);
    }

    // This is the magic function to check permissions
    public function hasPermissionTo($permissionSlug)
    {
        foreach ($this->roles as $role) {
            if ($role->permissions->contains('slug', $permissionSlug)) {
                return true;
            }
        }
        return false;
    }
}
