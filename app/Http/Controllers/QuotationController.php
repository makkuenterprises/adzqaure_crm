<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\CompanyDetail;
use App\Models\Customer;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuotationController extends Controller
{
    /** View Quotation List **/
    public function viewQuotationList()
    {
        $quotations = Quotation::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.sections.quotation.quotation-list', compact('quotations'));
    }

    /** View Quotation Create **/
    public function viewQuotationCreate()
    {
        $customers = Customer::where('status', true)->get();
        $serviceCategories = ServiceCategory::orderBy('name')->get();
        $services = Service::orderBy('service_name')->get();

        $allServicesGrouped = $services->groupBy('service_category_id');

        return view('admin.sections.quotation.quotation-create', compact(
            'customers', 'serviceCategories', 'services', 'allServicesGrouped'
        ));
    }

    /** View Quotation Update **/
    public function viewQuotationUpdate($id)
    {
        $quotation = Quotation::findOrFail($id);
        $customers = Customer::where('status', true)->get();
        $serviceCategories = ServiceCategory::orderBy('name')->get();
        $services = Service::orderBy('service_name')->get();

        $allServicesGrouped = $services->groupBy('service_category_id');

        return view('admin.sections.quotation.quotation-update', compact(
            'quotation', 'customers', 'serviceCategories', 'services', 'allServicesGrouped'
        ));
    }

    /** Handle Quotation Create **/
    public function handleQuotationCreate(Request $request)
    {
    $validation = Validator::make($request->all(), [
        'customer_id' => 'required|exists:customers,id',
        'service_category_id' => 'required|exists:service_categories,id',
        'service_id' => 'required|exists:services,id',
        'quotation_amount' => 'required|numeric',
        'content' => 'nullable|string',
    ]);

    if ($validation->fails()) {
        return redirect()->back()->withErrors($validation)->withInput();
    }

    $quotation = Quotation::create($request->only([
        'customer_id',
        'service_category_id',
        'service_id',
        'quotation_amount',
        'content',
    ]));

    return redirect()->route('admin.view.quotation.list')->with('message', [
        'status' => 'success',
        'title' => 'Quotation Created',
        'description' => 'Quotation successfully created.'
    ]);
    }

    /** Handle Quotation Update **/
    public function handleQuotationUpdate(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customers,id',
            'service_category_id' => 'required|exists:service_categories,id',
            'service_id' => 'required|exists:services,id',
            'quotation_amount' => 'required|numeric',
            'content' => 'nullable|string',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $quotation = Quotation::findOrFail($id);
        $quotation->update($request->only([
            'customer_id',
            'service_category_id',
            'service_id',
            'quotation_amount',
            'content',
        ]));

        return redirect()->route('admin.view.quotation.list')->with('message', [
            'status' => 'success',
            'title' => 'Quotation Updated',
            'description' => 'Quotation successfully updated.'
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Handle Bill Delete
    |--------------------------------------------------------------------------
    */
    public function handleQuotationDelete($id)
    {
        $quotation = Quotation::find($id);
        $quotation->delete();
        return redirect()->back()->with('message', [
            'status' => 'success',
            'title' => 'Quotation Deleted',
            'description' => 'The Quotation is successfully deleted'
        ]);
    }


    /** View Bill Invoice Download **/
       /**
     * Generate and download a PDF for a specific quotation.
     *
     * @param int $id The ID of the quotation.
     * @return \Illuminate\Http\Response
     */
    public function handleQuotationDownload($id)
    {
        try {
            $quotation = Quotation::with('customer', 'service')->findOrFail($id);
            $company = CompanyDetail::first();

            // This now loads your NEW, empty template
            $pdf = PDF::loadView('admin.documents.quotation-template', compact('quotation', 'company'));

            $customerName = optional($quotation->customer)->name ?? 'customer';
            $fileName = 'Quotation-' . $quotation->id . '-adzquare-' . str_replace(' ', '-', strtolower($customerName)) . '.pdf';

            return $pdf->download($fileName);

        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

}
