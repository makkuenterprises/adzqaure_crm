@extends('employee.layouts.app')


@section('main-content')
      <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body default-height">
            <div class="container-fluid">
				<div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('admin.view.lead.manager.list') }}">Leads Manager</a></li>
						<li class="breadcrumb-item active"><a href="{{ route('admin.view.lead.manager.update' , ['id' => $leads_manager->id]) }}">Update Lead</a></li>
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
                                    <form action="{{ route('admin.handle.lead.manager.update', ['id' => $leads_manager->id])  }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Full Name</label>
                                                <input type="text" name="name" value="{{ $leads_manager->name }}" class="form-control @error('name') input-invalid @enderror" placeholder="Enter Name" minlength="1" maxlength="250">
                                                @error('name')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" value="{{ $leads_manager->email }}" class="form-control @error('email') input-invalid @enderror" placeholder="Enter Email" minlength="1" maxlength="250">
                                                @error('email')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Phone<span class="text-danger">*</span></label>
                                                <input type="tel" name="phone" value="{{ $leads_manager->phone }}" class="form-control @error('phone') input-invalid @enderror" placeholder="Enter Phone" minlength="10" maxlength="12"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                @error('phone')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Address</label>
                                                <input type="text" name="address" value="{{ $leads_manager->address }}" class="form-control @error('address') input-invalid @enderror" placeholder="Enter Address" minlength="1" maxlength="500">
                                                @error('address')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Remarks</label>
                                                <input type="text" name="remarks" value="{{ $leads_manager->remarks }}" class="form-control @error('remarks') input-invalid @enderror" placeholder="Enter Remarks" minlength="1" maxlength="500">
                                                @error('remarks')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <label for="status-select" class="form-label">Select Status <span class="text-danger">*</span></label>
                                            <div class="basic-form">
                                                <select class="default-select form-control wide mb-3" name="status" id="status-select">
                                                    <option value="" selected>Select Status</option>
                                                    @foreach ($status as $status_value)
                                                        <option value="{{ $status_value }}" {{ old('status') == $status_value ? 'selected' : '' }}>
                                                            {{ $status_value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('status')
                                                    <span class="input-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Lead</button>
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
