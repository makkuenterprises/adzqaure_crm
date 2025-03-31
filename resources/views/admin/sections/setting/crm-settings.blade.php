@extends('admin.layouts.app')


@section('main-content')
    <!--**********************************
                    Content body start
                ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.view.setting') }}">Settings</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.view.crm.setting') }}">CRM Settings</a></li>
                </ol>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Update Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ route('admin.handle.crm.settings.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-4 mb-3">
                                            <label for="formFile" class="form-label">CRM Round Logo</label>
                                            <input type="file"
                                                class="form-control @error('round_logo') input-invalid @enderror"
                                                accept="image/jpeg, image/jpg, image/png" name="round_logo"
                                                onchange="handleProfilePreview(event)">
                                            @error('round_logo')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-xl-4 mb-3">
                                            <label for="formFile" class="form-label">CRM Text Logo</label>
                                            <input type="file"
                                                class="form-control @error('text_logo') input-invalid @enderror"
                                                accept="image/jpeg, image/jpg, image/png" name="text_logo"
                                                onchange="handleProfilePreview(event)">
                                            @error('text_logo')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-xl-4 mb-3">
                                            <label for="formFile" class="form-label">Fevicon</label>
                                            <input type="file"
                                                class="form-control @error('fevicon') input-invalid @enderror"
                                                accept="image/jpeg, image/jpg, image/png" name="fevicon"
                                                onchange="handleProfilePreview(event)">
                                            @error('fevicon')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="crm_name" class="form-label">CRM Name<span class="text-danger">*</span></label>
                                            <input type="text" name="crm_name"
                                                value="{{ old('crm_name') }}"
                                                class="form-control @error('crm_name') input-invalid @enderror"
                                                placeholder="Enter CRM Name" minlength="1" maxlength="250">
                                            @error('crm_name')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
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
