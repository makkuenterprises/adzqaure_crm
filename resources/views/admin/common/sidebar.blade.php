<aside id="sidebar">
    <div
        class="sticky top-0 left-0 h-[125vh] flex flex-col justify-start shadow-xl bg-white border-r py-8 px-8 space-y-7 overflow-y-auto hide-scrollbar">
        <div class="text-center">
            <div>
                <img src="{{asset('admin/images/logo.png')}}" alt="makku enterprises" class="h-[100px] w-auto mx-auto">   
            </div>
            <h1 class="text-xl font-bold mb-1">Admin Panel</h1>
            <p class="text-xs text-slate-600">Makku Enterprises Pvt Ltd</p>
        </div>
        <hr>
        <ul class="flex flex-col space-y-6">


            <li>
                <a href="{{ route('admin.view.dashboard') }}" class="sidebar-tab" id="dashboard-tab"> <i
                        data-feather="activity"></i><span>Dashboard</span></a>
            </li>
            <li>
                <a href="{{ route('admin.view.employee.list') }}" class="sidebar-tab" id="employee-tab"> <i
                        data-feather="user"></i> <span>Team Members</span></a>
            </li>
            <hr>
            <li x-data="{ open: false }">
                <a href="javascript:void(0);" @click="open = ! open" class="sidebar-tab" id="lead-management-tab">
                    <i data-feather="list"></i> <span>Leads Management</span>
                </a>
                <ul class="pl-4 ml-2 border-l-slate-300 space-y-3 border-l-2 mt-5" x-show="open" style="display: none;">
                    <li>
                        <a href="{{ route('admin.view.lead.create') }}" class="sidebar-tab" id="create-lead-tab">  <span>Create Lead</span></a>
                    </li>
                    <li>
                        <a href="{{ route('admin.view.lead.import') }}" class="sidebar-tab" id="import-lead-tab">  <span>Import Lead</span></a>
                    </li>
                    <li>
                        <a href="{{ route('admin.view.group.list') }}" class="sidebar-tab" id="group-tab"> <span>Groups</span></a>
                    </li>
                    <li>
                        <a href="{{ route('admin.view.campaign.list') }}" class="sidebar-tab" id="campaign-tab"><span>Campaign</span></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('admin.view.customer.list') }}" class="sidebar-tab" id="customer-tab"> <i
                        data-feather="user"></i> <span>Customers</span></a>
            </li>
            <li>
                <a href="{{ route('admin.view.project.list') }}" class="sidebar-tab" id="project-tab"> <i
                        data-feather="pie-chart"></i> <span>Projects</span></a>
            </li>
            <li>
                <a href="{{ route('admin.view.payment.list') }}" class="sidebar-tab" id="payment-tab"> <i
                        data-feather="dollar-sign"></i> <span>Cash Flow</span></a>
            </li>
            <li>
                <a href="{{ route('admin.view.bill.list') }}" class="sidebar-tab" id="bill-tab"> <i
                        data-feather="clipboard"></i> <span>Billing</span></a>
            </li>
            <li>
                <a href="{{ route('admin.view.plan.list') }}" class="sidebar-tab" id="plan-tab"> <i
                        data-feather="layers"></i> <span>Plans</span></a>
            </li>
            <li>
                <a href="{{ route('admin.view.package.list') }}" class="sidebar-tab" id="package-tab"> <i
                        data-feather="box"></i> <span>Packages</span></a>
            </li>
            <li>
                <a href="{{route('admin.view.password.list')}}" class="sidebar-tab" id="password-tab"> <i data-feather="key"></i> <span>Password Manager</span></a>
            </li>
            <li>
                <a href="{{route('admin.view.domain.hosting.list')}}" class="sidebar-tab" id="domain-hosting-tab"> <i data-feather="server"></i> <span>Domain Hosting</span></a>
            </li>
            <li>
                <a href="{{route('admin.view.admin.list')}}" class="sidebar-tab" id="admin-tab"> <i data-feather="shield"></i> <span>Admin Access</span></a>
            </li>
            <li>
                <a href="{{ route('admin.view.setting') }}" class="sidebar-tab" id="setting-tab"> <i
                        data-feather="settings"></i> <span>Setting</span></a>
            </li>
            <li class="md:hidden sm:block">
                <a href="javascript:void(0);" onclick="$('#sidebar').toggleClass('active')" class="sidebar-tab" id="setting-tab"> <i
                        data-feather="x-circle"></i> <span>Close Sidebar</span></a>
            </li>

        </ul>
    </div>
</aside>
