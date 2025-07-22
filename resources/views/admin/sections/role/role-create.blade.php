@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Create New Role</h1>

    <form action="{{ route('admin.handle.role.create') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="name">Role Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Create Role</button>
        <a href="{{ route('admin.view.role.list') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
