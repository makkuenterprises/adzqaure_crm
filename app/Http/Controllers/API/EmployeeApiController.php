<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceRequest;
use App\Models\Service;
use App\Models\Quotation;
use Illuminate\Support\Facades\Validator;

class EmployeeApiController extends Controller
{
    /**
     * Get all Customer Service Requests (For Employees)
     */
    /**
     * Get all Customer Service Requests (With Debug Info)
     */
    public function getServiceRequests(Request $request)
    {
        try {
            $requests = ServiceRequest::with(['customer', 'service', 'quotation'])
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'status' => 'success',
                'service_requests' => $requests
            ]);

        } catch (\Exception $e) {
            // This returns the exact SQL or PHP error message directly to your browser
            return response()->json([
                'status' => 'error',
                'debug_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 500);
        }
    }

    /**
     * Employee replies to a specific service request
     */
    public function replyToServiceRequest(Request $request, $id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:Pending,In-Progress,Quoted,Completed,Declined',
            'employee_remarks' => 'nullable|string|max:2000',
            'quotation_id' => 'nullable|exists:quotations,id' // Optionally link a quotation
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $serviceRequest->update([
            'status' => $request->status,
            'employee_remarks' => $request->employee_remarks,
            'quotation_id' => $request->quotation_id ?? $serviceRequest->quotation_id,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Service request updated successfully.',
            'data' => $serviceRequest
        ]);
    }

    /**
     * Get available services for Quotation generation dropdowns
     */
    public function getServicesList()
    {
        $services = Service::select('id', 'service_name', 'service_category_id', 'service_price_in_inr')
            ->orderBy('service_name')
            ->get();

        return response()->json([
            'status' => 'success',
            'services' => $services
        ]);
    }

    /**
     * Employee generates a new Quotation
     */
    public function createQuotation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customers,id',
            'service_category_id' => 'required|exists:service_categories,id',
            'service_id' => 'required|exists:services,id',
            'quotation_amount' => 'required|numeric|min:0',
            'content' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $quotation = Quotation::create($request->only([
            'customer_id',
            'service_category_id',
            'service_id',
            'quotation_amount',
            'content',
        ]));

        return response()->json([
            'status' => 'success',
            'message' => 'Quotation generated successfully.',
            'quotation' => $quotation
        ], 201);
    }

    /**
     * Get mock AI insights for the React dashboard
     */
    public function getAiInsights()
    {
        return response()->json([
            'status' => 'success',
            'insights' => [
                'recommendations' => [
                    'Review and process pending customer service requests.',
                    'Check attendance reports before initiating next monthly payroll.',
                    'Follow up with accounts containing unpaid invoices.'
                ]
            ]
        ]);
    }
}
