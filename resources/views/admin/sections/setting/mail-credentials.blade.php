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
        <h1 class="panel-title">Mail Credentials</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.setting') }}">Setting</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.mail.credentials.setting') }}">Mail Credentials</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <form action="{{ route('admin.handle.mail.credentials.update') }}" method="POST" enctype="multipart/form-data">
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

                    {{-- Mail Host --}}
                    <div class="input-group">
                        <label for="mail_host" class="input-label">Mail host <span class="text-red-500">*</span></label>
                        <input type="text" name="mail_host"
                            value="{{ old('mail_host', DB::table('mail_credentials')->where('name', 'mail_host')->first()->value) }}"
                            class="input-box-md @error('mail_host') input-invalid @enderror" placeholder="Enter mail host"
                            required>
                        @error('mail_host')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Mail Port --}}
                    {{-- <div class="input-group">
                        <label for="mail_port" class="input-label">Mail port<span class="text-red-500">*</span></label>
                        <input type="text" name="mail_port"
                            value="{{ old('mail_port', DB::table('mail_credentials')->where('name', 'mail_port')->first()->value) }}"
                            class="input-box-md @error('mail_port') input-invalid @enderror" placeholder="Enter mail port"
                            required>
                        @error('mail_port')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div> --}}

                    <div class="input-group">
                        <label for="mail_port" class="input-label">Mail port <span class="text-red-500">*</span></label>
                        <select name="mail_port" class="input-box-md @error('mail_port') input-invalid @enderror" required>
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

                    {{-- Mail Username --}}
                    <div class="input-group">
                        <label for="mail_username" class="input-label">Mail username <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="mail_username"
                            value="{{ old('mail_username', DB::table('mail_credentials')->where('name', 'mail_username')->first()->value) }}"
                            class="input-box-md @error('mail_username') input-invalid @enderror"
                            placeholder="Enter mail username" required>
                        @error('mail_username')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Mail password --}}
                    <div class="input-group">
                        <label for="mail_password" class="input-label">Mail password <span
                                class="text-red-500">*</span></label>
                        <input type="password" name="mail_password"
                            value="{{ old('mail_password', DB::table('mail_credentials')->where('name', 'mail_password')->first()->value) }}"
                            class="input-box-md @error('mail_password') input-invalid @enderror"
                            placeholder="Enter mail password" required>
                        @error('mail_password')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Mail encryption --}}
                    {{-- <div class="input-group">
                        <label for="mail_encryption" class="input-label">Mail encryption <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="mail_encryption"
                            value="{{ old('mail_encryption', DB::table('mail_credentials')->where('name', 'mail_encryption')->first()->value) }}"
                            class="input-box-md @error('mail_encryption') input-invalid @enderror"
                            placeholder="Enter mail encryption" required>
                        @error('mail_encryption')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div> --}}

                    <div class="input-group">
                        <label for="mail_encryption" class="input-label">Mail encryption <span
                                class="text-red-500">*</span></label>
                        <select name="mail_encryption"
                            class="input-box-md @error('mail_encryption') input-invalid @enderror" required>
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

                    {{-- Mail address --}}
                    <div class="input-group">
                        <label for="mail_address" class="input-label">Mail address <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="mail_address"
                            value="{{ old('mail_address', DB::table('mail_credentials')->where('name', 'mail_address')->first()->value) }}"
                            class="input-box-md @error('mail_address') input-invalid @enderror"
                            placeholder="Enter mail address" required>
                        @error('mail_address')
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
