@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Edit Project</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.customer.preview',['id' => $project->customer_id]) }}">Customer</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.project.update',['id' => $project]) }}">Edit Project</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <form action="{{ route('admin.handle.project.update',['id' => $project->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <figure class="panel-card">
            <div class="panel-card-header">
                <div>
                    <h1 class="panel-card-title">Update Information</h1>
                    <p class="panel-card-description">Please fill the required fields</p>
                </div>
            </div>
            <div class="panel-card-body">
                <div class="grid md:grid-cols-4 sm:grid-cols-1 md:gap-7 sm:gap-5">

                    {{-- Name --}}
                    <div class="flex flex-col md:col-span-2 sm:col-span-1">
                        <label for="name" class="input-label">Project name</label>
                        <input type="text" name="name" value="{{ old('name',$project->name) }}"
                            class="input-box-md @error('name') input-invalid @enderror" placeholder="Enter project name"
                            required minlength="1" maxlength="250">
                        @error('name')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Amount --}}
                    <div class="flex flex-col">
                        <label for="amount" class="input-label">Amount</label>
                        <input type="number" style="any" name="amount" value="{{ old('amount',$project->amount) }}"
                            class="input-box-md @error('amount') input-invalid @enderror" placeholder="Enter project amount"
                            required>
                        @error('amount')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Pending Amount --}}
                    <div class="flex flex-col">
                        <label for="pending_amount" class="input-label">Pending Amount</label>
                        <input type="number" style="any" name="pending_amount" value="{{ old('pending_amount', $project->pending_amount) }}"
                            class="input-box-md @error('pending_amount') input-invalid @enderror" placeholder="Enter project pending amount"
                            required>
                        @error('pending_amount')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Project Link --}}
                    <div class="flex flex-col">
                        <label for="project_link" class="input-label">Project link</label>
                        <input type="text" name="project_link" value="{{ old('project_link',$project->project_link) }}"
                            class="input-box-md @error('project_link') input-invalid @enderror" placeholder="Enter project link">
                        @error('project_link')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Resource Link --}}
                    <div class="flex flex-col">
                        <label for="resource_link" class="input-label">Resource link</label>
                        <input type="text" name="resource_link" value="{{ old('resource_link',$project->resource_link) }}"
                            class="input-box-md @error('resource_link') input-invalid @enderror" placeholder="Enter resource link">
                        @error('resource_link')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Start date --}}
                    <div class="flex flex-col">
                        <label for="start_date" class="input-label">Start date</label>
                        <input type="date" name="start_date" value="{{ old('start_date',$project->start_date) }}"
                            class="input-box-md @error('start_date') input-invalid @enderror" required>
                        @error('start_date')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Deadline date --}}
                    <div class="flex flex-col">
                        <label for="end_date" class="input-label">Deadline date</label>
                        <input type="date" name="end_date" value="{{ old('end_date',$project->end_date) }}"
                            class="input-box-md @error('end_date') input-invalid @enderror">
                        @error('end_date')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="flex flex-col">
                        <label for="status" class="input-label">Status</label>
                        <select name="status" class="input-box-md @error('status') input-invalid @enderror" required>
                            <option @selected($project->status == "Pending") value="Pending">Pending</option>
                            <option @selected($project->status == "Ongoing") value="Ongoing">Ongoing</option>
                            <option @selected($project->status == "Completed") value="Completed">Completed</option>
                        </select>
                        @error('status')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="panel-card-footer">
                <button type="submit" class="btn-primary-md md:w-fit sm:w-full">Save Changes</button>
            </div>
        </figure>
    </form>
@endsection

@section('panel-script')
    <script>
        document.getElementById('customer-tab').classList.add('active');
    </script>
@endsection
