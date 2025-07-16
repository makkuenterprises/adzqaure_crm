@extends('admin.layouts.app')


@section('main-content')
    <!--**********************************
          Content body start
        ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('admin.view.lead.manager.list') }}">Leads Manager</a></li>
                </ol>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="filter cm-content-box box-primary">
                        <div class="content-title SlideToolHeader">
                            <div class="cpa">
                                <i class="fa-solid fa-file-lines me-1"></i>All Inquiries
                            </div>
                            <div class="tools">
                                <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                            </div>
                            <div class="d-flex justify-content-end mb-3 mt-3">
                                <a href="{{ route('global.export.excel', [
                                    'model' => 'App\Models\Inquiry',
                                    'fields' => 'id,name,email,phone,status,created_at',
                                    'from_date' => request('from_date'),
                                    'to_date' => request('to_date'),
                                ]) }}" class="btn btn-success" target="_blank">
                                    <i class="fa fa-file-excel me-1"></i> Export to Excel
                                </a>
                            </div>
                        </div>

                        <div class="cm-content-body form excerpt">
                            <div class="card-body pb-4">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Company</th>
                                                <th>Message</th>
                                                <th>Received At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($inquiries as $inquiry)
                                                <tr>
                                                   <td>{{ $inquiry->id }}</td>
                                                    <td>{{ $inquiry->name }}</td>
                                                    <td>{{ $inquiry->email }}</td>
                                                    <td>{{ $inquiry->phone ?? '-' }}</td>
                                                    <td>{{ $inquiry->company }}</td>
                                                    <td>{{ Str::limit($inquiry->message, 100) }}</td>
                                                    <td>{{ $inquiry->created_at->format('d M Y, h:i A') }}</td>


                                                    <td class="text-nowrap">

                                                        <a href="tel: {{$inquiry->phone}}"
                                                            class="btn btn-success btn-sm content-icon">
                                                            <i class="fa fa-phone"></i>
                                                        </a>
                                                        <a href="mailto: {{$inquiry->email}}"
                                                            class="btn btn-success btn-sm content-icon">
                                                            <i class="fa fa-envelope"></i>
                                                        </a>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>


                                    <!-- Pagination Information -->
                                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                                        <p class="mb-2 me-3">
                                            Showing {{ $inquiries->firstItem() }} to {{ $inquiries->lastItem() }} of
                                            {{ $inquiries->total() }} records
                                        </p>
                                        <nav aria-label="Page navigation example mb-2">
                                            {{ $inquiries->links('pagination::bootstrap-4') }}
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
                    text: "Once deleted, you will not be able to recover this group!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = `{{ url('admin/leadmanager/delete') }}/${id}`;
                    }
                });
        }
    </script>
@endsection

