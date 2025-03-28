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
        <h1 class="panel-title">Add Package</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.package.list') }}">Packages</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.package.create') }}">Add Package</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <form action="{{ route('admin.handle.package.create') }}" method="POST" enctype="multipart/form-data">
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

                    {{-- Customer ID --}}
                    <div class="flex flex-col">
                        <label for="customer_id" class="input-label">Customer <span class="text-red-500">*</span></label>
                        <select name="customer_id" class="input-box-md @error('customer_id') input-invalid @enderror"
                            required>
                            <option value="">Select Customer</option>
                            @foreach (DB::table('customers')->orderBy('name')->get() as $customer)
                                <option @selected(old('customer_id') == $customer->id) value="{{ $customer->id }}">{{ $customer->name }}
                                    ({{ $customer->company_name }})
                                </option>
                            @endforeach
                        </select>
                        @error('customer_id')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- City --}}
                    <div class="flex flex-col">
                        <label for="city" class="input-label">City<span class="text-red-500">*</span></label>
                        <select name="city" onchange="handleFetchPlans(event)" id="city_select"
                            class="input-box-md @error('city') input-invalid @enderror" required>
                            <option value="">Select City</option>
                        </select>
                        @error('city')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Plan --}}
                    <div class="flex flex-col">
                        <label for="plan_id" class="input-label">Plan<span class="text-red-500">*</span></label>
                        <select name="plan_id" onchange="handleFetchPlanDetails(event)" id="plan_id_select"
                            class="input-box-md @error('plan_id') input-invalid @enderror" required>
                            <option value="">Select Plan</option>
                        </select>
                        @error('plan_id')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Payment Status --}}
                    <div class="flex flex-col">
                        <label for="payment_status" class="input-label">Payment Status <span
                                class="text-red-500">*</span></label>
                        <select name="payment_status" class="input-box-md @error('payment_status') input-invalid @enderror"
                            required>
                            <option value="">Select Status</option>
                            <option @selected(old('payment_status') == 'Paid') value="Paid">Paid</option>
                            <option @selected(old('payment_status') == 'Pending') value="Pending">Pending</option>
                            <option @selected(old('payment_status') == 'Partial Paid') value="Partial Paid">Partial Paid</option>
                        </select>
                        @error('payment_status')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Start Date --}}
                    <div class="flex flex-col">
                        <label for="start_date" class="input-label">Start Date<span class="text-red-500">*</span></label>
                        <input type="date" onchange="handleStartDateChange(event)" id="start_date" name="start_date"
                            value="{{ old('start_date') }}"
                            class="input-box-md @error('start_date') input-invalid @enderror" required>
                        @error('start_date')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- End Date --}}
                    <div class="flex flex-col">
                        <label for="end_date" class="input-label">End Date<span class="text-red-500">*</span></label>
                        <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}"
                            class="input-box-md @error('end_date') input-invalid @enderror" required>
                        @error('end_date')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="flex flex-col">
                        <label for="status" class="input-label">Status<span class="text-red-500">*</span></label>
                        <select name="status" class="input-box-md @error('status') input-invalid @enderror" required>
                            <option value="">Select Status</option>
                            <option @selected(old('status') == 'Active') value="Active">Active</option>
                            <option @selected(old('status') == 'Inactive') value="Inactive">Inactive</option>
                        </select>
                        @error('status')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="panel-card-footer">
                <button type="submit" class="btn-primary-md md:w-fit sm:w-full">Add Package</button>
            </div>
        </figure>
    </form>
@endsection

@section('panel-script')
    <script>
        document.getElementById('package-tab').classList.add('active');

        fetch("{{ asset('admin/json/plan-cities.json') }}")
            .then((res) => {
                return res.json();
            })
            .then((res) => {
                res.cities.forEach((city) => {
                    let option = document.createElement('option');
                    option.value = city;
                    option.innerHTML = city;
                    document.getElementById('city_select').appendChild(option);
                });
            })
            .catch((err) => {
                console.error(err);
            });

        const handleFetchPlans = (event) => {
            fetch("{{ route('admin.api.get.plans') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        city: event.target.value,
                        _token: "{{ csrf_token() }}"
                    })
                })
                .then((response) => {
                    return response.json();
                })
                .then((res) => {

                    document.getElementById('plan_id_select').innerHTML = "";

                    let default_option = document.createElement('option');
                    default_option.value = "";
                    default_option.innerHTML = "Select Plan";
                    document.getElementById('plan_id_select').appendChild(default_option);

                    res.data.forEach((plan) => {
                        let option = document.createElement('option');
                        option.value = plan.id;
                        option.innerHTML = plan.name;
                        document.getElementById('plan_id_select').appendChild(option);
                    });
                })
                .catch((err) => {
                    console.error(err);
                });
        }

        let current_plan = undefined;

        const handleFetchPlanDetails = (event) => {
            fetch("{{ route('admin.api.get.plans') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        plan_id: event.target.value,
                        city: document.getElementById('city_select').value,
                        _token: "{{ csrf_token() }}"
                    })
                })
                .then((response) => {
                    return response.json();
                })
                .then((res) => {
                    current_plan = res.data;
                })
                .catch((err) => {
                    console.error(err);
                });
        }

        const handleStartDateChange = (event) => {
            var today = new Date(event.target.value);
            var priorDate = new Date(new Date().setDate(today.getDate() + current_plan.duration));
            document.getElementById('end_date').valueAsDate = priorDate;
        }
    </script>
@endsection
