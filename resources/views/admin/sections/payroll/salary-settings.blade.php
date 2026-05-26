@extends('admin.layouts.app')

@section('main-content')
    <div class="content-body default-height">
        <div class="container-fluid">
            <!-- Breadcrumbs -->
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">HR & Payroll</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.payroll.salary-settings') }}">Salary Settings</a></li>
                </ol>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Employee Salary Configuration</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Emp ID</th>
                                            <th>Name</th>
                                            <th>Designation</th>
                                            <th>Basic Salary (Monthly)</th>
                                            <th>Fixed Allowances</th>
                                            <th>Monthly Deductions</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($employees as $employee)
                                            <tr>
                                                <td>{{ $employee->employee_id ?? 'N/A' }}</td>
                                                <td><strong>{{ $employee->name }}</strong></td>
                                                <td>{{ $employee->designation ?? 'N/A' }}</td>
                                                <td>₹{{ number_format($employee->payrollSetting->basic_salary ?? 0, 2) }}</td>
                                                <td>₹{{ number_format($employee->payrollSetting->allowances ?? 0, 2) }}</td>
                                                <td>₹{{ number_format($employee->payrollSetting->deductions ?? 0, 2) }}</td>
                                                <td class="text-end">
                                                    <button type="button" class="btn btn-primary btn-xs" data-bs-toggle="modal" data-bs-target="#editSalaryModal{{ $employee->id }}">
                                                        Configure Salary
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- modal wrapper for inline edits -->
                                            <div class="modal fade" id="editSalaryModal{{ $employee->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Configure Salary: {{ $employee->name }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <form action="{{ route('admin.payroll.salary-settings.update', ['id' => $employee->id]) }}" method="POST">
                                                            @csrf
                                                            <div class="modal-body text-start">
                                                                <div class="mb-3">
                                                                    <label class="form-label font-w500">Base Salary (INR/Month)</label>
                                                                    <input type="number" step="0.01" name="basic_salary" class="form-control" value="{{ $employee->payrollSetting->basic_salary ?? 0 }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label font-w500">Allowances (INR/Month)</label>
                                                                    <input type="number" step="0.01" name="allowances" class="form-control" value="{{ $employee->payrollSetting->allowances ?? 0 }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label font-w500">Deductions (INR/Month)</label>
                                                                    <input type="number" step="0.01" name="deductions" class="form-control" value="{{ $employee->payrollSetting->deductions ?? 0 }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger btn-xs light" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary btn-xs">Save Configuration</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex align-items-center justify-content-between flex-wrap mt-3">
                                <p class="mb-2">Showing {{ $employees->firstItem() }} to {{ $employees->lastItem() }} of {{ $employees->total() }} records</p>
                                <nav>{{ $employees->links('pagination::bootstrap-4') }}</nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
