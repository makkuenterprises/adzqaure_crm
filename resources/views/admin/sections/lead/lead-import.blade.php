@extends('admin.layouts.app')

@section('css')
    <style>
        /* Style for the required field marker */
        .input-label span.text-red-500 {
            color: red;
            font-weight: bold;
        }

        .input-invalid {
            border-color: red;
        }

        /* Style for error messages */
        .input-error {
            color: red;
            font-size: 0.875rem;
            margin-top: 5px;
        }
    </style>
@endsection


@section('main-content')
    <!--**********************************
                                                                            Content body start
                                                                    ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Data Records</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Import Data</a></li>
                </ol>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div>
                        {{-- <button type="button" class="btn btn-sm btn-primary mb-4 open">Download Sample File</button> --}}
                        <a href="{{ asset('admin/documents/lead-import-samle.xlsx') }}"
                            download="{{ asset('admin/documents/lead-import-samle.xlsx') }}"
                            class="btn btn-sm btn-primary mb-4 open">
                            Download Sample File
                        </a>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Information</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.handle.lead.import') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Leads file <span
                                                class="text-red-500">*</span></label>
                                        <input type="file"
                                            class="form-control @error('lead_file') input-invalid @enderror"
                                            name="lead_file" id="formFile" value="{{ old('lead_file') }}" required>
                                        @error('lead_file')
                                            <span class="input-error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <label for="basic-form" class="form-label">Select Groups</label>
                                    <div class="basic-form">
                                        <select class="default-select form-control wide mb-3" name="group_id">
                                            @if (!empty($groups))
                                                <option selected>Select Group</option>
                                                @foreach ($groups as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary mb-4 open">Import Data</button>
                                </form>
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
