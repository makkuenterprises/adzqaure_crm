@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Preview Group</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.group.list') }}">Groups</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.group.preview', ['id' => $group->id]) }}">Preview Group</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
        <figure class="panel-card">
            <div class="panel-card-header">
                <div>
                    <h1 class="panel-card-title">Preview Information</h1>
                    <p class="panel-card-description">Please check the information</p>
                </div>
            </div>
            <div class="panel-card-body border-b">
                <div class="grid md:grid-cols-4 sm:grid-cols-1 md:gap-7 sm:gap-5">

                    <div class="md:col-span-4 sm:col-span-1">
                        <h1 class="font-semibold ">General Information</h1>
                    </div>

                    {{-- Name --}}
                    <div class="flex flex-col">
                        <label for="name" class="input-label">Name</label>
                        <input type="text" name="name" value="{{ $group->name }}"
                            class="input-box-md @error('name') input-invalid @enderror" placeholder="Enter name" readonly
                            minlength="1" maxlength="250">
                        @error('name')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

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
                                <th>Address</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leads as $lead)
                                <tr>
                                    <td>{{ $lead->id }}</td>
                                    <td>{{ $lead->name }}</td>
                                    <td>{{ $lead->email }}</td>
                                    <td>{{ $lead->phone }}</td>
                                    <td>{{ $lead->address }}</td>
                                    <td>
                                        <label class="relative cursor-pointer">
                                            <input onchange="handleUpdateLeadStatus({{ $lead->id }})"
                                                @checked($lead->status) type="checkbox" class="sr-only peer">
                                            <div
                                                class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2.5px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-admin-ascent">
                                            </div>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="table-dropdown">
                                            <button type="button">Options<i data-feather="chevron-down"
                                                    class="ml-1 toggler-icon"></i></button>
                                            <div class="dropdown-menu">
                                                <ul>
                                                    <li><a href="tel: {{$lead->phone}}"
                                                            class="dropdown-link-primary"><i data-feather="phone"
                                                                class="mr-1"></i> Make a Call</a></li>
                                                    <li><a href="mailto: {{$lead->email}}"
                                                            class="dropdown-link-primary"><i data-feather="mail"
                                                                class="mr-1"></i> Send a Mail</a></li>
                                                    <li><a href="javascript:handleLeadDelete({{ $lead->id }});"
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
        // document.getElementById('group-tab').classList.add('active');
        document.getElementById('lead-management-tab').classList.add('active');

        const handleLeadDelete = (id) => {
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


        const handleUpdateLeadStatus = (id) => {
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
    </script>
@endsection
