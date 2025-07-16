@extends('admin.layouts.app')


@section('main-content')
    <!--**********************************
                                                                                                        Content body start
                                                                                                    ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.view.lead.manager.list') }}">Leads manager</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.lead.manager.remarks', ['lead' => $lead->id]) }}">View Remarks</a></li>
                </ol>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h4 class="card-title">Remarks | #ID-{{$lead->id}} : Phone: {{$lead->phone}}</h4>
                                    {{-- Optional: A link to create a new invoice for this specific customer --}}
                                    <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addRemarkModal">+ Add New Remark</a>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="addRemarkModal" tabindex="-1" aria-labelledby="addRemarkModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <form action="{{ route('admin.lead.manager.remarks.store', $lead->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="addRemarkModalLabel">Add New Remark</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="comment">Remark</label>
                                                <textarea name="comment" id="comment" class="form-control" rows="4" required></textarea>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Save Remark</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Records</th>
                                                    <th>Created At</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($remarks as $remark)
                                                    <tr>
                                                        <td>{{ $remark->comment }}</td>
                                                        <td>{{ $remark->created_at->format('d-m-Y h:i A') }}</td>
                                                    </tr>
                                                @empty
                                                    <li class="list-group-item">No remarks found.</li>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                    {{-- Pagination Links for the bills --}}
                                    <div class="mt-3">
                                        {{ $remarks->links() }}
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


