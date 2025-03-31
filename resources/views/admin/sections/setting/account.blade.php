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
                    <li class="breadcrumb-item active"><a href="{{ route('admin.view.account.setting') }}">Account
                            Information</a></li>
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
                                <form action="{{ route('admin.handle.account.information.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-4 mb-3">
                                            <label for="formFile" class="form-label">Profile</label>
                                            <input type="file"
                                                class="form-control @error('profile') input-invalid @enderror"
                                                accept="image/jpeg, image/jpg, image/png" name="profile"
                                                onchange="handleProfilePreview(event)">
                                            @error('profile')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Full Name<span class="text-danger">*</span></label>
                                            <input type="text" name="name"
                                                value="{{ old('name', auth()->user('admin')->name) }}"
                                                class="form-control @error('name') input-invalid @enderror"
                                                placeholder="Enter Name" minlength="1" maxlength="250">
                                            @error('name')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Email<span class="text-danger">*</span></label>
                                            <input type="email" name="email"
                                                value="{{ old('email', auth()->user('admin')->email) }}"
                                                class="form-control @error('email') input-invalid @enderror"
                                                placeholder="Enter Email" minlength="1" maxlength="250">
                                            @error('email')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Phone<span class="text-danger">*</span></label>
                                            <input type="tel" name="phone"
                                                value="{{ old('phone', auth()->user('admin')->phone) }}"
                                                class="form-control @error('phone') input-invalid @enderror"
                                                placeholder="Enter Phone" minlength="10" maxlength="12"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                            @error('phone')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6 position-relative">
                                            <label class="form-label" for="dlab-password">Password</label>
                                            <input type="password" name="account_password" id="dlab-password"
                                                class="form-control @error('account_password') input-invalid @enderror"
                                                placeholder="Enter password" required minlength="6" maxlength="20">

                                            <span class="show-pass eye">
                                                <i class="fa fa-eye-slash"></i>
                                                <i class="fa fa-eye"></i>
                                            </span>
                                            @error('account_password')
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
            <!-- row -->
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Update Password</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ route('admin.handle.account.password.update') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-6 position-relative">
                                            <label class="form-label" for="dlab-password">Current password </label>
                                            <input type="password" name="current_password" id="dlab-password"
                                                class="form-control @error('current_password') input-invalid @enderror"
                                                placeholder="Enter password" required minlength="6" maxlength="20">

                                            <span class="show-pass eye">
                                                <i class="fa fa-eye-slash"></i>
                                                <i class="fa fa-eye"></i>
                                            </span>
                                            @error('current_password')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6 position-relative">
                                            <label class="form-label" for="password">New Password</label>
                                            <input type="password" name="password" id="password"
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
                                            <label class="form-label" for="password_confirmation">Confirm password</label>
                                            <input type="password" name="password_confirmation"
                                                id="password_confirmation"
                                                class="form-control @error('password_confirmation') input-invalid @enderror"
                                                placeholder="Enter password" required minlength="6" maxlength="20">

                                            <span class="show-pass eye">
                                                <i class="fa fa-eye-slash"></i>
                                                <i class="fa fa-eye"></i>
                                            </span>
                                            @error('password_confirmation')
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

@section('panel-script')
    <script>
        document.getElementById('create-lead-tab').classList.add('active');
        document.getElementById('lead-management-tab').classList.add('active');
    </script>
@endsection
