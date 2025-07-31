@extends('admin.layouts.app')

@section('main-content')
<div class="content-body default-height">
    <div class="container-fluid">

        <!-- Breadcrumb -->
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="{{ route('admin.view.quotation.list') }}">Quotations</a>
                </li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-xl-12">
                <!-- Create Button -->
                <a href="{{ route('admin.view.quotation.create') }}" class="btn btn-sm btn-primary mb-4 open btn-loader">
                    Create Quotation
                </a>

                <!-- Quotations Table -->
                <div class="filter cm-content-box box-primary">
                    <div class="content-title SlideToolHeader d-flex justify-content-between align-items-center">
                        <div class="cpa">
                            <i class="fa-solid fa-file-lines me-1"></i> Quotations
                        </div>
                        <div class="tools">
                            <a href="javascript:void(0);" class="expand handle">
                                <i class="fal fa-angle-down"></i>
                            </a>
                        </div>
                    </div>

                    <div class="cm-content-body form excerpt">
                        <div class="card-body pb-4">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Quotation ID</th>
                                            <th>Customer Name</th>
                                            <th>Service Category</th>
                                            <th>Service Name</th>
                                            <th>Quotation Amount</th>
                                            <th>Content</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($quotations as $index => $quotation)
                                        <tr>
                                            <td>{{ $quotations->firstItem() + $index }}</td>
                                            <td>#Q{{ str_pad($quotation->id, 4, '0', STR_PAD_LEFT) }}</td>

                                            <!-- Names are now fetched correctly from the relationships -->
                                            <td>{{ $quotation->customer->name ?? 'N/A' }}</td>
                                            <td>{{ $quotation->serviceCategory->name ?? 'N/A' }}</td>
                                            <td>{{ $quotation->service->service_name ?? 'N/A' }}</td>

                                            <td>₹{{ number_format($quotation->quotation_amount, 2) }}</td>

                                            <!-- FIX: Content column with a button and a hidden div for the full content -->
                                            <td>
                                                <button type="button" class="btn btn-secondary btn-sm view-content-btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#contentModal">
                                                    View Content
                                                </button>

                                                <!-- This hidden div holds the raw HTML content for the modal -->
                                                <div class="full-content" style="display: none;">
                                                    {!! $quotation->content !!}
                                                </div>
                                            </td>

                                            <td>{{ \Carbon\Carbon::parse($quotation->created_at)->format('d-m-Y') }}</td>
                                            <td class="text-nowrap">

                                                <a href="{{ route('admin.handle.quotation.invoice', ['id' => $quotation->id]) }}"
                                                            class="btn btn-success btn-sm content-icon download-invoice-btn">
                                                            <i class="fa fa-download"></i>
                                                        </a>
                                                {{-- Your other action buttons --}}
                                                <a href="javascript:void(0);" onclick="handleDelete({{ $quotation->id }})"
                                                class="btn btn-danger btn-sm" title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                </table>

                                <!-- Pagination Footer -->
                                <div class="d-flex align-items-center justify-content-between flex-wrap">
                                    <p class="mb-2 me-3">
                                        Showing {{ $quotations->firstItem() }} to {{ $quotations->lastItem() }} of
                                        {{ $quotations->total() }} records
                                    </p>
                                    <nav aria-label="Page navigation example mb-2">
                                        {{ $quotations->links('pagination::bootstrap-4') }}
                                    </nav>
                                </div>

                            </div>
                        </div>
                    </div>
                </div> <!-- /.box -->
            </div>
        </div>
    </div>
</div>

<!-- In resources/views/admin/sections/quotation/quotation-list.blade.php -->

<!-- Content Display Modal -->
<div class="modal fade" id="contentModal" tabindex="-1" aria-labelledby="contentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="contentModalLabel">Quotation Content</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal-content-body">
        <!-- The rich text content will be injected here by JavaScript -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modalBody = document.getElementById('modal-content-body');

        document.querySelectorAll('.view-content-btn').forEach(button => {
            button.addEventListener('click', function () {
                // FIX: Find the closest table row, then find the hidden .full-content div within it
                const content = this.closest('tr').querySelector('.full-content').innerHTML;

                // Place the raw HTML into the modal's body, where it will be rendered correctly
                modalBody.innerHTML = content;
            });
        });
    });

    // Your existing delete function (no changes needed here)
    function handleDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This quotation will be permanently deleted.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `{{ url('admin/quotation/delete') }}/${id}`;
            }
        });
    }
</script>
@endsection
