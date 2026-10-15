    {{-- Footer --}}
    <footer class="border-t border-[#003260]/10 bg-[#e5e2dd]">
        <div class="modir-container py-8 sm:py-10">
            <div class="flex flex-col items-center justify-between gap-6 sm:flex-row">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <span class="grid h-10 w-10 place-items-center rounded-xl bg-[#003260] text-white">
                        <svg width="23" height="23" viewBox="0 0 32 32" fill="none" aria-hidden="true">
                            <path d="M5 14.5 16 5l11 9.5V27H5V14.5Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                            <path d="M11 27V17h10v10M10 12h.1M16 12h.1M22 12h.1" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </span>
                    <span>
                        <span class="block text-sm font-black text-[#003260]">مدیر خوب</span>
                        <span class="mt-1 block text-[10px] font-bold text-[#718497]">سامانه مدیریت ساختمان</span>
                    </span>
                </a>

                <div class="flex flex-wrap justify-center gap-x-6 gap-y-3 text-xs font-bold text-[#62798d]">
                    <a href="#features" class="transition hover:text-[#003260]">امکانات</a>
                    <a href="#how-it-works" class="transition hover:text-[#003260]">نحوه کار</a>
                    <a href="{{ route('subscription') }}" class="transition hover:text-[#003260]">اشتراک‌ها</a>
                    <a href="{{ url('/login') }}" class="transition hover:text-[#003260]">ورود</a>
                </div>

                <p class="text-center text-[11px] font-semibold text-[#718497]">
                    © {{ date('Y') }} مدیر خوب؛ تمامی حقوق محفوظ است.
                </p>
            </div>
        </div>
    </footer>