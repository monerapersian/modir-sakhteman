    {{-- Header --}}
    <header class="fixed inset-x-0 top-0 z-50 px-3 pt-3 sm:px-5 sm:pt-5">
        <nav class="modir-container flex items-center justify-between gap-4 rounded-2xl border border-white/70 bg-[#ffffff] px-4 py-3 shadow-sm backdrop-blur-xl sm:px-6">
            <a href="{{ url('/') }}" class="flex shrink-0 items-center gap-3" aria-label="صفحه اصلی مدیر خوب">
                <span class="grid h-11 w-11 place-items-center rounded-[14px] bg-[#fff] text-white shadow-lg shadow-[#003260]/15">
                    <img src="{{ asset('img/modir-logo.png') }}">
                </span>
                <span>
                    <span class="block text-[17px] font-black tracking-tight text-[#003260]">مدیر خوب</span>
                    <span class="mt-0.5 block text-[10px] font-bold text-[#6c7f91]">سامانه مدیریت ساختمان</span>
                </span>
            </a>

            <div class="hidden items-center gap-8 lg:flex">
                <a class="modir-nav-link" href="#features">امکانات</a>
                <a class="modir-nav-link" href="#how-it-works">نحوه کار</a>
                <a class="modir-nav-link" href="#benefits">مزایای سامانه</a>
            </div>

            <div class="flex shrink-0 items-center gap-2">
                <a href="{{ url('/login') }}" class="hidden rounded-xl px-4 py-3 text-sm font-extrabold text-[#003260] transition hover:bg-white/70 sm:inline-flex">
                    ورود
                </a>
                <!-- <a href="{{ route('subscription') }}" class="inline-flex items-center gap-2 rounded-xl bg-[#003260] px-4 py-3 text-xs font-extrabold text-white shadow-lg shadow-[#003260]/10 transition hover:-translate-y-0.5 hover:bg-[#064779] sm:px-5 sm:text-sm modir-bold">
                    تهیه اشتراک
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M19 12H5m0 0 7 7m-7-7 7-7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a> -->
                <button id="mobileMenuButton" type="button" class="grid h-11 w-11 place-items-center rounded-xl border border-[#003260]/10 text-[#003260] lg:hidden" aria-label="باز کردن منو" aria-expanded="false">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>
        </nav>

        <div id="mobileMenu" class="modir-container mt-2 hidden rounded-2xl border border-white/80 bg-[#ffffff]/95 p-3 shadow-xl backdrop-blur-xl lg:hidden">
            <a class="block rounded-xl px-4 py-3 text-sm font-bold hover:bg-white/70" href="#features">امکانات سامانه</a>
            <a class="block rounded-xl px-4 py-3 text-sm font-bold hover:bg-white/70" href="#how-it-works">نحوه کار</a>
            <a class="block rounded-xl px-4 py-3 text-sm font-bold hover:bg-white/70" href="#benefits">مزایای سامانه</a>
            <a class="block rounded-xl px-4 py-3 text-sm font-bold hover:bg-white/70" href="{{ url('/login') }}">ورود به سامانه</a>
        </div>
    </header>