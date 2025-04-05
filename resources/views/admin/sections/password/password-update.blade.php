@extends('admin.layouts.app')

@section('css')
    <style>
        .font-semibold {
            font-size: 16px;
        }
    </style>
@endsection

@php
    $password_type = ['Facebook', 'Instagram', 'Twitter', 'Linkedin', 'Google', 'Microsoft'];
@endphp

@section('main-content')
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.view.password.list') }}">Passwords</a></li>
                    <li class="breadcrumb-item active"><a
                            href="{{ route('admin.view.password.update', ['id' => $password->id]) }}">Edit Password</a></li>
                </ol>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Update Password Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ route('admin.handle.password.update', ['id' => $password->id]) }}"
                                    method="POST">
                                    @csrf
                                    <div class="row">
                                        {{-- Customer --}}
                                        <div class="col-xl-6 mb-3">
                                            <label for="customer_id" class="form-label">Customer</label>
                                            <select class="form-select @error('customer_id') input-invalid @enderror"
                                                name="customer_id">
                                                <option value="">Select Customer</option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}" @selected($password->customer_id == $customer->id)>
                                                        {{ $customer->name }} ({{ $customer->company_name }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('customer_id')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Type --}}
                                        <div class="col-md-6 mb-3">
                                            <label for="type" class="form-label">Type <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select @error('type') input-invalid @enderror"
                                                name="type" required>
                                                <option value="">Select Type</option>
                                                @foreach ($password_type as $type)
                                                    <option value="{{ $type }}" @selected($password->type == $type)>
                                                        {{ $type }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('type')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <h1 class="font-semibold">Credentials Information</h1>
                                    </div>

                                    <div class="row">
                                        {{-- Username --}}
                                        <div class="col-md-3 mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" name="username"
                                                value="{{ old('username', $password->username) }}"
                                                class="form-control @error('username') input-invalid @enderror"
                                                placeholder="Enter username" minlength="1" maxlength="250">
                                            @error('username')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Email --}}
                                        <div class="col-md-3 mb-3">
                                            <label for="email" class="form-label">Email address</label>
                                            <input type="email" name="email"
                                                value="{{ old('email', $password->email) }}"
                                                class="form-control @error('email') input-invalid @enderror"
                                                placeholder="Enter email address" minlength="1" maxlength="250">
                                            @error('email')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Phone --}}
                                        <div class="col-md-3 mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="tel" name="phone"
                                                value="{{ old('phone', $password->phone) }}"
                                                class="form-control @error('phone') input-invalid @enderror"
                                                placeholder="Enter phone" minlength="10" maxlength="12"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                            @error('phone')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Password --}}
                                        <div class="col-md-3 mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="text" name="password"
                                                value="{{ old('password', $password->password) }}"
                                                class="form-control @error('password') input-invalid @enderror"
                                                placeholder="Enter password" minlength="1" maxlength="250">
                                            @error('password')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
