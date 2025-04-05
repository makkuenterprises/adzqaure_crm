@extends('admin.layouts.app')

@section('main-content')
    <!--**********************************
                                                                                                                                                                                                                                                                    Content body start
                                                                                                                                                                                                                                                                ***********************************-->
    <div class="content-body default-height">
        <!-- row -->
        <div class="container-fluid">
            <div class="project-page d-flex justify-content-between align-items-center flex-wrap">
                <div class="card-tabs mb-4">

                    <ul class="nav nav-tabs style-1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ request('status') == null ? 'active' : '' }}" data-bs-toggle="tab"
                                href="#AllStatus" role="tab">All Status</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request('status') == 'Pending' ? 'active' : '' }}" data-bs-toggle="tab"
                                href="#Pending" role="tab">Pending</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('status') == 'OnProgress' ? 'active' : '' }}" data-bs-toggle="tab"
                                href="#OnProgress" role="tab">On Progress</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request('status') == 'Closed' ? 'active' : '' }}" data-bs-toggle="tab"
                                href="#Closed" role="tab">Closed</a>
                        </li>
                    </ul>


                </div>
                <div class="mb-4">
                    <a href="{{ route('admin.view.project.create') }}" class="btn btn-primary btn-rounded">+ New Project</a>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="tab-content">
                        <div class="tab-pane fade {{ request('status') == null ? 'active show' : '' }}" id="AllStatus">
                            <div class="card project-card">
                                <div class="card-body py-3 px-4">
                                    <div class="row align-items-center">
                                        @foreach ($projects as $project)
                                            @if ($status == null || $status == $project->status)
                                                <div class="col-xl-3  col-md-4 col-sm-12 align-items-center customers">
                                                    <div class="media-body">
                                                        <p class="text-primary mb-0">
                                                            #P-{{ str_pad($project->id, 6, '0', STR_PAD_LEFT) }}</p>
                                                        <h6 class="text-black"><a class="text-black"
                                                                href="{{ route('admin.view.project.preview', ['id' => $project->id]) }}">{{ $project->name }}</a>
                                                        </h6>
                                                        <p class="mb-0"><i class="fas fa-calendar me-3"></i>Created on
                                                            {{ $project->created_at->format('D, d M Y') }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3  col-md-6 col-sm-6 mt-md-0 mt-sm-3">
                                                    <div class="d-flex project-image">
                                                        {{-- <img src="images/customers/11.jpg" alt=""> --}}
                                                        <div>
                                                            <img src="{{ $project->customer->profile && file_exists(public_path('admin/customers/' . $project->customer->profile)) ? asset('admin/customers/' . $project->customer->profile) : asset('admin/customers/default-profile.png') }}"
                                                                alt="Customer Image" class="img-thumbnail">
                                                        </div>

                                                        <div>
                                                            <p class="mb-0">Client</p>
                                                            <h6 class="mb-0 ml-1">{{ $project->customer->name }}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-1 col-md-1 col-sm-3 text-lg-center mt-md-0 mt-3">
                                                    <div class="d-flex project-image">
                                                        <div>
                                                            <p class="mb-0">Amount</p>
                                                            <h6 class="mb-0">₹{{ number_format($project->amount, 0) }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3  col-md-6 col-sm-6 mt-3 mt-xl-0">
                                                    <div class="d-flex project-image">
                                                        <svg class="me-3" width="45" height="45"
                                                            viewBox="0 0 55 55" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <circle cx="27.5" cy="27.5" r="27.5" fill="#886CC0">
                                                            </circle>
                                                            <g clip-path="url(#clip0)">
                                                                <path
                                                                    d="M37.2961 23.6858C37.1797 23.4406 36.9325 23.2843 36.661 23.2843H29.6088L33.8773 16.0608C34.0057 15.8435 34.0077 15.5738 33.8826 15.3546C33.7574 15.1354 33.5244 14.9999 33.2719 15L27.2468 15.0007C26.9968 15.0008 26.7656 15.1335 26.6396 15.3495L18.7318 28.905C18.6049 29.1224 18.604 29.3911 18.7294 29.6094C18.8548 29.8277 19.0873 29.9624 19.3391 29.9624H26.3464L24.3054 38.1263C24.2255 38.4457 24.3781 38.7779 24.6725 38.9255C24.7729 38.9757 24.8806 39 24.9872 39C25.1933 39 25.3952 38.9094 25.5324 38.7413L37.2058 24.4319C37.3774 24.2215 37.4126 23.931 37.2961 23.6858Z"
                                                                    fill="white"></path>
                                                            </g>
                                                            <defs>
                                                                <clipPath>
                                                                    <rect width="24" height="24" fill="white"
                                                                        transform="translate(16 15)"></rect>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                        <div>
                                                            <p class="mb-0">Deadline</p>
                                                            <h6 class="mb-0">
                                                                {{ date('D, d M Y', strtotime($project->end_date)) }}</h6>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-2  col-sm-6 col-sm-4 mt-xl-0  mt-3">
                                                    <div class="d-flex justify-content-sm-end project-btn">
                                                        <a href="javascript:void(0);" class="badge badge-md light"
                                                            style="
                                                            @if ($project->status == 'OnProgress') background-color: #d7fde2; color: #09BD3C;
                                                            @elseif($project->status == 'Pending')
                                                                background-color: #fff9e6; color: #FFBF00;
                                                            @elseif($project->status == 'Closed')
                                                                background-color: #ffedf0; color: #FC2E53; @endif
                                                        ">
                                                            {{ $project->status }}
                                                        </a>

                                                        <div class="dropdown ms-4  mt-auto mb-auto">
                                                            <div class="btn-link" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12Z"
                                                                        stroke="#737B8B" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                    <path
                                                                        d="M18 12C18 12.5523 18.4477 13 19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11C18.4477 11 18 11.4477 18 12Z"
                                                                        stroke="#737B8B" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                    <path
                                                                        d="M4 12C4 12.5523 4.44772 13 5 13C5.55228 13 6 12.5523 6 12C6 11.4477 5.55228 11 5 11C4.44772 11 4 11.4477 4 12Z"
                                                                        stroke="#737B8B" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);">Edit</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Tab -->
                        <div class="tab-pane fade {{ request('status') == 'Pending' ? 'active show' : '' }}"
                            id="Pending">
                            <!-- Similar structure for Pending projects -->
                            <div class="card project-card">
                                <div class="card-body py-3 px-4">
                                    <div class="row align-items-center">
                                        @foreach ($projects as $project)
                                            @if ($project->status == 'Pending')
                                                <div class="col-xl-3  col-md-4 col-sm-12 align-items-center customers">
                                                    <div class="media-body">
                                                        <p class="text-primary mb-0">
                                                            #P-{{ str_pad($project->id, 6, '0', STR_PAD_LEFT) }}</p>
                                                        <h6 class="text-black"><a class="text-black"
                                                                href="{{ route('admin.view.project.preview', ['id' => $project->id]) }}">{{ $project->name }}</a>
                                                        </h6>
                                                        <p class="mb-0"><i class="fas fa-calendar me-3"></i>Created on
                                                            {{ $project->created_at->format('D, d M Y') }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-xl-2  col-md-4 col-sm-6 mt-md-0 mt-sm-3">
                                                    <div class="d-flex project-image">
                                                        <div>
                                                            <p class="mb-0">Profile</p>

                                                            <img src="{{ $project->customer->profile && file_exists(public_path('admin/customers/' . $project->customer->profile)) ? asset('admin/customers/' . $project->customer->profile) : asset('admin/customers/default-profile.png') }}"
                                                                alt="Customer Image" class="img-thumbnail">
                                                        </div>
                                                        <div>
                                                            <p class="mb-0">Client</p>
                                                            <h6 class="mb-0">{{ $project->customer->name }}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-2 col-md-4 col-sm-6 text-lg-center mt-md-0 mt-3">
                                                    <div class="d-flex project-image">
                                                        <div>
                                                            <p class="mb-0">Amount</p>
                                                            <h6 class="mb-0">₹{{ number_format($project->amount, 0) }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3  col-md-6 col-sm-6 mt-3 mt-xl-0">
                                                    <div class="d-flex project-image">
                                                        <svg class="me-3" width="45" height="45"
                                                            viewBox="0 0 55 55" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <circle cx="27.5" cy="27.5" r="27.5"
                                                                fill="#886CC0"></circle>
                                                            <g clip-path="url(#clip0)">
                                                                <path
                                                                    d="M37.2961 23.6858C37.1797 23.4406 36.9325 23.2843 36.661 23.2843H29.6088L33.8773 16.0608C34.0057 15.8435 34.0077 15.5738 33.8826 15.3546C33.7574 15.1354 33.5244 14.9999 33.2719 15L27.2468 15.0007C26.9968 15.0008 26.7656 15.1335 26.6396 15.3495L18.7318 28.905C18.6049 29.1224 18.604 29.3911 18.7294 29.6094C18.8548 29.8277 19.0873 29.9624 19.3391 29.9624H26.3464L24.3054 38.1263C24.2255 38.4457 24.3781 38.7779 24.6725 38.9255C24.7729 38.9757 24.8806 39 24.9872 39C25.1933 39 25.3952 38.9094 25.5324 38.7413L37.2058 24.4319C37.3774 24.2215 37.4126 23.931 37.2961 23.6858Z"
                                                                    fill="white"></path>
                                                            </g>
                                                            <defs>
                                                                <clipPath>
                                                                    <rect width="24" height="24" fill="white"
                                                                        transform="translate(16 15)"></rect>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                        <div>
                                                            <p class="mb-0">Deadline</p>
                                                            <h6 class="mb-0">
                                                                {{ date('D, d M Y', strtotime($project->end_date)) }}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-2  col-sm-6 col-sm-4 mt-xl-0  mt-3">
                                                    <div class="d-flex justify-content-sm-end project-btn">
                                                        <a href="javascript:void(0);"
                                                            class="badge badge-warning light badge-md">{{ $project->status }}</a>
                                                        <div class="dropdown ms-4  mt-auto mb-auto">
                                                            <div class="btn-link" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12Z"
                                                                        stroke="#737B8B" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                    <path
                                                                        d="M18 12C18 12.5523 18.4477 13 19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11C18.4477 11 18 11.4477 18 12Z"
                                                                        stroke="#737B8B" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                    <path
                                                                        d="M4 12C4 12.5523 4.44772 13 5 13C5.55228 13 6 12.5523 6 12C6 11.4477 5.55228 11 5 11C4.44772 11 4 11.4477 4 12Z"
                                                                        stroke="#737B8B" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);">Edit</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);">Delete</a>
                                                                <!-- Mark as On Progress option -->
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.project.change-status', ['id' => $project->id, 'status' => 'OnProgress']) }}">
                                                                    Mark as Progress
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- On Progress Tab -->
                        <div class="tab-pane fade {{ request('status') == 'OnProgress' ? 'active show' : '' }}"
                            id="OnProgress">
                            <!-- Similar structure for On Progress projects -->
                            <div class="card project-card">
                                <div class="card-body py-3 px-4">
                                    <div class="row align-items-center">
                                        @foreach ($projects as $project)
                                            @if ($project->status == 'OnProgress')
                                                <div class="col-xl-3  col-md-4 col-sm-12 align-items-center customers">
                                                    <div class="media-body">
                                                        <p class="text-primary mb-0">
                                                            #P-{{ str_pad($project->id, 6, '0', STR_PAD_LEFT) }}</p>
                                                        <h6 class="text-black"><a class="text-black"
                                                                href="{{ route('admin.view.project.preview', ['id' => $project->id]) }}">{{ $project->name }}</a>
                                                        </h6>
                                                        <p class="mb-0"><i class="fas fa-calendar me-3"></i>Created on
                                                            {{ $project->created_at->format('D, d M Y') }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-xl-2  col-md-4 col-sm-6 mt-md-0 mt-sm-3">
                                                    <div class="d-flex project-image">
                                                        <div>
                                                            <p class="mb-0">Profile</p>

                                                            <img src="{{ $project->customer->profile && file_exists(public_path('admin/customers/' . $project->customer->profile)) ? asset('admin/customers/' . $project->customer->profile) : asset('admin/customers/default-profile.png') }}"
                                                                alt="Customer Image" class="img-thumbnail">
                                                        </div>
                                                        <div>
                                                            <p class="mb-0">Client</p>
                                                            <h6 class="mb-0">{{ $project->customer->name }}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-2 col-md-4 col-sm-6 text-lg-center mt-md-0 mt-3">
                                                    <div class="d-flex project-image">
                                                        <div>
                                                            <p class="mb-0">Amount</p>
                                                            <h6 class="mb-0">₹{{ number_format($project->amount, 0) }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3  col-md-6 col-sm-6 mt-3 mt-xl-0">
                                                    <div class="d-flex project-image">
                                                        <svg class="me-3" width="45" height="45"
                                                            viewBox="0 0 55 55" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <circle cx="27.5" cy="27.5" r="27.5"
                                                                fill="#886CC0"></circle>
                                                            <g clip-path="url(#clip0)">
                                                                <path
                                                                    d="M37.2961 23.6858C37.1797 23.4406 36.9325 23.2843 36.661 23.2843H29.6088L33.8773 16.0608C34.0057 15.8435 34.0077 15.5738 33.8826 15.3546C33.7574 15.1354 33.5244 14.9999 33.2719 15L27.2468 15.0007C26.9968 15.0008 26.7656 15.1335 26.6396 15.3495L18.7318 28.905C18.6049 29.1224 18.604 29.3911 18.7294 29.6094C18.8548 29.8277 19.0873 29.9624 19.3391 29.9624H26.3464L24.3054 38.1263C24.2255 38.4457 24.3781 38.7779 24.6725 38.9255C24.7729 38.9757 24.8806 39 24.9872 39C25.1933 39 25.3952 38.9094 25.5324 38.7413L37.2058 24.4319C37.3774 24.2215 37.4126 23.931 37.2961 23.6858Z"
                                                                    fill="white"></path>
                                                            </g>
                                                            <defs>
                                                                <clipPath>
                                                                    <rect width="24" height="24" fill="white"
                                                                        transform="translate(16 15)"></rect>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                        <div>
                                                            <p class="mb-0">Deadline</p>
                                                            <h6 class="mb-0">
                                                                {{ date('D, d M Y', strtotime($project->end_date)) }}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-2  col-sm-6 col-sm-4 mt-xl-0  mt-3">
                                                    <div class="d-flex justify-content-sm-end project-btn">
                                                        <a href="javascript:void(0);"
                                                            class="badge badge-success light badge-md">{{ $project->status }}</a>
                                                        <div class="dropdown ms-4  mt-auto mb-auto">
                                                            <div class="btn-link" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12Z"
                                                                        stroke="#737B8B" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                    <path
                                                                        d="M18 12C18 12.5523 18.4477 13 19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11C18.4477 11 18 11.4477 18 12Z"
                                                                        stroke="#737B8B" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                    <path
                                                                        d="M4 12C4 12.5523 4.44772 13 5 13C5.55228 13 6 12.5523 6 12C6 11.4477 5.55228 11 5 11C4.44772 11 4 11.4477 4 12Z"
                                                                        stroke="#737B8B" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);">Edit</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);">Delete</a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.project.change-status', ['id' => $project->id, 'status' => 'Closed']) }}">
                                                                    Mark as Closed
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Closed Tab -->
                        <div class="tab-pane fade {{ request('status') == 'Closed' ? 'active show' : '' }}"
                            id="Closed">
                            <!-- Similar structure for Closed projects -->
                            <div class="card project-card">
                                <div class="card-body py-3 px-4">
                                    <div class="row align-items-center">
                                        @foreach ($projects as $project)
                                            @if ($project->status == 'Closed')
                                                <div class="col-xl-3  col-md-4 col-sm-12 align-items-center customers">
                                                    <div class="media-body">
                                                        <p class="text-primary mb-0">
                                                            #P-{{ str_pad($project->id, 6, '0', STR_PAD_LEFT) }}</p>
                                                        <h6 class="text-black"><a class="text-black"
                                                                href="{{ route('admin.view.project.preview', ['id' => $project->id]) }}">{{ $project->name }}</a>
                                                        </h6>
                                                        <p class="mb-0"><i class="fas fa-calendar me-3"></i>Created on
                                                            {{ $project->created_at->format('D, d M Y') }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-xl-2  col-md-4 col-sm-6 mt-md-0 mt-sm-3">
                                                    <div class="d-flex project-image">
                                                        <div>
                                                            <p class="mb-0">Profile</p>

                                                            <img src="{{ $project->customer->profile && file_exists(public_path('admin/customers/' . $project->customer->profile)) ? asset('admin/customers/' . $project->customer->profile) : asset('admin/customers/default-profile.png') }}"
                                                                alt="Customer Image" class="img-thumbnail">
                                                        </div>
                                                        <div>
                                                            <p class="mb-0">Client</p>
                                                            <h6 class="mb-0">{{ $project->customer->name }}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-2 col-md-4 col-sm-6 text-lg-center mt-md-0 mt-3">
                                                    <div class="d-flex project-image">
                                                        <div>
                                                            <p class="mb-0">Amount</p>
                                                            <h6 class="mb-0">₹{{ number_format($project->amount, 0) }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3  col-md-6 col-sm-6 mt-3 mt-xl-0">
                                                    <div class="d-flex project-image">
                                                        <svg class="me-3" width="45" height="45"
                                                            viewBox="0 0 55 55" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <circle cx="27.5" cy="27.5" r="27.5"
                                                                fill="#886CC0"></circle>
                                                            <g clip-path="url(#clip0)">
                                                                <path
                                                                    d="M37.2961 23.6858C37.1797 23.4406 36.9325 23.2843 36.661 23.2843H29.6088L33.8773 16.0608C34.0057 15.8435 34.0077 15.5738 33.8826 15.3546C33.7574 15.1354 33.5244 14.9999 33.2719 15L27.2468 15.0007C26.9968 15.0008 26.7656 15.1335 26.6396 15.3495L18.7318 28.905C18.6049 29.1224 18.604 29.3911 18.7294 29.6094C18.8548 29.8277 19.0873 29.9624 19.3391 29.9624H26.3464L24.3054 38.1263C24.2255 38.4457 24.3781 38.7779 24.6725 38.9255C24.7729 38.9757 24.8806 39 24.9872 39C25.1933 39 25.3952 38.9094 25.5324 38.7413L37.2058 24.4319C37.3774 24.2215 37.4126 23.931 37.2961 23.6858Z"
                                                                    fill="white"></path>
                                                            </g>
                                                            <defs>
                                                                <clipPath>
                                                                    <rect width="24" height="24" fill="white"
                                                                        transform="translate(16 15)"></rect>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                        <div>
                                                            <p class="mb-0">Deadline</p>
                                                            <h6 class="mb-0">
                                                                {{ date('D, d M Y', strtotime($project->end_date)) }}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-2  col-sm-6 col-sm-4 mt-xl-0  mt-3">
                                                    <div class="d-flex justify-content-sm-end project-btn">
                                                        <a href="javascript:void(0);"
                                                            class="badge badge-danger light badge-md">{{ $project->status }}</a>
                                                        <div class="dropdown ms-4  mt-auto mb-auto">
                                                            <div class="btn-link" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12Z"
                                                                        stroke="#737B8B" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                    <path
                                                                        d="M18 12C18 12.5523 18.4477 13 19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11C18.4477 11 18 11.4477 18 12Z"
                                                                        stroke="#737B8B" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                    <path
                                                                        d="M4 12C4 12.5523 4.44772 13 5 13C5.55228 13 6 12.5523 6 12C6 11.4477 5.55228 11 5 11C4.44772 11 4 11.4477 4 12Z"
                                                                        stroke="#737B8B" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);">Edit</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <p class="mb-0 text-black">Showing {{ $projects->firstItem() }} to {{ $projects->lastItem() }} of
                        {{ $projects->total() }} projects</p>
                    <nav>
                        <ul class="pagination pagination-circle">
                            {{ $projects->links('pagination::bootstrap-4') }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
                                                                                                                                                                                                                                                                    Content body end
                                                                                                                                                                                                                                                                ***********************************-->
@endsection



@section('js')
    <!--**********************************
                                                                                                                                                                                                                                                                Scripts
                                                                                                                                                                                                                                                            ***********************************-->
    <!-- Required vendors -->
    <script src="vendor/global/global.min.js"></script>
    <script src="vendor/bootstrap-select/js/bootstrap-select.min.js"></script>

    <!-- Apex Chart -->
    <!-- Chart piety plugin files -->

    <!-- Dashboard 1 -->
    <script src="js/custom.min.js"></script>
    <script src="js/dlabnav-init.js"></script>
@endsection
