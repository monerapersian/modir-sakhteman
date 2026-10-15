@extends('layouts.manager')

@section('title', 'مدیر خوب - قبض‌ها')

@section('content')

            {{-- پیام موفقیت --}}
            @if (session('success'))
                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            {{-- پیام خطا --}}
            @if (session('error'))
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            {{-- خطاهای اعتبارسنجی فرم --}}
            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-red-800">
                    <p class="mb-2 font-bold">لطفاً موارد زیر را بررسی کن:</p>

                    <ul class="list-inside list-disc space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <main class="flex-1 px-5 lg:px-8 pt-6 pb-28 lg:pb-8">

                <!-- Expenses Hero -->
                <section class="relative overflow-hidden rounded-[28px] bg-[#003260] text-white shadow-xl shadow-[#003260]/10">

                    <!-- Background Decoration -->
                    <div class="absolute -top-24 -left-20 w-72 h-72 rounded-full bg-white/5 blur-sm"></div>
                    <div class="absolute -bottom-28 right-12 w-80 h-80 rounded-full bg-white/5 blur-sm"></div>
                    <div class="absolute top-12 right-1/3 w-20 h-20 rounded-full bg-white/[0.04]"></div>

                    <div class="relative p-6 sm:p-8 lg:p-10">

                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">

                            <!-- Left Content -->
                            <div class="flex items-start gap-4">

                                <!-- Icon -->
                                <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/10 backdrop-blur-sm border border-white/10">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="30"
                                         height="30"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         stroke-linecap="round"
                                         stroke-linejoin="round"
                                         class="text-white">
                                        <path d="M12 1v22"/>
                                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7H15a3.5 3.5 0 0 1 0 7H6"/>
                                    </svg>

                                </div>

                                <!-- Title -->
                                <div>

                                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-[11px] font-medium text-white/80 mb-3">
                                        مدیریت مالی ساختمان
                                    </span>

                                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold modir-bold leading-tight">
                                        قبوض و هزینه‌های ساختمان
                                    </h1>

                                    <p class="mt-3 max-w-2xl text-sm sm:text-base leading-7 text-white/70">
                                        تمام قبوض و هزینه‌های خدماتی ساختمان را در یک مکان ثبت، مدیریت و پیگیری کنید؛
                                        از قبض آب، برق و گاز گرفته تا هزینه‌های سرایدار، آسانسور، فضای سبز، تعمیرات و سایر هزینه‌ها.
                                    </p>

                                </div>

                            </div>

                            <!-- Building Info Card -->
                            <div class="lg:min-w-[260px] rounded-2xl bg-white/10 backdrop-blur-sm border border-white/10 p-4">

                                <div class="flex items-center gap-3">

                                    <!-- Building Icon -->
                                    <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="20"
                                             height="20"
                                             viewBox="0 0 24 24"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8"
                                             stroke-linecap="round"
                                             stroke-linejoin="round"
                                             class="text-white">
                                            <path d="M3 21h18"/>
                                            <path d="M5 21V5l7-3 7 3v16"/>
                                            <path d="M9 21v-5h6v5"/>
                                            <path d="M8 8h1"/>
                                            <path d="M15 8h1"/>
                                            <path d="M8 11h1"/>
                                            <path d="M15 11h1"/>
                                        </svg>

                                    </div>

                                    <div class="min-w-0">

                                        <p class="text-xs text-white/50">
                                            ساختمان فعال
                                        </p>

                                        <h3 class="text-sm font-semibold text-white mt-1 break-words">
                                            {{ $building?->name ?? 'ساختمانی ثبت نشده است' }}
                                        </h3>

                                    </div>

                                </div>

                                <div class="mt-4 pt-4 border-t border-white/10">

                                    <div class="flex items-center justify-between gap-4 text-sm">

                                        <span class="text-white/60 shrink-0">
                                            دوره مالی جاری
                                        </span>

                                        <span class="font-semibold text-white modir-bold text-left">
                                            {{ $currentPeriod }}
                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </section>

                <!-- ===================================================== -->
                <!-- Quick Actions -->
                <!-- ===================================================== -->

                <section class="mt-6">

                    <div class="rounded-[28px] bg-white border border-[#003260]/5 shadow-sm overflow-hidden">

                        <!-- Header -->
                        <div class="p-5 sm:p-6 lg:p-7 border-b border-[#003260]/5">

                            <div class="flex items-center gap-3">

                                <div class="w-11 h-11 rounded-2xl bg-[#003260]/5 flex items-center justify-center text-[#003260]">

                                    <!-- Tabler Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="22"
                                         height="22"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <path d="M12 5v14"/>
                                        <path d="M5 12h14"/>
                                    </svg>

                                </div>

                                <div>

                                    <h2 class="text-xl font-bold modir-bold text-[#003260]">
                                        عملیات سریع
                                    </h2>

                                    <p class="mt-1 text-sm text-[#003260]/55">
                                        قبض یا هزینه خدماتی جدید را بدون خروج از این صفحه ثبت کنید.
                                    </p>

                                </div>

                            </div>

                        </div>



                        <!-- Action Cards -->
                        <div class="p-5 sm:p-6 lg:p-7">

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">


                                <!-- Add Bill -->
                                <button
                                    type="button"
                                    data-open-modal="billModal"
                                    class="group relative overflow-hidden rounded-[26px] border border-[#003260]/5 bg-[#003260] p-6 text-right transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-[#003260]/15 cursor-pointer">

                                    <!-- Background -->
                                    <div class="absolute -top-12 -left-12 w-40 h-40 rounded-full bg-white/5 group-hover:scale-110 transition-transform duration-500"></div>

                                    <div class="relative flex items-start justify-between gap-5">

                                        <div>

                                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-[11px] text-white/70 mb-5">
                                                قبوض ساختمان
                                            </div>

                                            <h3 class="text-xl font-bold modir-bold text-white">
                                                + قبض
                                            </h3>

                                            <p class="mt-3 text-sm leading-7 text-white/70">
                                                ثبت قبض آب، برق، گاز یا تلفن درب پارکینگ به همراه مبلغ، دوره و وضعیت پرداخت.
                                            </p>

                                        </div>


                                        <div class="w-14 h-14 rounded-2xl bg-white/10 flex items-center justify-center shrink-0 group-hover:bg-white/15 transition">

                                            <!-- Receipt Icon -->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 width="26"
                                                 height="26"
                                                 viewBox="0 0 24 24"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 stroke-width="1.8"
                                                 stroke-linecap="round"
                                                 stroke-linejoin="round"
                                                 class="text-white">
                                                <path d="M6 3h12l2 3v15l-3-2-3 2-2-2-2 2-3-2-3 2V6z"/>
                                                <path d="M9 8h6"/>
                                                <path d="M9 12h6"/>
                                                <path d="M9 16h4"/>
                                            </svg>

                                        </div>

                                    </div>


                                    <div class="relative mt-8 flex items-center justify-between text-white/70">

                                        <span class="text-sm font-medium">
                                            ثبت قبض جدید
                                        </span>

                                        <div class="w-9 h-9 rounded-xl bg-white/10 flex items-center justify-center group-hover:translate-x-1 transition-transform">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 width="18"
                                                 height="18"
                                                 viewBox="0 0 24 24"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 stroke-width="1.8"
                                                 stroke-linecap="round"
                                                 stroke-linejoin="round">
                                                <path d="M5 12h14"/>
                                                <path d="M13 6l6 6-6 6"/>
                                            </svg>

                                        </div>

                                    </div>

                                </button>



                                <!-- Add Service Expense -->
                                <button
                                    type="button"
                                    data-open-modal="serviceExpenseModal"
                                    class="group relative overflow-hidden rounded-[26px] border border-[#003260]/10 bg-[#F8F9FA] p-6 text-right transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-[#003260]/10 cursor-pointer">

                                    <!-- Decoration -->
                                    <div class="absolute -bottom-10 -right-10 w-40 h-40 rounded-full bg-[#003260]/5 group-hover:scale-110 transition-transform duration-500"></div>

                                    <div class="relative flex items-start justify-between gap-5">

                                        <div>

                                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#003260]/5 text-[11px] text-[#003260]/70 mb-5">
                                                هزینه‌های خدماتی
                                            </div>

                                            <h3 class="text-xl font-bold modir-bold text-[#003260]">
                                                + هزینه خدماتی
                                            </h3>

                                            <p class="mt-3 text-sm leading-7 text-[#003260]/60">
                                                ثبت هزینه‌هایی مانند سرایدار، آسانسور، فضای سبز، نظافت، تعمیرات و سایر خدمات ساختمان.
                                            </p>

                                        </div>


                                        <div class="w-14 h-14 rounded-2xl bg-[#003260]/5 flex items-center justify-center shrink-0 group-hover:bg-[#003260]/10 transition">

                                            <!-- Tools Icon -->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 width="26"
                                                 height="26"
                                                 viewBox="0 0 24 24"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 stroke-width="1.8"
                                                 stroke-linecap="round"
                                                 stroke-linejoin="round"
                                                 class="text-[#003260]">
                                                <path d="M14.7 6.3a4 4 0 0 0-5.4 5.4L3 18v3h3l6.3-6.3a4 4 0 0 0 5.4-5.4l-2.2 2.2-2.8-2.8z"/>
                                            </svg>

                                        </div>

                                    </div>


                                    <div class="relative mt-8 flex items-center justify-between text-[#003260]/70">

                                        <span class="text-sm font-medium">
                                            ثبت هزینه خدماتی جدید
                                        </span>

                                        <div class="w-9 h-9 rounded-xl bg-[#003260]/5 flex items-center justify-center group-hover:translate-x-1 transition-transform">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 width="18"
                                                 height="18"
                                                 viewBox="0 0 24 24"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 stroke-width="1.8"
                                                 stroke-linecap="round"
                                                 stroke-linejoin="round"
                                                 class="text-[#003260]">
                                                <path d="M5 12h14"/>
                                                <path d="M13 6l6 6-6 6"/>
                                            </svg>

                                        </div>

                                    </div>

                                </button>

                            </div>



                            <!-- Bottom Info -->
                            <div class="mt-6 rounded-2xl border border-[#003260]/5 bg-[#003260]/[0.03] p-4">

                                <div class="flex flex-col sm:flex-row sm:items-center gap-3 text-sm text-[#003260]/60">

                                    <div class="flex items-center gap-2">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="18"
                                             height="18"
                                             viewBox="0 0 24 24"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8"
                                             stroke-linecap="round"
                                             stroke-linejoin="round"
                                             class="text-[#003260]">
                                            <circle cx="12" cy="12" r="10"/>
                                            <path d="M12 16v-4"/>
                                            <path d="M12 8h.01"/>
                                        </svg>

                                        <span>
                                            پس از کلیک روی هر گزینه، فرم مربوطه به صورت پنجره (Modal) در همین صفحه باز می‌شود.
                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </section>

                <!-- ===================================================== -->
                <!-- Expenses Analytics Section -->
                <!-- ===================================================== -->

                <section class="mt-6">

                    <div class="rounded-[28px] bg-white border border-[#003260]/5 shadow-sm overflow-hidden">

                        <!-- Header -->
                        <div id="totalCosts" class="p-5 sm:p-6 lg:p-7 border-b border-[#003260]/5">

                            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

                                <div>

                                    <h2 class="text-xl font-bold modir-bold text-[#003260]">
                                        وضعیت قبوض و هزینه‌ها
                                    </h2>

                                    <p class="mt-2 text-sm text-[#003260]/55 leading-6">
                                        مجموع قبوض و هزینه‌های خدماتی ساختمان را در بازه‌های زمانی مختلف بررسی کنید.
                                    </p>

                                </div>


                                <!-- Date Filter -->
                                <div class="flex flex-wrap gap-2">

                                    <a
                                        href="{{ route('manager.bills', ['period' => 'month']) }}"
                                        data-period="month"
                                        class="period-filter px-4 py-2 rounded-xl text-sm font-medium transition
                                            {{ $period === 'month'
                                                ? 'bg-[#003260] text-white'
                                                : 'bg-[#003260]/5 text-[#003260] hover:bg-[#003260]/10' }}"
                                    >
                                        ماه جاری
                                    </a>

                                    <a
                                        href="{{ route('manager.bills', ['period' => '3months']) }}"
                                        data-period="3months"
                                        class="period-filter px-4 py-2 rounded-xl text-sm font-medium transition
                                            {{ $period === '3months'
                                                ? 'bg-[#003260] text-white'
                                                : 'bg-[#003260]/5 text-[#003260] hover:bg-[#003260]/10' }}"
                                    >
                                        ۳ ماه گذشته
                                    </a>

                                    <a
                                        href="{{ route('manager.bills', ['period' => '6months']) }}"
                                        data-period="6months"
                                        class="period-filter px-4 py-2 rounded-xl text-sm font-medium transition
                                            {{ $period === '6months'
                                                ? 'bg-[#003260] text-white'
                                                : 'bg-[#003260]/5 text-[#003260] hover:bg-[#003260]/10' }}"
                                    >
                                        ۶ ماه گذشته
                                    </a>

                                    <a
                                        href="{{ route('manager.bills', ['period' => 'year']) }}"
                                        data-period="year"
                                        class="period-filter px-4 py-2 rounded-xl text-sm font-medium transition
                                            {{ $period === 'year'
                                                ? 'bg-[#003260] text-white'
                                                : 'bg-[#003260]/5 text-[#003260] hover:bg-[#003260]/10' }}"
                                    >
                                        یک سال گذشته
                                    </a>

                                </div>

                            </div>

                        </div>

                        <div class="p-5 sm:p-6 lg:p-7">

                            <!-- Summary Cards -->
                            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 mb-8">

                                <!-- Total Expenses -->
                                <div class="rounded-2xl bg-[#003260] text-white p-5">

                                    <div class="text-xs text-white/60">
                                        مجموع هزینه‌های دوره
                                    </div>

                                    <div
                                        id="totalExpensesValue"
                                        class="mt-3 text-2xl font-bold modir-bold"
                                    >
                                        {{ toPersianDigits(number_format($totalExpenses)) }}
                                    </div>

                                    <div class="mt-1 text-xs text-white/50">
                                        تومان
                                    </div>

                                </div>


                                <!-- Bills -->
                                <div class="rounded-2xl border border-[#003260]/5 bg-[#F8F9FA] p-5">

                                    <div class="text-xs text-[#003260]/55">
                                        مجموع قبوض
                                    </div>

                                    <div
                                        id="totalBillsValue"
                                        class="mt-3 text-2xl font-bold modir-bold text-[#2563EB]"
                                    >
                                        {{ toPersianDigits(number_format($totalBills)) }}
                                    </div>

                                    <div class="mt-1 text-xs text-[#003260]/45">
                                        آب، برق و گاز
                                    </div>

                                </div>


                                <!-- Service Costs -->
                                <div class="rounded-2xl border border-[#003260]/5 bg-[#F8F9FA] p-5">

                                    <div class="text-xs text-[#003260]/55">
                                        هزینه‌های خدماتی
                                    </div>

                                    <div
                                        id="totalServiceExpensesValue"
                                        class="mt-3 text-2xl font-bold modir-bold text-[#7C3AED]"
                                    >
                                        {{ toPersianDigits(number_format($totalServiceExpenses)) }}
                                    </div>

                                    <div class="mt-1 text-xs text-[#003260]/45">
                                        سرایدار، آسانسور، فضای سبز و...
                                    </div>

                                </div>


                                <!-- Pending -->
                                <div class="rounded-2xl border border-[#003260]/5 bg-[#FFF8ED] p-5">

                                    <div class="text-xs text-[#003260]/55">
                                        پرداخت نشده
                                    </div>

                                    <div
                                        id="totalUnpaidExpensesValue"
                                        class="mt-3 text-2xl font-bold modir-bold text-[#EA580C]"
                                    >
                                        {{ toPersianDigits(number_format($totalUnpaidExpenses)) }}
                                    </div>

                                    <div
                                        id="unpaidExpensesCount"
                                        class="mt-1 text-xs text-[#003260]/45"
                                    >
                                        {{ toPersianDigits(number_format($unpaidExpensesCount)) }}
                                        هزینه پرداخت نشده
                                    </div>

                                    <!-- <div class="mt-1 text-xs text-[#003260]/45">
                                        تومان
                                    </div> -->

                                </div>

                            </div>

                        </div>

                    </div>

                </section>

                <section id="chartReprot" class="mt-6">
                    <div class="rounded-[28px] bg-white border border-[#003260]/5 shadow-sm overflow-hidden">

                        <!-- Header -->
                        <div class="p-5 sm:p-6 lg:p-7 border-b border-[#003260]/5">

                            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

                                <div>

                                    <h2 class="text-xl font-bold modir-bold text-[#003260]">
                                        تحلیل و بررسی قبوض و هزینه‌ها
                                    </h2>

                                    <p class="mt-2 text-sm text-[#003260]/55 leading-6">
                                        نمودار روند قبوض و هزینه‌های خدماتی ساختمان را در بازه‌های زمانی مختلف تحلیل و بررسی کنید.
                                    </p>

                                </div>

                            </div>

                        </div>

                        <div class="p-5 sm:p-6 lg:p-7">

                            <!-- Chart + Filters -->
                            <div class="grid lg:grid-cols-[1.5fr_360px] gap-6">

                                <!-- Chart Card -->
                                <div class="rounded-3xl border border-[#003260]/5 bg-[#FAFBFC] p-5">

                                    <div class="flex items-center justify-between mb-6">

                                        <div>

                                            <h3 class="font-bold text-[#003260]">
                                                روند هزینه‌ها
                                            </h3>

                                            <p class="text-xs text-[#003260]/45 mt-1">
                                                مقایسه قبوض و هزینه‌های خدماتی در ماه‌های اخیر
                                            </p>

                                        </div>

                                        <!-- <span class="text-xs text-[#003260]/50 bg-white px-3 py-1 rounded-full border border-[#003260]/5">
                                            سال ۱۴۰۵
                                        </span> -->

                                    </div>

                                    <!-- Dynamic BestModir Charts -->
                                        <!-- نمودار خطی: تبلت و نمایشگرهای بزرگ -->
                                        <div class="relative hidden sm:block w-full min-w-0 max-w-full h-[320px] overflow-hidden">
                                            <canvas id="expensesChart" class="block w-full max-w-full"></canvas>
                                        </div>

                                        <!-- نمودار دوناتی: موبایل -->
                                        <div
                                            id="expensesDoughnutWrapper"
                                            class="relative block sm:hidden mx-auto w-full max-w-[320px] h-[280px] min-w-0"
                                        >
                                            <canvas
                                                id="expensesDoughnutChart"
                                                class="block w-full max-w-full"
                                            ></canvas>
                                        </div>
                                    <!-- ./Dynamic BestModir Charts -->

                                </div>



                                <!-- Right Panel -->
                                <div class="flex flex-col gap-5">

                                    <!-- Categories -->
                                    <div class="rounded-3xl border border-[#003260]/5 bg-[#FAFBFC] p-5">

                                        <h3 class="font-bold text-[#003260] mb-5">
                                            نمایش دسته‌های هزینه
                                        </h3>

                                        <div class="space-y-4">

                                            <label class="flex items-center justify-between cursor-pointer">

                                                <div class="flex items-center gap-3">

                                                    <input type="checkbox" checked data-chart="water" class="accent-[#2563EB] w-4 h-4">

                                                    <span class="w-3 h-3 rounded-full bg-[#2563EB]"></span>

                                                    <span class="text-sm text-[#003260]">
                                                        قبض آب
                                                    </span>

                                                </div>

                                                <span class="text-xs text-[#003260]/45">
                                                    آبی
                                                </span>

                                            </label>


                                            <label class="flex items-center justify-between cursor-pointer">

                                                <div class="flex items-center gap-3">

                                                    <input type="checkbox" checked data-chart="electricity" class="accent-[#F59E0B] w-4 h-4">

                                                    <span class="w-3 h-3 rounded-full bg-[#F59E0B]"></span>

                                                    <span class="text-sm text-[#003260]">
                                                        قبض برق
                                                    </span>

                                                </div>

                                                <span class="text-xs text-[#003260]/45">
                                                    نارنجی
                                                </span>

                                            </label>


                                            <label class="flex items-center justify-between cursor-pointer">

                                                <div class="flex items-center gap-3">

                                                    <input type="checkbox" checked data-chart="gas" class="accent-[#16A34A] w-4 h-4">

                                                    <span class="w-3 h-3 rounded-full bg-[#16A34A]"></span>

                                                    <span class="text-sm text-[#003260]">
                                                        قبض گاز
                                                    </span>

                                                </div>

                                                <span class="text-xs text-[#003260]/45">
                                                    سبز
                                                </span>

                                            </label>


                                            <label class="flex items-center justify-between cursor-pointer">

                                                <div class="flex items-center gap-3">

                                                    <input type="checkbox" checked data-chart="services" class="accent-[#7C3AED] w-4 h-4">

                                                    <span class="w-3 h-3 rounded-full bg-[#7C3AED]"></span>

                                                    <span class="text-sm text-[#003260]">
                                                        هزینه‌های خدماتی
                                                    </span>

                                                </div>

                                                <span class="text-xs text-[#003260]/45">
                                                    بنفش
                                                </span>

                                            </label>

                                        </div>

                                    </div>


                                    <!-- Date Range Selector -->
                                    <div class="rounded-3xl border border-[#003260]/5 bg-[#FAFBFC] p-5">

                                        <h3 class="font-bold text-[#003260] mb-4">
                                            انتخاب بازه زمانی
                                        </h3>

                                        <div class="space-y-4">

                                            <!-- Start Date -->
                                            <div>
                                                <label for="start_date"
                                                       class="block text-xs text-[#003260]/60 mb-2">
                                                    از تاریخ
                                                </label>

                                                <button
                                                    type="button"
                                                    id="start_date"
                                                    data-date-picker="start_date"
                                                    class="jalali-date-trigger w-full h-12 rounded-xl border border-[#003260]/10 px-4 text-sm text-[#003260] bg-white outline-none hover:border-[#003260]/30 transition flex items-center justify-between cursor-pointer">

                                                    <input type="hidden" id="start_date_value" value="">

                                                    <span class="selected-date">انتخاب تاریخ شروع</span>

                                                    <svg class="w-5 h-5 text-[#003260]/50"
                                                         viewBox="0 0 24 24"
                                                         fill="none"
                                                         stroke="currentColor"
                                                         stroke-width="1.8">
                                                        <rect x="3" y="5" width="18" height="16" rx="2"/>
                                                        <path d="M16 3v4M8 3v4M3 10h18"/>
                                                    </svg>

                                                </button>
                                            </div>

                                            <!-- End Date -->
                                            <div>
                                                <label for="end_date"
                                                       class="block text-xs text-[#003260]/60 mb-2">
                                                    تا تاریخ
                                                </label>

                                                <button
                                                    type="button"
                                                    id="end_date"
                                                    data-date-picker="end_date"
                                                    class="jalali-date-trigger w-full h-12 rounded-xl border border-[#003260]/10 px-4 text-sm text-[#003260] bg-white outline-none hover:border-[#003260]/30 transition flex items-center justify-between cursor-pointer">

                                                    <input type="hidden" id="end_date_value" value="">

                                                    <span class="selected-date">انتخاب تاریخ پایان</span>

                                                    <svg class="w-5 h-5 text-[#003260]/50"
                                                         viewBox="0 0 24 24"
                                                         fill="none"
                                                         stroke="currentColor"
                                                         stroke-width="1.8">
                                                        <rect x="3" y="5" width="18" height="16" rx="2"/>
                                                        <path d="M16 3v4M8 3v4M3 10h18"/>
                                                    </svg>

                                                </button>
                                            </div>

                                            <!-- Report Button -->
                                            <button
                                                type="button"
                                                id="applyExpenseDateRange"
                                                class="w-full h-12 rounded-xl bg-[#003260] text-white text-sm font-semibold hover:bg-[#003260]/90 transition cursor-pointer modir-bold">
                                                نمایش گزارش
                                            </button>

                                            <p id="expenseDateRangeError"
                                               class="hidden text-xs text-red-600 leading-6">
                                            </p>

                                        </div>
                                    </div>

                                </div>

                            </div>

                            <!-- Bottom Legend Cards -->
                            <div class="grid sm:grid-cols-2 xl:grid-cols-4 gap-4 mt-8">

                                <!-- Water -->
                                <div class="rounded-2xl border border-[#003260]/5 p-4">

                                    <div class="flex items-center gap-3">
                                        <span class="w-3 h-3 rounded-full bg-[#2563EB]"></span>

                                        <span class="text-sm text-[#003260]/70">
                                            قبض آب
                                        </span>
                                    </div>

                                    <div
                                        id="waterTotal"
                                        data-expense-total="water"
                                        class="mt-3 text-lg font-bold text-[#003260] modir-bold"
                                        dir="rtl"
                                    >
                                        ۰ تومان
                                    </div>

                                </div>

                                <!-- Electricity -->
                                <div class="rounded-2xl border border-[#003260]/5 p-4">

                                    <div class="flex items-center gap-3">
                                        <span class="w-3 h-3 rounded-full bg-[#F59E0B]"></span>

                                        <span class="text-sm text-[#003260]/70">
                                            قبض برق
                                        </span>
                                    </div>

                                    <div
                                        id="electricityTotal"
                                        data-expense-total="electricity"
                                        class="mt-3 text-lg font-bold text-[#003260] modir-bold"
                                        dir="rtl"
                                    >
                                        ۰ تومان
                                    </div>

                                </div>

                                <!-- Gas -->
                                <div class="rounded-2xl border border-[#003260]/5 p-4">

                                    <div class="flex items-center gap-3">
                                        <span class="w-3 h-3 rounded-full bg-[#16A34A]"></span>

                                        <span class="text-sm text-[#003260]/70">
                                            قبض گاز
                                        </span>
                                    </div>

                                    <div
                                        id="gasTotal"
                                        data-expense-total="gas"
                                        class="mt-3 text-lg font-bold text-[#003260] modir-bold"
                                        dir="rtl"
                                    >
                                        ۰ تومان
                                    </div>

                                </div>

                                <!-- Services -->
                                <div class="rounded-2xl border border-[#003260]/5 p-4">

                                    <div class="flex items-center gap-3">
                                        <span class="w-3 h-3 rounded-full bg-[#7C3AED]"></span>

                                        <span class="text-sm text-[#003260]/70">
                                            هزینه‌های خدماتی
                                        </span>
                                    </div>

                                    <div
                                        id="servicesTotal"
                                        data-expense-total="services"
                                        class="mt-3 text-lg font-bold text-[#003260] modir-bold"
                                        dir="rtl"
                                    >
                                        ۰ تومان
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </section>


                <!-- ===================================================== -->
                <!-- Expenses Search, Filters & List -->
                <!-- ===================================================== -->

                <section class="mt-6">

                    @php
                        $categoryLabels = [
                            'water' => 'قبض آب',
                            'electricity' => 'قبض برق',
                            'gas' => 'قبض گاز',
                        ];

                        $categoryStyles = [
                            'water' => 'bg-blue-50 text-blue-700',
                            'electricity' => 'bg-orange-50 text-orange-700',
                            'gas' => 'bg-emerald-50 text-emerald-700',
                            'service' => 'bg-violet-50 text-violet-700',
                        ];

                        $categoryIcons = [
                            'water' => 'text-blue-600 bg-blue-50',
                            'electricity' => 'text-orange-600 bg-orange-50',
                            'gas' => 'text-emerald-600 bg-emerald-50',
                            'service' => 'text-violet-600 bg-violet-50',
                        ];
                    @endphp

                    <div class="rounded-[28px] bg-white border border-[#003260]/5 shadow-sm overflow-hidden">

                        <!-- Header -->
                        <div class="p-5 sm:p-6 lg:p-7 border-b border-[#003260]/5">

                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                                <div>
                                    <h2 class="text-xl font-bold modir-bold text-[#003260]">
                                        جستجو و فیلتر هزینه‌ها
                                    </h2>

                                    <p class="mt-1 text-sm text-[#003260]/55">
                                        قبض‌ها و هزینه‌های خدماتی را بر اساس مشخصات موردنظر پیدا کنید.
                                    </p>
                                </div>

                                <div class="text-sm text-[#003260]/50">
                                    @if ($expenses->total() > 0)
                                        نمایش
                                        <span class="font-semibold text-[#003260]">
                                            {{ toPersianDigits($expenses->firstItem()) }}
                                            تا
                                            {{ toPersianDigits($expenses->lastItem()) }}
                                        </span>
                                        مورد
                                    @else
                                        <span class="font-semibold text-[#003260]">۰</span>
                                        مورد
                                    @endif
                                </div>

                            </div>

                        </div>

                        <!-- Search & Filters -->
                        <form
                            id="expenseFiltersForm"
                            method="GET"
                            action="{{ url()->current() }}"
                            class="p-5 sm:p-6 lg:p-7"
                        >

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">

                                <!-- Search -->
                                <div class="sm:col-span-2">

                                    <label
                                        for="expenseSearch"
                                        class="block mb-2 text-sm font-medium text-[#003260]"
                                    >
                                        جستجو
                                    </label>

                                    <div class="relative">

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="19"
                                            height="19"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="absolute right-4 top-1/2 -translate-y-1/2 text-[#003260]/35 pointer-events-none"
                                        >
                                            <circle cx="11" cy="11" r="8"/>
                                            <path d="m21 21-4.3-4.3"/>
                                        </svg>

                                        <input
                                            type="text"
                                            id="expenseSearch"
                                            name="search"
                                            value="{{ $search }}"
                                            placeholder="جستجوی عنوان یا توضیحات هزینه..."
                                            autocomplete="off"
                                            class="w-full h-12 rounded-xl border border-[#003260]/10 bg-white pr-11 pl-4 text-sm text-[#003260] outline-none transition placeholder:text-[#003260]/30 focus:border-[#003260]/30 focus:ring-4 focus:ring-[#003260]/5"
                                        >

                                    </div>

                                </div>

                                <!-- Category -->
                                <div>

                                    <label
                                        for="expenseCategory"
                                        class="block mb-2 text-sm font-medium text-[#003260]"
                                    >
                                        دسته‌بندی هزینه
                                    </label>

                                    <select
                                        id="expenseCategory"
                                        name="category"
                                        class="w-full h-12 rounded-xl border border-[#003260]/10 bg-white px-4 text-sm text-[#003260] outline-none transition focus:border-[#003260]/30 focus:ring-4 focus:ring-[#003260]/5"
                                    >
                                        <option value="all" @selected($category === 'all')>
                                            همه
                                        </option>

                                        <option value="bills" @selected($category === 'bills')>
                                            قبوض
                                        </option>

                                        <option value="water" @selected($category === 'water')>
                                            قبض آب
                                        </option>

                                        <option value="electricity" @selected($category === 'electricity')>
                                            قبض برق
                                        </option>

                                        <option value="gas" @selected($category === 'gas')>
                                            قبض گاز
                                        </option>

                                        <option value="services" @selected($category === 'services')>
                                            هزینه‌های خدماتی
                                        </option>
                                    </select>

                                </div>

                                <!-- Payment Status -->
                                <div>

                                    <label
                                        for="paymentStatus"
                                        class="block mb-2 text-sm font-medium text-[#003260]"
                                    >
                                        وضعیت پرداخت
                                    </label>

                                    <select
                                        id="paymentStatus"
                                        name="payment_status"
                                        class="w-full h-12 rounded-xl border border-[#003260]/10 bg-white px-4 text-sm text-[#003260] outline-none transition focus:border-[#003260]/30 focus:ring-4 focus:ring-[#003260]/5"
                                    >
                                        <option value="all" @selected($paymentStatus === 'all')>
                                            همه
                                        </option>

                                        <option value="paid" @selected($paymentStatus === 'paid')>
                                            پرداخت شده
                                        </option>

                                        <option value="unpaid" @selected($paymentStatus === 'unpaid')>
                                            پرداخت نشده
                                        </option>
                                    </select>

                                </div>

                                <!-- Sort -->
                                <div>

                                    <label
                                        for="expenseSort"
                                        class="block mb-2 text-sm font-medium text-[#003260]"
                                    >
                                        مرتب‌سازی
                                    </label>

                                    <select
                                        id="expenseSort"
                                        name="sort"
                                        class="w-full h-12 rounded-xl border border-[#003260]/10 bg-white px-4 text-sm text-[#003260] outline-none transition focus:border-[#003260]/30 focus:ring-4 focus:ring-[#003260]/5"
                                    >
                                        <option value="newest" @selected($sort === 'newest')>
                                            جدیدترین
                                        </option>

                                        <option value="oldest" @selected($sort === 'oldest')>
                                            قدیمی‌ترین
                                        </option>

                                        <option value="highest" @selected($sort === 'highest')>
                                            بیشترین مبلغ
                                        </option>

                                        <option value="lowest" @selected($sort === 'lowest')>
                                            کمترین مبلغ
                                        </option>
                                    </select>

                                </div>

                            </div>

                            <!-- Filter Actions -->
                            <div class="mt-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                                <div class="flex items-center gap-2 text-xs text-[#003260]/45">

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="16"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >
                                        <circle cx="12" cy="12" r="10"/>
                                        <path d="M12 8v4"/>
                                        <path d="M12 16h.01"/>
                                    </svg>

                                    <span>
                                        جستجو و فیلترها را می‌توانید همزمان استفاده کنید.
                                    </span>

                                </div>

                                <div class="flex flex-col sm:flex-row gap-2">

                                    <button
                                        type="submit"
                                        class="inline-flex items-center justify-center gap-2 h-11 px-5 rounded-xl bg-[#003260] text-white text-sm font-bold hover:bg-[#003260]/90 transition modir-bold cursor-pointer"
                                    >
                                        اعمال فیلترها
                                    </button>

                                    <button
                                        id="clearExpenseFilters"
                                        type="button"
                                        class="inline-flex items-center justify-center gap-2 h-11 px-5 rounded-xl border border-[#003260]/10 bg-white text-sm font-medium text-[#003260]/70 hover:bg-[#003260]/5 hover:text-[#003260] transition cursor-pointer"
                                    >

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="18"
                                            height="18"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        >
                                            <path d="M3 6h18"/>
                                            <path d="M8 6v14"/>
                                            <path d="M16 6v14"/>
                                            <path d="M5 6l1-3h12l1 3"/>
                                        </svg>

                                        پاک کردن فیلترها

                                    </button>

                                </div>

                            </div>

                        </form>

                        <!-- List Header -->
                        <div id="bills-list" class="px-5 sm:px-6 lg:px-7 pt-7 pb-5 border-t border-[#003260]/5">

                            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">

                                <div>
                                    <h2 class="text-xl font-bold text-[#003260] modir-bold">
                                        لیست هزینه‌ها
                                    </h2>

                                    <p class="mt-1 text-sm text-[#003260]/60">
                                        آخرین قبوض و هزینه‌های خدماتی ثبت‌شده برای ساختمان
                                    </p>
                                </div>

                                <div class="text-sm text-[#003260]/55">
                                    مجموع
                                    <span class="font-bold text-[#003260]">
                                        {{ toPersianDigits($expenses->total()) }}
                                    </span>
                                    هزینه
                                </div>

                            </div>

                        </div>

                        <!-- Expenses List -->
                        <div id="expensesList" class="overflow-hidden">

                            <!-- Desktop Header -->
                            <div class="hidden lg:grid lg:grid-cols-[1.8fr_1fr_1fr_1fr_140px] gap-4 items-center px-6 py-4 bg-[#f8f7f4] border-b border-[#003260]/8 text-xs font-bold text-[#003260]/55">

                                <div>عنوان هزینه</div>
                                <div>دسته‌بندی</div>
                                <div>تاریخ</div>
                                <div>مبلغ</div>
                                <div class="text-center">وضعیت</div>

                            </div>

                            @forelse ($expenses as $expense)

                                @php
                                    $expenseCategory = $expense->type === 'service'
                                        ? 'service'
                                        : ($expense->category ?? '');

                                    $categoryLabel = $expense->type === 'service'
                                        ? 'هزینه خدماتی'
                                        : ($categoryLabels[$expense->category] ?? 'قبض');

                                    $categoryStyle = $categoryStyles[$expenseCategory]
                                        ?? 'bg-slate-100 text-slate-700';

                                    $iconStyle = $categoryIcons[$expenseCategory]
                                        ?? 'text-slate-600 bg-slate-100';

                                    $jalaliDate = \Morilog\Jalali\Jalalian::fromCarbon(
                                        \Illuminate\Support\Carbon::parse($expense->date)
                                    )->format('Y/m/d');

                                    $paymentStatusValue = $expense->payment_status;

                                    $statusLabel = match ($paymentStatusValue) {
                                        'paid' => 'پرداخت شده',
                                        'unpaid' => 'پرداخت نشده',
                                        default => 'تعیین نشده',
                                    };

                                    $statusStyle = match ($paymentStatusValue) {
                                        'paid' => 'bg-emerald-50 text-emerald-700',
                                        'unpaid' => 'bg-rose-50 text-rose-700',
                                        default => 'bg-slate-100 text-slate-600',
                                    };

                                    $statusDot = match ($paymentStatusValue) {
                                        'paid' => 'bg-emerald-500',
                                        'unpaid' => 'bg-rose-500',
                                        default => 'bg-slate-400',
                                    };
                                @endphp

                                <article
                                    data-expense-id="{{ $expense->id }}"
                                    data-expense-type="{{ $expense->type }}"
                                    class="expense-row group px-5 lg:px-6 py-5 border-b border-[#afadad] hover:bg-[#faf9f7] transition cursor-pointer"
                                    tabindex="0"
                                    role="button"
                                    aria-label="مشاهده و ویرایش {{ $expense->title }}"
                                >

                                    <!-- Main Row -->
                                    <div class="grid lg:grid-cols-[1.8fr_1fr_1fr_1fr_140px] gap-4 items-center">

                                        <!-- Title -->
                                        <div class="flex items-center gap-4 min-w-0">

                                            <div class="w-11 h-11 rounded-2xl {{ $iconStyle }} flex items-center justify-center shrink-0">

                                                @if ($expenseCategory === 'water')
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M12 3c-2.5 3.5-6 7-6 11a6 6 0 0 0 12 0c0-4-3.5-7.5-6-11z"/>
                                                    </svg>
                                                @elseif ($expenseCategory === 'electricity')
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M13 2 4 14h7l-1 8 10-12h-7l0-8z"/>
                                                    </svg>
                                                @elseif ($expenseCategory === 'gas')
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M12 22a7 7 0 0 0 7-7c0-4-4-6-4-11-3 2-4 5-4 7-2-1-3-3-3-3-1 3-3 5-3 8a7 7 0 0 0 7 6z"/>
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M12 3v18"/>
                                                        <path d="M5 8h14"/>
                                                        <path d="M7 8l-3 7h6L7 8z"/>
                                                        <path d="m17 8-3 7h6l-3-7z"/>
                                                        <path d="M5 21h14"/>
                                                    </svg>
                                                @endif

                                            </div>

                                            <div class="min-w-0">

                                                <div class="font-bold text-[#003260] break-words">
                                                    {{ $expense->title }}
                                                </div>

                                                <div class="text-xs text-[#003260]/50 mt-1 line-clamp-2">
                                                    {{ $expense->description ?: 'بدون توضیحات' }}
                                                </div>

                                            </div>

                                        </div>

                                        <!-- Category -->
                                        <div class="hidden lg:block">
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-xl {{ $categoryStyle }} text-xs font-bold">
                                                {{ $categoryLabel }}
                                            </span>
                                        </div>

                                        <!-- Date -->
                                        <div class="hidden lg:block text-sm text-[#003260]/65">
                                            {{ toPersianDigits($jalaliDate) }}
                                        </div>

                                        <!-- Amount -->
                                        <div class="hidden lg:block">
                                            <div class="font-bold text-[#003260]">
                                                {{ toPersianDigits(number_format((int) $expense->amount)) }}
                                            </div>

                                            <div class="text-xs text-[#003260]/45 mt-1">
                                                تومان
                                            </div>
                                        </div>

                                        <!-- Payment Status -->
                                        <div class="hidden lg:flex justify-center">
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl {{ $statusStyle }} text-xs font-bold">
                                                <span class="w-1.5 h-1.5 rounded-full {{ $statusDot }}"></span>
                                                {{ $statusLabel }}
                                            </span>
                                        </div>

                                    </div>

                                    <!-- Mobile Details -->
                                    <div class="lg:hidden mt-4 pt-4 border-t border-[#003260]/7 grid grid-cols-2 gap-4">

                                        <div>
                                            <div class="text-[11px] text-[#003260]/45 mb-1">
                                                دسته‌بندی
                                            </div>

                                            <span class="inline-flex px-2.5 py-1 rounded-lg {{ $categoryStyle }} text-xs font-bold">
                                                {{ $categoryLabel }}
                                            </span>
                                        </div>

                                        <div>
                                            <div class="text-[11px] text-[#003260]/45 mb-1">
                                                تاریخ
                                            </div>

                                            <div class="text-xs font-bold text-[#003260]">
                                                {{ toPersianDigits($jalaliDate) }}
                                            </div>
                                        </div>

                                        <div>
                                            <div class="text-[11px] text-[#003260]/45 mb-1">
                                                مبلغ
                                            </div>

                                            <div class="text-sm font-bold text-[#003260]">
                                                {{ toPersianDigits(number_format((int) $expense->amount)) }}
                                                تومان
                                            </div>
                                        </div>

                                        <div>
                                            <div class="text-[11px] text-[#003260]/45 mb-1">
                                                وضعیت
                                            </div>

                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg {{ $statusStyle }} text-xs font-bold">
                                                <span class="w-1.5 h-1.5 rounded-full {{ $statusDot }}"></span>
                                                {{ $statusLabel }}
                                            </span>
                                        </div>

                                    </div>

                                </article>

                            @empty

                                <!-- Empty State -->
                                <div class="px-5 py-16 text-center">

                                    <div class="w-16 h-16 mx-auto rounded-2xl bg-[#003260]/5 text-[#003260]/45 flex items-center justify-center">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M8 6h13"/>
                                            <path d="M8 12h13"/>
                                            <path d="M8 18h13"/>
                                            <path d="M3 6h.01"/>
                                            <path d="M3 12h.01"/>
                                            <path d="M3 18h.01"/>
                                        </svg>

                                    </div>

                                    <h3 class="mt-4 font-bold text-[#003260]">
                                        هزینه‌ای پیدا نشد
                                    </h3>

                                    <p class="mt-2 text-sm text-[#003260]/55">
                                        @if ($search !== '' || $category !== 'all' || $paymentStatus !== 'all')
                                            عبارت جستجو یا فیلترهای انتخاب‌شده را تغییر دهید.
                                        @else
                                            هنوز قبض یا هزینه‌ای برای این ساختمان ثبت نشده است.
                                        @endif
                                    </p>

                                </div>

                            @endforelse
                            <!-- Pagination -->
                            @php
                                $persianDigits = [
                                    '0' => '۰', '1' => '۱', '2' => '۲',
                                    '3' => '۳', '4' => '۴', '5' => '۵',
                                    '6' => '۶', '7' => '۷', '8' => '۸',
                                    '9' => '۹',
                                ];

                                $from = $expenses->firstItem() ?? 0;
                                $to = $expenses->lastItem() ?? 0;
                                $total = $expenses->total();
                            @endphp

                            @if ($expenses->hasPages() || $total > 0)
                                <div class="mt-5 p-4 flex flex-col sm:flex-row items-center justify-between gap-4">

                                    <div class="text-xs text-[#003260]/50">
                                        نمایش
                                        {{ strtr((string) $from, $persianDigits) }}
                                        تا
                                        {{ strtr((string) $to, $persianDigits) }}
                                        از
                                        {{ strtr((string) $total, $persianDigits) }}
                                        هزینه
                                    </div>

                                    <div class="flex items-center gap-1.5">

                                        <!-- Previous -->
                                        <a
                                            href="{{ $expenses->previousPageUrl() ? $expenses->previousPageUrl() . '#bills-list' : '#' }}"
                                            @if (!$expenses->previousPageUrl()) aria-disabled="true" tabindex="-1" @endif
                                            class="w-10 h-10 rounded-xl border border-[#003260]/10 flex items-center justify-center
                                                {{ $expenses->onFirstPage()
                                                    ? 'bg-white text-[#003260]/30 cursor-not-allowed pointer-events-none'
                                                    : 'bg-white text-[#003260] hover:bg-[#f8f7f4] transition' }}"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 width="18" height="18" viewBox="0 0 24 24"
                                                 fill="none" stroke="currentColor" stroke-width="1.8"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path d="m9 18 6-6-6-6" />
                                            </svg>
                                        </a>

                                        <!-- Page Numbers -->
                                        @foreach ($expenses->getUrlRange(1, $expenses->lastPage()) as $page => $url)
                                            <a
                                                href="{{ $url . '#bills-list' }}"
                                                @if ($page === $expenses->currentPage()) aria-current="page" @endif
                                                class="w-10 h-10 rounded-xl flex items-center justify-center text-sm font-bold modir-bold transition
                                                    {{ $page === $expenses->currentPage()
                                                        ? 'bg-[#003260] text-white shadow-sm'
                                                        : 'bg-white border border-[#003260]/10 text-[#003260]/70 hover:bg-[#f8f7f4]' }}"
                                            >
                                                {{ strtr((string) $page, $persianDigits) }}
                                            </a>
                                        @endforeach

                                        <!-- Next -->
                                        <a
                                            href="{{ $expenses->nextPageUrl() ? $expenses->nextPageUrl() . '#bills-list' : '#' }}"
                                            @if (!$expenses->hasMorePages()) aria-disabled="true" tabindex="-1" @endif
                                            class="w-10 h-10 rounded-xl border border-[#003260]/10 flex items-center justify-center
                                                {{ !$expenses->hasMorePages()
                                                    ? 'bg-white text-[#003260]/30 cursor-not-allowed pointer-events-none'
                                                    : 'bg-white text-[#003260] hover:bg-[#f8f7f4] transition' }}"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 width="18" height="18" viewBox="0 0 24 24"
                                                 fill="none" stroke="currentColor" stroke-width="1.8"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path d="m15 18-6-6 6-6" />
                                            </svg>
                                        </a>

                                    </div>
                                </div>
                            @endif

                        </div>

                    </div>

                </section>

            </main>

            <!-- Bill Modal -->
            <div id="billModal"
                 class="fixed inset-0 z-[90] hidden items-center justify-center p-4">

                <!-- Overlay -->
                <div data-close-modal="billModal"
                     class="absolute inset-0 bg-[#003260]/60 backdrop-blur-sm"></div>

                <!-- Modal Content -->
                <div class="relative z-10 w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-[28px] bg-white shadow-2xl">

                    <!-- Header -->
                    <div class="sticky top-0 z-10 flex items-center justify-between gap-4 border-b border-[#003260]/10 bg-white px-6 py-5">

                        <div>
                            <h2 class="text-xl font-bold modir-bold text-[#003260]">
                                ثبت قبض جدید
                            </h2>

                            <p class="mt-1 text-sm text-[#003260]/60">
                                اطلاعات قبض ساختمان را وارد کنید.
                            </p>
                        </div>

                        <button type="button"
                                data-close-modal="billModal"
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#003260]/5 text-[#003260] transition hover:bg-[#003260]/10 cursor-pointer"
                                aria-label="بستن مودال">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 width="20"
                                 height="20"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 stroke-linecap="round"
                                 stroke-linejoin="round">
                                <path d="M18 6 6 18"/>
                                <path d="m6 6 12 12"/>
                            </svg>
                        </button>

                    </div>

                    <!-- Form will be added in the next step -->
                    <div class="p-6">
                        <!-- Bill Form -->
                        <form
                            id="billForm"
                            action="{{ route('manager.bills.store-bill') }}"
                            method="POST"
                            enctype="multipart/form-data"
                            class="p-6 space-y-6"
                        >
                            @csrf

                            <!-- نوع قبض -->
                            <div>
                                <label for="billCategory" class="mb-2 block text-sm font-bold text-[#003260]">
                                    نوع قبض
                                </label>

                                <select id="billCategory"
                                        name="category"
                                        required
                                        class="w-full rounded-2xl border border-[#003260]/15 bg-white px-4 py-3.5 text-sm text-[#003260] outline-none transition focus:border-[#003260] focus:ring-2 focus:ring-[#003260]/10">
                                    <option value="">انتخاب نوع قبض</option>
                                    <option value="water">آب</option>
                                    <option value="electricity">برق</option>
                                    <option value="gas">گاز</option>
                                </select>
                            </div>

                            <!-- مبلغ قبض -->
                            <div>
                                <label for="billAmount" class="mb-2 block text-sm font-bold text-[#003260]">
                                    مبلغ قبض (تومان)
                                </label>

                                <div class="relative">
                                    <input type="text"
                                            name="amount"
                                            id="billAmount"
                                            inputmode="numeric"
                                            dir="ltr"
                                            maxlength="12"
                                            minlength="3"
                                            placeholder="مثلاً ۲۵۰,۰۰۰"
                                            required
                                           class="w-full rounded-2xl border border-[#003260]/15 bg-white px-4 py-3.5 pl-16 text-sm text-[#003260] outline-none transition focus:border-[#003260] focus:ring-2 focus:ring-[#003260]/10">

                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-[#003260]/50">
                                        تومان
                                    </span>
                                </div>
                            </div>

                            <!-- تاریخ قبض -->
                            <div>
                                <label for="bill_date" class="mb-2 block text-sm font-bold text-[#003260]">
                                    تاریخ قبض
                                </label>

                                <button type="button"
                                        id="bill_date"
                                        data-date-picker="bill"
                                        class="w-full rounded-2xl border border-[#003260]/15 bg-white px-4 py-3.5 text-right text-sm text-[#003260]/70 outline-none transition hover:border-[#003260]/40 focus:border-[#003260] cursor-pointer">
                                    انتخاب تاریخ قبض
                                </button>

                                <input type="hidden"
                                       id="bill_date_value"
                                       name="date"
                                       required>
                            </div>

                            <!-- تصویر قبض -->
                            <div>
                                <label for="billImage" class="mb-2 block text-sm font-bold text-[#003260]">
                                    تصویر قبض
                                    <span class="font-normal text-[#003260]/50">(اختیاری)</span>
                                </label>

                                <input type="file"
                                       id="billImage"
                                       name="image"
                                       accept="image/jpeg,image/png,image/webp"
                                       class="block w-full rounded-2xl border border-[#003260]/15 bg-white p-3 text-sm text-[#003260] file:ml-3 file:rounded-xl file:border-0 file:bg-[#003260]/5 file:px-4 file:py-2 file:font-medium file:text-[#003260]">

                                <p class="mt-2 text-xs leading-6 text-[#003260]/50">
                                    فرمت‌های مجاز: JPG، PNG و WebP
                                </p>
                            </div>

                            <!-- جدای از شارژ -->

                            <!-- روش تقسیم هزینه قبض -->
                            <div class="rounded-2xl border border-[#003260]/10 bg-[#003260]/[0.03] p-4 space-y-4">
                                <div>
                                    <label for="billDistributionMethod"
                                           class="mb-2 block text-sm font-bold text-[#003260]">
                                        نحوه محاسبه سهم واحدها
                                    </label>

                                    <select id="billDistributionMethod"
                                            name="distribution_method"
                                            class="w-full rounded-2xl border border-[#003260]/15 bg-white px-4 py-3.5 text-sm text-[#003260] outline-none focus:border-[#003260]">
                                        <option value="building_fund" selected>
                                            پرداخت از صندوق ساختمان
                                        </option>
                                        <option value="per_unit">
                                            تقسیم مساوی بین واحدها
                                        </option>
                                        <option value="per_person">
                                            تقسیم بر اساس تعداد ساکنان
                                        </option>
                                    </select>

                                    <p class="mt-2 text-xs leading-6 text-[#003260]/60">
                                        در حالت صندوق ساختمان، برای واحدها بدهی جدیدی ثبت نمی‌شود.
                                    </p>
                                </div>

                                <div id="billDistributionScopeWrap" class="hidden">
                                    <label for="billDistributionScope"
                                           class="mb-2 block text-sm font-bold text-[#003260]">
                                        واحدهای مشمول تقسیم
                                    </label>

                                    <select id="billDistributionScope"
                                            name="distribution_scope"
                                            class="w-full rounded-2xl border border-[#003260]/15 bg-white px-4 py-3.5 text-sm text-[#003260] outline-none focus:border-[#003260]">
                                        <option value="all_units">
                                            تمام واحدهای ساختمان
                                        </option>
                                        <option value="occupied_units">
                                            فقط واحدهای دارای ساکن فعلی
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- وضعیت پرداخت قبض -->
                            <div>
                                <label for="billPaymentStatus"
                                       class="mb-2 block text-sm font-bold text-[#003260]">
                                    وضعیت پرداخت قبض
                                </label>

                                <select id="billPaymentStatus"
                                        name="payment_status"
                                        required
                                        class="w-full rounded-2xl border border-[#003260]/15 bg-white px-4 py-3.5 text-sm text-[#003260] outline-none transition focus:border-[#003260] focus:ring-2 focus:ring-[#003260]/10">

                                    <option value="unpaid" selected>
                                        پرداخت نشده
                                    </option>

                                    <option value="paid">
                                        پرداخت شده
                                    </option>

                                </select>

                                <p class="mt-2 text-xs leading-6 text-[#003260]/55">
                                    این وضعیت مشخص می‌کند که مدیر قبض را پرداخت کرده است یا خیر؛
                                    مستقل از تسویه سهم واحدهای ساختمان است.
                                </p>
                            </div>

                            <!-- توضیحات -->
                            <div>
                                <label for="billDescription" class="mb-2 block text-sm font-bold text-[#003260]">
                                    توضیحات
                                    <span class="font-normal text-[#003260]/50">(اختیاری)</span>
                                </label>

                                <textarea id="billDescription"
                                          name="description"
                                          rows="3"
                                          placeholder="توضیحات تکمیلی قبض..."
                                          class="w-full resize-y rounded-2xl border border-[#003260]/15 bg-white px-4 py-3.5 text-sm leading-7 text-[#003260] outline-none transition placeholder:text-[#003260]/35 focus:border-[#003260] focus:ring-2 focus:ring-[#003260]/10"></textarea>
                            </div>

                            <!-- Buttons -->
                            <div class="flex flex-col-reverse gap-3 border-t border-[#003260]/10 pt-5 sm:flex-row sm:justify-end">

                                <button type="button"
                                        data-close-modal="billModal"
                                        class="rounded-2xl border border-[#003260]/15 px-6 py-3 text-sm font-bold text-[#003260] transition hover:bg-[#003260]/5 modir-bold cursor-pointer">
                                    انصراف
                                </button>

                                <button type="submit"
                                        class="rounded-2xl bg-[#003260] px-6 py-3 text-sm font-bold text-white transition hover:bg-[#00447f] modir-bold cursor-pointer">
                                    ثبت قبض
                                </button>

                            </div>

                        </form>
                    </div>

                </div>
            </div> 
            
            <!-- Service Expense Modal -->
            <div id="serviceExpenseModal"
                 class="fixed inset-0 z-[90] hidden items-center justify-center p-4">

                <!-- Overlay -->
                <div data-close-modal="serviceExpenseModal"
                     class="absolute inset-0 bg-[#003260]/60 backdrop-blur-sm"></div>

                <!-- Modal Content -->
                <div class="relative z-10 w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-[28px] bg-white shadow-2xl">

                    <!-- Header -->
                    <div class="sticky top-0 z-10 flex items-center justify-between gap-4 border-b border-[#003260]/10 bg-white px-6 py-5">

                        <div>
                            <h2 class="text-xl font-bold modir-bold text-[#003260]">
                                ثبت هزینه خدماتی
                            </h2>

                            <p class="mt-1 text-sm text-[#003260]/60">
                                هزینه‌های تعمیرات، نگهداری و خدمات ساختمان را ثبت کنید.
                            </p>
                        </div>

                        <button type="button"
                                data-close-modal="serviceExpenseModal"
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#003260]/5 text-[#003260] transition hover:bg-[#003260]/10 cursor-pointer"
                                aria-label="بستن مودال">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 width="20"
                                 height="20"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 stroke-linecap="round"
                                 stroke-linejoin="round">
                                <path d="M18 6 6 18"/>
                                <path d="m6 6 12 12"/>
                            </svg>
                        </button>

                    </div>

                    <!-- Service Expense Form -->
                    <form id="serviceExpenseForm" action="{{ route('manager.bills.store-service-expense') }}" method="POST" enctype="multipart/form-data" class="space-y-6 p-6" >
                        @csrf

                        <!-- عنوان هزینه -->
                        <div>
                            <label for="serviceExpenseTitle"
                                   class="mb-2 block text-sm font-bold text-[#003260]">
                                عنوان هزینه
                            </label>

                            <input type="text"
                                   id="serviceExpenseTitle"
                                   name="title"
                                   required
                                   maxlength="255"
                                   placeholder="مثلاً سرویس آسانسور"
                                   class="w-full rounded-2xl border border-[#003260]/15 bg-white px-4 py-3.5 text-sm text-[#003260] outline-none transition placeholder:text-[#003260]/35 focus:border-[#003260] focus:ring-2 focus:ring-[#003260]/10">
                        </div>

                        <!-- مبلغ -->
                        <div>
                            <label for="serviceExpenseAmount"
                                   class="mb-2 block text-sm font-bold text-[#003260]">
                                مبلغ هزینه (تومان)
                            </label>

                            <div class="relative">
                                <input type="text"
                                        name="amount"
                                        id="serviceExpenseAmount"
                                        inputmode="numeric"
                                        dir="ltr"
                                        maxlength="12"
                                        minlength="3"
                                        placeholder="مثلاً ۲۵۰,۰۰۰"
                                        required
                                       class="w-full rounded-2xl border border-[#003260]/15 bg-white px-4 py-3.5 pl-16 text-sm text-[#003260] outline-none transition focus:border-[#003260] focus:ring-2 focus:ring-[#003260]/10">

                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-[#003260]/50">
                                    تومان
                                </span>
                            </div>
                        </div>

                        <!-- تاریخ -->
                        <div>
                            <label for="service_expense_date"
                                   class="mb-2 block text-sm font-bold text-[#003260]">
                                تاریخ هزینه
                            </label>

                            <button type="button"
                                    id="service_expense_date"
                                    data-date-picker="serviceExpense"
                                    class="w-full rounded-2xl border border-[#003260]/15 bg-white px-4 py-3.5 text-right text-sm text-[#003260]/70 outline-none transition hover:border-[#003260]/40 focus:border-[#003260] cursor-pointer">
                                انتخاب تاریخ هزینه
                            </button>

                            <input type="hidden"
                                   id="service_expense_date_value"
                                   name="date"
                                   required>
                        </div>

                        <!-- تصویر رسید -->
                        <div>
                            <label for="serviceExpenseImage"
                                   class="mb-2 block text-sm font-bold text-[#003260]">
                                تصویر فاکتور یا رسید
                                <span class="font-normal text-[#003260]/50">(اختیاری)</span>
                            </label>

                            <input type="file"
                                   id="serviceExpenseImage"
                                   name="image"
                                   accept="image/jpeg,image/png,image/webp"
                                   class="block w-full rounded-2xl border border-[#003260]/15 bg-white p-3 text-sm text-[#003260] file:ml-3 file:rounded-xl file:border-0 file:bg-[#003260]/5 file:px-4 file:py-2 file:font-medium file:text-[#003260]">

                            <p class="mt-2 text-xs leading-6 text-[#003260]/50">
                                فرمت‌های مجاز: JPG، PNG و WebP
                            </p>
                        </div>

                        <!-- مسئول پرداخت -->
                        <div>
                            <label for="serviceExpenseResponsibleParty"
                                   class="mb-2 block text-sm font-bold text-[#003260]">
                                مسئول پرداخت
                            </label>

                            <select id="serviceExpenseResponsibleParty"
                                    name="responsible_party"
                                    required
                                    class="w-full rounded-2xl border border-[#003260]/15 bg-white px-4 py-3.5 text-sm text-[#003260] outline-none transition focus:border-[#003260] focus:ring-2 focus:ring-[#003260]/10">

                                <option value="residents" selected>
                                    ساکنان
                                </option>

                                <option value="owners">
                                    مالکین
                                </option>

                            </select>
                        </div>

                        <!-- روش تقسیم هزینه خدماتی -->
                        <div class="rounded-2xl border border-[#003260]/10 bg-[#003260]/[0.03] p-4 space-y-4">
                            <div>
                                <label for="serviceDistributionMethod"
                                       class="mb-2 block text-sm font-bold text-[#003260]">
                                    نحوه محاسبه سهم واحدها
                                </label>

                                <select id="serviceDistributionMethod"
                                        name="distribution_method"
                                        class="w-full rounded-2xl border border-[#003260]/15 bg-white px-4 py-3.5 text-sm text-[#003260] outline-none focus:border-[#003260]">
                                    <option value="building_fund" selected>
                                        پرداخت از صندوق ساختمان
                                    </option>
                                    <option value="per_unit">
                                        تقسیم مساوی بین واحدها
                                    </option>
                                    <option value="per_person">
                                        تقسیم بر اساس تعداد ساکنان
                                    </option>
                                </select>

                                <p class="mt-2 text-xs leading-6 text-[#003260]/60">
                                    در حالت صندوق ساختمان، برای واحدها بدهی جدیدی ثبت نمی‌شود.
                                </p>
                            </div>

                            <div id="serviceDistributionScopeWrap" class="hidden">
                                <label for="serviceDistributionScope"
                                       class="mb-2 block text-sm font-bold text-[#003260]">
                                    واحدهای مشمول تقسیم
                                </label>

                                <select id="serviceDistributionScope"
                                        name="distribution_scope"
                                        class="w-full rounded-2xl border border-[#003260]/15 bg-white px-4 py-3.5 text-sm text-[#003260] outline-none focus:border-[#003260]">
                                    <option value="all_units">
                                        تمام واحدهای ساختمان
                                    </option>
                                    <option value="occupied_units">
                                        فقط واحدهای دارای ساکن فعلی
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!-- وضعیت پرداخت هزینه خدماتی -->
                        <div>
                            <label for="serviceExpensePaymentStatus"
                                   class="mb-2 block text-sm font-bold text-[#003260]">
                                وضعیت پرداخت هزینه
                            </label>

                            <select id="serviceExpensePaymentStatus"
                                    name="payment_status"
                                    required
                                    class="w-full rounded-2xl border border-[#003260]/15 bg-white px-4 py-3.5 text-sm text-[#003260] outline-none transition focus:border-[#003260] focus:ring-2 focus:ring-[#003260]/10">

                                <option value="unpaid" selected>
                                    پرداخت نشده
                                </option>

                                <option value="paid">
                                    پرداخت شده
                                </option>

                            </select>

                            <p class="mt-2 text-xs leading-6 text-[#003260]/55">
                                وضعیت پرداخت هزینه به تعمیرکار یا ارائه‌دهنده خدمات را مشخص کنید.
                                این گزینه مستقل از پرداخت سهم واحدهاست.
                            </p>
                        </div>

                        <!-- توضیحات -->
                        <div>
                            <label for="serviceExpenseDescription"
                                   class="mb-2 block text-sm font-bold text-[#003260]">
                                توضیحات
                                <span class="font-normal text-[#003260]/50">(اختیاری)</span>
                            </label>

                            <textarea id="serviceExpenseDescription"
                                      name="description"
                                      rows="3"
                                      placeholder="توضیحات تکمیلی هزینه..."
                                      class="w-full resize-y rounded-2xl border border-[#003260]/15 bg-white px-4 py-3.5 text-sm leading-7 text-[#003260] outline-none transition placeholder:text-[#003260]/35 focus:border-[#003260] focus:ring-2 focus:ring-[#003260]/10"></textarea>
                        </div>

                        <!-- Buttons -->
                        <div class="flex flex-col-reverse gap-3 border-t border-[#003260]/10 pt-5 sm:flex-row sm:justify-end">

                            <button type="button"
                                    data-close-modal="serviceExpenseModal"
                                    class="rounded-2xl border border-[#003260]/15 px-6 py-3 text-sm font-bold text-[#003260] transition hover:bg-[#003260]/5 modir-bold cursor-pointer">
                                انصراف
                            </button>

                            <button type="submit"
                                    class="rounded-2xl bg-[#003260] px-6 py-3 text-sm font-bold text-white transition hover:bg-[#00447f] modir-bold cursor-pointer">
                                ثبت هزینه
                            </button>

                        </div>

                    </form>

                </div>
            </div>

            <!-- Jalali Circular Wheel Date Picker -->
            <div id="jalaliDatePicker" class="fixed inset-0 z-[100] hidden items-end sm:items-center justify-center">

                <!-- Overlay -->
                <div
                    id="jalaliDatePickerOverlay"
                    class="absolute inset-0 bg-[#003260db]"
                ></div>


                <!-- Modal -->
                <div
                    id="jalaliDatePickerModal"
                    class="relative w-full sm:max-w-[470px] bg-white rounded-t-[32px] sm:rounded-[32px] shadow-2xl overflow-hidden"
                >

                    <!-- Header -->
                    <div class="px-6 pt-6 pb-5">

                        <div class="flex items-start justify-between gap-4">

                            <div>

                                <div class="flex items-center gap-2">

                                    <div class="w-9 h-9 rounded-xl bg-[#003260]/5 text-[#003260] flex items-center justify-center">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 24 24"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8"
                                             stroke-linecap="round"
                                             stroke-linejoin="round"
                                             class="w-4 h-4">
                                            <rect x="3" y="4" width="18" height="18" rx="2" />
                                            <path d="M16 2v4" />
                                            <path d="M8 2v4" />
                                            <path d="M3 10h18" />
                                        </svg>

                                    </div>

                                    <h3 class="text-lg modir-bold text-[#003260]">
                                        انتخاب تاریخ
                                    </h3>

                                </div>

                                <p
                                    id="jalaliDatePickerPreview"
                                    class="mt-2 text-xs text-slate-400"
                                >
                                    تاریخ را انتخاب کنید
                                </p>

                            </div>


                            <button
                                type="button"
                                id="jalaliDatePickerClose"
                                class="w-10 h-10 rounded-xl bg-slate-50 text-slate-500 flex items-center justify-center hover:bg-slate-100 transition cursor-pointer"
                            >

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.8"
                                     stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="w-5 h-5">
                                    <path d="M6 6l12 12" />
                                    <path d="M18 6 6 18" />
                                </svg>

                            </button>

                        </div>

                    </div>


                    <!-- Wheel Area -->
                    <div class="px-5 sm:px-8 pb-6">

                        <div
                            id="wheelPicker"
                            class="relative h-[270px] rounded-[26px] bg-slate-50 border border-slate-100 overflow-hidden select-none"
                        >

                            <!-- Top Shadow -->
                            <div
                                class="absolute inset-x-0 top-0 h-[95px] bg-gradient-to-b from-slate-50 via-slate-50/95 to-transparent z-20 pointer-events-none"
                            ></div>


                            <!-- Bottom Shadow -->
                            <div
                                class="absolute inset-x-0 bottom-0 h-[95px] bg-gradient-to-t from-slate-50 via-slate-50/95 to-transparent z-20 pointer-events-none"
                            ></div>


                            <!-- Center Selection -->
                            <div
                                class="absolute left-4 right-4 top-1/2 -translate-y-1/2 h-[54px] rounded-2xl bg-[#00326000] border border-[#003260]/10 shadow-sm z-10 pointer-events-none"
                            ></div>


                            <div
                                class="absolute left-4 right-4 top-1/2 -translate-y-1/2 h-[54px] rounded-2xl border-y border-[#003260]/10 z-20 pointer-events-none"
                            ></div>


                            <!-- Wheels -->
                            <div class="absolute inset-0 grid grid-cols-3">

                                <div
                                    id="wheelDay"
                                    class="wheel-column"
                                ></div>

                                <div
                                    id="wheelMonth"
                                    class="wheel-column"
                                ></div>

                                <div
                                    id="wheelYear"
                                    class="wheel-column"
                                ></div>

                            </div>

                        </div>


                        <!-- Labels -->
                        <div class="grid grid-cols-3 mt-3 text-center">

                            <span class="text-[11px] text-slate-400">
                                روز
                            </span>

                            <span class="text-[11px] text-slate-400">
                                ماه
                            </span>

                            <span class="text-[11px] text-slate-400">
                                سال
                            </span>

                        </div>

                    </div>


                    <!-- Footer -->
                    <div class="px-5 sm:px-8 pb-6">

                        <button
                            type="button"
                            id="jalaliDatePickerConfirm"
                            class="w-full h-12 rounded-xl bg-[#003260] text-white text-sm modir-bold shadow-lg shadow-[#003260]/15 hover:bg-[#003260]/90 active:scale-[0.99] transition cursor-pointer"
                        >
                            تأیید تاریخ
                        </button>

                    </div>

                </div>
            </div>

            <!-- مودال جزئیات، ویرایش و حذف قبض یا هزینه -->
            <div id="expenseEditModal"
                 class="fixed inset-0 z-[90] hidden items-center justify-center bg-[#001a33]/60 p-3 sm:p-5"
                 role="dialog"
                 aria-modal="true"
                 aria-labelledby="expenseEditModalTitle">

                <div class="w-full max-w-2xl max-h-[92vh] overflow-y-auto rounded-3xl bg-white shadow-2xl">

                    <!-- Header -->
                    <div class="sticky top-0 z-10 flex items-center justify-between gap-3 border-b border-[#003260]/10 bg-white px-5 py-4 sm:px-7">
                        <div>
                            <h2 id="expenseEditModalTitle" class="text-lg font-extrabold text-[#003260]">
                                جزئیات هزینه
                            </h2>
                            <p id="expenseEditModalSubtitle" class="mt-1 text-xs text-[#003260]/55">
                                مشاهده و ویرایش اطلاعات
                            </p>
                        </div>

                        <button type="button"
                                data-close-modal="expenseEditModal"
                                class="flex h-10 w-10 shrink-0 cursor-pointer items-center justify-center rounded-xl bg-[#e5e2dd]/60 text-[#003260] transition hover:bg-[#e5e2dd]"
                                aria-label="بستن پنجره">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round">
                                <path d="m18 6-12 12M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-5 p-5 sm:p-7">

                        <!-- پیام موفقیت یا خطا -->
                        <div id="expenseEditMessage"
                             class="hidden rounded-xl px-4 py-3 text-sm font-bold"
                             role="status"
                             aria-live="polite"></div>

                        <form id="expenseEditForm" method="POST" enctype="multipart/form-data" class="space-y-5">
                            @csrf

                            <input type="hidden" id="edit_expense_id" name="expense_id">
                            <input type="hidden" id="edit_expense_type" name="expense_type">

                            <!-- عنوان هزینه خدماتی -->
                            <div id="editServiceTitleWrap" class="hidden">
                                <label for="edit_expense_title"
                                       class="mb-2 block text-sm font-bold text-[#003260]">
                                    عنوان هزینه خدماتی
                                </label>
                                <input type="text"
                                       id="edit_expense_title"
                                       name="title"
                                       maxlength="255"
                                       class="w-full rounded-xl border border-[#003260]/15 px-4 py-3 text-sm text-[#003260] outline-none transition focus:border-[#003260]">
                            </div>

                            <!-- نوع قبض -->
                            <div id="editBillCategoryWrap" class="hidden">
                                <label for="edit_expense_category"
                                       class="mb-2 block text-sm font-bold text-[#003260]">
                                    نوع قبض
                                </label>
                                <select id="edit_expense_category"
                                        name="category"
                                        class="w-full cursor-pointer rounded-xl border border-[#003260]/15 bg-white px-4 py-3 text-sm text-[#003260] outline-none focus:border-[#003260]">
                                    <option value="water">آب</option>
                                    <option value="electricity">برق</option>
                                    <option value="gas">گاز</option>
                                </select>
                            </div>

                            <!-- مبلغ و تاریخ -->
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                                <div>
                                    <label for="edit_expense_amount"
                                           class="mb-2 block text-sm font-bold text-[#003260]">
                                        مبلغ (تومان)
                                    </label>
                                    <input type="text"
                                           id="edit_expense_amount"
                                           name="amount"
                                           inputmode="numeric"
                                           required
                                           class="w-full rounded-xl border border-[#003260]/15 px-4 py-3 text-sm text-[#003260] outline-none focus:border-[#003260]">
                                </div>

                                <div>
                                    <label class="mb-2 block text-sm font-bold text-[#003260]">
                                        تاریخ
                                    </label>

                                    <input type="hidden"
                                           id="edit_expense_date_value"
                                           name="date"
                                           required>

                                    <button type="button"
                                            id="edit_expense_date"
                                            data-date-picker="expenseEdit"
                                            class="flex min-h-[46px] w-full cursor-pointer items-center justify-between gap-2 rounded-xl border border-[#003260]/15 px-4 py-3 text-right text-sm text-[#003260] transition hover:bg-[#e5e2dd]/40">
                                        <span id="editExpenseDateLabel">انتخاب تاریخ</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                             stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="5" width="18" height="16" rx="2"/>
                                            <path d="M16 3v4M8 3v4M3 11h18"/>
                                        </svg>
                                    </button>
                                </div>

                            </div>

                            <!-- وضعیت پرداخت -->
                            <div>
                                <label for="edit_expense_payment_status"
                                       class="mb-2 block text-sm font-bold text-[#003260]">
                                    وضعیت پرداخت قبض یا هزینه
                                </label>
                                <select id="edit_expense_payment_status"
                                        name="payment_status"
                                        required
                                        class="w-full cursor-pointer rounded-xl border border-[#003260]/15 bg-white px-4 py-3 text-sm text-[#003260] outline-none focus:border-[#003260]">
                                    <option value="unpaid">پرداخت نشده</option>
                                    <option value="paid">پرداخت شده</option>
                                </select>
                            </div>

                            <!-- پرداخت‌کننده هزینه خدماتی -->
                            <div id="editResponsiblePartyWrap" class="hidden">
                                <label for="edit_expense_responsible_party"
                                       class="mb-2 block text-sm font-bold text-[#003260]">
                                    هزینه مربوط به
                                </label>
                                <select id="edit_expense_responsible_party"
                                        name="responsible_party"
                                        class="w-full cursor-pointer rounded-xl border border-[#003260]/15 bg-white px-4 py-3 text-sm text-[#003260] outline-none focus:border-[#003260]">
                                    <option value="residents">ساکنان</option>
                                    <option value="owners">مالکین</option>
                                </select>
                            </div>

                            <!-- توضیحات -->
                            <div>
                                <label for="edit_expense_description"
                                       class="mb-2 block text-sm font-bold text-[#003260]">
                                    توضیحات
                                </label>
                                <textarea id="edit_expense_description"
                                          name="description"
                                          rows="3"
                                          class="w-full resize-y rounded-xl border border-[#003260]/15 px-4 py-3 text-sm text-[#003260] outline-none focus:border-[#003260]"></textarea>
                            </div>

                            <!-- تصویر قبض یا فاکتور -->
                            <div>
                                <label for="edit_expense_image"
                                       class="mb-2 block text-sm font-bold text-[#003260]">
                                    تصویر قبض یا فاکتور (اختیاری)
                                </label>
                                <input type="file"
                                       id="edit_expense_image"
                                       name="image"
                                       accept="image/*"
                                       class="block w-full rounded-xl border border-[#003260]/15 p-3 text-sm text-[#003260] file:ml-3 file:cursor-pointer file:rounded-lg file:border-0 file:bg-[#e5e2dd] file:px-3 file:py-2 file:font-bold file:text-[#003260]">

                                <div id="editExpenseCurrentImageWrap" class="mt-3 hidden">
                                    <a id="editExpenseCurrentImage"
                                       href="#"
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       class="cursor-pointer text-sm font-bold text-blue-700 underline">
                                        مشاهده تصویر فعلی
                                    </a>

                                    <label class="mt-3 flex cursor-pointer items-center gap-2 text-sm text-rose-700">
                                        <input type="checkbox"
                                               name="remove_image"
                                               id="edit_expense_remove_image"
                                               value="1"
                                               class="cursor-pointer rounded border-rose-300">
                                        حذف تصویر فعلی
                                    </label>
                                </div>
                            </div>

                            <!-- تأیید حذف -->
                            <div id="expenseDeleteConfirmation"
                                 class="hidden rounded-2xl border border-rose-200 bg-rose-50 p-4">
                                <p id="expenseDeleteConfirmationText"
                                   class="text-sm font-bold leading-7 text-rose-800">
                                    آیا از حذف این مورد مطمئن هستید؟
                                </p>
                                <p class="mt-1 text-xs leading-6 text-rose-700">
                                    این عملیات قابل بازگشت نیست.
                                </p>

                                <div class="mt-4 flex flex-wrap gap-3">
                                    <button type="button"
                                            id="confirmExpenseDelete"
                                            class="cursor-pointer rounded-xl bg-rose-600 px-4 py-2.5 text-sm font-bold text-white transition hover:bg-rose-700">
                                        بله، حذف شود
                                    </button>

                                    <button type="button"
                                            id="cancelExpenseDelete"
                                            class="cursor-pointer rounded-xl border border-[#003260]/15 px-4 py-2.5 text-sm font-bold text-[#003260] transition hover:bg-white">
                                        انصراف
                                    </button>
                                </div>
                            </div>

                            <!-- دکمه‌ها -->
                            <div class="flex flex-col-reverse gap-3 border-t border-[#003260]/10 pt-5 sm:flex-row sm:items-center sm:justify-between">
                                <button type="button"
                                        id="showExpenseDeleteConfirmation"
                                        class="cursor-pointer rounded-xl border border-rose-200 px-4 py-3 text-sm font-bold text-rose-700 transition hover:bg-rose-50">
                                    حذف این مورد
                                </button>

                                <div class="flex flex-col gap-3 sm:flex-row">
                                    <button type="button"
                                            data-close-modal="expenseEditModal"
                                            class="cursor-pointer rounded-xl border border-[#003260]/15 px-5 py-3 text-sm font-bold text-[#003260] transition hover:bg-[#e5e2dd]/40">
                                        بستن
                                    </button>

                                    <button type="submit"
                                            id="saveExpenseEdit"
                                            class="cursor-pointer rounded-xl bg-[#003260] px-6 py-3 text-sm font-bold text-white transition hover:bg-[#00447f] disabled:cursor-not-allowed disabled:opacity-60 modir-bold">
                                        ذخیره تغییرات
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <style>
                #jalaliDatePicker .wheel-column {
                    position: relative;
                    height: 270px;
                    overflow: hidden;
                    touch-action: none;
                    cursor: grab;
                }

                #jalaliDatePicker .wheel-column.dragging {
                    cursor: grabbing;
                }

                #jalaliDatePicker .wheel-track {
                    position: absolute;
                    inset: 0;
                }

                #jalaliDatePicker .wheel-item {
                    position: absolute;
                    left: 0;
                    right: 0;
                    top: 0;
                    height: 54px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: #003260;
                    font-size: 16px;
                    font-weight: 500;
                    white-space: nowrap;
                    user-select: none;
                    will-change: transform, opacity;
                }

                #jalaliDatePicker .wheel-item.active {
                    color: #003260;
                    font-weight: 800;
                }
            </style>   

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const canvas = document.getElementById('expensesChart');
                    const doughnutCanvas = document.getElementById('expensesDoughnutChart');

                    if (typeof Chart === 'undefined' || (!canvas && !doughnutCanvas)) {
                        console.error('Chart.js بارگذاری نشده است یا کادر نمودار پیدا نشد.');
                        return;
                    }

                    const startDateInput = document.getElementById('start_date_value');
                    const endDateInput = document.getElementById('end_date_value');
                    const applyButton = document.getElementById('applyExpenseDateRange');
                    const errorElement = document.getElementById('expenseDateRangeError');
                    const checkboxes = document.querySelectorAll('[data-chart]');

                    const categories = [
                        {
                            id: 'water',
                            label: 'قبض آب',
                            color: '#2563EB',
                            totalSelectors: [
                                '[data-expense-total="water"]',
                                '#waterTotal',
                                '#waterTotalValue'
                            ]
                        },
                        {
                            id: 'electricity',
                            label: 'قبض برق',
                            color: '#F59E0B',
                            totalSelectors: [
                                '[data-expense-total="electricity"]',
                                '#electricityTotal',
                                '#electricityTotalValue'
                            ]
                        },
                        {
                            id: 'gas',
                            label: 'قبض گاز',
                            color: '#16A34A',
                            totalSelectors: [
                                '[data-expense-total="gas"]',
                                '#gasTotal',
                                '#gasTotalValue'
                            ]
                        },
                        {
                            id: 'services',
                            label: 'هزینه‌های خدماتی',
                            color: '#7C3AED',
                            totalSelectors: [
                                '[data-expense-total="services"]',
                                '#servicesTotal',
                                '#servicesTotalValue'
                            ]
                        }
                    ];

                    const middleValue = 475000;

                    let reportRequestController = null;
                    let requestNumber = 0;
                    let categoryAmounts = {
                        water: 0,
                        electricity: 0,
                        gas: 0,
                        services: 0
                    };

                    function toEnglishDigits(value) {
                        return String(value ?? '').replace(/[۰-۹٠-٩]/g, function (digit) {
                            const persianDigits = '۰۱۲۳۴۵۶۷۸۹';
                            const arabicDigits = '٠١٢٣٤٥٦٧٨٩';

                            if (persianDigits.includes(digit)) {
                                return String(persianDigits.indexOf(digit));
                            }

                            return String(arabicDigits.indexOf(digit));
                        });
                    }

                    function formatAmount(value) {
                        return new Intl.NumberFormat('fa-IR').format(
                            Number(value) || 0
                        ) + ' تومان';
                    }

                    function formatCompactAmount(value) {
                        return new Intl.NumberFormat('fa-IR', {
                            notation: 'compact',
                            maximumFractionDigits: 1
                        }).format(Number(value) || 0);
                    }

                    function showError(message) {
                        if (!errorElement) {
                            alert(message);
                            return;
                        }

                        errorElement.textContent = message;
                        errorElement.classList.remove('hidden');
                    }

                    function clearError() {
                        if (errorElement) {
                            errorElement.textContent = '';
                            errorElement.classList.add('hidden');
                        }
                    }

                    function isValidJalaliDate(value) {
                        const normalized = toEnglishDigits(value).replace(/-/g, '/');
                        const match = normalized.match(/^(\d{4})\/(\d{1,2})\/(\d{1,2})$/);

                        if (!match) {
                            return false;
                        }

                        const year = Number(match[1]);
                        const month = Number(match[2]);
                        const day = Number(match[3]);

                        if (year < 1200 || year > 1600 || month < 1 || month > 12) {
                            return false;
                        }

                        const leap = [1, 5, 9, 13, 17, 22, 26, 30].includes(year % 33);

                        const monthLength = month <= 6
                            ? 31
                            : month <= 11
                                ? 30
                                : leap ? 30 : 29;

                        return day >= 1 && day <= monthLength;
                    }

                    function normalizeDate(value) {
                        return toEnglishDigits(value).replace(/-/g, '/');
                    }

                    function findTotalElement(category) {
                        for (const selector of category.totalSelectors) {
                            const element = document.querySelector(selector);

                            if (element) {
                                return element;
                            }
                        }

                        return null;
                    }

                    function updateCategoryTotals(totals) {
                        categories.forEach(category => {
                            const element = findTotalElement(category);

                            if (element) {
                                element.textContent = formatAmount(totals[category.id]);
                            }
                        });
                    }

                    function isCategorySelected(categoryId) {
                        const checkbox = document.querySelector(
                            '[data-chart="' + categoryId + '"]'
                        );

                        // اگر چک‌باکس برای دسته‌ای وجود نداشته باشد، آن دسته انتخاب‌شده محسوب می‌شود.
                        return !checkbox || checkbox.checked;
                    }

                    function getSelectedTotal() {
                        return categories.reduce((total, category) => {
                            if (!isCategorySelected(category.id)) {
                                return total;
                            }

                            return total + (Number(categoryAmounts[category.id]) || 0);
                        }, 0);
                    }

                    /*
                     * متن وسط نمودار دوناتی
                     */
                    const doughnutCenterTextPlugin = {
                        id: 'expensesDoughnutCenterText',

                        afterDraw(chartInstance) {
                            if (chartInstance.config.type !== 'doughnut') {
                                return;
                            }

                            // هنگام نمایش جزئیات، متن وسط نمودار رسم نشود.
                            if (chartInstance.tooltip && chartInstance.tooltip.opacity > 0) {
                                return;
                            }

                            const { ctx, chartArea } = chartInstance;

                            if (!chartArea) {
                                return;
                            }

                            const centerX = (chartArea.left + chartArea.right) / 2;
                            const centerY = (chartArea.top + chartArea.bottom) / 2;
                            const total = getSelectedTotal();

                            ctx.save();
                            ctx.textAlign = 'center';
                            ctx.textBaseline = 'middle';
                            ctx.direction = 'rtl';

                            ctx.fillStyle = '#64748B';
                            ctx.font = '12px sans-serif';
                            ctx.fillText('مجموع هزینه‌ها', centerX, centerY - 12);

                            ctx.fillStyle = '#003260';
                            ctx.font = 'bold 17px sans-serif';
                            ctx.fillText(formatCompactAmount(total), centerX, centerY + 13);

                            ctx.restore();
                        }
                    };

                    /*
                     * ساخت دیتاست‌های نمودار خطی
                     */
                    const lineDatasets = categories.map(category => ({
                        label: category.label,
                        data: [],
                        originalData: [],
                        borderColor: category.color,
                        backgroundColor: category.color,
                        borderWidth: 2.5,
                        pointRadius: 3,
                        pointHoverRadius: 6,
                        pointBackgroundColor: '#FFFFFF',
                        pointBorderColor: category.color,
                        pointBorderWidth: 2,
                        tension: 0.38,
                        fill: false
                    }));

                    /*
                     * نمودار خطی برای نمایشگرهای بزرگ
                     */
                    let lineChart = null;

                    if (canvas) {
                        const chartWrapper = canvas.parentElement;

                        if (chartWrapper) {
                            chartWrapper.style.width = '100%';
                            chartWrapper.style.maxWidth = '100%';
                            chartWrapper.style.minWidth = '0';
                            chartWrapper.style.overflow = 'hidden';
                            chartWrapper.style.position = 'relative';
                        }

                        canvas.style.display = 'block';
                        canvas.style.maxWidth = '100%';

                        if (chartWrapper && chartWrapper.parentElement) {
                            chartWrapper.parentElement.style.minWidth = '0';
                        }

                        lineChart = new Chart(canvas, {
                            type: 'line',

                            data: {
                                labels: [],
                                datasets: lineDatasets
                            },

                            options: {
                                responsive: true,
                                maintainAspectRatio: false,

                                onResize(chartInstance, size) {
                                    const width = size.width || 0;

                                    chartInstance.options.scales.x.ticks.maxTicksLimit =
                                        width < 320 ? 2 :
                                        width < 400 ? 3 :
                                        width < 600 ? 4 : 6;
                                },

                                resizeDelay: 100,

                                layout: {
                                    autoPadding: true,
                                    padding: {
                                        top: 4,
                                        right: 4,
                                        bottom: 0,
                                        left: 2
                                    }
                                },

                                interaction: {
                                    mode: 'index',
                                    intersect: false
                                },

                                animation: {
                                    duration: 1400,
                                    easing: 'easeOutQuart',

                                    delay(context) {
                                        return context.type === 'data' &&
                                            context.mode === 'default'
                                            ? context.dataIndex * 65 + context.datasetIndex * 100
                                            : 0;
                                    }
                                },

                                transitions: {
                                    show: {
                                        animations: {
                                            colors: {
                                                from: 'transparent'
                                            },
                                            visible: {
                                                type: 'boolean',
                                                duration: 850
                                            }
                                        }
                                    },

                                    hide: {
                                        animations: {
                                            colors: {
                                                to: 'transparent'
                                            },
                                            visible: {
                                                type: 'boolean',
                                                duration: 850
                                            }
                                        }
                                    }
                                },

                                plugins: {
                                    legend: {
                                        display: false
                                    },

                                    tooltip: {
                                        rtl: true,
                                        textDirection: 'rtl',
                                        backgroundColor: '#003260',
                                        titleColor: '#FFFFFF',
                                        bodyColor: '#FFFFFF',
                                        padding: 12,
                                        cornerRadius: 10,
                                        displayColors: true,

                                        callbacks: {
                                            label(context) {
                                                return context.dataset.label + ': ' +
                                                    formatAmount(context.parsed.y);
                                            }
                                        }
                                    }
                                },

                                scales: {
                                    x: {
                                        offset: false,

                                        grid: {
                                            display: false
                                        },

                                        border: {
                                            display: false
                                        },

                                        ticks: {
                                            color: '#64748B',

                                            font: {
                                                family: 'inherit',
                                                size: 10
                                            },

                                            maxRotation: 0,
                                            minRotation: 0,
                                            autoSkip: true,
                                            maxTicksLimit: 6,
                                            padding: 4,
                                            crossAlign: 'near'
                                        }
                                    },

                                    y: {
                                        beginAtZero: true,
                                        min: 0,
                                        max: 1000000,

                                        border: {
                                            display: false
                                        },

                                        grid: {
                                            color: '#E5E7EB',
                                            drawTicks: false
                                        },

                                        ticks: {
                                            color: '#64748B',
                                            padding: 4,
                                            maxTicksLimit: 6,

                                            font: {
                                                family: 'inherit',
                                                size: 10
                                            },

                                            callback(value) {
                                                return formatCompactAmount(value);
                                            }
                                        }
                                    }
                                },

                                elements: {
                                    line: {
                                        capBezierPoints: true
                                    }
                                }
                            }
                        });
                    }

                    /*
                     * نمودار دوناتی مخصوص موبایل
                     */
                    let doughnutChart = null;

                    if (doughnutCanvas) {
                        const doughnutWrapper = doughnutCanvas.parentElement;

                        if (doughnutWrapper) {
                            doughnutWrapper.style.width = '100%';
                            doughnutWrapper.style.maxWidth = '320px';
                            doughnutWrapper.style.minWidth = '0';
                            doughnutWrapper.style.position = 'relative';
                            doughnutWrapper.style.marginLeft = 'auto';
                            doughnutWrapper.style.marginRight = 'auto';
                        }

                        doughnutCanvas.style.display = 'block';
                        doughnutCanvas.style.maxWidth = '100%';

                        doughnutChart = new Chart(doughnutCanvas, {
                            type: 'doughnut',

                            data: {
                                labels: categories.map(category => category.label),

                                datasets: [{
                                    data: categories.map(() => 0),

                                    backgroundColor: categories.map(category => category.color),
                                    borderColor: '#FFFFFF',
                                    borderWidth: 3,
                                    hoverBorderWidth: 3,
                                    hoverOffset: 7,
                                    spacing: 1
                                }]
                            },

                            plugins: [doughnutCenterTextPlugin],

                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                cutout: '70%',

                                animation: {
                                    duration: 850,
                                    easing: 'easeOutQuart'
                                },

                                interaction: {
                                    intersect: true,
                                    mode: 'nearest'
                                },

                                plugins: {
                                    legend: {
                                        display: false
                                    },

                                    tooltip: {
                                        rtl: true,
                                        textDirection: 'rtl',
                                        backgroundColor: '#003260',
                                        titleColor: '#FFFFFF',
                                        bodyColor: '#FFFFFF',
                                        padding: 12,
                                        cornerRadius: 10,

                                        callbacks: {
                                            label(context) {
                                                const amount = Number(context.raw) || 0;
                                                const total = getSelectedTotal();
                                                const percentage = total > 0
                                                    ? (amount / total) * 100
                                                    : 0;

                                                return [
                                                    context.label + ': ' + formatAmount(amount),
                                                    'سهم از کل: ' +
                                                        new Intl.NumberFormat('fa-IR', {
                                                            maximumFractionDigits: 1
                                                        }).format(percentage) + '٪'
                                                ];
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    }

                    /*
                     * به‌روزرسانی دوناتی براساس دسته‌های انتخاب‌شده
                     */
                    function updateDoughnut() {
                        if (!doughnutChart) {
                            return;
                        }

                        const values = categories.map(category => {
                            if (!isCategorySelected(category.id)) {
                                return 0;
                            }

                            return Math.max(0, Number(categoryAmounts[category.id]) || 0);
                        });

                        doughnutChart.data.datasets[0].data = values;

                        // مجموع وسط دونات نیز با تغییر تیک‌ها به‌روزرسانی می‌شود.
                        doughnutChart.update();

                        doughnutChart.resize();
                    }

                    /*
                     * دریافت گزارش و به‌روزرسانی هر دو نمودار
                     */
                    function updateChart(report) {
                        if (
                            !report ||
                            !Array.isArray(report.labels) ||
                            !Array.isArray(report.datasets)
                        ) {
                            throw new Error('ساختار اطلاعات گزارش معتبر نیست.');
                        }

                        const labels = report.labels;
                        const returnedDatasets = report.datasets;

                        if (lineChart) {
                            lineChart.stop();
                            lineChart.data.labels = labels;
                        }

                        categories.forEach((category, index) => {
                            const incoming = returnedDatasets.find(
                                dataset => dataset.id === category.id
                            );

                            const values = incoming && Array.isArray(incoming.data)
                                ? incoming.data.map(value => Number(value) || 0)
                                : labels.map(() => 0);

                            /*
                             * مبالغ واقعی گزارش از مجموع نقاط نمودار به دست می‌آیند،
                             * مگر اینکه سرور مجموع آن دسته را جداگانه ارسال کرده باشد.
                             */
                            const calculatedTotal = values.reduce(
                                (sum, value) => sum + value,
                                0
                            );

                            const serverTotal = report.totals &&
                                report.totals[category.id] !== undefined &&
                                report.totals[category.id] !== null
                                ? Number(report.totals[category.id])
                                : calculatedTotal;

                            categoryAmounts[category.id] = Math.max(
                                0,
                                Number.isFinite(serverTotal) ? serverTotal : calculatedTotal
                            );

                            if (lineChart) {
                                const dataset = lineChart.data.datasets[index];

                                dataset.label = category.label;
                                dataset.borderColor = category.color;
                                dataset.backgroundColor = category.color;
                                dataset.originalData = values;
                                dataset.data = values.map(() => middleValue);
                            }
                        });

                        if (lineChart) {
                            const allValues = lineChart.data.datasets.flatMap(
                                dataset => dataset.originalData
                            );

                            const largestValue = Math.max(1000000, ...allValues);

                            lineChart.options.scales.y.max =
                                Math.ceil(largestValue * 1.15 / 100000) * 100000;

                            lineChart.update('none');

                            requestAnimationFrame(() => {
                                lineChart.data.datasets.forEach((dataset, index) => {
                                    dataset.data = [...dataset.originalData];

                                    const checkbox = document.querySelector(
                                        '[data-chart="' + categories[index].id + '"]'
                                    );

                                    if (checkbox) {
                                        lineChart.setDatasetVisibility(index, checkbox.checked);
                                    }
                                });

                                lineChart.update({
                                    duration: 1400,
                                    easing: 'easeOutQuart'
                                });

                                lineChart.resize();
                            });
                        }

                        updateCategoryTotals(report.totals || {});
                        updateDoughnut();
                    }

                    /*
                     * دریافت گزارش با بازه تاریخ انتخاب‌شده
                     */
                    async function loadReport() {
                        clearError();

                        if (!startDateInput || !endDateInput) {
                            showError('فیلدهای تاریخ گزارش پیدا نشدند.');
                            return;
                        }

                        const startDate = normalizeDate(startDateInput.value);
                        const endDate = normalizeDate(endDateInput.value);

                        if (!isValidJalaliDate(startDate)) {
                            showError('لطفاً تاریخ شروع معتبر را انتخاب کنید.');
                            return;
                        }

                        if (!isValidJalaliDate(endDate)) {
                            showError('لطفاً تاریخ پایان معتبر را انتخاب کنید.');
                            return;
                        }

                        if (startDate > endDate) {
                            showError('تاریخ شروع نمی‌تواند بعد از تاریخ پایان باشد.');
                            return;
                        }

                        if (reportRequestController) {
                            reportRequestController.abort();
                        }

                        reportRequestController = new AbortController();
                        const currentRequest = ++requestNumber;

                        if (applyButton) {
                            applyButton.disabled = true;
                            applyButton.classList.add('opacity-60', 'cursor-wait');
                        }

                        try {
                            const url = new URL(window.location.href);

                            url.searchParams.set('report', 'chart');
                            url.searchParams.set('start_date', startDate);
                            url.searchParams.set('end_date', endDate);

                            const response = await fetch(url.toString(), {
                                method: 'GET',
                                headers: {
                                    'Accept': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest'
                                },
                                signal: reportRequestController.signal
                            });

                            const result = await response.json();

                            if (currentRequest !== requestNumber) {
                                return;
                            }

                            if (!response.ok) {
                                throw new Error(
                                    result.message || 'دریافت گزارش با خطا مواجه شد.'
                                );
                            }

                            updateChart(result);

                        } catch (error) {
                            if (error.name === 'AbortError') {
                                return;
                            }

                            console.error('خطا در دریافت گزارش هزینه‌ها:', error);

                            showError(
                                error.message || 'دریافت گزارش انجام نشد. دوباره تلاش کنید.'
                            );

                        } finally {
                            if (currentRequest === requestNumber && applyButton) {
                                applyButton.disabled = false;
                                applyButton.classList.remove('opacity-60', 'cursor-wait');
                            }
                        }
                    }

                    /*
                     * چک‌باکس‌ها هر دو نمودار را کنترل می‌کنند.
                     */
                    checkboxes.forEach(checkbox => {
                        checkbox.addEventListener('change', function () {
                            const index = categories.findIndex(
                                category => category.id === this.dataset.chart
                            );

                            if (index === -1) {
                                return;
                            }

                            if (lineChart) {
                                const dataset = lineChart.data.datasets[index];

                                if (this.checked) {
                                    lineChart.stop();

                                    dataset.data = dataset.originalData.map(() => middleValue);
                                    lineChart.setDatasetVisibility(index, true);
                                    lineChart.update('none');

                                    requestAnimationFrame(() => {
                                        dataset.data = [...dataset.originalData];

                                        lineChart.update({
                                            duration: 1400,
                                            easing: 'easeOutQuart'
                                        });
                                    });
                                } else {
                                    lineChart.hide(index);
                                }
                            }

                            updateDoughnut();
                        });
                    });

                    if (applyButton) {
                        applyButton.addEventListener('click', loadReport);
                    }

                    /*
                     * وقتی نمایشگر تغییر اندازه می‌دهد، اندازه هر دو نمودار
                     * دوباره محاسبه می‌شود؛ به‌خصوص بعد از نمایش/مخفی‌شدن آن‌ها.
                     */
                    window.addEventListener('resize', function () {
                        if (lineChart) {
                            lineChart.resize();
                        }

                        if (doughnutChart) {
                            doughnutChart.resize();
                        }
                    });

                    requestAnimationFrame(() => {
                        if (lineChart) {
                            lineChart.resize();
                        }

                        if (doughnutChart) {
                            doughnutChart.resize();
                        }
                    });
                });
            </script>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const modalTriggers = document.querySelectorAll('[data-open-modal]');
                    const modalClosers = document.querySelectorAll('[data-close-modal]');

                    function openModal(modalId) {
                        const modal = document.getElementById(modalId);

                        if (!modal) {
                            return;
                        }

                        modal.classList.remove('hidden');
                        modal.classList.add('flex');

                        document.body.classList.add('overflow-hidden');
                    }

                    function closeModal(modalId) {
                        const modal = document.getElementById(modalId);

                        if (!modal) {
                            return;
                        }

                        modal.classList.add('hidden');
                        modal.classList.remove('flex');

                        const openModals = document.querySelectorAll(
                            '[id$="Modal"].flex'
                        );

                        if (openModals.length === 0) {
                            document.body.classList.remove('overflow-hidden');
                        }
                    }

                    modalTriggers.forEach(function (trigger) {
                        trigger.addEventListener('click', function () {
                            openModal(this.dataset.openModal);
                        });
                    });

                    modalClosers.forEach(function (closer) {
                        closer.addEventListener('click', function () {
                            closeModal(this.dataset.closeModal);
                        });
                    });

                    document.addEventListener('keydown', function (event) {
                        if (event.key !== 'Escape') {
                            return;
                        }

                        document.querySelectorAll(
                            '[id$="Modal"]:not(.hidden)'
                        ).forEach(function (modal) {
                            closeModal(modal.id);
                        });
                    });
                });
            </script>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const picker = document.getElementById('jalaliDatePicker');
                    if (!picker) return;

                    const overlay = document.getElementById('jalaliDatePickerOverlay');
                    const closeButton = document.getElementById('jalaliDatePickerClose');
                    const confirmButton = document.getElementById('jalaliDatePickerConfirm');
                    const preview = document.getElementById('jalaliDatePickerPreview');

                    const dayContainer = document.getElementById('wheelDay');
                    const monthContainer = document.getElementById('wheelMonth');
                    const yearContainer = document.getElementById('wheelYear');

                    if (!dayContainer || !monthContainer || !yearContainer || !preview) {
                        console.error('اجزای مودال تاریخ غلتکی کامل نیستند.');
                        return;
                    }

                    const months = [
                        'فروردین', 'اردیبهشت', 'خرداد', 'تیر',
                        'مرداد', 'شهریور', 'مهر', 'آبان',
                        'آذر', 'دی', 'بهمن', 'اسفند'
                    ];

                    const toPersianNumber = value =>
                        String(value).replace(/\d/g, digit => '۰۱۲۳۴۵۶۷۸۹'[digit]);

                    const toEnglishNumber = value =>
                        String(value)
                            .replace(/[۰-۹]/g, digit =>
                                String('۰۱۲۳۴۵۶۷۸۹'.indexOf(digit))
                            )
                            .replace(/[٠-٩]/g, digit =>
                                String('٠١٢٣٤٥٦٧٨٩'.indexOf(digit))
                            );

                    const mod = (value, length) =>
                        ((value % length) + length) % length;

                    function getCurrentJalaliDate() {
                        const parts = new Intl.DateTimeFormat(
                            'en-u-ca-persian-nu-latn',
                            {
                                year: 'numeric',
                                month: 'numeric',
                                day: 'numeric'
                            }
                        ).formatToParts(new Date());

                        const part = type => Number(
                            parts.find(item => item.type === type)?.value
                        );

                        return {
                            year: part('year'),
                            month: part('month'),
                            day: part('day')
                        };
                    }

                    function isLeapJalaliYear(year) {
                        const breaks = [
                            -61, 9, 38, 199, 426, 686, 756, 818, 1111, 1181,
                            1210, 1635, 2060, 2097, 2192, 2262, 2347, 2381,
                            2454, 3178
                        ];

                        let leapJ = -14;
                        let jp = breaks[0];
                        let jump = 0;

                        for (let i = 1; i < breaks.length; i++) {
                            const jm = breaks[i];
                            jump = jm - jp;

                            if (year < jm) break;

                            leapJ += Math.floor(jump / 33) * 8
                                + Math.floor((jump % 33) / 4);

                            jp = jm;
                        }

                        let n = year - jp;

                        if (jump - n < 6) {
                            n = n - jump + Math.floor((jump + 4) / 33) * 33;
                        }

                        let leap = (((n + 1) % 33) - 1) % 4;
                        if (leap === -1) leap = 4;

                        return leap === 0;
                    }

                    function daysInMonth(year, month) {
                        if (month <= 6) return 31;
                        if (month <= 11) return 30;
                        return isLeapJalaliYear(year) ? 30 : 29;
                    }

                    let activeTarget = null;
                    let selectedDay = 1;
                    let selectedMonth = 1;
                    let selectedYear = 1405;

                    let dayWheel = null;
                    let monthWheel = null;
                    let yearWheel = null;

                    const currentDate = getCurrentJalaliDate();
                    const firstYear = 1340;
                    const lastYear = currentDate.year + 20;

                    // تنظیمات مقصدهای مختلف مودال
                    const dateConfig = {
                        bill: {
                            inputId: 'bill_date_value',
                            displayId: 'bill_date'
                        },
                        serviceExpense: {
                            inputId: 'service_expense_date_value',
                            displayId: 'service_expense_date'
                        },
                        start_date: {
                            inputId: 'start_date_value',
                            displayId: 'start_date'
                        },
                        end_date: {
                            inputId: 'end_date_value',
                            displayId: 'end_date'
                        },
                        expenseEdit: {
                            inputId: 'edit_expense_date_value',
                            displayId: 'editExpenseDateLabel'
                        }
                    };

                    class CircularWheel {
                        constructor(element, values, initialIndex, onChange) {
                            this.element = element;
                            this.values = values;
                            this.length = values.length;
                            this.itemHeight = 54;
                            this.centerY = 135;
                            this.position = initialIndex;
                            this.velocity = 0;
                            this.dragging = false;
                            this.pointerId = null;
                            this.lastY = 0;
                            this.lastTime = 0;
                            this.animationFrame = null;
                            this.onChange = onChange;

                            this.track = document.createElement('div');
                            this.track.className = 'wheel-track';
                            this.element.innerHTML = '';
                            this.element.appendChild(this.track);

                            this.items = [];

                            for (let slot = -3; slot <= 3; slot++) {
                                const item = document.createElement('div');
                                item.className = 'wheel-item';
                                this.track.appendChild(item);
                                this.items.push({ element: item, slot });
                            }

                            this.render();
                            this.bind();
                        }

                        render() {
                            const base = Math.floor(this.position);
                            const fraction = this.position - base;

                            this.items.forEach(({ element, slot }) => {
                                const index = mod(base + slot, this.length);
                                const distance = slot - fraction;
                                const absoluteDistance = Math.abs(distance);
                                const y = this.centerY - this.itemHeight / 2
                                    + distance * this.itemHeight;

                                element.style.transform =
                                    `translateY(${y}px) scale(${absoluteDistance < 0.5 ? 1.08 : absoluteDistance < 1.5 ? 1 : 0.92})`;

                                element.style.opacity =
                                    absoluteDistance < 0.5 ? 1
                                    : absoluteDistance < 1.5 ? 0.65
                                    : absoluteDistance < 2.5 ? 0.32 : 0;

                                element.textContent = this.values[index];
                                element.classList.toggle('active', absoluteDistance < 0.5);
                            });
                        }

                        getSelectedIndex() {
                            return mod(Math.round(this.position), this.length);
                        }

                        bind() {
                            this.element.addEventListener('pointerdown', event => {
                                this.stop();
                                this.dragging = true;
                                this.pointerId = event.pointerId;
                                this.lastY = event.clientY;
                                this.lastTime = performance.now();
                                this.velocity = 0;
                                this.element.classList.add('dragging');
                                this.element.setPointerCapture?.(event.pointerId);
                            });

                            this.element.addEventListener('pointermove', event => {
                                if (!this.dragging || event.pointerId !== this.pointerId) return;

                                const now = performance.now();
                                const deltaY = event.clientY - this.lastY;
                                const deltaTime = Math.max(1, now - this.lastTime);

                                this.lastY = event.clientY;
                                this.lastTime = now;
                                this.position -= deltaY / this.itemHeight;
                                this.velocity = (-deltaY / this.itemHeight) / deltaTime;
                                this.render();
                            });

                            const endDrag = event => {
                                if (!this.dragging || event.pointerId !== this.pointerId) return;

                                this.dragging = false;
                                this.element.classList.remove('dragging');
                                this.velocity = Math.max(
                                    -18,
                                    Math.min(18, this.velocity * 110)
                                );

                                if (Math.abs(this.velocity) < 0.08) {
                                    this.snap();
                                } else {
                                    this.inertia();
                                }
                            };

                            this.element.addEventListener('pointerup', endDrag);
                            this.element.addEventListener('pointercancel', endDrag);
                        }

                        inertia() {
                            const animate = () => {
                                if (this.dragging) return;

                                this.position += this.velocity;
                                this.velocity *= 0.94;
                                this.render();

                                if (Math.abs(this.velocity) > 0.012) {
                                    this.animationFrame = requestAnimationFrame(animate);
                                } else {
                                    this.snap();
                                }
                            };

                            this.animationFrame = requestAnimationFrame(animate);
                        }

                        snap() {
                            this.stop();

                            const start = this.position;
                            const target = Math.round(start);
                            const distance = target - start;
                            const startTime = performance.now();
                            const duration = 220;

                            const animate = now => {
                                const progress = Math.min(1, (now - startTime) / duration);
                                const eased = 1 - Math.pow(1 - progress, 3);

                                this.position = start + distance * eased;
                                this.render();

                                if (progress < 1) {
                                    this.animationFrame = requestAnimationFrame(animate);
                                    return;
                                }

                                this.position = target;
                                this.velocity = 0;
                                this.render();
                                this.onChange?.(this.getSelectedIndex());
                            };

                            this.animationFrame = requestAnimationFrame(animate);
                        }

                        stop() {
                            if (this.animationFrame !== null) {
                                cancelAnimationFrame(this.animationFrame);
                                this.animationFrame = null;
                            }
                        }

                        setIndex(index) {
                            this.stop();
                            this.position = index;
                            this.velocity = 0;
                            this.render();
                        }
                    }

                    function updatePreview() {
                        preview.textContent =
                            `${toPersianNumber(selectedDay)} ${months[selectedMonth - 1]} ${toPersianNumber(selectedYear)}`;
                    }

                    function rebuildDayWheel() {
                        if (dayWheel) dayWheel.stop();

                        const totalDays = daysInMonth(selectedYear, selectedMonth);
                        selectedDay = Math.min(selectedDay, totalDays);

                        const values = Array.from(
                            { length: totalDays },
                            (_, index) => toPersianNumber(index + 1)
                        );

                        dayWheel = new CircularWheel(
                            dayContainer,
                            values,
                            selectedDay - 1,
                            index => {
                                selectedDay = index + 1;
                                updatePreview();
                            }
                        );
                    }

                    function createMonthWheel() {
                        if (monthWheel) monthWheel.stop();

                        monthWheel = new CircularWheel(
                            monthContainer,
                            months,
                            selectedMonth - 1,
                            index => {
                                selectedMonth = index + 1;
                                rebuildDayWheel();
                                updatePreview();
                            }
                        );
                    }

                    function createYearWheel() {
                        if (yearWheel) yearWheel.stop();

                        const years = Array.from(
                            { length: lastYear - firstYear + 1 },
                            (_, index) => toPersianNumber(firstYear + index)
                        );

                        yearWheel = new CircularWheel(
                            yearContainer,
                            years,
                            selectedYear - firstYear,
                            index => {
                                selectedYear = firstYear + index;
                                rebuildDayWheel();
                                updatePreview();
                            }
                        );
                    }

                    function openPicker(target) {
                        const config = dateConfig[target];

                        if (!config) return;

                        const hiddenInput = document.getElementById(config.inputId);
                        if (!hiddenInput) {
                            console.error(`فیلد تاریخ پیدا نشد: ${config.inputId}`);
                            return;
                        }

                        activeTarget = target;

                        const today = getCurrentJalaliDate();

                        selectedYear = today.year;
                        selectedMonth = today.month;
                        selectedDay = today.day;

                        if (hiddenInput.value) {
                            const parts = toEnglishNumber(hiddenInput.value)
                                .split('-')
                                .map(Number);

                            if (
                                parts.length === 3 &&
                                parts.every(Number.isFinite) &&
                                parts[1] >= 1 &&
                                parts[1] <= 12 &&
                                parts[2] >= 1 &&
                                parts[2] <= 31
                            ) {
                                [selectedYear, selectedMonth, selectedDay] = parts;
                            }
                        }

                        selectedYear = Math.max(
                            firstYear,
                            Math.min(lastYear, selectedYear)
                        );

                        selectedMonth = Math.max(1, Math.min(12, selectedMonth));

                        selectedDay = Math.max(
                            1,
                            Math.min(
                                daysInMonth(selectedYear, selectedMonth),
                                selectedDay
                            )
                        );

                        rebuildDayWheel();
                        createMonthWheel();
                        createYearWheel();
                        updatePreview();

                        picker.classList.remove('hidden');
                        picker.classList.add('flex');
                        document.body.classList.add('overflow-hidden');
                    }

                    function closePicker() {
                        picker.classList.add('hidden');
                        picker.classList.remove('flex');

                        if (dayWheel) dayWheel.stop();
                        if (monthWheel) monthWheel.stop();
                        if (yearWheel) yearWheel.stop();

                        activeTarget = null;

                        const anotherModalOpen = [
                            'billModal',
                            'serviceExpenseModal'
                        ].some(id => {
                            const modal = document.getElementById(id);
                            return modal && modal.classList.contains('flex');
                        });

                        if (!anotherModalOpen) {
                            document.body.classList.remove('overflow-hidden');
                        }
                    }

                    // اتصال دکمه‌های تاریخ قبض، خدمات و گزارش
                    document.querySelectorAll('[data-date-picker]').forEach(button => {
                        const target = button.dataset.datePicker;

                        if (!dateConfig[target]) return;

                        button.addEventListener('click', () => {
                            openPicker(target);
                        });
                    });

                    closeButton?.addEventListener('click', closePicker);
                    overlay?.addEventListener('click', closePicker);

                    document.addEventListener('keydown', event => {
                        if (
                            event.key === 'Escape' &&
                            !picker.classList.contains('hidden')
                        ) {
                            closePicker();
                        }
                    });

                    // تأیید تاریخ انتخاب‌شده
                    confirmButton?.addEventListener('click', () => {
                        if (!activeTarget) return;

                        const config = dateConfig[activeTarget];
                        if (!config) return;

                        const hiddenInput = document.getElementById(config.inputId);
                        const displayButton = document.getElementById(config.displayId);

                        if (!hiddenInput || !displayButton) {
                            console.error('فیلد نمایش یا ذخیره تاریخ پیدا نشد.');
                            return;
                        }

                        hiddenInput.value =
                            `${selectedYear}-${String(selectedMonth).padStart(2, '0')}-${String(selectedDay).padStart(2, '0')}`;

                        const dateText =
                            `${toPersianNumber(selectedDay)} ${months[selectedMonth - 1]} ${toPersianNumber(selectedYear)}`;

                        const displayElement =
                            displayButton.querySelector('.selected-date') || displayButton;

                        displayElement.textContent = dateText;

                        displayButton.classList.remove('text-[#003260]/70');
                        displayButton.classList.add('text-[#003260]');

                        closePicker();
                    });
                });
            </script>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const amountInputIds = [
                        'billAmount',
                        'serviceExpenseAmount',
                        'edit_expense_amount'
                    ];

                    const amountInputs = amountInputIds
                        .map(id => document.getElementById(id))
                        .filter(Boolean);

                    const forms = [
                        document.getElementById('billForm'),
                        document.getElementById('serviceExpenseForm'),
                        document.getElementById('expenseEditForm')
                    ].filter(Boolean);

                    function toEnglishDigits(value) {
                        return String(value)
                            .replace(/[۰-۹]/g, digit =>
                                String('۰۱۲۳۴۵۶۷۸۹'.indexOf(digit))
                            )
                            .replace(/[٠-٩]/g, digit =>
                                String('٠١٢٣٤٥٦٧٨٩'.indexOf(digit))
                            );
                    }

                    function toPersianDigits(value) {
                        return String(value).replace(/[0-9]/g, digit =>
                            '۰۱۲۳۴۵۶۷۸۹'[Number(digit)]
                        );
                    }

                    function getDigits(value) {
                        return toEnglishDigits(value)
                            .replace(/\D/g, '')
                            .slice(0, 9);
                    }

                    function formatAmount(input) {
                        if (!input) return;

                        const digits = getDigits(input.value);

                        const formatted = digits.replace(
                            /\B(?=(\d{3})+(?!\d))/g,
                            ','
                        );

                        input.value = toPersianDigits(formatted);

                        input.setCustomValidity(
                            digits.length === 0
                                ? 'لطفاً مبلغ را وارد کنید.'
                                : digits.length < 3
                                    ? 'مبلغ باید حداقل ۳ رقم داشته باشد.'
                                    : ''
                        );
                    }

                    // برای استفاده مجدد در زمان بازشدن مودال ویرایش
                    window.formatExpenseAmount = function (input) {
                        formatAmount(input);
                    };

                    // قالب‌بندی اولیه و هنگام تایپ
                    amountInputs.forEach(function (input) {
                        input.addEventListener('input', function () {
                            formatAmount(input);
                        });

                        if (input.value.trim() !== '') {
                            formatAmount(input);
                        }
                    });

                    // اعتبارسنجی فرم‌ها
                    forms.forEach(function (form) {
                        const formAmountInputs = amountInputs.filter(input =>
                            form.contains(input)
                        );

                        formAmountInputs.forEach(function (input) {
                            input.addEventListener('invalid', function () {
                                if (input.validity.valueMissing) {
                                    input.setCustomValidity(
                                        'لطفاً مبلغ را وارد کنید.'
                                    );
                                }
                            });
                        });

                        form.addEventListener('submit', function (event) {
                            let valid = true;

                            formAmountInputs.forEach(function (input) {
                                const digits = getDigits(input.value);

                                if (digits.length === 0) {
                                    input.setCustomValidity(
                                        'لطفاً مبلغ را وارد کنید.'
                                    );
                                    input.reportValidity();
                                    valid = false;
                                } else if (digits.length < 3 || digits.length > 9) {
                                    input.setCustomValidity(
                                        'مبلغ باید بین ۳ تا ۹ رقم داشته باشد.'
                                    );
                                    input.reportValidity();
                                    valid = false;
                                } else {
                                    input.setCustomValidity('');
                                }
                            });

                            if (!valid) {
                                event.preventDefault();
                                return;
                            }

                            // فرم ویرایش با AJAX ارسال می‌شود.
                            // مقدار ورودی را تغییر نمی‌دهیم تا نمایش فارسی حفظ شود.
                            if (form.id === 'expenseEditForm') {
                                return;
                            }

                            // فرم‌های ثبت قبض و هزینه:
                            // ارسال مبلغ فارسی بدون جداکننده سه‌رقمی
                            formAmountInputs.forEach(function (input) {
                                input.value = toPersianDigits(getDigits(input.value));
                            });
                        });
                    });
                });
            </script>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const filters = document.querySelectorAll('.period-filter');

                    const values = {
                        totalExpenses: document.getElementById('totalExpensesValue'),
                        totalBills: document.getElementById('totalBillsValue'),
                        totalServiceExpenses: document.getElementById('totalServiceExpensesValue'),
                        totalUnpaidExpenses: document.getElementById('totalUnpaidExpensesValue'),
                        unpaidExpensesCount: document.getElementById('unpaidExpensesCount'),
                    };

                    const activeClasses = ['bg-[#003260]', 'text-white'];

                    const inactiveClasses = [
                        'bg-[#003260]/5',
                        'text-[#003260]',
                        'hover:bg-[#003260]/10'
                    ];

                    function toPersianDigits(value) {
                        return String(value).replace(/[0-9]/g, digit =>
                            '۰۱۲۳۴۵۶۷۸۹'[Number(digit)]
                        );
                    }

                    function formatAmount(value) {
                        return toPersianDigits(
                            Number(value || 0).toLocaleString('en-US')
                        );
                    }

                    filters.forEach(function (filter) {
                        filter.addEventListener('click', async function (event) {
                            event.preventDefault();

                            const period = filter.dataset.period;

                            filters.forEach(function (item) {
                                item.classList.remove(...activeClasses);
                                item.classList.add(...inactiveClasses);
                            });

                            filter.classList.remove(...inactiveClasses);
                            filter.classList.add(...activeClasses);

                            try {
                                const url = new URL(filter.href, window.location.origin);
                                url.searchParams.set('period', period);

                                const response = await fetch(url, {
                                    headers: {
                                        'Accept': 'application/json',
                                        'X-Requested-With': 'XMLHttpRequest'
                                    }
                                });

                                if (!response.ok) {
                                    throw new Error('دریافت آمار با خطا مواجه شد.');
                                }

                                const data = await response.json();

                                if (values.totalExpenses) {
                                    values.totalExpenses.textContent =
                                        formatAmount(data.totalExpenses);
                                }

                                if (values.totalBills) {
                                    values.totalBills.textContent =
                                        formatAmount(data.totalBills);
                                }

                                if (values.totalServiceExpenses) {
                                    values.totalServiceExpenses.textContent =
                                        formatAmount(data.totalServiceExpenses);
                                }

                                // به‌روزرسانی مبلغ پرداخت‌نشده
                                if (values.totalUnpaidExpenses) {
                                    values.totalUnpaidExpenses.textContent =
                                        formatAmount(data.totalUnpaidExpenses);
                                }

                                // به‌روزرسانی تعداد هزینه‌های پرداخت‌نشده
                                if (values.unpaidExpensesCount) {
                                    values.unpaidExpensesCount.textContent =
                                        formatAmount(data.unpaidExpensesCount) +
                                        ' هزینه پرداخت نشده';
                                }

                                window.history.replaceState({}, '', url);

                            } catch (error) {
                                console.error(error);
                                window.location.href = filter.href;
                            }
                        });
                    });
                });
            </script>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const modal = document.getElementById('expenseEditModal');
                    const form = document.getElementById('expenseEditForm');

                    if (!modal || !form) return;

                    const message = document.getElementById('expenseEditMessage');
                    const saveButton = document.getElementById('saveExpenseEdit');
                    const deleteConfirmation = document.getElementById('expenseDeleteConfirmation');
                    const deleteConfirmationText = document.getElementById('expenseDeleteConfirmationText');

                    let currentExpenseId = null;
                    let currentExpenseTitle = '';
                    let requestInProgress = false;

                    const detailsUrl = @json(route('manager.bills.show', ['expense' => '__ID__']));
                    const updateUrl = @json(route('manager.bills.update', ['expense' => '__ID__']));
                    const deleteUrl = @json(route('manager.bills.destroy', ['expense' => '__ID__']));

                    function makeUrl(template, id) {
                        return template.replace('__ID__', encodeURIComponent(id));
                    }

                    function openEditModal() {
                        modal.classList.remove('hidden');
                        modal.classList.add('flex');
                        document.body.classList.add('overflow-hidden');
                    }

                    function closeEditModal() {
                        modal.classList.add('hidden');
                        modal.classList.remove('flex');
                        deleteConfirmation.classList.add('hidden');

                        const otherOpenModals = Array.from(
                            document.querySelectorAll('[id$="Modal"]')
                        ).some(item => item !== modal && !item.classList.contains('hidden'));

                        if (!otherOpenModals) {
                            document.body.classList.remove('overflow-hidden');
                        }
                    }

                    function showMessage(text, success = false) {
                        message.textContent = text;
                        message.className = 'rounded-xl px-4 py-3 text-sm font-bold ' +
                            (success
                                ? 'bg-emerald-50 text-emerald-700'
                                : 'bg-rose-50 text-rose-700');
                        message.classList.remove('hidden');
                    }

                    function clearMessage() {
                        message.textContent = '';
                        message.classList.add('hidden');
                    }

                    async function readResponse(response) {
                        const result = await response.json().catch(() => ({}));

                        if (!response.ok) {
                            if (result.errors) {
                                const firstError = Object.values(result.errors).flat()[0];
                                throw new Error(firstError || 'لطفاً اطلاعات واردشده را بررسی کنید.');
                            }

                            throw new Error(
                                result.message || 'انجام عملیات با خطا مواجه شد.'
                            );
                        }

                        return result;
                    }

                    function setFieldValue(id, value) {
                        const element = document.getElementById(id);
                        if (element) element.value = value ?? '';
                    }

                    function setEditDate(date) {
                        setFieldValue('edit_expense_date_value', date);

                        const label = document.getElementById('editExpenseDateLabel');

                        if (label) {
                            const displayDate = date
                                ? String(date).replace(/[0-9]/g, digit =>
                                    '۰۱۲۳۴۵۶۷۸۹'[Number(digit)]
                                )
                                : 'انتخاب تاریخ';

                            label.textContent = displayDate;
                        }
                    }

                    function setImagePreview(url) {
                        const wrap = document.getElementById('editExpenseCurrentImageWrap');
                        const link = document.getElementById('editExpenseCurrentImage');
                        const removeCheckbox = document.getElementById('edit_expense_remove_image');

                        if (removeCheckbox) removeCheckbox.checked = false;

                        if (url) {
                            link.href = url;
                            wrap.classList.remove('hidden');
                        } else {
                            link.removeAttribute('href');
                            wrap.classList.add('hidden');
                        }
                    }

                    function showTypeFields(type) {
                        const isService = type === 'service';

                        document.getElementById('editServiceTitleWrap')
                            .classList.toggle('hidden', !isService);

                        document.getElementById('editBillCategoryWrap')
                            .classList.toggle('hidden', isService);

                        document.getElementById('editResponsiblePartyWrap')
                            .classList.toggle('hidden', !isService);

                        document.getElementById('edit_expense_title').required = isService;
                        document.getElementById('edit_expense_category').required = !isService;
                        document.getElementById('edit_expense_responsible_party').required = isService;
                    }

                    async function openExpense(expenseId) {
                        if (requestInProgress) return;

                        currentExpenseId = expenseId;
                        clearMessage();

                        form.reset();
                        deleteConfirmation.classList.add('hidden');
                        setImagePreview(null);
                        setEditDate('');

                        document.getElementById('expenseEditModalTitle').textContent =
                            'در حال دریافت اطلاعات...';

                        openEditModal();

                        try {
                            const response = await fetch(makeUrl(detailsUrl, expenseId), {
                                method: 'GET',
                                headers: {
                                    'Accept': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            });

                            const result = await readResponse(response);
                            const expense = result.expense || result;

                            currentExpenseId = expense.id;
                            currentExpenseTitle = expense.title || 'این هزینه';

                            setFieldValue('edit_expense_id', expense.id);
                            setFieldValue('edit_expense_type', expense.type);
                            setFieldValue('edit_expense_title', expense.title);
                            setFieldValue('edit_expense_category', expense.category);
                            setFieldValue('edit_expense_amount', expense.amount);

                            window.formatExpenseAmount(
                                document.getElementById('edit_expense_amount')
                            );

                            setFieldValue('edit_expense_payment_status', expense.payment_status || 'unpaid');
                            setFieldValue('edit_expense_responsible_party', expense.responsible_party || 'residents');
                            setFieldValue('edit_expense_description', expense.description);

                            setEditDate(expense.date || '');
                            setImagePreview(expense.image_url || null);
                            showTypeFields(expense.type);

                            document.getElementById('expenseEditModalTitle').textContent =
                                expense.title || 'جزئیات هزینه';

                            document.getElementById('expenseEditModalSubtitle').textContent =
                                expense.type === 'service' ? 'هزینه خدماتی' : 'قبض ساختمان';

                            if (result.has_obligations) {
                                showMessage(
                                    'برای این هزینه تعهد مالی ثبت شده است. هنگام ویرایش مبلغ، آثار آن بر تعهدات را بررسی کن.'
                                );
                            }
                        } catch (error) {
                            showMessage(error.message || 'دریافت اطلاعات ناموفق بود.');
                        }
                    }

                    // باز کردن جزئیات با کلیک روی ردیف
                    document.querySelectorAll('.expense-row[data-expense-id]').forEach(row => {
                        row.addEventListener('click', function (event) {
                            if (event.target.closest('button, a, input, select, textarea, label')) {
                                return;
                            }

                            openExpense(this.dataset.expenseId);
                        });

                        // پشتیبانی از صفحه‌کلید
                        row.addEventListener('keydown', function (event) {
                            if (event.target !== row) return;

                            if (event.key === 'Enter' || event.key === ' ') {
                                event.preventDefault();
                                openExpense(this.dataset.expenseId);
                            }
                        });
                    });

                    // ذخیره تغییرات
                    form.addEventListener('submit', async function (event) {
                        event.preventDefault();

                        if (requestInProgress || !currentExpenseId) return;

                        clearMessage();

                        const amount = document.getElementById('edit_expense_amount').value.trim();
                        const date = document.getElementById('edit_expense_date_value').value.trim();

                        if (!amount) {
                            showMessage('لطفاً مبلغ را وارد کن.');
                            return;
                        }

                        if (!date) {
                            showMessage('لطفاً تاریخ را انتخاب کن.');
                            return;
                        }

                        const formData = new FormData(form);
                        formData.set(
                            'amount',
                            document.getElementById('edit_expense_amount').value
                                .replace(/[۰-۹]/g, digit => String('۰۱۲۳۴۵۶۷۸۹'.indexOf(digit)))
                                .replace(/[٠-٩]/g, digit => String('٠١٢٣٤٥٦٧٨٩'.indexOf(digit)))
                                .replace(/\D/g, '')
                        );

                        formData.set('_method', 'PATCH');

                        requestInProgress = true;
                        saveButton.disabled = true;
                        saveButton.textContent = 'در حال ذخیره...';

                        try {
                            const response = await fetch(makeUrl(updateUrl, currentExpenseId), {
                                method: 'POST',
                                headers: {
                                    'Accept': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest'
                                },
                                body: formData
                            });

                            const result = await readResponse(response);

                            showMessage(result.message || 'تغییرات با موفقیت ذخیره شد.', true);

                            setTimeout(() => window.location.reload(), 900);
                        } catch (error) {
                            showMessage(error.message || 'ذخیره تغییرات ناموفق بود.');
                        } finally {
                            requestInProgress = false;
                            saveButton.disabled = false;
                            saveButton.textContent = 'ذخیره تغییرات';
                        }
                    });

                    // نمایش تأیید حذف
                    document.getElementById('showExpenseDeleteConfirmation')
                        .addEventListener('click', function () {
                            deleteConfirmationText.textContent =
                                `در حال حذف «${currentExpenseTitle}» هستید؛ مطمئنید؟`;

                            deleteConfirmation.classList.remove('hidden');
                            deleteConfirmation.scrollIntoView({
                                behavior: 'smooth',
                                block: 'nearest'
                            });
                        });

                    document.getElementById('cancelExpenseDelete')
                        .addEventListener('click', function () {
                            deleteConfirmation.classList.add('hidden');
                        });

                    // انجام حذف پس از تأیید
                    document.getElementById('confirmExpenseDelete')
                        .addEventListener('click', async function () {
                            if (requestInProgress || !currentExpenseId) return;

                            requestInProgress = true;
                            this.disabled = true;
                            this.textContent = 'در حال حذف...';

                            try {
                                const response = await fetch(makeUrl(deleteUrl, currentExpenseId), {
                                    method: 'DELETE',
                                    headers: {
                                        'Accept': 'application/json',
                                        'X-Requested-With': 'XMLHttpRequest',
                                        'X-CSRF-TOKEN':
                                            document.querySelector('meta[name="csrf-token"]')?.content
                                            || form.querySelector('[name="_token"]').value
                                    }
                                });

                                const result = await readResponse(response);

                                showMessage(result.message || 'مورد انتخاب‌شده حذف شد.', true);

                                setTimeout(() => window.location.reload(), 900);
                            } catch (error) {
                                showMessage(error.message || 'حذف مورد انتخاب‌شده ناموفق بود.');
                            } finally {
                                requestInProgress = false;
                                this.disabled = false;
                                this.textContent = 'بله، حذف شود';
                            }
                        });

                    // پاک‌کردن فایل انتخاب‌شده در صورت انتخاب مجدد
                    document.getElementById('edit_expense_image')
                        .addEventListener('change', function () {
                            if (this.files.length) {
                                const removeCheckbox =
                                    document.getElementById('edit_expense_remove_image');

                                if (removeCheckbox) removeCheckbox.checked = false;
                            }
                        });

                    // بستن مودال با کلیک روی فضای بیرونی
                    modal.addEventListener('click', function (event) {
                        if (event.target === modal) closeEditModal();
                    });

                    // بستن با دکمه‌های داخل مودال
                    modal.querySelectorAll('[data-close-modal="expenseEditModal"]')
                        .forEach(button => {
                            button.addEventListener('click', closeEditModal);
                        });
                });
            </script>

            <!-- Expense Search & Filters Script -->
            <script>
                document.addEventListener('DOMContentLoaded', function () {

                    const form = document.getElementById('expenseFiltersForm');
                    const search = document.getElementById('expenseSearch');
                    const category = document.getElementById('expenseCategory');
                    const paymentStatus = document.getElementById('paymentStatus');
                    const sort = document.getElementById('expenseSort');
                    const clearButton = document.getElementById('clearExpenseFilters');

                    if (!form) return;

                    const scrollKey = 'bills_expenses_scroll_position';

                    // بازیابی موقعیت دقیق صفحه پس از بارگذاری مجدد
                    const savedScrollPosition = sessionStorage.getItem(scrollKey);

                    if (savedScrollPosition !== null) {
                        sessionStorage.removeItem(scrollKey);

                        requestAnimationFrame(function () {
                            window.scrollTo({
                                top: Number(savedScrollPosition),
                                behavior: 'instant'
                            });
                        });
                    }

                    // ذخیره موقعیت صفحه پیش از ارسال فرم فیلترها
                    form.addEventListener('submit', function () {
                        sessionStorage.setItem(
                            scrollKey,
                            String(window.scrollY)
                        );
                    });

                    // اعمال خودکار فیلترها
                    [category, paymentStatus, sort].forEach(function (element) {
                        element?.addEventListener('change', function () {
                            form.requestSubmit();
                        });
                    });

                    // جستجو پس از مکث کوتاه کاربر
                    let searchTimer;

                    search?.addEventListener('input', function () {
                        clearTimeout(searchTimer);

                        searchTimer = setTimeout(function () {
                            form.requestSubmit();
                        }, 500);
                    });

                    // پاک کردن فیلترها و حفظ موقعیت صفحه
                    clearButton?.addEventListener('click', function (event) {
                        event.preventDefault();

                        const url = new URL(window.location.href);

                        [
                            'search',
                            'category',
                            'payment_status',
                            'sort',
                            'page'
                        ].forEach(function (key) {
                            url.searchParams.delete(key);
                        });

                        // ذخیره موقعیت فعلی پیش از بارگذاری مجدد
                        sessionStorage.setItem(
                            scrollKey,
                            String(window.scrollY)
                        );

                        window.location.assign(url.toString());
                    });

                });
            </script>

            <script>
                function setupDistributionSelector(methodId, scopeWrapId, scopeId) {
                    const method = document.getElementById(methodId);
                    const scopeWrap = document.getElementById(scopeWrapId);
                    const scope = document.getElementById(scopeId);

                    if (!method || !scopeWrap || !scope) return;

                    function updateScopeVisibility() {
                        const isEqualSplit = method.value === 'per_unit';

                        scopeWrap.classList.toggle('hidden', !isEqualSplit);
                        scope.disabled = !isEqualSplit;
                    }

                    method.addEventListener('change', updateScopeVisibility);
                    updateScopeVisibility();
                }

                setupDistributionSelector(
                    'billDistributionMethod',
                    'billDistributionScopeWrap',
                    'billDistributionScope'
                );

                setupDistributionSelector(
                    'serviceDistributionMethod',
                    'serviceDistributionScopeWrap',
                    'serviceDistributionScope'
                );
            </script>

@endsection