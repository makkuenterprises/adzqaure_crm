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
        <h1 class="panel-title">Add Campaign</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.campaign.list') }}">Campaign</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.campaign.create') }}">Add Campaign</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <form action="{{ route('admin.handle.campaign.create') }}" method="POST" enctype="multipart/form-data">
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

                    {{-- Name --}}
                    <div class="flex flex-col">
                        <label for="name" class="input-label">Campaign Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="input-box-md @error('name') input-invalid @enderror" placeholder="Enter name" required
                            minlength="1" maxlength="250">
                        @error('name')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Lead Count --}}
                    <div class="flex flex-col">
                        <label for="lead_count" class="input-label">Lead Count <span class="text-red-500">*</span></label>
                        <input type="number" name="lead_count" value="{{ old('lead_count') }}"
                            class="input-box-md @error('lead_count') input-invalid @enderror" placeholder="Enter lead count"
                            required>
                        @error('lead_count')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Employee ID --}}
                    <div class="flex flex-col">
                        <label for="employee_id" class="input-label">Team Member <span class="text-red-500">*</span></label>
                        <select class="input-box-md" name="employee_id" required>
                            <option value="">Select Team Member</option>
                            @foreach ($employees as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('employee_id')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Group ID --}}
                    <div class="flex flex-col">
                        <label for="group_id" class="input-label">Group <span class="text-red-500">*</span></label>
                        <select class="input-box-md" name="group_id" required>
                            <option value="">Select Group</option>
                            @foreach ($groups as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('group_id')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="panel-card-footer">
                <button type="submit" class="btn-primary-md md:w-fit sm:w-full">Add Campaign</button>
            </div>
        </figure>
    </form>
@endsection

@section('panel-script')
    <script>
        document.getElementById('campaign-tab').classList.add('active');
        document.getElementById('lead-management-tab').classList.add('active');
    </script>
@endsection
