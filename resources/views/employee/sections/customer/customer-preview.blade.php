@extends('employee.layouts.app')


@section('main-content')
    <!--**********************************
                                                                                                        Content body start
                                                                                                    ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('employee.view.customer.list') }}">Customers</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('employee.view.customer.preview', ['id' => $customer->id]) }}">Preview Customer</a></li>
                </ol>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card contact-bx item-content">
                                <div class="card-header border-0">
                                    <div class="action-dropdown">
                                        <div class="dropdown ">
                                            <div class="btn-link" data-bs-toggle="dropdown">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="12.4999" cy="3.5" r="2.5" fill="#A5A5A5"/>
                                                    <circle cx="12.4999" cy="11.5" r="2.5" fill="#A5A5A5"/>
                                                    <circle cx="12.4999" cy="19.5" r="2.5" fill="#A5A5A5"/>
                                                </svg>
                                            </div>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="javascript:handleDelete({{ $customer->id }});">Delete</a>
                                                <a class="dropdown-item" href="{{ route('employee.view.customer.update', ['id' => $customer->id]) }}">Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body user-profile">
                                    <div class="image-bx">
                                        <img src="{{ is_null($customer->profile) ? asset('employee/profile/default-profile.png') : asset('employee/profile/'.$customer->profile) }}" data-src="images/contacts/Untitled-3.jpg" alt="" class="rounded-circle">
                                        <span class="active"></span>
                                    </div>
                                    <div class="media-body user-meta-info">
                                        <h5 class="mb-0"><a class="text-black user-name" data-name="Alan Green">{{$customer->name}}</a></h5>
                                        <p class=" mb-3" data-occupation="UI Designer">{{$customer->company_name}}</p>
                                        <ul>
                                            <li><a href="tel: {{$customer->phone}}"><i class="fas fa-phone-alt"></i></a></li>
                                            <li><a href="mailto: {{$customer->email}}"><i class="fa-regular fa-envelope"></i></a></li>
                                            @if (!is_null($customer->whatsapp))
                                                <li><a target="_blank" href="https://wa.me/{{$customer->whatsapp}}"><i class="fa-brands fa-whatsapp"></i></a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="row"> <!-- Add this row to align items in a row -->
                                <div class="col-xl-12 col-lg-12 col-xxl-12 col-sm-12">
                                    <div class="card text-white bg-primary">
                                        <a class="m-3 text-white">Additional Info</a>
                                        <ul class="list-group list-group-flush">
                                            @if (!is_null($customer->phone_alternate))
                                                <li class="list-group-item d-flex justify-content-between"><span class="mb-0 text-white">Alt Phone</span><strong class="text-white"><a class="text-white" href="tel: {{$customer->phone_alternate}}">{{$customer->phone_alternate}}</a></strong></li>
                                            @endif
                                            @if (!is_null($customer->whatsapp))
                                            <li class="list-group-item d-flex justify-content-between"><span class="mb-0 text-white">WhatsApp Phone</span><strong class="text-white"><a class="text-white" target="_blank" href="https://wa.me/{{$customer->whatsapp}}">{{$customer->whatsapp}}</a></strong></li>
                                            @endif
                                            @if (!is_null($customer->street) || !is_null($customer->city) || !is_null($customer->state) || !is_null($customer->country))
                                                <li class="list-group-item d-flex justify-content-between"><span class="mb-0 text-white">Street</span><strong class="text-white">{{$customer->street}}</strong></li>
                                                <li class="list-group-item d-flex justify-content-between"><span class="mb-0 text-white">City</span><strong class="text-white">{{$customer->city}}</strong></li>
                                                <li class="list-group-item d-flex justify-content-between"><span class="mb-0 text-white">Pincode</span><strong class="text-white">{{$customer->pincode}}</strong></li>
                                                <li class="list-group-item d-flex justify-content-between"><span class="mb-0 text-white">State</span><strong class="text-white">{{$customer->state}}</strong></li>
                                                <li class="list-group-item d-flex justify-content-between"><span class="mb-0 text-white">Country</span><strong class="text-white">{{$customer->country}}</strong></li>
                                            @endif
                                            @if ( is_null($customer->phone_alternate) && is_null($customer->whatsapp) && is_null($customer->street) && is_null($customer->city) && is_null($customer->state) && is_null($customer->country))
                                              <li class="list-group-item d-flex justify-content-between text-white">No Additional Data Available</li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Projects</h4>
                                    <a href="{{ route('employee.view.project.create', ['customer_id' => $customer->id]) }}" class="btn btn-primary btn-sm">+ Create New Project</a>
                                </div>
                                <div class="card-body">
                                    @forelse ($projects as $project)
                                        <div class="row align-items-center mb-4 border-bottom pb-3">
                                            <div class="col-xl-4 col-md-6 col-sm-12">
                                                <p class="text-primary mb-0">#P-{{ str_pad($project->id, 6, '0', STR_PAD_LEFT) }}</p>
                                                <h6 class="text-black"><a class="text-black" href="{{ route('employee.view.project.preview', ['id' => $project->id]) }}">{{ $project->name }}</a></h6>
                                                <p class="mb-0"><i class="fas fa-calendar me-2"></i>Created on {{ $project->created_at->format('d M Y') }}</p>
                                            </div>
                                            <div class="col-xl-2 col-md-3 col-sm-6 mt-3 mt-md-0">
                                                <p class="mb-1">Amount</p>
                                                <h6 class="mb-0">₹{{ number_format($project->amount, 0) }}</h6>
                                            </div>
                                            <div class="col-xl-3 col-md-3 col-sm-6 mt-3 mt-md-0">
                                                <p class="mb-1">Deadline</p>
                                                <h6 class="mb-0">{{ date('D, d M Y', strtotime($project->end_date)) }}</h6>
                                            </div>
                                            <div class="col-xl-3 col-md-12 col-sm-12 mt-3 mt-xl-0 d-flex justify-content-xl-end justify-content-sm-start">
                                                <div class="d-flex align-items-center">
                                                    <a href="javascript:void(0);" class="badge badge-md light
                                                        @if ($project->status == 'OnProgress') badge-success @endif
                                                        @if ($project->status == 'Pending') badge-warning @endif
                                                        @if ($project->status == 'Closed') badge-danger @endif
                                                    ">
                                                        {{ $project->status }}
                                                    </a>
                                                    <div class="dropdown ms-3">
                                                        <div class="btn-link" data-bs-toggle="dropdown">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11.4477 12 12 12.5523 12 13Z" stroke="#3E4954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#3E4954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#3E4954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </div>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="#">Project Notes</a>
                                                            <a class="dropdown-item" href="javascript:handleProjectDelete({{ $project->id }});">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-center p-4">
                                            <p class="text-muted">This customer does not have any projects yet.</p>
                                            <a href="{{ route('employee.view.project.create', ['customer_id' => $customer->id]) }}" class="btn btn-primary btn-sm">+ Create New Project</a>
                                        </div>
                                    @endforelse

                                    {{-- Pagination Links --}}
                                    <div class="mt-3">
                                        {{ $projects->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form id="delete-project-form" action="" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>

                        {{-- ... existing code for customer info and the projects card ... --}}
                        {{-- This new card goes after the projects card div --}}

                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h4 class="card-title">Invoices</h4>
                                    {{-- Optional: A link to create a new invoice for this specific customer --}}
                                    <a href="{{ route('employee.view.bill.create', ['customer_id' => $customer->id]) }}" class="btn btn-primary btn-sm">+ New Invoice</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Amount</th>
                                                    <th>Bill Date</th>
                                                    <th>Due Date</th>
                                                    <th>Status</th>
                                                    <th>Created At</th>
                                                    <th class="text-end">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($bills as $bill)
                                                    <tr>
                                                        <td>{{ env('APP_CURRENCY') }}{{ number_format($bill->total, 2) }}</td>
                                                        <td>{{ date('d M, Y', strtotime($bill->bill_date)) }}</td>
                                                        <td>
                                                            @if (\Carbon\Carbon::parse($bill->due_date)->isPast() && $bill->payment_status != 'Paid')
                                                                <span class="badge light badge-danger">{{ date('d M, Y', strtotime($bill->due_date)) }}</span>
                                                            @else
                                                                <span class="badge light badge-success">{{ date('d M, Y', strtotime($bill->due_date)) }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($bill->payment_status == 'Paid')
                                                                <span class="badge badge-success">Paid</span>
                                                            @else
                                                                <span class="badge badge-warning">Pending</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $project->created_at->format('d M Y') }}</td>
                                                        <td class="text-end text-nowrap">
                                                            <a href="{{ route('employee.view.bill.update', ['id' => $bill->id]) }}" class="btn btn-warning btn-xxs" title="Edit">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <a href="{{ route('employee.handle.bill.invoice', ['id' => $bill->id]) }}" class="btn btn-info btn-xxs" title="Download">
                                                                <i class="fa fa-download"></i>
                                                            </a>
                                                            <a href="javascript:handleBillDelete({{ $bill->id }});" class="btn btn-danger btn-xxs" title="Delete">
                                                                <i class="fa fa-times"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center p-4">
                                                            This customer does not have any invoices yet.
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                    {{-- Pagination Links for the bills --}}
                                    <div class="mt-3">
                                        {{ $bills->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Domain & Hosting --}}
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h4 class="card-title">Domain & Hosting</h4>
                                    <a href="{{ route('employee.view.domain.hosting.create', ['customer_id' => $customer->id]) }}" class="btn btn-primary btn-sm">+ Add New Record</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Domain</th>
                                                    <th>Domain Expiry</th>
                                                    <th>Hosting Expiry</th>
                                                    <th class="text-end">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($domainHostings as $domainHosting)
                                                    <tr>
                                                        <td>
                                                            <strong>{{ $domainHosting->domain_name }}</strong>
                                                        </td>
                                                        <td>
                                                            @if (!is_null($domainHosting->domain_purchase))
                                                                @php
                                                                    $domainExpiry = \Carbon\Carbon::parse($domainHosting->domain_purchase)->addYear();
                                                                    $daysLeft = \Carbon\Carbon::now()->diffInDays($domainExpiry, false);
                                                                @endphp

                                                                @if ($daysLeft <= 30)
                                                                    <span class="badge light badge-danger">
                                                                        Expires in {{ $daysLeft }} days
                                                                    </span>
                                                                @else
                                                                    <span class="badge light badge-success">
                                                                        {{ $domainExpiry->format('d M, Y') }}
                                                                    </span>
                                                                @endif
                                                            @else
                                                                <span class="text-muted">N/A</span>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            @if (!is_null($domainHosting->hosting_purchase))
                                                                @php
                                                                    $hostingExpiry = \Carbon\Carbon::parse($domainHosting->hosting_purchase)->addYear();
                                                                    $daysLeft = \Carbon\Carbon::now()->diffInDays($hostingExpiry, false);
                                                                @endphp

                                                                @if ($daysLeft <= 30)
                                                                    <span class="badge light badge-danger">
                                                                        Expires in {{ $daysLeft }} days
                                                                    </span>
                                                                @else
                                                                    <span class="badge light badge-success">
                                                                        {{ $hostingExpiry->format('d M, Y') }}
                                                                    </span>
                                                                @endif
                                                            @else
                                                                <span class="text-muted">N/A</span>
                                                            @endif
                                                        </td>

                                                        <td class="text-end text-nowrap">
                                                            <a href="{{ route('employee.view.domain.hosting.update', ['id' => $domainHosting->id]) }}" class="btn btn-warning btn-xxs" title="Edit">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <a href="javascript:handleDomainHostingDelete({{ $domainHosting->id }});" class="btn btn-danger btn-xxs" title="Delete">
                                                                <i class="fa fa-times"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center p-4">
                                                            This customer has no Domain or Hosting records.
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                    {{-- Pagination Links for the domain/hosting records --}}
                                    <div class="mt-3">
                                        {{ $domainHostings->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Password Manager --}}
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h4 class="card-title">Password Manager</h4>
                                    <a href="{{ route('employee.view.password.create', ['customer_id' => $customer->id]) }}" class="btn btn-primary btn-sm">+ Add New Password</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Type</th>
                                                    <th>Username</th>
                                                    <th>Password</th>
                                                    <th class="text-end">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($passwords as $password)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <span class="me-2">
                                                                    @switch($password->type)
                                                                        @case('Facebook') <i class="fab fa-facebook-square fa-lg text-primary"></i> @break
                                                                        @case('Twitter') <i class="fab fa-twitter fa-lg text-info"></i> @break
                                                                        @case('Instagram') <i class="fab fa-instagram fa-lg text-danger"></i> @break
                                                                        @case('Linkedin') <i class="fab fa-linkedin fa-lg text-primary"></i> @break
                                                                        @case('Google') <i class="fab fa-google fa-lg text-warning"></i> @break
                                                                        @case('Microsoft') <i class="fab fa-microsoft fa-lg text-info"></i> @break
                                                                        @default <i class="fa fa-key"></i> @break
                                                                    @endswitch
                                                                </span>
                                                                <span>{{ $password->type }}</span>
                                                            </div>
                                                        </td>
                                                        <td>{{ $password->username ?: $password->email }}</td>
                                                        <td>
                                                            <div class="input-group input-group-sm">
                                                                <input type="password" class="form-control bg-transparent border-0" value="{{ $password->password }}" readonly>
                                                                <button class="btn btn-outline-secondary" type="button" onclick="handleTogglePassword(event)"><i class="fa fa-eye"></i></button>
                                                            </div>
                                                        </td>
                                                        <td class="text-end text-nowrap">
                                                            <a href="{{ route('employee.view.password.update', ['id' => $password->id]) }}" class="btn btn-warning btn-xxs" title="Edit">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <a href="javascript:handlePasswordDelete({{ $password->id }});" class="btn btn-danger btn-xxs" title="Delete">
                                                                <i class="fa fa-times"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center p-4">
                                                            No passwords have been saved for this customer.
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                    {{-- Pagination Links for the passwords --}}
                                    <div class="mt-3">
                                        {{ $passwords->links() }}
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
                            `{{ url('employee/customer/delete') }}/${id}`;
                    }
                });
        }

        function handleProjectDelete(id) {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this project!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        // Use a secure form post for deletion
                        const form = document.getElementById('delete-project-form');
                        form.action = `{{ url('employee/project') }}/${id}`;
                        form.submit();
                    }
                });
        }
    </script>
@endsection

