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
                <div class="col-lg-6 col-md-6 d-flex align-items-center justify-content-center p-4">

                           <img src="https://i.ibb.co/b58D3N04/Pngtree-a-colorful-3d-infographic-featuring-20547594.png"
                                alt="Image"
                                class="w-100"
                            >


                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="card mb-0 h-auto">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <a href="{{ route('register') }}"><img class="logo-auth" src="{{ asset('admin_new/images/logo-full.png') }}"
                                        alt=""></a>
                            </div>
                            <h4 class="text-center mb-4">Sign in your account</h4>
                            <div class="basic-form">
                                <form method="POST" action="{{ url('register') }}" class="form-valide-with-icon needs-validation" novalidate>
                                    @csrf
                                    <div class="mb-3">
                                        <label class="text-label form-label required" for="name">Full Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name" placeholder="Enter Name.." required>
                                            <div class="invalid-feedback">
                                                @error('name')
                                                 <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="text-label form-label required" for="email">Email address</label>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email" placeholder="Enter email.." required>
                                            <div class="invalid-feedback">
                                                @error('email')
                                                 <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                    {{-- <div class="mb-3">
                                        <label class="text-label form-label required" for="phone">Phone</label>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                            <input type="tel" name="phone" value="{{ old('phone') }}" class="form-control" id="phone" placeholder="Enter Phone No.." required>
                                            <div class="invalid-feedback">
                                                @error('phone')
                                                 <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div> --}}
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
                                    <div class="mb-3">
                                        <label class="text-label form-label required" for="dlab-password">Confirm Password</label>
                                        <div class="input-group transparent-append">
                                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') input-invalid @enderror" id="dlab-password" placeholder="Enter confirm password..." required>
                                            <span class="input-group-text show-pass">
                                                <i class="fa fa-eye-slash"></i>
                                                <i class="fa fa-eye"></i>
                                            </span>
                                            <div class="invalid-feedback">
                                                @error('password_confirmation')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="basic-form">
                                        <select class="default-select form-control wide mb-3" name="role" id="role" required>
                                            <option selected disabled>Select Role</option>
                                            <option value="customer">Customer</option>
                                            <option value="service_provider">Service Provider Program</option>
                                            <option value="partner">Partner Program</option>
                                        </select>
                                        @error('role')
                                            <span class="input-error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn me-2 btn-primary">Register</button>
                                    <div class="text-center mt-3">
                                        <a href="{{ url('login') }}">Already have an account? Login</a>
                                    </div>
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
