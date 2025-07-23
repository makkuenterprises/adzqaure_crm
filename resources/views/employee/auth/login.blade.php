

@extends('employee.layouts.auth')
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
                                <a href="{{ route('admin.view.login') }}"><img class="logo-auth" src="{{ asset('admin_new/images/logo-full.png') }}"
                                        alt=""></a>
                            </div>
                            <h4 class="text-center mb-4">Sign in your employee account</h4>
                            <div class="basic-form">
                                <form action="{{route('employee.handle.login')}}" method="POST" class="form-valide-with-icon needs-validation" novalidate>
                                    @csrf
                                    <div class="mb-3">
                                        <label class="text-label form-label required" for="validationCustomUsername">Email address</label>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="validationCustomUsername" placeholder="Enter email.." required>
                                            <div class="invalid-feedback">
                                                @error('email')
                                                 <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="text-label form-label required" for="dlab-password">Password</label>
                                        <div class="input-group transparent-append">
                                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                            <input type="password" name="password" class="form-control @error('password') input-invalid @enderror" id="dlab-password" placeholder="Enter password..." required>
                                            <span class="input-group-text show-pass">
                                                <i class="fa fa-eye-slash"></i>
                                                <i class="fa fa-eye"></i>
                                            </span>
                                            <div class="invalid-feedback">
                                                @error('password')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn me-2 btn-primary">Sign In</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Login Card (End) --}}
@endsection
