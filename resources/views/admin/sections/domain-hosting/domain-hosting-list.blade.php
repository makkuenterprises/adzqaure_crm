@extends('admin.layouts.app')

@section('main-content')
    <!--**********************************
                                                                                                                                                                                            Content body start
                                                                                                                                                                                        ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.view.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.view.domain.hosting.list') }}">Domain &
                            Hosting</a></li>
                </ol>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div>
                        <a href="{{ route('admin.view.domain.hosting.create') }}" type="button"
                            class="btn btn-sm btn-primary mb-4 open">Add Domain & Hosting</a>
                    </div>
                    <div class="filter cm-content-box box-primary">
                        <div class="content-title SlideToolHeader">
                            <div class="cpa">
                                <i class="fa-solid fa-file-lines me-1"></i>All Domain Hostings
                            </div>
                            <div class="tools">
                                <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                            </div>
                        </div>
                        <div class="cm-content-body form excerpt">
                            <div class="card-body pb-4">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
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
                                            @foreach ($domain_hostings as $index => $domain_hosting)
                                                <tr>
                                                    <td>{{ $domain_hostings->firstItem() + $index }}</td>
                                                    <td>{{ DB::table('customers')->find($domain_hosting->customer_id)?->name }}
                                                    </td>
                                                    <td>{{ $domain_hosting->domain_name }}</td>
                                                    <td>
                                                        @if (!is_null($domain_hosting->domain_expiry))
                                                            @if (\Carbon\Carbon::now()->diffInDays($domain_hosting->domain_expiry, false) <= 10)
                                                                <span class="badge badge-rounded badge-danger">
                                                                    {{ date('d-m-Y', strtotime($domain_hosting->domain_expiry)) }}
                                                                </span>
                                                            @else
                                                                <span class="badge badge-rounded badge-success">
                                                                    {{ date('d-m-Y', strtotime($domain_hosting->domain_expiry)) }}
                                                                </span>
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (!is_null($domain_hosting->hosting_expiry))
                                                            {{ env('APP_CURRENCY') }}{{ number_format($domain_hosting->domain_renewal_price, 2) }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            @if (!is_null($domain_hosting->hosting_expiry))
                                                                @if (\Carbon\Carbon::now()->diffInDays($domain_hosting->hosting_expiry, false) <= 10)
                                                                    <span class="badge badge-rounded badge-success">
                                                                        {{ date('d-m-Y', strtotime($domain_hosting->hosting_expiry)) }}
                                                                    </span>
                                                                @else
                                                                    <span class="badge badge-rounded badge-danger">
                                                                        {{ date('d-m-Y', strtotime($domain_hosting->hosting_expiry)) }}
                                                                    </span>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if (!is_null($domain_hosting->hosting_expiry))
                                                            {{ env('APP_CURRENCY') }}{{ number_format($domain_hosting->hosting_renewal_price, 2) }}
                                                        @endif
                                                    </td>
                                                    <td class="text-nowrap">

                                                        <a href="{{ route('admin.view.domain.hosting.update', ['id' => $domain_hosting->id]) }}"
                                                            class="btn btn-warning btn-sm content-icon">
                                                            <i class="fa fa-edit"></i>
                                                        </a>

                                                        <a href="{{ route('admin.handle.domain.hosting.bill.create', ['id' => $domain_hosting->id]) }}"
                                                            class="btn btn-success btn-sm content-icon">
                                                            <i class="fa fa-download"></i>
                                                        </a>

                                                        <a href="javascript:handleDelete({{ $domain_hosting->id }});"
                                                            class="btn btn-danger btn-sm content-icon">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                                        <p class="mb-2 me-3">
                                            Showing {{ $domain_hostings->firstItem() }} to
                                            {{ $domain_hostings->lastItem() }} of
                                            {{ $domain_hostings->total() }} records
                                        </p>
                                        <nav aria-label="Page navigation example mb-2">
                                            {{ $domain_hostings->links('pagination::bootstrap-4') }}
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
    <!--**********************************
                                                                                                                                                                                            Content body end
                                                                                                                                                                                        ***********************************-->
@endsection

@section('js')
    <script>
        function handleDelete(id) {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this admin!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = `{{ url('admin/admin-access/delete') }}/${id}`;
                    }
                });
        }
    </script>
@endsection
