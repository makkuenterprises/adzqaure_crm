@extends('admin.layouts.app')

@section('main-content')
    <!--**********************************
        Content body start
         ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('admin.view.bill.list') }}">Payments & Bill</a></li>

                </ol>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div>
                        <a href="{{ route('admin.view.bill.create') }}" type="button"
                            class="btn btn-sm btn-primary mb-4 open">Create Invoice</a>
                    </div>
                    <div class="filter cm-content-box box-primary">
                        <div class="content-title SlideToolHeader">
                            <div class="cpa">
                                <i class="fa-solid fa-file-lines me-1"></i>Invoices
                            </div>
                            <div class="tools">
                                <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                            </div>
                        </div>
                        <div class="cm-content-body form excerpt">
                            <div class="card-body pb-4">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                {{-- <th>Invoice No.</th> --}}
                                                <th>Customer Name</th>
                                                <th>Total Amount</th>
                                                <th>Discount</th>
                                                <th>Net Payable</th>
                                                <th>Due Amount</th>
                                                <th>Bill Date</th>
                                                <th>Due Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- {{ dd($bills) }} --}}
                                            @foreach ($bills as $index => $bill)
                                                <tr>
                                                    <td>{{ $bills->firstItem() + $index }}</td>
                                                    <td>{{ DB::table('customers')->find($bill->customer_id)?->name }}</td>
                                                    <td>₹{{ number_format($bill->total, 2) }}</td>
                                                    <td>₹{{ number_format($bill->discount_amount, 2) }}</td>
                                                    <td>₹{{ number_format($bill->net_payable, 2) }}</td>
                                                    @php
                                                        $total_received = $bill->paymentHistories ? $bill->paymentHistories->sum('received_amount') : 0;
                                                        $due_amount = $bill->net_payable - $total_received;
                                                    @endphp

                                                    <td class="fw-bold {{ $due_amount > 0 ? 'text-danger' : 'text-success' }}">
                                                        ₹{{ number_format($due_amount, 2) }}
                                                    </td>

                                                    <td>{{ date('d-m-Y', strtotime($bill->bill_date)) }}</td>
                                                    <td>
                                                        @if (\Carbon\Carbon::parse($bill->due_date) <= \Carbon\Carbon::now())
                                                            <span
                                                                class="badge badge-rounded badge-danger">{{ date('d-m-Y', strtotime($bill->due_date)) }}</span>
                                                        @else
                                                            <span
                                                                class="badge badge-rounded badge-success">{{ date('d-m-Y', strtotime($bill->due_date)) }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            @if ($bill->payment_status == 'Paid')
                                                                <i class="fa fa-circle text-success me-1"></i> Paid
                                                            @else
                                                                <i class="fa fa-circle text-danger me-1"></i> Pending
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="text-nowrap">

                                                        <a href="{{ route('admin.view.bill.update', ['id' => $bill->id]) }}"
                                                            class="btn btn-warning btn-sm content-icon">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a href="{{ route('admin.bill.history', ['bill' => $bill->id]) }}" class="btn btn-info btn-sm content-icon view-remarks" title="View Payment History"><i class="fa fa-history"></i></a>
                                                        <a href="{{ route('admin.handle.bill.duplicate', ['id' => $bill->id]) }}"
                                                            class="btn btn-success btn-sm content-icon">
                                                            <i class="fa fa-window-maximize"></i>
                                                        </a>
                                                        <a href="{{ route('admin.handle.bill.invoice', ['id' => $bill->id]) }}"
                                                            class="btn btn-success btn-sm content-icon">
                                                            <i class="fa fa-download"></i>
                                                        </a>

                                                        {{-- <a href="javascript:handleDelete({{ $bill->id }});"
                                                            class="btn btn-danger btn-sm content-icon">
                                                            <i class="fa fa-times"></i>
                                                        </a> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                                        <p class="mb-2 me-3">
                                            Showing {{ $bills->firstItem() }} to {{ $bills->lastItem() }} of
                                            {{ $bills->total() }} records
                                        </p>
                                        <nav aria-label="Page navigation example mb-2">
                                            {{ $bills->links('pagination::bootstrap-4') }}
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
                                                                                    Content body end
                                                                                ***********************************-->
@endsection

@section('js')
    <script>
        function handleDelete(id) {

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
                            `{{ url('admin/admin-access/delete') }}/${id}`;
                    }
                });
        }
    </script>
@endsection
