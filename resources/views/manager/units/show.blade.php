@extends('layouts.manager')

@section('content')
@php
    $currentOwner = $unit->ownerships->first();
    $currentResident = $unit->residencies->first();

    $unitTypeLabels = [
        'residential' => 'مسکونی',
        'administrative' => 'اداری',
        'commercial' => 'تجاری',
    ];

    $occupancyLabels = [
        'occupied' => 'ساکن دارد',
        'vacant' => 'بدون ساکن',
    ];

    $totalDebt = 0;
    $totalPaid = 0;

    foreach ($unit->obligations as $obligation) {
        $paid = $obligation->payments->sum('amount');
        $remaining = max(0, (int) $obligation->amount - $paid);

        $obligation->total_paid = $paid;
        $obligation->remaining_amount = $remaining;

        $totalDebt += (int) $obligation->amount;
        $totalPaid += $paid;
    }

    $remainingDebt = max(0, $totalDebt - $totalPaid);

    $recentPayments = $unit->obligations
        ->flatMap(function ($obligation) {
            return $obligation->payments->map(function ($payment) use ($obligation) {
                $payment->obligation_title = $obligation->title;
                return $payment;
            });
        })
        ->sortByDesc('paid_at')
        ->take(5);
@endphp

    <div dir="rtl" class="min-h-screen bg-[#e5e2dd] px-4 py-6 text-[#003260] sm:px-6 lg:px-8 px-5 lg:px-8 pt-6 pb-28 lg:pb-8">
        <div class="mx-auto max-w-7xl space-y-6">

            {{-- پیام‌های ثبت پرداخت --}}
            @if(session('success'))
                <div role="alert" class="flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800">
                    <svg class="mt-0.5 h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="m5 12 4 4L19 6"/>
                    </svg>
                    <p class="text-sm font-semibold leading-6">{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div role="alert" class="flex items-start gap-3 rounded-xl border border-rose-200 bg-rose-50 p-4 text-rose-800">
                    <svg class="mt-0.5 h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <circle cx="12" cy="12" r="9"/>
                        <path d="M12 8v5m0 3h.01"/>
                    </svg>
                    <p class="text-sm font-semibold leading-6">{{ session('error') }}</p>
                </div>
            @endif

            @if($errors->any())
                <div role="alert" class="rounded-xl border border-rose-200 bg-rose-50 p-4 text-rose-800">
                    <p class="font-bold">پرداخت ثبت نشد.</p>
                    <ul class="mt-2 list-inside list-disc space-y-1 text-sm leading-6">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- سربرگ صفحه --}}
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <a href="{{ route('manager.units') }}"
                       class="mb-3 inline-flex items-center gap-2 text-sm text-[#003260]/65 transition hover:text-[#003260]">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M15 18l-6-6 6-6"/>
                        </svg>
                        بازگشت به فهرست واحدها
                    </a>

                    <h1 class="text-2xl font-bold sm:text-3xl">
                        پروفایل واحد {{ $unit->unit_name }}
                    </h1>

                    <p class="mt-2 text-sm text-[#003260]/65">
                        {{ $building->name ?? 'ساختمان' }}
                        <span class="mx-1">/</span>
                        مشاهده اطلاعات و وضعیت مالی واحد
                    </p>
                </div>

                <button type="button"
                        disabled
                        title="این قابلیت هنوز فعال نشده است"
                        class="inline-flex cursor-not-allowed items-center justify-center gap-2 rounded-xl border border-[#003260]/15 bg-white/60 px-4 py-3 text-sm font-semibold text-[#003260]/50">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M12 20h9"/>
                        <path d="M16.5 3.5a2.12 2.12 0 013 3L8 18l-4 1 1-4Z"/>
                    </svg>
                    ویرایش اطلاعات اصلی واحد
                </button>
            </div>

            {{-- کارت خلاصه وضعیت --}}
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

                <div class="rounded-2xl bg-[#003260] p-5 text-white shadow-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-white/70">نام واحد</span>
                        <svg class="h-6 w-6 text-white/70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                            <path d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6M9 9h.01M15 9h.01"/>
                        </svg>
                    </div>
                    <p class="mt-4 text-2xl font-bold modir-bold">{{ $unit->unit_name }}</p>
                    <p class="mt-2 text-sm text-white/65">
                        طبقه {{ $unit->floor }}
                        <span class="mx-1">|</span>
                        {{ $unitTypeLabels[$unit->unit_type] ?? 'نامشخص' }}
                    </p>
                </div>

                <div class="rounded-2xl border border-[#003260]/10 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-[#003260]/65">وضعیت سکونت</span>
                        <span class="rounded-lg bg-[#e5e2dd] p-2">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M3 10.5 12 3l9 7.5"/>
                                <path d="M5 9v12h14V9M9 21v-7h6v7"/>
                            </svg>
                        </span>
                    </div>
                    <p class="mt-4 text-xl font-bold">
                        {{ $occupancyLabels[$unit->occupancy_status] ?? 'نامشخص' }}
                    </p>
                    <p class="mt-2 text-sm text-[#003260]/55">
                        {{ $currentResident?->name ?? 'اطلاعات ساکن ثبت نشده' }}
                    </p>
                </div>

                <div class="rounded-2xl border border-[#003260]/10 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-[#003260]/65">مجموع بدهی‌ها</span>
                        <svg class="h-6 w-6 text-[#003260]/60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <rect x="3" y="5" width="18" height="14" rx="2"/>
                            <path d="M3 10h18M7 15h3"/>
                        </svg>
                    </div>
                    <p class="mt-4 text-xl font-bold">
                        {{ number_format($totalDebt) }}
                        <span class="text-sm font-normal">تومان</span>
                    </p>
                    <p class="mt-2 text-sm text-[#003260]/55">
                        مجموع تعهدهای مالی ثبت‌شده
                    </p>
                </div>

                <div class="rounded-2xl border border-[#003260]/10 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-[#003260]/65">مانده بدهی</span>
                        <svg class="h-6 w-6 text-[#003260]/60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M12 3v18M17 7H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/>
                        </svg>
                    </div>
                    <p class="mt-4 text-xl font-bold {{ $remainingDebt > 0 ? 'text-rose-600' : 'text-emerald-700' }}">
                        {{ number_format($remainingDebt) }}
                        <span class="text-sm font-normal">تومان</span>
                    </p>
                    <p class="mt-2 text-sm {{ $remainingDebt > 0 ? 'text-rose-600' : 'text-emerald-700' }}">
                        {{ $remainingDebt > 0 ? 'بدهی تسویه‌نشده' : 'تسویه کامل' }}
                    </p>
                </div>

            </div>

            {{-- اطلاعات اصلی واحد --}}
            <section class="overflow-hidden rounded-2xl border border-[#003260]/10 bg-white shadow-sm">
                <div class="border-b border-[#003260]/10 px-5 py-4 sm:px-6">
                    <h2 class="text-lg font-bold">اطلاعات اصلی واحد</h2>
                    <p class="mt-1 text-sm text-[#003260]/55">مشخصات ثبت‌شده این واحد</p>
                </div>

                <div class="grid grid-cols-1 gap-x-8 gap-y-6 p-5 sm:grid-cols-2 sm:p-6 lg:grid-cols-3">

                    <div>
                        <p class="text-sm text-[#003260]/55">نام واحد</p>
                        <p class="mt-2 font-semibold">{{ $unit->unit_name }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-[#003260]/55">طبقه</p>
                        <p class="mt-2 font-semibold">{{ $unit->floor }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-[#003260]/55">نوع واحد</p>
                        <p class="mt-2 font-semibold">{{ $unitTypeLabels[$unit->unit_type] ?? 'نامشخص' }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-[#003260]/55">متراژ</p>
                        <p class="mt-2 font-semibold">
                            {{ $unit->area !== null ? number_format($unit->area) . ' متر مربع' : 'ثبت نشده' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-[#003260]/55">پارکینگ</p>
                        <p class="mt-2 font-semibold">
                            {{ filled($unit->parking) ? $unit->parking : 'ندارد' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-[#003260]/55">انباری</p>
                        <p class="mt-2 font-semibold">
                            {{ (bool) $unit->storage ? 'دارد' : 'ندارد' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-[#003260]/55">وضعیت سکونت</p>
                        <p class="mt-2 font-semibold">{{ $occupancyLabels[$unit->occupancy_status] ?? 'نامشخص' }}</p>
                    </div>

                    @if(filled($unit->description))
                        <div class="sm:col-span-2 lg:col-span-3">
                            <p class="text-sm text-[#003260]/55">توضیحات</p>
                            <p class="mt-2 whitespace-pre-line leading-7">{{ $unit->description }}</p>
                        </div>
                    @endif

                </div>
            </section>

            {{-- اطلاعات مالک و ساکن --}}
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

                {{-- مالک فعلی --}}
                <section class="overflow-hidden rounded-2xl border border-[#003260]/10 bg-white shadow-sm">
                    <div class="flex items-center gap-3 border-b border-[#003260]/10 px-5 py-4 sm:px-6">
                        <div class="rounded-xl bg-[#e5e2dd] p-2.5">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <circle cx="12" cy="8" r="4"/>
                                <path d="M4 21v-2a8 8 0 0116 0v2"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="font-bold">اطلاعات مالک</h2>
                            <p class="mt-1 text-xs text-[#003260]/55">مالک فعلی واحد</p>
                        </div>
                    </div>

                    <div class="space-y-5 p-5 sm:p-6">
                        @if($currentOwner)
                            <div>
                                <p class="text-sm text-[#003260]/55">نام و نام خانوادگی</p>
                                <p class="mt-1 font-semibold">{{ $currentOwner->name }}</p>
                            </div>

                            <div>
                                <p class="text-sm text-[#003260]/55">شماره تماس</p>
                                <p class="mt-1 font-semibold" dir="ltr">
                                    {{ $currentOwner->phone ?: 'ثبت نشده' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-[#003260]/55">تاریخ شروع مالکیت</p>
                                <p class="mt-1 font-semibold">
                                    @if($currentOwner->started_at)
                                        {{ \Morilog\Jalali\Jalalian::fromCarbon($currentOwner->started_at)->format('Y/m/d') }}
                                    @else
                                        ثبت نشده
                                    @endif
                                </p>
                            </div>

                            @if(filled($currentOwner->notes))
                                <div>
                                    <p class="text-sm text-[#003260]/55">توضیحات</p>
                                    <p class="mt-1 whitespace-pre-line leading-7">{{ $currentOwner->notes }}</p>
                                </div>
                            @endif
                        @else
                            <div class="rounded-xl bg-[#e5e2dd]/60 px-4 py-6 text-center">
                                <p class="font-semibold">اطلاعات مالک ثبت نشده است.</p>
                            </div>
                        @endif
                    </div>
                </section>

                {{-- ساکن فعلی --}}
                <section class="overflow-hidden rounded-2xl border border-[#003260]/10 bg-white shadow-sm">
                    <div class="flex items-center gap-3 border-b border-[#003260]/10 px-5 py-4 sm:px-6">
                        <div class="rounded-xl bg-[#e5e2dd] p-2.5">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <circle cx="12" cy="8" r="4"/>
                                <path d="M4 21v-2a8 8 0 0116 0v2"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="font-bold">اطلاعات ساکن</h2>
                            <p class="mt-1 text-xs text-[#003260]/55">وضعیت سکونت فعلی</p>
                        </div>
                    </div>

                    <div class="space-y-5 p-5 sm:p-6">
                        @if($currentResident)
                            <div>
                                <p class="text-sm text-[#003260]/55">نام و نام خانوادگی</p>
                                <p class="mt-1 font-semibold">{{ $currentResident->name }}</p>
                            </div>

                            <div>
                                <p class="text-sm text-[#003260]/55">شماره تماس</p>
                                <p class="mt-1 font-semibold" dir="ltr">
                                    {{ $currentResident->phone ?: 'ثبت نشده' }}
                                </p>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-[#003260]/55">تعداد ساکنان</p>
                                    <p class="mt-1 font-semibold">
                                        {{ $currentResident->resident_count ?? 'ثبت نشده' }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-sm text-[#003260]/55">نوع سکونت</p>
                                    <p class="mt-1 font-semibold">
                                        @switch($currentResident->resident_type)
                                            @case('owner')
                                                مالک
                                                @break
                                            @case('tenant')
                                                مستأجر
                                                @break
                                            @default
                                                ثبت نشده
                                        @endswitch
                                    </p>
                                </div>
                            </div>

                            <div>
                                <p class="text-sm text-[#003260]/55">تاریخ شروع سکونت</p>
                                <p class="mt-1 font-semibold">
                                    @if($currentResident->started_at)
                                        {{ \Morilog\Jalali\Jalalian::fromCarbon($currentResident->started_at)->format('Y/m/d') }}
                                    @else
                                        ثبت نشده
                                    @endif
                                </p>
                            </div>

                            @if(filled($currentResident->notes))
                                <div>
                                    <p class="text-sm text-[#003260]/55">توضیحات</p>
                                    <p class="mt-1 whitespace-pre-line leading-7">{{ $currentResident->notes }}</p>
                                </div>
                            @endif
                        @else
                            <div class="rounded-xl bg-[#e5e2dd]/60 px-4 py-6 text-center">
                                <p class="font-semibold">اطلاعات ساکن فعلی ثبت نشده است.</p>
                            </div>
                        @endif
                    </div>
                </section>

            </div>

            {{-- بدهی‌های واحد --}}
            <section class="overflow-hidden rounded-2xl border border-[#003260]/10 bg-white shadow-sm">
                <div class="flex flex-col gap-3 border-b border-[#003260]/10 px-5 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                    <div>
                        <h2 class="text-lg font-bold">بدهی‌های واحد</h2>
                        <p class="mt-1 text-sm text-[#003260]/55">تعهدهای مالی ثبت‌شده برای این واحد</p>
                    </div>

                    <div class="rounded-xl bg-[#e5e2dd]/70 px-4 py-2 text-sm">
                        مانده کل:
                        <span class="font-bold">{{ number_format($remainingDebt) }} تومان</span>
                    </div>
                </div>

                @if($unit->obligations->isNotEmpty())
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[760px] text-right">
                            <thead class="bg-[#e5e2dd]/50 text-sm text-[#003260]/70">
                                <tr>
                                    <th class="px-5 py-4 font-semibold">عنوان بدهی</th>
                                    <th class="px-5 py-4 font-semibold">مسئول پرداخت</th>
                                    <th class="px-5 py-4 font-semibold">مبلغ اولیه</th>
                                    <th class="px-5 py-4 font-semibold">پرداخت‌شده</th>
                                    <th class="px-5 py-4 font-semibold">مانده</th>
                                    <th class="px-5 py-4 font-semibold">وضعیت</th>
                                    <th class="px-5 py-4 font-semibold">عملیات</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-[#003260]/10">
                                @foreach($unit->obligations as $obligation)
                                    <tr>
                                        <td class="px-5 py-4">
                                            <p class="font-semibold">{{ $obligation->title }}</p>
                                            @if($obligation->due_date)
                                                <p class="mt-1 text-xs text-[#003260]/55">
                                                    سررسید:
                                                    {{ \Morilog\Jalali\Jalalian::fromCarbon($obligation->due_date)->format('Y/m/d') }}
                                                </p>
                                            @endif
                                        </td>

                                        <td class="px-5 py-4 text-sm">
                                            @switch($obligation->responsible_party)
                                                @case('owner')
                                                    مالک
                                                    @break
                                                @case('resident')
                                                    ساکن
                                                    @break
                                                @default
                                                    نامشخص
                                            @endswitch
                                        </td>

                                        <td class="px-5 py-4 text-sm">
                                            {{ number_format($obligation->amount) }} تومان
                                        </td>

                                        <td class="px-5 py-4 text-sm">
                                            {{ number_format($obligation->total_paid) }} تومان
                                        </td>

                                        <td class="px-5 py-4 text-sm font-bold">
                                            {{ number_format($obligation->remaining_amount) }} تومان
                                        </td>

                                        <td class="px-5 py-4">
                                            @if($obligation->remaining_amount > 0)
                                                <span class="rounded-lg bg-rose-50 px-3 py-1.5 text-xs font-semibold text-rose-700">
                                                    تسویه‌نشده
                                                </span>
                                            @else
                                                <span class="rounded-lg bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700">
                                                    تسویه‌شده
                                                </span>
                                            @endif
                                        </td>

                                        <td class="px-5 py-4">
                                            @if($obligation->remaining_amount > 0)
                                                <button
                                                    type="button"
                                                    data-payment-button
                                                    data-obligation-id="{{ $obligation->id }}"
                                                    data-obligation-title="{{ $obligation->title }}"
                                                    data-remaining="{{ $obligation->remaining_amount }}"
                                                    class="whitespace-nowrap rounded-lg bg-[#003260] px-3 py-2 text-xs font-semibold text-white transition hover:bg-[#004780] modir-bold cursor-pointer">
                                                    ثبت پرداخت
                                                </button>
                                            @else
                                                <span class="text-xs font-semibold text-emerald-700">تسویه کامل</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="px-5 py-12 text-center">
                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-[#e5e2dd]/70">
                            <svg class="h-7 w-7 text-[#003260]/65" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M5 12l4 4L19 6"/>
                            </svg>
                        </div>
                        <h3 class="mt-4 font-bold">بدهی ثبت‌شده‌ای وجود ندارد</h3>
                        <p class="mt-2 text-sm text-[#003260]/55">در حال حاضر برای این واحد تعهد مالی ثبت نشده است.</p>
                    </div>
                @endif
            </section>

            {{-- آخرین پرداخت‌ها --}}
            <section class="overflow-hidden rounded-2xl border border-[#003260]/10 bg-white shadow-sm">
                <div class="border-b border-[#003260]/10 px-5 py-4 sm:px-6">
                    <h2 class="text-lg font-bold">آخرین پرداخت‌های واحد</h2>
                    <p class="mt-1 text-sm text-[#003260]/55">پنج پرداخت آخر ثبت‌شده</p>
                </div>

                @if($recentPayments->isNotEmpty())
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[600px] text-right">
                            <thead class="bg-[#e5e2dd]/50 text-sm text-[#003260]/70">
                                <tr>
                                    <th class="px-5 py-4 font-semibold">عنوان بدهی</th>
                                    <th class="px-5 py-4 font-semibold">مبلغ پرداخت</th>
                                    <th class="px-5 py-4 font-semibold">تاریخ پرداخت</th>
                                    <th class="px-5 py-4 font-semibold">توضیحات</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-[#003260]/10">
                                @foreach($recentPayments as $payment)
                                    <tr>
                                        <td class="px-5 py-4 font-semibold">{{ $payment->obligation_title }}</td>
                                        <td class="px-5 py-4 font-semibold text-emerald-700">
                                            {{ number_format($payment->amount) }} تومان
                                        </td>
                                        <td class="px-5 py-4 text-sm">
                                            @if($payment->paid_at)
                                                {{ \Morilog\Jalali\Jalalian::fromCarbon($payment->paid_at)->format('Y/m/d') }}
                                            @else
                                                ثبت نشده
                                            @endif
                                        </td>
                                        <td class="px-5 py-4 text-sm text-[#003260]/65">
                                            {{ $payment->description ?: '—' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="px-5 py-10 text-center text-sm text-[#003260]/55">
                        هنوز پرداختی برای این واحد ثبت نشده است.
                    </div>
                @endif
            </section>

        </div>
    </div>

    {{-- مودال ثبت پرداخت --}}
    <div id="paymentModal"
         class="fixed inset-0 z-50 hidden items-center justify-center overflow-y-auto bg-[#001a33]/60 p-4"
         aria-labelledby="paymentModalTitle"
         aria-modal="true"
         role="dialog">

        <div class="my-auto w-full max-w-lg overflow-hidden rounded-2xl bg-white shadow-2xl">
            <div class="flex items-center justify-between border-b border-[#003260]/10 px-5 py-4">
                <div>
                    <h2 id="paymentModalTitle" class="text-lg font-bold text-[#003260]">ثبت پرداخت بدهی</h2>
                    <p id="paymentObligationTitle" class="mt-1 text-sm text-[#003260]/60"></p>
                </div>

                <button type="button" id="closePaymentModal"
                        class="rounded-lg p-2 text-[#003260]/60 transition hover:bg-[#e5e2dd]"
                        aria-label="بستن">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M18 6 6 18M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form
                id="paymentForm"
                method="POST"
                action="{{ route('manager.units.payment', ['unit' => $unit->id, 'obligation' => 0]) }}"
                data-action-template="{{ route('manager.units.payment', ['unit' => $unit->id, 'obligation' => 0]) }}"
                class="space-y-5 p-5"
            >
                @csrf

                <div class="rounded-xl bg-[#e5e2dd]/60 p-4">
                    <p class="text-sm text-[#003260]/60">مانده بدهی</p>
                    <p id="paymentRemaining" class="mt-1 text-xl font-bold text-[#003260]"></p>
                </div>

                <div>
                    <label for="paymentAmount" class="mb-2 block text-sm font-semibold text-[#003260]">
                        مبلغ پرداخت (تومان)
                    </label>
                    <input
                        id="paymentAmount"
                        name="amount"
                        type="text"
                        inputmode="numeric"
                        autocomplete="off"
                        required
                        placeholder="مبلغ را وارد کنید"
                        class="w-full rounded-xl border border-[#003260]/15 px-4 py-3 text-[#003260] outline-none transition focus:border-[#003260] focus:ring-2 focus:ring-[#003260]/10">

                    <div class="mt-2 flex flex-wrap items-center justify-between gap-2">
                        <p class="text-xs leading-5 text-[#003260]/55">
                            حداقل پرداخت ۱٬۰۰۰ تومان است و مبلغ نباید از مانده بدهی بیشتر باشد.
                        </p>

                        <button type="button" id="payRemainingButton"
                                class="shrink-0 text-xs font-bold text-[#003260] underline decoration-[#003260]/30 underline-offset-4 hover:decoration-[#003260]">
                            تسویه کامل
                        </button>
                    </div>

                    <p id="paymentAmountError" class="mt-2 hidden text-sm text-rose-600"></p>
                </div>

                <div>
                    <label for="payment_date" class="mb-2 block text-sm font-semibold text-[#003260]">
                        تاریخ پرداخت
                    </label>

                    <input
                        type="hidden"
                        name="paid_at"
                        id="payment_date_value"
                        value="{{ old('paid_at') }}"
                        required
                    >

                    <button
                        type="button"
                        id="payment_date"
                        class="flex w-full items-center justify-between gap-3 rounded-xl border border-[#003260]/15 bg-white px-4 py-3 text-right text-[#003260] outline-none transition hover:border-[#003260]/40 focus:border-[#003260] focus:ring-2 focus:ring-[#003260]/10 modir-bold cursor-pointer"
                    >
                        <span id="payment_date_label" class="text-sm text-[#003260]/70">
                            انتخاب تاریخ پرداخت
                        </span>

                        <svg class="h-5 w-5 shrink-0 text-[#003260]/65"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="1.8"
                             stroke-linecap="round"
                             stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2"/>
                            <path d="M16 2v4M8 2v4M3 10h18"/>
                        </svg>
                    </button>

                    <p class="mt-2 text-xs text-[#003260]/55">
                        برای انتخاب تاریخ، روی این کادر بزن.
                    </p>
                </div>

                <div>
                    <label for="paymentDescription" class="mb-2 block text-sm font-semibold text-[#003260]">
                        توضیحات (اختیاری)
                    </label>
                    <textarea
                        id="paymentDescription"
                        name="description"
                        rows="2"
                        maxlength="2000"
                        class="w-full rounded-xl border border-[#003260]/15 px-4 py-3 text-[#003260] outline-none transition focus:border-[#003260] focus:ring-2 focus:ring-[#003260]/10"
                        placeholder="توضیحات پرداخت"></textarea>
                </div>

                <div class="flex gap-3 border-t border-[#003260]/10 pt-4">
                    <button type="button" id="cancelPaymentModal"
                            class="flex-1 rounded-xl border border-[#003260]/15 px-4 py-3 text-sm font-semibold text-[#003260] transition hover:bg-[#e5e2dd] modir-bold cursor-pointer">
                        انصراف
                    </button>

                    <button type="submit" id="submitPaymentButton"
                            class="flex-1 rounded-xl bg-[#003260] px-4 py-3 text-sm font-semibold text-white transition hover:bg-[#004780] modir-bold cursor-pointer">
                        ثبت پرداخت
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
        <div id="jalaliDatePickerModal" class="relative w-full sm:max-w-[470px] bg-white rounded-t-[32px] sm:rounded-[32px] shadow-2xl overflow-hidden">

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
            const picker = document.getElementById('jalaliDatePicker');
            const overlay = document.getElementById('jalaliDatePickerOverlay');
            const closeButton = document.getElementById('jalaliDatePickerClose');
            const confirmButton = document.getElementById('jalaliDatePickerConfirm');
            const preview = document.getElementById('jalaliDatePickerPreview');

            const dayContainer = document.getElementById('wheelDay');
            const monthContainer = document.getElementById('wheelMonth');
            const yearContainer = document.getElementById('wheelYear');

            const dateButton = document.getElementById('payment_date');
            const dateLabel = document.getElementById('payment_date_label');
            const dateInput = document.getElementById('payment_date_value');

            if (
                !picker ||
                !overlay ||
                !closeButton ||
                !confirmButton ||
                !preview ||
                !dayContainer ||
                !monthContainer ||
                !yearContainer ||
                !dateButton ||
                !dateInput
            ) {
                console.error(
                    'اجزای تقویم شمسی یا فیلد تاریخ پرداخت پیدا نشدند.'
                );
                return;
            }

            const months = [
                'فروردین',
                'اردیبهشت',
                'خرداد',
                'تیر',
                'مرداد',
                'شهریور',
                'مهر',
                'آبان',
                'آذر',
                'دی',
                'بهمن',
                'اسفند'
            ];

            const persianDigits = '۰۱۲۳۴۵۶۷۸۹';
            const arabicDigits = '٠١٢٣٤٥٦٧٨٩';

            const toPersianNumber = value =>
                String(value).replace(
                    /\d/g,
                    digit => persianDigits[Number(digit)]
                );

            const toEnglishNumber = value =>
                String(value)
                    .replace(/[۰-۹]/g, digit =>
                        String(persianDigits.indexOf(digit))
                    )
                    .replace(/[٠-٩]/g, digit =>
                        String(arabicDigits.indexOf(digit))
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
                    -61, 9, 38, 199, 426, 686, 756, 818, 1111,
                    1181, 1210, 1635, 2060, 2097, 2192, 2262,
                    2347, 2381, 2454, 3178
                ];

                if (year < breaks[0] || year >= breaks[breaks.length - 1]) {
                    return false;
                }

                let leapJ = -14;
                let jp = breaks[0];
                let jump = 0;

                for (let i = 1; i < breaks.length; i++) {
                    const jm = breaks[i];
                    jump = jm - jp;

                    if (year < jm) {
                        break;
                    }

                    leapJ +=
                        Math.floor(jump / 33) * 8 +
                        Math.floor((jump % 33) / 4);

                    jp = jm;
                }

                let n = year - jp;

                if (jump - n < 6) {
                    n = n - jump + Math.floor((jump + 4) / 33) * 33;
                }

                let leap = (((n + 1) % 33) - 1) % 4;

                if (leap === -1) {
                    leap = 4;
                }

                return leap === 0;
            }

            function daysInMonth(year, month) {
                if (month >= 1 && month <= 6) {
                    return 31;
                }

                if (month >= 7 && month <= 11) {
                    return 30;
                }

                return month === 12 && isLeapJalaliYear(year) ? 30 : 29;
            }

            let activeTarget = false;
            let selectedDay = 1;
            let selectedMonth = 1;

            const currentDate = getCurrentJalaliDate();

            let selectedYear = currentDate.year;

            const firstYear = 1340;
            const lastYear = currentDate.year + 20;

            let dayWheel = null;
            let monthWheel = null;
            let yearWheel = null;

            function formatSelectedDate() {
                return (
                    `${toPersianNumber(selectedDay)} ` +
                    `${months[selectedMonth - 1]} ` +
                    `${toPersianNumber(selectedYear)}`
                );
            }

            function updatePreview() {
                preview.textContent = formatSelectedDate();
            }

            function updateDateButton(value) {
                const text = value || 'انتخاب تاریخ پرداخت';

                if (dateLabel) {
                    dateLabel.textContent = text;
                } else {
                    dateButton.textContent = text;
                }

                dateButton.classList.toggle('text-[#003260]/70', !value);
                dateButton.classList.toggle('text-[#003260]', Boolean(value));
            }

            function parseJalaliDate(value) {
                if (!value) {
                    return null;
                }

                const parts = toEnglishNumber(value)
                    .trim()
                    .split('-')
                    .map(Number);

                if (
                    parts.length !== 3 ||
                    !parts.every(Number.isInteger)
                ) {
                    return null;
                }

                const [year, month, day] = parts;

                if (
                    year < firstYear ||
                    year > lastYear ||
                    month < 1 ||
                    month > 12 ||
                    day < 1 ||
                    day > daysInMonth(year, month)
                ) {
                    return null;
                }

                return { year, month, day };
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

                        const y =
                            this.centerY -
                            this.itemHeight / 2 +
                            distance * this.itemHeight;

                        const scale =
                            absDistance < 0.5
                                ? 1.08
                                : absDistance < 1.5
                                    ? 1
                                    : 0.92;

                        const opacity =
                            absDistance < 0.5
                                ? 1
                                : absDistance < 1.5
                                    ? 0.65
                                    : absDistance < 2.5
                                        ? 0.32
                                        : 0;

                        element.style.transform =
                            `translateY(${y}px) scale(${scale})`;

                        element.style.opacity = opacity;

                        element.textContent = this.values[index];

                        element.classList.toggle(
                            'active',
                            absDistance < 0.5
                        );
                    });
                }

                getSelectedIndex() {
                    return mod(Math.round(this.position), this.length);
                }

                bind() {
                    this.element.addEventListener('pointerdown', event => {
                        if (event.pointerType === 'mouse' && event.button !== 0) {
                            return;
                        }

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
                        if (
                            !this.dragging ||
                            event.pointerId !== this.pointerId
                        ) {
                            return;
                        }

                        const now = performance.now();
                        const deltaY = event.clientY - this.lastY;
                        const deltaTime = Math.max(1, now - this.lastTime);

                        this.lastY = event.clientY;
                        this.lastTime = now;

                        this.position -= deltaY / this.itemHeight;

                        this.velocity =
                            (-deltaY / this.itemHeight) / deltaTime;

                        this.render();
                    });

                    const endDrag = event => {
                        if (
                            !this.dragging ||
                            event.pointerId !== this.pointerId
                        ) {
                            return;
                        }

                        this.dragging = false;
                        this.pointerId = null;

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
                        if (this.dragging) {
                            return;
                        }

                        this.position += this.velocity;
                        this.velocity *= 0.94;

                        this.render();

                        if (Math.abs(this.velocity) > 0.012) {
                            this.animationFrame =
                                requestAnimationFrame(animate);
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
                        const progress = Math.min(
                            1,
                            (now - startTime) / duration
                        );

                        const eased = 1 - Math.pow(1 - progress, 3);

                        this.position = start + distance * eased;
                        this.render();

                        if (progress < 1) {
                            this.animationFrame =
                                requestAnimationFrame(animate);

                            return;
                        }

                        this.position = target;
                        this.velocity = 0;
                        this.animationFrame = null;

                        this.render();

                        this.onChange?.(this.getSelectedIndex());
                    };

                    this.animationFrame =
                        requestAnimationFrame(animate);
                }

                stop() {
                    if (this.animationFrame !== null) {
                        cancelAnimationFrame(this.animationFrame);
                        this.animationFrame = null;
                    }
                }
            }

            function rebuildDayWheel() {
                if (dayWheel) {
                    dayWheel.stop();
                }

                const totalDays = daysInMonth(
                    selectedYear,
                    selectedMonth
                );

                selectedDay = Math.min(selectedDay, totalDays);

                dayWheel = new CircularWheel(
                    dayContainer,
                    Array.from(
                        { length: totalDays },
                        (_, index) => toPersianNumber(index + 1)
                    ),
                    selectedDay - 1,
                    index => {
                        selectedDay = index + 1;
                        updatePreview();
                    }
                );
            }

            function createMonthWheel() {
                if (monthWheel) {
                    monthWheel.stop();
                }

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
                if (yearWheel) {
                    yearWheel.stop();
                }

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

                const savedDate = parseJalaliDate(dateInput.value);

                if (savedDate) {
                    selectedYear = savedDate.year;
                    selectedMonth = savedDate.month;
                    selectedDay = savedDate.day;
                }

                selectedYear = Math.max(
                    firstYear,
                    Math.min(lastYear, selectedYear)
                );

                selectedMonth = Math.max(
                    1,
                    Math.min(12, selectedMonth)
                );

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

                activeTarget = true;

                picker.classList.remove('hidden');
                picker.classList.add('flex');

                document.body.classList.add('overflow-hidden');

                closeButton.focus();
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
                if (
                    event.key === 'Escape' &&
                    !picker.classList.contains('hidden')
                ) {
                    closePicker();
                    dateButton.focus();
                }
            });

            confirmButton.addEventListener('click', () => {
                if (!activeTarget) {
                    return;
                }

                dateInput.value =
                    `${selectedYear}-` +
                    `${String(selectedMonth).padStart(2, '0')}-` +
                    `${String(selectedDay).padStart(2, '0')}`;

                updateDateButton(formatSelectedDate());

                dateInput.dispatchEvent(
                    new Event('change', { bubbles: true })
                );

                closePicker();
                dateButton.focus();
            });

            // نمایش تاریخ قبلی در صورت بازگشت فرم پس از خطای اعتبارسنجی
            const savedDate = parseJalaliDate(dateInput.value);

            if (savedDate) {
                selectedYear = savedDate.year;
                selectedMonth = savedDate.month;
                selectedDay = savedDate.day;

                updateDateButton(formatSelectedDate());
            } else {
                updateDateButton('');
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('paymentModal');
            const form = document.getElementById('paymentForm');

            const closeButton = document.getElementById('closePaymentModal');
            const cancelButton = document.getElementById('cancelPaymentModal');

            const titleElement = document.getElementById('paymentObligationTitle');
            const remainingElement = document.getElementById('paymentRemaining');

            const amountInput = document.getElementById('paymentAmount');

            // شناسه صحیح فیلد تاریخ متصل به تقویم شمسی
            const dateInput = document.getElementById('payment_date_value');
            const dateButton = document.getElementById('payment_date');
            const dateLabel = document.getElementById('payment_date_label');

            const descriptionInput = document.getElementById('paymentDescription');
            const payRemainingButton = document.getElementById('payRemainingButton');
            const submitButton = document.getElementById('submitPaymentButton');
            const amountError = document.getElementById('paymentAmountError');

            if (
                !modal ||
                !form ||
                !closeButton ||
                !cancelButton ||
                !titleElement ||
                !remainingElement ||
                !amountInput ||
                !dateInput ||
                !dateButton ||
                !descriptionInput ||
                !payRemainingButton ||
                !submitButton ||
                !amountError
            ) {
                console.error('اجزای مودال ثبت پرداخت پیدا نشدند.');
                return;
            }

            let selectedRemaining = 0;
            let isSubmitting = false;

            function englishDigits(value) {
                const persian = '۰۱۲۳۴۵۶۷۸۹';
                const arabic = '٠١٢٣٤٥٦٧٨٩';

                return String(value)
                    .replace(/[۰-۹]/g, digit => persian.indexOf(digit))
                    .replace(/[٠-٩]/g, digit => arabic.indexOf(digit));
            }

            function normalizeAmount(value) {
                return englishDigits(value).replace(/[,\s٬،]/g, '');
            }

            function formatAmount(value) {
                return new Intl.NumberFormat('fa-IR')
                    .format(Number(value) || 0) + ' تومان';
            }

            function showAmountError(message) {
                amountError.textContent = message;
                amountError.classList.remove('hidden');
                amountInput.setAttribute('aria-invalid', 'true');
            }

            function clearAmountError() {
                amountError.textContent = '';
                amountError.classList.add('hidden');
                amountInput.removeAttribute('aria-invalid');
            }

            function resetDateField() {
                dateInput.value = '';

                if (dateLabel) {
                    dateLabel.textContent = 'انتخاب تاریخ پرداخت';
                }

                dateButton.classList.remove('text-[#003260]');
                dateButton.classList.add('text-[#003260]/70');
            }

            function openModal(button) {
                const title = button.dataset.obligationTitle || 'بدهی واحد';
                const remaining = Number(button.dataset.remaining);
                const obligationId = button.dataset.obligationId;

                if (
                    !obligationId ||
                    !Number.isSafeInteger(remaining) ||
                    remaining <= 0
                ) {
                    console.error('اطلاعات بدهی برای ثبت پرداخت معتبر نیست.');
                    return;
                }

                selectedRemaining = remaining;
                isSubmitting = false;

                titleElement.textContent = title;
                remainingElement.textContent = formatAmount(remaining);

                amountInput.value = '';
                amountInput.dataset.remaining = String(remaining);

                resetDateField();

                descriptionInput.value = '';
                clearAmountError();

                submitButton.disabled = false;
                submitButton.textContent = 'ثبت پرداخت';
                submitButton.classList.remove('cursor-wait', 'opacity-70');

                const template = form.dataset.actionTemplate;

                if (!template) {
                    console.error('آدرس فرم پرداخت تعریف نشده است.');
                    return;
                }

                form.action = template.replace(
                    /\/obligations\/0\/payment$/,
                    '/obligations/' + encodeURIComponent(obligationId) + '/payment'
                );

                // باز کردن مودال پرداخت
                modal.classList.remove('hidden');
                modal.classList.add('flex');

                document.body.classList.add('overflow-hidden');

                amountInput.focus();
            }

            function closeModal() {
                if (isSubmitting) {
                    return;
                }

                modal.classList.add('hidden');
                modal.classList.remove('flex');

                document.body.classList.remove('overflow-hidden');

                clearAmountError();
            }

            // اتصال تمام دکمه‌های ثبت پرداخت در جدول بدهی‌ها
            document.querySelectorAll('[data-payment-button]').forEach(button => {
                button.addEventListener('click', function () {
                    openModal(this);
                });
            });

            closeButton.addEventListener('click', closeModal);
            cancelButton.addEventListener('click', closeModal);

            // پر کردن مبلغ برای تسویه کامل بدهی
            payRemainingButton.addEventListener('click', function () {
                amountInput.value = new Intl.NumberFormat('en-US')
                    .format(selectedRemaining);

                clearAmountError();
                amountInput.focus();
            });

            // بستن مودال با کلیک روی فضای بیرونی آن
            modal.addEventListener('click', function (event) {
                if (event.target === modal) {
                    closeModal();
                }
            });

            // قالب‌بندی مبلغ هنگام تایپ
            amountInput.addEventListener('input', function () {
                const digits = normalizeAmount(this.value);

                this.value = digits
                    ? new Intl.NumberFormat('en-US').format(Number(digits))
                    : '';

                clearAmountError();
            });

            // اعتبارسنجی فرم پیش از ارسال
            form.addEventListener('submit', function (event) {
                if (isSubmitting) {
                    event.preventDefault();
                    return;
                }

                clearAmountError();

                const amountString = normalizeAmount(amountInput.value);
                const amount = Number(amountString);

                if (
                    !amountString ||
                    !Number.isSafeInteger(amount) ||
                    amount < 1000
                ) {
                    event.preventDefault();

                    showAmountError(
                        'مبلغ پرداخت باید حداقل ۱٬۰۰۰ تومان باشد.'
                    );

                    amountInput.focus();
                    return;
                }

                if (amount > selectedRemaining) {
                    event.preventDefault();

                    showAmountError(
                        'مبلغ واردشده از مانده بدهی بیشتر است.'
                    );

                    amountInput.focus();
                    return;
                }

                // فیلد تاریخ مخفی است؛ required و reportValidity روی آن
                // قابل اتکا نیستند، پس مقدار آن را مستقیماً بررسی می‌کنیم.
                if (!dateInput.value.trim()) {
                    event.preventDefault();

                    alert('لطفاً تاریخ پرداخت را انتخاب کنید.');

                    dateButton.focus();
                    dateButton.click();

                    return;
                }

                // ارسال مبلغ بدون جداکننده
                amountInput.value = amountString;

                isSubmitting = true;
                submitButton.disabled = true;
                submitButton.textContent = 'در حال ثبت...';

                submitButton.classList.add(
                    'cursor-wait',
                    'opacity-70'
                );
            });

            // بستن مودال پرداخت با کلید Escape
            document.addEventListener('keydown', function (event) {
                if (
                    event.key === 'Escape' &&
                    !modal.classList.contains('hidden')
                ) {
                    closeModal();
                }
            });
        });
    </script>
@endsection