<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ApiAuthController extends Controller
{
    /**
     * Dispatch OTP to user's email during Registration request
     */
    public function sendRegistrationOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $otp = rand(100000, 999999);

        // Record or update the OTP in DB logs
        DB::table('email_otps')->updateOrInsert(
            ['email' => $request->email],
            [
                'otp' => Hash::make($otp),
                'created_at' => Carbon::now()
            ]
        );

        Log::info("Adzsquare Registration OTP for {$request->email} is: {$otp}");

        // Unleashed/Uncommented Mailer Block
        try {
            Mail::raw("Your Adzsquare account onboarding verification code is: {$otp}", function($message) use ($request) {
                $message->to($request->email)->subject('Adzsquare Verification Pin');
            });
        } catch (\Exception $e) {
            Log::error("Mail dispatch exception: " . $e->getMessage());
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Onboarding code dispatched successfully.'
        ], 200);
    }

    /**
     * Verify registration OTP and create customer profile
     */
    public function verifyAndRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|max:255|unique:customers,email',
            'company_name' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'service_type' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:2000',
            'otp' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $otpRecord = DB::table('email_otps')->where('email', $request->email)->first();

        if (!$otpRecord || Carbon::parse($otpRecord->created_at)->addMinutes(15)->isPast()) {
            return response()->json([
                'status' => 'error',
                'message' => 'The verification pin has expired. Please request a new one.'
            ], 422);
        }

        if (!Hash::check($request->otp, $otpRecord->otp)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid verification pin.'
            ], 422);
        }

        DB::table('email_otps')->where('email', $request->email)->delete();

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'company_name' => $request->company_name ?? '',
            'website' => $request->website ?? '',
            'password' => Hash::make(rand(1000000, 9999999)),
        ]);

        $token = $customer->createToken('customer_api_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Profile onboarding completed successfully.',
            'token' => $token,
            'profile' => $customer,
            'user' => [
                'id' => $customer->id,
                'name' => $customer->name,
                'email' => $customer->email,
                'company_name' => $customer->company_name,
                'type' => 'customer'
            ]
        ], 211);
    }

    /**
     * Dispatch OTP to user's email during Login request
     */
    public function sendLoginOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $customer = Customer::where('email', $request->email)->first();
        if (!$customer) {
            return response()->json([
                'status' => 'error',
                'message' => 'No workspace account linked to this email address.'
            ], 404);
        }

        $otp = rand(100000, 999999);

        DB::table('email_otps')->updateOrInsert(
            ['email' => $request->email],
            [
                'otp' => Hash::make($otp),
                'created_at' => Carbon::now()
            ]
        );

        Log::info("Adzsquare Login OTP for {$request->email} is: {$otp}");

        // Unleashed/Uncommented Mailer Block
        try {
            Mail::raw("Your Adzsquare verification login code is: {$otp}", function($message) use ($request) {
                $message->to($request->email)->subject('Adzsquare Verification Login Code');
            });
        } catch (\Exception $e) {
            Log::error("Mail dispatch exception: " . $e->getMessage());
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Login pin dispatched successfully.'
        ], 200);
    }

    /**
     * Verify login OTP and return active session token
     */
    public function verifyLoginOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|string|max:255',
            'otp' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $otpRecord = DB::table('email_otps')->where('email', $request->email)->first();

        if (!$otpRecord || Carbon::parse($otpRecord->created_at)->addMinutes(15)->isPast()) {
            return response()->json([
                'status' => 'error',
                'message' => 'The login code has expired. Please try again.'
            ], 422);
        }

        if (!Hash::check($request->otp, $otpRecord->otp)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid login verification code.'
            ], 422);
        }

        DB::table('email_otps')->where('email', $request->email)->delete();

        $customer = Customer::where('email', $request->email)->firstOrFail();
        $token = $customer->createToken('customer_api_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Login verification successful.',
            'token' => $token,
            'profile' => $customer,
            'user' => [
                'id' => $customer->id,
                'name' => $customer->name,
                'email' => $customer->email,
                'company_name' => $customer->company_name,
                'type' => 'customer'
            ]
        ], 200);
    }

    /**
     * Existing Customer Login API (Supported fallback)
     */
    public function customerLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $customer = Customer::where('email', $request->email)->first();

        if (!$customer || !Hash::check($request->password, $customer->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid email or password.'
            ], 401);
        }

        $token = $customer->createToken('customer_api_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Customer logged in successfully.',
            'token' => $token,
            'user' => [
                'id' => $customer->id,
                'name' => $customer->name,
                'email' => $customer->email,
                'company_name' => $customer->company_name,
                'type' => 'customer'
            ]
        ], 200);
    }

    /**
     * Existing Employee Login API (Supported fallback)
     */
    public function employeeLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $employee = Employee::where('email', $request->email)->first();

        if (!$employee || !Hash::check($request->password, $employee->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid email or password.'
            ], 401);
        }

        $token = $employee->createToken('employee_api_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Employee logged in successfully.',
            'token' => $token,
            'user' => [
                'id' => $employee->id,
                'employee_id' => $employee->employee_id,
                'name' => $employee->name,
                'email' => $employee->email,
                'designation' => $employee->designation,
                'type' => 'employee'
            ]
        ], 200);
    }

    /**
     * Get Authenticated Customer Profile
     */
    public function customerProfile(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'user' => $request->user(),
            'profile' => $request->user()
        ]);
    }

    /**
     * Get Authenticated Employee Profile
     */
    public function employeeProfile(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'user' => $request->user()
        ]);
    }

    /**
     * Generic API Logout (Revokes current token)
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Token revoked successfully.'
        ], 200);
    }
}
