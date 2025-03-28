@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Edit Team Member</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.employee.list') }}">Team Member</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.employee.update',['id' => $employee->id]) }}">Edit Team Member</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <form action="{{ route('admin.handle.employee.update', ['id' => $employee->id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <figure class="panel-card">
            <div class="panel-card-header">
                <div>
                    <h1 class="panel-card-title">UpdateInformation</h1>
                    <p class="panel-card-description">Please fill the required fields</p>
                </div>
                <div>
                    <button type="button" class="btn-danger-md" onclick="handleDelete()">Delete</button>
                </div>
            </div>
            <div class="panel-card-body">
                <div class="grid md:grid-cols-4 sm:grid-cols-1 md:gap-7 sm:gap-5">

                    <div class="md:col-span-4 sm:col-span-1">
                        <h1 class="font-semibold ">General Information</h1>
                    </div>

                    {{-- First Name --}}
                    <div class="flex flex-col">
                        <label for="firstname" class="input-label">First name</label>
                        <input type="text" name="firstname" value="{{ $employee->firstname }}"
                            class="input-box-md @error('firstname') input-invalid @enderror" placeholder="Enter first name"
                            required minlength="1" maxlength="250">
                        @error('firstname')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Last Name --}}
                    <div class="flex flex-col">
                        <label for="lastname" class="input-label">Last name</label>
                        <input type="text" name="lastname" value="{{ $employee->lastname }}"
                            class="input-box-md @error('lastname') input-invalid @enderror" placeholder="Enter last name"
                            required minlength="1" maxlength="250">
                        @error('lastname')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email  --}}
                    <div class="flex flex-col">
                        <label for="email" class="input-label">Email address </label>
                        <input type="email" name="email" value="{{ $employee->email }}"
                            class="input-box-md @error('email') input-invalid @enderror" placeholder="Enter email" required
                            minlength="1" maxlength="250">
                        @error('email')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email Official --}}
                    <div class="flex flex-col">
                        <label for="email_official" class="input-label">Email address (Official)</label>
                        <input type="email" name="email_official" value="{{ $employee->email_official }}"
                            class="input-box-md @error('email_official') input-invalid @enderror"
                            placeholder="Enter official email" minlength="1" maxlength="250">
                        @error('email_official')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Phone  --}}
                    <div class="flex flex-col">
                        <label for="phone" class="input-label">Phone </label>
                        <input type="tel" name="phone" value="{{ $employee->phone }}"
                            class="input-box-md @error('phone') input-invalid @enderror" placeholder="Enter phone" required
                            minlength="10" maxlength="12">
                        @error('phone')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Phone Alternate  --}}
                    <div class="flex flex-col">
                        <label for="phone_alternate" class="input-label">Phone (Alternate)</label>
                        <input type="tel" name="phone_alternate" value="{{ $employee->phone_alternate }}"
                            class="input-box-md @error('phone_alternate') input-invalid @enderror"
                            placeholder="Enter phone alternate" minlength="10" maxlength="12">
                        @error('phone_alternate')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Role  --}}
                    <div class="flex flex-col">
                        <label for="role" class="input-label">Role</label>
                        <input type="text" name="role" value="{{ $employee->role }}"
                            class="input-box-md @error('role') input-invalid @enderror" placeholder="Enter role"
                            minlength="1" maxlength="20" required>
                        @error('role')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-4 sm:col-span-1">
                        <br>
                        <h1 class="font-semibold ">Address Information</h1>
                    </div>

                    {{-- Address Home --}}
                    <div class="flex flex-col">
                        <label for="home" class="input-label">Home / Flat/ Building</label>
                        <input type="text" name="home" value="{{ $employee->home }}"
                            class="input-box-md @error('home') input-invalid @enderror"
                            placeholder="Enter home / flat / building" minlength="1" maxlength="250" required>
                        @error('home')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Address Street --}}
                    <div class="flex flex-col">
                        <label for="street" class="input-label">Street</label>
                        <input type="text" name="street" value="{{ $employee->street }}"
                            class="input-box-md @error('street') input-invalid @enderror" placeholder="Enter street"
                            required minlength="1" maxlength="250">
                        @error('street')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Address City --}}
                    <div class="flex flex-col">
                        <label for="city" class="input-label">City</label>
                        <input type="text" name="city" value="{{ $employee->city }}"
                            class="input-box-md @error('city') input-invalid @enderror" placeholder="Enter city" required
                            minlength="1" maxlength="250">
                        @error('city')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Address Pincode --}}
                    <div class="flex flex-col">
                        <label for="pincode" class="input-label">Pincode</label>
                        <input type="text" name="pincode" value="{{ $employee->pincode }}"
                            class="input-box-md @error('pincode') input-invalid @enderror" placeholder="Enter pincode"
                            required minlength="1" maxlength="250">
                        @error('pincode')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Address State --}}
                    <div class="flex flex-col">
                        <label for="state" class="input-label">State</label>
                        <input type="text" name="state" value="{{ $employee->state }}"
                            class="input-box-md @error('state') input-invalid @enderror" placeholder="Enter state"
                            required minlength="1" maxlength="250">
                        @error('state')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Address State --}}
                    <div class="flex flex-col">
                        <label for="country" class="input-label">Country</label>
                        <input type="text" name="country" value="{{ $employee->state }}"
                            class="input-box-md @error('country') input-invalid @enderror" placeholder="Enter country"
                            required minlength="1" maxlength="250">
                        @error('country')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-4 sm:col-span-1">
                        <br>
                        <h1 class="font-semibold ">Password Information</h1>
                    </div>

                    <div class="md:col-span-4 sm:col-span-1 grid md:grid-cols-4 sm:grid-cols-1 md:gap-7 sm:gap-5"
                        x-data="{ open: false }">

                        {{-- Change Password --}}
                        <div class="md:col-span-4 sm:col-span-1">
                            <label for="change_password">Change Password</label>
                            <div class="mt-2">
                                <label class="relative cursor-pointer">
                                    <input @click="open = ! open" name="change_password" type="checkbox"
                                        class="sr-only peer">
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
        document.getElementById('employee-tab').classList.add('active');

        const handleDelete = () => {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this employee!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location =
                            "{{ route('admin.handle.employee.delete', ['id' => $employee->id]) }}";
                    }
                });
        }
    </script>
@endsection
