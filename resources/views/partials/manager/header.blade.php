        <!-- Mobile Header -->
        <header id="mobileHeader" class="lg:hidden sticky top-0 z-50 bg-white/90 backdrop-blur-xl border-b border-[#003260]/5 px-5 py-4 transition-transform duration-300">

            <div class="flex items-center justify-between">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center">
                        <img
                            src="{{ asset('img/modir-logo.png') }}"
                            alt="مدیر خوب"
                            class="w-10 h-10 object-contain"
                        >
                    </div>

                    <div>
                        <h2 class="modir-bold text-lg">مدیر خوب</h2>
                        <p class="text-[11px] text-gray-500">سامانه مدیریت ساختمان</p>
                    </div>

                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center text-red-500 hover:bg-red-100 transition-colors cursor-pointer"
                        title="خروج از حساب"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="20"
                            height="20"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M10 17l5-5-5-5" />
                            <path d="M15 12H3" />
                            <path d="M21 19V5a2 2 0 0 0-2-2h-6" />
                        </svg>
                    </button>
                </form>

            </div>

        </header>

        <!-- Desktop Header -->
        <header class="hidden lg:flex justify-between items-center px-8 py-6">

            <div>

                <p class="text-sm text-gray-500 mb-1">
                    مدیر ساختمان: {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                </p>

                <h2 class="text-3xl modir-bold">
                    {{ auth()->user()->buildings()->first()?->name ?? 'نام ساختمان' }}
                </h2>

            </div>

            <div class="flex items-center gap-4">

                <!-- Search -->

                <!-- <div class="relative">

                    <input type="text"
                        placeholder="جستجو در واحدها، پرداخت‌ها، ساکنین..."
                        class="w-[330px] bg-white rounded-2xl pr-12 pl-5 py-3 border border-[#003260]/10 focus:border-[#003260]/30 outline-none">

                    <div class="absolute right-4 top-3.5 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 10a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                            <path d="M21 21l-6 -6" />
                        </svg>
                    </div>

                </div> -->

                <button class="w-12 h-12 rounded-2xl bg-white flex items-center justify-center shadow-sm text-[#003260] cursor-pointer">
                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'><title>تنظیمات</title><g id="settings_5_line" fill='none' fill-rule='evenodd'><path d='M24 0v24H0V0zM12.593 23.258l-.011.002-.071.035-.02.004-.014-.004-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01-.017.428.005.02.01.013.104.074.015.004.012-.004.104-.074.012-.016.004-.017-.017-.427c-.002-.01-.009-.017-.017-.018m.265-.113-.013.002-.185.093-.01.01-.003.011.018.43.005.012.008.007.201.093c.012.004.023 0 .029-.008l.004-.014-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014-.034.614c0 .012.007.02.017.024l.015-.002.201-.093.01-.008.004-.011.017-.43-.003-.012-.01-.01z'/><path fill='#003260FF' d='M14.41 2.293a9.946 9.946 0 0 1 2.75 1.14 1 1 0 0 1 .47 1.019c-.113.689.059 1.216.38 1.538.322.322.85.493 1.538.38a1 1 0 0 1 1.02.47 9.948 9.948 0 0 1 1.14 2.75 1 1 0 0 1-.388 1.054c-.568.407-.82.9-.82 1.356 0 .456.252.95.82 1.357a1 1 0 0 1 .388 1.053 9.947 9.947 0 0 1-1.14 2.75 1 1 0 0 1-1.02.47c-.689-.113-1.215.059-1.537.38-.322.322-.494.85-.38 1.538a1 1 0 0 1-.47 1.02 9.948 9.948 0 0 1-2.752 1.14 1 1 0 0 1-1.053-.388c-.406-.568-.9-.82-1.356-.82-.455 0-.95.252-1.356.82a1 1 0 0 1-1.053.388 9.948 9.948 0 0 1-2.752-1.14 1 1 0 0 1-.47-1.02c.114-.688-.057-1.215-.38-1.537-.321-.322-.848-.494-1.537-.38a1 1 0 0 1-1.019-.47 9.947 9.947 0 0 1-1.14-2.752 1 1 0 0 1 .388-1.053c.567-.406.82-.9.82-1.356 0-.455-.253-.95-.82-1.356a1 1 0 0 1-.388-1.053 9.946 9.946 0 0 1 1.14-2.751 1 1 0 0 1 1.019-.47c.689.113 1.216-.058 1.538-.38.322-.322.493-.85.38-1.538a1 1 0 0 1 .47-1.019 9.947 9.947 0 0 1 2.75-1.14 1 1 0 0 1 1.054.388c.407.567.9.82 1.356.82.456 0 .95-.253 1.357-.82a1 1 0 0 1 1.053-.388m.102 2.11C13.855 5.06 12.992 5.5 12 5.5s-1.855-.439-2.512-1.098a7.944 7.944 0 0 0-1.084.45c.001.93-.299 1.85-1 2.552-.701.701-1.622 1.001-2.552 1-.176.348-.326.71-.45 1.084.659.657 1.098 1.52 1.098 2.512s-.439 1.855-1.098 2.512c.124.374.275.737.45 1.085.93-.002 1.85.298 2.552 1 .701.7 1.001 1.621 1 2.551.347.176.71.326 1.084.45.657-.659 1.52-1.098 2.512-1.098s1.855.44 2.512 1.098a7.943 7.943 0 0 0 1.085-.45c-.002-.93.298-1.85 1-2.552.7-.701 1.621-1 2.551-1 .176-.347.326-.71.45-1.084-.659-.657-1.098-1.52-1.098-2.512s.44-1.855 1.098-2.512a7.94 7.94 0 0 0-.45-1.084c-.93.001-1.85-.299-2.552-1-.701-.701-1-1.622-1-2.552a7.945 7.945 0 0 0-1.084-.45ZM12 8a4 4 0 1 1 0 8 4 4 0 0 1 0-8m0 2a2 2 0 1 0 0 4 2 2 0 0 0 0-4'/></g></svg>
                </button>

                <button class="w-12 h-12 rounded-2xl bg-[#003260] flex items-center justify-center text-white shadow-sm cursor-pointer">
                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'><title>اطلاعیه</title><g id="mail_line" fill='none'><path d='M24 0v24H0V0zM12.593 23.258l-.011.002-.071.035-.02.004-.014-.004-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01-.017.428.005.02.01.013.104.074.015.004.012-.004.104-.074.012-.016.004-.017-.017-.427c-.002-.01-.009-.017-.017-.018m.265-.113-.013.002-.185.093-.01.01-.003.011.018.43.005.012.008.007.201.093c.012.004.023 0 .029-.008l.004-.014-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014-.034.614c0 .012.007.02.017.024l.015-.002.201-.093.01-.008.004-.011.017-.43-.003-.012-.01-.01z'/><path fill='#FFFFFFFF' d='M20 4a2 2 0 0 1 1.995 1.85L22 6v12a2 2 0 0 1-1.85 1.995L20 20H4a2 2 0 0 1-1.995-1.85L2 18V6a2 2 0 0 1 1.85-1.995L4 4zm0 3.414-6.94 6.94a1.5 1.5 0 0 1-2.12 0L4 7.414V18h16zM18.586 6H5.414L12 12.586z'/></g></svg>
                    </svg>
                </button>

            </div>

        </header>

        <!-- Mobile Search -->
        <!-- <div class="lg:hidden px-5 mt-5">

            <div class="relative">

                <input type="text"
                    placeholder="جستجو..."
                    class="w-full bg-white rounded-2xl pr-12 pl-4 py-3 border border-[#003260]/10 outline-none">

                <div class="absolute right-4 top-3.5 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 10a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                        <path d="M21 21l-6 -6" />
                    </svg>
                </div>

            </div>

        </div> -->