<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiAuthController;
use App\Http\Controllers\API\CustomerApiController;
use App\Http\Controllers\API\EmployeeApiController;
use App\Http\Controllers\API\ChatApiController;
use App\Http\Controllers\API\CallBookingApiController;
use App\Http\Controllers\API\NotificationApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {

    // --- PUBLIC AUTHENTICATION ---
    // Used by Mobile App login screens to authenticate and receive Sanctum tokens
    Route::post('/customer/login', [ApiAuthController::class, 'customerLogin']);
    Route::post('/employee/login', [ApiAuthController::class, 'employeeLogin']);

    // --- PROTECTED ROUTES ---
    Route::middleware('auth:sanctum')->group(function () {

        // --- SESSION & IDENTITY ---
        // Used to maintain user session, update profile avatars, and revoke access (Logout)
        Route::get('/customer/profile', [ApiAuthController::class, 'customerProfile']);
        Route::get('/employee/profile', [ApiAuthController::class, 'employeeProfile']);
        Route::post('/logout', [ApiAuthController::class, 'logout']);

        // --- MOBILE APP INFRASTRUCTURE ---
        // Used for Push Notifications and checking if app needs an update
        Route::get('/app-config', [ApiAuthController::class, 'getAppConfig']);
        // Route::post('/notifications/device-token', [NotificationApiController::class, 'saveDeviceToken']);
        // Route::get('/notifications', [NotificationApiController::class, 'index']);
        // Route::post('/notifications/mark-read', [NotificationApiController::class, 'markAsRead']);

        // --- CUSTOMER PANEL API ---
        Route::prefix('customer')->group(function () {
            // Dashboard: Fetches active projects/packages, AI insights, and small summary stats for fast mobile loading
            Route::get('/ongoing-services', [CustomerApiController::class, 'getOngoingServices']);
            Route::get('/stats-summary', [CustomerApiController::class, 'getStatsSummary']);
            Route::get('/ai-insights', [CustomerApiController::class, 'getAiInsights']);
            Route::post('/profile/update', [CustomerApiController::class, 'updateProfile']);

            // Billing: Displays invoices, generates Razorpay orders for payments, and downloads PDFs
            Route::get('/quotations', [CustomerApiController::class, 'getQuotations']);
            Route::get('/invoices', [CustomerApiController::class, 'getInvoices']);
            Route::get('/invoices/download/{id}', [CustomerApiController::class, 'downloadInvoicePdf']);
            Route::post('/invoices/{id}/pay', [CustomerApiController::class, 'initiatePayment']);
            Route::post('/invoices/payment/verify', [CustomerApiController::class, 'verifyPayment']);

            // Support: Submitting tickets, Chatting, and Scheduling calls
            Route::get('/service-requests', [CustomerApiController::class, 'getServiceRequests']);
            Route::post('/service-requests', [CustomerApiController::class, 'submitServiceRequest']);
            Route::get('/chat/messages', [ChatApiController::class, 'getCustomerMessages']);
            Route::post('/chat/messages', [ChatApiController::class, 'sendCustomerMessage']);
            Route::get('/call-bookings', [CallBookingApiController::class, 'getCustomerBookings']);
            Route::post('/call-bookings', [CallBookingApiController::class, 'bookCall']);
        });

        // --- EMPLOYEE PANEL API ---
        Route::prefix('employee')->group(function () {
            // Dashboard: Metrics, AI recommendations, and Service selection lists
            Route::get('/ai-insights', [EmployeeApiController::class, 'getAiInsights']);
            Route::get('/services', [EmployeeApiController::class, 'getServicesList']);

            // Workflow: Managing tickets (replying) and generating formal Quotations
            Route::get('/service-requests', [EmployeeApiController::class, 'getServiceRequests']);
            Route::post('/service-requests/{id}/reply', [EmployeeApiController::class, 'replyToServiceRequest']);
            Route::post('/quotations', [EmployeeApiController::class, 'createQuotation']);

            // Communications: Real-time chat (rooms & messages) and scheduling/managing customer calls
            Route::get('/rooms', [ChatApiController::class, 'getEmployeeChatRooms']);
            Route::get('/chat/rooms', [ChatApiController::class, 'getEmployeeChatRooms']);
            Route::get('/chat/messages/{customer_id}', [ChatApiController::class, 'getEmployeeMessages']);
            Route::post('/chat/messages/{customer_id}', [ChatApiController::class, 'sendEmployeeMessage']);
            Route::get('/call-bookings', [CallBookingApiController::class, 'getEmployeeBookings']);
            Route::post('/call-bookings/{id}/status', [CallBookingApiController::class, 'updateBookingStatus']);
        });
    });
});
