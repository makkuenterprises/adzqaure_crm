@extends('admin.layouts.app')


@section('main-content')
      <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body default-height">
            <div class="container-fluid">
				<div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Data Records</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Create Data</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
					<div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="{{ route('admin.handle.group.create') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Group Name<span class="text-danger">*</span></label>
                                                <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') input-invalid @enderror" placeholder="Enter Group Name" minlength="1" maxlength="250">
                                                @error('name')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        <button type="submit" class="btn btn-primary">Create Group</button>
                                    </form>
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

@section('panel-script')
    <script>
        // document.getElementById('group-tab').classList.add('active');
        document.getElementById('lead-management-tab').classList.add('active');
    </script>
@endsection
