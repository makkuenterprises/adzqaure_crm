@extends('admin.layouts.app')


@section('main-content')
    <!--**********************************
                                        Content body start
                                    ***********************************-->
    <div class="content-body default-height">
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
                                                    <small>80% Increase in 20 Days</small>
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
                                                    <p class="mb-1">Total Leads</p>
                                                    <h3 class="text-white">{{ DB::table('leads')->count() }}</h3>
                                                    <div class="progress mb-2 bg-primary">
                                                        <div class="progress-bar progress-animated bg-white"
                                                            style="width: 76%"></div>
                                                    </div>
                                                    <small>76% Increase in 20 Days</small>
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
                                                                <strong class="text-success">+0,5%</strong>
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
                                                            <p class="mb-0"><strong class="text-success">+2%</strong> than
                                                                last
                                                                month</p>
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
                                                    <small>50% Increase in 25 Days</small>
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
                                                    <i class="la la-dollar"></i>
                                                </span>
                                                <div class="media-body text-white">
                                                    <p class="mb-1">Employees</p>
                                                    <h3 class="text-white">{{ DB::table('employees')->count() }}</h3>
                                                    <div class="progress mb-2 bg-secondary">
                                                        <div class="progress-bar progress-animated bg-white"
                                                            style="width: 30%"></div>
                                                    </div>
                                                    <small>30% Increase in 30 Days</small>
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
