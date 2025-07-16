@extends('admin.layouts.app')

@section('main-content')
    <!--**********************************
                                              Content body start
                                         ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.view.service.list') }}">Service</a>
                    </li>
                </ol>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div>
                        <a href="{{ route('admin.view.service.create') }}" type="button"
                            class="btn btn-sm btn-primary mb-4 open">Create Service</a>
                    </div>
                    <div class="filter cm-content-box box-primary">
                        <div class="content-title SlideToolHeader">
                            <div class="cpa">
                                <i class="fa-solid fa-file-lines me-1"></i>All Service
                            </div>
                            <div class="tools">
                                <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                            </div>
                            <div class="d-flex justify-content-end mb-3 mt-3">
                                <a href="{{ route('global.export.excel', [
                                    'model' => 'App\Models\Service',
                                    'fields' => 'id,name,email,phone,status,created_at',
                                    'from_date' => request('from_date'),
                                    'to_date' => request('to_date'),
                                ]) }}" class="btn btn-success" target="_blank">
                                    <i class="fa fa-file-excel me-1"></i> Export to Excel
                                </a>
                            </div>
                        </div>
                        <div class="cm-content-body form excerpt">
                            <div class="card-body pb-4">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Service Name</th>
                                                <th>Category</th>
                                                <th>Price (INR)</th>
                                                <th>Govt. Fee</th>
                                                <th>Subscription</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($services as $index => $service)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $service->service_name }}</td>
                                                    <td>{{ $service->category->name ?? '-' }}</td>
                                                    <td>₹{{ number_format($service->service_price_in_inr, 2) }}</td>
                                                    <td>
                                                        @if ($service->govt_fee)
                                                            ₹{{ number_format($service->govt_fee, 2) }}
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @switch($service->subscription_duration)
                                                            @case(0)
                                                                One-Time
                                                            @break

                                                            @case(30)
                                                                30 Days
                                                            @break

                                                            @case(90)
                                                                90 Days
                                                            @break

                                                            @case(180)
                                                                180 Days
                                                            @break

                                                            @case(365)
                                                                365 Days
                                                            @break

                                                            @default
                                                                N/A
                                                        @endswitch
                                                    </td>
                                                    <td>{{ $service->created_at->format('d M Y') }}</td>
                                                    <td class="text-nowrap">
                                                        <a href="{{ route('admin.view.service.update', ['id' => $service->id]) }}"
                                                            class="btn btn-warning btn-sm content-icon">
                                                            <i class="fa fa-edit"></i>
                                                        </a>


                                                        <a href="javascript:handleDelete({{ $service->id }});"
                                                            class="btn btn-danger btn-sm content-icon">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <!-- Pagination Information -->
                                    {{-- <div class="d-flex align-items-center justify-content-between flex-wrap">
                                        <p class="mb-2 me-3">
                                            Showing {{ $service_cat->firstItem() }} to {{ $service_cat->lastItem() }} of
                                            {{ $service_cat->total() }} records
                                        </p>
                                        <nav aria-label="Page navigation example mb-2">
                                            {{ $service_cat->links('pagination::bootstrap-4') }}
                                        </nav>
                                    </div> --}}
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
                    text: "Once deleted, you will not be able to recover this service category!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = `{{ url('admin/service/delete') }}/${id}`;
                    }
                });
        }
    </script>
@endsection
