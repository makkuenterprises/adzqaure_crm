@extends('employee.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Preview Campaign</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('employee.view.dashboard') }}">Team Member</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('employee.view.campaign.list') }}">Campaign</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('employee.view.campaign.preview',['id' => $campaign->id]) }}">Preview Campaign</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
        <figure class="panel-card">
            <div class="panel-card-header">
                <div>
                    <h1 class="panel-card-title">Update Information</h1>
                    <p class="panel-card-description">Please fill the required fields</p>
                </div>
            </div>
            <div class="panel-card-body border-b">
                <div class="grid md:grid-cols-4 sm:grid-cols-1 md:gap-7 sm:gap-5">

                    {{-- Name --}}
                    <div class="flex flex-col">
                        <label for="name" class="input-label">Campaign Name</label>
                        <input type="text" name="name" value="{{ old('name', $campaign->name) }}"
                            class="input-box-md @error('name') input-invalid @enderror" readonly >
                        @error('name')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Leads Count --}}
                    <div class="flex flex-col">
                        <label for="lead_count" class="input-label">Leads Count</label>
                        <input type="text" name="lead_count" value="{{DB::table('leads')->where('campaign_id',$campaign->id)->count() . " Leads"}}"
                            class="input-box-md @error('lead_count') input-invalid @enderror" readonly>
                        @error('lead_count')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Leads Count --}}
                    <div class="flex flex-col">
                        <label for="created_at" class="input-label">Created on</label>
                        <input type="text" name="created_at" value="{{date('D d M Y',strtotime($campaign->created_at)) }}"
                            class="input-box-md @error('created_at') input-invalid @enderror" readonly>
                        @error('created_at')
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
                                <th>Group</th>
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
                                    <td>{{ DB::table('groups')->find($lead->group_id)?->name }}</td>
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
            <div class="panel-card-footer">
                <button type="submit" class="btn-primary-md md:w-fit sm:w-full">Save Changes</button>
            </div>
        </figure>
@endsection

@section('panel-script')
    <script>
        document.getElementById('campaign-tab').classList.add('active');

        const handleUpdateLeadStatus = (id) => {
            fetch("{{route('employee.api.lead.status')}}", {
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
