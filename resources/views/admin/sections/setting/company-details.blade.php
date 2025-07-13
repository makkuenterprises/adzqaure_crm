@extends('admin.layouts.app')


@section('main-content')
      <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body default-height">
            <div class="container-fluid">
				<div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('admin.view.setting') }}">Settings</a></li>
						<li class="breadcrumb-item active"><a href="{{ route('admin.view.company.details.setting') }}">Company Details</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
					<div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Update Company Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="{{ route('admin.handle.company.details.update') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-12 mb-3">
                                                <label for="formFile" class="form-label">Company Logo</label>

                                                <!-- Profile image section -->
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="profile-preview">
                                                        @if (optional($company_details)->company_log)
                                                            <img src="{{ asset('admin/company_logo/' . $company_details->company_logo) }}"
                                                                alt="Profile Image" class="img-thumbnail"
                                                                style="max-width: 100px; height: auto;">
                                                        @else
                                                            <img src="{{ asset('admin/images/default-profile.png') }}"
                                                                alt="Default Profile Image" class="img-thumbnail"
                                                                style="max-width: 100px; height: auto;">
                                                        @endif
                                                    </div>

                                                    <!-- Profile file input -->
                                                    <input type="file"
                                                        class="form-control ms-3 @error('company_logo') input-invalid @enderror"
                                                        accept="image/jpeg, image/jpg, image/png" name="company_logo"
                                                        onchange="handleProfilePreview(event)">
                                                </div>

                                                @error('company_logo')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-xl-12 mb-3">
                                                <label for="formFile" class="form-label">Brand Logo</label>

                                                <!-- Profile image section -->
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="profile-preview">
                                                        @if (optional($company_details)->brand_logo)
                                                            <img src="{{ asset('admin/brand_logo/' . $company_details->brand_logo) }}"
                                                                alt="Profile Image" class="img-thumbnail"
                                                                style="max-width: 100px; height: auto;">
                                                        @else
                                                            <img src="{{ asset('admin/images/default-profile.png') }}"
                                                                alt="Default Profile Image" class="img-thumbnail"
                                                                style="max-width: 100px; height: auto;">
                                                        @endif
                                                    </div>

                                                    <!-- Profile file input -->
                                                    <input type="file"
                                                        class="form-control ms-3 @error('brand_logo') input-invalid @enderror"
                                                        accept="image/jpeg, image/jpg, image/png" name="brand_logo"
                                                        onchange="handleProfilePreview(event)">
                                                </div>

                                                @error('brand_logo')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Brand Name<span class="text-danger">*</span></label>
                                                <input type="text" name="brand_name" value="{{ old('brand_name', $company_details->brand_name ?? '') }}" class="form-control @error('brand_name') input-invalid @enderror" placeholder="Enter Brand Name" minlength="1" maxlength="250">
                                                @error('brand_name')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Company Name<span class="text-danger">*</span></label>
                                                <input type="text" name="company_name" value="{{ old('company_name', $company_details->company_name ?? '') }}" class="form-control @error('company_name') input-invalid @enderror" placeholder="Enter Company Name" minlength="1" maxlength="250">
                                                @error('company_name')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Company Email Address<span class="text-danger">*</span></label>
                                                <input type="email" name="company_email" value="{{ old('company_email', $company_details->company_email ?? '') }}" class="form-control @error('company_email') input-invalid @enderror" placeholder="Enter Company Email" minlength="1" maxlength="250">
                                                @error('company_email')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Company Phone No.<span class="text-danger">*</span></label>
                                                <input type="tel" name="company_phone" value="{{ old('company_phone', $company_details->company_phone ?? '') }}" class="form-control @error('company_phone') input-invalid @enderror" placeholder="Enter Company Phone" minlength="10" maxlength="10"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                @error('company_phone')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Company Phone No. (Alternate)</label>
                                                <input type="tel" name="company_phone_alternate" value="{{ old('company_phone_alternate') }}" class="form-control @error('company_phone_alternate') input-invalid @enderror" placeholder="Enter Alternate Phone No." minlength="10" maxlength="12"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                @error('company_phone_alternate')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Company Website Link<span class="text-danger">*</span></label>
                                                <input type="url" name="company_website" value="{{ old('company_website', $company_details->company_website ?? '') }}" class="form-control @error('company_website') input-invalid @enderror" placeholder="Enter Company Website Link">
                                                @error('company_website')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Street</label>
                                                <input type="text" name="company_address_street" value="{{ old('company_address_street', $company_details->company_address_street ?? '') }}"
                                                    class="form-control @error('company_address_street') input-invalid @enderror"
                                                    placeholder="Enter street address" minlength="1" maxlength="250">
                                                @error('company_address_street')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">City</label>
                                                <input type="text" name="company_address_city" value="{{ old('company_address_city', $company_details->company_address_city ?? '') }}"
                                                    class="form-control @error('company_address_city') input-invalid @enderror"
                                                    placeholder="Enter city" minlength="1" maxlength="250">
                                                @error('company_address_city')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Pincode</label>
                                                <input type="text" name="company_address_pincode" value="{{ old('company_address_pincode', $company_details->company_address_pincode ?? '') }}"
                                                    class="form-control @error('company_address_pincode') input-invalid @enderror"
                                                    placeholder="Enter pincode" minlength="1" maxlength="6"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                @error('company_address_pincode')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">State</label>
                                                <input type="text" name="company_address_state" value="{{ old('company_address_state', $company_details->company_address_state ?? '') }}"
                                                    class="form-control @error('company_address_state') input-invalid @enderror"
                                                    placeholder="Enter state" minlength="1" maxlength="250">
                                                @error('company_address_state')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Country</label>
                                                <input type="text" name="company_address_country" value="{{ old('company_address_country', $company_details->company_address_country ?? '') }}"
                                                    class="form-control @error('company_address_country') input-invalid @enderror"
                                                    placeholder="Enter country" minlength="1" maxlength="250">
                                                @error('company_address_country')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">GST Number<span class="text-danger">*</span></label>
                                                <input type="text" name="company_gst_number" value="{{ old('company_gst_number', $company_details->company_gst_number ?? '') }}"
                                                    class="form-control @error('company_gst_number') input-invalid @enderror"
                                                    placeholder="Enter GST Number">
                                                @error('company_gst_number')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Tax Percentage (GST)<span class="text-danger">*</span></label>
                                                <input type="number" name="billing_tax_percentage" value="{{ old('billing_tax_percentage', $company_details->billing_tax_percentage ?? '') }}"
                                                    class="form-control @error('billing_tax_percentage') input-invalid @enderror"
                                                    placeholder="Enter Tax %">
                                                @error('billing_tax_percentage')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Facebook Link</label>
                                                <input type="url" name="company_social_media_facebook" value="{{ old('company_social_media_facebook', $company_details->company_social_media_facebook ?? '') }}"
                                                    class="form-control @error('company_social_media_facebook') input-invalid @enderror"
                                                    placeholder="Enter Facebook Link">
                                                @error('company_social_media_facebook')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Twitter Link</label>
                                                <input type="url" name="company_social_media_twitter" value="{{ old('company_social_media_twitter', $company_details->company_social_media_twitter ?? '') }}"
                                                    class="form-control @error('company_social_media_twitter') input-invalid @enderror"
                                                    placeholder="Enter Twitter Link">
                                                @error('company_social_media_twitter')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Instagram Link</label>
                                                <input type="url" name="company_social_media_instagram" value="{{ old('company_social_media_instagram', $company_details->company_social_media_instagram ?? '') }}"
                                                    class="form-control @error('company_social_media_instagram') input-invalid @enderror"
                                                    placeholder="Enter Instagram Link">
                                                @error('company_social_media_instagram')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">LinkedIn Link</label>
                                                <input type="url" name="company_social_media_linkedin" value="{{ old('company_social_media_linkedin', $company_details->company_social_media_linkedin ?? '') }}"
                                                    class="form-control @error('company_social_media_linkedin') input-invalid @enderror"
                                                    placeholder="Enter LinkedIn Link">
                                                @error('company_social_media_linkedin')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">YouTube Link</label>
                                                <input type="url" name="company_social_media_youtube" value="{{ old('company_social_media_youtube', $company_details->company_social_media_youtube ?? '') }}"
                                                    class="form-control @error('company_social_media_youtube') input-invalid @enderror"
                                                    placeholder="Enter YouTube Link">
                                                @error('company_social_media_youtube')
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
        <!--**********************************
            Content body end
        ***********************************-->
@endsection

