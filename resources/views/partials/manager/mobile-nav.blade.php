<nav class="lg:hidden fixed -bottom-1 -left-1 -right-1 bg-[#003260] px-4 py-2 flex justify-between items-center shadow-2xl z-50">

    {{-- واحدها --}}
    <a href="{{ route('manager.units') }}"
       class="flex flex-col items-center gap-1 text-white">

        <svg xmlns="http://www.w3.org/2000/svg"
             width="24"
             height="24"
             viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="1.5"
             stroke-linecap="round"
             stroke-linejoin="round"
             class="icon icon-tabler icons-tabler-outline icon-tabler-building-community text-white">

            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M8 9l5 5v7h-5v-4m0 4h-5v-7l5 -5m1 1v-6a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v17h-8" />
            <path d="M13 7l0 .01" />
            <path d="M17 7l0 .01" />
            <path d="M17 11l0 .01" />
            <path d="M17 15l0 .01" />

        </svg>

    </a>


    {{-- شارژ --}}
    <a href="{{ route('manager.charges') }}"
       class="flex flex-col items-center gap-1 text-white">

        <svg xmlns="http://www.w3.org/2000/svg"
             width="24"
             height="24"
             viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="1.5"
             stroke-linecap="round"
             stroke-linejoin="round"
             class="icon icon-tabler icons-tabler-outline icon-tabler-invoice text-white">

            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
            <path d="M19 12v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-14a2 2 0 0 1 2 -2h7l5 5v4.25" />

        </svg>

    </a>


    {{-- داشبورد --}}
    <a href="{{ route('manager.dashboard') }}"
       class="flex flex items-center justify-center gap-1 bg-white text-[#003260] w-14 h-14 rounded-2xl shadow-xl">

        <svg xmlns="http://www.w3.org/2000/svg"
             width="24"
             height="24"
             viewBox="0 0 24 24"
             fill="currentColor"
             class="icon icon-tabler icons-tabler-filled icon-tabler-layout-dashboard">

            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M9 3a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2zm0 12a2 2 0 0 1 2 2v2a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2 -2v-2a2 2 0 0 1 2 -2zm10 -4a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2zm0 -8a2 2 0 0 1 2 2v2a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2 -2v-2a2 2 0 0 1 2 -2z" />

        </svg>

    </a>


    {{-- قبض‌ها --}}
    <a href="{{ route('manager.bills') }}"
       class="flex flex-col items-center gap-1 text-white">

        <svg xmlns="http://www.w3.org/2000/svg"
             width="24"
             height="24"
             viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="1.5"
             stroke-linecap="round"
             stroke-linejoin="round"
             class="icon icon-tabler icons-tabler-outline icon-tabler-credit-card">

            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M3 8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3l0 -8" />
            <path d="M3 10l18 0" />
            <path d="M7 15l.01 0" />
            <path d="M11 15l2 0" />

        </svg>

    </a>


    {{-- گزارش‌ها --}}
    <a href="{{ route('manager.reports') }}"
       class="flex flex-col items-center gap-1 text-white">

        <svg xmlns="http://www.w3.org/2000/svg"
             width="24"
             height="24"
             viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="1.5"
             stroke-linecap="round"
             stroke-linejoin="round"
             class="icon icon-tabler icons-tabler-outline icon-tabler-chart-histogram">

            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M3 3v18h18" />
            <path d="M20 18v3" />
            <path d="M16 16v5" />
            <path d="M12 13v8" />
            <path d="M8 16v5" />
            <path d="M3 11c6 0 5 -5 9 -5s3 5 9 5" />

        </svg>

    </a>

</nav>