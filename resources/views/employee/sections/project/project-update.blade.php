@extends('employee.layouts.app')


@section('main-content')
    <!--**********************************
                                    Content body start
                                ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('employee.view.project.list') }}">Customers Project</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('employee.view.project.update', ['id' => $project->id]) }}">Update Project</a>
                    </li>
                </ol>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Update Project</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ route('employee.handle.project.update', ['id' => $project->id]) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <label for="basic-form" class="form-label">Select Customer <span
                                                class="text-danger">*</span></label>
                                        <div class="basic-form @error('customer_id') input-invalid @enderror">
                                            <select class="default-select form-control wide mb-3" name="customer_id" {{ !empty($project->customer_id) ? 'disabled' : '' }}>
                                                <option selected>Select Customer</option>
                                                @foreach (DB::table('customers')->orderBy('name')->get() as $customer)
                                                    <option @selected(old('customer_id', $project->customer_id) == $customer->id) value="{{ $customer->id }}">
                                                        {{ $customer->name }}
                                                        ({{ $customer->company_name }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('customer_id')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Project Name<span class="text-danger">*</span></label>
                                            <input type="text" name="name" value="{{ $project->name }}"
                                                class="form-control @error('name') input-invalid @enderror"
                                                placeholder="Enter Project Name" minlength="1" maxlength="250" {{ !empty($project->name) ? 'readonly' : '' }}>
                                            @error('name')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="amount" class="form-label">Amount<span
                                                    class="text-danger">*</span></label>
                                            <input type="number" name="amount" value="{{ $project->amount }}"
                                                class="form-control @error('amount') input-invalid @enderror"
                                                placeholder="Enter Amount" minlength="1" maxlength="250" {{ !empty($project->amount) ? 'readonly' : '' }}>
                                            @error('amount')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Project Link</label>
                                            <input type="url" name="project_link" value="{{ $project->project_link }}"
                                                class="form-control @error('project_link') input-invalid @enderror"
                                                placeholder="Enter Project Link" {{ !empty($project->project_link) ? 'readonly' : '' }}>
                                            @error('project_link')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="resource_link" class="form-label">Resource Link</label>
                                            <input type="url" name="resource_link" value="{{ $project->resource_link }}"
                                                class="form-control @error('resource_link') input-invalid @enderror"
                                                placeholder="Enter Resource Link" {{ !empty($project->resource_link) ? 'readonly' : '' }}>
                                            @error('resource_link')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Deadline Date</label>
                                            <input type="date" name="end_date" value="{{ $project->end_date }}"
                                                class="form-control @error('end_date') input-invalid @enderror"
                                                placeholder="Enter Deadline Date" {{ !empty($project->end_date) ? 'readonly' : '' }}>
                                            @error('end_date')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="basic-form" class="form-label">Select Status <span
                                                    class="text-danger">*</span></label>
                                            <div class="basic-form @error('status') input-invalid @enderror">
                                                <select class="default-select form-control wide mb-3" name="status">
                                                    <option value="">Select Status</option>
                                                    <option value="OnProgess"
                                                        {{ old('status', $project->status) == 'OnProgess' ? 'selected' : '' }}>On Progress</option>
                                                    <option value="Pending"
                                                        {{ old('status', $project->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="Closed"
                                                        {{ old('status', $project->status) == 'Closed' ? 'selected' : '' }}>Closed</option>
                                                </select>
                                                @error('status')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>


                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Project</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
                                    Content body end
                                ***********************************-->
@endsection
