<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiAuthController;
use App\Http\Controllers\API\CustomerApiController;
use App\Http\Controllers\API\EmployeeApiController;
use App\Http\Controllers\API\ChatApiController;
use App\Http\Controllers\API\CallBookingApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {

    // Public Authentication Endpoints
    Route::post('/customer/login', [ApiAuthController::class, 'customerLogin']);
    Route::post('/employee/login', [ApiAuthController::class, 'employeeLogin']);

    // Protected Endpoints (Requires sanctum Bearer Token)
    Route::middleware('auth:sanctum')->group(function () {

        // Profiles & Logout
        Route::get('/customer/profile', [ApiAuthController::class, 'customerProfile']);
        Route::get('/employee/profile', [ApiAuthController::class, 'employeeProfile']);
        Route::post('/logout', [ApiAuthController::class, 'logout']);

        // --- CUSTOMER PANEL API ENDPOINTS ---
        Route::prefix('customer')->group(function () {
            Route::get('/ongoing-services', [CustomerApiController::class, 'getOngoingServices']);
            Route::get('/quotations', [CustomerApiController::class, 'getQuotations']);
            Route::get('/service-requests', [CustomerApiController::class, 'getServiceRequests']);
            Route::post('/service-requests', [CustomerApiController::class, 'submitServiceRequest']);

            Route::get('/invoices', [CustomerApiController::class, 'getInvoices']);
            Route::post('/invoices/{id}/pay', [CustomerApiController::class, 'initiatePayment']);
            Route::post('/invoices/payment/verify', [CustomerApiController::class, 'verifyPayment']);

            Route::post('/profile/update', [CustomerApiController::class, 'updateProfile'])->name('customer.profile.update');

            // Customer Chat System
            Route::get('/chat/messages', [ChatApiController::class, 'getCustomerMessages']);
            Route::post('/chat/messages', [ChatApiController::class, 'sendCustomerMessage']);

            // Customer Call Bookings
            Route::get('/call-bookings', [CallBookingApiController::class, 'getCustomerBookings']);
            Route::post('/call-bookings', [CallBookingApiController::class, 'bookCall']);

            Route::get('/ai-insights', [CustomerApiController::class, 'getAiInsights']);
            Route::get('/invoices/download/{id}', [CustomerApiController::class, 'downloadInvoicePdf'])->name('customer.invoice.download');
        });

        // --- EMPLOYEE PANEL API ENDPOINTS ---
        Route::prefix('employee')->group(function () {
            Route::get('/service-requests', [EmployeeApiController::class, 'getServiceRequests']);
            Route::post('/service-requests/{id}/reply', [EmployeeApiController::class, 'replyToServiceRequest']);
            Route::get('/services', [EmployeeApiController::class, 'getServicesList']);
            Route::post('/quotations', [EmployeeApiController::class, 'createQuotation']);

            // Mapped to match React's exact '/employee/rooms' request path
            Route::get('/rooms', [ChatApiController::class, 'getEmployeeChatRooms']);
            Route::get('/chat/rooms', [ChatApiController::class, 'getEmployeeChatRooms']);
            Route::get('/chat/messages/{customer_id}', [ChatApiController::class, 'getEmployeeMessages']);
            Route::post('/chat/messages/{customer_id}', [ChatApiController::class, 'sendEmployeeMessage']);

            // Mapped to match React's exact '/employee/call-bookings' request path
            Route::get('/call-bookings', [CallBookingApiController::class, 'getEmployeeBookings']);
            Route::post('/call-bookings/{id}/status', [CallBookingApiController::class, 'updateBookingStatus']);

            Route::get('/ai-insights', [EmployeeApiController::class, 'getAiInsights']);
        });

    });

});
