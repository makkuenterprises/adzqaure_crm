@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Campaigns</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.campaign.list') }}">Campaign</a></li>
        </ul>
    </div>
@endsection


@section('panel-body')
    <figure class="panel-card">
        <div class="panel-card-header">
            <div>
                <h1 class="panel-card-title">All Campaign</h1>
                <p class="panel-card-description">All campaign in the website </p>
            </div>
            <div>
                <a href="{{ route('admin.view.campaign.create') }}" class="btn-primary-md">Add Campaign</a>
            </div>
        </div>
        <div class="panel-card-body">
            <div class="panel-card-table">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Lead Count</th>
                            <th>Created on</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($campaigns as $campaign)
                            <tr>
                                <td>{{ $campaign->id }}</td>
                                <td><a
                                        href="{{ route('admin.view.campaign.preview', ['id' => $campaign->id]) }}">{{ $campaign->name }}</a>
                                </td>
                                <td>{{ DB::table('leads')->where('campaign_id', $campaign->id)->count() }}</td>
                                <td>{{ date('D d M Y', strtotime($campaign->created_at)) }}</td>
                                <td>
                                    <label class="relative cursor-pointer">
                                        <input onchange="handleUpdateStatus({{ $campaign->id }})"
                                            @checked($campaign->status) type="checkbox" class="sr-only peer">
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
                                                <li><a href="{{ route('admin.view.campaign.preview', ['id' => $campaign->id]) }}"
                                                        class="dropdown-link-primary"><i data-feather="external-link"
                                                            class="mr-1"></i> Preview Campaign</a></li>
                                                <li><a href="{{ route('admin.view.campaign.update', ['id' => $campaign->id]) }}"
                                                        class="dropdown-link-primary"><i data-feather="edit"
                                                            class="mr-1"></i> Edit Campaign</a></li>
                                                <li><a href="javascript:handleDelete({{ $campaign->id }});"
                                                        class="dropdown-link-danger"><i data-feather="trash-2"
                                                            class="mr-1"></i> Delete Campaign</a></li>
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
        document.getElementById('campaign-tab').classList.add('active');
        document.getElementById('lead-management-tab').classList.add('active');

        const handleUpdateStatus = (id) => {
            fetch("{{ route('admin.api.campaign.status') }}", {
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
                    text: "Once deleted, you will not be able to recover this campaign!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location =
                            `{{ url('admin/campaign/delete') }}/${id}`;
                    }
                });
        }
    </script>
@endsection
