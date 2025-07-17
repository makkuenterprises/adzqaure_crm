@extends('admin.layouts.app')

@section('main-content')
    <!--**********************************
                                                                                                                                                Content body start
                                                                                                                                            ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Management</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Admin Access</a></li>
                </ol>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div>
                        <a href="{{ route('admin.view.admin.create') }}" type="button"
                            class="btn btn-sm btn-primary mb-4 open btn-loader">Create New Admin</a>
                    </div>
                    <div class="filter cm-content-box box-primary">
                        <div class="content-title SlideToolHeader">
                            <div class="cpa">
                                <i class="fa-solid fa-file-lines me-1"></i>Admin List
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
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($admins as $index => $admin)
                                                <tr>
                                                    <td>{{ $admins->firstItem() + $index }}</td>
                                                    <td>{{ $admin->name }}</td>
                                                    <td>{{ $admin->email }}</td>
                                                    <td>{{ $admin->phone }}</td>
                                                    <td>
                                                        @switch($admin->role)
                                                            @case('Master Admin')
                                                                <span
                                                                    class="badge badge-rounded badge-success">{{ $admin->role }}</span>
                                                            @break

                                                            @case('Super Admin')
                                                                <span
                                                                    class="badge badge-rounded badge-success">{{ $admin->role }}</span>
                                                            @break

                                                            @case('Sub Admin')
                                                                <span
                                                                    class="badge badge-rounded badge-warning">{{ $admin->role }}</span>
                                                            @break
                                                        @endswitch
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            @if ($admin->status == 1)
                                                                <i class="fa fa-circle text-success me-1"></i> Enabled
                                                            @else
                                                                <i class="fa fa-circle text-danger me-1"></i> Disabled
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="text-nowrap">

                                                        <a href="{{ route('admin.view.admin.update', ['id' => $admin->id]) }}"
                                                            class="btn btn-warning btn-sm content-icon">
                                                            <i class="fa fa-edit"></i>
                                                        </a>

                                                        <a href="javascript:handleDelete({{ $admin->id }});"
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
                                            Showing {{ $admins->firstItem() }} to {{ $admins->lastItem() }} of
                                            {{ $admins->total() }} records
                                        </p>
                                        <nav aria-label="Page navigation example mb-2">
                                            {{ $admins->links('pagination::bootstrap-4') }}
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
                        window.location = `{{ url('admin/admin-access/delete') }}/${id}`;
                    }
                });
        }
    </script>
@endsection
