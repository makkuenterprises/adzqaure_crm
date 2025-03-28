@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Packages</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.package.list') }}">Packages</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <figure class="panel-card">
        <div class="panel-card-header">
            <div>
                <h1 class="panel-card-title">All Packages</h1>
                <p class="panel-card-description">List of all packages in webiste</p>
            </div>
            <div>
                <a href="{{ route('admin.view.package.create') }}" class="btn-primary-md">Add Package</a>
            </div>
        </div>
        <div class="panel-card-body">
            <div class="panel-card-table">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Plan</th>
                            <th>Duration</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($packages as $package)
                            <tr>
                                <td>{{ $package->id }}</td>
                                <td>{{ DB::table('customers')->find($package->customer_id)?->name }}</td>
                                <td>{{ DB::table('plans')->find($package->plan_id)?->name }}</td>
                                <td>{{ DB::table('plans')->find($package->plan_id)?->duration }} Days</td>
                                <td>{{ date('d-m-Y', strtotime($package->start_date)) }}</td>
                                <td>{{ date('d-m-Y', strtotime($package->end_date)) }}</td>
                                <td>
                                    <select name="status" onchange="handleUpdatePaymentStatus({{ $package->id }},event)"
                                        class="input-box-sm cursor-pointer" required>
                                        <option @selected($package->payment_status == 'Paid') value="Paid">Paid</option>
                                        <option @selected($package->payment_status == 'Pending') value="Pending">Pending</option>
                                        <option @selected($package->payment_status == 'Partial Paid') value="Partial Paid">Partial Paid</option>
                                    </select>
                                </td>
                                <td>
                                    @switch($package->status)
                                        @case('Active')
                                            <div class="table-status-success">{{ $package->status }}</div>
                                        @break

                                        @case('Inactive')
                                            <div class="table-status-danger">{{ $package->status }}</div>
                                        @break
                                    @endswitch
                                </td>
                                <td>

                                    <div class="table-dropdown">
                                        <button>Options<i data-feather="chevron-down"
                                                class="ml-1 toggler-icon"></i></button>
                                        <div class="dropdown-menu">
                                            <ul>
                                                <li><a href="{{ route('admin.view.package.update', ['id' => $package->id]) }}"
                                                        class="dropdown-link-primary"><i data-feather="edit"
                                                            class="mr-1"></i> Edit Package</a></li>
                                                <li><a href="{{ route('admin.handle.package.bill.create', ['id' => $package->id]) }}"
                                                        class="dropdown-link-primary"><i data-feather="clipboard"
                                                            class="mr-1"></i> Generate Bill</a></li>


                                                <li><a href="{{ route('admin.view.package.renew', ['id' => $package->id]) }}"
                                                        class="dropdown-link-primary"><i data-feather="repeat"
                                                            class="mr-1"></i> Renew Package</a></li>
                                                <li><a href="javascript:handleDelete({{ $package->id }});"
                                                        class="dropdown-link-danger"><i data-feather="trash-2"
                                                            class="mr-1"></i> Delete Package</a></li>
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
        const handleUpdatePaymentStatus = (id, event) => {
            fetch("{{ route('admin.api.package.payment.status') }}", {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: id,
                    payment_status: event.target.value,
                    _token: "{{ csrf_token() }}"
                })
            }).then((response) => {
                return response.json();
            }).then((result) => {
                swal({
                    title: "Payment Status Updated",
                    text: "The payment status for this project is updated",
                    icon: "success",
                })
            }).catch((error) => {
                console.error(error);
            });
        }
    </script>

    <script>
        const handleDelete = (id) => {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this package!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location =
                            `{{ url('admin/package/delete') }}/${id}`;
                    }
                });
        }
    </script>
@endsection
