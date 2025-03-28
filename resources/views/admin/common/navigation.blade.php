<header class="bg-white top-0 shadow-lg fixed z-20 w-full md:border-b" id="top-navigation">
    <nav class="md:block sm:hidden">
        <div class="py-6 md:px-10 sm:px-5">
            <div class="flex items-center justify-between">
                <div>
                    <ul class="flex space-x-1">

                        <li class="navigation-tab"><a href="{{ route('admin.view.dashboard') }}">Dashboard</a></li>

                        <li class="navigation-tab" :class="open ? 'active' : ''" x-data="{
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
                            x-id="['dashboard-dropdown-button']">

                            <button x-ref="button" x-on:click="toggle()">
                                Data Records <i data-feather="chevron-down" class="ml-1 toggler-icon"></i>
                            </button>

                            <div class="navigation-tab-dropdown-menu" x-ref="panel" x-show="open"
                                x-transition.origin.top x-on:click.outside="close($refs.button)"
                                :id="$id('dashboard-dropdown-button')" style="display: none;">
                                <ul>
                                    <li><a href="{{ route('admin.view.lead.create') }}"
                                            class="dropdown-link-primary">Create Data</a></li>
                                    <li><a href="{{ route('admin.view.lead.import') }}"
                                            class="dropdown-link-primary">Import Data</a></li>
                                    <li><a href="{{ route('admin.view.group.list') }}"
                                            class="dropdown-link-primary">Data Groups</a></li>
                                    <li><a href="{{ route('admin.view.campaign.list') }}"
                                            class="dropdown-link-primary">Campaigns</a></li>

                                </ul>
                            </div>
                        </li>

                        <li class="navigation-tab" :class="open ? 'active' : ''" x-data="{
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
                            x-id="['dashboard-dropdown-button']">

                            <button x-ref="button" x-on:click="toggle()">
                                Work <i data-feather="chevron-down" class="ml-1 toggler-icon"></i>
                            </button>

                            <div class="navigation-tab-dropdown-menu" x-ref="panel" x-show="open"
                                x-transition.origin.top x-on:click.outside="close($refs.button)"
                                :id="$id('dashboard-dropdown-button')" style="display: none;">
                                <ul>


                                    <li><a href="{{ route('admin.view.plan.list') }}"
                                            class="dropdown-link-primary">Plan</a></li>
                                    <li><a href="{{ route('admin.view.package.list') }}"
                                            class="dropdown-link-primary">Packages</a></li>


                                </ul>
                            </div>
                        </li>



                        <li class="navigation-tab" :class="open ? 'active' : ''" x-data="{
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
                            x-id="['dashboard-dropdown-button']">

                            <button x-ref="button" x-on:click="toggle()">
                                Management <i data-feather="chevron-down" class="ml-1 toggler-icon"></i>
                            </button>

                            <div class="navigation-tab-dropdown-menu" x-ref="panel" x-show="open"
                                x-transition.origin.top x-on:click.outside="close($refs.button)"
                                :id="$id('dashboard-dropdown-button')" style="display: none;">
                                <ul>
                                    <li><a href="{{ route('admin.view.payment.list') }}"
                                            class="dropdown-link-primary">Cashflow</a></li>
                                    <li><a href="{{ route('admin.view.admin.list') }}"
                                            class="dropdown-link-primary">Admin Access</a></li>
                                    <li><a href="{{ route('admin.view.setting') }}"
                                            class="dropdown-link-primary">Settings</a></li>
                                </ul>
                            </div>

                        </li>

                        <li class="navigation-tab" :class="open ? 'active' : ''" x-data="{
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
                            x-id="['dashboard-dropdown-button']">

                            <button x-ref="button" x-on:click="toggle()">
                                Customers <i data-feather="chevron-down" class="ml-1 toggler-icon"></i>
                            </button>

                            <div class="navigation-tab-dropdown-menu" x-ref="panel" x-show="open"
                                x-transition.origin.top x-on:click.outside="close($refs.button)"
                                :id="$id('dashboard-dropdown-button')" style="display: none;">
                                <ul>
                                    <li><a href="{{ route('admin.view.customer.list') }}"
                                            class="dropdown-link-primary">Manage Customers</a></li>
                                    <li><a href="{{ route('admin.view.project.list') }}"
                                            class="dropdown-link-primary">Customer Projects</a></li>
                                    <li><a href="{{ route('admin.view.domain.hosting.list') }}"
                                            class="dropdown-link-primary">Domain & Hosting</a></li>
                                    <li><a href="{{ route('admin.view.bill.list') }}"
                                            class="dropdown-link-primary">Payments & Bills</a></li>
                                    <li><a href="{{ route('admin.view.password.list') }}"
                                            class="dropdown-link-primary">Password Manager</a></li>

                                </ul>
                            </div>

                        </li>


                        <li class="navigation-tab" :class="open ? 'active' : ''" x-data="{
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
                            x-id="['dashboard-dropdown-button']">

                            <button x-ref="button" x-on:click="toggle()">
                                Employees <i data-feather="chevron-down" class="ml-1 toggler-icon"></i>
                            </button>

                            <div class="navigation-tab-dropdown-menu" x-ref="panel" x-show="open"
                                x-transition.origin.top x-on:click.outside="close($refs.button)"
                                :id="$id('dashboard-dropdown-button')" style="display: none;">
                                <ul>
                                    <li><a href="{{ route('admin.view.employee.list') }}"
                                            class="dropdown-link-primary">Manage Employees</a></li>
                                    <li><a href="javascript:void(0);" class="dropdown-link-primary">Task Manager</a>
                                    </li>


                                </ul>
                            </div>

                        </li>


                    </ul>
                </div>
                @include('admin.common.profile-dropdown')
            </div>
    </nav>

    <nav class="md:hidden sm:block">
        <div class="py-6 md:px-10 sm:px-5 border-b border-b-slate-300">
            <div class="flex items-center justify-between">
                <div>
                    <a href="{{ route('admin.view.dashboard') }}"
                        class="text-lg font-semibold text-admin-ascent">Adzquare</a>
                </div>
                <button>
                    <i data-feather="menu" onclick="$('#navigation-list-mobile').slideToggle(200)"></i>
                </button>
            </div>
        </div>
        <div class="py-4 px-5" style="display: none;" id="navigation-list-mobile">
            <ul class="flex flex-col">

                <li class="navigation-tab"><a href="{{ route('admin.view.dashboard') }}">Dashboard</a></li>
                <hr>
                <li class="navigation-tab" :class="open ? 'active' : ''" x-data="{
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
                    x-id="['dashboard-dropdown-button']">

                    <button x-ref="button" x-on:click="toggle()">
                        Data Records <i data-feather="chevron-down" class="ml-1 toggler-icon"></i>
                    </button>

                    <div class="navigation-tab-dropdown-menu" x-ref="panel" x-show="open" x-transition.origin.top
                        x-on:click.outside="close($refs.button)" :id="$id('dashboard-dropdown-button')"
                        style="display: none;">
                        <ul>
                            <li><a href="{{ route('admin.view.lead.create') }}" class="dropdown-link-primary">Create
                                    Data</a></li>
                            <li><a href="{{ route('admin.view.lead.import') }}" class="dropdown-link-primary">Import
                                    Data</a></li>
                            <li><a href="{{ route('admin.view.group.list') }}" class="dropdown-link-primary">Data
                                    Groups</a></li>
                            <li><a href="{{ route('admin.view.campaign.list') }}"
                                    class="dropdown-link-primary">Campaigns</a></li>
                        </ul>
                    </div>
                </li>
                <hr>
                <li class="navigation-tab" :class="open ? 'active' : ''" x-data="{
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
                    x-id="['dashboard-dropdown-button']">

                    <button x-ref="button" x-on:click="toggle()">
                        Work <i data-feather="chevron-down" class="ml-1 toggler-icon"></i>
                    </button>

                    <div class="navigation-tab-dropdown-menu" x-ref="panel" x-show="open" x-transition.origin.top
                        x-on:click.outside="close($refs.button)" :id="$id('dashboard-dropdown-button')"
                        style="display: none;">
                        <ul>


                            <li><a href="{{ route('admin.view.plan.list') }}" class="dropdown-link-primary">Plan</a>
                            </li>
                            <li><a href="{{ route('admin.view.package.list') }}"
                                    class="dropdown-link-primary">Packages</a></li>

                        </ul>
                    </div>
                </li>
                <hr>
                <li class="navigation-tab" :class="open ? 'active' : ''" x-data="{
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
                    x-id="['dashboard-dropdown-button']">

                    <button x-ref="button" x-on:click="toggle()">
                        Management <i data-feather="chevron-down" class="ml-1 toggler-icon"></i>
                    </button>

                    <div class="navigation-tab-dropdown-menu" x-ref="panel" x-show="open" x-transition.origin.top
                        x-on:click.outside="close($refs.button)" :id="$id('dashboard-dropdown-button')"
                        style="display: none;">
                        <ul>
                            <li><a href="{{ route('admin.view.payment.list') }}"
                                    class="dropdown-link-primary">Cashflow</a></li>
                            <li><a href="{{ route('admin.view.admin.list') }}" class="dropdown-link-primary">Admin
                                    Access</a></li>
                            <li><a href="{{ route('admin.view.setting') }}"
                                    class="dropdown-link-primary">Settings</a></li>
                        </ul>
                    </div>
                </li>
                <hr>
                <li class="navigation-tab" :class="open ? 'active' : ''" x-data="{
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
                    x-id="['dashboard-dropdown-button']">

                    <button x-ref="button" x-on:click="toggle()">
                        Customers <i data-feather="chevron-down" class="ml-1 toggler-icon"></i>
                    </button>

                    <div class="navigation-tab-dropdown-menu" x-ref="panel" x-show="open" x-transition.origin.top
                        x-on:click.outside="close($refs.button)" :id="$id('dashboard-dropdown-button')"
                        style="display: none;">
                        <ul>
                            <li><a href="{{ route('admin.view.customer.list') }}"
                                    class="dropdown-link-primary">Manage Customers</a></li>
                            <li><a href="{{ route('admin.view.project.list') }}"
                                    class="dropdown-link-primary">Customer Projects</a></li>
                            <li><a href="{{ route('admin.view.domain.hosting.list') }}"
                                    class="dropdown-link-primary">Domain & Hosting</a></li>
                            <li><a href="{{ route('admin.view.bill.list') }}" class="dropdown-link-primary">Payments
                                    & Bills</a></li>
                            <li><a href="{{ route('admin.view.password.list') }}"
                                    class="dropdown-link-primary">Password Manager</a></li>

                        </ul>
                    </div>
                </li>
                <hr>
                <li class="navigation-tab" :class="open ? 'active' : ''" x-data="{
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
                    x-id="['dashboard-dropdown-button']">

                    <button x-ref="button" x-on:click="toggle()">
                        Employees <i data-feather="chevron-down" class="ml-1 toggler-icon"></i>
                    </button>

                    <div class="navigation-tab-dropdown-menu" x-ref="panel" x-show="open" x-transition.origin.top
                        x-on:click.outside="close($refs.button)" :id="$id('dashboard-dropdown-button')"
                        style="display: none;">
                        <ul>
                            <li><a href="{{ route('admin.view.employee.list') }}"
                                    class="dropdown-link-primary">Manage Employees</a></li>
                            <li><a href="javascript:void(0);" class="dropdown-link-primary">Task Manager</a></li>
                        </ul>
                    </div>
                </li>
                <hr>
                <li class="navigation-tab"><button onclick="handleLogout()">Logout<i data-feather="log-out"
                            class="ml-1 toggler-icon"></i></button></li>


            </ul>
        </div>
    </nav>
</header>
