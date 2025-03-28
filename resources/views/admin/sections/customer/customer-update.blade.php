@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Edit Customer</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.customer.list') }}">Customers</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.customer.update', ['id' => $customer->id]) }}">Edit Customer</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <form action="{{ route('admin.handle.customer.update', ['id' => $customer->id]) }}" method="POST" enctype="multipart/form-data">
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

                    <div class="md:col-span-4 sm:col-span-1">
                        <h1 class="font-semibold ">General Information</h1>
                    </div>

                    {{-- Profile --}}
                    <div class="md:col-span-4 sm:col-span-1">
                        <div class="flex md:flex-row sm:flex-col items-center md:space-x-5">
                            <img src="{{ is_null($customer->profile) ? asset('admin/images/default-profile.png') : asset('storage/'.$customer->profile) }}" id="profile" alt="profile" class="h-24 w-24 rounded-full border bg-white" />
                            <div class="input-group">
                                <label for="profile" class="input-label">Profile</label>
                                <input type="file" accept="image/jpeg, image/jpg, image/png" class="input-box-sm" name="profile" onchange="handleProfilePreview(event)" >
                                @error('profile')<span class="input-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    {{-- Name --}}
                    <div class="flex flex-col">
                        <label for="name" class="input-label">Name</label>
                        <input type="text" name="name" value="{{ old('name', $customer->name) }}"
                            class="input-box-md @error('name') input-invalid @enderror" placeholder="Enter name"
                            required minlength="1" maxlength="250">
                        @error('name')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email  --}}
                    <div class="flex flex-col">
                        <label for="email" class="input-label">Email address </label>
                        <input type="email" name="email" value="{{ old('email', $customer->email) }}"
                            class="input-box-md @error('email') input-invalid @enderror" placeholder="Enter email" required
                            minlength="1" maxlength="250">
                        @error('email')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Phone  --}}
                    <div class="flex flex-col">
                        <label for="phone" class="input-label">Phone </label>
                        <input type="tel" name="phone" value="{{ old('phone', $customer->phone) }}"
                            class="input-box-md @error('phone') input-invalid @enderror" placeholder="Enter phone" required
                            minlength="10" maxlength="12">
                        @error('phone')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Phone Alternate  --}}
                    <div class="flex flex-col">
                        <label for="phone_alternate" class="input-label">Phone (Official)</label>
                        <input type="tel" name="phone_alternate" value="{{ old('phone_alternate', $customer->phone_alternate) }}"
                            class="input-box-md @error('phone_alternate') input-invalid @enderror"
                            placeholder="Enter phone alternate" minlength="10" maxlength="12">
                        @error('phone_alternate')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Whatsapp  --}}
                    <div class="flex flex-col">
                        <label for="whatsapp" class="input-label">Whatsapp </label>
                        <input type="tel" name="whatsapp" value="{{ old('whatsapp', $customer->whatsapp) }}"
                            class="input-box-md @error('whatsapp') input-invalid @enderror" placeholder="Enter whatsapp"
                            minlength="10" maxlength="12">
                        @error('whatsapp')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Company name --}}
                    <div class="flex flex-col">
                        <label for="company_name" class="input-label">Company name</label>
                        <input type="text" name="company_name" value="{{ old('company_name', $customer->company_name) }}"
                            class="input-box-md @error('company_name') input-invalid @enderror" placeholder="Enter company name" minlength="1" maxlength="250">
                        @error('company_name')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Webiste --}}
                    <div class="flex flex-col">
                        <label for="website" class="input-label">Webiste</label>
                        <input type="url" name="website" value="{{ old('website',$customer->website) }}"
                            class="input-box-md @error('website') input-invalid @enderror" placeholder="Enter website">
                        @error('website')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Other Information --}}
                    <div class="flex flex-col md:col-span-2 sm:col-span-1">
                        <label for="other" class="input-label">Other Information</label>
                        <div class="space-y-2">
                            <div class="space-y-2" id="other-inputs">

                            </div>
                            <button type="button" onclick="handleCreateOtherInput(null,null)"
                                class="btn-secondary-md">Add Links</button>
                        </div>
                        @error('other')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-4 sm:col-span-1">
                        <br>
                        <h1 class="font-semibold ">Address Information</h1>
                    </div>

                    {{-- Street --}}
                    <div class="flex flex-col">
                        <label for="street" class="input-label">Street</label>
                        <input type="text" name="street" value="{{ old('street', $customer->street) }}"
                            class="input-box-md @error('street') input-invalid @enderror" placeholder="Enter street" minlength="1" maxlength="250">
                        @error('street')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- City --}}
                    <div class="flex flex-col">
                        <label for="city" class="input-label">City</label>
                        <input type="text" name="city" value="{{ old('city', $customer->city) }}"
                            class="input-box-md @error('city') input-invalid @enderror" placeholder="Enter city" minlength="1" maxlength="250">
                        @error('city')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Pincode --}}
                    <div class="flex flex-col">
                        <label for="pincode" class="input-label">Pincode</label>
                        <input type="text" name="pincode" value="{{ old('pincode', $customer->pincode) }}"
                            class="input-box-md @error('pincode') input-invalid @enderror" placeholder="Enter pincode" minlength="1" maxlength="250">
                        @error('pincode')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- State --}}
                    <div class="flex flex-col">
                        <label for="state" class="input-label">State</label>
                        <input type="text" name="state" value="{{ old('state', $customer->state) }}"
                            class="input-box-md @error('state') input-invalid @enderror" placeholder="Enter state"
                            minlength="1" maxlength="250">
                        @error('state')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Country --}}
                    <div class="flex flex-col">
                        <label for="country" class="input-label">Country</label>
                        <input type="text" name="country" value="{{ old('country', $customer->country) }}"
                            class="input-box-md @error('country') input-invalid @enderror" placeholder="Enter country" minlength="1" maxlength="250">
                        @error('country')
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
        document.getElementById('customer-tab').classList.add('active');

        const handleProfilePreview = (event) => {
            if (event.target.files.length == 0) {
                document.getElementById('profile').src = "{{ is_null($customer->profile) ? asset('admin/images/default-profile.png') : asset('storage/'.$customer->profile) }}";
            }
            else {
                document.getElementById('profile').src = URL.createObjectURL(event.target.files[0])
            }
        }

        const handleCreateOtherInput = (name, value) => {

            let parentDiv = document.createElement('div');
            parentDiv.className = "flex space-x-2";

            let otherNameInput = document.createElement('input');
            otherNameInput.type = "text";
            otherNameInput.className = "input-box-md w-full";
            otherNameInput.name = "other_name[]";
            otherNameInput.value = name;
            otherNameInput.required = true;
            otherNameInput.placeholder = "Enter name";

            let otherValueInput = document.createElement('input');
            otherValueInput.type = "text";
            otherValueInput.className = "input-box-md w-full";
            otherValueInput.name = "other_value[]";
            otherValueInput.value = value;
            otherValueInput.required = true;
            otherValueInput.placeholder = "Enter value";

            let remove = document.createElement('button');
            remove.className = "btn-danger-md";
            remove.innerHTML = ' &times ';
            remove.type = "button";
            remove.onclick = (event) => {
                event.target.parentNode.remove();
            }
            parentDiv.append(otherNameInput, otherValueInput, remove);
            document.getElementById('other-inputs').appendChild(parentDiv);
        }
    </script>
    @if (!is_null($customer->other))
    <script defer>
        @foreach (json_decode($customer->other) as $other)
        handleCreateOtherInput('{{$other->name}}','{{$other->value}}');
        @endforeach
    </script>
    @endif
@endsection
