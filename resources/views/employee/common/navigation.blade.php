<!--**********************************
            Sidebar start
        ***********************************-->
<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">

            @can('view-dashboard')
            <li><a href="{{ route('employee.view.dashboard') }}" aria-expanded="false">
                    <i class="fas fa-home"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            @endcan

            @can('view-inquiries')
            <li><a href="{{ route('employee.inquiries.index') }}" aria-expanded="false">
                    <i class="fa fa-envelope"></i>
                    <span class="nav-text">Inquiries <span class="badge badge-xs badge-danger ms-2">New</span></span>
                </a>
            </li>
            @endcan

            @can('manage-leads')
            <li><a href="{{ route('employee.view.lead.manager.list') }}" aria-expanded="false">
                    <i class="fa fa-hourglass"></i>
                    <span class="nav-text">Leads Manager <span class="badge badge-xs badge-danger ms-2">New</span></span>
                </a>
            </li>
            @endcan

            {{-- NOTE: Data Records section was commented out in your original file.
                 If you re-enable it, the permissions are ready. --}}
            {{-- @can('access-data-records-menu')
            <li>
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <i class="fa-solid fa-database"></i>
                    <span class="nav-text">Data Records <span class="badge badge-xs badge-danger ms-2">New</span></span>
                </a>
                <ul aria-expanded="false">
                    @can('create-data')
                    <li><a href="{{ route('admin.view.lead.create') }}">Create Data</a></li>
                    @endcan
                    @can('import-data')
                    <li><a href="{{ route('admin.view.lead.import') }}">Import Data</a></li>
                    @endcan
                    @can('view-data-groups')
                    <li><a href="{{ route('admin.view.group.list') }}">Data Groups</a></li>
                    @endcan
                </ul>
            </li>
            @endcan --}}

            @can('access-customers-menu')
            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-heart"></i>
                    <span class="nav-text">Customers</span>
                </a>
                <ul aria-expanded="false">
                    @can('manage-customers')
                    <li><a href="{{ route('employee.view.customer.list') }}">Manage Customers</a></li>
                    @endcan
                    @can('manage-customer-projects')
                    <li><a href="{{ route('employee.view.project.list') }}">Customer Projects</a></li>
                    @endcan
                    @can('manage-domain-hosting')
                    <li><a href="{{ route('employee.view.domain.hosting.list') }}">Domain & Hosting</a></li>
                    @endcan
                    @can('manage-payments-bills')
                    <li><a href="{{ route('employee.view.bill.list') }}">Payment & Bills</a></li>
                    @endcan
                    @can('manage-password-manager')
                    <li><a href="{{ route('employee.view.password.list') }}">Paassword Manager</a></li>
                    @endcan
                </ul>
            </li>
            @endcan

            @can('access-employees-menu')
            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fa-solid fa-user-tie"></i>
                    <span class="nav-text">Employees</span>
                </a>
                <ul aria-expanded="false">
                    {{-- The "Manage Employees" link was commented out, which is good practice
                         as regular employees likely shouldn't manage each other. --}}
                    {{-- @can('manage-employees')
                    <li><a href="{{ route('admin.view.employee.list') }}">Manage Employees</a></li>
                    @endcan --}}
                    @can('manage-task-manager')
                    <li><a href="uc-nestable.html">Task Manager</a></li>
                    @endcan
                </ul>
            </li>
            @endcan

            @can('manage-settings')
            <li><a href="{{ route('employee.view.setting') }}" aria-expanded="false">
                    <i class="fas fa-cog"></i>
                    <span class="nav-text">Settings</span>
                </a>
            </li>
            @endcan
        </ul>

        <div class="copyright">
            <p>Makku Enterprises © {{ date('Y') }} All Rights Reserved</p>
            <p class="fs-12">Made with <span class="heart"></span> by <a href="https://adzquare.com">Adzquare</a></p>
        </div>
    </div>
</div>
<!--**********************************
            Sidebar end
        ***********************************-->
