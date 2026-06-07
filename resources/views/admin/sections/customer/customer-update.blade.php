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
                    <li class="breadcrumb-item active"><a
                            href="{{ route('admin.view.customer.update', ['id' => $customer->id]) }}">Update Customer</a>
                    </li>
                </ol>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Update Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ route('admin.handle.customer.update', ['id' => $customer->id]) }}"
                                    method="POST" enctype="multipart/form-data" class="needs-loader">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-12 mb-3">
                                            <label for="formFile" class="form-label">Profile</label>

                                            <!-- Profile image section -->
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="profile-preview">
                                                    @if ($customer->profile)
                                                        <img src="{{ asset('admin/customers/' . $customer->profile) }}"
                                                            alt="Profile Image" class="img-thumbnail"
                                                            style="max-width: 100px; height: auto;">
                                                    @else
                                                        <img src="{{ asset('admin/customers/default-profile.png') }}"
                                                            alt="Default Profile Image" class="img-thumbnail"
                                                            style="max-width: 100px; height: auto;">
                                                    @endif
                                                </div>

                                                <!-- Profile file input -->
                                                <input type="file"
                                                    class="form-control ms-3 @error('profile') input-invalid @enderror"
                                                    accept="image/jpeg, image/jpg, image/png" name="profile"
                                                    onchange="handleProfilePreview(event)">
                                            </div>

                                            @error('profile')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Full Name --}}
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Full Name<span class="text-danger">*</span></label>
                                            <input type="text" name="name" value="{{ old('name', $customer->name) }}"
                                                class="form-control @error('name') input-invalid @enderror"
                                                placeholder="Enter Name" required>
                                            @error('name')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Email --}}
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Email<span class="text-danger">*</span></label>
                                            <input type="email" name="email"
                                                value="{{ old('email', $customer->email) }}"
                                                class="form-control @error('email') input-invalid @enderror"
                                                placeholder="Enter Email" required>
                                            @error('email')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Phone --}}
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Phone<span class="text-danger">*</span></label>
                                            <input type="tel" name="phone"
                                                value="{{ old('phone', $customer->phone) }}"
                                                class="form-control @error('phone') input-invalid @enderror"
                                                placeholder="Enter Phone" minlength="10" maxlength="12" required
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                            @error('phone')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Business Phone --}}
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Business Phone</label>
                                            <input type="tel" name="phone_alternate"
                                                value="{{ old('phone_alternate', $customer->phone_alternate) }}"
                                                class="form-control @error('phone_alternate') input-invalid @enderror"
                                                placeholder="Enter Business Phone" minlength="10" maxlength="12"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                            @error('phone_alternate')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- WhatsApp Phone --}}
                                        <div class="mb-3 col-md-6">
                                            <label for="whatsapp" class="form-label">WhatsApp Phone</label>
                                            <input type="tel" name="whatsapp"
                                                value="{{ old('whatsapp', $customer->whatsapp) }}"
                                                class="form-control @error('whatsapp') input-invalid @enderror"
                                                placeholder="Enter WhatsApp Phone" minlength="10" maxlength="12"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                            @error('whatsapp')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Company Name --}}
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Company Name<span class="text-danger">*</span></label>
                                            <input type="text" name="company_name"
                                                value="{{ old('company_name', $customer->company_name) }}"
                                                class="form-control @error('company_name') input-invalid @enderror"
                                                placeholder="Enter Company Name" required>
                                            @error('company_name')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Website Link --}}
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Website Link<span class="text-danger">*</span></label>
                                            <input type="url" name="website"
                                                value="{{ old('website', $customer->website) }}"
                                                class="form-control @error('website') input-invalid @enderror"
                                                placeholder="Enter Website" required>
                                            @error('website')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Date of Onboarding --}}
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Date of Onboarding</label>
                                            <input type="date" name="onboarding_date"
                                                value="{{ old('onboarding_date', $customer->onboarding_date) }}"
                                                class="form-control @error('onboarding_date') input-invalid @enderror">
                                            @error('onboarding_date')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Services Interested In (Multi-select Checklist) --}}
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Services Interested In</label>
                                            @php
                                                // Decode saved services to pre-select them in the grid
                                                $savedServices = json_decode($customer->interested_services) ?? [];
                                            @endphp
                                            <select class="default-select form-control wide" name="interested_services[]" multiple data-actions-box="true">
                                                @foreach ([
                                                    'SMM' => 'SMM (Social Media Marketing)',
                                                    'SEO' => 'SEO (Search Engine Optimization)',
                                                    'Logo Designing' => 'Logo Designing',
                                                    'Website Development' => 'Website Development',
                                                    'Mobile App Development' => 'Mobile App Development',
                                                    'Content Writing' => 'Content Writing',
                                                    'PPC Campaigns' => 'PPC Campaigns (Google Ads)'
                                                ] as $value => $label)
                                                    <option value="{{ $value }}" @selected(
                                                        (is_array(old('interested_services')) && in_array($value, old('interested_services'))) ||
                                                        (is_array($savedServices) && in_array($value, $savedServices))
                                                    )>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('interested_services')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Street --}}
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Street</label>
                                            <input type="text" name="street"
                                                value="{{ old('street', $customer->street) }}"
                                                class="form-control @error('street') input-invalid @enderror"
                                                placeholder="Enter street address">
                                            @error('street')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- City --}}
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">City</label>
                                            <input type="text" name="city"
                                                value="{{ old('city', $customer->city) }}"
                                                class="form-control @error('city') input-invalid @enderror"
                                                placeholder="Enter city">
                                            @error('city')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Pincode --}}
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Pincode</label>
                                            <input type="text" name="pincode"
                                                value="{{ old('pincode', $customer->pincode) }}"
                                                class="form-control @error('pincode') input-invalid @enderror"
                                                placeholder="Enter pincode" minlength="1" maxlength="6"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                            @error('pincode')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- State Dropdown Selector (Preselected) --}}
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">State</label>
                                            <select class="default-select form-control wide" name="state">
                                                <option value="">Select State</option>
                                                @foreach (['Bihar', 'Delhi', 'Maharashtra', 'Uttar Pradesh', 'West Bengal', 'Karnataka', 'Tamil Nadu', 'Telangana', 'Other'] as $st)
                                                    <option value="{{ $st }}" @selected(old('state', $customer->state) == $st)>{{ $st }}</option>
                                                @endforeach
                                            </select>
                                            @error('state')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Country Dropdown Selector (Preselected) --}}
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Country</label>
                                            <select class="default-select form-control wide" name="country">
                                                @foreach (['India', 'United States', 'Australia', 'United Kingdom', 'Canada', 'Other'] as $cn)
                                                    <option value="{{ $cn }}" @selected(old('country', $customer->country) == $cn)>{{ $cn }}</option>
                                                @endforeach
                                            </select>
                                            @error('country')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Customer</button>
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
