@extends('layouts.manager')

@section('title', 'مدیر خوب - شارژ')

@section('content')

@php
    $persianDigits = [
        '0' => '۰', '1' => '۱', '2' => '۲', '3' => '۳', '4' => '۴',
        '5' => '۵', '6' => '۶', '7' => '۷', '8' => '۸', '9' => '۹',
    ];

    $occupiedChargeValue = old(
        'occupied_charge',
        $building->occupied_monthly_charge !== null
            ? number_format($building->occupied_monthly_charge)
            : ''
    );

    $vacantChargeValue = old(
        'vacant_charge',
        $building->vacant_monthly_charge !== null
            ? number_format($building->vacant_monthly_charge)
            : ''
    );

    $occupiedUnitsCount = $building->units->where('occupancy_status', 'occupied')->count();
    $vacantUnitsCount = $building->units->where('occupancy_status', 'vacant')->count();
    $totalUnitsCount = $building->units->count();
@endphp

    <main class="flex-1 px-5 lg:px-8 pt-6 pb-28 lg:pb-8">

        {{-- پیام موفقیت --}}
        @if (session('success'))
            <div class="mb-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Charge Management Hero --}}
        <section class="relative overflow-hidden rounded-[28px] bg-[#003260] text-white shadow-xl shadow-[#003260]/10">
            <div class="absolute -top-20 -left-20 w-64 h-64 rounded-full bg-white/5"></div>
            <div class="absolute -bottom-24 right-10 w-72 h-72 rounded-full bg-white/5"></div>
            <div class="absolute top-10 right-1/3 w-24 h-24 rounded-full bg-white/[0.03]"></div>

            <div class="relative p-6 sm:p-8 lg:p-10">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div class="flex items-start gap-4">
                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/10 border border-white/10 backdrop-blur-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                                <path d="M6 2v20" />
                                <path d="M18 2v20" />
                                <path d="M6 4h12" />
                                <path d="M6 20h12" />
                                <path d="M9 8h6" />
                                <path d="M9 12h6" />
                                <path d="M9 16h6" />
                            </svg>
                        </div>

                        <div>
                            <h1 class="text-2xl sm:text-3xl font-bold modir-bold">مدیریت شارژ ساختمان</h1>
                            <p class="mt-2 text-sm sm:text-base text-white/70 leading-7">
                                تعیین مبلغ ثابت شارژ برای واحدهای دارای ساکن و بدون ساکن
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 rounded-2xl bg-white/10 border border-white/10 px-4 py-3 backdrop-blur-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="text-white/80">
                            <path d="M3 21h18" />
                            <path d="M6 21V5a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v16" />
                            <path d="M9 7h1" />
                            <path d="M14 7h1" />
                            <path d="M9 11h1" />
                            <path d="M14 11h1" />
                            <path d="M9 15h1" />
                            <path d="M14 15h1" />
                        </svg>

                        <div>
                            <p class="text-xs text-white/50">ساختمان</p>
                            <p class="mt-0.5 text-sm font-medium text-white">
                                {{ $building->name }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Current Charge Status --}}
        <section class="mt-6">
            <div class="rounded-[28px] bg-white border border-[#003260]/5 shadow-sm overflow-hidden">

                <div class="px-5 sm:px-6 lg:px-7 py-5 border-b border-[#003260]/5">
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h2 class="text-lg sm:text-xl font-bold modir-bold text-[#003260]">وضعیت فعلی شارژ</h2>
                            <p class="mt-1 text-sm text-[#003260]/55">خلاصه تنظیمات فعلی شارژ ساختمان</p>
                        </div>

                        <div class="inline-flex items-center gap-2 self-start rounded-full bg-emerald-50 px-3.5 py-2 text-xs font-medium text-emerald-700">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            تنظیمات فعال
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-5 sm:p-6 lg:p-7">

                    {{-- Occupied Units --}}
                    <div class="rounded-2xl border border-[#003260]/5 bg-[#f8f9fa] p-5">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm text-[#003260]/55">شارژ واحدهای دارای ساکن</p>

                                <div class="mt-3 flex items-baseline gap-2">
                                    <span class="text-2xl sm:text-3xl font-bold modir-bold text-[#003260]">
                                        {{ strtr(number_format($building->occupied_monthly_charge ?? 0), $persianDigits) }}
                                    </span>
                                    <span class="text-sm text-[#003260]/50">تومان</span>
                                </div>
                            </div>

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#003260]/5 text-[#003260]">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                </svg>
                            </div>
                        </div>

                        <div class="mt-4 flex items-center gap-2 text-xs text-[#003260]/50">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                            </svg>
                            <span>{{ strtr(number_format($occupiedUnitsCount), $persianDigits) }} واحد دارای ساکن</span>
                        </div>
                    </div>

                    {{-- Vacant Units --}}
                    <div class="rounded-2xl border border-[#003260]/5 bg-[#f8f9fa] p-5">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm text-[#003260]/55">شارژ واحدهای بدون ساکن</p>

                                <div class="mt-3 flex items-baseline gap-2">
                                    <span class="text-2xl sm:text-3xl font-bold modir-bold text-[#003260]">
                                        {{ strtr(number_format($building->vacant_monthly_charge ?? 0), $persianDigits) }}
                                    </span>
                                    <span class="text-sm text-[#003260]/50">تومان</span>
                                </div>
                            </div>

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#003260]/5 text-[#003260]">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="M16 11a4 4 0 1 0-4-4" />
                                </svg>
                            </div>
                        </div>

                        <div class="mt-4 flex items-center gap-2 text-xs text-[#003260]/50">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M16 11a4 4 0 1 0-4-4" />
                            </svg>
                            <span>{{ strtr(number_format($vacantUnitsCount), $persianDigits) }} واحد بدون ساکن</span>
                        </div>
                    </div>
                </div>

                {{-- Building Summary --}}
                <div class="px-5 sm:px-6 lg:px-7 pb-5 sm:pb-6 lg:pb-7">
                    <div class="flex flex-wrap items-center gap-x-6 gap-y-3 rounded-2xl bg-[#003260]/[0.03] px-5 py-4">
                        <div class="flex items-center gap-2 text-sm text-[#003260]/65">
                            <span class="font-semibold text-[#003260]">{{ strtr(number_format($totalUnitsCount), $persianDigits) }}</span>
                            واحد ساختمان
                        </div>

                        <div class="hidden sm:block w-px h-4 bg-[#003260]/10"></div>

                        <div class="flex items-center gap-2 text-sm text-[#003260]/65">
                            <span class="font-semibold text-[#003260]">{{ strtr(number_format($occupiedUnitsCount), $persianDigits) }}</span>
                            دارای ساکن
                        </div>

                        <div class="hidden sm:block w-px h-4 bg-[#003260]/10"></div>

                        <div class="flex items-center gap-2 text-sm text-[#003260]/65">
                            <span class="font-semibold text-[#003260]">{{ strtr(number_format($vacantUnitsCount), $persianDigits) }}</span>
                            بدون ساکن
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Charge Settings Form --}}
        <section class="mt-6">
            <div class="rounded-[28px] bg-white border border-[#003260]/5 shadow-sm overflow-hidden">

                <div class="px-5 sm:px-6 lg:px-7 py-5 border-b border-[#003260]/5">
                    <h2 class="text-lg sm:text-xl font-bold modir-bold text-[#003260]">تنظیم مبلغ شارژ</h2>
                    <p class="mt-1 text-sm text-[#003260]/55">
                        مبلغ ثابت شارژ را برای واحدهای دارای ساکن و بدون ساکن تعیین کنید.
                    </p>
                </div>

                <form action="{{ route('manager.charges.store') }}" method="POST" class="p-5 sm:p-6 lg:p-7" id="chargeSettingsForm">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">

                        {{-- Occupied Unit Charge --}}
                        <div class="rounded-2xl border border-[#003260]/5 bg-[#f8f9fa] p-5">
                            <div class="flex items-start gap-4">
                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#003260]/5 text-[#003260]">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                        <circle cx="9" cy="7" r="4" />
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                    </svg>
                                </div>

                                <div>
                                    <h3 class="text-base font-semibold text-[#003260]">واحدهای دارای ساکن</h3>
                                    <p class="mt-1 text-xs leading-6 text-[#003260]/50">
                                        مبلغ ثابت شارژ برای واحدهایی که در حال حاضر دارای ساکن هستند.
                                    </p>
                                </div>
                            </div>

                            <div class="mt-5">
                                <label for="occupiedCharge" class="block mb-2 text-sm font-medium text-[#003260]">
                                    مبلغ شارژ
                                </label>

                                <div class="relative">
                                    <input
                                        type="text"
                                        id="occupiedCharge"
                                        name="occupied_charge"
                                        value="{{ strtr((string) $occupiedChargeValue, $persianDigits) }}"
                                        inputmode="numeric"
                                        autocomplete="off"
                                        maxlength="11"
                                        class="w-full h-12 rounded-xl border border-[#003260]/10 bg-white px-4 pl-16 text-sm text-[#003260] outline-none transition focus:border-[#003260]/30 focus:ring-4 focus:ring-[#003260]/5"
                                        placeholder="مثلاً ۲,۵۰۰,۰۰۰"
                                        aria-describedby="occupiedChargeError"
                                    >
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-xs text-[#003260]/45">تومان</span>
                                </div>

                                <p id="occupiedChargeError" class="mt-2 text-xs text-red-600 @if(!$errors->has('occupied_charge')) hidden @endif">@error('occupied_charge'){{ $message }}@enderror</p>
                            </div>
                        </div>

                        {{-- Vacant Unit Charge --}}
                        <div class="rounded-2xl border border-[#003260]/5 bg-[#f8f9fa] p-5">
                            <div class="flex items-start gap-4">
                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#003260]/5 text-[#003260]">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                        <circle cx="9" cy="7" r="4" />
                                        <path d="M16 11a4 4 0 1 0-4-4" />
                                    </svg>
                                </div>

                                <div>
                                    <h3 class="text-base font-semibold text-[#003260]">واحدهای بدون ساکن</h3>
                                    <p class="mt-1 text-xs leading-6 text-[#003260]/50">
                                        مبلغ ثابت شارژ برای واحدهایی که در حال حاضر ساکن ندارند.
                                    </p>
                                </div>
                            </div>

                            <div class="mt-5">
                                <label for="vacantCharge" class="block mb-2 text-sm font-medium text-[#003260]">
                                    مبلغ شارژ
                                </label>

                                <div class="relative">
                                    <input
                                        type="text"
                                        id="vacantCharge"
                                        name="vacant_charge"
                                        value="{{ strtr((string) $vacantChargeValue, $persianDigits) }}"
                                        inputmode="numeric"
                                        autocomplete="off"
                                        maxlength="11"
                                        class="w-full h-12 rounded-xl border border-[#003260]/10 bg-white px-4 pl-16 text-sm text-[#003260] outline-none transition focus:border-[#003260]/30 focus:ring-4 focus:ring-[#003260]/5"
                                        placeholder="مثلاً ۱,۰۰۰,۰۰۰"
                                        aria-describedby="vacantChargeError"
                                    >
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-xs text-[#003260]/45">تومان</span>
                                </div>

                                <p id="vacantChargeError" class="mt-2 text-xs text-red-600 @if(!$errors->has('vacant_charge')) hidden @endif">@error('vacant_charge'){{ $message }}@enderror</p>
                            </div>
                        </div>
                    </div>

                    {{-- Notice --}}
                    <div class="mt-5 flex items-start gap-3 rounded-2xl border border-[#003260]/5 bg-[#003260]/[0.03] p-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="mt-0.5 shrink-0 text-[#003260]/60">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M12 16v-4" />
                            <path d="M12 8h.01" />
                        </svg>

                        <p class="text-xs leading-6 text-[#003260]/55">
                            مبلغ تعیین‌شده به‌صورت ثابت برای هر واحد در نظر گرفته می‌شود و با تغییر تعداد ساکنین یا متراژ واحد تغییر نمی‌کند.
                        </p>
                    </div>

                    {{-- Submit --}}
                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#003260] px-6 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-[#003260]/90 focus:outline-none focus:ring-4 focus:ring-[#003260]/10 modir-bold cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                                <polyline points="17 21 17 13 7 13 7 21" />
                                <polyline points="7 3 7 8 15 8" />
                            </svg>
                            ذخیره تنظیمات
                        </button>
                    </div>
                </form>
            </div>
        </section>

        {{-- Monthly Charge Issuance --}}
        <section class="mt-6">
            <div class="overflow-hidden rounded-[28px] border border-[#003260]/5 bg-white shadow-sm">

                <div class="border-b border-[#003260]/5 px-5 py-5 sm:px-6 lg:px-7">
                    <h2 class="text-lg font-bold text-[#003260] modir-bold sm:text-xl">
                        صدور شارژ ماهانه
                    </h2>
                    <p class="mt-1 text-sm leading-6 text-[#003260]/55">
                        دوره شارژ را انتخاب کنید تا بدهی واحدهای ساختمان ثبت شود.
                    </p>
                </div>

                <form action="{{ route('manager.charges.issue') }}"
                      method="POST"
                      id="issueChargeForm"
                      class="p-5 sm:p-6 lg:p-7">
                    @csrf

                    @php
                        $currentJalaliYear = \Morilog\Jalali\Jalalian::now()->getYear();
                        $monthNames = [
                            1 => 'فروردین',
                            2 => 'اردیبهشت',
                            3 => 'خرداد',
                            4 => 'تیر',
                            5 => 'مرداد',
                            6 => 'شهریور',
                            7 => 'مهر',
                            8 => 'آبان',
                            9 => 'آذر',
                            10 => 'دی',
                            11 => 'بهمن',
                            12 => 'اسفند',
                        ];
                    @endphp

                    @if (session('error'))
                        <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm leading-6 text-red-700">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->has('year') || $errors->has('month') || $errors->has('due_date'))
                        <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm leading-6 text-red-700">
                            @foreach (['year', 'month', 'due_date'] as $field)
                                @foreach ($errors->get($field) as $message)
                                    <p>{{ $message }}</p>
                                @endforeach
                            @endforeach
                        </div>
                    @endif

                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-2">

                        <div>
                            <label for="chargeYear" class="mb-2 block text-sm font-medium text-[#003260]">
                                سال شمسی
                            </label>
                            <select
                                id="chargeYear"
                                name="year"
                                required
                                class="h-12 w-full rounded-xl border border-[#003260]/10 bg-white px-4 text-sm text-[#003260] outline-none focus:border-[#003260]/30 focus:ring-4 focus:ring-[#003260]/5"
                            >
                                @for ($year = $currentJalaliYear - 2; $year <= $currentJalaliYear + 1; $year++)
                                    <option
                                        value="{{ $year }}"
                                        @selected((string) old('year', $currentJalaliYear) === (string) $year)
                                    >
                                        {{ strtr((string) $year, $persianDigits) }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <div>
                            <label for="chargeMonth" class="mb-2 block text-sm font-medium text-[#003260]">
                                ماه شارژ
                            </label>
                            <select
                                id="chargeMonth"
                                name="month"
                                required
                                class="h-12 w-full rounded-xl border border-[#003260]/10 bg-white px-4 text-sm text-[#003260] outline-none focus:border-[#003260]/30 focus:ring-4 focus:ring-[#003260]/5"
                            >
                                @foreach ($monthNames as $monthNumber => $monthName)
                                    <option
                                        value="{{ $monthNumber }}"
                                        @selected((string) old('month', \Morilog\Jalali\Jalalian::now()->getMonth()) === (string) $monthNumber)
                                    >
                                        {{ $monthName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- <div>
                            <label for="chargeDueDate" class="mb-2 block text-sm font-medium text-[#003260]">
                                تاریخ سررسید
                            </label>
                            <input
                                type="text"
                                id="chargeDueDate"
                                name="due_date"
                                value="{{ old('due_date', \Morilog\Jalali\Jalalian::now()->format('Y/m/d')) }}"
                                placeholder="۱۴۰۵/۰۷/۳۰"
                                inputmode="numeric"
                                autocomplete="off"
                                required
                                dir="ltr"
                                class="h-12 w-full rounded-xl border border-[#003260]/10 bg-white px-4 text-left text-sm text-[#003260] outline-none focus:border-[#003260]/30 focus:ring-4 focus:ring-[#003260]/5"
                            >
                            <p class="mt-2 text-xs text-[#003260]/45">
                                قالب تاریخ: سال/ماه/روز شمسی
                            </p>
                        </div> -->

                    </div>

                    {{-- Charge Preview --}}
                    <div class="mt-6 rounded-2xl border border-[#003260]/5 bg-[#f8f9fa] p-5">
                        <h3 class="text-sm font-bold text-[#003260] modir-bold">
                            خلاصه صدور شارژ
                        </h3>

                        <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-3">
                            <div>
                                <p class="text-xs text-[#003260]/50">تعداد کل واحدها</p>
                                <p class="mt-2 text-lg font-bold text-[#003260]">
                                    {{ strtr(number_format($totalUnitsCount), $persianDigits) }}
                                    <span class="text-xs font-normal">واحد</span>
                                </p>
                            </div>

                            <div>
                                <p class="text-xs text-[#003260]/50">مجموع شارژ واحدهای دارای ساکن</p>
                                <p class="mt-2 text-lg font-bold text-[#003260]">
                                    {{ strtr(number_format($occupiedUnitsCount * (int) $building->occupied_monthly_charge), $persianDigits) }}
                                    <span class="text-xs font-normal">تومان</span>
                                </p>
                            </div>

                            <div>
                                <p class="text-xs text-[#003260]/50">مجموع شارژ واحدهای بدون ساکن</p>
                                <p class="mt-2 text-lg font-bold text-[#003260]">
                                    {{ strtr(number_format($vacantUnitsCount * (int) $building->vacant_monthly_charge), $persianDigits) }}
                                    <span class="text-xs font-normal">تومان</span>
                                </p>
                            </div>
                        </div>

                        <div class="mt-4 border-t border-[#003260]/10 pt-4">
                            <p class="text-xs text-[#003260]/50">مجموع مبلغ قابل صدور</p>
                            <p class="mt-2 text-xl font-bold text-[#003260] modir-bold">
                                {{ strtr(number_format(
                                    ($occupiedUnitsCount * (int) $building->occupied_monthly_charge)
                                    + ($vacantUnitsCount * (int) $building->vacant_monthly_charge)
                                ), $persianDigits) }}
                                <span class="text-sm font-normal">تومان</span>
                            </p>
                        </div>
                    </div>

                    <div class="mt-5 flex items-start gap-3 rounded-2xl border border-amber-200 bg-amber-50 p-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                             class="mt-0.5 shrink-0 text-amber-700">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M12 8v4"/>
                            <path d="M12 16h.01"/>
                        </svg>
                        <p class="text-xs leading-6 text-amber-800">
                            با صدور شارژ، بدهی تمام واحدها بر اساس وضعیت سکونت و مبالغ فعلی ثبت می‌شود.
                            هر دوره فقط یک‌بار قابل صدور است.
                        </p>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button
                            type="submit"
                            class="inline-flex w-full cursor-pointer items-center justify-center gap-2 rounded-xl bg-[#003260] px-6 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-[#003260]/90 focus:outline-none focus:ring-4 focus:ring-[#003260]/10 modir-bold sm:w-auto"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 5v14"/>
                                <path d="M5 12h14"/>
                            </svg>
                            صدور شارژ ماهانه
                        </button>
                    </div>
                </form>
            </div>
        </section>

        {{-- ثبت پرداخت شارژ واحد --}}
        <section class="mt-6">
            <div class="mt-8 rounded-2xl border border-[#003260]/10 bg-white p-5 sm:p-6">
                <div class="mb-5">
                    <h2 class="text-lg font-bold text-[#003260]">
                        ثبت پرداخت شارژ واحد
                    </h2>
                    <p class="mt-1 text-sm text-[#003260]/60">
                        پرداخت ثبت‌شده به بدهی همان واحد و دوره شارژ متصل می‌شود.
                    </p>
                </div>

                <form
                    action="{{ route('manager.charges.payment') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="grid grid-cols-1 gap-4 md:grid-cols-2"
                >
                    @csrf

                    <div>
                        <label for="unit_name" class="mb-2 block text-sm font-semibold">
                            نام واحد
                        </label>
                        <input
                            type="text"
                            id="unit_name"
                            name="unit_name"
                            value="{{ old('unit_name') }}"
                            list="chargeUnits"
                            required
                            autocomplete="off"
                            placeholder="مثلاً 4 غربی"
                            class="w-full rounded-xl border border-[#003260]/15 bg-[#e5e2dd]/30 px-4 py-3 text-[#003260] outline-none focus:border-[#003260]"
                        >

                        <datalist id="chargeUnits">
                            @foreach($building->units as $unit)
                                <option value="{{ $unit->unit_name }}"></option>
                            @endforeach
                        </datalist>

                        @error('unit_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="charge_period_id" class="mb-2 block text-sm font-semibold">
                            دوره شارژ
                        </label>
                        <select
                            id="charge_period_id"
                            name="charge_period_id"
                            required
                            class="w-full rounded-xl border border-[#003260]/15 bg-white px-4 py-3 text-[#003260] outline-none focus:border-[#003260]"
                        >
                            <option value="">انتخاب دوره شارژ</option>
                            @foreach($chargePeriods as $period)
                                <option
                                    value="{{ $period->id }}"
                                    @selected((string) old('charge_period_id') === (string) $period->id)
                                >
                                    {{ $period->title }}
                                </option>
                            @endforeach
                        </select>

                        @error('charge_period_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="payment_date" class="mb-2 block text-sm font-semibold">
                            تاریخ پرداخت
                        </label>

                        <button
                            type="button"
                            id="payment_date"
                            class="w-full rounded-xl border border-[#003260]/15 bg-white px-4 py-3 text-right text-[#003260] outline-none focus:border-[#003260] cursor-pointer"
                        >
                            انتخاب تاریخ پرداخت
                        </button>

                        <input
                            type="hidden"
                            id="payment_date_value"
                            name="paid_at"
                            value="{{ old('paid_at') }}"
                        >

                        @error('paid_at')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="receipt" class="mb-2 block text-sm font-semibold">
                            تصویر رسید <span class="font-normal text-[#003260]/50">(اختیاری)</span>
                        </label>
                        <input
                            type="file"
                            id="receipt"
                            name="receipt"
                            accept=".jpg,.jpeg,.png,.webp"
                            class="w-full rounded-xl border border-[#003260]/15 bg-white px-3 py-2.5 text-sm text-[#003260] cursor-pointer"
                        >

                        @error('receipt')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="payment_description" class="mb-2 block text-sm font-semibold">
                            توضیحات <span class="font-normal text-[#003260]/50">(اختیاری)</span>
                        </label>
                        <textarea
                            id="payment_description"
                            name="description"
                            rows="3"
                            class="w-full rounded-xl border border-[#003260]/15 bg-white px-4 py-3 text-[#003260] outline-none focus:border-[#003260]"
                            placeholder="توضیحات پرداخت..."
                        >{{ old('description') }}</textarea>

                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <button
                            type="submit"
                            class="rounded-xl bg-[#003260] px-6 py-3 font-semibold text-white transition hover:bg-[#004780] cursor-pointer modir-bold"
                        >
                            ثبت پرداخت
                        </button>
                    </div>
                </form>
            </div>
        </section>

    </main>


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
            const persianDigits = '۰۱۲۳۴۵۶۷۸۹';

            const digitMap = {
                '۰': '0', '۱': '1', '۲': '2', '۳': '3', '۴': '4',
                '۵': '5', '۶': '6', '۷': '7', '۸': '8', '۹': '9',
                '٠': '0', '١': '1', '٢': '2', '٣': '3', '٤': '4',
                '٥': '5', '٦': '6', '٧': '7', '٨': '8', '٩': '9'
            };

            const fields = [
                {
                    input: document.getElementById('occupiedCharge'),
                    error: document.getElementById('occupiedChargeError'),
                    emptyMessage: 'مبلغ شارژ واحدهای دارای ساکن را وارد کنید.'
                },
                {
                    input: document.getElementById('vacantCharge'),
                    error: document.getElementById('vacantChargeError'),
                    emptyMessage: 'مبلغ شارژ واحدهای بدون ساکن را وارد کنید.'
                }
            ];

            function toEnglishDigits(value) {
                return value.replace(/[۰-۹٠-٩]/g, digit => digitMap[digit]);
            }

            function toPersianDigits(value) {
                return value.replace(/\d/g, digit => persianDigits[Number(digit)]);
            }

            function getDigits(value) {
                return toEnglishDigits(value).replace(/\D/g, '');
            }

            function formatAmount(value) {
                let digits = getDigits(value).slice(0, 9);

                // اگر اولین رقم صفر باشد، ورودی خالی می‌ماند.
                if (digits.startsWith('0')) {
                    digits = '';
                }

                const grouped = digits.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                return toPersianDigits(grouped);
            }

            function validateField(field) {
                const digits = getDigits(field.input.value);
                let message = '';

                if (!digits.length) {
                    message = field.emptyMessage;
                } else if (digits.length < 4) {
                    message = 'مبلغ باید حداقل ۴ رقم داشته باشد.';
                } else if (digits.length > 9) {
                    message = 'مبلغ نمی‌تواند بیشتر از ۹ رقم داشته باشد.';
                }

                field.error.textContent = message;
                field.error.classList.toggle('hidden', !message);
                field.input.classList.toggle('border-red-500', Boolean(message));

                return !message;
            }

            fields.forEach(field => {
                if (!field.input || !field.error) return;

                field.input.value = formatAmount(field.input.value);

                field.input.addEventListener('input', function () {
                    const previousPosition = this.selectionStart ?? this.value.length;
                    const beforeCursor = this.value.slice(0, previousPosition);
                    const previousDigitCount = getDigits(beforeCursor).length;

                    this.value = formatAmount(this.value);

                    // تا حد ممکن مکان‌نما در موقعیت قبلی باقی بماند.
                    let cursor = 0;
                    let countedDigits = 0;

                    while (cursor < this.value.length && countedDigits < previousDigitCount) {
                        if (/\d/.test(toEnglishDigits(this.value[cursor]))) {
                            countedDigits++;
                        }
                        cursor++;
                    }

                    this.setSelectionRange(cursor, cursor);
                    validateField(field);
                });

                field.input.addEventListener('blur', function () {
                    validateField(field);
                });
            });

            document.getElementById('chargeSettingsForm').addEventListener('submit', function (event) {
                let valid = true;

                fields.forEach(field => {
                    if (!validateField(field)) {
                        valid = false;
                    }
                });

                if (!valid) {
                    event.preventDefault();
                    return;
                }

                // پیش از ارسال، اعداد انگلیسی و بدون جداکننده به سرور فرستاده می‌شوند.
                fields.forEach(field => {
                    field.input.value = getDigits(field.input.value);
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const picker = document.getElementById('jalaliDatePicker');
            const overlay = document.getElementById('jalaliDatePickerOverlay');
            const closeButton = document.getElementById('jalaliDatePickerClose');
            const confirmButton = document.getElementById('jalaliDatePickerConfirm');
            const preview = document.getElementById('jalaliDatePickerPreview');

            const dayContainer = document.getElementById('wheelDay');
            const monthContainer = document.getElementById('wheelMonth');
            const yearContainer = document.getElementById('wheelYear');

            const dateButton = document.getElementById('payment_date');
            const dateInput = document.getElementById('payment_date_value');

            if (
                !picker || !overlay || !closeButton || !confirmButton ||
                !preview || !dayContainer || !monthContainer || !yearContainer ||
                !dateButton || !dateInput
            ) {
                console.error('اجزای تقویم یا فیلد تاریخ پرداخت شارژ پیدا نشدند.');
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
                    .replace(/[۰-۹]/g, digit => String('۰۱۲۳۴۵۶۷۸۹'.indexOf(digit)))
                    .replace(/[٠-٩]/g, digit => String('٠١٢٣٤٥٦٧٨٩'.indexOf(digit)));

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

                const getPart = type =>
                    Number(parts.find(item => item.type === type)?.value);

                return {
                    year: getPart('year'),
                    month: getPart('month'),
                    day: getPart('day')
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

            let activeTarget = false;
            let selectedDay = 1;
            let selectedMonth = 1;
            let selectedYear = 1405;

            let dayWheel = null;
            let monthWheel = null;
            let yearWheel = null;

            const currentDate = getCurrentJalaliDate();
            const firstYear = 1340;
            const lastYear = currentDate.year + 20;

            function updatePreview() {
                preview.textContent =
                    `${toPersianNumber(selectedDay)} ${months[selectedMonth - 1]} ${toPersianNumber(selectedYear)}`;
            }

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
                        const absDistance = Math.abs(distance);
                        const y = this.centerY - this.itemHeight / 2
                            + distance * this.itemHeight;

                        element.style.transform =
                            `translateY(${y}px) scale(${absDistance < 0.5 ? 1.08 : absDistance < 1.5 ? 1 : 0.92})`;

                        element.style.opacity =
                            absDistance < 0.5 ? 1
                            : absDistance < 1.5 ? 0.65
                            : absDistance < 2.5 ? 0.32 : 0;

                        element.textContent = this.values[index];
                        element.classList.toggle('active', absDistance < 0.5);
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
                        this.velocity = Math.max(-18, Math.min(18, this.velocity * 110));

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
            }

            function rebuildDayWheel() {
                if (dayWheel) dayWheel.stop();

                const totalDays = daysInMonth(selectedYear, selectedMonth);
                selectedDay = Math.min(selectedDay, totalDays);

                dayWheel = new CircularWheel(
                    dayContainer,
                    Array.from({ length: totalDays }, (_, i) => toPersianNumber(i + 1)),
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

            function openPicker() {
                const today = getCurrentJalaliDate();

                selectedYear = today.year;
                selectedMonth = today.month;
                selectedDay = today.day;

                if (dateInput.value) {
                    const parts = toEnglishNumber(dateInput.value).split('-').map(Number);

                    if (
                        parts.length === 3 &&
                        parts.every(Number.isFinite) &&
                        parts[0] >= firstYear &&
                        parts[0] <= lastYear &&
                        parts[1] >= 1 &&
                        parts[1] <= 12 &&
                        parts[2] >= 1 &&
                        parts[2] <= daysInMonth(parts[0], parts[1])
                    ) {
                        [selectedYear, selectedMonth, selectedDay] = parts;
                    }
                }

                selectedYear = Math.max(firstYear, Math.min(lastYear, selectedYear));
                selectedMonth = Math.max(1, Math.min(12, selectedMonth));
                selectedDay = Math.max(
                    1,
                    Math.min(daysInMonth(selectedYear, selectedMonth), selectedDay)
                );

                rebuildDayWheel();
                createMonthWheel();
                createYearWheel();
                updatePreview();

                activeTarget = true;
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

                activeTarget = false;
                document.body.classList.remove('overflow-hidden');
            }

            dateButton.addEventListener('click', openPicker);
            closeButton.addEventListener('click', closePicker);
            overlay.addEventListener('click', closePicker);

            document.addEventListener('keydown', event => {
                if (event.key === 'Escape' && !picker.classList.contains('hidden')) {
                    closePicker();
                }
            });

            confirmButton.addEventListener('click', () => {
                if (!activeTarget) return;

                dateInput.value =
                    `${selectedYear}-${String(selectedMonth).padStart(2, '0')}-${String(selectedDay).padStart(2, '0')}`;

                dateButton.textContent =
                    `${toPersianNumber(selectedDay)} ${months[selectedMonth - 1]} ${toPersianNumber(selectedYear)}`;

                dateButton.classList.remove('text-[#003260]/70');
                dateButton.classList.add('text-[#003260]');

                closePicker();
            });

            // حفظ تاریخ انتخاب‌شده پس از برگشت فرم با خطای اعتبارسنجی
            if (dateInput.value) {
                const parts = toEnglishNumber(dateInput.value).split('-').map(Number);

                if (
                    parts.length === 3 &&
                    parts[1] >= 1 && parts[1] <= 12 &&
                    parts[2] >= 1 && parts[2] <= 31
                ) {
                    dateButton.textContent =
                        `${toPersianNumber(parts[2])} ${months[parts[1] - 1]} ${toPersianNumber(parts[0])}`;
                }
            }
        });
    </script>

@endsection