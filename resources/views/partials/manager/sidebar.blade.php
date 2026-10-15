    <aside class="hidden lg:flex w-[285px] h-screen sticky top-0 bg-[#003260] text-white flex-col justify-between p-5 rounded-l-[16px] shadow-2xl">

        <div>

            <!-- Brand -->

            <div class="flex items-center gap-3 mb-10">

                <div class="w-12 h-12 rounded-2xl bg-[#e5e2dd] flex items-center justify-center">

                    <img src="{{ asset('img/modir-logo.png') }}" alt="مدیر خوب">

                </div>

                <div>
                    <h1 class="text-xl modir-bold">مدیر خوب</h1>
                    <p class="text-xs text-white/50">مدیریت ساختمان</p>
                </div>

            </div>

            <!-- Navigation -->

            <nav class="space-y-2">

                <!-- Dashboard -->

                <a href="{{ route('manager.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl transition
                    {{ request()->routeIs('manager.dashboard') ? 'bg-white/10 text-white' : 'hover:bg-white/5' }}">

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-layout-dashboard">

                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />

                        <path d="M5 4h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1" />
                        <path d="M5 16h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1" />
                        <path d="M15 12h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1" />
                        <path d="M15 4h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1" />

                    </svg>

                    <span>داشبورد</span>

                </a>


                <!-- Units -->

                <a href="{{ route('manager.units') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl transition
                    {{ request()->routeIs('manager.units') ? 'bg-white/10 text-white' : 'hover:bg-white/5' }}">

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-building-community">

                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />

                        <path d="M8 9l5 5v7h-5v-4m0 4h-5v-7l5 -5m1 1v-6a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v17h-8" />

                        <path d="M13 7l0 .01" />
                        <path d="M17 7l0 .01" />
                        <path d="M17 11l0 .01" />
                        <path d="M17 15l0 .01" />

                    </svg>

                    <span>واحدها</span>

                </a>


                <!-- Charges -->

                <a href="{{ route('manager.charges') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl transition
                    {{ request()->routeIs('manager.charges') ? 'bg-white/10 text-white' : 'hover:bg-white/5' }}">

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-credit-card">

                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />

                        <path d="M3 8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3l0 -8" />
                        <path d="M3 10l18 0" />
                        <path d="M7 15l.01 0" />
                        <path d="M11 15l2 0" />

                    </svg>

                    <span>شارژ ساختمان</span>

                </a>


                <!-- Bills & Expenses -->

                <a href="{{ route('manager.bills') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl transition
                    {{ request()->routeIs('manager.bills') ? 'bg-white/10 text-white' : 'hover:bg-white/5' }}">

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-invoice">

                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />

                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />

                        <path d="M19 12v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-14a2 2 0 0 1 2 -2h7l5 5v4.25" />

                    </svg>

                    <span>قبوض و هزینه‌ها</span>

                </a>


                <!-- Reports -->

                <a href="{{ route('manager.reports') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl transition
                    {{ request()->routeIs('manager.reports') ? 'bg-white/10 text-white' : 'hover:bg-white/5' }}">

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-chart-histogram">

                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />

                        <path d="M3 3v18h18" />
                        <path d="M20 18v3" />
                        <path d="M16 16v5" />
                        <path d="M12 13v8" />
                        <path d="M8 16v5" />
                        <path d="M3 11c6 0 5 -5 9 -5s3 5 9 5" />

                    </svg>

                    <span>گزارش‌ها</span>

                </a>


                <!-- Notifications - Later -->

                <!-- <a href="#"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-white/5 transition">

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-bell">

                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />

                        <path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />

                        <path d="M9 17v1a3 3 0 0 0 6 0v-1" />

                    </svg>

                    <span>اطلاعیه‌ها</span>

                </a> -->


                <!-- Settings - Later -->

                <!-- <a href="#"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-white/5 transition">

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-settings">

                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />

                        <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 .826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 .426 -1.756 2.924 0 3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065" />

                        <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />

                    </svg>

                    <span>تنظیمات</span>

                </a> -->

            </nav>

        </div>


        <!-- User -->

        <div class="bg-white/8 rounded-3xl p-4">

            <div class="flex items-center gap-3">

                <div class="w-12 h-12 rounded-full bg-[#e5e2dd] text-[#003260] flex items-center justify-center font-bold">

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="currentColor"
                        class="icon icon-tabler icons-tabler-filled icon-tabler-user">

                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />

                        <path d="M12 2a5 5 0 1 1 -5 5l.005 -.217a5 5 0 0 1 4.995 -4.783z" />

                        <path d="M14 14a5 5 0 0 1 5 5v1a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-1a5 5 0 0 1 5 -5h4z" />

                    </svg>

                </div>

                <div class="min-w-0">

                    <h3 class="text-sm modir-bold truncate">
                        {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                    </h3>

                    <p class="text-xs text-white/50">
                        مدیر ساختمان
                    </p>

                </div>

            </div>


            <!-- Logout -->

            <div class="mt-4 pt-4 border-t border-white/10">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-2xl text-white/65 hover:text-white hover:bg-white/5 transition-colors cursor-pointer"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="21"
                            height="21"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M10 17l5-5-5-5" />
                            <path d="M15 12H3" />
                            <path d="M21 19V5a2 2 0 0 0-2-2h-6" />
                        </svg>

                        <span class="text-sm font-medium">
                            خروج از حساب
                        </span>

                    </button>

                </form>

            </div>

        </div>

    </aside>