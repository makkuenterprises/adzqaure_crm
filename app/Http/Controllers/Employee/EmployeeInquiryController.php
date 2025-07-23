<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inquiry;

class EmployeeInquiryController extends Controller
{

    public function index()
    {
        $inquiries = \App\Models\Inquiry::latest()->paginate(10); // Optional: change to all() if needed
        return view('employee.inquiries.index', compact('inquiries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'nullable|email|max:255',
            'phone'   => 'required|string|max:20',
            'company' => 'nullable|string|max:255',
            'message' => 'nullable|string',
        ]);

        Inquiry::create($request->only('name', 'email', 'phone', 'company', 'message'));

        return redirect()->back()->with('success', 'Your inquiry has been submitted successfully.');
    }

}
