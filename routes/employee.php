<?php

use App\Http\Controllers\Employee\EmployeeAuthController;
use App\Http\Controllers\Employee\EmployeeViewController;
use App\Http\Controllers\Employee\EmployeeUpdateController;
use App\Http\Controllers\Employee\EmployeeCreateController;
use App\Http\Controllers\Employee\EmployeeDeleteController;
use App\Http\Controllers\Admin\AdminViewController;
use App\Http\Controllers\LeadRemarkController;
use App\Http\Controllers\Admin\AdminUpdateController;
use App\Http\Controllers\Admin\AdminCreateController;
use App\Http\Controllers\Admin\AdminDeleteController;
use App\Http\Controllers\PaymentHistoryController;
use App\Http\Controllers\Employee\EmployeeCustomerController;
use App\Http\Controllers\Employee\EmployeeAPIController;
use App\Http\Controllers\Employee\EmployeeInquiryController;
use App\Http\Controllers\Employee\LeadManagerController;
use App\Http\Controllers\Employee\EmployeeProjectController;
use App\Http\Controllers\Employee\EmployeePasswordController;
use App\Http\Controllers\Employee\EmployeeDomainHostingController;
use App\Http\Controllers\Employee\EmployeePaymentController;
use App\Http\Controllers\Employee\EmployeeBillController;



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

    Route::prefix('inquiries')->group(function () {
        Route::get('/index', [EmployeeInquiryController::class, 'index'])->name('employee.inquiries.index');
    });

    Route::prefix('campaign')->group(function () {
        Route::get('/list', [EmployeeViewController::class, 'viewCampaignList'])->name('employee.view.campaign.list');
        Route::get('/preview/{id}', [EmployeeViewController::class, 'viewCampaignPreview'])->name('employee.view.campaign.preview');
    });

    Route::prefix('api')->group(function () {
        Route::put('/lead/status', [EmployeeAPIController::class, 'handleLeadStatusUpdate'])->name('employee.api.lead.status');
    });


    Route::prefix('leadmanager')->group(function () {
        Route::get('/list', [LeadManagerController::class, 'viewLeadManagerList'])->name('employee.view.lead.manager.list');
        Route::get('/create', [LeadManagerController::class, 'viewLeadManagerCreate'])->name('employee.view.lead.manager.create');
        Route::post('/create', [LeadManagerController::class, 'handleLeadManagerCreate'])->name('employee.handle.lead.manager.create');
        Route::get('/delete/{id}', [LeadManagerController::class, 'handleLeadManagerDelete'])->name('employee.handle.lead.manager.delete');
        Route::get('/update/{id}', [LeadManagerController::class, 'viewLeadManagerUpdate'])->name('employee.view.lead.manager.update');
        Route::post('/update/{id}', [LeadManagerController::class, 'handleLeadsManagerUpdate'])->name('employee.handle.lead.manager.update');
        Route::get('{lead}/remarks', [LeadManagerController::class, 'showRemarks'])->name('employee.lead.manager.remarks');
        Route::post('{lead}/remarks', action: [LeadManagerController::class, 'storeRemark'])->name('employee.lead.manager.remarks.store');
    });

    Route::prefix('customer')->group(function () {
        Route::get('/list', [EmployeeCustomerController::class, 'viewCustomerList'])->name('employee.view.customer.list');
        Route::get('/create', [EmployeeCustomerController::class, 'viewCustomerCreate'])->name('employee.view.customer.create');
        Route::get('/update/{id}', [EmployeeCustomerController::class, 'viewCustomerUpdate'])->name('employee.view.customer.update');
        Route::get('/preview/{id}', [EmployeeCustomerController::class, 'viewCustomerPreview'])->name('employee.view.customer.preview');
        Route::post('/create', [EmployeeCustomerController::class, 'handleCustomerCreate'])->name('employee.handle.customer.create');
        Route::post('/update/{id}', [EmployeeCustomerController::class, 'handleCustomerUpdate'])->name('employee.handle.customer.update');
        Route::get('/delete/{id}', [EmployeeCustomerController::class, 'handleCustomerDelete'])->name('employee.handle.customer.delete');
    });

    Route::prefix('password')->group(function () {
        Route::get('/list', [EmployeePasswordController::class, 'viewPasswordList'])->name('employee.view.password.list');
        Route::get('/create', [EmployeePasswordController::class, 'viewPasswordCreate'])->name('employee.view.password.create');
        Route::get('/update/{id}', [EmployeePasswordController::class, 'viewPasswordUpdate'])->name('employee.view.password.update');
        Route::post('/create', [EmployeePasswordController::class, 'handlePasswordCreate'])->name('employee.handle.password.create');
        Route::post('/update/{id}', [EmployeePasswordController::class, 'handlePasswordUpdate'])->name('employee.handle.password.update');
        Route::get('/delete/{id}', [EmployeePasswordController::class, 'handlePasswordDelete'])->name('employee.handle.password.delete');
    });

    Route::prefix('project')->group(function () {
        Route::get('/list', [EmployeeProjectController::class, 'viewProjectList'])->name('employee.view.project.list');
        Route::get('/create', [EmployeeProjectController::class, 'viewProjectCreate'])->name('employee.view.project.create');
        Route::get('/update/{id}', [EmployeeProjectController::class, 'viewProjectUpdate'])->name('employee.view.project.update');
        Route::get('/preview/{id}', [EmployeeProjectController::class, 'viewProjectPreview'])->name('employee.view.project.preview');
        Route::post('/create', [EmployeeProjectController::class, 'handleProjectCreate'])->name('employee.handle.project.create');
        Route::post('/update/{id}', [EmployeeProjectController::class, 'handleProjectUpdate'])->name('employee.handle.project.update');
        Route::get('/delete/{id}', [EmployeeProjectController::class, 'handleProjectDelete'])->name('employee.handle.project.delete');
        Route::get('employee/project/{id}/change-status/{status}', [EmployeeProjectController::class, 'changeStatus'])->name('employee.project.change-status');
    });

    Route::prefix('domain-hosting')->group(function () {
        Route::get('/list', [EmployeeDomainHostingController::class, 'viewDomainHostingList'])->name('employee.view.domain.hosting.list');
        Route::get('/create', [EmployeeDomainHostingController::class, 'viewDomainHostingCreate'])->name('employee.view.domain.hosting.create');
        Route::get('/update/{id}', [EmployeeDomainHostingController::class, 'viewDomainHostingUpdate'])->name('employee.view.domain.hosting.update');
        Route::post('/create', [EmployeeDomainHostingController::class, 'handleDomainHostingCreate'])->name('employee.handle.domain.hosting.create');
        Route::post('/update/{id}', [EmployeeDomainHostingController::class, 'handleDomainHostingUpdate'])->name('employee.handle.domain.hosting.update');
        Route::get('/delete/{id}', [EmployeeDomainHostingController::class, 'handleDomainHostingDelete'])->name('employee.handle.domain.hosting.delete');
        Route::get('/bill/{id}', [EmployeeDomainHostingController::class, 'handleDomainHostingBillCreate'])->name('employee.handle.domain.hosting.bill.create');
    });

    Route::prefix('payment')->group(function () {
        Route::get('/list', [EmployeePaymentController::class, 'viewPaymentList'])->name('employee.view.payment.list');
        Route::get('/create', [EmployeePaymentController::class, 'viewPaymentCreate'])->name('employee.view.payment.create');
        Route::get('/update/{id}', [EmployeePaymentController::class, 'viewPaymentUpdate'])->name('employee.view.payment.update');
        Route::post('/create', [EmployeePaymentController::class, 'handlePaymentCreate'])->name('employee.handle.payment.create');
        Route::post('/update/{id}', [EmployeePaymentController::class, 'handlePaymentUpdate'])->name('employee.handle.payment.update');
        Route::get('/delete/{id}', [EmployeePaymentController::class, 'handlePaymentDelete'])->name('employee.handle.payment.delete');
    });

    Route::prefix('billing')->group(callback: function () {
        Route::get('/list', [EmployeeBillController::class, 'viewBillList'])->name('employee.view.bill.list');
        Route::get('/create', [EmployeeBillController::class, 'viewBillCreate'])->name('employee.view.bill.create');
        Route::get('/update/{id}', [EmployeeBillController::class, 'viewBillUpdate'])->name('employee.view.bill.update');
        Route::get('/download/{id}', [EmployeeBillController::class, 'handleBillInvoiceDownload'])->name('employee.view.bill.download');
        Route::post('/create', [EmployeeBillController::class, 'handleBillCreate'])->name('employee.handle.bill.create');
        Route::post('/update/{id}', [EmployeeBillController::class, 'handleBillUpdate'])->name('employee.handle.bill.update');
        Route::get('/delete/{id}', [EmployeeBillController::class, 'handleBillDelete'])->name('employee.handle.bill.delete');
        Route::get('/invoice/{id}', [EmployeeBillController::class, 'handleBillInvoiceDownload'])->name('employee.handle.bill.invoice');
        Route::get('/duplicate/{id}', [EmployeeBillController::class, 'handleBillDuplicate'])->name('employee.handle.bill.duplicate');
        Route::get('{bill}/history', [EmployeeBillController::class, 'showHistory'])->name('employee.bill.history');
        Route::post('{bill}/history', action: [EmployeeBillController::class, 'storeHistory'])->name('employee.bill.history.store');
        // In your admin route group...
        Route::post('/settle/{id}', [EmployeeBillController::class, 'settleBill'])->name('employee.bill.settle');

    });
});
