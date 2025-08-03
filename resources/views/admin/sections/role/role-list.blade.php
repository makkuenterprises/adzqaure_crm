@extends('admin.layouts.app')

@section('main-content')
    <!--**********************************
                                                 Content body start
                                                 ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.view.role.list') }}">Roles</a>
                    </li>
                </ol>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div>
                        <a href="{{ route('admin.view.role.create') }}" type="button"
                            class="btn btn-sm btn-primary mb-4 open btn-loader">Create New Employee Role</a>
                    </div>
                    <div class="filter cm-content-box box-primary">
                        <div class="content-title SlideToolHeader">
                            <div class="cpa">
                                <i class="fa-solid fa-file-lines me-1"></i>Manage Roles
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
                                                <th>Roles</th>
                                                <th>Slug</th>
                                                <th>Created at</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roles as $role)
                                                <tr>
                                                    <td>{{ $role->id }}</td>
                                                    <td>{{ $role->name }}</td>
                                                    <td>{{ $role->slug }}</td>
                                                    <td>{{ $role->created_at->format('Y-m-d H:i') }}</td>


                                                    <td class="text-nowrap">


                                                        <a href="{{ route('admin.view.role.update', ['id' => $role->id]) }}"
                                                            class="btn btn-success btn-sm content-icon">
                                                            <i class="fa fa-plus-circle"></i>
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

                                    <!-- Pagination Information -->
                                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                                        <p class="mb-2 me-3">
                                            Showing {{ $roles->firstItem() }} to {{ $roles->lastItem() }} of
                                            {{ $roles->total() }} records
                                        </p>
                                        <nav aria-label="Page navigation example mb-2">
                                            {{ $roles->links('pagination::bootstrap-4') }}
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
                    text: "Once deleted, you will not be able to recover this service category!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = `{{ url('admin.handle.role.delete') }}/${id}`;
                    }
                });
        }
    </script>
@endsection
