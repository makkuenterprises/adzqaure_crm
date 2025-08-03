@extends('admin.layouts.app')

@section('css')
    <style>
        .input-error {
            color: red;
        }
    </style>
@endsection
@section('main-content')
    <!--**********************************
                        Content body start
                    ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.view.employee.list') }}">Employees</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.view.employee.create') }}">Create Team
                            Member</a></li>
                </ol>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Team Members</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ route('admin.handle.employee.create') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">First Name<span class="text-danger">*</span></label>
                                            <input type="text" name="firstname" value="{{ old('firstname') }}"
                                                class="form-control @error('firstname') input-invalid @enderror"
                                                placeholder="Enter First Name" minlength="1" maxlength="250">
                                            @error('firstname')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Last Name<span class="text-danger">*</span></label>
                                            <input type="text" name="lastname" value="{{ old('lastname') }}"
                                                class="form-control @error('lastname') input-invalid @enderror"
                                                placeholder="Enter Last Name" minlength="1" maxlength="250">
                                            @error('lastname')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Email<span class="text-danger">*</span></label>
                                            <input type="email" name="email" value="{{ old('email') }}"
                                                class="form-control @error('email') input-invalid @enderror"
                                                placeholder="Enter Email" minlength="1" maxlength="250">
                                            @error('email')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Email (Business Email)</label>
                                            <input type="email" name="email_official" value="{{ old('email_official') }}"
                                                class="form-control @error('email_official') input-invalid @enderror"
                                                placeholder="Enter Business Email @Business.com" minlength="1"
                                                maxlength="250">
                                            @error('email_official')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Phone<span class="text-danger">*</span></label>
                                            <input type="tel" name="phone" value="{{ old('phone') }}"
                                                class="form-control @error('phone') input-invalid @enderror"
                                                placeholder="Enter Phone" minlength="10" maxlength="12"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                            @error('phone')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Alternate Phone</label>
                                            <input type="tel" name="phone_alternate"
                                                value="{{ old('phone_alternate') }}"
                                                class="form-control @error('phone_alternate') input-invalid @enderror"
                                                placeholder="Enter Alternate Phone" minlength="10" maxlength="12"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                            @error('phone_alternate')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        {{-- This is the NEW, CORRECT code block --}}
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="role-select">Assign Role<span class="text-danger">*</span></label>
                                            {{-- Using your template's specific classes for the select dropdown --}}
                                            <select class="default-select form-control wide @error('role_id') is-invalid @enderror" name="role_id" id="role-select" required>
                                                <option value="" selected>Select a Role</option>
                                                {{-- Loop through the roles passed from the controller --}}
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('role_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Designation</label>
                                            <input type="text" name="designation" value="{{ old('designation') }}"
                                                class="form-control @error('designation') input-invalid @enderror"
                                                placeholder="Enter Designation" maxlength="255">
                                            @error('designation')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Date of Joining</label>
                                            <input type="date" name="date_of_joining" value="{{ old('date_of_joining') }}"
                                                class="form-control @error('date_of_joining') input-invalid @enderror">
                                            @error('date_of_joining')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Home / Flat/ Building</label>
                                            <input type="text" name="home" value="{{ old('home') }}"
                                                class="form-control @error('home') input-invalid @enderror"
                                                placeholder="Enter home / flat / building" minlength="1"
                                                maxlength="250">
                                            @error('home')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Street</label>
                                            <input type="text" name="street" value="{{ old('street') }}"
                                                class="form-control @error('street') input-invalid @enderror"
                                                placeholder="Enter street address" minlength="1" maxlength="250">
                                            @error('street')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">City</label>
                                            <input type="text" name="city" value="{{ old('city') }}"
                                                class="form-control @error('city') input-invalid @enderror"
                                                placeholder="Enter city" minlength="1" maxlength="250">
                                            @error('city')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Pincode</label>
                                            <input type="text" name="pincode" value="{{ old('pincode') }}"
                                                class="form-control @error('pincode') input-invalid @enderror"
                                                placeholder="Enter pincode" minlength="1" maxlength="6"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                            @error('pincode')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">State</label>
                                            <input type="text" name="state" value="{{ old('state') }}"
                                                class="form-control @error('state') input-invalid @enderror"
                                                placeholder="Enter state" minlength="1" maxlength="250">
                                            @error('state')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Country</label>
                                            <input type="text" name="country" value="{{ old('country') }}"
                                                class="form-control @error('country') input-invalid @enderror"
                                                placeholder="Enter country" minlength="1" maxlength="250">
                                            @error('country')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6 position-relative">
                                            <label class="form-label" for="dlab-password">Password <span
                                                    class="text-danger">*</span> </label>
                                            <input type="password" name="password" id="dlab-password"
                                                class="form-control @error('password') input-invalid @enderror"
                                                placeholder="Enter password" required minlength="6" maxlength="20">

                                            <span class="show-pass eye">
                                                <i class="fa fa-eye-slash"></i>
                                                <i class="fa fa-eye"></i>
                                            </span>
                                            @error('password')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6 position-relative">
                                            <label class="form-label" for="password_confirmation">Confirm Password <span
                                                    class="text-danger">*</span></label>
                                            <input type="password" name="password_confirmation"
                                                id="password_confirmation"
                                                class="form-control @error('password_confirmation') input-invalid @enderror"
                                                placeholder="Enter confirm password" required minlength="6"
                                                maxlength="20">

                                            <span class="show-pass eye">
                                                <i class="fa fa-eye-slash"></i>
                                                <i class="fa fa-eye"></i>
                                            </span>
                                            @error('password_confirmation')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Team Members</button>
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
