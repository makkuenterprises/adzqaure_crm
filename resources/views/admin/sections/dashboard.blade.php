

@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Dashboard</h1>
        <ul class="breadcrumb">
            <li><a href="#">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="#">Dashboard</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <div class="grid md:grid-cols-4 md:gap-10 sm:gap-5">

        <a href="{{route('admin.view.campaign.list')}}" class="panel-card">
            <div class="panel-card-body">
                <div class="flex items-center justify-between mb-2">
                    <div class="space-y-2">
                        <p class="text-sm text-slate-500 font-medium tracking-wider uppercase">Campaign</p>
                        <h1 class="font-bold text-3xl">{{DB::table('campaigns')->count()}}</h1>
                    </div>
                    <div>
                        <div class="h-12 w-12 flex items-center justify-center bg-indigo-600 rounded-full text-white">
                            <i data-feather="layers"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <p class="flex items-center justify-start font-medium text-slate-500 text-sm whitespace-nowrap">
                       Todays Enquires 
                    </p>
                </div>
            </div>
        </a>

        <a href="{{route('admin.view.group.list')}}" class="panel-card">
            <div class="panel-card-body">
                <div class="flex items-center justify-between mb-2">
                    <div class="space-y-2">
                        <p class="text-sm text-slate-500 font-medium tracking-wider uppercase">Groups</p>
                        <h1 class="font-bold text-3xl">{{DB::table('groups')->count()}}</h1>
                    </div>
                    <div>
                        <div class="h-12 w-12 flex items-center justify-center bg-purple-600 rounded-full text-white">
                            <i data-feather="grid"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <p class="flex items-center justify-start font-medium text-slate-500 text-sm whitespace-nowrap">
                       Listed on Website
                    </p>
                </div>
            </div>
        </a>

        <a href="{{route('admin.view.employee.list')}}" class="panel-card">
            <div class="panel-card-body">
                <div class="flex items-center justify-between mb-2">
                    <div class="space-y-2">
                        <p class="text-sm text-slate-500 font-medium tracking-wider uppercase">Employees</p>
                        <h1 class="font-bold text-3xl">{{DB::table('employees')->count()}}</h1>
                    </div>
                    <div>
                        <div class="h-12 w-12 flex items-center justify-center bg-orange-600 rounded-full text-white">
                            <i data-feather="user"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <p class="flex items-center justify-start font-medium text-slate-500 text-sm whitespace-nowrap">
                       Listed on Website
                    </p>
                </div>
            </div>
        </a>

        <a href="{{route('admin.view.customer.list')}}" class="panel-card">
            <div class="panel-card-body">
                <div class="flex items-center justify-between mb-2">
                    <div class="space-y-2">
                        <p class="text-sm text-slate-500 font-medium tracking-wider uppercase">Customers</p>
                        <h1 class="font-bold text-3xl">{{DB::table('customers')->count()}}</h1>
                    </div>
                    <div>
                        <div class="h-12 w-12 flex items-center justify-center bg-pink-600 rounded-full text-white">
                            <i data-feather="user"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <p class="flex items-center justify-start font-medium text-slate-500 text-sm whitespace-nowrap">
                       Listed on Website
                    </p>
                </div>
            </div>
        </a>

        <a href="{{route('admin.view.project.list')}}" class="panel-card">
            <div class="panel-card-body">
                <div class="flex items-center justify-between mb-2">
                    <div class="space-y-2">
                        <p class="text-sm text-slate-500 font-medium tracking-wider uppercase">Projects</p>
                        <h1 class="font-bold text-3xl">{{DB::table('projects')->count()}}</h1>
                    </div>
                    <div>
                        <div class="h-12 w-12 flex items-center justify-center bg-green-600 rounded-full text-white">
                            <i data-feather="pie-chart"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <p class="flex items-center justify-start font-medium text-slate-500 text-sm whitespace-nowrap">
                       Listed on Website
                    </p>
                </div>
            </div>
        </a>

        <a href="{{route('admin.view.admin.list')}}" class="panel-card">
            <div class="panel-card-body">
                <div class="flex items-center justify-between mb-2">
                    <div class="space-y-2">
                        <p class="text-sm text-slate-500 font-medium tracking-wider uppercase">Admin Access</p>
                        <h1 class="font-bold text-3xl">{{DB::table('admins')->count()}}</h1>
                    </div>
                    <div>
                        <div class="h-12 w-12 flex items-center justify-center bg-blue-600 rounded-full text-white">
                            <i data-feather="shield"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <p class="flex items-center justify-start font-medium text-slate-500 text-sm whitespace-nowrap">
                       Listed on Website
                    </p>
                </div>
            </div>
        </a>

        <a href="{{route('admin.view.domain.hosting.list')}}" class="panel-card">
            <div class="panel-card-body">
                <div class="flex items-center justify-between mb-2">
                    <div class="space-y-2">
                        <p class="text-sm text-slate-500 font-medium tracking-wider uppercase">Domain Hostings</p>
                        <h1 class="font-bold text-3xl">{{DB::table('domain_hostings')->count()}}</h1>
                    </div>
                    <div>
                        <div class="h-12 w-12 flex items-center justify-center bg-violet-600 rounded-full text-white">
                            <i data-feather="server"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <p class="flex items-center justify-start font-medium text-slate-500 text-sm whitespace-nowrap">
                       Listed on Website
                    </p>
                </div>
            </div>
        </a>

        <a href="{{route('admin.view.lead.import')}}" class="panel-card">
            <div class="panel-card-body">
                <div class="flex items-center justify-between mb-2">
                    <div class="space-y-2">
                        <p class="text-sm text-slate-500 font-medium tracking-wider uppercase">Leads</p>
                        <h1 class="font-bold text-3xl">{{DB::table('leads')->count()}}</h1>
                    </div>
                    <div>
                        <div class="h-12 w-12 flex items-center justify-center bg-cyan-600 rounded-full text-white">
                            <i data-feather="list"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <p class="flex items-center justify-start font-medium text-slate-500 text-sm whitespace-nowrap">
                       Listed on Website
                    </p>
                </div>
            </div>
        </a>

        <figure class="panel-card md:col-span-2 sm:col-span-1">
            <div class="panel-card-header">
                <div>
                    <h1 class="panel-card-title">All Domain Hostings</h1>
                    <p class="panel-card-description">All domain hostings in the website </p>
                </div>
            </div>
            <div>
            @foreach (DB::table('domain_hostings')->get() as $item)
            <a href="{{route('admin.view.domain.hosting.list')}}" class="">
                @if (\Carbon\Carbon::now()->diffInDays($item->domain_expiry, false) <= 10 && \Carbon\Carbon::now()->diffInDays($item->domain_expiry, false) > 0)
                <div class="notification-body w-full">
                    <div class="icon"><i data-feather="server"></i></div>
                    <div class="content w-full">
                        <div>
                            <h1 class="title">{{DB::table('customers')->find($item->customer_id)?->name}}`s domain will expire in {{\Carbon\Carbon::now()->diffInDays($item->domain_expiry, false)}} days</h1>
                        </div>
                        
                        <p class="description">{{$item->domain_name}} will expire on {{ date('D d-m-Y',strtotime($item->domain_expiry)) }}</p>
                    </div>
                </div>
                @endif

                @if (\Carbon\Carbon::now()->diffInDays($item->domain_expiry, false) <= 0)
                <div class="notification-body w-full">
                    <div class="icon"><i data-feather="server"></i></div>
                    <div class="content w-full">
                        <div>
                            <h1 class="title">{{DB::table('customers')->find($item->customer_id)?->name}}`s domain is expired</h1>
                        </div>
                        <p class="description">{{$item->domain_name}} is expired on {{ date('D d-m-Y',strtotime($item->domain_expiry)) }}</p>
                    </div>
                </div>
                @endif
                
                @if (\Carbon\Carbon::now()->diffInDays($item->hosting_expiry, false) <= 10 && \Carbon\Carbon::now()->diffInDays($item->hosting_expiry, false) > 0)
                <div class="notification-body w-full">
                    <div class="icon"><i data-feather="server"></i></div>
                    <div class="content w-full">
                        <div>
                            <h1 class="title">{{DB::table('customers')->find($item->customer_id)?->name}}`s hosting will expire in {{\Carbon\Carbon::now()->diffInDays($item->hosting_expiry, false)}} days</h1>
                        </div>
                        
                        <p class="description">The hosting of {{DB::table('customers')->find($item->customer_id)?->name}} will expire on {{ date('D d-m-Y',strtotime($item->hosting_expiry)) }}</p>
                    </div>
                </div>
                @endif

                @if (\Carbon\Carbon::now()->diffInDays($item->hosting_expiry, false) <= 0)
                <div class="notification-body w-full">
                    <div class="icon"><i data-feather="server"></i></div>
                    <div class="content w-full">
                        <div>
                            <h1 class="title">{{DB::table('customers')->find($item->customer_id)?->name}}`s hosting is expired</h1>
                        </div>
                        <p class="description">The hosting of {{DB::table('customers')->find($item->customer_id)?->name}} is expired on {{ date('D d-m-Y',strtotime($item->domain_expiry)) }}</p>
                    </div>
                </div>
                @endif

            </a>
            @endforeach
            </div>
        </figure>


    </div>
@endsection

@section('panel-script')
    <script>
        document.getElementById('dashboard-tab').classList.add('active');
    </script>
@endsection