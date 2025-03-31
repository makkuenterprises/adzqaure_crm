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
                <!-- row -->
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
                                            <div class="mb-3 col-md-6">
                                                <label for="mail_host" class="form-label">Mail host</label>
                                                <input type="text" name="mail_host" value="{{ old('mail_host', DB::table('mail_credentials')->where('name', 'mail_host')->first()->value) }}" class="form-control @error('mail_host') input-invalid @enderror" placeholder="Enter mail_host" minlength="1" maxlength="250">
                                                @error('mail_host')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="mail_username" class="form-label">Mail username</label>
                                                <input type="text" name="mail_username" value="{{ old('mail_username', DB::table('mail_credentials')->where('name', 'mail_username')->first()->value) }}" class="form-control @error('mail_username') input-invalid @enderror" placeholder="Enter mail username" minlength="1" maxlength="250">
                                                @error('mail_username')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <label for="basic-form" class="form-label">Mail Port <span class="text-danger">*</span></label>
                                            <div class="basic-form">
                                                <select class="default-select form-control wide mb-3 @error('mail_port') input-invalid @enderror" name="mail_port">

                                                        <option selected>Select Mail Port</option>
                                                        <option value="465"
                                                            {{ old('mail_port', DB::table('mail_credentials')->where('name', 'mail_port')->first()->value) == '465' ? 'selected' : '' }}>
                                                            SMTP - 465</option>
                                                        <option value="993"
                                                            {{ old('mail_port', DB::table('mail_credentials')->where('name', 'mail_port')->first()->value) == '993' ? 'selected' : '' }}>
                                                            IMAP - 993</option>
                                                        <option value="995"
                                                            {{ old('mail_port', DB::table('mail_credentials')->where('name', 'mail_port')->first()->value) == '995' ? 'selected' : '' }}>
                                                            POP3 - 995</option>

                                                </select>
                                                @error('mail_port')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <label for="basic-form" class="form-label">Mail Encryption <span class="text-danger">*</span></label>
                                            <div class="basic-form">
                                                <select class="default-select form-control wide mb-3 @error('mail_encryption') input-invalid @enderror" name="mail_port">

                                                        <option selected>Select Mail Encryption</option>
                                                        <option value="tls"
                                                        {{ old('mail_encryption', DB::table('mail_credentials')->where('name', 'mail_encryption')->first()->value) == 'tls' ? 'selected' : '' }}>
                                                        TLS</option>
                                                        <option value="ssl"
                                                        {{ old('mail_encryption', DB::table('mail_credentials')->where('name', 'mail_encryption')->first()->value) == 'ssl' ? 'selected' : '' }}>
                                                        SSL</option>

                                                </select>
                                                @error('mail_encryption')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="mail_address" class="form-label">Mail address</label>
                                                <input type="text" name="mail_address" value="{{ old('mail_address', DB::table('mail_credentials')->where('name', 'mail_address')->first()->value) }}" class="form-control @error('mail_address') input-invalid @enderror" placeholder="Enter mail address" minlength="1" maxlength="250">
                                                @error('mail_address')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="text-label form-label required" for="dlab-password">Password</label>
                                                <div class="input-group transparent-append">
                                                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                                    <input type="password" name="mail_password" value="{{ old('mail_password', DB::table('mail_credentials')->where('name', 'mail_password')->first()->value) }}" class="form-control @error('mail_password') input-invalid @enderror" id="dlab-password" placeholder="Enter mail password..." required>
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
        <!--**********************************
            Content body end
        ***********************************-->
@endsection
