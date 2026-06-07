@extends('admin.layouts.app')

@section('main-content')
    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <!-- Breadcrumbs -->
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Customers</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Manage Customers</a></li>
                </ol>
            </div>

            <!-- Stats Widgets -->
            <div class="row">
                <div class="col-xl-3 col-xxl-4 col-lg-4 col-sm-4">
                    <div class="widget-stat card">
                        <div class="card-body p-4">
                            <div class="media ai-icon">
                                <span class="me-3 bgl-primary text-primary">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
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
									</div>
								</div>
							</div>
						</div>
                    <div>
                        <a href="{{ route('admin.view.customer.create') }}" type="button"
                            class="btn btn-sm btn-primary mb-4 open btn-loader">Create New Customer</a>
                    </div>

                    <!-- Customer List Card -->
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
                                <div class="table-responsive font-sans">
                                    <table class="table align-middle">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Customer Name</th>
                                                <th>Company</th>
                                                <th>Contact Details</th>
                                                <th>Onboarding Date</th>
                                                <th>Interested Services</th>
                                                <th>Status</th>
                                                <th class="text-end">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($customers as $index => $customer)
                                                <tr>
                                                    <td>{{ $customers->firstItem() + $index }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.view.customer.preview', ['id' => $customer->id]) }}" class="font-w600 text-primary">
                                                            {{ $customer->name }}
                                                        </a>
                                                    </td>
                                                    <td><strong>{{ $customer->company_name }}</strong></td>
                                                    <td>
                                                        <div>{{ $customer->email }}</div>
                                                        <small class="text-muted font-mono">{{ $customer->phone }}</small>
                                                    </td>
                                                    <td>
                                                        @if(!is_null($customer->onboarding_date))
                                                            <span class="font-mono">{{ \Carbon\Carbon::parse($customer->onboarding_date)->format('d M, Y') }}</span>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    <td style="max-width: 200px; white-space: normal;">
                                                        @if (!empty($customer->interested_services))
                                                            @php $services = json_decode($customer->interested_services) ?? []; @endphp
                                                            @foreach ($services as $service)
                                                                <span class="badge badge-xs light badge-primary mb-1">{{ $service }}</span>
                                                            @endforeach
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            @if ($customer->status == 1)
                                                                <i class="fa fa-circle text-success me-1"></i> Enabled
                                                            @else
                                                                <i class="fa fa-circle text-danger me-1"></i> Disabled
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="text-end text-nowrap">
                                                        <a href="{{ route('admin.view.customer.update', ['id' => $customer->id]) }}"
                                                            class="btn btn-warning btn-sm content-icon">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <!-- Reset Password trigger button -->
                                                        <button type="button" class="btn btn-info btn-sm content-icon" data-bs-toggle="modal" data-bs-target="#resetCustomerPasswordModal{{ $customer->id }}">
                                                            <i class="fa fa-key"></i>
                                                        </button>
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

                                                <!-- Reset Password Modal -->
                                                <div class="modal fade" id="resetCustomerPasswordModal{{ $customer->id }}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Reset Password: {{ $customer->name }}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <form action="{{ route('admin.customer.reset-password', ['id' => $customer->id]) }}" method="POST">
                                                                @csrf
                                                                <div class="modal-body text-start">
                                                                    <div class="mb-3">
                                                                        <label class="form-label font-w500">New Password <span class="text-danger">*</span></label>
                                                                        <input type="password" name="password" class="form-control" placeholder="Enter New Password" required minlength="6">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label font-w500">Confirm Password <span class="text-danger">*</span></label>
                                                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm New Password" required minlength="6">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger btn-xs light" data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-primary btn-xs">Reset Password</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <!-- Pagination -->
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
