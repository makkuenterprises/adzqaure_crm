@extends('admin.layouts.app')
@section('css')
    <style>
        /* Style for the required field marker */
        .input-label span.text-red-500 {
            color: red;
            font-weight: bold;
        }

        .input-invalid {
            border-color: red;
        }

        /* Style for error messages */
        .input-error {
            color: red;
            font-size: 0.875rem;
            margin-top: 5px;
        }
    </style>
@endsection
@section('panel-header')
    <div>
        <h1 class="panel-title">Add Project</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.project.list') }}">Projects</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.project.create') }}">Add Project</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <form action="{{ route('admin.handle.project.create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <figure class="panel-card">
            <div class="panel-card-header">
                <div>
                    <h1 class="panel-card-title">Add Information</h1>
                    <p class="panel-card-description">Please fill the required fields</p>
                </div>
            </div>
            <div class="panel-card-body">
                <div class="grid md:grid-cols-4 sm:grid-cols-1 md:gap-7 sm:gap-5">

                    {{-- Customer ID --}}
                    <div class="{{ request('customer_id') ? 'hidden' : 'flex' }} flex-col">
                        <label for="customer_id" class="input-label">Customer <span class="text-red-500">*</span></label>
                        <select name="customer_id" class="input-box-md @error('customer_id') input-invalid @enderror"
                            required>
                            <option value="">Select Customer</option>
                            @foreach (DB::table('customers')->orderBy('name')->get() as $customer)
                                <option @selected(old('customer_id', request('customer_id')) == $customer->id) value="{{ $customer->id }}">{{ $customer->name }}
                                    ({{ $customer->company_name }})
                                </option>
                            @endforeach
                        </select>
                        @error('customer_id')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Name --}}
                    <div class="flex flex-col md:col-span-2 sm:col-span-1">
                        <label for="name" class="input-label">Project name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="input-box-md @error('name') input-invalid @enderror" placeholder="Enter project name"
                            required minlength="1" maxlength="250">
                        @error('name')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Amount --}}
                    <div class="flex flex-col">
                        <label for="amount" class="input-label">Amount<span class="text-red-500">*</span></label>
                        <input type="number" style="any" name="amount" value="{{ old('amount') }}"
                            class="input-box-md @error('amount') input-invalid @enderror" placeholder="Enter project amount"
                            required>
                        @error('amount')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Pending Amount --}}
                    <div class="flex flex-col">
                        <label for="pending_amount" class="input-label">Pending Amount<span
                                class="text-red-500">*</span></label>
                        <input type="number" style="any" name="pending_amount" value="{{ old('pending_amount') }}"
                            class="input-box-md @error('pending_amount') input-invalid @enderror"
                            placeholder="Enter project pending amount" required>
                        @error('pending_amount')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Project Link --}}
                    <div class="flex flex-col">
                        <label for="project_link" class="input-label">Project link</label>
                        <input type="text" name="project_link" value="{{ old('project_link') }}"
                            class="input-box-md @error('project_link') input-invalid @enderror"
                            placeholder="Enter project link">
                        @error('project_link')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Resource Link --}}
                    <div class="flex flex-col">
                        <label for="resource_link" class="input-label">Resource link</label>
                        <input type="text" name="resource_link" value="{{ old('resource_link') }}"
                            class="input-box-md @error('resource_link') input-invalid @enderror"
                            placeholder="Enter resource link">
                        @error('resource_link')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Start date --}}
                    <div class="flex flex-col">
                        <label for="start_date" class="input-label">Start date <span class="text-red-500">*</span></label>
                        <input type="date" name="start_date" value="{{ old('start_date') }}"
                            class="input-box-md @error('start_date') input-invalid @enderror" required>
                        @error('start_date')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Deadline date --}}
                    <div class="flex flex-col">
                        <label for="end_date" class="input-label">Deadline date</label>
                        <input type="date" name="end_date" value="{{ old('end_date') }}"
                            class="input-box-md @error('end_date') input-invalid @enderror">
                        @error('end_date')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="flex flex-col">
                        <label for="status" class="input-label">Status<span class="text-red-500">*</span></label>
                        <select name="status" class="input-box-md @error('status') input-invalid @enderror" required>
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Ongoing">Ongoing</option>
                            <option value="Completed">Completed</option>
                        </select>
                        @error('status')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="panel-card-footer">
                <button type="submit" class="btn-primary-md md:w-fit sm:w-full">Add Project</button>
            </div>
        </figure>
    </form>
@endsection

@section('panel-script')
    <script>
        document.getElementById('project-tab').classList.add('active');
    </script>
@endsection
