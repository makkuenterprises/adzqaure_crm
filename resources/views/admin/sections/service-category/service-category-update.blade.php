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
                    <li class="breadcrumb-item active">Update Service Category</li>
                </ol>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Update Service Category</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ route('admin.handle.service-category.update', $serviceCategory->id) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST') <!-- Since your route uses POST for update -->

                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Service Category Name<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="name"
                                                value="{{ old('name', $serviceCategory->name) }}"
                                                class="form-control @error('name') input-invalid @enderror"
                                                placeholder="Enter service category name" minlength="1" maxlength="250">
                                            @error('name')
                                                <span class="input-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update Service Category</button>
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
