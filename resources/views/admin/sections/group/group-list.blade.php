@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Groups</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.group.list') }}">Groups</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <figure class="panel-card">
        <div class="panel-card-header">
            <div>
                <h1 class="panel-card-title">All Groups</h1>
                <p class="panel-card-description">All groups in the website </p>
            </div>
            <div>
                <a href="{{ route('admin.view.group.create') }}" class="btn-primary-md">Add Group</a>
            </div>

        </div>
        <div class="panel-card-body">
            <div class="panel-card-table">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Records</th>
                            {{-- <th>Status</th> --}}
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($groups as $group)
                            <tr>
                                <td>{{ $group->id }}</td>
                                <td><a
                                        href="{{ route('admin.view.group.preview', ['id' => $group->id]) }}">{{ $group->name }}</a>
                                </td>
                                <td>{{ DB::table('leads')->where('group_id', $group->id)->count() }}</td>
                                {{-- <td>
                                    <label class="relative cursor-pointer">
                                        <input onchange="handleUpdateStatus({{ $group->id }})"
                                            @checked($group->status) type="checkbox" class="sr-only peer">
                                        <div
                                            class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2.5px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-admin-ascent">
                                        </div>
                                    </label>
                                </td> --}}
                                <td>
                                    <div class="table-dropdown">
                                        <button>Options<i data-feather="chevron-down"
                                                class="ml-1 toggler-icon"></i></button>
                                        <div class="dropdown-menu">
                                            <ul>
                                                <li><a href="{{ route('admin.view.group.update', ['id' => $group->id]) }}"
                                                        class="dropdown-link-primary"><i data-feather="edit"
                                                            class="mr-1"></i> Edit Group</a></li>
                                                <li><a href="{{ route('admin.view.group.preview', ['id' => $group->id]) }}"
                                                        class="dropdown-link-primary"><i data-feather="external-link"
                                                            class="mr-1"></i> Preview Group</a></li>
                                                <li><a href="{{ route('admin.view.group.export', ['id' => $group->id]) }}"
                                                        class="dropdown-link-primary"><i data-feather="download"
                                                            class="mr-1"></i> Export Group</a></li>


                                                <li><a href="javascript:handleDelete({{ $group->id }});"
                                                        class="dropdown-link-danger"><i data-feather="trash-2"
                                                            class="mr-1"></i> Delete Group</a></li>

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
        // document.getElementById('group-tab').classList.add('active');
        document.getElementById('lead-management-tab').classList.add('active');

        const handleUpdateStatus = (id) => {
            fetch("{{ route('admin.api.group.status') }}", {
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
                    text: "Once deleted, you will not be able to recover this group!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        // Correct the URL generation using Blade syntax
                        window.location = `{{ url('admin/group/delete') }}/${id}`;
                    }
                });
        };
    </script>
@endsection
