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
                                    <form action="{{ route('admin.handle.lead.create') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Full Name</label>
                                                <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') input-invalid @enderror" placeholder="Enter Name" minlength="1" maxlength="250">
                                                @error('name')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') input-invalid @enderror" placeholder="Enter Email" minlength="1" maxlength="250">
                                                @error('email')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Phone<span class="text-danger">*</span></label>
                                                <input type="tel" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') input-invalid @enderror" placeholder="Enter Password" minlength="10" maxlength="12"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                @error('phone')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Address</label>
                                                <input type="text" name="address" value="{{ old('address') }}" class="form-control @error('address') input-invalid @enderror" placeholder="Enter Address" minlength="1" maxlength="500">
                                                @error('address')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <label for="basic-form" class="form-label">Select Groups <span class="text-danger">*</span></label>
                                            <div class="basic-form">
                                                <select class="default-select form-control wide mb-3" name="group_id">
                                                    @if (!empty($groups))
                                                        <option selected>Select Group</option>
                                                        @foreach ($groups as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('group_id')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Create Lead</button>
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
        document.getElementById('create-lead-tab').classList.add('active');
        document.getElementById('lead-management-tab').classList.add('active');
    </script>
@endsection
