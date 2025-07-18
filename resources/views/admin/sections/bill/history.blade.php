@extends('admin.layouts.app')

@section('main-content')
<!--**********************************
    Content body start
***********************************-->
<div class="content-body default-height">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.view.bill.list') }}">Billing</a></li>
                <li class="breadcrumb-item active"><a href="#">Payment History</a></li>
            </ol>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">

                    @php
                        // THE ONE TRUE CALCULATION for the due amount. This is the only one we need.
                        // It correctly accounts for the total, tax, payments received, AND discounts/settlements.
                        $due_amount = $bill->total + $bill->tax - $bill->received_amount - $bill->discount_amount;
                    @endphp

                    <div class="card-header d-flex justify-content-between align-items-center">
                       <h4 class="card-title">Bill #{{ $bill->id }} | Due: ₹{{ number_format($bill->total + $bill->tax - $bill->received_amount - $bill->discount_amount, 2) }}</h4>

                         <div>
                            @if (!in_array($bill->payment_status, ['Paid', 'Settled']))
                                <a href="#" class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#addPaymentModal">+ Add Received Payment</a>
                                {{-- NEW: Bill Settlement Button --}}
                                <a href="#" class="btn btn-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#settleBillModal">Settle Bill</a>
                            @else
                               <span class="btn btn-success btn-sm me-2 disabled">
                                    <i class="fa fa-check me-1"></i>
                                    {{ $bill->payment_status }} {{-- This will dynamically show 'Paid' or 'Settled' --}}
                                </span>
                            @endif
                                <a href="{{ route('admin.view.bill.list') }}" class="btn btn-success btn-sm">Back</a>
                        </div>
                    </div>

                    <!-- Payment Modal -->
                    <div class="modal fade" id="addPaymentModal" tabindex="-1" aria-labelledby="addPaymentModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('admin.bill.history.store', $bill->id) }}">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addPaymentModalLabel">Add Received Payment</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="received_amount" class="form-label">Received Amount (₹)</label>
                                            <input type="number" name="received_amount" id="received_amount" step="0.01" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="payment_method" class="form-label">Payment Method</label>
                                            <select name="payment_method" id="payment_method" class="form-select">
                                                <option value="Cash">Cash</option>
                                                <option value="UPI">UPI</option>
                                                <option value="Bank Transfer">Bank Transfer</option>

                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="notes" class="form-label">Notes (optional)</label>
                                            <textarea name="notes" id="notes" class="form-control" rows="3"></textarea>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success">Add Payment</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->

                    <!-- ============================================= -->
                    <!-- NEW: Bill Settlement Confirmation Modal -->
                    <!-- ============================================= -->
                    <div class="modal fade" id="settleBillModal" tabindex="-1" aria-labelledby="settleBillModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('admin.bill.settle', $bill->id) }}">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="settleBillModalLabel">Confirm Bill Settlement</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <p>Are you sure you want to settle this invoice?</p>
                                        <p class="alert alert-warning">
                                            The remaining due amount of <strong>₹{{ number_format($due_amount, 2) }}</strong> will be written off as a settlement discount, and the invoice will be marked as <strong>Paid</strong>. This action cannot be undone.
                                        </p>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success">Yes, Settle Invoice</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Settlement Modal -->

                    <div class="card-body p-0">
                        <div id="DZ_W_TimeLine" class="widget-timeline dlab-scroll p-4">
                            <ul class="timeline">
                                @forelse($payment_histories as $history)
                                    <li>
                                        <div class="timeline-badge success"></div>
                                        <div class="timeline-panel text-muted">
                                            <span>{{ $history->created_at->format('d-m-Y h:i A') }}</span>
                                            <h6 class="mb-1">Received ₹{{ number_format($history->received_amount, 2) }}</h6>
                                            @if($history->payment_method)
                                                <small>Method: {{ $history->payment_method }}</small><br>
                                            @endif
                                            @if($history->notes)
                                                <small>Notes: {{ $history->notes }}</small>
                                            @endif
                                        </div>
                                    </li>
                                @empty
                                    <li>
                                        <div class="timeline-panel text-muted">
                                            <h6>No payments recorded yet.</h6>
                                        </div>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>

                    <div class="card-footer">
                        {{ $payment_histories->links() }}
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
