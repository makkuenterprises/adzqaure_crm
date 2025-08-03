@extends('admin.layouts.app')



@section('main-content')
    <!--**********************************
                                                Content body start
                                            ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.view.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.view.employee.list') }}">Team Members</a></li>
                </ol>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div>
                        <a href="{{ route('admin.view.employee.create') }}" type="button"
                            class="btn btn-sm btn-primary mb-4 open btn-loader">Create New Employees</a>
                    </div>
                    <div class="filter cm-content-box box-primary">
                        <div class="content-title SlideToolHeader">
                            <div class="cpa">
                                <i class="fa-solid fa-file-lines me-1"></i>Employees List
                            </div>
                            <div class="tools">
                                <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                            </div>
                            <div class="d-flex justify-content-end mb-3 mt-3">
                                <a href="{{ route('global.export.excel', [
                                    'model' => 'App\Models\Employee',
                                    'fields' => 'id,name,email,phone,status,created_at',
                                    'from_date' => request('from_date'),
                                    'to_date' => request('to_date'),
                                ]) }}" class="btn btn-success btn-loader" target="_blank">
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
                                                <th>S.No</th>
                                                <th>Emp Id</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Role</th>

                                                <th>Designation</th>
                                                <th>Date of Joining</th>
                                                 <th>Status</th>
                                                <th>Actions</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($employees as $index => $employee)
                                                <tr>
                                                    <td>{{ $employees->firstItem() + $index }}</td>
                                                    <td>{{ $employee->employee_id }}</td>
                                                    <td>{{ $employee->name }}</td>
                                                    <td>{{ $employee->email }}</td>
                                                    <td>{{ $employee->phone }}</td>
                                                    <td>{{ $employee->role }}</td>
                                                    <td>{{ $employee->designation }}</td>
                                                    <td>{{ $employee->date_of_joining }}</td>

                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            @if ($employee->status == 1)
                                                                <i class="fa fa-circle text-success me-1"></i> Enabled
                                                            @else
                                                                <i class="fa fa-circle text-danger me-1"></i> Disabled
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="text-nowrap">

                                                        <a href="{{ route('admin.view.employee.update', ['id' => $employee->id]) }}"
                                                            class="btn btn-warning btn-sm content-icon">
                                                            <i class="fa fa-edit"></i>
                                                        </a>

                                                        <a href="javascript:handleDelete({{ $employee->id }});"
                                                            class="btn btn-danger btn-sm content-icon">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                                        <p class="mb-2 me-3">
                                            Showing {{ $employees->firstItem() }} to {{ $employees->lastItem() }} of
                                            {{ $employees->total() }} records
                                        </p>
                                        <nav aria-label="Page navigation example mb-2">
                                            {{ $employees->links('pagination::bootstrap-4') }}
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
                    text: "Once deleted, you will not be able to recover this admin!",
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
