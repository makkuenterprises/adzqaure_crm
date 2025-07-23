<!--**********************************
            Sidebar start
        ***********************************-->
<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">

            <li><a href="{{ route('employee.view.dashboard') }}" aria-expanded="false">
                    <i class="fas fa-home"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>

            <li><a href="{{ route('employee.inquiries.index') }}" aria-expanded="false">
                    <i class="fa fa-envelope"></i>
                    <span class="nav-text">Inquiries <span class="badge badge-xs badge-danger ms-2">New</span></span>
                </a>
            </li>
            <li><a href="{{ route('employee.view.lead.manager.list') }}" aria-expanded="false">
                    <i class="fa fa-hourglass"></i>
                    <span class="nav-text">Leads Manager <span class="badge badge-xs badge-danger ms-2">New</span></span>
                </a>
            </li>
            {{-- <li>
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <i class="fa-solid fa-database"></i>
                    <span class="nav-text">Data Records <span class="badge badge-xs badge-danger ms-2">New</span></span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.view.lead.create') }}">Create Data</a></li>
                    <li><a href="{{ route('admin.view.lead.import') }}">Import Data</a></li>
                    <li><a href="{{ route('admin.view.group.list') }}">Data Groups</a></li>
                </ul>
            </li> --}}
            {{-- <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fa-solid fa-briefcase"></i>
                    <span class="nav-text">Work</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.view.plan.list') }}">Plan</a></li>
                    <li><a href="{{ route('admin.view.package.list') }}">Package</a></li>
                </ul>
            </li> --}}

            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-heart"></i>
                    <span class="nav-text">Customers</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.view.customer.list') }}">Manage Customers</a></li>
                    <li><a href="{{ route('admin.view.project.list') }}">Customer Projects</a></li>
                    <li><a href="{{ route('admin.view.domain.hosting.list') }}">Domain & Hosting</a></li>
                    <li><a href="{{ route('admin.view.bill.list') }}">Payment & Bills</a></li>
                    <li><a href="{{ route('admin.view.password.list') }}">Paassword Manager</a></li>
                </ul>
            </li>


            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fa-solid fa-user-tie"></i>
                    <span class="nav-text">Employees</span>
                </a>
                <ul aria-expanded="false">
                    {{-- <li><a href="{{ route('admin.view.employee.list') }}">Manage Employees</a></li> --}}
                    <li><a href="uc-nestable.html">Task Manager</a></li>
                </ul>
            </li>
            <li><a href="{{ route('employee.view.setting') }}" aria-expanded="false">
                    <i class="fas fa-cog"></i>
                    <span class="nav-text">Settings</span>
                </a>
            </li>
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
