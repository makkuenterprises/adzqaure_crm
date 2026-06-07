@extends('admin.layouts.app')


@section('main-content')
    <!--**********************************
                                        Content body start
                                    ***********************************-->
    <div class="content-body default-height">


      <!-- Dynamic Overdue Invoices Alert Box (Fully Detached & Spaced on All 4 Sides) -->
            @if(isset($overdueBills) && $overdueBills->isNotEmpty())
                <!-- 'mt-3' adds the requested top margin to detach it from the header bar -->
                <div class="row mx-0 px-1 mt-3">
                    <div class="col-12 mb-3 px-0">
                        <div class="card" style="background-color: #ffffff; border-left: 4px solid #f72b50 !important; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid #e2e8f0;">

                            <!-- Minimalist Header -->
                            <div class="card-header d-flex justify-content-between align-items-center cursor-pointer select-none py-3 px-4"
                                 data-bs-toggle="collapse"
                                 data-bs-target="#overdueInvoicesCollapse"
                                 style="background: transparent; border-bottom: none;"
                                 title="Click to view overdue list">
                                <div class="d-flex align-items-center">
                                    <span class="text-danger me-2"><i class="fa fa-exclamation-circle fs-16 animate-pulse"></i></span>
                                    <span class="font-w600 text-dark fs-14">Outstanding Invoice Alert</span>
                                    <span class="badge badge-sm badge-danger rounded-pill ms-2" style="font-size: 0.75rem; padding: 2px 8px;">
                                        {{ $overdueBills->count() }} Overdue
                                    </span>
                                </div>
                                <span class="text-muted"><i class="fa fa-chevron-down fs-12"></i></span>
                            </div>

                            <!-- Collapsible Content -->
                            <div class="collapse" id="overdueInvoicesCollapse">
                                <!-- Nested floating card containing margins on all 4 sides so it does not touch the edges -->
                                <div style="background-color: #fafafa; border: 1px solid #f1f5f9; padding: 20px; margin: 0 20px 20px 20px; border-radius: 8px;">
                                    <p class="mb-3 text-muted fs-12">The following website maintenance invoices have passed their 1-week grace period and remain unpaid:</p>
                                    <ul class="mb-0" style="list-style-type: none; padding-left: 0;">
                                        @foreach($overdueBills as $bill)
                                            @php
                                                // Calculate the actual outstanding due amount
                                                $dueAmount = $bill->net_payable - $bill->received_amount;
                                            @endphp
                                            <li class="mb-2 d-flex align-items-center justify-content-between flex-wrap text-dark fs-12 py-2 border-bottom" style="border-color: #f1f5f9 !important;">
                                                <div>
                                                    <i class="fa fa-arrow-right text-muted me-2 fs-10"></i>
                                                    Invoice <strong class="font-mono">#ADZ/{{ $bill->created_at->year }}/{{ $bill->id }}</strong> for
                                                    <strong>{{ $bill->customer?->name }} @if($bill->customer?->phone) ({{ $bill->customer->phone }}) @endif</strong>
                                                    <span class="text-muted">(Due: {{ \Carbon\Carbon::parse($bill->due_date)->format('d M, Y') }})</span>
                                                </div>
                                                <div class="d-flex align-items-center mt-1 mt-sm-0">
                                                    <span class="font-w600 text-danger me-3">Rs. {{ number_format($dueAmount, 2) }} Due</span>
                                                    <a href="{{ route('admin.bill.history', ['bill' => $bill->id]) }}" class="btn btn-warning btn-xxs text-white py-1 px-2.5" style="border-radius: 4px;">
                                                        Settle
                                                    </a>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif

        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card tryal-gradient">
                                        <div class="card-body tryal row">
                                            <div class="col-xl-7 col-sm-7">
                                                <h2 class="mb-0">Manage your project in one touch</h2>
                                                <span>Let Adzquare manage your project automatically with our best
                                                    AI systems </span>
                                                <a href="javascript:void(0);" class="btn btn-rounded">Try Our
                                                    Services Now</a>
                                            </div>
                                            <div class="col-xl-5 col-sm-5 ">
                                                <img src="{{ asset('admin_new/images/chart.png') }}" alt=""
                                                    class="sd-shape">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="widget-stat card bg-primary">
                                        <div class="card-body  p-4">
                                            <div class="media">
                                                <span class="me-3">
                                                    <i class="la la-users"></i>
                                                </span>
                                                <div class="media-body text-white">
                                                    <p class="mb-1">Domains & Hosting</p>
                                                    <h3 class="text-white">{{ DB::table('domain_hostings')->count() }}</h3>
                                                    <div class="progress mb-2 bg-secondary">
                                                        <div class="progress-bar progress-animated bg-white"
                                                            style="width: 80%"></div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="widget-stat card bg-secondary">
                                        <div class="card-body p-4">
                                            <div class="media">
                                                <span class="me-3">
                                                    <i class="la la-graduation-cap"></i>
                                                </span>
                                                <div class="media-body text-white">
                                                    <p class="mb-1">Total Data</p>
                                                    <h3 class="text-white">{{ DB::table('leads')->count() }}</h3>
                                                    <div class="progress mb-2 bg-primary">
                                                        <div class="progress-bar progress-animated bg-white"
                                                            style="width: 76%"></div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="col-xl-6">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="row">
                                        <div class="col-xl-6 col-sm-6">
                                            <div class="card">
                                                <div
                                                    class="card-body card-padding d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <h4 class="mb-3 text-nowrap">Total Clients</h4>
                                                        <div class="d-flex align-items-center">
                                                            <h2 class="fs-32 font-w700 mb-0 counter">
                                                                {{ DB::table('customers')->count() }}</h2>
                                                            <div class="ms-4 d-flex align-items-center">
                                                                <svg width="16" height="11" viewBox="0 0 21 11"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M1.49217 11C0.590508 11 0.149368 9.9006 0.800944 9.27736L9.80878 0.66117C10.1954 0.29136 10.8046 0.291359 11.1912 0.661169L20.1991 9.27736C20.8506 9.9006 20.4095 11 19.5078 11H1.49217Z"
                                                                        fill="#09BD3C" />
                                                                </svg>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="columnChart"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-sm-6">
                                            <div class="card">
                                                <div class="card-body d-flex px-4  justify-content-between">
                                                    <div>
                                                        <div class="">
                                                            <h2 class="fs-32 font-w700 counter">
                                                                {{ DB::table('projects')->count() }}</h2>
                                                            <h4 class="mb-0 text-nowrap">Total Projects</h4>

                                                        </div>
                                                    </div>
                                                    <div id="NewCustomers1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="widget-stat card bg-warning">
                                        <div class="card-body p-4">
                                            <div class="media">
                                                <span class="me-3">
                                                    <i class="la la-user"></i>
                                                </span>
                                                <div class="media-body text-white">
                                                    <p class="mb-1">Admin Access</p>
                                                    <h3 class="text-white">{{ DB::table('admins')->count() }}</h3>
                                                    <div class="progress mb-2 bg-primary">
                                                        <div class="progress-bar progress-animated bg-white"
                                                            style="width: 50%"></div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="widget-stat card bg-danger ">
                                        <div class="card-body p-4">
                                            <div class="media">
                                                <span class="me-3">
                                                    <i class="la la-users"></i>
                                                </span>
                                                <div class="media-body text-white">
                                                    <p class="mb-1">Employees</p>
                                                    <h3 class="text-white">{{ DB::table('employees')->count() }}</h3>
                                                    <div class="progress mb-2 bg-secondary">
                                                        <div class="progress-bar progress-animated bg-white"
                                                            style="width: 30%"></div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
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
