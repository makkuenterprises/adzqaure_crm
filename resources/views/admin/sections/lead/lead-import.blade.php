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
        <h1 class="panel-title">Import Leads</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.lead.list') }}">Leads</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.lead.import') }}">Import Leads</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <form action="{{ route('admin.handle.lead.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <figure class="panel-card">
            <div class="panel-card-header">
                <div>
                    <h1 class="panel-card-title">Add Information</h1>
                    <p class="panel-card-description">Please fill the required fields</p>
                </div>
                <div>
                    <a href="{{ asset('admin/documents/lead-import-samle.xlsx') }}"
                        download="{{ asset('admin/documents/lead-import-samle.xlsx') }}" class="btn-primary-md">Download
                        Sample File</a>
                </div>
            </div>
            <div class="panel-card-body">
                <div class="grid md:grid-cols-4 sm:grid-cols-1 md:gap-7 sm:gap-5">

                    {{-- Lead File --}}
                    <div class="flex flex-col">
                        <label for="lead_file" class="input-label">Leads File <span class="text-red-500">*</span></label>
                        <input type="file" name="lead_file" value="{{ old('lead_file') }}"
                            class="input-box-md @error('lead_file') input-invalid @enderror" required>
                        @error('lead_file')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- <div class="flex flex-col">
                        <label for="firstname" class="input-label">Employee</label>
                        <select class="input-box-md" name="employee_id">
                            <option selected>Select Employee</option>
                            @foreach ($employees as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('firstname')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div> --}}

                    {{-- Group --}}
                    <div class="flex flex-col">
                        <label for="group_id" class="input-label">Group<span class="text-red-500">*</span></label>
                        <select class="input-box-md" name="group_id">
                            <option selected>Select Group</option>
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
                <button type="submit" class="btn-primary-md md:w-fit sm:w-full">Import Data</button>
            </div>
        </figure>
    </form>
@endsection

@section('panel-script')
    <script>
        document.getElementById('import-lead-tab').classList.add('active');
        document.getElementById('lead-management-tab').classList.add('active');
    </script>
@endsection
