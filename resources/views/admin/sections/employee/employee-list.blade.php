@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Team Members</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.employee.list') }}">Team Members</a></li>
        </ul>
    </div>
@endsection


@section('panel-body')
    {{-- @dd($employee); --}}
    <figure class="panel-card">
        <div class="panel-card-header">
            <div>
                <h1 class="panel-card-title">All Team Members</h1>
                <p class="panel-card-description">All team members in the website </p>
            </div>
            <div>
                <a href="{{ route('admin.view.employee.create') }}" class="btn-primary-md">Add Team Member</a>
            </div>
        </div>
        <div class="panel-card-body">
            <div class="panel-card-table">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $employee->id }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->phone }}</td>
                                <td>{{ $employee->role }}</td>
                                <td>
                                    <label class="relative cursor-pointer">
                                        <input onchange="handleUpdateStatus({{ $employee->id }})"
                                            @checked($employee->status) type="checkbox" class="sr-only peer">
                                        <div
                                            class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2.5px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-admin-ascent">
                                        </div>
                                    </label>
                                </td>
                                <td>

                                    <div class="table-dropdown">
                                        <button>Options<i data-feather="chevron-down"
                                                class="ml-1 toggler-icon"></i></button>
                                        <div class="dropdown-menu">
                                            <ul>
                                                <li><a href="{{ route('admin.view.employee.update', ['id' => $employee->id]) }}"
                                                        class="dropdown-link-primary"><i data-feather="edit"
                                                            class="mr-1"></i> Edit Team Member</a></li>
                                                <li><a href="javascript:handleDelete({{ $employee->id }});"
                                                        class="dropdown-link-danger"><i data-feather="trash-2"
                                                            class="mr-1"></i> Delete Team Member</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </figure>
@endsection

@section('panel-script')
    <script>
        document.getElementById('employee-tab').classList.add('active');

        const handleUpdateStatus = (id) => {
            fetch("{{ route('admin.api.employee.status') }}", {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: id,
                    _token: "{{ csrf_token() }}"
                })
            }).then((response) => {
                return response.json();
            }).then((result) => {
                console.log(result);
            }).catch((error) => {
                console.error(error);
            });
        }
    </script>


    <script>
        const handleDelete = (id) => {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this employee!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = "{{ route('admin.handle.employee.delete', ':id') }}".replace(':id', id);
                    }
                });
        }
    </script>
@endsection
