@extends('admin.layouts.app')


@section('main-content')
    <!--**********************************
                                                                                                        Content body start
                                                                                                    ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.view.group.list') }}">Data Records</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.view.group.list') }}">Data Groups</a></li>
                </ol>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div>
                        <a href="{{ route('admin.view.group.create') }}" type="button"
                            class="btn btn-sm btn-primary mb-4 open">Create New Data Group</a>
                    </div>
                    <div class="filter cm-content-box box-primary">
                        <div class="content-title SlideToolHeader">
                            <div class="cpa">
                                <i class="fa-solid fa-file-lines me-1"></i>All Data Groups
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
                                                <th>Group Name</th>
                                                <th>No. of Records</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($groups as $index => $group)
                                                <tr>
                                                    <td>{{ $groups->firstItem() + $index }}</td>
                                                    <td><a
                                                            href="{{ route('admin.view.group.preview', ['id' => $group->id]) }}">{{ $group->name }}</a>
                                                    </td>
                                                    <td>{{ DB::table('leads')->where('group_id', $group->id)->count() }}
                                                    </td>
                                                    <td class="text-nowrap">

                                                        <a href="{{ route('admin.view.group.update', ['id' => $group->id]) }}"
                                                            class="btn btn-warning btn-sm content-icon">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a href="{{ route('admin.view.group.preview', ['id' => $group->id]) }}"
                                                            class="btn btn-success btn-sm content-icon">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admin.view.group.export', ['id' => $group->id]) }}"
                                                            class="btn btn-success btn-sm content-icon">
                                                            <i class="fa fa-download"></i>
                                                        </a>
                                                        <a href="javascript:handleDelete({{ $group->id }});"
                                                            class="btn btn-danger btn-sm content-icon">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>


                                    <!-- Pagination Information -->
                                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                                        <p class="mb-2 me-3">
                                            Showing {{ $groups->firstItem() }} to {{ $groups->lastItem() }} of
                                            {{ $groups->total() }} records
                                        </p>
                                        <nav aria-label="Page navigation example mb-2">
                                            {{ $groups->links('pagination::bootstrap-4') }}
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
                        window.location = `{{ url('admin/group/delete') }}/${id}`;
                    }
                });
        }
    </script>
@endsection
