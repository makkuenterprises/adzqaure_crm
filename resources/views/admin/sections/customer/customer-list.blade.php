@extends('admin.layouts.app')

@section('main-content')
    <!--**********************************
                                                            Content body start
                                                        ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Customers</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Manage Customers</a></li>
                </ol>
            </div>
            <div class="row">
                <div class="col-xl-3 col-xxl-4 col-lg-4 col-sm-4">
                    <div class="widget-stat card">
                        <div class="card-body p-4">
                            <div class="media ai-icon">
                                <span class="me-3 bgl-primary text-primary">
                                    <!-- <i class="ti-user"></i> -->
                                    <svg id="icon-customers" xmlns="http://www.w3.org/2000/svg" width="30"
                                        height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </span>
                                <div class="media-body">
                                    <p class="mb-1">Total Customers</p>
                                    <h4 class="mb-0">{{ $totalCustomers }}</h4>
                                    {{-- <span class="badge badge-primary">+3.5%</span> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-xxl-4 col-lg-4 col-sm-4">
                    <div class="widget-stat card">
                        <div class="card-body p-4">
                            <div class="media ai-icon">
                                <span class="me-3 bgl-primary text-primary">
                                    <!-- <i class="ti-user"></i> -->
                                    <svg id="icon-customers" xmlns="http://www.w3.org/2000/svg" width="30"
                                        height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </span>
                                <div class="media-body">
                                    <p class="mb-1">Active Customers</p>
                                    <h4 class="mb-0">{{ $activeCustomers }}</h4>
                                    {{-- <span class="badge badge-primary">+3.5%</span> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-xxl-4 col-lg-4 col-sm-4">
                    <div class="widget-stat card">
                        <div class="card-body p-4">
                            <div class="media ai-icon">
                                <span class="me-3 bgl-primary text-primary">
                                    <!-- <i class="ti-user"></i> -->
                                    <svg id="icon-customers" xmlns="http://www.w3.org/2000/svg" width="30"
                                        height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </span>
                                <div class="media-body">
                                    <p class="mb-1">Inactive Customers</p>
                                    <h4 class="mb-0">{{ $inactiveCustomers }}</h4>
                                    {{-- <span class="badge badge-primary">+3.5%</span> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="filter cm-content-box box-primary">
							<div class="content-title SlideToolHeader">
								<div class="cpa">
									<i class="fa-sharp fa-solid fa-filter me-2"></i>Filter
								</div>
								<div class="tools">
									<a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
								</div>
							</div>
							<div class="cm-content-body form excerpt">
								<div class="card-body">
									<div class="row">
										<div class="col-xl-3 col-sm-6">
											<label class="form-label">Search</label>
											<input type="text" class="form-control mb-xl-0 mb-3" id="exampleFormControlInput1" placeholder="Search...">
										</div>
										{{-- <div class="col-xl-3  col-sm-6 mb-3 mb-xl-0">
											<label class="form-label">Status</label>
											<select class="form-control default-select h-auto wide" aria-label="Default select example">
												<option selected>Select Status</option>
												<option value="1">Published</option>
												<option value="2">Draft</option>
												<option value="3">Trash</option>
												<option value="4">Private</option>
												<option value="5">Pending</option>
											</select>
										</div> --}}
										{{-- <div class="col-xl-3 col-sm-6">
											<label class="form-label">Date</label>
											<div class="input-hasicon mb-sm-0 mb-3">
												<input  name="datepicker" class="form-control bt-datepicker">
												<div class="icon"><i class="far fa-calendar"></i></div>
											</div>
										</div> --}}
										{{-- <div class="col-xl-3 col-sm-6 align-self-end">
											<div>
												<button class="btn btn-primary me-2" title="Click here to Search" type="button"><i class="fa fa-filter me-1"></i>Filter</button>
												<button class="btn btn-danger light" title="Click here to remove filter" type="button">Remove Filter</button>
											</div>
										</div> --}}
									</div>
								</div>
							</div>
						</div>
                    <div>
                        <a href="{{ route('admin.view.customer.create') }}" type="button"
                            class="btn btn-sm btn-primary mb-4 open btn-loader">Create New Customer</a>
                    </div>
                    <div class="filter cm-content-box box-primary">
                        <div class="content-title SlideToolHeader">
                            <div class="cpa">
                                <i class="fa-solid fa-file-lines me-1"></i>Customer List
                            </div>
                            <div class="tools">
                                <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                            </div>
                            <div class="d-flex justify-content-end mb-3 mt-3">
                                <a href="{{ route('global.export.excel', [
                                    'model' => 'App\Models\Customer',
                                    'fields' => 'id,name,email,phone,status,created_at',
                                    'from_date' => request('from_date'),
                                    'to_date' => request('to_date'),
                                ]) }}" class="btn btn-success btn-loader" target="_blank">
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
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Company</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($customers as $index => $customer)
                                            
                                                <tr>
                                                    <td>{{ $customers->firstItem() + $index }}</td>
                                                    <td><a
                                                            href="{{ route('admin.view.customer.preview', ['id' => $customer->id]) }}">{{ $customer->name }}</a>
                                                    </td>
                                                    <td>{{ $customer->email }}</td>
                                                    <td>{{ $customer->phone }}</td>
                                                    <td>{{ $customer->company_name }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            @if ($customer->status == 1)
                                                                <i class="fa fa-circle text-success me-1"></i> Enabled
                                                            @else
                                                                <i class="fa fa-circle text-danger me-1"></i> Disabled
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="text-nowrap">

                                                        <a href="{{ route('admin.view.customer.update', ['id' => $customer->id]) }}"
                                                            class="btn btn-warning btn-sm content-icon">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a href="{{ route('admin.view.password.list', ['customer_id' => $customer->id]) }}"
                                                            class="btn btn-success btn-sm content-icon">
                                                            <i class="fa fa-lock"></i>
                                                        </a>
                                                        <a href="{{ route('admin.view.customer.preview', ['id' => $customer->id]) }}"
                                                            class="btn btn-success btn-sm content-icon">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a href="javascript:handleDelete({{ $customer->id }});"
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
                                            Showing {{ $customers->firstItem() }} to {{ $customers->lastItem() }} of
                                            {{ $customers->total() }} records
                                        </p>
                                        <nav aria-label="Page navigation example mb-2">
                                            {{ $customers->links('pagination::bootstrap-4') }}
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
                    text: "Once deleted, you will not be able to recover this customer!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location =
                            `{{ url('admin/customer/delete') }}/${id}`;
                    }
                });
        }
    </script>
@endsection
