<div class="relative" 
    x-data="{
        open: false,
        toggle() {
            if (this.open) {
                return this.close()
            }
            this.$refs.button.focus()
            this.open = true
        },
        close(focusAfter) {
            if (!this.open) return
            this.open = false
            focusAfter && focusAfter.focus()
        }
    }" 
    x-on:keydown.escape.prevent.stop="close($refs.button)"
    x-on:focusin.window="! $refs.panel.contains($event.target) && close()" 
    x-id="['profile-dropdown-button']">
    <div>
        <button 
            x-ref="button" 
            x-on:click="toggle()" 
            x-tra
            type="button"
            :class=" open ? 'border-admin-ascent' : 'border-slate-400' "
            class="md:h-[50px] md:w-[50px] sm:h-[40px] sm:w-[40px] flex items-center justify-center overflow-hidden rounded-full md:border-4 sm:border-2 bg-white">
            <img src="{{ is_null(auth()->user('employee')->profile) ? asset('admin/images/default-profile.png') : asset('storage/'.auth()->user('employee')->profile) }}" alt="profile"
                class="h-full w-fullrounded-ful" />
        </button>
    </div>
    <div 
        x-ref="panel" 
        x-show="open" 
        x-transition.origin.top.right x-on:click.outside="close($refs.button)"
        :id="$id('profile-dropdown-button')" 
        style="display: none;"
        class="absolute border md:right-0 sm:right-[-20px] z-10 md:mt-2 sm:mt-7 md:w-auto sm:w-screen origin-top-right rounded-md bg-white border-slate-300 shadow-lg overflow-hidden p-5 space-y-5 text-left">

        <button class="flex items-center justify-start w-auto space-x-3">
            <div class="w-[50px] h-[50px] rounded-full border overflow-hidden">
                <img src="{{ is_null(auth()->user('employee')->profile) ? asset('admin/images/default-profile.png') : asset('storage/'.auth()->user('employee')->profile) }}" alt="profile" class="h-full w-full" />
            </div>
            <div class="whitespace-nowrap text-left">
                <h1 class="font-semibold text-base mb-[1px]">{{auth()->user()->name}}</h1>
                <h1 class="text-slate-700 text-xs">{{auth()->user()->email}}</h1>
            </div>
        </button>

        <hr />

        <ul class="flex flex-col space-y-4">
            <li>
                <a href="{{route('employee.view.setting')}}"
                    class="text-sm font-medium text-slate-800 hover:text-admin-ascent-dark whitespace-nowrap flex items-center justify-start">
                    <i data-feather="settings" class="mr-2 h-5 w-5"></i> Account Settings
                </a>
            </li>
            <li><form action="{{route('logout')}}" id="logout-form" method="POST">@csrf</form>
                <a onclick="handleLogout()"
                    class="text-sm font-medium text-slate-800 hover:text-admin-ascent-dark whitespace-nowrap flex items-center justify-start cursor-pointer">
                    <i data-feather="log-out" class="mr-2 h-5 w-5"></i> Logout
                </a>
                <script>
                    function handleLogout() {
                        swal({
                            title: "Are you sure?",
                            text: "Once you clicked you will logged out!",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                $('#logout-form').submit();
                            }
                        });
                    }
                </script>
            </li>
        </ul>

    </div>
</div>
