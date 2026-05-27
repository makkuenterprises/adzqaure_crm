@extends('admin.layouts.app')

@section('css')
    <style>
        .input-error {
            color: red;
            font-size: 0.875rem;
            margin-top: 5px;
            display: block;
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
						<li class="breadcrumb-item"><a href="{{ route('admin.view.customer.list') }}">Customers</a></li>
						<li class="breadcrumb-item active"><a href="{{ route('admin.view.customer.create') }}">Create Customer</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
					<div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="{{ route('admin.handle.customer.create') }}" method="POST" enctype="multipart/form-data" class="needs-loader">
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-12 mb-3">
                                                <label for="formFile" class="form-label">Profile</label>
                                                <input type="file"
                                                    class="form-control @error('profile') input-invalid @enderror"
                                                    accept="image/jpeg, image/jpg, image/png" name="profile">
                                                @error('profile')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            {{-- Full Name --}}
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Full Name<span class="text-danger">*</span></label>
                                                <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') input-invalid @enderror" placeholder="Enter Name" required>
                                                @error('name')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            {{-- Email address --}}
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') input-invalid @enderror" placeholder="Enter Email" required>
                                                @error('email')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            {{-- Password --}}
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Password <span class="text-danger">*</span></label>
                                                <input type="password" name="password" class="form-control @error('password') input-invalid @enderror" placeholder="Create Password" required>
                                                @error('password')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            {{-- Confirm Password --}}
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                                            </div>

                                            {{-- Phone --}}
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Phone<span class="text-danger">*</span></label>
                                                <input type="tel" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') input-invalid @enderror" placeholder="Enter Phone" minlength="10" maxlength="12" required
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                @error('phone')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            {{-- Business Phone --}}
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Business Phone</label>
                                                <input type="tel" name="phone_alternate" value="{{ old('phone_alternate') }}" class="form-control @error('phone_alternate') input-invalid @enderror" placeholder="Enter Business Phone" minlength="10" maxlength="12"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                @error('phone_alternate')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            {{-- WhatsApp Phone --}}
                                            <div class="mb-3 col-md-6">
                                                <label for="whatsapp" class="form-label">WhatsApp Phone</label>
                                                <input type="tel" name="whatsapp" value="{{ old('whatsapp') }}" class="form-control @error('whatsapp') input-invalid @enderror" placeholder="Enter WhatsApp Phone" minlength="10" maxlength="12"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                @error('whatsapp')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            {{-- Company Name --}}
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Company Name<span class="text-danger">*</span></label>
                                                <input type="text" name="company_name" value="{{ old('company_name') }}" class="form-control @error('company_name') input-invalid @enderror" placeholder="Enter Company Name" required>
                                                @error('company_name')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            {{-- Website Link --}}
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Website Link<span class="text-danger">*</span></label>
                                                <input type="url" name="website" value="{{ old('website') }}" class="form-control @error('website') input-invalid @enderror" placeholder="Enter Website" required>
                                                @error('website')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            {{-- Street --}}
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Street</label>
                                                <input type="text" name="street" value="{{ old('street') }}"
                                                    class="form-control @error('street') input-invalid @enderror"
                                                    placeholder="Enter street address">
                                                @error('street')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            {{-- City --}}
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">City</label>
                                                <input type="text" name="city" value="{{ old('city') }}"
                                                    class="form-control @error('city') input-invalid @enderror"
                                                    placeholder="Enter city">
                                                @error('city')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            {{-- Pincode --}}
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

                                            {{-- State --}}
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">State</label>
                                                <input type="text" name="state" value="{{ old('state') }}"
                                                    class="form-control @error('state') input-invalid @enderror"
                                                    placeholder="Enter state">
                                                @error('state')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            {{-- Country --}}
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Country</label>
                                                <input type="text" name="country" value="{{ old('country') }}"
                                                    class="form-control @error('country') input-invalid @enderror"
                                                    placeholder="Enter country">
                                                @error('country')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Create Customer</button>
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
