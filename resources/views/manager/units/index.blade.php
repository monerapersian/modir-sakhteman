@extends('layouts.manager')

@section('title', 'مدیر خوب - واحدها')

@section('content')

        <main class="flex-1 px-5 lg:px-8 pt-6 pb-28 lg:pb-8">

            <!-- Welcome Banner -->

            <!-- Hero | Units -->
            <section class="relative overflow-hidden rounded-[28px] bg-[#003260] text-white shadow-xl shadow-[#003260]/10">

                <!-- Decorative Elements -->
                <div class="absolute -top-20 -left-20 w-56 h-56 rounded-full bg-white/5"></div>
                <div class="absolute -bottom-24 right-1/4 w-72 h-72 rounded-full bg-white/5"></div>

                <div class="relative z-10 p-6 sm:p-8 lg:p-10">

                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">

                        <!-- Hero Content -->
                        <div class="flex items-start gap-4">

                            <!-- Icon -->
                            <div class="shrink-0 w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-white/10 border border-white/10 flex items-center justify-center">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="30"
                                     height="30"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.8"
                                     stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="w-7 h-7 sm:w-8 sm:h-8">
                                    <path d="M3 21l18 0" />
                                    <path d="M5 21v-14l8 -4v18" />
                                    <path d="M19 21v-10l-6 -4" />
                                    <path d="M9 9l0 .01" />
                                    <path d="M9 12l0 .01" />
                                    <path d="M9 15l0 .01" />
                                    <path d="M9 18l0 .01" />
                                    <path d="M13 9l0 .01" />
                                    <path d="M13 12l0 .01" />
                                    <path d="M13 15l0 .01" />
                                    <path d="M16 13l0 .01" />
                                    <path d="M16 16l0 .01" />
                                </svg>

                            </div>

                            <div>
                                <h1 class="modir-bold text-2xl sm:text-3xl lg:text-4xl leading-tight">
                                    واحدهای ساختمان
                                </h1>

                                <p class="mt-2 text-sm sm:text-base text-white/70 leading-7 max-w-xl">
                                    مدیریت و مشاهده اطلاعات واحدهای ساختمان و وضعیت فعلی هر واحد
                                </p>
                            </div>

                        </div>


                        <!-- Statistics -->
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 sm:gap-3 lg:min-w-[520px]">

                            <!-- Total Units -->
                            <div class="rounded-2xl bg-white/10 border border-white/10 px-3 py-4 sm:px-5 text-center backdrop-blur-sm">

                                <div class="text-2xl sm:text-3xl modir-bold">
                                    {{ faNumber($totalUnits) }}
                                </div>

                                <div class="mt-1 text-[11px] sm:text-xs text-white/60">
                                    کل واحدها
                                </div>

                            </div>


                            <!-- Unregistered -->
                            <div class="rounded-2xl bg-white/10 border border-white/10 px-3 py-4 sm:px-5 text-center backdrop-blur-sm">

                                <div class="text-2xl sm:text-3xl modir-bold">
                                    {{ faNumber($unregisteredUnits) }}
                                </div>

                                <div class="mt-1 text-[11px] sm:text-xs text-white/60">
                                    ثبت‌نشده
                                </div>

                            </div>


                            <!-- Occupied -->
                            <div class="rounded-2xl bg-white/10 border border-white/10 px-3 py-4 sm:px-5 text-center backdrop-blur-sm">

                                <div class="text-2xl sm:text-3xl modir-bold">
                                    {{ faNumber($occupiedUnits) }}
                                </div>

                                <div class="mt-1 text-[11px] sm:text-xs text-white/60">
                                    دارای ساکن
                                </div>

                            </div>


                            <!-- Empty -->
                            <div class="rounded-2xl bg-white/10 border border-white/10 px-3 py-4 sm:px-5 text-center backdrop-blur-sm">

                                <div class="text-2xl sm:text-3xl modir-bold">
                                    {{ faNumber($vacantUnits) }}
                                </div>

                                <div class="mt-1 text-[11px] sm:text-xs text-white/60">
                                    بدون ساکن
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </section>


            <!-- Search & Filters | Units -->
            <form id="unitFiltersForm"
                method="GET"
                action="{{ route('manager.units') }}">

                <section class="mt-6">

                    <div class="rounded-[28px] bg-white border border-[#003260]/5 shadow-sm p-5 sm:p-6">

                        <!-- Search -->
                        <div class="relative">

                            <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-[#003260]/45">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="24"
                                     height="24"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.8"
                                     stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="w-5 h-5">
                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                    <path d="M21 21l-6 -6" />
                                </svg>

                            </div>

                            <input
                                type="text"
                                id="unitSearch"
                                name="search"
                                value="{{ $search }}"
                                autocomplete="off"
                                placeholder="جستجوی شماره واحد یا نام ساکن..."
                                class="w-full h-14 rounded-2xl bg-[#e5e2dd]/45 border border-transparent pr-12 pl-4 text-sm sm:text-base text-[#003260] placeholder:text-[#003260]/40 outline-none transition focus:bg-white focus:border-[#003260]/20 focus:ring-4 focus:ring-[#003260]/5"
                            >
                        </div>


                        <!-- Filters -->
                        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">

                            <!-- Occupancy -->
                            <div class="relative">

                                <select
                                    id="occupancyFilter"
                                    name="occupancy"
                                    class="appearance-none w-full h-12 rounded-xl bg-[#e5e2dd]/45 border border-transparent pr-4 pl-10 text-sm text-[#003260] outline-none transition cursor-pointer focus:bg-white focus:border-[#003260]/20 focus:ring-4 focus:ring-[#003260]/5"
                                >
                                    <option value="" @selected($occupancy === '')>وضعیت سکونت: همه</option>
                                    <option value="occupied" @selected($occupancy === 'occupied')>دارای ساکن</option>
                                    <option value="empty" @selected($occupancy === 'empty')>بدون ساکن</option>
                                </select>

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="20"
                                     height="20"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.8"
                                     stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 pointer-events-none text-[#003260]/50">
                                    <path d="M6 9l6 6l6 -6" />
                                </svg>

                            </div>


                            <!-- Financial Status -->
                            <div class="relative">

                                <select
                                    id="debtFilter"
                                    name="financial"
                                    class="appearance-none w-full h-12 rounded-xl bg-[#e5e2dd]/45 border border-transparent pr-4 pl-10 text-sm text-[#003260] outline-none transition cursor-pointer focus:bg-white focus:border-[#003260]/20 focus:ring-4 focus:ring-[#003260]/5"
                                >
                                    <option value="" @selected($financial === '')>وضعیت مالی: همه</option>
                                    <option value="paid" @selected($financial === 'paid')>بدون بدهی</option>
                                    <option value="debt" @selected($financial === 'debt')>دارای بدهی</option>
                                </select>

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="20"
                                     height="20"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.8"
                                     stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 pointer-events-none text-[#003260]/50">
                                    <path d="M6 9l6 6l6 -6" />
                                </svg>

                            </div>

                        </div>


                        <!-- Bottom Row -->
                        <div class="mt-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                            <!-- Result Count -->
                            <div class="flex items-center gap-2 text-sm text-[#003260]/55">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="20"
                                     height="20"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.8"
                                     stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="w-4 h-4">
                                    <path d="M3 21l18 0" />
                                    <path d="M5 21v-14l8 -4v18" />
                                    <path d="M19 21v-10l-6 -4" />
                                </svg>

                                <span id="unitResultCount">
                                    نمایش {{ faNumber($units->total()) }} واحد
                                </span>

                            </div>


                            <!-- Clear Filters -->
                            <a
                                href="{{ route('manager.units') }}"
                                id="clearUnitFilters"
                                class="inline-flex items-center justify-center gap-2 h-10 px-4 rounded-xl text-sm text-[#003260]/65 hover:text-[#003260] hover:bg-[#e5e2dd]/60 transition cursor-pointer"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="20"
                                     height="20"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.8"
                                     stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="w-4 h-4">
                                    <path d="M18 6l-12 12" />
                                    <path d="M6 6l12 12" />
                                </svg>

                                پاک کردن فیلترها
                            </a>

                        </div>

                    </div>

                </section>
            </form>


            <!-- Units List -->
            <section id="unitsList" class="mt-6">

                <!-- Section Header -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">

                    <div>
                        <h2 class="modir-bold text-xl sm:text-2xl text-[#003260]">
                            لیست واحدها
                        </h2>

                        <p class="mt-1 text-sm text-[#003260]/55">
                            واحدهای ساختمان و وضعیت فعلی آن‌ها
                        </p>
                    </div>

                    <div class="flex items-center gap-3">

                        <div class="text-sm text-[#003260]/55">
                            {{ faNumber($registeredUnits) }} واحد فعال
                        </div>

                        <a
                            href="{{ route('manager.units.create') }}"
                            class="inline-flex items-center justify-center gap-2 h-11 px-5 rounded-xl bg-[#003260] text-white text-sm modir-bold hover:bg-[#003260]/90 transition shadow-sm"
                        >

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 width="20"
                                 height="20"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 stroke-linecap="round"
                                 stroke-linejoin="round"
                                 class="w-4 h-4">
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>

                            <span>
                                واحد جدید
                            </span>

                        </a>

                    </div>

                </div>


                <!-- Units Container -->
                <div class="rounded-[28px] bg-white border border-[#003260]/5 shadow-sm overflow-hidden">

                    <!-- Table Header -->
                    <div class="hidden lg:grid grid-cols-[110px_1.4fr_1.2fr_1fr] items-center gap-4 px-6 py-4 bg-[#e5e2dd]/35 border-b border-[#003260]/5 text-sm font-medium text-[#003260]/55">

                        <div class="border-l border-gray-300">
                            نام واحد
                        </div>

                        <div class="border-l border-gray-300">
                            ساکن
                        </div>

                        <div class="border-l border-gray-300">
                            شماره تماس
                        </div>

                        <div>
                            بدهی
                        </div>

                    </div>


                    <!-- Unit Row -->
                    @forelse($units as $unit)

                        <a href="{{ route('manager.units.show', $unit) }}"
                           class="group grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-[110px_1.4fr_1.2fr_1fr] gap-x-4 gap-y-4 lg:gap-4 items-center px-5 sm:px-6 py-5 border-b border-[#e5e2dd] last:border-b-0 hover:bg-[#e5e2dd]/25 transition cursor-pointer">

                            <!-- Unit Name -->
                            <div>

                                <div class="lg:hidden text-xs text-[#003260]/45 mb-1">
                                    واحد
                                </div>

                                <div class="h-11 px-2 rounded-xl bg-[#003260]/5 flex items-center justify-center text-[#003260] modir-bold">
                                    {{ faNumber($unit->unit_name) }}
                                </div>

                                <!-- <div class="lg:hidden">
                                    <div class="mt-0.5 text-m modir-bold text-[#003260]">
                                        {{ $unit->unit_name }}
                                    </div>
                                </div> -->

                            </div>


                            <!-- Resident -->
                            <div>

                                <div class="lg:hidden text-xs text-[#003260]/45 mb-1">
                                    ساکن
                                </div>

                                @php
                                    $currentResidency = $unit->residencies->first();
                                @endphp

                                @if($currentResidency)

                                    <div class="flex items-center gap-2">

                                        <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 bg-[#003260]/5 text-[#003260]">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 width="20"
                                                 height="20"
                                                 viewBox="0 0 24 24"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 stroke-width="1.8"
                                                 stroke-linecap="round"
                                                 stroke-linejoin="round"
                                                 class="w-4 h-4">
                                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                            </svg>

                                        </div>

                                        <div>
                                            <div class="text-m font-medium modir-bold text-[#003260]">
                                                {{ $currentResidency->name }}
                                            </div>

                                            <div class="text-xs text-emerald-600 mt-0.5">
                                                ساکن
                                            </div>
                                        </div>

                                    </div>

                                @else

                                    <div class="flex items-center gap-2">

                                        <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 bg-orange-50 text-orange-600">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 width="20"
                                                 height="20"
                                                 viewBox="0 0 24 24"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 stroke-width="1.8"
                                                 stroke-linecap="round"
                                                 stroke-linejoin="round"
                                                 class="w-4 h-4">
                                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                                <path d="M3 3l18 18" />
                                            </svg>

                                        </div>

                                        <div>
                                            <div class="text-m font-medium text-[#003260]/55 modir-bold">
                                                واحد فاقد ساکن می‌باشد
                                            </div>

                                            <div class="text-xs text-orange-600 mt-0.5">
                                                واحد خالی
                                            </div>
                                        </div>

                                    </div>

                                @endif

                            </div>


                            <!-- Phone -->
                            <div>

                                <div class="lg:hidden text-xs text-[#003260]/45 mb-1">
                                    شماره تماس
                                </div>

                                @php
                                    $currentResidency = $unit->residencies->first();
                                @endphp

                                @if($currentResidency && $currentResidency->phone)

                                    <div class="text-m text-[#003260] modir-bold">
                                        {{ faNumber($currentResidency->phone) }}
                                    </div>

                                @else

                                    <div class="text-m modir-bold text-[#003260]/25">
                                        —
                                    </div>

                                @endif

                            </div>


                            <!-- Debt -->
                            <div data-financial-status="{{ $unit->financial_status }}" class="unit-financial-status">
                                <div class="lg:hidden text-xs text-[#003260]/45 mb-1">
                                    وضعیت مالی
                                </div>

                                <div class="flex flex-col items-start gap-2">

                                    @if($unit->remaining_debt > 0)
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50 text-red-600 text-sm font-medium modir-bold">
                                            دارای بدهی
                                        </span>

                                        <span class="text-sm text-red-600 modir-bold">
                                            {{ faNumber(number_format($unit->remaining_debt)) }}
                                            تومان
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-600 text-sm font-medium modir-bold">
                                            تسویه کامل
                                        </span>
                                    @endif

                                </div>
                            </div>

                        </a>

                    @empty

                        <div class="px-6 py-12 text-center">

                            <!-- <div class="text-sm text-[#003260]/50">
                                هنوز هیچ واحدی در سیستم ثبت نشده است.
                            </div>

                            <a href="{{ route('manager.units.create') }}"
                               class="inline-flex items-center gap-2 mt-4 px-4 py-2.5 rounded-xl bg-[#003260] text-white text-sm modir-bold hover:bg-[#003260]/90 transition">
                                <span>واحد جدید</span>
                            </a> -->
                            @if(
                                $search !== ''
                                || $occupancy !== ''
                                || $financial !== ''
                            )
                                <div class="text-sm text-[#003260]/50">
                                    هیچ واحدی با جستجو و فیلترهای انتخاب‌شده پیدا نشد.
                                </div>

                                <a href="{{ route('manager.units') }}"
                                   class="inline-flex items-center gap-2 mt-4 px-4 py-2.5 rounded-xl bg-[#003260] text-white text-sm modir-bold hover:bg-[#003260]/90 transition">
                                    پاک کردن فیلترها
                                </a>
                            @else
                                <div class="text-sm text-[#003260]/50">
                                    هنوز هیچ واحدی در سیستم ثبت نشده است.
                                </div>

                                <a href="{{ route('manager.units.create') }}"
                                   class="inline-flex items-center gap-2 mt-4 px-4 py-2.5 rounded-xl bg-[#003260] text-white text-sm modir-bold hover:bg-[#003260]/90 transition">
                                    واحد جدید
                                </a>
                            @endif                        
                        </div>



                    @endforelse


                    <!-- Pagination -->
                    @if($units->count() > 0)

                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 px-5 sm:px-6 py-5 bg-[#e5e2dd]/20 border-t border-[#003260]/5">

                            <div class="text-sm text-[#003260]/50">
                                نمایش
                                <span class="text-[#003260] font-medium">
                                    {{ $units->firstItem() }}
                                </span>
                                تا
                                <span class="text-[#003260] font-medium">
                                    {{ $units->lastItem() }}
                                </span>
                                از
                                <span class="text-[#003260] font-medium">
                                    {{ $units->total() }}
                                </span>
                                واحد
                            </div>


                            <div class="flex items-center gap-1.5">

                                <!-- Previous -->
                                @if($units->onFirstPage())

                                    <span
                                        class="w-10 h-10 rounded-xl flex items-center justify-center text-[#003260]/20 cursor-not-allowed"
                                        aria-label="صفحه قبل"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="20"
                                             height="20"
                                             viewBox="0 0 24 24"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8"
                                             stroke-linecap="round"
                                             stroke-linejoin="round"
                                             class="w-4 h-4">
                                            <path d="M9 6l6 6l-6 6" />
                                        </svg>
                                    </span>

                                @else

                                    <a
                                        href="{{ $units->previousPageUrl() }}"
                                        class="w-10 h-10 rounded-xl flex items-center justify-center text-[#003260]/65 hover:bg-white hover:text-[#003260] transition"
                                        aria-label="صفحه قبل"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="20"
                                             height="20"
                                             viewBox="0 0 24 24"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8"
                                             stroke-linecap="round"
                                             stroke-linejoin="round"
                                             class="w-4 h-4">
                                            <path d="M9 6l6 6l-6 6" />
                                        </svg>
                                    </a>

                                @endif


                                <!-- Page Numbers -->
                                @foreach($units->getUrlRange(1, $units->lastPage()) as $page => $url)

                                    @if($page == $units->currentPage())

                                        <span
                                            class="w-10 h-10 rounded-xl bg-[#003260] text-white text-sm modir-bold flex items-center justify-center"
                                        >
                                            {{ $page }}
                                        </span>

                                    @else

                                        <a
                                            href="{{ $url }}"
                                            class="w-10 h-10 rounded-xl text-[#003260]/65 hover:bg-white hover:text-[#003260] text-sm transition flex items-center justify-center"
                                        >
                                            {{ $page }}
                                        </a>

                                    @endif

                                @endforeach


                                <!-- Next -->
                                @if($units->hasMorePages())

                                    <a
                                        href="{{ $units->nextPageUrl() }}"
                                        class="w-10 h-10 rounded-xl flex items-center justify-center text-[#003260]/65 hover:bg-white hover:text-[#003260] transition"
                                        aria-label="صفحه بعد"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="20"
                                             height="20"
                                             viewBox="0 0 24 24"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8"
                                             stroke-linecap="round"
                                             stroke-linejoin="round"
                                             class="w-4 h-4">
                                            <path d="M15 6l-6 6l6 6" />
                                        </svg>
                                    </a>

                                @else

                                    <span
                                        class="w-10 h-10 rounded-xl flex items-center justify-center text-[#003260]/20 cursor-not-allowed"
                                        aria-label="صفحه بعد"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="20"
                                             height="20"
                                             viewBox="0 0 24 24"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8"
                                             stroke-linecap="round"
                                             stroke-linejoin="round"
                                             class="w-4 h-4">
                                            <path d="M15 6l-6 6l6 6" />
                                        </svg>
                                    </span>

                                @endif

                            </div>

                        </div>

                    @endif

                </div>

            </section>

        </main>
        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const form = document.getElementById('unitFiltersForm');
                    const searchInput = document.getElementById('unitSearch');
                    const occupancyFilter = document.getElementById('occupancyFilter');
                    const debtFilter = document.getElementById('debtFilter');

                    if (!form || !searchInput || !occupancyFilter || !debtFilter) {
                        return;
                    }

                    let searchTimer;

                    // جستجو پس از توقف کوتاه تایپ اجرا می‌شود.
                    searchInput.addEventListener('input', function () {
                        clearTimeout(searchTimer);

                        searchTimer = setTimeout(function () {
                            form.requestSubmit();
                        }, 450);
                    });

                    // تغییر فیلترها بلافاصله نتایج را به‌روز می‌کند.
                    occupancyFilter.addEventListener('change', function () {
                        form.requestSubmit();
                    });

                    debtFilter.addEventListener('change', function () {
                        form.requestSubmit();
                    });
                });
            </script>
        @endpush
@endsection