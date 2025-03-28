@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Edit Domain Hosting</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.domain.hosting.list') }}">Domain Hosting</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.domain.hosting.update', ['id' => $domain_hosting->id]) }}">Edit Domain
                    Hosting</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <form action="{{ route('admin.handle.domain.hosting.update', ['id' => $domain_hosting->id]) }}" method="POST">
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

                    {{-- Customer --}}
                    <div class="flex flex-col">
                        <label for="customer_id" class="input-label">Customer</label>
                        <select class="input-box-md" name="customer_id">
                            <option value="">Select Customer</option>
                            @foreach ($customers as $customer)
                                <option @selected($domain_hosting->customer_id == $customer->id) value="{{ $customer->id }}">{{ $customer->name }}
                                    ({{ $customer->company_name }})
                                </option>
                            @endforeach
                        </select>
                        @error('customer_id')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-4 sm:col-span-1">
                        <h1 class="font-semibold ">Domain Information</h1>
                    </div>

                    {{-- Domain Name --}}
                    <div class="flex flex-col">
                        <label for="domain_name" class="input-label">Domain Name</label>
                        <input type="text" name="domain_name"
                            value="{{ old('domain_name', $domain_hosting->domain_name) }}"
                            class="input-box-md @error('domain_name') input-invalid @enderror"
                            placeholder="Enter domain name" minlength="1" maxlength="250">
                        @error('domain_name')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Domain Provider --}}
                    <div class="flex flex-col">
                        <label for="domain_provider" class="input-label">Domain Provider</label>
                        <input type="text" name="domain_provider"
                            value="{{ old('domain_provider', $domain_hosting->domain_provider) }}"
                            class="input-box-md @error('domain_provider') input-invalid @enderror"
                            placeholder="Enter domain provider" minlength="1" maxlength="250">
                        @error('domain_provider')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Domain Purchase Date --}}
                    <div class="flex flex-col">
                        <label for="domain_purchase" class="input-label">Domain Purchase Date</label>
                        <input type="date" name="domain_purchase"
                            value="{{ old('domain_purchase', $domain_hosting->domain_purchase) }}"
                            class="input-box-md @error('domain_purchase') input-invalid @enderror">
                        @error('domain_purchase')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Domain Expiry Date --}}
                    {{-- <div class="flex flex-col">
                        <label for="domain_expiry" class="input-label">Domain Expiry Date</label>
                        <input type="date" name="domain_expiry" value="{{ old('domain_expiry', $domain_hosting->domain_expiry) }}"
                            class="input-box-md @error('domain_expiry') input-invalid @enderror">
                        @error('domain_expiry')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div> --}}

                    {{-- Domain Renewal Price --}}
                    <div class="flex flex-col">
                        <label for="domain_renewal_price" class="input-label">Domain Renewal Price</label>
                        <input type="number" style="any" name="domain_renewal_price"
                            value="{{ old('domain_renewal_price', $domain_hosting->domain_renewal_price) }}"
                            class="input-box-md @error('domain_renewal_price') input-invalid @enderror"
                            placeholder="Enter domain renewal price">
                        @error('domain_renewal_price')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-4 sm:col-span-1">
                        <h1 class="font-semibold ">Hosting Information</h1>
                    </div>

                    {{-- Hosting Provider --}}
                    <div class="flex flex-col">
                        <label for="hosting_provider" class="input-label">Hosting Provider</label>
                        <input type="text" name="hosting_provider"
                            value="{{ old('hosting_provider', $domain_hosting->hosting_provider) }}"
                            class="input-box-md @error('hosting_provider') input-invalid @enderror"
                            placeholder="Enter hosting provider" minlength="1" maxlength="250">
                        @error('hosting_provider')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Hosting Purchase Date --}}
                    <div class="flex flex-col">
                        <label for="hosting_purchase" class="input-label">Hosting Purchase Date</label>
                        <input type="date" name="hosting_purchase"
                            value="{{ old('hosting_purchase', $domain_hosting->hosting_purchase) }}"
                            class="input-box-md @error('hosting_purchase') input-invalid @enderror">
                        @error('hosting_purchase')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Hosting Expiry Date --}}
                    {{-- <div class="flex flex-col">
                        <label for="hosting_expiry" class="input-label">Hosting Expiry Date</label>
                        <input type="date" name="hosting_expiry"
                            value="{{ old('hosting_expiry', $domain_hosting->hosting_expiry) }}"
                            class="input-box-md @error('hosting_expiry') input-invalid @enderror">
                        @error('hosting_expiry')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div> --}}

                    {{-- Hosting Renewal Price --}}
                    <div class="flex flex-col">
                        <label for="hosting_renewal_price" class="input-label">Hosting Renewal Price</label>
                        <input type="number" style="any" name="hosting_renewal_price"
                            value="{{ old('hosting_renewal_price', $domain_hosting->hosting_renewal_price) }}"
                            class="input-box-md @error('hosting_renewal_price') input-invalid @enderror"
                            placeholder="Enter hosting renewal price">
                        @error('hosting_renewal_price')
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
        document.getElementById('domain-hosting-tab').classList.add('active');
    </script>
@endsection
