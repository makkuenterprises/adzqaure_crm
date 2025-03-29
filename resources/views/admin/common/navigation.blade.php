<!--**********************************
            Sidebar start
        ***********************************-->
<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">

            <li><a href="{{route('/')}}" aria-expanded="false">
                    <i class="fas fa-home"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <i class="fas fa-chart-line"></i>
                    <span class="nav-text">Data Records <span class="badge badge-xs badge-danger ms-2">New</span></span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.view.lead.create') }}">Create Data</a></li>
                    <li><a href="{{ route('admin.view.lead.import') }}">Import Data</a></li>
                    <li><a href="datagroups.html">Data Groups</a></li>
                    <li><a href="email-template.html">Campaigns</a></li>
                </ul>
            </li>
            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-info-circle"></i>
                    <span class="nav-text">Work</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="app-profile.html">Plan</a></li>
                    <li><a href="edit-profile.html">Package</a></li>
                </ul>
            </li>
            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-chart-line"></i>
                    <span class="nav-text">Management</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="chart-flot.html">Cashflow</a></li>
                    <li><a href="{{ route('admin.view.admin.list') }}">Admin Access</a></li>
                    <li><a href="chart-chartjs.html">Settings</a></li>
                </ul>
            </li>
            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fab fa-bootstrap"></i>
                    <span class="nav-text">Customers</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="ui-accordion.html">Manage Customers</a></li>
                    <li><a href="ui-alert.html">Customer Projects</a></li>
                    <li><a href="ui-badge.html">Domain & Hosting</a></li>
                    <li><a href="ui-button.html">Payment & Bills</a></li>
                    <li><a href="ui-modal.html">Paassword Manager</a></li>
                </ul>
            </li>
            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-heart"></i>
                    <span class="nav-text">Employees</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="uc-select2.html">Manage Employees</a></li>
                    <li><a href="uc-nestable.html">Task Manager</a></li>
                </ul>
            </li>
            <li><a href="widget-basic.html" aria-expanded="false">
                    <i class="fas fa-user"></i>
                    <span class="nav-text">Settings</span>
                </a>
            </li>

            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-clone"></i>
                    <span class="nav-text">Pages</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="page-login.html">Login</a></li>
                    <li><a href="page-register.html">Register</a></li>
                </ul>
            </li>
        </ul>


        <div class="copyright">
            <p>Makku Enterprises © 2025 All Rights Reserved</p>
            <p class="fs-12">Made with <span class="heart"></span> by Adzquare</p>
        </div>
    </div>
</div>
<!--**********************************
            Sidebar end
        ***********************************-->
