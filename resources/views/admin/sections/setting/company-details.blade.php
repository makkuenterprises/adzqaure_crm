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
        <h1 class="panel-title">Company Details</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.setting') }}">Setting</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.company.details.setting') }}">Company Details</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    {{-- <form action="{{ route('admin.handle.company.details.update') }}" method="POST" enctype="multipart/form-data">
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

                    <div class="md:col-span-4 sm:col-span-1">
                        <h1 class="font-semibold ">General Information</h1>
                    </div>


                    <div class="md:col-span-4 sm:col-span-1">
                        <div class="flex md:flex-row sm:flex-col items-center md:space-x-5">
                            <img src="{{ is_null(DB::table('company_details')->where('name', 'company_logo')->first()->value) ? asset('admin/images/default-profile.png') : asset('storage/' . DB::table('company_details')->where('name', 'company_logo')->first()->value) }}"
                                id="company_logo" alt="company_logo" class="h-24 w-24 rounded-md border bg-white" />
                            <div class="input-group">
                                <label for="company_logo" class="input-label">Company Logo</label>
                                <input type="file" accept="image/jpeg, image/jpg, image/png" class="input-box-sm"
                                    name="company_logo" onchange="handleProfilePreview(event)">
                                @error('profile')
                                    <span class="input-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="input-group">
                        <label for="company_name" class="input-label">Company Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="company_name"
                            value="{{ old('company_name', DB::table('company_details')->where('name', 'company_name')->first()->value) }}"
                            class="input-box-md @error('company_name') input-invalid @enderror"
                            placeholder="Enter company name" required>
                        @error('company_name')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="input-group">
                        <label for="company_email" class="input-label">Company Email Address <span
                                class="text-red-500">*</span></label>
                        <input type="email" name="company_email"
                            value="{{ old('company_email', DB::table('company_details')->where('name', 'company_email')->first()->value) }}"
                            class="input-box-md @error('company_email') input-invalid @enderror"
                            placeholder="Enter company email" required>
                        @error('company_email')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="input-group">
                        <label for="company_phone" class="input-label">Company Phone<span
                                class="text-red-500">*</span></label>
                        <input type="tel" name="company_phone"
                            value="{{ old('company_phone', DB::table('company_details')->where('name', 'company_phone')->first()->value) }}"
                            class="input-box-md @error('company_phone') input-invalid @enderror"
                            placeholder="Enter company phone" required>
                        @error('company_phone')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="input-group">
                        <label for="company_phone_alternate" class="input-label">Company Phone (Alternate)</label>
                        <input type="tel" name="company_phone_alternate"
                            value="{{ old('company_phone_alternate', DB::table('company_details')->where('name', 'company_phone_alternate')->first()->value) }}"
                            class="input-box-md @error('company_phone_alternate') input-invalid @enderror"
                            placeholder="Enter company phone alternate">
                        @error('company_phone_alternate')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="input-group">
                        <label for="company_website" class="input-label">Company Website <span
                                class="text-red-500">*</span></label>
                        <input type="url" name="company_website"
                            value="{{ old('company_website', DB::table('company_details')->where('name', 'company_website')->first()->value) }}"
                            class="input-box-md @error('company_website') input-invalid @enderror"
                            placeholder="Enter company website link" required>
                        @error('company_website')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-4 sm:col-span-1">
                        <h1 class="font-semibold ">Address Information</h1>
                    </div>


                    <div class="input-group">
                        <label for="company_address_street" class="input-label">Street</label>
                        <input type="text" name="company_address_street"
                            value="{{ old('company_address_street', DB::table('company_details')->where('name', 'company_address_street')->first()->value) }}"
                            class="input-box-md @error('company_address_street') input-invalid @enderror"
                            placeholder="Enter street">
                        @error('company_address_street')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="input-group">
                        <label for="company_address_city" class="input-label">City</label>
                        <input type="text" name="company_address_city"
                            value="{{ old('company_address_city', DB::table('company_details')->where('name', 'company_address_city')->first()->value) }}"
                            class="input-box-md @error('company_address_city') input-invalid @enderror"
                            placeholder="Enter city">
                        @error('company_address_city')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="input-group">
                        <label for="company_address_pincode" class="input-label">Pincode</label>
                        <input type="text" name="company_address_pincode"
                            value="{{ old('company_address_pincode', DB::table('company_details')->where('name', 'company_address_pincode')->first()->value) }}"
                            class="input-box-md @error('company_address_pincode') input-invalid @enderror"
                            placeholder="Enter pincode">
                        @error('company_address_pincode')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="input-group">
                        <label for="company_address_state" class="input-label">State</label>
                        <input type="text" name="company_address_state"
                            value="{{ old('company_address_state', DB::table('company_details')->where('name', 'company_address_state')->first()->value) }}"
                            class="input-box-md @error('company_address_state') input-invalid @enderror"
                            placeholder="Enter state">
                        @error('company_address_state')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="input-group">
                        <label for="company_address_country" class="input-label">Country</label>
                        <input type="text" name="company_address_country"
                            value="{{ old('company_address_country', DB::table('company_details')->where('name', 'company_address_country')->first()->value) }}"
                            class="input-box-md @error('company_address_country') input-invalid @enderror"
                            placeholder="Enter country">
                        @error('company_address_country')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-4 sm:col-span-1">
                        <h1 class="font-semibold ">Payment Information</h1>
                    </div>


                    <div class="input-group">
                        <label for="company_account_type" class="input-label">Company Account Type</label>
                        <input type="text" name="company_account_type"
                            value="{{ old('company_account_type', DB::table('company_details')->where('name', 'company_account_type')->first()->value) }}"
                            class="input-box-md @error('company_account_type') input-invalid @enderror"
                            placeholder="Enter account type">
                        @error('company_account_type')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="input-group">
                        <label for="company_account_no" class="input-label">Company Account Number</label>
                        <input type="text" name="company_account_no"
                            value="{{ old('company_account_no', DB::table('company_details')->where('name', 'company_account_no')->first()->value) }}"
                            class="input-box-md @error('company_account_no') input-invalid @enderror"
                            placeholder="Enter account number">
                        @error('company_account_no')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="input-group">
                        <label for="company_account_holder" class="input-label">Company Account Holder</label>
                        <input type="text" name="company_account_holder"
                            value="{{ old('company_account_holder', DB::table('company_details')->where('name', 'company_account_holder')->first()->value) }}"
                            class="input-box-md @error('company_account_holder') input-invalid @enderror"
                            placeholder="Enter account holder">
                        @error('company_account_holder')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="input-group">
                        <label for="company_account_ifsc" class="input-label">Company Account IFSC</label>
                        <input type="text" name="company_account_ifsc"
                            value="{{ old('company_account_ifsc', DB::table('company_details')->where('name', 'company_account_ifsc')->first()->value) }}"
                            class="input-box-md @error('company_account_ifsc') input-invalid @enderror"
                            placeholder="Enter account ifsc">
                        @error('company_account_ifsc')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="input-group">
                        <label for="company_account_branch" class="input-label">Company Account Branch</label>
                        <input type="text" name="company_account_branch"
                            value="{{ old('company_account_branch', DB::table('company_details')->where('name', 'company_account_branch')->first()->value) }}"
                            class="input-box-md @error('company_account_branch') input-invalid @enderror"
                            placeholder="Enter account branch">
                        @error('company_account_branch')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="input-group">
                        <label for="company_account_vpa" class="input-label">Company Account VPA (UPI)</label>
                        <input type="text" name="company_account_vpa"
                            value="{{ old('company_account_vpa', DB::table('company_details')->where('name', 'company_account_vpa')->first()->value) }}"
                            class="input-box-md @error('company_account_vpa') input-invalid @enderror"
                            placeholder="Enter account vpa">
                        @error('company_account_vpa')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="input-group">
                        <label for="company_gst_number" class="input-label">GST Number <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="company_gst_number"
                            class="input-box-md @error('company_gst_number') input-invalid @enderror"
                            placeholder="Enter GST number with GST prefix" required>
                        @error('company_gst_number')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="input-group">
                        <label for="billing_tax_percentage" class="input-label">Tax Percentag (GST) <span
                                class="text-red-500">*</span></label>
                        <input type="number" step="any" name="billing_tax_percentage"
                            value="{{ old('billing_tax_percentage', DB::table('company_details')->where('name', 'billing_tax_percentage')->first()->value) }}"
                            class="input-box-md @error('billing_tax_percentage') input-invalid @enderror"
                            placeholder="Enter tax percentage" required>
                        @error('billing_tax_percentage')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-4 sm:col-span-1">
                        <h1 class="font-semibold ">Social Media</h1>
                    </div>


                    <div class="input-group">
                        <label for="company_social_media_facebook" class="input-label">Facebook</label>
                        <input type="text" name="company_social_media_facebook"
                            value="{{ old('company_social_media_facebook', DB::table('company_details')->where('name', 'company_social_media_facebook')->first()->value) }}"
                            class="input-box-md @error('company_social_media_facebook') input-invalid @enderror"
                            placeholder="Enter facebook">
                        @error('company_social_media_facebook')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="input-group">
                        <label for="company_social_media_twitter" class="input-label">Twitter</label>
                        <input type="text" name="company_social_media_twitter"
                            value="{{ old('company_social_media_twitter', DB::table('company_details')->where('name', 'company_social_media_twitter')->first()->value) }}"
                            class="input-box-md @error('company_social_media_twitter') input-invalid @enderror"
                            placeholder="Enter twitter">
                        @error('company_social_media_twitter')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="input-group">
                        <label for="company_social_media_instagram" class="input-label">Instagram</label>
                        <input type="text" name="company_social_media_instagram"
                            value="{{ old('company_social_media_instagram', DB::table('company_details')->where('name', 'company_social_media_instagram')->first()->value) }}"
                            class="input-box-md @error('company_social_media_instagram') input-invalid @enderror"
                            placeholder="Enter instagram">
                        @error('company_social_media_instagram')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="input-group">
                        <label for="company_social_media_linkedin" class="input-label">Linkedin</label>
                        <input type="text" name="company_social_media_linkedin"
                            value="{{ old('company_social_media_linkedin', DB::table('company_details')->where('name', 'company_social_media_linkedin')->first()->value) }}"
                            class="input-box-md @error('company_social_media_linkedin') input-invalid @enderror"
                            placeholder="Enter linkedin">
                        @error('company_social_media_linkedin')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="input-group">
                        <label for="company_social_media_youtube" class="input-label">Youtube</label>
                        <input type="text" name="company_social_media_youtube"
                            value="{{ old('company_social_media_youtube', DB::table('company_details')->where('name', 'company_social_media_youtube')->first()->value) }}"
                            class="input-box-md @error('company_social_media_youtube') input-invalid @enderror"
                            placeholder="Enter youtube">
                        @error('company_social_media_youtube')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="panel-card-footer">
                <button type="submit" class="btn-primary-md md:w-fit sm:w-full">Save Changes</button>
            </div>
        </figure>
    </form> --}}

    <form action="{{ route('admin.handle.company.details.update') }}" method="POST" enctype="multipart/form-data">
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

                    <div class="md:col-span-4 sm:col-span-1">
                        <h1 class="font-semibold">General Information</h1>
                    </div>

                    <!-- Company Logo -->
                    {{-- {{ dd($company_details->company_logo) }} --}}

                    {{-- <div class="md:col-span-4 sm:col-span-1">
                        <div class="flex md:flex-row sm:flex-col items-center md:space-x-5">
                            <img src="{{ empty($company_details->company_logo) ? asset('admin/images/default-profile.png') : asset('admin/company_logo/' . $company_details->company_logo) }}"
                                id="company_logo" alt="company_logo" class="h-24 w-24 rounded-md border bg-white" />
                            <div class="input-group">
                                <label for="company_logo" class="input-label">Company Logo</label>
                                <input type="file" accept="image/jpeg, image/jpg, image/png" class="input-box-sm"
                                    name="company_logo" onchange="handleProfilePreview(event)">
                                @error('company_logo')
                                    <span class="input-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div> --}}

                    <div class="md:col-span-4 sm:col-span-1">
                        <div class="flex md:flex-row sm:flex-col items-center md:space-x-5 sm:space-y-5">

                            <!-- Company Logo -->
                            <div class="flex items-center space-x-3 w-full md:w-auto">
                                <img src="{{ empty($company_details->company_logo) ? asset('admin/images/default-profile.png') : asset('admin/company_logo/' . $company_details->company_logo) }}"
                                    id="company_logo" alt="company_logo" class="h-24 w-24 rounded-md border bg-white" />
                                <div class="flex flex-col w-full">
                                    <label for="company_logo" class="input-label">Company Logo</label>
                                    <input type="file" accept="image/jpeg, image/jpg, image/png" class="input-box-sm"
                                        name="company_logo" onchange="handleProfilePreview(event)">
                                    @error('company_logo')
                                        <span class="input-error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Brand Logo -->
                            <div class="flex items-center space-x-3 w-full md:w-auto mt-5">
                                <img src="{{ empty($company_details->brand_logo) ? asset('admin/images/default-profile.png') : asset('admin/brand_logo/' . $company_details->brand_logo) }}"
                                    id="brand_logo" alt="brand_logo" class="h-24 w-24 rounded-md border bg-white" />
                                <div class="flex flex-col w-full">
                                    <label for="brand_logo" class="input-label">Brand Logo</label>
                                    <input type="file" accept="image/jpeg, image/jpg, image/png" class="input-box-sm"
                                        name="brand_logo" onchange="handleProfilePreview(event)">
                                    @error('brand_logo')
                                        <span class="input-error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>






                    <!-- Brand Name -->
                    <div class="input-group">
                        <label for="brand_name" class="input-label">Brand Name <span class="text-red-500">*</span></label>
                        <input type="text" name="brand_name"
                            value="{{ old('brand_name', $company_details->brand_name ?? '') }}"
                            class="input-box-md @error('brand_name') input-invalid @enderror" placeholder="Enter brand name"
                            required>
                        @error('brand_name')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>


                    <!-- Company Name -->
                    <div class="input-group">
                        <label for="company_name" class="input-label">Company Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="company_name"
                            value="{{ old('company_name', $company_details->company_name ?? '') }}"
                            class="input-box-md @error('company_name') input-invalid @enderror"
                            placeholder="Enter company name" required>
                        @error('company_name')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Company Email Address -->
                    <div class="input-group">
                        <label for="company_email" class="input-label">Company Email Address <span
                                class="text-red-500">*</span></label>
                        <input type="email" name="company_email"
                            value="{{ old('company_email', $company_details->company_email ?? '') }}"
                            class="input-box-md @error('company_email') input-invalid @enderror"
                            placeholder="Enter company email" required>
                        @error('company_email')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Company Phone -->
                    <div class="input-group">
                        <label for="company_phone" class="input-label">Company Phone <span
                                class="text-red-500">*</span></label>
                        <input type="tel" name="company_phone"
                            value="{{ old('company_phone', $company_details->company_phone ?? '') }}"
                            class="input-box-md @error('company_phone') input-invalid @enderror"
                            placeholder="Enter company phone" required>
                        @error('company_phone')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Company Phone (Alternate) -->
                    <div class="input-group">
                        <label for="company_phone_alternate" class="input-label">Company Phone (Alternate)</label>
                        <input type="tel" name="company_phone_alternate"
                            value="{{ old('company_phone_alternate', $company_details->company_phone_alternate ?? '') }}"
                            class="input-box-md @error('company_phone_alternate') input-invalid @enderror"
                            placeholder="Enter company phone alternate">
                        @error('company_phone_alternate')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Company Website -->
                    <div class="input-group">
                        <label for="company_website" class="input-label">Company Website <span
                                class="text-red-500">*</span></label>
                        <input type="url" name="company_website"
                            value="{{ old('company_website', $company_details->company_website ?? '') }}"
                            class="input-box-md @error('company_website') input-invalid @enderror"
                            placeholder="Enter company website link" required>
                        @error('company_website')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Address Information -->
                    <div class="md:col-span-4 sm:col-span-1">
                        <h1 class="font-semibold">Address Information</h1>
                    </div>

                    <!-- Company Street -->
                    <div class="input-group">
                        <label for="company_address_street" class="input-label">Street</label>
                        <input type="text" name="company_address_street"
                            value="{{ old('company_address_street', $company_details->company_address_street ?? '') }}"
                            class="input-box-md @error('company_address_street') input-invalid @enderror"
                            placeholder="Enter street">
                        @error('company_address_street')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Company City -->
                    <div class="input-group">
                        <label for="company_address_city" class="input-label">City</label>
                        <input type="text" name="company_address_city"
                            value="{{ old('company_address_city', $company_details->company_address_city ?? '') }}"
                            class="input-box-md @error('company_address_city') input-invalid @enderror"
                            placeholder="Enter city">
                        @error('company_address_city')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Company Pincode -->
                    <div class="input-group">
                        <label for="company_address_pincode" class="input-label">Pincode</label>
                        <input type="text" name="company_address_pincode"
                            value="{{ old('company_address_pincode', $company_details->company_address_pincode ?? '') }}"
                            class="input-box-md @error('company_address_pincode') input-invalid @enderror"
                            placeholder="Enter pincode">
                        @error('company_address_pincode')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Company State -->
                    <div class="input-group">
                        <label for="company_address_state" class="input-label">State</label>
                        <input type="text" name="company_address_state"
                            value="{{ old('company_address_state', $company_details->company_address_state ?? '') }}"
                            class="input-box-md @error('company_address_state') input-invalid @enderror"
                            placeholder="Enter state">
                        @error('company_address_state')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Company Country -->
                    <div class="input-group">
                        <label for="company_address_country" class="input-label">Country</label>
                        <input type="text" name="company_address_country"
                            value="{{ old('company_address_country', $company_details->company_address_country ?? '') }}"
                            class="input-box-md @error('company_address_country') input-invalid @enderror"
                            placeholder="Enter country">
                        @error('company_address_country')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Payment Information -->
                    <div class="md:col-span-4 sm:col-span-1">
                        <h1 class="font-semibold">Payment Information</h1>
                    </div>

                    <!-- Company Account Type -->
                    <div class="input-group">
                        <label for="company_account_type" class="input-label">Company Account Type</label>
                        <input type="text" name="company_account_type"
                            value="{{ old('company_account_type', $company_details->company_account_type ?? '') }}"
                            class="input-box-md @error('company_account_type') input-invalid @enderror"
                            placeholder="Enter account type">
                        @error('company_account_type')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Company Account Number -->
                    <div class="input-group">
                        <label for="company_account_no" class="input-label">Company Account Number</label>
                        <input type="text" name="company_account_no"
                            value="{{ old('company_account_no', $company_details->company_account_no ?? '') }}"
                            class="input-box-md @error('company_account_no') input-invalid @enderror"
                            placeholder="Enter account number">
                        @error('company_account_no')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Company Account Holder -->
                    <div class="input-group">
                        <label for="company_account_holder" class="input-label">Company Account Holder</label>
                        <input type="text" name="company_account_holder"
                            value="{{ old('company_account_holder', $company_details->company_account_holder ?? '') }}"
                            class="input-box-md @error('company_account_holder') input-invalid @enderror"
                            placeholder="Enter account holder">
                        @error('company_account_holder')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Company Account IFSC -->
                    <div class="input-group">
                        <label for="company_account_ifsc" class="input-label">Company Account IFSC</label>
                        <input type="text" name="company_account_ifsc"
                            value="{{ old('company_account_ifsc', $company_details->company_account_ifsc ?? '') }}"
                            class="input-box-md @error('company_account_ifsc') input-invalid @enderror"
                            placeholder="Enter account IFSC">
                        @error('company_account_ifsc')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Company Account Branch -->
                    <div class="input-group">
                        <label for="company_account_branch" class="input-label">Company Account Branch</label>
                        <input type="text" name="company_account_branch"
                            value="{{ old('company_account_branch', $company_details->company_account_branch ?? '') }}"
                            class="input-box-md @error('company_account_branch') input-invalid @enderror"
                            placeholder="Enter account branch">
                        @error('company_account_branch')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Company Account VPA -->
                    <div class="input-group">
                        <label for="company_account_vpa" class="input-label">Company Account VPA (UPI)</label>
                        <input type="text" name="company_account_vpa"
                            value="{{ old('company_account_vpa', $company_details->company_account_vpa ?? '') }}"
                            class="input-box-md @error('company_account_vpa') input-invalid @enderror"
                            placeholder="Enter account VPA">
                        @error('company_account_vpa')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- GST Number -->
                    <div class="input-group">
                        <label for="company_gst_number" class="input-label">GST Number <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="company_gst_number"
                            value="{{ old('company_gst_number', $company_details->company_gst_number ?? '') }}"
                            class="input-box-md @error('company_gst_number') input-invalid @enderror"
                            placeholder="Enter GST number">
                        @error('company_gst_number')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Tax Percentage -->
                    <div class="input-group">
                        <label for="billing_tax_percentage" class="input-label">Tax Percentage (GST) <span
                                class="text-red-500">*</span></label>
                        <input type="number" step="any" name="billing_tax_percentage"
                            value="{{ old('billing_tax_percentage', $company_details->billing_tax_percentage ?? '') }}"
                            class="input-box-md @error('billing_tax_percentage') input-invalid @enderror"
                            placeholder="Enter tax percentage" required>
                        @error('billing_tax_percentage')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Social Media -->
                    <div class="md:col-span-4 sm:col-span-1">
                        <h1 class="font-semibold">Social Media</h1>
                    </div>

                    <!-- Facebook -->
                    <div class="input-group">
                        <label for="company_social_media_facebook" class="input-label">Facebook</label>
                        <input type="text" name="company_social_media_facebook"
                            value="{{ old('company_social_media_facebook', $company_details->company_social_media_facebook ?? '') }}"
                            class="input-box-md @error('company_social_media_facebook') input-invalid @enderror"
                            placeholder="Enter Facebook">
                        @error('company_social_media_facebook')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Twitter -->
                    <div class="input-group">
                        <label for="company_social_media_twitter" class="input-label">Twitter</label>
                        <input type="text" name="company_social_media_twitter"
                            value="{{ old('company_social_media_twitter', $company_details->company_social_media_twitter ?? '') }}"
                            class="input-box-md @error('company_social_media_twitter') input-invalid @enderror"
                            placeholder="Enter Twitter">
                        @error('company_social_media_twitter')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Instagram -->
                    <div class="input-group">
                        <label for="company_social_media_instagram" class="input-label">Instagram</label>
                        <input type="text" name="company_social_media_instagram"
                            value="{{ old('company_social_media_instagram', $company_details->company_social_media_instagram ?? '') }}"
                            class="input-box-md @error('company_social_media_instagram') input-invalid @enderror"
                            placeholder="Enter Instagram">
                        @error('company_social_media_instagram')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- LinkedIn -->
                    <div class="input-group">
                        <label for="company_social_media_linkedin" class="input-label">LinkedIn</label>
                        <input type="text" name="company_social_media_linkedin"
                            value="{{ old('company_social_media_linkedin', $company_details->company_social_media_linkedin ?? '') }}"
                            class="input-box-md @error('company_social_media_linkedin') input-invalid @enderror"
                            placeholder="Enter LinkedIn">
                        @error('company_social_media_linkedin')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- YouTube -->
                    <div class="input-group">
                        <label for="company_social_media_youtube" class="input-label">YouTube</label>
                        <input type="text" name="company_social_media_youtube"
                            value="{{ old('company_social_media_youtube', $company_details->company_social_media_youtube ?? '') }}"
                            class="input-box-md @error('company_social_media_youtube') input-invalid @enderror"
                            placeholder="Enter YouTube">
                        @error('company_social_media_youtube')
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
        document.getElementById('setting-tab').classList.add('active');
    </script>
@endsection
