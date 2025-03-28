@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Customers</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.customer.list') }}">Customers</a></li>
        </ul>
    </div>
@endsection


@section('panel-body')
    <figure class="panel-card">
        <div class="panel-card-header">
            <div>
                <h1 class="panel-card-title">All Customers</h1>
                <p class="panel-card-description">All customers in the website </p>
            </div>
            <div>
                <a href="{{ route('admin.view.customer.create') }}" class="btn-primary-md">Add Customer</a>
            </div>
        </div>
        <!-- Customer Summary Section -->
        <div class="panel-card-body mb-6">
            <div class="grid md:grid-cols-3 sm:grid-cols-1 gap-5">
                <!-- Total Customers -->
                <div class="bg-white p-5 rounded-lg shadow-md flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-medium">Total Customers</h3>
                        <p class="text-2xl font-semibold">{{ $totalCustomers }}</p>
                    </div>
                    <div class="text-blue-600">
                        <i data-feather="users" class="w-12 h-12"></i>
                    </div>
                </div>

                <!-- Active Customers -->
                <div class="bg-white p-5 rounded-lg shadow-md flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-medium">Active Customers</h3>
                        <p class="text-2xl font-semibold">{{ $activeCustomers }}</p>
                    </div>
                    <div class="text-green-600">
                        <i data-feather="check-circle" class="w-12 h-12"></i>
                    </div>
                </div>

                <!-- Inactive Customers -->
                <div class="bg-white p-5 rounded-lg shadow-md flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-medium">Inactive Customers</h3>
                        <p class="text-2xl font-semibold">{{ $inactiveCustomers }}</p>
                    </div>

                </div>
            </div>
        </div>
        <div class="panel-card-body">
            <div class="panel-card-table">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Company</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $customer->id }}</td>
                                <td><a
                                        href="{{ route('admin.view.customer.preview', ['id' => $customer->id]) }}">{{ $customer->name }}</a>
                                </td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->company_name }}</td>
                                <td>
                                    <label class="relative cursor-pointer">
                                        <input onchange="handleUpdateStatus({{ $customer->id }})"
                                            @checked($customer->status) type="checkbox" class="sr-only peer">
                                        <div
                                            class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2.5px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-admin-ascent">
                                        </div>
                                    </label>
                                </td>
                                <td>

                                    <div class="table-dropdown">
                                        <button>Options<i data-feather="chevron-down"
                                                class="ml-1 toggler-icon"></i></button>
                                        <div class="dropdown-menu">
                                            <ul>
                                                <li><a href="{{ route('admin.view.customer.preview', ['id' => $customer->id]) }}"
                                                        class="dropdown-link-primary"><i data-feather="external-link"
                                                            class="mr-1"></i> Preview Customer</a></li>
                                                <li><a href="{{ route('admin.view.customer.update', ['id' => $customer->id]) }}"
                                                        class="dropdown-link-primary"><i data-feather="edit"
                                                            class="mr-1"></i> Edit Customer</a></li>
                                                <li><a href="javascript:handleDelete({{ $customer->id }});"
                                                        class="dropdown-link-danger"><i data-feather="trash-2"
                                                            class="mr-1"></i> Delete Customer</a></li>
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
        document.getElementById('customer-tab').classList.add('active');
    </script>

    <script>
        const handleDelete = (id) => {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this customer!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location =
                            `{{ url('admin/customer/delete') }}/${id}`;
                    }
                });
        }
    </script>
    <script>
        const handleUpdateStatus = (id) => {
            fetch("{{ route('admin.api.customer.status') }}", {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: id,
                    _token: "{{ csrf_token() }}"
                })
            }).then((response) => {
                return response.json();
            }).then((result) => {
                console.log(result);
                location.reload();

            }).catch((error) => {
                console.error(error);
            });
        }
    </script>
@endsection
