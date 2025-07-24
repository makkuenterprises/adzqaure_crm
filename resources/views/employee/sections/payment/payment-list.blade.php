@extends('employee.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">All Payments</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('employee.view.dashboard') }}">Dashboard</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('employee.view.payment.list') }}">Payments</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <figure class="panel-card">
        <div class="panel-card-header">
            <div>
                <h1 class="panel-card-title">All Payments</h1>
                <p class="panel-card-description">List of all payments in this project</p>
            </div>
            <div class="space-x-3">
                <a href="{{ route('employee.view.payment.create') }}?type=Credit" class="btn-primary-md">Add Credit</a>
                <a href="{{ route('employee.view.payment.create') }}?type=Debit" class="btn-primary-md">Add Debit</a>
            </div>
        </div>
        <div class="panel-card-body border-b">


            <div class="panel-card-table">
                <table class="data-table">
                    <thead class="border-b">
                        <tr>
                            <th class="border-r">ID</th>
                            <th class="border-r">Credit</th>
                            <th class="border-r">Debit</th>
                            <th class="border-r">Customer</th>
                            <th class="border-r">Project</th>
                            <th class="border-r">Date</th>
                            <th class="border-r">Remark</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td class="border-r">{{ $payment->id }}</td>
                                <td class="border-r">
                                    @if ($payment->type == 'Credit')
                                        <div class="table-status-success">{{ env('APP_CURRENCY') }}{{ $payment->amount }}
                                        </div>
                                    @endif
                                </td>
                                <td class="border-r">
                                    @if ($payment->type == 'Debit')
                                        <div class="table-status-danger">{{ env('APP_CURRENCY') }}{{ $payment->amount }}
                                        </div>
                                    @endif
                                </td>
                                <td class="border-r">{{ DB::table('customers')->find($payment->customer_id)?->name }}</td>
                                <td class="border-r">{{ DB::table('projects')->find($payment->project_id)?->name }}</td>
                                <td class="border-r">{{ date('D d-m-Y', strtotime($payment->date)) }}</td>
                                <td class="border-r">{{ $payment->remark }}</td>
                                <td>

                                    <div class="table-dropdown">
                                        <button>Options<i data-feather="chevron-down"
                                                class="ml-1 toggler-icon"></i></button>
                                        <div class="dropdown-menu">
                                            <ul>
                                                <li><a href="{{ route('employee.view.payment.update', ['id' => $payment->id]) }}"
                                                        class="dropdown-link-primary"><i data-feather="edit"
                                                            class="mr-1"></i> Edit Payment</a></li>
                                                <li><a href="javascript:handleDelete({{ $payment->id }});"
                                                        class="dropdown-link-danger"><i data-feather="trash-2"
                                                            class="mr-1"></i> Delete Payment</a></li>
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

        <div class="panel-card-body">
            <div class="md:space-x-5 sm:space-x-0 md:space-y-0 sm:space-y-3 flex md:flex-row sm:flex-col">
                <h1 class="font-medium text-slate-600 text-lg">Total Credit =
                    {{ env('APP_CURRENCY') }}{{ number_format(DB::table('payments')->where('type', 'Credit')->sum('amount'), 2) }}
                </h1>

                <h1 class="font-medium text-slate-600 text-lg">Total Debit =
                    {{ env('APP_CURRENCY') }}{{ number_format(DB::table('payments')->where('type', 'Debit')->sum('amount'), 2) }}
                </h1>

                <h1 class="font-medium text-lg">Net Profit = {{ env('APP_CURRENCY') }}
                    {{ number_format(DB::table('payments')->where('type', 'Credit')->sum('amount') - DB::table('payments')->where('type', 'Debit')->sum('amount'), 2) }}
                </h1>

            </div>
        </div>
    </figure>
@endsection

@section('panel-script')
    <script>
        document.getElementById('payment-tab').classList.add('active');
    </script>

    <script>
        const handleDelete = (id) => {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this payment!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location =
                            `{{ url('employee/payment/delete') }}/${id}`;
                    }
                });
        }
    </script>
@endsection
