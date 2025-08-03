<?php

namespace App\Providers;
use Illuminate\Support\Facades\Gate;
use App\Models\Permission;
use App\Models\Employee;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // This gives any user with the 'Admin' guard full access to all permissions.
        // Adjust 'admin' if your admin guard is named differently in config/auth.php
        Gate::before(function ($user, $ability) {
            if (auth()->guard('admin')->check()) {
                return true;
            }
            return null;
        });

        // Dynamically register permissions for other users (i.e., Employees)
        try {
            Permission::all()->map(function ($permission) {
                Gate::define($permission->slug, function ($user) use ($permission) {
                    // This will now correctly call the hasPermissionTo() method
                    // on whichever user model is currently logged in (e.g., Employee).
                    return $user->hasPermissionTo($permission->slug);
                });
            });
        } catch (\Exception $e) {
            // Failsafe for when running migrations before the permissions table exists.
            return;
        }
    }
}
