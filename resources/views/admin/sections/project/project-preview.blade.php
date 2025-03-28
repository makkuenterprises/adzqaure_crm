@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Manage Payments</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.project.list') }}">Projects</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.project.preview',['id' => $project->id]) }}">Manage Payments</a></li>
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
                    <a href="{{ route('admin.view.payment.create',['project_id' => $project->id]) }}&type=Credit" class="btn-primary-md">Add Credit</a>
                    <a href="{{ route('admin.view.payment.create',['project_id' => $project->id]) }}&type=Debit" class="btn-primary-md">Add Debit</a>
                </div>
            </div>
            {{-- <div class="panel-card-body space-y-4 border-b">
                <div>
                    <h1 class="font-semibold text-xl">{{$project->name}}</h1>
                </div>
                <div>
                    <p class="text-sm text-slate-600 flex items-center font-medium"><i data-feather="calendar" class="h-4 w-4 mr-1 mb-1"></i>From {{ date('d-m-Y',strtotime($project->start_date)) }} {{ is_null($project->end_date) ? null : 'to ' . date('d-m-Y',strtotime($project->end_date)) }}</p>
                </div>

                @if (!is_null($project->project_link) || !is_null($project->resource_link))
                <div class="space-x-2 flex">
                    
                    @if (!is_null($project->project_link))
                    <a target="_blank" href="{{$project->project_link}}" class="btn-secondary-sm w-fit flex items-center font-medium"><i data-feather="external-link" class="h-4 w-4 mr-2"></i>View Project</a>
                    @endif

                    @if (!is_null($project->resource_link))
                    <a target="_blank" href="{{$project->resource_link}}" class="btn-secondary-sm w-fit flex items-center font-medium"><i data-feather="link" class="h-4 w-4 mr-2"></i>View Resources</a>
                    @endif

                </div>
                @endif

            </div> --}}
            <div class="panel-card-body border-b">
                    
                <div class="panel-card-table">
                    <table class="data-table">
                        <thead class="border-b">
                            <tr>
                                <th class="border-r">ID</th>
                                <th class="border-r">Credit</th>
                                <th class="border-r">Debit</th>
                                <th class="border-r">Date</th>
                                <th class="border-r">Remark</th>
                                <th class="border-r">Method</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                                <tr>
                                    <td class="border-r">{{ $payment->id }}</td>
                                    <td class="border-r">
                                        @if ($payment->type == "Credit")
                                        <div class="table-status-success">{{env('APP_CURRENCY')}}{{$payment->amount}}</div>
                                        @endif
                                    </td>
                                    <td class="border-r">
                                        @if ($payment->type == "Debit")
                                        <div class="table-status-danger">{{env('APP_CURRENCY')}}{{$payment->amount}}</div>
                                        @endif
                                    </td>
                                    <td class="border-r">{{ date('D d-m-Y',strtotime($payment->date)) }}</td>
                                    <td class="border-r">{{ $payment->remark }}</td>
                                    <td class="border-r">{{ $payment->method }}</td>
                                    <td>
    
                                        <div class="table-dropdown">
                                            <button>Options<i data-feather="chevron-down"
                                                    class="ml-1 toggler-icon"></i></button>
                                            <div class="dropdown-menu">
                                                <ul>
                                                    <li><a href="{{ route('admin.view.payment.update', ['id' => $payment->id]) }}?project_id={{$payment->project_id}}"
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
                    <h1 class="font-medium text-slate-600 text-lg">Total Credit = {{env('APP_CURRENCY')}}{{number_format($credit_amount ,2)}}</h1>

                    <h1 class="font-medium text-slate-600 text-lg">Total Debit = {{env('APP_CURRENCY')}}{{number_format($debit_amount ,2)}}</h1>

                    <h1 class="font-medium text-lg">Net Profit = {{env('APP_CURRENCY')}}
                        {{number_format($credit_amount - $debit_amount,2)}}</h1>

                </div>
            </div>
        </figure>
@endsection

@section('panel-script')
    <script>
        document.getElementById('project-tab').classList.add('active');

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
                            `{{ url('admin/payment/delete') }}/${id}`;
                    }
                });
        }
    </script>
@endsection
