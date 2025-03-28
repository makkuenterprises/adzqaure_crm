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
    x-id="['notification-dropdown-button']">
    <div>
        <button 
            x-ref="button" 
            x-on:click="toggle()" 
            type="button"
            :class=" open ? 'border-admin-ascent text-admin-ascent bg-slate-100' : 'border-slate-400 text-slate-300 bg-transparent' "
            class="md:h-[50px] md:w-[50px] sm:h-[40px] sm:w-[40px] flex items-center justify-center overflow-hidden rounded-full md:border-4 sm:border-2">
            <i data-feather="bell" class="h-5 w-5 md:stroke-[3px] sm:stroke-2"></i>
        </button>
    </div>
    <div 
        x-ref="panel" 
        x-show="open" 
        x-transition.origin.top.right x-on:click.outside="close($refs.button)"
        :id="$id('notification-dropdown-button')" 
        style="display: none;"
        class="absolute border md:right-0 sm:right-[-72px] z-10 md:mt-2 sm:mt-7 md:w-auto sm:w-screen origin-top-right rounded-md bg-white border-slate-300 shadow-lg overflow-hidden">
        <div class="p-5 border-b">
            <h1 class="text-lg font-semibold">Notifications</h1>
            <p class="text-xs text-slate-500">You have 4 unread notifications</p>
        </div>
        <ul class="flex flex-col">
            @for ($i = 1; $i < 5; $i++)
            <li>
                <a href="#" class="notification-item">
                    <div class="notification-body">
                        <div class="icon"><i data-feather="shopping-bag"></i></div>
                        <div class="content">
                            <div>
                                <h1 class="title">Order Arrived</h1>
                                <p class="time">18 min ago</p>
                            </div>
                            
                            <p class="description"> Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                        </div>
                    </div>
                </a>
            </li> 
            @endfor
           
        </ul>
        <div class="px-5 py-3 border-b">
            <a href="#" class="link"><i data-feather="mail" class="h-4 w-4 mr-1"></i> Mark all as read</a>
        </div>
    </div>
</div>
