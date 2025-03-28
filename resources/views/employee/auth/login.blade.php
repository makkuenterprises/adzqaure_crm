@extends('employee.layouts.auth')

@section('auth-card')
    {{-- Login Card (Start) --}}
    <figure class="rounded-lg shadow-lg bg-white">
        <form action="{{route('employee.handle.login')}}" method="POST" class="p-10 text-center space-y-6" onsubmit="this.querySelector('button[type=submit]').setAttribute('disabled','disabled')">

            @csrf

            {{-- Title --}}
            <div>
                <h1 class="font-semibold text-2xl mb-2">Welcome Back</h1>
                <p class="text-xs text-slate-600 mb-6">Enter your credentials to access your account</p>
            </div>

            {{-- Flash Message --}}
            @if (session('status'))
            <div class="alert-success-md">
                <i data-feather="check-circle"></i>
                <span>{{ session('status') }}</span>
            </div>
            @endif

            {{-- Email address --}}
            <div class="flex flex-col">
                <label for="email" class="input-label">Email address</label>
                <input type="email" name="email" value="{{old('email')}}" class="input-box-md @error('email') input-invalid @enderror" placeholder="Enter email" required minlength="10" maxlength="100">
                @error('email')<span class="input-error">{{ $message }}</span>@enderror
            </div>

            {{-- Password --}}
            <div class="flex flex-col">
                <label for="password" class="input-label">Password</label>
                <input type="password" name="password" class="input-box-md @error('password') input-invalid @enderror" placeholder="Enter password" required minlength="6" maxlength="20">
                @error('password')<span class="input-error">{{ $message }}</span>@enderror
            </div>

            {{-- Remember me --}}
            <div class="flex items-center">
                <input type="checkbox" @checked(old('remember')) name="remember" id="remember">
                <label for="remember" class="text-xs text-slate-600">Keep me logged in</label>
            </div>

            {{-- Submit button --}}
            <div>
                <button type="submit" class="btn-primary-md w-full"><i data-feather="lock" class="h-4 w-4 opacity-50 absolute mr-auto"></i>Sign in</button>
            </div>
            
            <div class="text-center">
                <p class="text-slate-600 text-xs">Forgot your password ? <a href="{{--route('admin.forgot.password')--}}" class="link text-xs mx-auto">Reset password</a></p>
            </div>
            
        </form>
    </figure>
    {{-- Login Card (End) --}}
@endsection