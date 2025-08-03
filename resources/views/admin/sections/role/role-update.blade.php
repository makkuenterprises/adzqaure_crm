@extends('admin.layouts.app')

@section('main-content')
<!--**********************************
    Content body start
***********************************-->
<div class="content-body default-height">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.view.role.list') }}">Manage Roles</a></li>
                <li class="breadcrumb-item active"><a href="#">Edit Role & Permissions</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Edit Role: <span class="text-primary">{{ $role->name }}</span></h4>
                        <a href="{{ route('admin.view.role.list') }}" class="btn btn-secondary btn-sm">Back to List</a>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ route('admin.handle.role.update', $role->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    {{-- Role Name Input --}}
                                    <div class="mb-4 col-md-12">
                                        <label for="name" class="form-label font-w600">Role Name</label>
                                        <input type="text" class="form-control solid @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $role->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <hr>

                                {{-- Permission Checkboxes Section --}}
                                <h4 class="mt-4 mb-3">Assign Permissions</h4>
                                <div class="row">
                                    @forelse($permissions as $permission)
                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input"
                                                       type="checkbox"
                                                       name="permissions[]"
                                                       value="{{ $permission->id }}"
                                                       id="perm_{{ $permission->id }}"
                                                       @if(in_array($permission->id, $rolePermissions)) checked @endif
                                                >
                                                <label class="form-check-label" for="perm_{{ $permission->id }}">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <p class="text-muted">No permissions found. It seems the seeder hasn't been run.</p>
                                        </div>
                                    @endforelse
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-success">Update Role & Permissions</button>
                                </div>
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
