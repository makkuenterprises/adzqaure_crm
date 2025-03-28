@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Projects</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.project.list') }}">Projects</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <figure class="panel-card">
        <div class="panel-card-header">
            <div>
                <h1 class="panel-card-title">All Projects</h1>
                <p class="panel-card-description">List of all projects in webiste</p>
            </div>
            <div>
                <a href="{{ route('admin.view.project.create') }}" class="btn-primary-md">Add Project</a>
            </div>
        </div>
        <div class="panel-card-body">
            <div class="panel-card-table">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            {{-- <th>Customer Name</th> --}}
                            <th>Amount</th>
                            <th>Start Date</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr>
                                <td>{{ $project->id }}</td>
                                <td><a
                                        href="{{ route('admin.view.project.preview', ['id' => $project->id]) }}">{{ $project->name }}</a>
                                </td>
                                {{-- <td>{{ DB::table('customers')->find($project->customer_id)?->name }}</td> --}}
                                <td>{{ env('APP_CURRENCY') }}{{ number_format($project->amount, 0) }}</td>
                                <td>{{ date('d-m-Y', strtotime($project->start_date)) }}</td>
                                <td>{{ date('d-m-Y', strtotime($project->end_date)) }}</td>
                                <td>
                                    <select name="status" onchange="handleUpdateStatus({{ $project->id }},event)"
                                        class="input-box-sm cursor-pointer" required>
                                        <option @selected($project->status == 'Pending') value="Pending">Pending</option>
                                        <option @selected($project->status == 'Completed') value="Completed">Completed</option>
                                        <option @selected($project->status == 'Ongoing') value="Ongoing">Ongoing</option>
                                    </select>
                                </td>
                                <td>

                                    <div class="table-dropdown">
                                        <button>Options<i data-feather="chevron-down"
                                                class="ml-1 toggler-icon"></i></button>
                                        <div class="dropdown-menu">
                                            <ul>
                                                <li><a href="{{ route('admin.view.project.preview', ['id' => $project->id]) }}"
                                                        class="dropdown-link-primary"><i data-feather="external-link"
                                                            class="mr-1"></i> Manage Payments</a></li>
                                                <li><a href="{{ route('admin.view.project.update', ['id' => $project->id]) }}"
                                                        class="dropdown-link-primary"><i data-feather="edit"
                                                            class="mr-1"></i> Edit Projects</a></li>
                                                <li><a href="javascript:handleDelete({{ $project->id }});"
                                                        class="dropdown-link-danger"><i data-feather="trash-2"
                                                            class="mr-1"></i> Delete Projects</a></li>
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
        document.getElementById('project-tab').classList.add('active');
        const handleUpdateStatus = (id, event) => {
            fetch("{{ route('admin.api.project.status') }}", {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: id,
                    status: event.target.value,
                    _token: "{{ csrf_token() }}"
                })
            }).then((response) => {
                return response.json();
            }).then((result) => {
                swal({
                    title: "Status Updated",
                    text: "The status for this project is updated",
                    icon: "success",
                })
            }).catch((error) => {
                console.error(error);
            });
        }
    </script>

    <script>
        const handleDelete = (id) => {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this project!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location =
                            `{{ url('admin/customer/project/delete') }}/${id}`;
                    }
                });
        }
    </script>
@endsection
