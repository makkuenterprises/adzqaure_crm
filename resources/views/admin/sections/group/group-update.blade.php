@extends('admin.layouts.app')


@section('main-content')
    <!--**********************************
                                                                                                        Content body start
                                                                                                    ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.view.group.list') }}">Data Groups</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.view.group.update', ['id' => $group->id]) }}">Update Data Groups</a></li>
                </ol>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <form action="{{ route('admin.handle.group.update', ['id' => $group->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="filter cm-content-box box-primary">
                            <div class="content-title SlideToolHeader">
                                <div class="cpa">
                                    <i class="fa-solid fa-file-lines me-1"></i>Update Information
                                </div>
                                <div class="tools">
                                    <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                                </div>
                            </div>
                            <div class="mb-3 m-3 col-md-6">
                                <label for="name" class="form-label">Update Group Name<span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ $group->name }}" class="form-control @error('name') input-invalid @enderror" placeholder="Enter name" minlength="1" maxlength="250">
                                @error('name')
                                    <span class="input-error">{{ $message }}</span>
                                @enderror
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
                                                    <th>Address</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($leads as $lead)
                                                    <tr>
                                                        <td>{{ $lead->id }}</td>
                                                        <td>{{ $lead->name }}</td>
                                                        <td>{{ $lead->email }}</td>
                                                        <td>{{ $lead->phone }}</td>
                                                        <td>{{ $lead->address }}</td>
                                                        <td class="text-nowrap">

                                                            <a href="tel: {{$lead->phone}}"
                                                                class="btn btn-warning btn-sm content-icon">
                                                                <i class="fa fa-phone"></i>
                                                            </a>
                                                            <a href="mailto: {{$lead->email}}"
                                                                class="btn btn-success btn-sm content-icon">
                                                                <i class="fa fa-envelope"></i>
                                                            </a>

                                                            <a href="javascript:handleLeadDelete({{ $lead->id }});"
                                                                class="btn btn-danger btn-sm content-icon">
                                                                <i class="fa fa-times"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>


                                        <!-- Pagination Information -->
                                        {{-- <div class="d-flex align-items-center justify-content-between flex-wrap">
                                            <p class="mb-2 me-3">
                                                Showing {{ $lead->firstItem() }} to {{ $lead->lastItem() }} of
                                                {{ $lead->total() }} records
                                            </p>
                                            <nav aria-label="Page navigation example mb-2">
                                                {{ $lead->links('pagination::bootstrap-4') }}
                                            </nav>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Data Group</button>
                    </form>
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
        function handleLeadDelete(id) {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this group!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = `{{ url('admin/lead/delete') }}/${id}`;
                    }
                });
        }
    </script>
@endsection
