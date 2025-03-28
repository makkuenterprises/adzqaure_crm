<aside id="sidebar">
    <div
        class="sticky top-0 left-0 h-[125vh] flex flex-col justify-start shadow-xl bg-white border-r py-8 px-8 space-y-7 overflow-y-auto hide-scrollbar">
        <div class="text-center">
            <div>
                <img src="{{asset('admin/images/logo.png')}}" alt="makku enterprises" class="h-[100px] w-auto mx-auto">   
            </div>
            <h1 class="text-xl font-bold mb-1">Team Mamber</h1>
            <p class="text-xs text-slate-600">Makku Enterprises Pvt Ltd</p>
        </div>
        <hr>
        <ul class="flex flex-col space-y-6">


            <li>
                <a href="{{ route('employee.view.dashboard') }}" class="sidebar-tab" id="dashboard-tab"> <i
                        data-feather="activity"></i><span>Dashboard</span></a>
            </li>
            <hr>
            <li>
                <a href="{{ route('employee.view.campaign.list') }}" class="sidebar-tab" id="campaign-tab"> <i
                        data-feather="user"></i> <span>Campaigns</span></a>
            </li>
            <li>
                <a href="{{ route('employee.view.setting') }}" class="sidebar-tab" id="setting-tab"> <i
                        data-feather="settings"></i> <span>Setting</span></a>
            </li>
            <li class="md:hidden sm:block">
                <a href="javascript:void(0);" onclick="$('#sidebar').toggleClass('active')" class="sidebar-tab" id="setting-tab"> <i
                        data-feather="x-circle"></i> <span>Close Sidebar</span></a>
            </li>

        </ul>
    </div>
</aside>
