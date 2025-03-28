@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Edit Package</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.package.list') }}">Packages</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.package.update',['id' => $package->id]) }}">Edit Package</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <form action="{{ route('admin.handle.package.update',['id' => $package->id]) }}" method="POST" enctype="multipart/form-data">
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

                    {{-- Customer ID --}}
                    <div class="flex flex-col">
                        <label for="customer_id" class="input-label">Customer</label>
                        <select name="customer_id" class="input-box-md @error('customer_id') input-invalid @enderror" required>
                            <option value="">Select Customer</option>
                            @foreach (DB::table('customers')->orderBy('name')->get() as $customer)
                            <option @selected(old('customer_id', $package->customer_id) == $customer->id) value="{{$customer->id}}">{{$customer->name}} ({{$customer->company_name}})</option>
                            @endforeach
                        </select>
                        @error('customer_id')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- City --}}
                    <div class="flex flex-col">
                        <label for="city" class="input-label">City</label>
                        <select name="city" onchange="handleFetchPlans(event)" id="city_select" class="input-box-md @error('city') input-invalid @enderror" required>
                            <option value="">Select City</option>
                        </select>
                        @error('city')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Plan --}}
                    <div class="flex flex-col">
                        <label for="plan_id" class="input-label">Plan</label>
                        <select name="plan_id" onchange="handleFetchPlanDetails(event)" id="plan_id_select" class="input-box-md @error('plan_id') input-invalid @enderror" required>
                            <option value="">Select Plan</option>
                        </select>
                        @error('plan_id')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Payment Status --}}
                    <div class="flex flex-col">
                        <label for="payment_status" class="input-label">Payment Status</label>
                        <select name="payment_status" class="input-box-md @error('payment_status') input-invalid @enderror" required>
                            <option value="">Select Status</option>
                            <option @selected(old('payment_status', $package->payment_status) == "Paid") value="Paid">Paid</option>
                            <option @selected(old('payment_status', $package->payment_status) == "Pending") value="Pending">Pending</option>
                            <option @selected(old('payment_status', $package->payment_status) == "Partial Paid") value="Partial Paid">Partial Paid</option>
                        </select>
                        @error('payment_status')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Start Date --}}
                    <div class="flex flex-col">
                        <label for="start_date" class="input-label">Start Date</label>
                        <input type="date" onchange="handleStartDateChange(event)" id="start_date" name="start_date" value="{{ old('start_date', $package->start_date) }}"
                            class="input-box-md @error('start_date') input-invalid @enderror" required>
                        @error('start_date')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- End Date --}}
                    <div class="flex flex-col">
                        <label for="end_date" class="input-label">End Date</label>
                        <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $package->end_date) }}"
                            class="input-box-md @error('end_date') input-invalid @enderror" required>
                        @error('end_date')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="flex flex-col">
                        <label for="status" class="input-label">Status</label>
                        <select name="status" class="input-box-md @error('status') input-invalid @enderror" required>
                            <option @selected(old('status', $package->status) == "Active") value="Active">Active</option>
                            <option @selected(old('status', $package->status) == "Inactive") value="Inactive">Inactive</option>
                        </select>
                        @error('status')
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

    <figure class="panel-card">
        <div class="panel-card-header">
            <div>
                <h1 class="panel-card-title">All Bills for this package</h1>
                <p class="panel-card-description">All previously generated bills in the website </p>
            </div>
            <div>
                <a href="{{ route('admin.handle.package.bill.create',['id' => $package->id]) }}" class="btn-primary-md">Generate Bill</a>
            </div>
        </div>
        <div class="panel-card-body">
            <div class="panel-card-table">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer Name</th>
                            <th>Amount</th>
                            <th>Bill Date</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bills as $bill)
                            <tr>
                                <td>{{ $bill->id }}</td>
                                <td>{{ DB::table('customers')->find($bill->customer_id)?->name }}</td>
                                <td>{{env('APP_CURRENCY')}}{{ number_format($bill->total,2) }}</td>
                                <td>{{ date('d-m-Y',strtotime($bill->bill_date)) }}</td>
                                <td>
                                    @if (\Carbon\Carbon::parse($bill->due_date) <= \Carbon\Carbon::now())
                                    <p class="alert-danger-sm w-fit">{{ date('d-m-Y',strtotime($bill->due_date)) }} </p>
                                    @else 
                                    <p class="alert-success-sm w-fit">{{ date('d-m-Y',strtotime($bill->due_date)) }} </p>
                                    @endif
                                </td>
                                <td>
                                    @switch($bill->payment_status)
                                        @case('Paid')
                                            <div class="table-status-success">{{$bill->payment_status}}</div>
                                            @break
                                        @case('Pending')
                                            <div class="table-status-danger">{{$bill->payment_status}}</div>
                                            @break
                                    @endswitch
                                </td>
                                <td>
                                    <div class="table-dropdown">
                                        <button>Options<i data-feather="chevron-down"
                                                class="ml-1 toggler-icon"></i></button>
                                        <div class="dropdown-menu">
                                            <ul>
                                                <li><a href="{{ route('admin.view.bill.update', ['id' => $bill->id]) }}"
                                                        class="dropdown-link-primary"><i data-feather="edit"
                                                            class="mr-1"></i> Edit Bill</a></li>
                                                <li><a href="{{ route('admin.handle.bill.invoice', ['id' => $bill->id]) }}"
                                                        class="dropdown-link-primary"><i data-feather="download"
                                                            class="mr-1"></i> Download Bill</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </figure>
@endsection

@section('panel-script')
    <script>
        document.getElementById('package-tab').classList.add('active');

        fetch("{{asset('admin/json/plan-cities.json')}}")
        .then((res) => {
            return res.json();
        })
        .then((res) => {
            res.cities.forEach((city) => {
                let option = document.createElement('option');
                option.value = city;
                option.innerHTML = city;
                if (city == "{{DB::table('plans')->find($package->plan_id)?->city}}") {
                    option.selected = true;
                }
                document.getElementById('city_select').appendChild(option);
            });

            fetch("{{ route('admin.api.get.plans') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    city: "{{DB::table('plans')->find($package->plan_id)?->city}}",
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
                    if (plan.id == "{{$package->plan_id}}") {
                        option.selected = true;
                    }
                    document.getElementById('plan_id_select').appendChild(option);
                });
            })
            .catch((err) => {
                console.error(err);
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

        let current_plan = "{{json_encode($package)}}".replaceAll("&quot;","");

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

        setTimeout(() => {
            fetch("{{ route('admin.api.get.plans') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    plan_id: document.getElementById('plan_id_select').value,
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
        }, 1000);


        const handleStartDateChange = (event) => {
            var today = new Date(event.target.value);
            var priorDate = new Date(new Date().setDate(today.getDate() + current_plan.duration));
            document.getElementById('end_date').valueAsDate = priorDate;
        }
    </script>
@endsection
