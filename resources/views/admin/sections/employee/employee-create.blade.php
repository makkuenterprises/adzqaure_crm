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
        <h1 class="panel-title">Add Team Member</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.employee.list') }}">Team Members</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.employee.create') }}">Add Team Member</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <form action="{{ route('admin.handle.employee.create') }}" method="POST" enctype="multipart/form-data">
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

                    <div class="md:col-span-4 sm:col-span-1">
                        <h1 class="font-semibold ">General Information</h1>
                    </div>

                    {{-- First Name --}}
                    <div class="flex flex-col">
                        <label for="firstname" class="input-label">First name <span class="text-red-500">*</span></label>
                        <input type="text" name="firstname" value="{{ old('firstname') }}"
                            class="input-box-md @error('firstname') input-invalid @enderror" placeholder="Enter first name"
                            required minlength="1" maxlength="250">
                        @error('firstname')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Last Name --}}
                    <div class="flex flex-col">
                        <label for="lastname" class="input-label">Last name <span class="text-red-500">*</span></label>
                        <input type="text" name="lastname" value="{{ old('lastname') }}"
                            class="input-box-md @error('lastname') input-invalid @enderror" placeholder="Enter last name"
                            required minlength="1" maxlength="250">
                        @error('lastname')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email  --}}
                    <div class="flex flex-col">
                        <label for="email" class="input-label">Email address <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="input-box-md @error('email') input-invalid @enderror" placeholder="Enter email" required
                            minlength="1" maxlength="250">
                        @error('email')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email Official --}}
                    <div class="flex flex-col">
                        <label for="email_official" class="input-label">Email address (Official)<span
                                class="text-red-500">*</span></label>
                        <input type="email" name="email_official" value="{{ old('email_official') }}"
                            class="input-box-md @error('email_official') input-invalid @enderror"
                            placeholder="Enter official email" minlength="1" maxlength="250">
                        @error('email_official')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Phone  --}}
                    <div class="flex flex-col">
                        <label for="phone" class="input-label">Phone <span class="text-red-500">*</span></label>
                        <input type="tel" name="phone" value="{{ old('phone') }}"
                            class="input-box-md @error('phone') input-invalid @enderror" placeholder="Enter phone" required
                            minlength="10" maxlength="12">
                        @error('phone')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Phone Alternate  --}}
                    <div class="flex flex-col">
                        <label for="phone_alternate" class="input-label">Phone (Alternate) <span
                                class="text-red-500">*</span></label>
                        <input type="tel" name="phone_alternate" value="{{ old('phone_alternate') }}"
                            class="input-box-md @error('phone_alternate') input-invalid @enderror"
                            placeholder="Enter phone alternate" minlength="10" maxlength="12">
                        @error('phone_alternate')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Role  --}}
                    <div class="flex flex-col">
                        <label for="role" class="input-label">Role <span class="text-red-500">*</span></label>
                        <input type="text" name="role" value="{{ old('role') }}"
                            class="input-box-md @error('role') input-invalid @enderror" placeholder="Enter role"
                            minlength="1" maxlength="20" required>
                        @error('role')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-4 sm:col-span-1">
                        <br>
                        <h1 class="font-semibold ">Address Information</h1>
                    </div>

                    {{-- Address Home --}}
                    <div class="flex flex-col">
                        <label for="home" class="input-label">Home / Flat/ Building <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="home" value="{{ old('home') }}"
                            class="input-box-md @error('home') input-invalid @enderror"
                            placeholder="Enter home / flat / building" minlength="1" maxlength="250" required>
                        @error('home')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Address Street --}}
                    <div class="flex flex-col">
                        <label for="street" class="input-label">Street <span class="text-red-500">*</span></label>
                        <input type="text" name="street" value="{{ old('street') }}"
                            class="input-box-md @error('street') input-invalid @enderror" placeholder="Enter street"
                            required minlength="1" maxlength="250">
                        @error('street')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Address City --}}
                    <div class="flex flex-col">
                        <label for="city" class="input-label">City <span class="text-red-500">*</span></label>
                        <input type="text" name="city" value="{{ old('city') }}"
                            class="input-box-md @error('city') input-invalid @enderror" placeholder="Enter city" required
                            minlength="1" maxlength="250">
                        @error('city')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Address Pincode --}}
                    <div class="flex flex-col">
                        <label for="pincode" class="input-label">Pincode <span class="text-red-500">*</span></label>
                        <input type="text" name="pincode" value="{{ old('pincode') }}"
                            class="input-box-md @error('pincode') input-invalid @enderror" placeholder="Enter pincode"
                            required minlength="1" maxlength="250">
                        @error('pincode')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Address State --}}
                    <div class="flex flex-col">
                        <label for="state" class="input-label">State <span class="text-red-500">*</span></label>
                        <input type="text" name="state" value="{{ old('state') }}"
                            class="input-box-md @error('state') input-invalid @enderror" placeholder="Enter state"
                            required minlength="1" maxlength="250">
                        @error('state')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Address State --}}
                    <div class="flex flex-col">
                        <label for="country" class="input-label">Country <span class="text-red-500">*</span></label>
                        <input type="text" name="country" value="{{ old('country') }}"
                            class="input-box-md @error('country') input-invalid @enderror" placeholder="Enter country"
                            required minlength="1" maxlength="250">
                        @error('country')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-4 sm:col-span-1">
                        <br>
                        <h1 class="font-semibold ">Password Information</h1>
                    </div>

                    {{-- Password --}}
                    <div class="input-group">
                        <label for="password" class="input-label">Password <span class="text-red-500">*</span></label>
                        <input type="password" name="password"
                            class="input-box-md @error('password') input-invalid @enderror" placeholder="Enter password"
                            required>
                        @error('password')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Confirm password --}}
                    <div class="input-group">
                        <label for="password_confirmation" class="input-label">Confirm password <span
                                class="text-red-500">*</span></label>
                        <input type="password" name="password_confirmation"
                            class="input-box-md @error('password_confirmation') input-invalid @enderror"
                            placeholder="Repeat password" required>
                        @error('password_confirmation')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="panel-card-footer">
                <button type="submit" class="btn-primary-md md:w-fit sm:w-full">Add Team Member</button>
            </div>
        </figure>
    </form>
@endsection

@section('panel-script')
    <script>
        document.getElementById('employee-tab').classList.add('active');
    </script>
@endsection
