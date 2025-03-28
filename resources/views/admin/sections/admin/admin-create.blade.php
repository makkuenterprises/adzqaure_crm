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
        <h1 class="panel-title">Create Admin Access</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.admin.list') }}">Admin Access</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.admin.create') }}">Create Admin Access</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <form action="{{ route('admin.handle.admin.create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <figure class="panel-card">
            <div class="panel-card-header">
                <div>
                    <h1 class="panel-card-title">Add Information</h1>
                    <p class="panel-card-description">Please fill the required fields</p>
                </div>
            </div>
            <div class="panel-card-body">
                <div class="grid md:grid-cols-4 sm:grid-cols-1 md:gap-7 sm:gap-5">

                    {{-- Profile --}}
                    <div class="md:col-span-4 sm:col-span-1">
                        <div class="flex md:flex-row sm:flex-col items-center md:space-x-5">
                            <img src="{{ asset('admin/images/default-profile.png') }}" id="profile" alt="profile"
                                class="h-24 w-24 rounded-full border bg-white" />
                            <div class="input-group">
                                <label for="profile" class="input-label">Profile</label>
                                <input type="file" accept="image/jpeg, image/jpg, image/png" class="input-box-sm"
                                    name="profile" onchange="handleProfilePreview(event)">
                                @error('profile')
                                    <span class="input-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Name --}}
                    <div class="input-group">
                        <label for="name" class="input-label">Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="input-box-md @error('name') input-invalid @enderror" placeholder="Enter name" required>
                        @error('name')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email  --}}
                    <div class="flex flex-col">
                        <label for="email" class="input-label">Email address <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="input-box-md @error('email') input-invalid @enderror" placeholder="Enter email" required
                            minlength="1" maxlength="250">
                        @error('email')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Phone  --}}
                    <div class="flex flex-col">
                        <label for="phone" class="input-label">Phone <span class="text-red-500">*</span></label>
                        <input type="tel" name="phone" value="{{ old('phone') }}"
                            class="input-box-md @error('phone') input-invalid @enderror" placeholder="Enter phone" required
                            minlength="10" maxlength="12">
                        @error('phone')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Role  --}}
                    <div class="flex flex-col">
                        <label for="role" class="input-label">Role <span class="text-red-500">*</span></label>
                        <select name="role" class="input-box-md @error('role') input-invalid @enderror" required>
                            <option value="">Select Role</option>
                            <option @selected(old('role') == 'Master Admin') value="Master Admin">Master Admin</option>
                            <option @selected(old('role') == 'Super Admin') value="Super Admin">Super Admin</option>
                            <option @selected(old('role') == 'Sub Admin') value="Sub Admin">Sub Admin</option>
                        </select>
                        @error('role')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="input-group">
                        <label for="password" class="input-label">Password<span class="text-red-500">*</span></label>
                        <input type="password" name="password"
                            class="input-box-md @error('password') input-invalid @enderror" placeholder="Enter password"
                            required>
                        @error('password')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Confirm password --}}
                    <div class="input-group">
                        <label for="password_confirmation" class="input-label">Confirm password<span
                                class="text-red-500">*</span></label>
                        <input type="password" name="password_confirmation"
                            class="input-box-md @error('password_confirmation') input-invalid @enderror"
                            placeholder="Repeat password" required>
                        @error('password_confirmation')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="panel-card-footer">
                <button type="submit" class="btn-primary-md md:w-fit sm:w-full">Create Admin Access</button>
            </div>
        </figure>
    </form>
@endsection

@section('panel-script')
    <script>
        document.getElementById('admin-tab').classList.add('active');
        const handleProfilePreview = (event) => {
            if (event.target.files.length == 0) {
                document.getElementById('profile').src = "{{ asset('admin/images/default-profile.png') }}";
            } else {
                document.getElementById('profile').src = URL.createObjectURL(event.target.files[0])
            }
        }
    </script>
@endsection
