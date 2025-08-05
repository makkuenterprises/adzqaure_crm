<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\MetaIntegrationController;
use App\Http\Controllers\Auth\CommonAuthController;
use App\Exports\GlobalExport;
use App\Models\Admin;
use Maatwebsite\Excel\Facades\Excel;
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

    return view('website.welcome');
})->name('main');

Route::get('store', function () {

    return view('website.store');
})->name('store');

Route::get('privacy-policy', function () {

    return view('website.privacy-policy');
})->name('privacy-policy');

Route::get('terms-of-service', function () {

    return view('website.terms-of-service');
})->name('terms-of-service');

// AFTER (Working)
Route::get('/seo-sem', function () {
    return view('website.services.seo-sem');
})->name('seo-sem');

Route::get('/social-media-marketing', function () {
        return view('website.services.smm');
    })->name('social-media-marketing');

Route::get('/precision-paid-advertising', function () {
        return view('website.services.ppc');
    })->name('precision-paid-advertising');

Route::get('/direct-engagement-lead-generation', function () {
        return view('website.services.lead-generation');
    })->name('direct-engagement-lead-generation');

 Route::get('/it-solutions-cloud', function () {
        return view('website.services.it-solutions');
    })->name('it-solutions-cloud');

Route::redirect('/login', '/');
Auth::routes(['login' => false, 'register' => false]);

Route::get('setup', function () {
    Artisan::call('migrate');
    Artisan::call('db:seed');
    Artisan::call('storage:link');
    dd('Application Setup Completed');
});

Route::get('generate-key', function () {
    Artisan::call('key:generate');
    dd('Application Key Generated Successfully');
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

Route::get('/refresh-migrate', function () {
    Artisan::call('migrate:fresh --seed');
    return 'Database migrated and seeded successfully!';
});

// Route to initiate the connection
Route::get('/meta/connect', [MetaIntegrationController::class, 'redirectToMeta'])->name('meta.connect');

// Route to handle the callback from Meta
Route::get('/meta/callback', [MetaIntegrationController::class, 'handleMetaCallback'])->name('meta.callback');




Route::post('/inquiry', [InquiryController::class, 'store'])->name('inquiry.store');

Route::get('login', [CommonAuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [CommonAuthController::class, 'login']);
Route::get('register', [CommonAuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [CommonAuthController::class, 'register']);


Route::get('/admin/export/excel', function (\Illuminate\Http\Request $request) {
    $modelClass = $request->get('model'); // e.g., App\Models\LeadsManager
    $fields     = explode(',', $request->get('fields')); // e.g., id,name,email
    $from       = $request->get('from_date');
    $to         = $request->get('to_date');

    if (!class_exists($modelClass)) {
        abort(404, 'Model not found');
    }

    $query = $modelClass::query();

    if ($from) $query->whereDate('created_at', '>=', $from);
    if ($to)   $query->whereDate('created_at', '<=', $to);

    $records = $query->get($fields);

    $headers = array_map('ucfirst', $fields);
    $rows = $records->map(fn($item) => $item->only($fields))->values()->toArray();

    return Excel::download(new GlobalExport('admin.exports.table', [
        'headers' => $headers,
        'rows'    => $rows,
    ]), class_basename($modelClass) . '_export.xlsx');
})->name('global.export.excel'); // ✅ THIS is required

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



Route::middleware(['auth', 'type:customer'])->get('customer/dashboard', function () {
    // Correctly points to 'resources/views/customers/dashboard.blade.php'
    return view('customer.dashboard');
})->name('customer.dashboard');

Route::middleware(['auth', 'type:service_provider'])->get('service_provider/dashboard', function () {
    // return view('service_provider.dashboard');
    return "service_provider.dashboard";
})->name('service_provider.dashboard');

Route::middleware(['auth', 'type:partner'])->get('partner/dashboard', function () {
    // return view('partner.dashboard');
    return "Partner dashboard";
})->name('partner.dashboard');


Route::get('/super-secret-token-fix/{secretKey}', function ($secretKey) {

    // 1. Define a SIMPLE, plain text secret key.
    // ** CHANGE THIS to something simple you can remember and type. **
    $correctSecretKey = 'FixMyTokenNow123';

    if ($secretKey != $correctSecretKey) {
        return response('Unauthorized. The secret key in the URL is wrong.', 403);
    }

    // 2. Paste your PLAIN TEXT permanent System User token here.
    // ** THIS MUST BE THE TOKEN FROM META, STARTING WITH EAA... **
    //https://adzquare.in/super-secret-token-fix/FixMyTokenNow123
    $permanentToken = 'EAALLH1hfXSUBPFZAZCFaIj9K1uWIegbfACZCLCHourZBBXvVUSt9tccZBFMAIgdC1jFtOZC3U7JbezLj3roN1Qt4nPEyxt4aHabToc0EgVE5WluZAdeutFMZBhpyFRpSpkEsJDZAfepM5WeFoRr5wCPPT5abPkwdta5QXRo413tVeeW1uy3xgbPGB28SZBbG57Cwt77QZDZD';

    // 3. Define the admin ID.
    $adminId = 100001;

    try {
        $admin = Admin::findOrFail($adminId);

        // 4. Encrypt the PLAIN TEXT token and save it.
        $admin->whatsapp_access_token = encrypt($permanentToken);
        $admin->save();

        // 5. Return a success message.
        return response('SUCCESS: The PLAIN TEXT token has been correctly encrypted and saved for Admin ID: ' . $adminId);

    } catch (\Exception $e) {
        return response('An error occurred: ' . $e->getMessage(), 500);
    }
});
