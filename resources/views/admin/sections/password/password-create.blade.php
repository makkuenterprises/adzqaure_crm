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
@php
    $password_type = ['Facebook', 'Instagram', 'Twitter', 'Linkedin', 'Google', 'Microsoft'];
@endphp

@section('panel-header')
    <div>
        <h1 class="panel-title">Create a Password</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.password.list') }}">Password Manager</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.password.create') }}">Create a Password</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <form action="{{ route('admin.handle.password.create') }}" method="POST">
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

                    {{-- Customer --}}
                    <div class="flex flex-col">
                        <label for="customer_id" class="input-label">Customer</label>
                        <select class="input-box-md" name="customer_id">
                            <option value="">Select Customer</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->company_name }})
                                </option>
                            @endforeach
                        </select>
                        @error('customer_id')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Type --}}
                    <div class="flex flex-col">
                        <label for="type" class="input-label">Type <span class="text-red-500">*</span></label>
                        <select class="input-box-md" name="type" required>
                            <option value="">Select Type</option>
                            @foreach ($password_type as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                        @error('type')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-4 sm:col-span-1">
                        <h1 class="font-semibold ">Credentials Information</h1>
                    </div>

                    {{-- Username --}}
                    <div class="flex flex-col">
                        <label for="username" class="input-label">Username</label>
                        <input type="text" name="username" value="{{ old('username') }}"
                            class="input-box-md @error('username') input-invalid @enderror" placeholder="Enter username"
                            minlength="1" maxlength="250">
                        @error('username')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email address --}}
                    <div class="flex flex-col">
                        <label for="email" class="input-label">Email address</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="input-box-md @error('email') input-invalid @enderror" placeholder="Enter email address"
                            minlength="1" maxlength="250">
                        @error('email')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Phone --}}
                    <div class="flex flex-col">
                        <label for="phone" class="input-label">Phone</label>
                        <input type="tel" name="phone" value="{{ old('phone') }}"
                            class="input-box-md @error('phone') input-invalid @enderror" placeholder="Enter phone"
                            minlength="1" maxlength="250">
                        @error('phone')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="flex flex-col">
                        <label for="password" class="input-label">Password</label>
                        <input type="text" name="password" value="{{ old('password') }}"
                            class="input-box-md @error('password') input-invalid @enderror" placeholder="Enter password"
                            minlength="1" maxlength="250">
                        @error('password')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="panel-card-footer">
                <button type="submit" class="btn-primary-md md:w-fit sm:w-full">Add Password</button>
            </div>
        </figure>
    </form>
@endsection

@section('panel-script')
    <script>
        document.getElementById('password-tab').classList.add('active');
    </script>
@endsection
