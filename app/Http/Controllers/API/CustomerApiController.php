<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Package;
use App\Models\Quotation;
use App\Models\ServiceRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Bill;
use App\Models\PaymentHistory;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;

class CustomerApiController extends Controller
{
    /**
     * Get active ongoing services (Projects & Packages) for logged-in Customer
     * (Defensively programmed to bypass 504 eager-loading timeouts)
     */
    public function getOngoingServices(Request $request)
    {
        try {
            $customer = $request->user();

            // Fetch ongoing projects
            $ongoingProjects = Project::where('customer_id', $customer->id)
                ->whereIn('status', ['OnProgress', 'Pending'])
                ->get();

            // Fetch active packages without utilizing eager-loading 'with()'
            $activePackages = Package::where('customer_id', $customer->id)
                ->where('status', 'Active')
                ->get();

            // Manually map the plan inside the collection to bypass circular relation loops
            $activePackages->transform(function ($package) {
                // Manually fetch and attach the plan attribute
                $package->plan = \App\Models\Plan::find($package->plan_id);
                return $package;
            });

            return response()->json([
                'status' => 'success',
                'projects' => $ongoingProjects,
                'packages' => $activePackages
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve ongoing services: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all Quotations assigned to logged-in Customer
     */
    public function getQuotations(Request $request)
    {
        $customer = $request->user();

        $quotations = Quotation::with('service')
            ->where('customer_id', $customer->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'quotations' => $quotations
        ]);
    }

    /**
     * Get Customer's requested services history
     */
    public function getServiceRequests(Request $request)
    {
        $customer = $request->user();

        $requests = ServiceRequest::with(['service', 'quotation'])
            ->where('customer_id', $customer->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'service_requests' => $requests
        ]);
    }

     public function customerProfile(Request $request)
    {
        $customer = $request->user();

        return response()->json([
            'status' => 'success',
            'user' => $customer,
            'profile' => $customer // Returns both keys for safety
        ]);
    }

    /**
     * Customer submits a new service request (Updated to capture custom budget payload)
     */
    public function submitServiceRequest(Request $request)
    {
        $customer = $request->user();

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'service_id' => 'nullable|exists:services,id',
            'budgetInr' => 'nullable|numeric|min:0', // Validates React's budgetInr decimal payload
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $serviceRequest = ServiceRequest::create([
            'customer_id' => $customer->id,
            'service_id' => $request->service_id,
            'title' => $request->title,
            'description' => $request->description,
            'budget' => $request->budgetInr ?? 0.00, // Saves budget safely to the database column
            'status' => 'Pending',
        ]);

        // Refresh the record to fetch the newly auto-generated sequential service_request_id
        $serviceRequest->refresh();

        return response()->json([
            'status' => 'success',
            'message' => 'Service request submitted successfully.',
            'data' => $serviceRequest
        ], 201);
    }
     /**
     * Get all invoices (bills) belonging to the logged-in customer
     */
   public function getInvoices(Request $request)
    {
        $customer = $request->user();

        $invoices = Bill::where('customer_id', $customer->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Transform the collection to decode JSON elements and provide clean numeric fallbacks
        $invoices->transform(function ($invoice) {
            // Decodes the raw items JSON string into a structured PHP array/object for React mapping
            $invoice->decoded_items = json_decode($invoice->items) ?? [];

            // Explicitly cast or fallback amounts to ensure they render properly on the frontend
            $invoice->total = (float)($invoice->total ?? 0.00);
            $invoice->tax = (float)($invoice->tax ?? 0.00);
            $invoice->discount_amount = (float)($invoice->discount_amount ?? 0.00);

            // Calculate net_payable if it is blank or 0 in older rows
            $invoice->net_payable = (float)($invoice->net_payable > 0
                ? $invoice->net_payable
                : ($invoice->total + $invoice->tax - $invoice->discount_amount));

            return $invoice;
        });

        return response()->json([
            'status' => 'success',
            'invoices' => $invoices
        ]);
    }

    /**
     * Securely compile and download invoice PDF for the logged-in customer
     */
    public function downloadInvoicePdf(Request $request, $id)
    {
        try {
            $customer = $request->user();

            // Security check: Ensures a customer can only retrieve their own invoices
            $bill = Bill::where('customer_id', $customer->id)->findOrFail($id);
            $company = \App\Models\CompanyDetail::first();
            $paymentSettings = \App\Models\PaymentSetting::all();

            // Uses your existing print layout template
            $pdf = Pdf::loadView('admin.documents.bill-template', [
                'bill' => $bill,
                'customer' => $customer,
                'company' => $company,
                'paymentSettings' => $paymentSettings
            ]);

            return $pdf->download("Invoice-{$bill->id}-adzquare.pdf");

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to compile invoice PDF: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Initiate Payment: Creates a secure order via Razorpay API
     */
    public function initiatePayment(Request $request, $id)
    {
        $customer = $request->user();
        $bill = Bill::where('customer_id', $customer->id)->findOrFail($id);

        // Calculate remaining balance to be paid
        $dueAmount = max(0, $bill->net_payable - $bill->received_amount);

        if ($dueAmount <= 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'This invoice has already been fully paid.'
            ], 400);
        }

        // Razorpay accepts payments in "Paise" (1 INR = 100 Paise)
        $amountInPaise = round($dueAmount * 100);

        try {
            // Initiate Order Creation request directly to Razorpay's API
            $response = Http::withBasicAuth(
                config('services.razorpay.key_id', env('RAZORPAY_KEY_ID')),
                config('services.razorpay.key_secret', env('RAZORPAY_KEY_SECRET'))
            )->post('https://api.razorpay.com/v1/orders', [
                'receipt' => 'receipt_bill_' . $bill->id,
                'amount' => $amountInPaise,
                'currency' => 'INR',
            ]);

            if ($response->failed()) {
                throw new \Exception('Failed to communicate with Razorpay API.');
            }

            $orderData = $response->json();

            return response()->json([
                'status' => 'success',
                'razorpay_order_id' => $orderData['id'],
                'amount' => $orderData['amount'],
                'currency' => $orderData['currency'],
                'invoice_id' => $bill->id,
                'key_id' => env('RAZORPAY_KEY_ID'), // Passed to React to open checkout modal
                'customer_details' => [
                    'name' => $customer->name,
                    'email' => $customer->email,
                    'phone' => $customer->phone,
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Payment initialization failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Verify Payment Signature: Checks transaction validity and updates DB
     */
    public function verifyPayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'invoice_id' => 'required|exists:bills,id',
            'razorpay_payment_id' => 'required|string',
            'razorpay_order_id' => 'required|string',
            'razorpay_signature' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $paymentId = $request->razorpay_payment_id;
        $orderId = $request->razorpay_order_id;
        $signature = $request->razorpay_signature;
        $secret = env('RAZORPAY_KEY_SECRET');

        // Verify authenticity of signature using HMAC SHA256 (Razorpay Standard)
        $expectedSignature = hash_hmac("sha256", $orderId . '|' . $paymentId, $secret);

        if ($expectedSignature !== $signature) {
            return response()->json([
                'status' => 'error',
                'message' => 'Payment signature verification failed. Transaction unauthorized.'
            ], 400);
        }

        // Retrieve and update the bill record
        $bill = Bill::findOrFail($request->invoice_id);
        $dueAmount = max(0, $bill->net_payable - $bill->received_amount);

        // Register the successful payment in your 'payment_histories' table
        PaymentHistory::create([
            'bill_id' => $bill->id,
            'received_amount' => $dueAmount,
            'payment_method' => 'RAZORPAY',
            'notes' => 'Payment processed securely via Razorpay API (Ref: ' . $paymentId . ')',
        ]);

        // Increment received amount and dynamically evaluate pay status
        $bill->increment('received_amount', $dueAmount);
        $bill->refresh();

        if ($bill->received_amount >= $bill->net_payable) {
            $bill->payment_status = 'Paid';
            $bill->save();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Payment processed and verified successfully.',
            'data' => $bill
        ], 200);
    }

    /**
     * Get mock AI insights for the React Customer dashboard
     */
    public function getAiInsights()
    {
        return response()->json([
            'status' => 'success',
            'insights' => [
                'recommendations' => [
                    'Track active project milestones directly from your dashboard.',
                    'Review and clear unpaid invoices using secure online payments.',
                    'Need assistance? Schedule a support call with our dedicated team.'
                ]
            ]
        ]);
    }

    /**
     * Update customer profile details (Supports both 'profile' and 'profile_base64' keys)
     */
    public function updateProfile(Request $request)
    {
        $customer = $request->user();

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|string|max:255|unique:customers,email,' . $customer->id,
            'phone' => 'nullable|string|max:20|unique:customers,phone,' . $customer->id,
            'company' => 'nullable|string|max:255',     // Aligned with React's "company" key
            'website' => 'nullable|string|max:255',
            'avatar' => 'nullable|string',              // Aligned with React's "avatar" key
            'profile' => 'nullable|string',
            'profile_base64' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Dynamically update text fields
        if ($request->filled('name')) $customer->name = $request->name;
        if ($request->filled('email')) $customer->email = $request->email;
        if ($request->filled('phone')) $customer->phone = $request->phone;
        if ($request->filled('company')) $customer->company_name = $request->company; // Map "company" to DB "company_name"
        if ($request->filled('website')) $customer->website = $request->website;

        // Smart Dual-Field Base64 Image Parser (Interpreting React's "avatar" key)
        $imageData = $request->input('avatar') ?? $request->input('profile') ?? $request->input('profile_base64');

        // Check if the received string is indeed a Base64 Data URI
        if ($imageData && (str_starts_with($imageData, 'data:image') || preg_match('/^data:image\/(\w+);base64,/', $imageData))) {
            try {
                // Strip the base64 prefix if present (e.g., "data:image/png;base64,...")
                if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
                    $imageData = substr($imageData, strpos($imageData, ',') + 1);
                    $type = strtolower($type[1]); // png, jpg, jpeg, webp

                    if (!in_array($type, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
                        throw new \Exception('Invalid image type.');
                    }
                    $imageData = base64_decode($imageData);
                } else {
                    throw new \Exception('Invalid base64 format.');
                }

                $fileName = time() . '_' . uniqid() . '.' . $type;
                $destinationPath = public_path('admin/customers');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                // Save decoded image binary directly to storage
                file_put_contents($destinationPath . '/' . $fileName, $imageData);

                // Delete old profile picture from server if it exists
                if ($customer->profile && file_exists(public_path('admin/customers/' . $customer->profile))) {
                    unlink(public_path('admin/customers/' . $customer->profile));
                }

                // Save the generated filename to the database profile column
                $customer->profile = $fileName;

            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to process profile image: ' . $e->getMessage()
                ], 400);
            }
        }

        $customer->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Profile updated successfully.',
            'profile' => $customer // <-- Aligned with React's "res.profile" expectation
        ]);
    }
}
