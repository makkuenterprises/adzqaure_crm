@extends('admin.layouts.app')

@section('main-content')
    <div class="content-body default-height">
        <div class="container-fluid">
            <!-- Breadcrumbs -->
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">HR & Payroll</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.payroll.attendance') }}">Attendance</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.payroll.attendance.bulk') }}">Bulk Mark</a></li>
                </ol>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Bulk Mark Attendance Sheet</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ route('admin.payroll.attendance.bulk.store') }}" method="POST" class="needs-loader">
                                    @csrf

                                    <div class="row g-3">
                                        {{-- Start Date --}}
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="start_date" class="form-label font-w500">Start Date <span class="text-danger">*</span></label>
                                                <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', date('Y-m-d')) }}" required>
                                                @error('start_date')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- End Date --}}
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="end_date" class="form-label font-w500">End Date <span class="text-danger">*</span></label>
                                                <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date', date('Y-m-d')) }}" required>
                                                @error('end_date')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                                @error('date_range')
                                                    <div class="text-danger font-w500 text-xs mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Target Employees --}}
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="employee_ids" class="form-label font-w500">Target Employees <span class="text-danger">*</span></label>
                                                <select class="default-select form-control wide @error('employee_ids') is-invalid @enderror" name="employee_ids[]" id="employee_ids" multiple required data-actions-box="true">
                                                    <option value="all">All Employees</option>
                                                    @foreach ($employees as $employee)
                                                        <option value="{{ $employee->id }}" @selected(is_array(old('employee_ids')) && in_array($employee->id, old('employee_ids')))>
                                                            {{ $employee->name }} ({{ $employee->employee_id ?? 'N/A' }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('employee_ids')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Target Status --}}
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="status" class="form-label font-w500">Attendance Status <span class="text-danger">*</span></label>
                                                <select class="default-select form-control wide" name="status" id="status" required>
                                                    <option value="Present" @selected(old('status') == 'Present')>Present</option>
                                                    <option value="Absent" @selected(old('status') == 'Absent')>Absent</option>
                                                    <option value="Half-Day" @selected(old('status') == 'Half-Day')>Half-Day</option>
                                                    <option value="Leave_Paid" @selected(old('status') == 'Leave_Paid')>Paid Leave</option>
                                                    <option value="Holiday" @selected(old('status') == 'Holiday')>Holiday</option>
                                                </select>
                                                @error('status')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Weekend Exclusion Options --}}
                                        <div class="col-12 mt-3">
                                            <h5 class="font-w600 mb-2">Exclusion Preferences</h5>
                                            <div class="d-flex gap-4">
                                                <div class="form-check">
                                                    <input type="checkbox" name="skip_sundays" id="skip_sundays" value="1" class="form-check-input" @checked(old('skip_sundays', true))>
                                                    <label for="skip_sundays" class="form-check-label select-none cursor-pointer">Skip Sundays</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" name="skip_saturdays" id="skip_saturdays" value="1" class="form-check-input" @checked(old('skip_saturdays'))>
                                                    <label for="skip_saturdays" class="form-check-label select-none cursor-pointer">Skip Saturdays</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-4">Generate Bulk Attendance</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
