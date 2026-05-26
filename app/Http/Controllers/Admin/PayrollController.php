<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\PayrollSetting;
use App\Models\Attendance;
use App\Models\Payslip;
use App\Models\CompanyDetail;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;

class PayrollController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * 1. Display Salary Settings for each Employee
     */
    public function salarySettings()
    {
        $employees = Employee::whereIn('status', [1, true, '1'])
            ->with('payrollSetting')
            ->orderBy('name')
            ->paginate(10);

        return view('admin.sections.payroll.salary-settings', compact('employees'));
    }

    /**
     * Update/Save Salary Configurations
     */
    public function updateSalarySettings(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'basic_salary' => 'required|numeric|min:0',
            'allowances' => 'required|numeric|min:0',
            'deductions' => 'required|numeric|min:0',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        PayrollSetting::updateOrCreate(
            ['employee_id' => $id],
            [
                'basic_salary' => $request->basic_salary,
                'allowances' => $request->allowances,
                'deductions' => $request->deductions,
            ]
        );

        return redirect()->back()->with('message', [
            'status' => 'success',
            'title' => 'Salary Configuration Saved',
            'description' => 'Employee salary configuration has been successfully updated.'
        ]);
    }

    /**
     * 2. View Monthly Generated Payslips List
     */
    public function payslips(Request $request)
    {
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);

        $payslips = Payslip::with('employee')
            ->where('month', $month)
            ->where('year', $year)
            ->get();

        return view('admin.sections.payroll.payslips', compact('payslips', 'month', 'year'));
    }

    /**
     * 3. Single-Click Generation Logic
     */
    /**
     * 3. Single-Click Generation Logic (Updated with Pro-Rata Allowances and Auto LOP)
     */
    public function generate(Request $request)
    {
        $request->validate([
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer',
        ]);

        $month = $request->month;
        $year = $request->year;

        $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth();
        $daysInMonth = $startDate->daysInMonth;

        $employees = Employee::whereIn('status', [1, true, '1'])
            ->with(['payrollSetting', 'attendances' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('date', [$startDate->toDateString(), $endDate->toDateString()]);
            }])->get();

        $processed = 0;

        foreach ($employees as $employee) {
            $settings = $employee->payrollSetting;
            if (!$settings || $settings->basic_salary <= 0) {
                continue; // Skip employees who don't have active salary configurations
            }

            // Tally marked attendance days
            $pCount = 0; $aCount = 0; $hdCount = 0; $plCount = 0; $hCount = 0;
            foreach ($employee->attendances as $att) {
                switch ($att->status) {
                    case 'Present': $pCount++; break;
                    case 'Absent': $aCount++; break;
                    case 'Half-Day': $hdCount++; break;
                    case 'Leave_Paid': $plCount++; break;
                    case 'Holiday': $hCount++; break;
                }
            }

            // Payable Days calculation (Present + Half-Days(0.5) + Paid Leaves + Holidays)
            $payableDays = $pCount + ($hdCount * 0.5) + $plCount + $hCount;

            // Total Gross Rate = Basic Salary + Allowances
            $totalMonthlyRate = $settings->basic_salary + $settings->allowances;

            // Calculate pro-rata earned gross based strictly on Present/Payable Days
            $dailyRate = $totalMonthlyRate / $daysInMonth;
            $earnedGross = $dailyRate * $payableDays;

            // Net payable calculation (Earned Gross - Deductions)
            $netSalary = $earnedGross - $settings->deductions;
            if ($netSalary < 0) $netSalary = 0;

            // Any day of the month without positive attendance is treated as Loss of Pay (LOP)
            $lopDays = $daysInMonth - $payableDays;

            Payslip::updateOrCreate(
                ['employee_id' => $employee->id, 'month' => $month, 'year' => $year],
                [
                    'basic_salary' => $settings->basic_salary,
                    'allowances' => $settings->allowances,
                    'deductions' => $settings->deductions,
                    'net_salary' => round($netSalary, 2),
                    'total_days' => $daysInMonth,
                    'present_days' => $pCount,
                    'absent_days' => $lopDays, // Save calculated LOP days here
                    'half_days' => $hdCount,
                    'paid_leaves' => $plCount + $hCount,
                    'status' => 'Unpaid'
                ]
            );

            $processed++;
        }

        return redirect()->back()->with('message', [
            'status' => 'success',
            'title' => 'Payslips Processed',
            'description' => "Calculated and updated payslips for {$processed} employees."
        ]);
    }
    
    /**
     * 4. Compile dynamic PDF payslips using the custom design layout
     */
    public function downloadPayslip($id)
    {
        $payslip = Payslip::with('employee')->findOrFail($id);
        $company = CompanyDetail::first();

        $pdf = Pdf::loadView('admin.documents.payslip-template', compact('payslip', 'company'));
        return $pdf->download("Payslip-{$payslip->employee->name}-{$payslip->month}-{$payslip->year}.pdf");
    }
}
