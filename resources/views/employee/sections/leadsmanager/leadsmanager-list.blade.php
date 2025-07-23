@extends('employee.layouts.app')

@section('main-content')
<div class="content-body default-height">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ route('employee.view.lead.manager.list') }}">Leads Manager</a></li>
            </ol>
        </div>
        <!-- Row -->
        <div class="row">
            <div class="col-xl-12">
                <div>
                    <a href="{{ route('employee.view.lead.manager.create') }}" type="button" class="btn btn-sm btn-primary mb-4 open btn-loader">Create New Leads</a>
                </div>
                <div class="filter cm-content-box box-primary">
                    <div class="content-title SlideToolHeader">
                        <div class="cpa"><i class="fa-solid fa-file-lines me-1"></i>All Leads</div>
                        <div class="tools"><a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a></div>
                    </div>
                    <div class="cm-content-body form excerpt">
                        <div class="card-body pb-4">
                            <form method="GET" action="{{ route('employee.view.lead.manager.list') }}">
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">From Date</label>
                                        <input type="date" name="from_date" class="form-control"
                                            value="{{ request('from_date') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">To Date</label>
                                        <input type="date" name="to_date" class="form-control"
                                            value="{{ request('to_date') }}">
                                    </div>
                                    <div class="col-md-3 align-self-end">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-filter me-1"></i>Filter</button>
                                        <a href="{{ route('admin.view.lead.manager.list') }}" class="btn btn-danger">Reset</a>
                                    </div>
                                </div>
                            </form>
                            <div class="d-flex justify-content-end mb-3">
                                <a href="{{ route('global.export.excel', [
                                    'model' => 'App\Models\LeadsManager',
                                    'fields' => 'id,name,email,phone,status,created_at',
                                    'from_date' => request('from_date'),
                                    'to_date' => request('to_date'),
                                ]) }}" class="btn btn-success" target="_blank">
                                    <i class="fa fa-file-excel me-1"></i> Export to Excel
                                </a>
                            </div>



                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th>Created at</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($leads_manager as $lead)
                                            <tr>
                                                <td>{{ $lead->id }}</td>
                                                <td>{{ $lead->name }}</td>
                                                <td>{{ $lead->email }}</td>
                                                <td>{{ $lead->phone }}</td>
                                                <td>{{ $lead->address }}</td>
                                                <td>{{ $lead->status }}</td>
                                                <td>{{ $lead->created_at->format('M d, Y') }}</td>
                                                <td class="text-nowrap">
                                                    <a href="tel:{{$lead->phone}}" class="btn btn-success btn-sm content-icon"><i class="fa fa-phone"></i></a>
                                                    <a href="mailto:{{$lead->email}}" class="btn btn-success btn-sm content-icon"><i class="fa fa-envelope"></i></a>
                                                    <a href="{{ route('employee.lead.manager.remarks', ['lead' => $lead->id]) }}" class="btn btn-info btn-sm content-icon view-remarks" title="View Remarks History"><i class="fa fa-history"></i></a>
                                                    <a href="{{ route('employee.view.lead.manager.update', ['id' => $lead->id]) }}" class="btn btn-warning btn-sm content-icon"><i class="fa fa-edit"></i></a>
                                                    <a href="javascript:handleDelete({{ $lead->id }});" class="btn btn-danger btn-sm content-icon"><i class="fa fa-times"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Pagination -->
                                <div class="d-flex align-items-center justify-content-between flex-wrap">
                                    <p class="mb-2 me-3">
                                        Showing {{ $leads_manager->firstItem() }} to {{ $leads_manager->lastItem() }} of {{ $leads_manager->total() }} records
                                    </p>
                                    <nav aria-label="Page navigation example mb-2">
                                        {{ $leads_manager->links('pagination::bootstrap-4') }}
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
@endsection

@section('js')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function handleDelete(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this lead!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                window.location = `{{ url('employee/leadmanager/delete') }}/${id}`;
            }
        });
    }
</script>
@endsection
