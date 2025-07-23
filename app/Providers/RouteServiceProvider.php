<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "dashboard" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * The path to the "admin" route for your application.
     *
     * Typically, admin are redirected here after authentication.
     *
     * @var string
     */
    public const ADMIN = '/admin/dashboard';

    /**
     * The path to the "employee" route for your application.
     *
     * Typically, employee are redirected here after authentication.
     *
     * @var string
     */
    public const EMPLOYEE = '/team-member/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->prefix('admin')
                ->group(base_path('routes/admin.php'));

            Route::middleware('web')
                ->prefix('team-member')
                ->group(base_path('routes/employee.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
                
            Route::middleware('web')
                ->prefix('customer')
                ->group(base_path('routes/customer.php'));

        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
