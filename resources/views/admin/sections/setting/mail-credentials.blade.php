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
                    <li class="breadcrumb-item active"><a href="{{ route('admin.view.mail.credentials.setting') }}">Mail Credentials</a></li>
                </ol>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Update Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ route('admin.handle.mail.credentials.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">

                                        {{-- Mail Host --}}
                                        <div class="mb-3 col-md-6">
                                            <label for="mail_host" class="form-label">Mail host</label>
                                            <input type="text" name="mail_host" value="{{ old('mail_host', $mail_credentials->get('mail_host')?->value ?? '') }}" class="form-control @error('mail_host') input-invalid @enderror" placeholder="Enter mail_host" minlength="1" maxlength="250">
                                            @error('mail_host')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Mail Username --}}
                                        <div class="mb-3 col-md-6">
                                            <label for="mail_username" class="form-label">Mail username</label>
                                            <input type="text" name="mail_username" value="{{ old('mail_username', $mail_credentials->get('mail_username')?->value ?? '') }}" class="form-control @error('mail_username') input-invalid @enderror" placeholder="Enter mail username" minlength="1" maxlength="250">
                                            @error('mail_username')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Mail Port --}}
                                        <div class="mb-3 col-md-12">
                                            <label for="mail_port" class="form-label">Mail Port <span class="text-danger">*</span></label>
                                            <select class="default-select form-control wide mb-3 @error('mail_port') input-invalid @enderror" name="mail_port">
                                                <option value="" @selected(is_null($mail_credentials->get('mail_port')?->value))>Select Mail Port</option>
                                                <option value="465" @selected(old('mail_port', $mail_credentials->get('mail_port')?->value) == '465')>SMTP - 465</option>
                                                <option value="993" @selected(old('mail_port', $mail_credentials->get('mail_port')?->value) == '993')>IMAP - 993</option>
                                                <option value="995" @selected(old('mail_port', $mail_credentials->get('mail_port')?->value) == '995')>POP3 - 995</option>
                                            </select>
                                            @error('mail_port')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Mail Encryption --}}
                                        <div class="mb-3 col-md-12">
                                            <label for="mail_encryption" class="form-label">Mail Encryption <span class="text-danger">*</span></label>
                                            <select class="default-select form-control wide mb-3 @error('mail_encryption') input-invalid @enderror" name="mail_encryption">
                                                <option value="" @selected(is_null($mail_credentials->get('mail_encryption')?->value))>Select Mail Encryption</option>
                                                <option value="tls" @selected(old('mail_encryption', $mail_credentials->get('mail_encryption')?->value) == 'tls')>TLS</option>
                                                <option value="ssl" @selected(old('mail_encryption', $mail_credentials->get('mail_encryption')?->value) == 'ssl')>SSL</option>
                                            </select>
                                            @error('mail_encryption')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Mail Address --}}
                                        <div class="mb-3 col-md-6">
                                            <label for="mail_address" class="form-label">Mail address</label>
                                            <input type="text" name="mail_address" value="{{ old('mail_address', $mail_credentials->get('mail_address')?->value ?? '') }}" class="form-control @error('mail_address') input-invalid @enderror" placeholder="Enter mail address" minlength="1" maxlength="250">
                                            @error('mail_address')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Password --}}
                                        <div class="mb-3 col-md-6">
                                            <label class="text-label form-label required" for="dlab-password">Password</label>
                                            <div class="input-group transparent-append">
                                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                                <input type="password" name="mail_password" value="{{ old('mail_password', $mail_credentials->get('mail_password')?->value ?? '') }}" class="form-control @error('mail_password') input-invalid @enderror" id="dlab-password" placeholder="Enter mail password..." required>
                                                <span class="input-group-text show-pass">
                                                    <i class="fa fa-eye-slash"></i>
                                                    <i class="fa fa-eye"></i>
                                                </span>
                                                <div class="invalid-feedback">
                                                    @error('mail_password')
                                                        <span class="input-error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
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
