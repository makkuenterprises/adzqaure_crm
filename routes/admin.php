<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminViewController;
use App\Http\Controllers\Admin\AdminUpdateController;
use App\Http\Controllers\Admin\AdminCreateController;
use App\Http\Controllers\Admin\AdminDeleteController;
use App\Http\Controllers\Admin\AdminAPIController;
use App\Http\Controllers\LeadRemarkController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\PaymentHistoryController;

Route::middleware(['guest:admin'])->group(function () {
    Route::get('login', [AdminAuthController::class, 'viewLogin'])->name('admin.view.login');
    Route::post('login', [AdminAuthController::class, 'handleLogin'])->name('admin.handle.login');
});

Route::middleware(['auth:admin'])->group(function () {

    Route::get('dashboard', [AdminViewController::class, 'viewDashboard'])->name('admin.view.dashboard');

    Route::prefix('settings')->group(function () {
        Route::get('/', [AdminViewController::class, 'viewSetting'])->name('admin.view.setting');
        Route::get('/account-information', [AdminViewController::class, 'viewAccountSetting'])->name('admin.view.account.setting');
        Route::post('/account-information', [AdminUpdateController::class, 'handleAccountInformationUpdate'])->name('admin.handle.account.information.update');
        Route::post('/account-password', [AdminUpdateController::class, 'handleAccountPasswordUpdate'])->name('admin.handle.account.password.update');
        Route::get('/company-details', [AdminViewController::class, 'viewCompanyDetailsSetting'])->name('admin.view.company.details.setting');
        Route::post('/company-details', [AdminUpdateController::class, 'handleCompanyDetailsUpdate'])->name('admin.handle.company.details.update');
        Route::get('/mail-credentials', [AdminViewController::class, 'viewMailCredentialsSetting'])->name('admin.view.mail.credentials.setting');

        Route::get('/payment-setting', [AdminViewController::class, 'viewPaymentSetting'])->name('admin.view.payment-setting');

        Route::post('/payment-setting', [AdminUpdateController::class, 'handlePaymentSettingUpdate'])->name('admin.handle.payment.setting.update');

        Route::post('/mail-credentials', [AdminUpdateController::class, 'handleMailCredentialsUpdate'])->name('admin.handle.mail.credentials.update');
        Route::get('/crm-settings', [AdminViewController::class, 'viewCrmSetting'])->name('admin.view.crm.setting');
        Route::post('/crm-settings', [AdminUpdateController::class, 'handleCrmUpdate'])->name('admin.handle.crm.settings.update');
    });

    Route::prefix('inquiries')->group(function () {
        Route::get('/index', [InquiryController::class, 'index'])->name('inquiries.index');
    });

    Route::prefix('domain-hosting')->group(function () {
        Route::get('/list', [AdminViewController::class, 'viewDomainHostingList'])->name('admin.view.domain.hosting.list');
        Route::get('/create', [AdminViewController::class, 'viewDomainHostingCreate'])->name('admin.view.domain.hosting.create');
        Route::get('/update/{id}', [AdminViewController::class, 'viewDomainHostingUpdate'])->name('admin.view.domain.hosting.update');
        Route::post('/create', [AdminCreateController::class, 'handleDomainHostingCreate'])->name('admin.handle.domain.hosting.create');
        Route::post('/update/{id}', [AdminUpdateController::class, 'handleDomainHostingUpdate'])->name('admin.handle.domain.hosting.update');
        Route::get('/delete/{id}', [AdminDeleteController::class, 'handleDomainHostingDelete'])->name('admin.handle.domain.hosting.delete');
        Route::get('/bill/{id}', [AdminCreateController::class, 'handleDomainHostingBillCreate'])->name('admin.handle.domain.hosting.bill.create');
    });

    Route::prefix('password')->group(function () {
        Route::get('/list', [AdminViewController::class, 'viewPasswordList'])->name('admin.view.password.list');
        Route::get('/create', [AdminViewController::class, 'viewPasswordCreate'])->name('admin.view.password.create');
        Route::get('/update/{id}', [AdminViewController::class, 'viewPasswordUpdate'])->name('admin.view.password.update');
        Route::post('/create', [AdminCreateController::class, 'handlePasswordCreate'])->name('admin.handle.password.create');
        Route::post('/update/{id}', [AdminUpdateController::class, 'handlePasswordUpdate'])->name('admin.handle.password.update');
        Route::get('/delete/{id}', [AdminDeleteController::class, 'handlePasswordDelete'])->name('admin.handle.password.delete');
    });

    Route::prefix('customer')->group(function () {
        Route::get('/list', [AdminViewController::class, 'viewCustomerList'])->name('admin.view.customer.list');
        Route::get('/create', [AdminViewController::class, 'viewCustomerCreate'])->name('admin.view.customer.create');
        Route::get('/update/{id}', [AdminViewController::class, 'viewCustomerUpdate'])->name('admin.view.customer.update');
        Route::get('/preview/{id}', [AdminViewController::class, 'viewCustomerPreview'])->name('admin.view.customer.preview');
        Route::post('/create', [AdminCreateController::class, 'handleCustomerCreate'])->name('admin.handle.customer.create');
        Route::post('/update/{id}', [AdminUpdateController::class, 'handleCustomerUpdate'])->name('admin.handle.customer.update');
        Route::get('/delete/{id}', [AdminDeleteController::class, 'handleCustomerDelete'])->name('admin.handle.customer.delete');
    });

    Route::prefix('project')->group(function () {
        Route::get('/list', [AdminViewController::class, 'viewProjectList'])->name('admin.view.project.list');
        Route::get('/create', [AdminViewController::class, 'viewProjectCreate'])->name('admin.view.project.create');
        Route::get('/update/{id}', [AdminViewController::class, 'viewProjectUpdate'])->name('admin.view.project.update');
        Route::get('/preview/{id}', [AdminViewController::class, 'viewProjectPreview'])->name('admin.view.project.preview');
        Route::post('/create', [AdminCreateController::class, 'handleProjectCreate'])->name('admin.handle.project.create');
        Route::post('/update/{id}', [AdminUpdateController::class, 'handleProjectUpdate'])->name('admin.handle.project.update');
        Route::get('/delete/{id}', [AdminDeleteController::class, 'handleProjectDelete'])->name('admin.handle.project.delete');
        Route::get('admin/project/{id}/change-status/{status}', [AdminUpdateController::class, 'changeStatus'])->name('admin.project.change-status');
    });

    Route::prefix('payment')->group(function () {
        Route::get('/list', [AdminViewController::class, 'viewPaymentList'])->name('admin.view.payment.list');
        Route::get('/create', [AdminViewController::class, 'viewPaymentCreate'])->name('admin.view.payment.create');
        Route::get('/update/{id}', [AdminViewController::class, 'viewPaymentUpdate'])->name('admin.view.payment.update');
        Route::post('/create', [AdminCreateController::class, 'handlePaymentCreate'])->name('admin.handle.payment.create');
        Route::post('/update/{id}', [AdminUpdateController::class, 'handlePaymentUpdate'])->name('admin.handle.payment.update');
        Route::get('/delete/{id}', [AdminDeleteController::class, 'handlePaymentDelete'])->name('admin.handle.payment.delete');
    });

    Route::prefix('billing')->group(function () {
        Route::get('/list', [AdminViewController::class, 'viewBillList'])->name('admin.view.bill.list');
        Route::get('/create', [AdminViewController::class, 'viewBillCreate'])->name('admin.view.bill.create');
        Route::get('/update/{id}', [AdminViewController::class, 'viewBillUpdate'])->name('admin.view.bill.update');
        Route::get('/download/{id}', [AdminViewController::class, 'handleBillInvoiceDownload'])->name('admin.view.bill.download');
        Route::post('/create', [AdminCreateController::class, 'handleBillCreate'])->name('admin.handle.bill.create');
        Route::post('/update/{id}', [AdminUpdateController::class, 'handleBillUpdate'])->name('admin.handle.bill.update');
        Route::get('/delete/{id}', [AdminDeleteController::class, 'handleBillDelete'])->name('admin.handle.bill.delete');
        Route::get('/invoice/{id}', [AdminViewController::class, 'handleBillInvoiceDownload'])->name('admin.handle.bill.invoice');
        Route::get('/duplicate/{id}', [AdminCreateController::class, 'handleBillDuplicate'])->name('admin.handle.bill.duplicate');
        Route::get('{bill}/history', [PaymentHistoryController::class, 'showHistory'])->name('admin.bill.history');
        Route::post('{bill}/history', action: [PaymentHistoryController::class, 'storeHistory'])->name('admin.bill.history.store');
        // In your admin route group...
        Route::post('/settle/{id}', [PaymentHistoryController::class, 'settleBill'])->name('admin.bill.settle');

    });

    Route::prefix('admin-access')->group(function () {
        Route::get('/list', [AdminViewController::class, 'viewAdminList'])->name('admin.view.admin.list');
        Route::get('/create', [AdminViewController::class, 'viewAdminCreate'])->name('admin.view.admin.create');
        Route::get('/update/{id}', [AdminViewController::class, 'viewAdminUpdate'])->name('admin.view.admin.update');
        Route::post('/create', [AdminCreateController::class, 'handleAdminCreate'])->name('admin.handle.admin.create');
        Route::post('/update/{id}', [AdminUpdateController::class, 'handleAdminUpdate'])->name('admin.handle.admin.update');
        Route::get('/delete/{id}', [AdminDeleteController::class, 'handleAdminDelete'])->name('admin.handle.admin.delete');
        Route::put('/status', [AdminAPIController::class, 'handleAdminStatus'])->name('admin.handle.admin.status');
    });

    Route::prefix('team-member')->group(function () {
        Route::get('/list', [AdminViewController::class, 'viewEmployeeList'])->name('admin.view.employee.list');
        Route::get('/create', [AdminViewController::class, 'viewEmployeeCreate'])->name('admin.view.employee.create');
        Route::get('/update/{id}', [AdminViewController::class, 'viewEmployeeUpdate'])->name('admin.view.employee.update');
        Route::post('/create', [AdminCreateController::class, 'handleEmployeeCreate'])->name('admin.handle.employee.create');
        Route::post('/update/{id}', [AdminUpdateController::class, 'handleEmployeeUpdate'])->name('admin.handle.employee.update');
        Route::get('delete/{id}', [AdminDeleteController::class, 'handleEmployeeDelete'])->name('admin.handle.employee.delete');
    });

    Route::prefix('role')->group(function () {
        Route::get('/list', [AdminViewController::class, 'viewRoleList'])->name('admin.view.role.list');
        Route::get('/create', [AdminViewController::class, 'viewRoleCreate'])->name('admin.view.role.create');
        Route::get('/update/{id}', [AdminViewController::class, 'viewRoleUpdate'])->name('admin.view.role.update');
        Route::post('/create', [AdminCreateController::class, 'handleRoleCreate'])->name('admin.handle.role.create');
        Route::post('/update/{id}', [AdminUpdateController::class, 'handleRoleUpdate'])->name('admin.handle.role.update');
        Route::get('/delete/{id}', [AdminDeleteController::class, 'handleRoleDelete'])->name('admin.handle.role.delete');
    });

    Route::prefix('group')->group(function () {
        Route::get('/list', [AdminViewController::class, 'viewGroupList'])->name('admin.view.group.list');
        Route::get('/create', [AdminViewController::class, 'viewGroupCreate'])->name('admin.view.group.create');
        Route::get('/update/{id}', [AdminViewController::class, 'viewGroupUpdate'])->name('admin.view.group.update');
        Route::get('/preview/{id}', [AdminViewController::class, 'viewGroupPreview'])->name('admin.view.group.preview');
        Route::post('/create', [AdminCreateController::class, 'handleGroupCreate'])->name('admin.handle.group.create');
        Route::post('/update/{id}', [AdminUpdateController::class, 'handleGroupUpdate'])->name('admin.handle.group.update');
        Route::get('/delete/{id}', [AdminDeleteController::class, 'handleGroupDelete'])->name('admin.handle.group.delete');
        Route::get('/export/{id}', [AdminViewController::class, 'viewGroupExport'])->name('admin.view.group.export');
    });

    // service
    Route::prefix('service')->group(function () {
        Route::get('/list', [AdminViewController::class, 'viewSList'])->name('admin.view.service.list');
        Route::get('/create', [AdminViewController::class, 'viewSCreate'])->name('admin.view.service.create');
        Route::get('/update/{id}', [AdminViewController::class, 'viewSUpdate'])->name('admin.view.service.update');
        Route::post('/create', [AdminCreateController::class, 'handleSCreate'])->name('admin.handle.service.create');
        Route::post('/update/{id}', [AdminUpdateController::class, 'handleSUpdate'])->name('admin.handle.service.update');
        Route::get('/delete/{id}', [AdminDeleteController::class, 'handleSDelete'])->name('admin.handle.service.delete');
    });

    // service category
    Route::prefix('service-category')->group(function () {
        Route::get('/list', [AdminViewController::class, 'viewScList'])->name('admin.view.service-category.list');
        Route::get('/create', [AdminViewController::class, 'viewScCreate'])->name('admin.view.service-category.create');
        Route::get('/update/{id}', [AdminViewController::class, 'viewScUpdate'])->name('admin.view.service-category.update');
        Route::post('/create', [AdminCreateController::class, 'handleScCreate'])->name('admin.handle.service-category.create');
        Route::post('/update/{id}', [AdminUpdateController::class, 'handleScUpdate'])->name('admin.handle.service-category.update');
        Route::get('/delete/{id}', [AdminDeleteController::class, 'handleScDelete'])->name('admin.handle.service-category.delete');
    });

    Route::prefix('lead')->group(function () {
        Route::get('/list', [AdminViewController::class, 'viewLeadList'])->name('admin.view.lead.list');
        Route::get('/create', [AdminViewController::class, 'viewLeadCreate'])->name('admin.view.lead.create');
        Route::post('/create', [AdminCreateController::class, 'handleLeadCreate'])->name('admin.handle.lead.create');
        Route::get('/import', [AdminViewController::class, 'viewLeadImport'])->name('admin.view.lead.import');
        Route::post('/import', [AdminCreateController::class, 'handleLeadImport'])->name('admin.handle.lead.import');
        Route::get('/delete/{id}', [AdminDeleteController::class, 'handleLeadDelete'])->name('admin.handle.lead.delete');
    });

    Route::prefix('leadmanager')->group(function () {
        Route::get('/list', [AdminViewController::class, 'viewLeadManagerList'])->name('admin.view.lead.manager.list');
        Route::get('/create', [AdminViewController::class, 'viewLeadManagerCreate'])->name('admin.view.lead.manager.create');
        Route::post('/create', [AdminCreateController::class, 'handleLeadManagerCreate'])->name('admin.handle.lead.manager.create');
        Route::get('/delete/{id}', [AdminDeleteController::class, 'handleLeadManagerDelete'])->name('admin.handle.lead.manager.delete');
        Route::get('/update/{id}', [AdminViewController::class, 'viewLeadManagerUpdate'])->name('admin.view.lead.manager.update');
        Route::post('/update/{id}', [AdminUpdateController::class, 'handleLeadsManagerUpdate'])->name('admin.handle.lead.manager.update');
        Route::get('{lead}/remarks', [LeadRemarkController::class, 'showRemarks'])->name('admin.lead.manager.remarks');
        Route::post('{lead}/remarks', action: [LeadRemarkController::class, 'storeRemark'])->name('admin.lead.manager.remarks.store');
    });

    Route::prefix('campaign')->group(function () {
        Route::get('/list', [AdminViewController::class, 'viewCampaignList'])->name('admin.view.campaign.list');
        Route::get('/create', [AdminViewController::class, 'viewCampaignCreate'])->name('admin.view.campaign.create');
        Route::post('/create', [AdminCreateController::class, 'handleCampaignCreate'])->name('admin.handle.campaign.create');
        Route::get('/preview/{id}', [AdminViewController::class, 'viewCampaignPreview'])->name('admin.view.campaign.preview');
        Route::get('/update/{id}', [AdminViewController::class, 'viewCampaignUpdate'])->name('admin.view.campaign.update');
        Route::post('/update/{id}', [AdminUpdateController::class, 'handleCampaignUpdate'])->name('admin.handle.campaign.update');
        Route::get('/delete/{id}', [AdminDeleteController::class, 'handleCampaignDelete'])->name('admin.handle.campaign.delete');
    });

    Route::prefix('plan')->group(function () {
        Route::get('/list', [AdminViewController::class, 'viewPlanList'])->name('admin.view.plan.list');
        Route::get('/create', [AdminViewController::class, 'viewPlanCreate'])->name('admin.view.plan.create');
        Route::post('/create', [AdminCreateController::class, 'handlePlanCreate'])->name('admin.handle.plan.create');
        Route::get('/update/{id}', [AdminViewController::class, 'viewPlanUpdate'])->name('admin.view.plan.update');
        Route::post('/update/{id}', [AdminUpdateController::class, 'handlePlanUpdate'])->name('admin.handle.plan.update');
        Route::get('/delete/{id}', [AdminDeleteController::class, 'handlePlanDelete'])->name('admin.handle.plan.delete');
    });

    //company_payment_accounts
    Route::prefix('company-payment')->group(function () {
        // Route::get('/list', [AdminViewController::class, 'viewPlanList'])->name('admin.view.plan.list');
        Route::get('/create', [AdminViewController::class, 'viewCompanyPaymentCreate'])->name('admin.view.company-payment.create');
        // Route::post('/create', [AdminCreateController::class, 'handlePlanCreate'])->name('admin.handle.plan.create');
        // Route::get('/update/{id}', [AdminViewController::class, 'viewPlanUpdate'])->name('admin.view.plan.update');
        // Route::post('/update/{id}', [AdminUpdateController::class, 'handlePlanUpdate'])->name('admin.handle.plan.update');
        // Route::get('/delete/{id}', [AdminDeleteController::class, 'handlePlanDelete'])->name('admin.handle.plan.delete');
    });

    Route::prefix('package')->group(function () {
        Route::get('/list', [AdminViewController::class, 'viewPackageList'])->name('admin.view.package.list');
        Route::get('/create', [AdminViewController::class, 'viewPackageCreate'])->name('admin.view.package.create');
        Route::post('/create', [AdminCreateController::class, 'handlePackageCreate'])->name('admin.handle.package.create');
        Route::get('/update/{id}', [AdminViewController::class, 'viewPackageUpdate'])->name('admin.view.package.update');
        Route::post('/update/{id}', [AdminUpdateController::class, 'handlePackageUpdate'])->name('admin.handle.package.update');
        Route::get('/delete/{id}', [AdminDeleteController::class, 'handlePackageDelete'])->name('admin.handle.package.delete');
        Route::get('/renew/{id}', [AdminViewController::class, 'viewPackageRenew'])->name('admin.view.package.renew');
        Route::post('/renew/{id}', [AdminUpdateController::class, 'handlePackageRenew'])->name('admin.handle.package.renew');
        Route::get('/bill/{id}', [AdminCreateController::class, 'handlePackageBillCreate'])->name('admin.handle.package.bill.create');
    });

    Route::prefix('api')->group(function () {

        Route::put('/employee/status', [AdminAPIController::class, 'handleEmployeeStatusUpdate'])->name('admin.api.employee.status');

        Route::put('/lead/status', [AdminAPIController::class, 'handleLeadStatusUpdate'])->name('admin.api.lead.status');
        Route::put('/group/status', [AdminAPIController::class, 'handleGroupStatusUpdate'])->name('admin.api.group.status');
        Route::put('/campaign/status', [AdminAPIController::class, 'handleCampaignStatusUpdate'])->name('admin.api.campaign.status');
        Route::put('/customer/status', [AdminAPIController::class, 'handleCustomerStatusUpdate'])->name('admin.api.customer.status');
        Route::put('/project/status', [AdminAPIController::class, 'handleProjectStatusUpdate'])->name('admin.api.project.status');
        Route::put('/bill/payment/status', [AdminAPIController::class, 'handleBillStatusUpdate'])->name('admin.api.bill.status');
        Route::put('/package/payment/status', [AdminAPIController::class, 'handlePackagePaymentStatusUpdate'])->name('admin.api.package.payment.status');
        Route::post('/get/plans/', [AdminAPIController::class, 'handleGetPlansByCity'])->name('admin.api.get.plans');
    });

    Route::view('/bill/template', 'admin.documents.bill-template');
});
