@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Leads</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.group.list') }}">Data Groups</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.lead.list') }}">Data</a></li>
        </ul>
    </div>
@endsection


@section('panel-body')
    {{-- @dd($employee); --}}
    <figure class="panel-card">
        <div class="panel-card-header">
            <div>
                <h1 class="panel-card-title">All Data</h1>
                <p class="panel-card-description">All Data in the website </p>
            </div>
            <div>
                <a href="{{ route('admin.view.lead.create') }}" class="btn-primary-md">Create Lead</a>
                <a href="{{ route('admin.view.lead.import') }}" class="btn-primary-md">Import Leads</a>
            </div>
        </div>
        <div class="panel-card-body">
            <div class="panel-card-table">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Select</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Group</th>
                            <th>Employee</th>
                            <th>Campaign</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leads as $lead)
                            <tr>
                                <td>{{ $lead->id }}</td>
                                <td><input type="checkbox" name="lead_id[]" value="{{$lead->id}}"></td>
                                <td>{{ $lead->name }}</td>
                                <td>{{ $lead->email }}</td>
                                <td>{{ $lead->phone }}</td>
                                <td>{{ $lead->address }}</td>
                                <td>{{ DB::table('groups')->find($lead->group_id)?->name }}</td>
                                <td>{{ DB::table('employees')->find($lead->employee_id)?->name }}</td>
                                <td>{{ DB::table('campaigns')->find($lead->campaign_id)?->name }}</td>
                                <td>
                                    <label class="relative cursor-pointer">
                                        <input onchange="handleUpdateStatus({{ $lead->id }})"
                                            @checked($lead->status) type="checkbox" class="sr-only peer">
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
                                                <li><a href="tel: {{$lead->phone}}"
                                                        class="dropdown-link-primary"><i data-feather="phone"
                                                            class="mr-1"></i> Make a Call</a></li>
                                                <li><a href="mailto: {{$lead->email}}"
                                                        class="dropdown-link-primary"><i data-feather="mail"
                                                            class="mr-1"></i> Send a Mail</a></li>
                                                <li><a href="javascript:handleDelete({{ $lead->id }});"
                                                        class="dropdown-link-danger"><i data-feather="trash-2"
                                                            class="mr-1"></i> Delete Lead</a></li>
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
        document.getElementById('lead-tab').classList.add('active');
        document.getElementById('lead-management-tab').classList.add('active');

        const handleUpdateStatus = (id) => {
            fetch("{{ route('admin.api.lead.status') }}", {
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

        const handleDelete = (id) => {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this lead!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location =
                            `{{ url('admin/lead/delete') }}/${id}`;
                    }
                });
        }
    </script>
@endsection
