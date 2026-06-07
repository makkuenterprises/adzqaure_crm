<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Attendance;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display daily attendance checklist.
     */
    public function index(Request $request)
    {
        // Default to today's date if no date is specified
        $selectedDate = $request->input('date', Carbon::today()->toDateString());
        $date = Carbon::parse($selectedDate);

        // Fetch all active employees
        $employees = Employee::where('status', true)->orderBy('name')->get();

        // Get already marked attendance for this day
        $markedAttendance = Attendance::whereDate('date', $date)
            ->get()
            ->keyBy('employee_id');

        return view('admin.sections.payroll.attendance', compact('employees', 'date', 'markedAttendance'));
    }

    /**
     * Save/Update bulk attendance for a selected date.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'date' => 'required|date',
            'status' => 'required|array',
            'status.*' => 'required|in:Present,Absent,Half-Day,Leave_Paid,Holiday',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $date = $request->input('date');

        foreach ($request->input('status') as $employeeId => $statusVal) {
            Attendance::updateOrCreate(
                ['employee_id' => $employeeId, 'date' => $date],
                ['status' => $statusVal]
            );
        }

        return redirect()->back()->with('message', [
            'status' => 'success',
            'title' => 'Attendance Saved',
            'description' => 'Daily attendance recorded successfully for ' . Carbon::parse($date)->format('d M Y') . '.'
        ]);
    }

    /**
 * Display a monthly attendance grid report.
 */
public function report(Request $request)
{
    // Default to current month and year
    $month = $request->input('month', Carbon::now()->month);
    $year = $request->input('year', Carbon::now()->year);

    $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
    $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth();
    $daysInMonth = $startDate->daysInMonth;

    // Fetch active employees
    $employees = Employee::whereIn('status', [1, true, '1'])->orderBy('name')->get();

    // Fetch all attendance records for this month with a single query (optimized)
    $attendances = Attendance::whereBetween('date', [$startDate->toDateString(), $endDate->toDateString()])
        ->get()
        ->groupBy([
            'employee_id',
            function ($item) {
                return Carbon::parse($item->date)->day; // Group dynamically by calendar day number
            }
        ]);

    return view('admin.sections.payroll.attendance-report', compact('employees', 'attendances', 'month', 'year', 'daysInMonth', 'startDate'));
}

public function downloadReportPdf(Request $request)
{
    $month = $request->input('month', Carbon::now()->month);
    $year = $request->input('year', Carbon::now()->year);

    $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
    $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth();
    $daysInMonth = $startDate->daysInMonth;

    // Fetch active employees
    $employees = Employee::whereIn('status', [1, true, '1'])->orderBy('name')->get();

    // Fetch attendance using composite key indexing
    $attendances = Attendance::whereBetween('date', [$startDate->toDateString(), $endDate->toDateString()])
        ->get()
        ->keyBy(function ($item) {
            return $item->employee_id . '_' . Carbon::parse($item->date)->day;
        });

    // Load custom landscape print view
    $pdf = Pdf::loadView('admin.documents.attendance-report-pdf', compact(
        'employees', 'attendances', 'month', 'year', 'daysInMonth', 'startDate'
    ))->setPaper('a4', 'landscape');

    $monthName = $startDate->format('F');
    return $pdf->download("Attendance-Report-{$monthName}-{$year}.pdf");
}

/**
 * Render the bulk attendance form.
 */
public function viewBulk()
{
    // Fetch active employees
    $employees = Employee::whereIn('status', [1, true, '1'])->orderBy('name')->get();

    return view('admin.sections.payroll.attendance-bulk', compact('employees'));
}

/**
 * Process and save bulk attendance records for a date range.
 */
public function storeBulk(Request $request)
{
    $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'employee_ids' => 'required|array|min:1',
        'status' => 'required|in:Present,Absent,Half-Day,Leave_Paid,Holiday',
        'skip_sundays' => 'nullable|boolean',
        'skip_saturdays' => 'nullable|boolean',
    ]);

    $start = Carbon::parse($request->start_date);
    $end = Carbon::parse($request->end_date);

    // Resolve employee IDs
    $employeeIds = $request->input('employee_ids');
    if (in_array('all', $employeeIds)) {
        $employeeIds = Employee::whereIn('status', [1, true, '1'])->pluck('id')->toArray();
    }

    // Build the array of target dates based on weekend-skipping preferences
    $dates = [];
    while ($start->lte($end)) {
        if ($request->has('skip_sundays') && $start->isSunday()) {
            $start->addDay();
            continue;
        }
        if ($request->has('skip_saturdays') && $start->isSaturday()) {
            $start->addDay();
            continue;
        }
        $dates[] = $start->toDateString();
        $start->addDay();
    }

    if (empty($dates)) {
        return redirect()->back()->withErrors(['date_range' => 'The selected date range yielded no valid days after skipping weekends.'])->withInput();
    }

    // Perform highly optimized bulk database updates/creates
    foreach ($employeeIds as $employeeId) {
        foreach ($dates as $date) {
            Attendance::updateOrCreate(
                ['employee_id' => $employeeId, 'date' => $date],
                ['status' => $request->status]
            );
        }
    }

    return redirect()->route('admin.payroll.attendance.report')->with('message', [
        'status' => 'success',
        'title' => 'Bulk Attendance Saved',
        'description' => 'Successfully updated attendance records for ' . count($employeeIds) . ' employees across ' . count($dates) . ' days.'
    ]);
}
}
