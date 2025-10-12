@extends('admin.layouts.app')

@section('main-content')
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.view.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.view.employee.list') }}">Team Members</a></li>
                </ol>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div>
                        <a href="{{ route('admin.view.employee.create') }}" class="btn btn-sm btn-primary mb-4 open btn-loader">Create New Employee</a>
                    </div>
                    <div class="filter cm-content-box box-primary">
                        <div class="content-title SlideToolHeader d-flex flex-wrap justify-content-between align-items-center">
                            <div class="cpa">
                                <i class="fa-solid fa-users me-1"></i> Employees List
                            </div>
                            <div class="tools">
                                <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                            </div>
                        </div>
                        <div class="cm-content-body form excerpt">
                            <div class="card-body pb-4">

                                <!-- ================== SEARCH FORM START ================== -->
                                <div class="row mb-3">
                                    <div class="col-md-8">
                                        {{-- The form submits to the current route using the GET method --}}
                                        <form action="{{ route('admin.view.employee.list') }}" method="GET" class="d-flex">
                                            <input type="text" name="search" class="form-control" placeholder="Search by EMP ID, Name, or Email..." value="{{ request('search') }}">
                                            <button type="submit" class="btn btn-primary ms-2">Search</button>
                                            <a href="{{ route('admin.view.employee.list') }}" class="btn btn-secondary ms-2">Reset</a>
                                        </form>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        {{-- Note: The export link won't work with search unless the backend logic is updated --}}
                                        <a href="{{ route('global.export.excel', [ /* ... params ... */ ]) }}" class="btn btn-success btn-loader">
                                            <i class="fa fa-file-excel me-1"></i> Export to Excel
                                        </a>
                                    </div>
                                </div>
                                <!-- ================== SEARCH FORM END ================== -->

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Emp Id</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Role</th>
                                                <th>Designation</th>
                                                <th>Date of Joining</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($employees as $index => $employee)
                                                <tr>
                                                    <td>{{ $employees->firstItem() + $index }}</td>
                                                    <td>{{ $employee->employee_id }}</td>
                                                    <td>{{ $employee->name }}</td>
                                                    <td>{{ $employee->email }}</td>
                                                    <td>{{ $employee->phone }}</td>
                                                    <td>{{ $employee->role }}</td>
                                                    <td>{{ $employee->designation }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($employee->date_of_joining)->format('d M, Y') }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            @if ($employee->status == 1)
                                                                <i class="fa fa-circle text-success me-1"></i> Enabled
                                                            @else
                                                                <i class="fa fa-circle text-danger me-1"></i> Disabled
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="text-nowrap">
                                                        <a href="{{ route('admin.view.employee.update', ['id' => $employee->id]) }}" class="btn btn-warning btn-sm content-icon" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>

                                                        {{-- IMPROVED: Delete action now uses a form --}}
                                                        <form action="{{ route('admin.handle.employee.delete', ['id' => $employee->id]) }}" method="POST" class="d-inline" id="delete-form-{{ $employee->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" onclick="handleDelete({{ $employee->id }})" class="btn btn-danger btn-sm" title="Delete">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="10" class="text-center">No employees found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                                        <p class="mb-2 me-3">
                                            Showing {{ $employees->firstItem() }} to {{ $employees->lastItem() }} of {{ $employees->total() }} records
                                        </p>
                                        <nav aria-label="Page navigation example mb-2">
                                            {{-- IMPROVEMENT: Appending search query to pagination links --}}
                                            {{ $employees->appends(request()->query())->links('pagination::bootstrap-4') }}
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
@endsection

@section('js')
{{-- Using modern SweetAlert2 --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // IMPROVED: Using modern Swal syntax and submitting a form
    function handleDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This employee record will be permanently deleted.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the specific form for this employee
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection