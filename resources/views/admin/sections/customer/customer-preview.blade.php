@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Preview Customer</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.customer.list') }}">Customers</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.customer.preview', ['id' => $customer->id]) }}">Preview Customer</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
        <figure class="panel-card">
            <div class="panel-card-header">
                <div>
                    <h1 class="panel-card-title">Preview Information</h1>
                    <p class="panel-card-description">View imformation</p>
                </div>
            </div>
            <div class="panel-card-body border-b">
                <div class="grid md:grid-cols-4 sm:grid-cols-1 md:gap-7 sm:gap-5">

                    <div class="md:col-span-4 sm:col-span-1">
                        <div class="flex md:flex-row sm:flex-col md:space-y-0 md:space-x-3 sm:space-x-0 sm:space-y-3">
                            <div>
                                <img src="{{ is_null($customer->profile) ? asset('admin/images/default-profile.png') : asset('storage/'.$customer->profile) }}" id="profile" alt="profile" class="h-[165px] w-[165px] rounded-md border bg-white" />
                            </div>
                            <div class="space-y-2">
                                <h1 class="font-semibold text-xl">{{$customer->name}}</h1>
                                <h1 class="text-xs font-medium text-slate-800">{{$customer->company_name}}</h1>
                                <h1 class="text-slate-700 text-sm flex items-center">
                                    <div>
                                        <i data-feather="mail" class="h-4 w-4 mr-2"></i> 
                                    </div>
                                    <a href="mailto: {{$customer->email}}">{{$customer->email}}</a>
                                </h1>
                                <h1 class="text-slate-700 text-sm flex items-center">
                                    <div>
                                        <i data-feather="phone" class="h-4 w-4 mr-2"></i> 
                                    </div>
                                    <a href="tel: {{$customer->phone}} ">{{$customer->phone}} </a>
                                    <a href="tel:  {{is_null($customer->phone_alternate) ? null : ', ' . $customer->phone_alternate}}"> {{is_null($customer->phone_alternate) ? null : ', ' . $customer->phone_alternate}}</a>
                                </h1>
                                @if (!is_null($customer->phone_alternate))
                                <h1 class="text-slate-700 text-sm flex items-center">
                                    <div>
                                        <i data-feather="phone" class="h-4 w-4 mr-2"></i> 
                                    </div>
                                    <a href="tel: {{$customer->phone_alternate}} ">{{$customer->phone_alternate}} </a>
                                </h1>
                                @endif
                                @if (!is_null($customer->whatsapp))
                                <h1 class="text-slate-700 text-sm flex items-center">
                                    <div>
                                        <i data-feather="message-circle" class="h-4 w-4 mr-2"></i>
                                    </div>
                                    <a target="_blank" href="https://wa.me/{{$customer->whatsapp}} ">{{$customer->whatsapp}} </a>
                                </h1>
                                @endif
                                @if (!is_null($customer->street) || !is_null($customer->city) || !is_null($customer->state) || !is_null($customer->country))
                                <h1 class="text-slate-700 text-sm flex items-center">
                                    <div>
                                        <i data-feather="map-pin" class="h-4 w-4 mr-2"></i>
                                    </div>
                                    {{is_null($customer->street) ? null : $customer->street}}
                                    {{is_null($customer->city) ? null : ', ' . $customer->city}}
                                    {{is_null($customer->pincode) ? null : ', ' . $customer->pincode}}
                                    {{is_null($customer->state) ? null : ', ' . $customer->state}}
                                    {{is_null($customer->country) ? null : ', ' . $customer->country}}
                                </h1>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="panel-card-header">
                <div>
                    <h1 class="panel-card-title">Projects</h1>
                    <p class="panel-card-description">Manage projects from {{$customer->name}}</p>
                </div>
                <div>
                    <a href="{{ route('admin.view.project.create') }}?customer_id={{$customer->id}}" class="btn-primary-md">Add Project</a>
                </div>
            </div>
            <div class="panel-card-body">
                <div class="panel-card-table">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                <tr>
                                    <td>{{ $project->id }}</td>
                                    <td>{{ $project->name }}</td>
                                    <td>{{env('APP_CURRENCY')}}{{ number_format($project->amount,0) }}</td>
                                    <td>{{ date('d-m-Y',strtotime($project->start_date)) }}</td>
                                    <td>{{ date('d-m-Y',strtotime($project->end_date)) }}</td>
                                    <td>
                                        <select name="status" onchange="handleUpdateStatus({{$project->id}},event)" class="input-box-sm cursor-pointer" required>
                                            <option @selected($project->status == "Pending") value="Pending">Pending</option>
                                            <option @selected($project->status == "Completed") value="Completed">Completed</option>
                                            <option @selected($project->status == "Ongoing") value="Ongoing">Ongoing</option>
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
        document.getElementById('customer-tab').classList.add('active');

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

        const handleUpdateStatus = (id,event) => {
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
@endsection
