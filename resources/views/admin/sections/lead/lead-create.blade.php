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
        <h1 class="panel-title">Create a Lead</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.lead.list') }}">Leads</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.lead.create') }}">Create a Lead</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <form action="{{ route('admin.handle.lead.create') }}" method="POST" enctype="multipart/form-data">
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
                        <label for="name" class="input-label">Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="input-box-md @error('name') input-invalid @enderror" placeholder="Enter name"
                            minlength="1" maxlength="250">
                        @error('name')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email  --}}
                    <div class="flex flex-col">
                        <label for="email" class="input-label">Email address <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="input-box-md @error('email') input-invalid @enderror" placeholder="Enter email"
                            minlength="1" maxlength="250">
                        @error('email')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Phone  --}}
                    <div class="flex flex-col">
                        <label for="phone" class="input-label">Phone <span class="text-red-500">*</span></label>
                        <input type="tel" name="phone" value="{{ old('phone') }}"
                            class="input-box-md @error('phone') input-invalid @enderror" placeholder="Enter phone"
                            minlength="10" maxlength="12"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        @error('phone')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Address  --}}
                    <div class="flex flex-col">
                        <label for="address" class="input-label">Address <span class="text-red-500">*</span></label>
                        <input type="text" name="address" value="{{ old('address') }}"
                            class="input-box-md @error('address') input-invalid @enderror" placeholder="Enter address"
                            minlength="1" maxlength="500">
                        @error('address')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Group --}}
                    <div class="flex flex-col">
                        <label for="group_id" class="input-label">Group <span class="text-red-500">*</span></label>
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
                <button type="submit" class="btn-primary-md md:w-fit sm:w-full">Create Lead</button>
            </div>
        </figure>
    </form>
@endsection

@section('panel-script')
    <script>
        document.getElementById('create-lead-tab').classList.add('active');
        document.getElementById('lead-management-tab').classList.add('active');
    </script>
@endsection
