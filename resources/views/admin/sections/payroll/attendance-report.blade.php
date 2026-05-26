@extends('admin.layouts.app')

@section('css')
    <style>
        /* Small, neat circular badges for the grid */
        .att-badge {
            display: inline-block;
            width: 22px;
            height: 22px;
            line-height: 22px;
            border-radius: 50%;
            text-align: center;
            font-size: 10px;
            font-weight: bold;
            color: #fff;
        }
        .bg-present { background-color: #2bc155; }
        .bg-absent { background-color: #f72b50; }
        .bg-halfday { background-color: #ffaa2b; }
        .bg-leave { background-color: #1ea1f2; }
        .bg-holiday { background-color: #888888; }
        .bg-none { background-color: #e2e2e2; color: #888; }
    </style>
@endsection

@section('main-content')
    <div class="content-body default-height">
        <div class="container-fluid">
            <!-- Breadcrumbs -->
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">HR & Payroll</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.payroll.attendance.report') }}">Attendance Report</a></li>
                </ol>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="filter cm-content-box box-primary">
                        <div class="content-title SlideToolHeader">
                            <div class="cpa">
                                <i class="fa-solid fa-chart-bar me-1"></i>Monthly Attendance Grid
                            </div>
                        </div>

                        <div class="cm-content-body form excerpt">
                            <div class="card-body pb-4">
                                <!-- Filter Month & Year -->
                                <form method="GET" action="{{ route('admin.payroll.attendance.report') }}" class="mb-4">
                                    <div class="row g-3 align-items-end">
                                        <div class="col-md-3">
                                            <label class="form-label font-w500">Month</label>
                                            <select name="month" class="form-select" onchange="this.form.submit()">
                                                @for ($m = 1; $m <= 12; $m++)
                                                    <option value="{{ $m }}" @selected($month == $m)>
                                                        {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label font-w500">Year</label>
                                            <select name="year" class="form-select" onchange="this.form.submit()">
                                                @for ($y = \Carbon\Carbon::now()->year - 2; $y <= \Carbon\Carbon::now()->year + 1; $y++)
                                                    <option value="{{ $y }}" @selected($year == $y)>{{ $y }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                         <div class="col-md-4 d-flex align-items-end">
                                            <button type="submit" class="btn btn-primary me-2">Generate Report</button>

                                            <a href="{{ route('admin.payroll.attendance.report.pdf', ['month' => $month, 'year' => $year]) }}"
                                            class="btn btn-danger btn-loader" target="_blank">
                                                <i class="fa fa-file-pdf me-1"></i> Download PDF
                                            </a>
                                        </div>
                                    </div>
                                </form>

                                <hr>

                                <!-- Grid Table -->
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped text-center align-middle" style="font-size: 11px;">
                                        <thead>
                                            <tr class="bg-light">
                                                <th class="text-start" style="min-width: 150px;">Employee</th>
                                                @for ($day = 1; $day <= $daysInMonth; $day++)
                                                    <th style="padding: 5px; min-width: 30px;">{{ $day }}</th>
                                                @endfor
                                                <th class="text-success font-w600" title="Present">P</th>
                                                <th class="text-danger font-w600" title="Absent">A</th>
                                                <th class="text-warning font-w600" title="Half-Day">HD</th>
                                                <th class="text-info font-w600" title="Paid Leave">PL</th>
                                                <th class="text-secondary font-w600" title="Holiday">H</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($employees as $employee)
                                                @php
                                                    $pCount = 0; $aCount = 0; $hdCount = 0; $plCount = 0; $hCount = 0;
                                                @endphp
                                                <tr>
                                                    <td class="text-start"><strong>{{ $employee->name }}</strong></td>

                                                    @for ($day = 1; $day <= $daysInMonth; $day++)
                                                        @php
                                                            // Check if attendance exists for this employee on this day
                                                            $status = null;
                                                            if ($attendances->has($employee->id) && $attendances->get($employee->id)->has($day)) {
                                                                $status = $attendances->get($employee->id)->get($day)->first()->status;
                                                            }
                                                        @endphp
                                                        <td style="padding: 4px;">
                                                            @if ($status == 'Present')
                                                                @php $pCount++; @endphp
                                                                <span class="att-badge bg-present">P</span>
                                                            @elseif ($status == 'Absent')
                                                                @php $aCount++; @endphp
                                                                <span class="att-badge bg-absent">A</span>
                                                            @elseif ($status == 'Half-Day')
                                                                @php $hdCount++; @endphp
                                                                <span class="att-badge bg-halfday">HD</span>
                                                            @elseif ($status == 'Leave_Paid')
                                                                @php $plCount++; @endphp
                                                                <span class="att-badge bg-leave">L</span>
                                                            @elseif ($status == 'Holiday')
                                                                @php $hCount++; @endphp
                                                                <span class="att-badge bg-holiday">H</span>
                                                            @else
                                                                <span class="att-badge bg-none">-</span>
                                                            @endif
                                                        </td>
                                                    @endfor

                                                    <!-- Sum Totals -->
                                                    <td class="text-success font-w600">{{ $pCount }}</td>
                                                    <td class="text-danger font-w600">{{ $aCount }}</td>
                                                    <td class="text-warning font-w600">{{ $hdCount }}</td>
                                                    <td class="text-info font-w600">{{ $plCount }}</td>
                                                    <td class="text-secondary font-w600">{{ $hCount }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="{{ $daysInMonth + 6 }}" class="text-center text-muted">No employees found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>

                                </div>

                                <div class="mt-4">
                                    <h6 class="font-w600 mb-2">Legend:</h6>
                                    <span class="badge badge-success me-2">P = Present</span>
                                    <span class="badge badge-danger me-2">A = Absent</span>
                                    <span class="badge badge-warning me-2">HD = Half-Day</span>
                                    <span class="badge badge-info me-2">L = Paid Leave</span>
                                    <span class="badge badge-secondary me-2">H = Holiday</span>
                                    <span class="badge badge-light text-dark">- = Unmarked</span>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
