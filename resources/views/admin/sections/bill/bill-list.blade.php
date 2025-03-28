@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Billing</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.bill.list') }}">Billing</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <figure class="panel-card">
        <div class="panel-card-header">
            <div>
                <h1 class="panel-card-title">All Bills</h1>
                <p class="panel-card-description">All previously generated bills in the website </p>
            </div>
            <div>
                <a href="{{ route('admin.view.bill.create') }}" class="btn-primary-md">Create a Bill</a>
            </div>
        </div>
        <div class="panel-card-body">
            <div class="panel-card-table">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Company Name</th>
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
                                <td>{{ DB::table('customers')->find($bill->customer_id)?->company_name }}</td>
                                <td>{{ DB::table('customers')->find($bill->customer_id)?->name }}</td>
                                <td>{{ env('APP_CURRENCY') }}{{ number_format($bill->total, 2) }}</td>
                                <td>{{ date('d-m-Y', strtotime($bill->bill_date)) }}</td>
                                <td>
                                    @if (\Carbon\Carbon::parse($bill->due_date) <= \Carbon\Carbon::now())
                                        <p class="alert-danger-sm w-fit">{{ date('d-m-Y', strtotime($bill->due_date)) }}
                                        </p>
                                    @else
                                        <p class="alert-success-sm w-fit">{{ date('d-m-Y', strtotime($bill->due_date)) }}
                                        </p>
                                    @endif
                                </td>
                                <td>
                                    @if (!is_null($bill->payment_status))
                                        <select name="status" onchange="handleUpdateStatus({{ $bill->id }},event)"
                                            class="input-box-sm cursor-pointer" required>
                                            <option @selected($bill->payment_status == 'Paid') value="Paid">Paid</option>
                                            <option @selected($bill->payment_status == 'Pending') value="Pending">Pending</option>
                                        </select>
                                    @endif
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
                                                <li><a href="{{ route('admin.handle.bill.duplicate', ['id' => $bill->id]) }}"
                                                        class="dropdown-link-primary"><i data-feather="copy"
                                                            class="mr-1"></i> Duplicate Bill</a></li>
                                                <li><a href="{{ route('admin.handle.bill.invoice', ['id' => $bill->id]) }}"
                                                        class="dropdown-link-primary"><i data-feather="download"
                                                            class="mr-1"></i> Download Bill</a></li>
                                                <li><a href="javascript:handleDelete({{ $bill->id }});"
                                                        class="dropdown-link-danger"><i data-feather="trash-2"
                                                            class="mr-1"></i> Delete Bill</a></li>
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
        // document.getElementById('bill-tab').classList.add('active');
        const handleDelete = (id) => {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this bill!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location =
                            `{{ url('admin/billing/delete') }}/${id}`;
                    }
                });
        }

        const handleUpdateStatus = (id, event) => {
            fetch("{{ route('admin.api.bill.status') }}", {
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
                    text: "The payment status for this bill is updated",
                    icon: "success",
                })
            }).catch((error) => {
                console.error(error);
            });
        }
    </script>
@endsection
