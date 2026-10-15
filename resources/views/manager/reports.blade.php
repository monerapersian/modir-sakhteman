@extends('layouts.manager')

@section('title', 'مدیر خوب - گزارش‌ها')

@section('content')

        <main class="flex-1 px-5 lg:px-8 pt-6 pb-28 lg:pb-8">

            <!-- Welcome Banner -->

            <!-- ===================================================== -->
            <!-- Reports Hero -->
            <!-- ===================================================== -->

            <section class="relative overflow-hidden rounded-[28px] bg-[#003260] text-white shadow-xl shadow-[#003260]/10">

                <!-- Background Decoration -->
                <div class="absolute -top-24 -left-24 w-72 h-72 rounded-full bg-white/5"></div>
                <div class="absolute -bottom-28 right-8 w-80 h-80 rounded-full bg-white/5"></div>
                <div class="absolute top-14 right-1/3 w-20 h-20 rounded-full bg-white/[0.04]"></div>

                <div class="relative p-6 sm:p-8 lg:p-10">

                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">

                        <!-- Left Content -->
                        <div class="flex items-start gap-4">

                            <!-- Icon -->
                            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/10 backdrop-blur-sm border border-white/10">

                                <!-- Tabler File Report Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="30"
                                     height="30"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.8"
                                     stroke-linecap="round"
                                     stroke-linejoin="round">

                                    <path d="M14 3v4a1 1 0 0 0 1 1h4"/>
                                    <path d="M17 21H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7l5 5v11a2 2 0 0 1-2 2"/>
                                    <path d="M9 17l2-2 2 2 3-3"/>
                                    <path d="M9 12h1"/>
                                    <path d="M13 12h2"/>

                                </svg>

                            </div>

                            <!-- Title -->
                            <div>

                                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-[11px] font-medium text-white/80 mb-3">

                                    گزارش‌ها و چاپ ساختمان

                                </span>

                                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold modir-bold leading-tight">
                                    مرکز گزارش‌ها
                                </h1>

                                <p class="mt-3 max-w-2xl text-sm sm:text-base leading-7 text-white/70">
                                    گزارش‌های مالی ساختمان را مشاهده کنید، خروجی PDF یا چاپ بگیرید و اطلاعیه‌ها و بیانیه‌های رسمی ساختمان را با سربرگ «مدیر خوب» آماده کنید.
                                </p>

                            </div>

                        </div>


                        <!-- Building Information -->
                        <div class="lg:min-w-[280px] rounded-2xl bg-white/10 backdrop-blur-sm border border-white/10 p-5">

                            <div class="flex items-center gap-3">

                                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center">

                                    <!-- Building Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="20"
                                         height="20"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         stroke-linecap="round"
                                         stroke-linejoin="round">

                                        <path d="M3 21h18"/>
                                        <path d="M5 21V5l7-3 7 3v16"/>
                                        <path d="M9 21v-5h6v5"/>
                                        <path d="M8 8h1"/>
                                        <path d="M15 8h1"/>
                                        <path d="M8 11h1"/>
                                        <path d="M15 11h1"/>

                                    </svg>

                                </div>

                                <div>

                                    <p class="text-xs text-white/50">
                                        ساختمان فعال
                                    </p>

                                    <h3 class="text-sm font-semibold text-white mt-1">
                                        {{ $building?->name ?? 'ساختمانی ثبت نشده است' }}
                                    </h3>

                                </div>

                            </div>


                            <div class="mt-5 pt-5 border-t border-white/10 space-y-3">

                                <div class="flex items-center justify-between text-sm">

                                    <span class="text-white/60">
                                        دوره مالی جاری
                                    </span>

                                    <span class="font-semibold text-white modir-bold">
                                        {{ $currentPeriod ?? 'ثبت نشده' }}
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

            <!-- ===================================================== -->
            <!-- Reports, Print & Export Center -->
            <!-- ===================================================== -->

            <section class="mt-6" id="reportsCenter">

                <div class="bg-white rounded-[28px] border border-[#003260]/8 shadow-sm overflow-hidden">

                    <!-- Header -->
                    <div class="p-5 sm:p-6 lg:p-7 border-b border-[#003260]/8">

                        <div class="flex items-center gap-3">

                            <div class="w-11 h-11 rounded-2xl bg-[#003260]/5 flex items-center justify-center text-[#003260] shrink-0">

                                <!-- Reports Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="22"
                                     height="22"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.8"
                                     stroke-linecap="round"
                                     stroke-linejoin="round"
                                     aria-hidden="true">
                                    <path d="M8 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-3"/>
                                    <path d="M16 3h5v5"/>
                                    <path d="m21 3-9 9"/>
                                    <path d="M7 15h4"/>
                                    <path d="M7 11h2"/>
                                </svg>

                            </div>

                            <div>
                                <h2 class="text-xl font-bold modir-bold text-[#003260]">
                                    گزارش، چاپ و خروجی
                                </h2>

                                <p class="mt-1 text-sm text-[#003260]/55">
                                    گزارش موردنظر خود را انتخاب کنید.
                                </p>
                            </div>

                        </div>

                    </div>


                    <!-- Report Cards -->
                    <div class="p-5 sm:p-6 lg:p-7">

                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">


                            <!-- 1. Monthly Charges -->
                            <a href="{{ route('manager.reports.monthly-charges') }}"
                                    aria-label="گزارش لیست شارژ ماه جاری"
                                    class="group w-full min-w-0 rounded-[24px] border border-blue-200/80 bg-[#EEF5FF] p-5 sm:p-6 text-right cursor-pointer transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-900/10 hover:border-blue-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">

                                <div class="flex items-start justify-between gap-3 mb-5">

                                    <div class="w-12 h-12 rounded-2xl bg-blue-600 text-white flex items-center justify-center shrink-0 shadow-sm shadow-blue-600/20">

                                        <!-- Receipt / Charges Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="25"
                                             height="25"
                                             viewBox="0 0 24 24"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8"
                                             stroke-linecap="round"
                                             stroke-linejoin="round"
                                             aria-hidden="true">
                                            <path d="M6 3h12l2 3v15l-3-2-3 2-2-2-2 2-3-2-3 2V6z"/>
                                            <path d="M9 8h6"/>
                                            <path d="M9 12h6"/>
                                            <path d="M9 16h4"/>
                                        </svg>

                                    </div>

                                    <span class="text-[11px] px-3 py-1.5 rounded-full bg-blue-600/10 text-blue-700 font-semibold whitespace-nowrap">
                                        شارژ
                                    </span>

                                </div>

                                <h3 class="text-lg font-bold modir-bold text-[#003260]">
                                    لیست شارژ ماه جاری
                                </h3>

                                <p class="mt-3 text-sm leading-7 text-[#003260]/65">
                                    لیست کامل شارژ واحدها برای چاپ و نصب روی تابلو اعلانات ساختمان.
                                </p>

                                <div class="mt-5 flex items-center justify-between gap-3 text-blue-700">

                                    <span class="text-sm font-semibold">
                                        انتخاب گزارش
                                    </span>

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="20"
                                         height="20"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         stroke-linecap="round"
                                         stroke-linejoin="round"
                                         class="transition-transform duration-300 group-hover:-translate-x-1"
                                         aria-hidden="true">
                                        <path d="M5 12h14"/>
                                        <path d="m13 6 6 6-6 6"/>
                                    </svg>

                                </div>

                            </a>


                            <!-- 2. Debtors -->
                            <a href="{{ route('manager.reports.debtors') }}"
                                    aria-label="گزارش لیست بدهکاران ساختمان"
                                    class="group w-full min-w-0 rounded-[24px] border border-orange-200/80 bg-[#FFF3E8] p-5 sm:p-6 text-right cursor-pointer transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-orange-900/10 hover:border-orange-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-500 focus-visible:ring-offset-2">

                                <div class="flex items-start justify-between gap-3 mb-5">

                                    <div class="w-12 h-12 rounded-2xl bg-orange-600 text-white flex items-center justify-center shrink-0 shadow-sm shadow-orange-600/20">

                                        <!-- Wallet / Debt Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="25"
                                             height="25"
                                             viewBox="0 0 24 24"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8"
                                             stroke-linecap="round"
                                             stroke-linejoin="round"
                                             aria-hidden="true">
                                            <rect x="3" y="6" width="18" height="15" rx="2"/>
                                            <path d="M3 10h18"/>
                                            <path d="M16 15h.01"/>
                                            <path d="M7 3h10l3 3"/>
                                            <path d="M12 12v4"/>
                                            <path d="M10 14h4"/>
                                        </svg>

                                    </div>

                                    <span class="text-[11px] px-3 py-1.5 rounded-full bg-orange-600/10 text-orange-700 font-semibold whitespace-nowrap">
                                        بدهی‌ها
                                    </span>

                                </div>

                                <h3 class="text-lg font-bold modir-bold text-[#003260]">
                                    لیست بدهکاران ساختمان
                                </h3>

                                <p class="mt-3 text-sm leading-7 text-[#003260]/65">
                                    لیست واحدهای بدهکار به همراه مبلغ بدهی برای نصب روی تابلو اعلانات.
                                </p>

                                <div class="mt-5 flex items-center justify-between gap-3 text-orange-700">

                                    <span class="text-sm font-semibold">
                                        انتخاب گزارش
                                    </span>

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="20"
                                         height="20"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         stroke-linecap="round"
                                         stroke-linejoin="round"
                                         class="transition-transform duration-300 group-hover:-translate-x-1"
                                         aria-hidden="true">
                                        <path d="M5 12h14"/>
                                        <path d="m13 6 6 6-6 6"/>
                                    </svg>

                                </div>

                            </a>


                            <!-- 3. Building Cash Flow -->
                            <a href="{{ route('manager.bills') }}#chartReprot"
                                    aria-label="گزارش گردش صندوق ساختمان"
                                    class="group w-full min-w-0 rounded-[24px] border border-emerald-200/80 bg-[#EAF8F0] p-5 sm:p-6 text-right cursor-pointer transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-emerald-900/10 hover:border-emerald-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500 focus-visible:ring-offset-2">

                                <div class="flex items-start justify-between gap-3 mb-5">

                                    <div class="w-12 h-12 rounded-2xl bg-emerald-600 text-white flex items-center justify-center shrink-0 shadow-sm shadow-emerald-600/20">

                                        <!-- Cash Flow Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="25"
                                             height="25"
                                             viewBox="0 0 24 24"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8"
                                             stroke-linecap="round"
                                             stroke-linejoin="round"
                                             aria-hidden="true">
                                            <rect x="3" y="4" width="18" height="16" rx="3"/>
                                            <path d="M12 8v8"/>
                                            <path d="m9 11 3-3 3 3"/>
                                            <path d="m9 13 3 3 3-3"/>
                                        </svg>

                                    </div>

                                    <span class="text-[11px] px-3 py-1.5 rounded-full bg-emerald-600/10 text-emerald-700 font-semibold whitespace-nowrap">
                                        امور مالی
                                    </span>

                                </div>

                                <h3 class="text-lg font-bold modir-bold text-[#003260]">
                                    گردش صندوق ساختمان
                                </h3>

                                <p class="mt-3 text-sm leading-7 text-[#003260]/65">
                                    تحلیل و بررسی صندوق ساختمان در بازه زمانی انتخاب شده.
                                </p>

                                <div class="mt-5 flex items-center justify-between gap-3 text-emerald-700">

                                    <span class="text-sm font-semibold">
                                        انتخاب گزارش
                                    </span>

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="20"
                                         height="20"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         stroke-linecap="round"
                                         stroke-linejoin="round"
                                         class="transition-transform duration-300 group-hover:-translate-x-1"
                                         aria-hidden="true">
                                        <path d="M5 12h14"/>
                                        <path d="m13 6 6 6-6 6"/>
                                    </svg>

                                </div>

                            </a>


                            <!-- 4. Unit Statement -->
                            <a href="{{ route('manager.units') }}#unitsList"
                                    aria-label="گزارش کارنامه یک واحد"
                                    class="group w-full min-w-0 rounded-[24px] border border-violet-200/80 bg-[#F3EDFF] p-5 sm:p-6 text-right cursor-pointer transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-violet-900/10 hover:border-violet-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-violet-500 focus-visible:ring-offset-2">

                                <div class="flex items-start justify-between gap-3 mb-5">

                                    <div class="w-12 h-12 rounded-2xl bg-violet-600 text-white flex items-center justify-center shrink-0 shadow-sm shadow-violet-600/20">

                                        <!-- Unit Statement Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="25"
                                             height="25"
                                             viewBox="0 0 24 24"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8"
                                             stroke-linecap="round"
                                             stroke-linejoin="round"
                                             aria-hidden="true">
                                            <path d="M8 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V8z"/>
                                            <path d="M8 3v5h5"/>
                                            <path d="M8 13h8"/>
                                            <path d="M8 17h5"/>
                                            <circle cx="17" cy="17" r="3"/>
                                            <path d="m19.2 19.2 1.3 1.3"/>
                                        </svg>

                                    </div>

                                    <span class="text-[11px] px-3 py-1.5 rounded-full bg-violet-600/10 text-violet-700 font-semibold whitespace-nowrap">
                                        واحدها
                                    </span>

                                </div>

                                <h3 class="text-lg font-bold modir-bold text-[#003260]">
                                    کارنامه یک واحد
                                </h3>

                                <p class="mt-3 text-sm leading-7 text-[#003260]/65">
                                     پرونده کامل یک واحد شامل مالک، ساکن، پرداخت‌ها، بدهی و سوابق مالی.
                                </p>

                                <div class="mt-5 flex items-center justify-between gap-3 text-violet-700">

                                    <span class="text-sm font-semibold">
                                        انتخاب گزارش
                                    </span>

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="20"
                                         height="20"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         stroke-linecap="round"
                                         stroke-linejoin="round"
                                         class="transition-transform duration-300 group-hover:-translate-x-1"
                                         aria-hidden="true">
                                        <path d="M5 12h14"/>
                                        <path d="m13 6 6 6-6 6"/>
                                    </svg>

                                </div>

                            </a>


                            <!-- 5. Bills & Expenses -->
                            <a href="{{ route('manager.bills') }}#expenseFiltersForm"
                                    aria-label="گزارش قبوض و هزینه‌ها"
                                    class="group w-full min-w-0 rounded-[24px] border border-rose-200/80 bg-[#FFF0F3] p-5 sm:p-6 text-right cursor-pointer transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-rose-900/10 hover:border-rose-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-rose-500 focus-visible:ring-offset-2">

                                <div class="flex items-start justify-between gap-3 mb-5">

                                    <div class="w-12 h-12 rounded-2xl bg-rose-600 text-white flex items-center justify-center shrink-0 shadow-sm shadow-rose-600/20">

                                        <!-- Bills & Expenses Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="25"
                                             height="25"
                                             viewBox="0 0 24 24"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8"
                                             stroke-linecap="round"
                                             stroke-linejoin="round"
                                             aria-hidden="true">
                                            <path d="M6 3h12l2 3v15l-3-2-3 2-2-2-2 2-3-2-3 2V6z"/>
                                            <path d="M9 8h6"/>
                                            <path d="M9 12h6"/>
                                            <path d="M9 16h3"/>
                                            <circle cx="17" cy="16" r="3"/>
                                            <path d="M17 14.5v1.5l1 0.5"/>
                                        </svg>

                                    </div>

                                    <span class="text-[11px] px-3 py-1.5 rounded-full bg-rose-600/10 text-rose-700 font-semibold whitespace-nowrap">
                                        هزینه‌ها
                                    </span>

                                </div>

                                <h3 class="text-lg font-bold modir-bold text-[#003260]">
                                    گزارش قبوض و هزینه‌ها
                                </h3>

                                <p class="mt-3 text-sm leading-7 text-[#003260]/65">
                                    لیست و جزئیات هزینه‌های خدماتی، قبوض و هزینه‌های ثبت‌شده ساختمان.
                                </p>

                                <div class="mt-5 flex items-center justify-between gap-3 text-rose-700">

                                    <span class="text-sm font-semibold">
                                        انتخاب گزارش
                                    </span>

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="20"
                                         height="20"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         stroke-linecap="round"
                                         stroke-linejoin="round"
                                         class="transition-transform duration-300 group-hover:-translate-x-1"
                                         aria-hidden="true">
                                        <path d="M5 12h14"/>
                                        <path d="m13 6 6 6-6 6"/>
                                    </svg>

                                </div>
                            </a>


                            <!-- 6. Monthly Expenses -->
                            <a href="{{ route('manager.bills') }}#totalCosts"
                                    data-report-modal="monthly-expenses"
                                    aria-label="گزارش ریز هزینه‌های ماه"
                                    class="group w-full min-w-0 rounded-[24px] border border-amber-200/80 bg-[#FFF8E5] p-5 sm:p-6 text-right cursor-pointer transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-amber-900/10 hover:border-amber-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-500 focus-visible:ring-offset-2">

                                <div class="flex items-start justify-between gap-3 mb-5">

                                    <div class="w-12 h-12 rounded-2xl bg-amber-500 text-white flex items-center justify-center shrink-0 shadow-sm shadow-amber-600/20">

                                        <!-- Monthly Expenses Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="25"
                                             height="25"
                                             viewBox="0 0 24 24"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8"
                                             stroke-linecap="round"
                                             stroke-linejoin="round"
                                             aria-hidden="true">
                                            <rect x="3" y="5" width="18" height="16" rx="2"/>
                                            <path d="M16 3v4"/>
                                            <path d="M8 3v4"/>
                                            <path d="M3 10h18"/>
                                            <path d="M8 14h3"/>
                                            <path d="M8 17h6"/>
                                            <path d="m16 14 1 1 2-2"/>
                                        </svg>

                                    </div>

                                    <span class="text-[11px] px-3 py-1.5 rounded-full bg-amber-500/15 text-amber-800 font-semibold whitespace-nowrap">
                                        ماهانه
                                    </span>

                                </div>

                                <h3 class="text-lg font-bold modir-bold text-[#003260]">
                                    مجموع هزینه‌ها
                                </h3>

                                <p class="mt-3 text-sm leading-7 text-[#003260]/65">
                                    مجموع هزینه‌های خدماتی ، قبوض و بدهی واحدها در بازه یک، سه، شش ماهه و یک ساله.
                                </p>

                                <div class="mt-5 flex items-center justify-between gap-3 text-amber-800">

                                    <span class="text-sm font-semibold">
                                        انتخاب گزارش
                                    </span>

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="20"
                                         height="20"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         stroke-linecap="round"
                                         stroke-linejoin="round"
                                         class="transition-transform duration-300 group-hover:-translate-x-1"
                                         aria-hidden="true">
                                        <path d="M5 12h14"/>
                                        <path d="m13 6 6 6-6 6"/>
                                    </svg>

                                </div>
                            </a>


                        </div>

                    </div>


                    <!-- Footer Note -->
                    <div class="px-5 sm:px-6 lg:px-7 pb-6">

                        <div class="rounded-2xl border border-[#003260]/8 bg-[#003260]/[0.03] p-4">

                            <div class="flex items-start gap-3">

                                <div class="w-10 h-10 rounded-xl bg-[#003260]/[0.08] flex items-center justify-center text-[#003260] shrink-0">

                                    <!-- Info Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="20"
                                         height="20"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         stroke-linecap="round"
                                         stroke-linejoin="round"
                                         aria-hidden="true">
                                        <circle cx="12" cy="12" r="10"/>
                                        <path d="M12 16v-4"/>
                                        <path d="M12 8h.01"/>
                                    </svg>

                                </div>

                                <div class="min-w-0">

                                    <p class="text-sm font-semibold text-[#003260]">
                                        خروجی‌های مدیر خوب
                                    </p>

                                    <p class="mt-1 text-sm leading-7 text-[#003260]/60">
                                        تمام گزارش‌های چاپی با سربرگ اختصاصی «مدیر خوب»، نام ساختمان، تاریخ چاپ و اطلاعات مدیر ساختمان تولید می‌شوند تا مستقیماً قابل چاپ یا ذخیره به‌صورت PDF باشند.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

        </main>

@endsection