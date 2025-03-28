@extends('admin.layouts.auth')
@section('css')
    <style>
        .input-error {
            color: red;
            font-weight: 500;
        }
    </style>
@endsection
@section('auth-card')
    {{-- Login Card (Start) --}}
    <div class="fix-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6">
                    <div class="card mb-0 h-auto">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <a href="index.html"><img class="logo-auth" src="{{ asset('admin_new/images/logo-full.png') }}"
                                        alt=""></a>
                            </div>
                            <h4 class="text-center mb-4">Sign in your account</h4>
                            <form action="{{ route('admin.handle.login') }}" method="POST">
                                @csrf
                                <div class="form-group mb-4">
                                    <label class="form-label" for="username">Email address</label>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                        placeholder="Enter email" id="username">
                                    @error('email')
                                        <span class="input-error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-sm-4 mb-3 position-relative">
                                    <label class="form-label" for="dlab-password">Password</label>
                                    <input type="password" name="password" id="dlab-password"
                                        class="form-control @error('password') input-invalid @enderror" minlength="6"
                                        maxlength="20">

                                    <span class="show-pass eye">
                                        <i class="fa fa-eye-slash"></i>
                                        <i class="fa fa-eye"></i>
                                    </span>
                                    @error('password')
                                        <span class="input-error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-row d-flex flex-wrap justify-content-between mb-2">
                                    <div class="form-group mb-sm-4 mb-1">
                                        <div class="form-check custom-checkbox ms-1">
                                            <input type="checkbox" @checked(old('remember')) name="remember"
                                                class="form-check-input" id="basic_checkbox_1">
                                            <label class="form-check-label" for="basic_checkbox_1">Remember my
                                                preference</label>
                                        </div>
                                    </div>
                                    <div class="form-group ms-2">
                                        <a href="#">Forgot Password?</a>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Login Card (End) --}}
@endsection
