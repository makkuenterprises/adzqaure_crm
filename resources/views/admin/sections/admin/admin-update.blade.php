@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Edit Admin Access</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.admin.list') }}">Admin Access</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.admin.update', ['id' => $admin->id]) }}">Edit Admin Access</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <form action="{{ route('admin.handle.admin.update', ['id' => $admin->id]) }}" method="POST" enctype="multipart/form-data">
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

                    {{-- Profile --}}
                    <div class="md:col-span-4 sm:col-span-1">
                        <div class="flex md:flex-row sm:flex-col items-center md:space-x-5">
                            <img src="{{ is_null($admin->profile) ? asset('admin/images/default-profile.png') : asset('storage/' . $admin->profile) }}"
                                id="profile" alt="profile" class="h-24 w-24 rounded-full border bg-white" />
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
                        <label for="name" class="input-label">Name</label>
                        <input type="text" name="name" value="{{ old('name', $admin->name) }}"
                            class="input-box-md @error('name') input-invalid @enderror" placeholder="Enter name" required>
                        @error('name')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email  --}}
                    <div class="flex flex-col">
                        <label for="email" class="input-label">Email address </label>
                        <input type="email" name="email" value="{{ old('email', $admin->email) }}"
                            class="input-box-md @error('email') input-invalid @enderror" placeholder="Enter email" required
                            minlength="1" maxlength="250">
                        @error('email')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Phone  --}}
                    <div class="flex flex-col">
                        <label for="phone" class="input-label">Phone </label>
                        <input type="tel" name="phone" value="{{ old('phone', $admin->phone) }}"
                            class="input-box-md @error('phone') input-invalid @enderror" placeholder="Enter phone" required
                            minlength="10" maxlength="12">
                        @error('phone')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Role  --}}
                    <div class="flex flex-col">
                        <label for="role" class="input-label">Role</label>
                        <select name="role" class="input-box-md @error('role') input-invalid @enderror" required>
                            <option value="">Select Role</option>
                            <option @selected(old('role', $admin->role) == 'Master Admin') value="Master Admin">Master Admin</option>
                            <option @selected(old('role', $admin->role) == 'Super Admin') value="Super Admin">Super Admin</option>
                            <option @selected(old('role', $admin->role) == 'Sub Admin') value="Sub Admin">Sub Admin</option>
                        </select>
                        @error('role')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-4 sm:col-span-1 grid md:grid-cols-4 sm:grid-cols-1 md:gap-7 sm:gap-5"
                        x-data="{ open: {{ old('password_change') == '1' ? 'true' : 'false' }} }">

                        {{-- Change Password --}}
                        <div class="md:col-span-4 sm:col-span-1">
                            <label for="password_change" class="input-label">Change Password</label>
                            <div class="mt-2">
                                <label class="relative cursor-pointer">
                                    <input @click="open = ! open" @checked(old('password_change') == '1') value="1"
                                        name="password_change" type="checkbox" class="sr-only peer">
                                    <div
                                        class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2.5px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-admin-ascent">
                                    </div>
                                </label>
                            </div>
                        </div>

                        {{-- Password --}}
                        <div class="input-group" x-show="open">
                            <label for="password" class="input-label">Password</label>
                            <input type="password" name="password"
                                class="input-box-md @error('password') input-invalid @enderror"
                                placeholder="Enter password">
                            @error('password')
                                <span class="input-error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Confirm password --}}
                        <div class="input-group" x-show="open">
                            <label for="password_confirmation" class="input-label">Confirm password</label>
                            <input type="password" name="password_confirmation"
                                class="input-box-md @error('password_confirmation') input-invalid @enderror"
                                placeholder="Repeat password">
                            @error('password_confirmation')
                                <span class="input-error">{{ $message }}</span>
                            @enderror
                        </div>

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
        document.getElementById('admin-tab').classList.add('active');
        const handleProfilePreview = (event) => {
            if (event.target.files.length == 0) {
                document.getElementById('profile').src =
                    "{{ is_null($admin->profile) ? asset('admin/images/default-profile.png') : asset('storage/' . $admin->profile) }}";
            } else {
                document.getElementById('profile').src = URL.createObjectURL(event.target.files[0])
            }
        }
    </script>
@endsection