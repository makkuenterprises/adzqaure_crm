@extends('admin.layouts.app')

@section('main-content')
    <!--**********************************
                                                 Content body start
                                                 ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.view.service-category.list') }}">Service Category</a>
                    </li>
                </ol>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div>
                        <a href="{{ route('admin.view.service-category.create') }}" type="button"
                            class="btn btn-sm btn-primary mb-4 open btn-loader">Create Service Category</a>
                    </div>
                    <div class="filter cm-content-box box-primary">
                        <div class="content-title SlideToolHeader">
                            <div class="cpa">
                                <i class="fa-solid fa-file-lines me-1"></i>All Service Category
                            </div>
                            <div class="tools">
                                <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                            </div>
                            <div class="d-flex justify-content-end mb-3 mt-3">
                                <a href="{{ route('global.export.excel', [
                                    'model' => 'App\Models\ServiceCategory',
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
                                                <th>Service Category Name</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($service_cat as $index => $category)
                                                <tr>
                                                    <td>{{ $service_cat->firstItem() + $index }}</td>
                                                    <td>{{ $category->name }}</td>
                                                    <td>
                                                        {{-- Check the status and display the appropriate badge --}}
                                                        @if ($category->status)
                                                            <span class="badge bg-success">Active</span>
                                                        @else
                                                            <span class="badge bg-danger">Inactive</span>
                                                        @endif
                                                    </td>


                                                    <td class="text-nowrap">
                                                        <a href="{{ route('admin.view.service-category.update', ['id' => $category->id]) }}"
                                                            class="btn btn-warning btn-sm content-icon">
                                                            <i class="fa fa-edit"></i>
                                                        </a>


                                                        <a href="javascript:handleDelete({{ $category->id }});"
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
                                            Showing {{ $service_cat->firstItem() }} to {{ $service_cat->lastItem() }} of
                                            {{ $service_cat->total() }} records
                                        </p>
                                        <nav aria-label="Page navigation example mb-2">
                                            {{ $service_cat->links('pagination::bootstrap-4') }}
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
                        window.location = `{{ url('admin/service-category/delete') }}/${id}`;
                    }
                });
        }
    </script>
@endsection
