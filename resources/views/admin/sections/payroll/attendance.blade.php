@extends('admin.layouts.app')

@section('main-content')
    <div class="content-body default-height">
        <div class="container-fluid">
            <!-- Breadcrumbs -->
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">HR & Payroll</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.payroll.attendance') }}">Daily Attendance</a></li>
                </ol>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="filter cm-content-box box-primary">
                        <div class="content-title SlideToolHeader">
                            <div class="cpa">
                                <i class="fa-solid fa-calendar-check me-1"></i>Mark Attendance Sheet
                            </div>
                        </div>

                        <div class="cm-content-body form excerpt">
                            <div class="card-body pb-4">
                                <!-- Date Selector Form -->
                                <form method="GET" action="{{ route('admin.payroll.attendance') }}" class="mb-4">
                                    <div class="row align-items-end g-3">
                                        <div class="col-md-3">
                                            <label class="form-label font-w500">Select Date</label>
                                            <input type="date" name="date" class="form-control"
                                                value="{{ $date->toDateString() }}" onchange="this.form.submit()">
                                        </div>
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-primary">Load Date</button>
                                        </div>
                                    </div>
                                </form>

                                <hr>

                                <!-- Main Attendance Checklist Form -->
                                <form action="{{ route('admin.payroll.attendance.store') }}" method="POST" class="needs-loader">
                                    @csrf
                                    <input type="hidden" name="date" value="{{ $date->toDateString() }}">

                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Emp ID</th>
                                                    <th>Employee Name</th>
                                                    <th>Designation</th>
                                                    <th class="text-center">Status Selection</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($employees as $employee)
                                                    @php
                                                        // Resolve current marked value or fallback to "Present"
                                                        $currentStatus = $markedAttendance->has($employee->id)
                                                            ? $markedAttendance->get($employee->id)->status
                                                            : 'Present';
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $employee->employee_id ?? 'N/A' }}</td>
                                                        <td><strong>{{ $employee->name }}</strong></td>
                                                        <td>{{ $employee->designation ?? 'N/A' }}</td>
                                                        <td>
                                                            <div class="d-flex justify-content-center gap-3">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="status[{{ $employee->id }}]"
                                                                        id="status_p_{{ $employee->id }}"
                                                                        value="Present" @checked($currentStatus == 'Present')>
                                                                    <label class="form-check-label text-success font-w600" for="status_p_{{ $employee->id }}">Present</label>
                                                                </div>

                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="status[{{ $employee->id }}]"
                                                                        id="status_a_{{ $employee->id }}"
                                                                        value="Absent" @checked($currentStatus == 'Absent')>
                                                                    <label class="form-check-label text-danger font-w600" for="status_a_{{ $employee->id }}">Absent</label>
                                                                </div>

                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="status[{{ $employee->id }}]"
                                                                        id="status_hd_{{ $employee->id }}"
                                                                        value="Half-Day" @checked($currentStatus == 'Half-Day')>
                                                                    <label class="form-check-label text-warning font-w600" for="status_hd_{{ $employee->id }}">Half-Day</label>
                                                                </div>

                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="status[{{ $employee->id }}]"
                                                                        id="status_pl_{{ $employee->id }}"
                                                                        value="Leave_Paid" @checked($currentStatus == 'Leave_Paid')>
                                                                    <label class="form-check-label text-info font-w600" for="status_pl_{{ $employee->id }}">Paid Leave</label>
                                                                </div>

                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="status[{{ $employee->id }}]"
                                                                        id="status_h_{{ $employee->id }}"
                                                                        value="Holiday" @checked($currentStatus == 'Holiday')>
                                                                    <label class="form-check-label text-secondary font-w600" for="status_h_{{ $employee->id }}">Holiday</label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center text-muted py-4">No employees found to mark attendance.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                    @if ($employees->isNotEmpty())
                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-primary">Save Attendance Sheet</button>
                                        </div>
                                    @endif
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
