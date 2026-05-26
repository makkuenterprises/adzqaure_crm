@extends('admin.layouts.app')

@section('main-content')
    <div class="content-body default-height">
        <div class="container-fluid">
            <!-- Breadcrumbs -->
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">HR & Payroll</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.payroll.payslips') }}">Payslips</a></li>
                </ol>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                            <h4 class="card-title">Generated Payslips Sheet</h4>
                            <!-- Click generator trigger form -->
                            <form action="{{ route('admin.payroll.payslips.generate') }}" method="POST" class="needs-loader">
                                @csrf
                                <input type="hidden" name="month" value="{{ $month }}">
                                <input type="hidden" name="year" value="{{ $year }}">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-calculator me-1"></i> Generate Payslips for {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                                </button>
                            </form>
                        </div>
                        <div class="card-body">
                            <!-- Filters -->
                            <form method="GET" action="{{ route('admin.payroll.payslips') }}" class="mb-4">
                                <div class="row g-3 align-items-end">
                                    <div class="col-md-3">
                                        <label class="form-label font-w500">Month</label>
                                        <select name="month" class="form-select" onchange="this.form.submit()">
                                            @for ($m = 1; $m <= 12; $m++)
                                                <option value="{{ $m }}" @selected($month == $m)>{{ \Carbon\Carbon::create()->month($m)->format('F') }}</option>
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
                                </div>
                            </form>

                            <hr>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Emp ID</th>
                                            <th>Employee Name</th>
                                            <th>Gross Salary</th>
                                            <th>Allowances</th>
                                            <th>Deductions</th>
                                            <th>Net Salary (Earned)</th>
                                            <th>Status</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($payslips as $slip)
                                            <tr>
                                                <td>{{ $slip->employee->employee_id ?? 'N/A' }}</td>
                                                <td><strong>{{ $slip->employee->name }}</strong></td>
                                                <td>₹{{ number_format($slip->basic_salary, 2) }}</td>
                                                <td>₹{{ number_format($slip->allowances, 2) }}</td>
                                                <td>₹{{ number_format($slip->deductions, 2) }}</td>
                                                <td class="text-success font-w600">₹{{ number_format($slip->net_salary, 2) }}</td>
                                                <td><span class="badge badge-success">Processed</span></td>
                                                <td class="text-end">
                                                    <a href="{{ route('admin.payroll.payslips.download', ['id' => $slip->id]) }}" class="btn btn-danger btn-xs btn-loader" target="_blank">
                                                        <i class="fa fa-file-pdf me-1"></i> Payslip PDF
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center text-muted py-4">No payslips have been generated for this month. Click the "Generate" button above.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
