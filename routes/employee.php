<?php

use App\Http\Controllers\Employee\EmployeeAuthController;
use App\Http\Controllers\Employee\EmployeeViewController;
use App\Http\Controllers\Employee\EmployeeUpdateController;
use App\Http\Controllers\Employee\EmployeeCreateController;
use App\Http\Controllers\Employee\EmployeeDeleteController;
use App\Http\Controllers\Employee\EmployeeAPIController;

Route::middleware(['guest:employee'])->group(function () {
    Route::get('login', [EmployeeAuthController::class, 'viewLogin'])->name('employee.view.login');
    Route::post('login', [EmployeeAuthController::class, 'handleLogin'])->name('employee.handle.login');
});

Route::middleware(['auth:employee'])->group(function () {

    Route::get('dashboard', [EmployeeViewController::class, 'viewDashboard'])->name('employee.view.dashboard');

    Route::prefix('setting')->group(function () {
        Route::get('/', [EmployeeViewController::class, 'viewSetting'])->name('employee.view.setting');
        Route::get('/account-information', [EmployeeViewController::class, 'viewAccountSetting'])->name('employee.view.account.setting');
        Route::post('/account-information', [EmployeeUpdateController::class, 'handleAccountInformationUpdate'])->name('employee.handle.account.information.update');
        Route::post('/account-password', [EmployeeUpdateController::class, 'handleAccountPasswordUpdate'])->name('employee.handle.account.password.update');
    });

    Route::prefix('campaign')->group(function () {
        Route::get('/list', [EmployeeViewController::class, 'viewCampaignList'])->name('employee.view.campaign.list');
        Route::get('/preview/{id}', [EmployeeViewController::class, 'viewCampaignPreview'])->name('employee.view.campaign.preview');
    });

    Route::prefix('api')->group(function () {
        Route::put('/lead/status', [EmployeeAPIController::class, 'handleLeadStatusUpdate'])->name('employee.api.lead.status');
    });



});