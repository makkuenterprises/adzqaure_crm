<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Auth\CommonAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    return view('welcome');
})->name('main');

Route::redirect('/login', '/');
Auth::routes(['login' => false, 'register' => false]);

Route::get('setup', function () {
    Artisan::call('migrate');
    Artisan::call('db:seed');
    Artisan::call('storage:link');
    dd('Application Setup Completed');
});

Route::get('setup/new', function () {
    Artisan::call('migrate');
    dd('Application Setup Completed');
});

Route::get('storage/link', function () {
    Artisan::call('storage:link');
    dd('Application Setup Completed');
});
Route::get('clear', function () {
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('event:clear');
    Artisan::call('optimize:clear');
    Artisan::call('queue:clear');
    dd('Application Cache Cleared');
});


Route::get('login', [CommonAuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [CommonAuthController::class, 'login']);
Route::get('register', [CommonAuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [CommonAuthController::class, 'register']);


// Route::middleware(['auth'])->group(function () {
//     Route::get('customer/dashboard', function () {
//         return view('customer.dashboard');
//     })->name('customer.dashboard');

//     Route::get('service_provider/dashboard', function () {
//         return view('service_provider.dashboard');
//     })->name('service_provider.dashboard');

//     Route::get('partner/dashboard', function () {
//         return view('partner.dashboard');
//     })->name('partner.dashboard');
// });


Route::middleware(['auth', 'role:customer'])->get('customer/dashboard', function () {
    // return view('customer.dashboard');
    return "customer dashboard";
})->name('customer.dashboard');

Route::middleware(['auth', 'role:service_provider'])->get('service_provider/dashboard', function () {
    // return view('service_provider.dashboard');
    return "service provider dashboard";
})->name('service_provider.dashboard');

Route::middleware(['auth', 'role:partner'])->get('partner/dashboard', function () {
    // return view('partner.dashboard');
    return "Partner dashboard";
})->name('partner.dashboard');