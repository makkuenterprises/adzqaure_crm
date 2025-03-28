<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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