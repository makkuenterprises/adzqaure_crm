@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Domain Hosting</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.domain.hosting.list') }}">Domain Hosting</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <figure class="panel-card">
        <div class="panel-card-header">
            <div>
                <h1 class="panel-card-title">All Domain Hostings</h1>
                <p class="panel-card-description">All domain hostings in the website </p>
            </div>
            <div>
                <a href="{{ route('admin.view.domain.hosting.create') }}" class="btn-primary-md">Add Domain Hosting</a>
            </div>
        </div>
        <div class="panel-card-body">
            <div class="panel-card-table">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer Name</th>
                            <th>Domain</th>
                            <th>Domain Expiry</th>
                            <th>Domain Renewal</th>
                            <th>Hosting Expiry</th>
                            <th>Hosting Renewal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($domain_hostings as $domain_hosting)
                            <tr>
                                <td>{{ $domain_hosting->id }}</td>
                                <td>{{ DB::table('customers')->find($domain_hosting->customer_id)?->name }}</td>
                                <td>{{ $domain_hosting->domain_name }}</td>
                                <td>
                                    @if (!is_null($domain_hosting->domain_expiry))
                                        @if (\Carbon\Carbon::now()->diffInDays($domain_hosting->domain_expiry, false) <= 10)
                                            <p class="alert-danger-sm">
                                                {{ date('d-m-Y', strtotime($domain_hosting->domain_expiry)) }} </p>
                                        @else
                                            <p class="alert-success-sm">
                                                {{ date('d-m-Y', strtotime($domain_hosting->domain_expiry)) }} </p>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if (!is_null($domain_hosting->hosting_expiry))
                                        {{ env('APP_CURRENCY') }}{{ number_format($domain_hosting->domain_renewal_price, 2) }}
                                    @endif
                                </td>
                                <td>
                                    @if (!is_null($domain_hosting->hosting_expiry))
                                        @if (\Carbon\Carbon::now()->diffInDays($domain_hosting->hosting_expiry, false) <= 10)
                                            <p class="alert-danger-sm">
                                                {{ date('d-m-Y', strtotime($domain_hosting->hosting_expiry)) }} </p>
                                        @else
                                            <p class="alert-success-sm">
                                                {{ date('d-m-Y', strtotime($domain_hosting->hosting_expiry)) }} </p>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if (!is_null($domain_hosting->hosting_expiry))
                                        {{ env('APP_CURRENCY') }}{{ number_format($domain_hosting->hosting_renewal_price, 2) }}
                                    @endif
                                </td>
                                <td>
                                    <div class="table-dropdown">
                                        <button>Options<i data-feather="chevron-down"
                                                class="ml-1 toggler-icon"></i></button>
                                        <div class="dropdown-menu">
                                            <ul>
                                                <li><a href="{{ route('admin.view.domain.hosting.update', ['id' => $domain_hosting->id]) }}"
                                                        class="dropdown-link-primary"><i data-feather="edit"
                                                            class="mr-1"></i> Edit Domain Hosting</a></li>
                                                <li><a href="{{ route('admin.handle.domain.hosting.bill.create', ['id' => $domain_hosting->id]) }}"
                                                        class="dropdown-link-primary"><i data-feather="clipboard"
                                                            class="mr-1"></i> Generate Bill</a></li>
                                                <li><a href="javascript:handleDelete({{ $domain_hosting->id }});"
                                                        class="dropdown-link-danger"><i data-feather="trash-2"
                                                            class="mr-1"></i> Delete Domain Hosting</a></li>
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
        document.getElementById('domain-hosting-tab').classList.add('active');
    </script>

    <script>
        const handleDelete = (id) => {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this domain hosting!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location =
                            `{{ url('admin/domain-hosting/delete') }}/${id}`;
                    }
                });
        }
    </script>
@endsection
