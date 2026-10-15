@extends('layouts.manager')

@section('title', 'مدیر خوب - داشبورد')

@section('content')

        <!-- ============================= -->
        <!-- Dashboard Content -->
        <!-- ============================= -->
        <main class="flex-1 px-5 lg:px-8 pt-6 pb-28 lg:pb-8">

            <section class="bg-[#003260] text-white rounded-[28px] p-6 lg:p-8 relative overflow-hidden">

                <!-- Decorative Elements -->
                <div class="absolute -top-20 -left-20 w-56 h-56 rounded-full bg-white/5"></div>
                <div class="absolute -bottom-24 right-1/4 w-72 h-72 rounded-full bg-white/5"></div>

                <div class="relative z-10 flex flex-col lg:flex-row justify-between gap-6">

                    <div class="max-w-lg">

                        <p class="text-white/60 text-sm mb-3">
                            پنل مدیریت ساختمان
                        </p>

                        <h1 class="text-3xl lg:text-4xl leading-relaxed modir-bold mb-4">
                            {{ $building->name }}
                        </h1>

                        <p class="text-white/70 leading-8 text-sm">
                            مدیریت شارژ، هزینه‌ها، واحدها، ساکنین و گزارش‌های مالی را از یک پنل یکپارچه انجام دهید.
                        </p>

                    </div>

                    <div class="flex items-end">

                        <div class="bg-white/10 backdrop-blur rounded-3xl px-5 py-4 border border-white/10">

                            <p class="text-xs text-white/50 mb-2">
                                امروز {{ \Morilog\Jalali\Jalalian::fromCarbon(\Illuminate\Support\Carbon::now('Asia/Tehran'))->format('%A') }}
                            </p>

                            <p class="text-xl modir-bold">
                                {{ toPersianDigits(\Morilog\Jalali\Jalalian::fromCarbon(\Illuminate\Support\Carbon::now('Asia/Tehran'))->format('j F Y')) }}
                            </p>

                        </div>

                    </div>

                </div>

            </section>

            <!-- ============================= -->
            <!-- Quick Access -->
            <!-- ============================= -->
            <section class="mt-8">

                <!-- Section Header -->
                <div class="flex items-center justify-between gap-3 mb-5">

                    <div>
                        <h2 class="text-xl modir-bold text-[#003260]">
                            دسترسی سریع
                        </h2>

                        <p class="text-sm text-[#003260]/60 mt-2">
                            به بخش‌های پرکاربرد ساختمان دسترسی پیدا کنید.
                        </p>
                    </div>

                    <div class="hidden sm:flex items-center justify-center w-11 h-11 rounded-2xl bg-white border border-[#003260]/5">
                        <svg
                            class="w-5 h-5 text-[#003260]"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
                            <rect x="3.5" y="3.5" width="7" height="7" rx="2"/>
                            <rect x="13.5" y="3.5" width="7" height="7" rx="2"/>
                            <rect x="3.5" y="13.5" width="7" height="7" rx="2"/>
                            <rect x="13.5" y="13.5" width="7" height="7" rx="2"/>
                        </svg>
                    </div>

                </div>

                <!-- Quick Access Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

                    <!-- Units -->
                    <a
                        href="{{ route('manager.units') }}"
                        aria-label="رفتن به صفحه واحدها"
                        class="group relative flex flex-col min-h-[190px] overflow-hidden rounded-[24px] bg-white border border-[#003260]/5 p-5 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-[#003260]/10 hover:border-[#003260]/15 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#003260] focus-visible:ring-offset-2"
                    >

                        <div class="absolute -top-12 -left-12 w-32 h-32 rounded-full bg-[#003260]/[0.035] transition-transform duration-500 group-hover:scale-150"></div>

                        <div class="relative flex items-start justify-between">

                            <div class="flex items-center justify-center w-14 h-14 rounded-2xl bg-[#003260] text-white shadow-lg shadow-[#003260]/15 transition-transform duration-300 group-hover:scale-105">

                                <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <rect x="4" y="3" width="16" height="18" rx="2"/>
                                    <path d="M9 7h2M9 11h2M9 15h2M15 7h.01M15 11h.01M15 15h.01M9 21v-3h6v3"/>
                                </svg>

                            </div>

                            <span class="flex items-center justify-center w-9 h-9 rounded-full bg-[#e5e2dd]/60 text-[#003260]/60 transition-all duration-300 group-hover:bg-[#003260] group-hover:text-white group-hover:-translate-x-1">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                                </svg>
                            </span>

                        </div>

                        <div class="relative mt-5">
                            <h3 class="text-base modir-bold text-[#003260]">
                                واحدها
                            </h3>

                            <p class="text-xs leading-6 text-[#003260]/55 mt-2">
                                مدیریت و مشاهده واحدهای ساختمان
                            </p>
                        </div>

                    </a>


                    <!-- Building Charges -->
                    <a
                        href="{{ route('manager.charges') }}"
                        aria-label="رفتن به صفحه شارژ ساختمان"
                        class="group relative flex flex-col min-h-[190px] overflow-hidden rounded-[24px] bg-white border border-[#003260]/5 p-5 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-[#003260]/10 hover:border-[#003260]/15 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#003260] focus-visible:ring-offset-2"
                    >

                        <div class="absolute -top-12 -left-12 w-32 h-32 rounded-full bg-[#003260]/[0.035] transition-transform duration-500 group-hover:scale-150"></div>

                        <div class="relative flex items-start justify-between">

                            <div class="flex items-center justify-center w-14 h-14 rounded-2xl bg-[#e5e2dd] text-[#003260] transition-transform duration-300 group-hover:scale-105">

                                <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <rect x="3" y="5" width="18" height="14" rx="2"/>
                                    <path d="M3 10h18M7 15h3M16 14v3M14.5 15.5h3"/>
                                </svg>

                            </div>

                            <span class="flex items-center justify-center w-9 h-9 rounded-full bg-[#e5e2dd]/60 text-[#003260]/60 transition-all duration-300 group-hover:bg-[#003260] group-hover:text-white group-hover:-translate-x-1">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                                </svg>
                            </span>

                        </div>

                        <div class="relative mt-5">
                            <h3 class="text-base modir-bold text-[#003260]">
                                شارژ ساختمان
                            </h3>

                            <p class="text-xs leading-6 text-[#003260]/55 mt-2">
                                مدیریت شارژ ماهانه و دوره‌های پرداخت
                            </p>
                        </div>

                    </a>


                    <!-- Bills & Expenses -->
                    <a
                        href="{{ route('manager.bills') }}"
                        aria-label="رفتن به صفحه قبوض و هزینه‌ها"
                        class="group relative flex flex-col min-h-[190px] overflow-hidden rounded-[24px] bg-white border border-[#003260]/5 p-5 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-[#003260]/10 hover:border-[#003260]/15 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#003260] focus-visible:ring-offset-2"
                    >

                        <div class="absolute -top-12 -left-12 w-32 h-32 rounded-full bg-[#003260]/[0.035] transition-transform duration-500 group-hover:scale-150"></div>

                        <div class="relative flex items-start justify-between">

                            <div class="flex items-center justify-center w-14 h-14 rounded-2xl bg-[#003260]/[0.07] text-[#003260] transition-transform duration-300 group-hover:scale-105">

                                <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M6 3h9l4 4v14H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z"/>
                                    <path d="M14 3v5h5M8 12h8M8 16h5"/>
                                    <path d="m14 19 2 2 4-4"/>
                                </svg>

                            </div>

                            <span class="flex items-center justify-center w-9 h-9 rounded-full bg-[#e5e2dd]/60 text-[#003260]/60 transition-all duration-300 group-hover:bg-[#003260] group-hover:text-white group-hover:-translate-x-1">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                                </svg>
                            </span>

                        </div>

                        <div class="relative mt-5">
                            <h3 class="text-base modir-bold text-[#003260]">
                                قبوض و هزینه‌ها
                            </h3>

                            <p class="text-xs leading-6 text-[#003260]/55 mt-2">
                                ثبت و پیگیری هزینه‌های ساختمان
                            </p>
                        </div>

                    </a>


                    <!-- Reports -->
                    <a
                        href="{{ route('manager.reports') }}"
                        aria-label="رفتن به صفحه گزارش‌ها"
                        class="group relative flex flex-col min-h-[190px] overflow-hidden rounded-[24px] bg-white border border-[#003260]/5 p-5 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-[#003260]/10 hover:border-[#003260]/15 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#003260] focus-visible:ring-offset-2"
                    >

                        <div class="absolute -top-12 -left-12 w-32 h-32 rounded-full bg-[#003260]/[0.035] transition-transform duration-500 group-hover:scale-150"></div>

                        <div class="relative flex items-start justify-between">

                            <div class="flex items-center justify-center w-14 h-14 rounded-2xl bg-[#003260] text-white shadow-lg shadow-[#003260]/15 transition-transform duration-300 group-hover:scale-105">

                                <!-- <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M4 20V10M10 20V4M16 20v-7M22 20H2"/>
                                    <path d="m3 7 5-4 5 5 7-6"/>
                                </svg> -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                    class="w-7 h-7 icon icon-tabler icons-tabler-outline icon-tabler-chart-histogram">

                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />

                                    <path d="M3 3v18h18" />
                                    <path d="M20 18v3" />
                                    <path d="M16 16v5" />
                                    <path d="M12 13v8" />
                                    <path d="M8 16v5" />
                                    <path d="M3 11c6 0 5 -5 9 -5s3 5 9 5" />

                                </svg>

                            </div>

                            <span class="flex items-center justify-center w-9 h-9 rounded-full bg-[#e5e2dd]/60 text-[#003260]/60 transition-all duration-300 group-hover:bg-[#003260] group-hover:text-white group-hover:-translate-x-1">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                                </svg>
                            </span>

                        </div>

                        <div class="relative mt-5">
                            <h3 class="text-base modir-bold text-[#003260]">
                                گزارش‌ها
                            </h3>

                            <p class="text-xs leading-6 text-[#003260]/55 mt-2">
                                مشاهده و چاپ گزارش‌های ساختمان
                            </p>
                        </div>

                    </a>

                </div>

            </section>

            <!-- ====================================== -->
            <!-- Statistics Cards -->
            <!-- ====================================== -->

            <section class="mt-8">

                <!-- Section Header -->

                <div class="flex items-center justify-between mb-5">

                    <div>

                        <h2 class="text-2xl modir-bold text-[#003260]">
                            نمای کلی ساختمان
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            وضعیت مالی و اطلاعات اصلی ساختمان در یک نگاه
                        </p>

                    </div>

                </div>


                <!-- Grid -->

                <div class="grid grid-cols-2 lg:grid-cols-12 gap-4">

                    <!-- تعداد واحدها -->

                    <div class="col-span-1 lg:col-span-3 bg-white rounded-[24px] p-5 border border-[#003260]/5 shadow-sm hover:shadow-lg transition">

                        <div class="flex justify-between items-start mb-5">

                            <div class="w-12 h-12 rounded-2xl bg-[#003260]/8 flex items-center justify-center text-xl">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="24"
                                     height="24"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.5"
                                     stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="icon icon-tabler icons-tabler-outline icon-tabler-building-community">

                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />

                                    <path d="M8 9l5 5v7h-5v-4m0 4h-5v-7l5 -5m1 1v-6a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v17h-8" />

                                    <path d="M13 7l0 .01" />
                                    <path d="M17 7l0 .01" />
                                    <path d="M17 11l0 .01" />
                                    <path d="M17 15l0 .01" />

                                </svg>

                            </div>

                            <span class="text-xs bg-[#003260]/5 text-[#003260] px-2 py-1 rounded-full">
                                کل ساختمان
                            </span>

                        </div>

                        <p class="text-gray-500 text-sm mb-2">
                            تعداد واحدها
                        </p>

                        <h3 class="text-3xl modir-bold text-[#003260]">
                            {{ number_format($totalUnits, 0, '', '٬') }}
                        </h3>

                        <p class="text-xs text-gray-400 mt-3">
                            شامل واحدهای مسکونی و تجاری
                        </p>

                    </div>


                    <!-- واحدهای دارای ساکن -->

                    <div class="col-span-1 lg:col-span-3 bg-white rounded-[24px] p-5 border border-[#003260]/5 shadow-sm hover:shadow-lg transition">

                        <div class="flex justify-between items-start mb-5">

                            <div class="w-12 h-12 rounded-2xl bg-green-100 flex items-center justify-center text-xl">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="24"
                                     height="24"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.5"
                                     stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="icon icon-tabler icons-tabler-outline icon-tabler-users-group">

                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />

                                    <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />

                                    <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />

                                    <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />

                                    <path d="M17 10h2a2 2 0 0 1 2 2v1" />

                                    <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />

                                    <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />

                                </svg>

                            </div>

                            <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">
                                فعال
                            </span>

                        </div>

                        <p class="text-gray-500 text-sm mb-2">
                            واحدهای دارای ساکن
                        </p>

                        <h3 class="text-3xl modir-bold text-[#003260]">
                            {{ number_format($occupiedUnits, 0, '', '٬') }}
                        </h3>

                        <div class="w-full bg-gray-100 h-2 rounded-full mt-4 overflow-hidden">

                            <div
                                class="bg-green-500 h-full rounded-full"
                                style="width: {{ $occupancyPercentage }}%;"
                            ></div>

                        </div>

                        <p class="text-xs text-gray-400 mt-2">
                            {{ number_format($occupancyPercentage, 0, '', '٬') }}٪ واحدها دارای ساکن هستند.
                        </p>

                    </div>


                    <!-- مبلغ بدهی -->

                    <div class="col-span-1 lg:col-span-3 bg-white rounded-[24px] p-5 border border-[#003260]/5 shadow-sm hover:shadow-lg transition">

                        <div class="flex justify-between items-start mb-5">

                            <div class="w-12 h-12 rounded-2xl bg-orange-100 flex items-center justify-center text-xl">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="24"
                                     height="24"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.5"
                                     stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="icon icon-tabler icons-tabler-outline icon-tabler-alert-triangle text-orange-600">

                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />

                                    <path d="M12 9v4" />

                                    <path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0" />

                                    <path d="M12 16h.01" />

                                </svg>

                            </div>

                            <span class="text-xs bg-orange-100 text-orange-700 px-2 py-1 rounded-full">
                                نیاز به پیگیری
                            </span>

                        </div>

                        <p class="text-gray-500 text-sm mb-2">
                            بدهی کل واحدها
                        </p>

                        <h3 class="text-2xl modir-bold text-orange-600">
                            {{ toPersianDigits(number_format($totalDebt, 0, '', '٬')) }} تومان
                        </h3>

                        <p class="text-xs text-gray-400 mt-3">
                            بدهی مربوط به {{ toPersianDigits($indebtedUnits) }} واحد
                        </p>

                    </div>


                    <!-- واحدهای بدهکار -->

                    <div class="col-span-1 lg:col-span-3 bg-white rounded-[24px] p-5 border border-[#003260]/5 shadow-sm hover:shadow-lg transition">

                        <div class="flex justify-between items-start mb-5">

                            <div class="w-12 h-12 rounded-2xl bg-red-100 flex items-center justify-center text-xl">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="24"
                                     height="24"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.5"
                                     stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="icon icon-tabler icons-tabler-outline icon-tabler-cash-banknote-minus text-red-600">

                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />

                                    <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />

                                    <path d="M12 18h-7a2 2 0 0 1 -2 -2v-8a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v7" />

                                    <path d="M18 12h.01" />
                                    <path d="M6 12h.01" />

                                    <path d="M16 19h6" />

                                </svg>

                            </div>

                            <span class="text-xs bg-red-100 text-red-700 px-2 py-1 rounded-full">
                                بدهکار
                            </span>

                        </div>

                        <p class="text-gray-500 text-sm mb-2">
                            تعداد واحدهای بدهکار
                        </p>

                        <h3 class="text-3xl modir-bold text-red-600">
                            {{ toPersianDigits($indebtedUnits) }}
                        </h3>

                        <p class="text-xs text-gray-400 mt-3">
                            از مجموع {{ toPersianDigits(number_format($totalUnits, 0, '', '٬')) }} واحد ساختمان
                        </p>

                    </div>

                </div>

            </section>

        </main>

@endsection