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
                            class="btn btn-sm btn-primary mb-4 open btn-loader">Create Invoice</a>
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
                                <div class="table-responsive font-sans">
                                    <table class="table align-middle">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Customer Name</th>
                                                <th>Payment For</th>
                                                <th>Total Amount</th>
                                                <th>GST</th>
                                                <th>Discount</th>
                                                <th>Net Payable</th>
                                                <th>Due Amount</th>
                                                <th>Bill Date</th>
                                                <th>Due Date</th>
                                                <th>Status</th>
                                                <th class="text-end">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($bills as $index => $bill)
                                                <tr>
                                                    <td>{{ $bills->firstItem() + $index }}</td>
                                                    <td><strong>{{ DB::table('customers')->find($bill->customer_id)?->name }}</strong></td>

                                                   <td>
                                                        <span class="badge
                                                            @if($bill->payment_for == 'Package') badge-info
                                                            @elseif($bill->payment_for == 'Domain Hosting') badge-secondary
                                                            @else badge-primary light @endif">

                                                            {{-- Fallback: If display attribute is empty, show 'Manual Invoice' --}}
                                                            {{ $bill->payment_for_display_attribute ?: 'Manual Invoice' }}
                                                        </span>
                                                    </td>

                                                    <td>₹{{ number_format($bill->total, 2) }}</td>
                                                    <td>₹{{ number_format($bill->tax, 2) }}</td>
                                                    <td>₹{{ number_format($bill->discount_amount, 2) }}</td>
                                                    <td>₹{{ number_format($bill->net_payable, 2) }}</td>

                                                    @php
                                                        // Calculate the actual outstanding due amount
                                                        $dueAmount = $bill->total + $bill->tax - $bill->received_amount - $bill->discount_amount;
                                                    @endphp
                                                    <td class="fw-bold {{ $dueAmount > 0 ? 'text-danger' : 'text-success' }}">
                                                        ₹{{ number_format($dueAmount, 2) }}
                                                    </td>

                                                    <td class="font-mono">{{ date('d-m-Y', strtotime($bill->bill_date)) }}</td>
                                                    <td>
                                                        @if (\Carbon\Carbon::parse($bill->due_date) <= \Carbon\Carbon::now() && $bill->payment_status != 'Paid')
                                                            <span class="badge badge-rounded badge-danger font-mono">{{ date('d-m-Y', strtotime($bill->due_date)) }}</span>
                                                        @else
                                                            <span class="badge badge-rounded badge-success font-mono">{{ date('d-m-Y', strtotime($bill->due_date)) }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            @if ($bill->payment_status == 'Paid')
                                                                <i class="fa fa-circle text-success me-1"></i> Paid
                                                            @elseif ($bill->payment_status == 'Settled')
                                                                <i class="fa fa-circle text-success me-1"></i> Settled
                                                            @else
                                                                <i class="fa fa-circle text-danger me-1"></i> Pending
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="text-nowrap text-end">

                                                        <!-- 1. Copy Payment Link Button (if generated) -->
                                                        @if($bill->razorpay_payment_link)
                                                            <button type="button" onclick="copyToClipboard('{{ $bill->razorpay_payment_link }}')" class="btn btn-primary btn-sm content-icon" title="Copy Razorpay Payment Link">
                                                                <i class="fa fa-copy"></i>
                                                            </button>
                                                        @endif

                                                        <!-- 2. Send Razorpay Reminder Notification (if pending) -->
                                                        @if($bill->razorpay_payment_link_id && $bill->payment_status != 'Paid' && $bill->payment_status != 'Settled')
                                                            <form action="{{ route('admin.bill.reminder', ['id' => $bill->id]) }}" method="POST" class="d-inline needs-loader">
                                                                @csrf
                                                                <button type="submit" class="btn btn-warning btn-sm content-icon" title="Send Razorpay Reminder">
                                                                    <i class="fa fa-bell"></i>
                                                                </button>
                                                            </form>
                                                        @endif

                                                        <!-- Edit Button (Only visible if unpaid) -->
                                                        @if ($dueAmount > 0 && $bill->received_amount == 0)
                                                            <a href="{{ route('admin.view.bill.update', ['id' => $bill->id]) }}"
                                                                class="btn btn-warning btn-sm content-icon" title="Edit Bill">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                        @endif

                                                        <!-- Standard CRM Actions -->
                                                        <a href="{{ route('admin.bill.history', ['bill' => $bill->id]) }}" class="btn btn-info btn-sm content-icon view-remarks" title="View Payment History">
                                                            <i class="fa fa-history"></i>
                                                        </a>
                                                        <a href="{{ route('admin.handle.bill.duplicate', ['id' => $bill->id]) }}"
                                                            class="btn btn-success btn-sm content-icon" title="Duplicate Bill">
                                                            <i class="fa fa-window-maximize"></i>
                                                        </a>
                                                        <a href="{{ route('admin.handle.bill.invoice', ['id' => $bill->id]) }}"
                                                            class="btn btn-success btn-sm content-icon download-invoice-btn" title="Download Invoice PDF">
                                                            <i class="fa fa-download"></i>
                                                        </a>
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
    {{-- Include SweetAlert2 if missing in app.blade.php --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Reusable clipboard copy script with animated success toast
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                });
                Toast.fire({
                    icon: 'success',
                    title: 'Payment link copied to clipboard!'
                });
            }).catch(err => {
                console.error('Failed to copy text: ', err);
            });
        }

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

        document.addEventListener('DOMContentLoaded', function () {
            const downloadButtons = document.querySelectorAll('.download-invoice-btn');

            downloadButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const downloadUrl = this.href;

                    const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 2000,
                      timerProgressBar: true,
                    });

                    Toast.fire({
                      icon: 'info',
                      title: 'Preparing your invoice for download...'
                    });

                    setTimeout(() => {
                        window.location.href = downloadUrl;
                    }, 1500);
                });
            });
        });
    </script>
@endsection
