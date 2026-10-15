@extends('layouts.manager')

@section('title', 'مدیر خوب - لیست بدهکاران ساختمان')

@section('content')

@php
    $isResidentReport = $responsibleParty === 'resident';

    $reportSubtitle = $isResidentReport
        ? 'مربوط به ساکنین'
        : 'مربوط به مالکین';

    $formatAmount = fn ($amount) => number_format((int) $amount);

    $persianDigits = fn ($value) => strtr((string) $value, [
        '0' => '۰',
        '1' => '۱',
        '2' => '۲',
        '3' => '۳',
        '4' => '۴',
        '5' => '۵',
        '6' => '۶',
        '7' => '۷',
        '8' => '۸',
        '9' => '۹',
    ]);
@endphp

<main class="flex-1 px-5 lg:px-8 pt-6 pb-28 lg:pb-8">

    {{-- Page actions --}}
    <div class="mx-auto mb-5 flex max-w-7xl flex-wrap items-center justify-between gap-3 print:hidden">
        <div>
            <h1 class="text-xl font-bold text-[#003260] modir-bold">
                لیست بدهکاران ساختمان
            </h1>
            <p class="mt-1 text-sm text-[#003260]/60">
                تهیه فهرست بدهی واحدها برای چاپ و نصب روی تابلو اعلانات
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <form method="GET" action="{{ route('manager.reports.debtors') }}"
                  class="flex items-center gap-2">
                <label for="responsible_party"
                       class="text-sm font-semibold text-[#003260] modir-bold">
                    نمایش بدهی:
                </label>

                <select id="responsible_party"
                        name="responsible_party"
                        onchange="this.form.submit()"
                        class="rounded-xl border border-[#003260]/15 bg-white px-3 py-2.5 text-sm text-[#003260] focus:border-[#003260] focus:outline-none">
                    <option value="resident" @selected($responsibleParty === 'resident')>
                        ساکنین
                    </option>
                    <option value="owner" @selected($responsibleParty === 'owner')>
                        مالکین
                    </option>
                </select>
            </form>

            <button type="button"
                    onclick="window.print()"
                    class="rounded-xl bg-[#003260] px-4 py-2.5 text-sm font-semibold text-white modir-bold transition hover:bg-[#003260]/90">
                چاپ و دانلود PDF
            </button>

            <a href="{{ route('manager.reports') }}"
               class="rounded-xl border border-[#003260]/15 bg-white px-4 py-2.5 text-sm font-semibold text-[#003260] modir-bold transition hover:bg-gray-50">
                بازگشت به گزارش‌ها
            </a>
        </div>
    </div>

    {{-- Report --}}
    <section id="debtors-report"
             class="report-sheet mx-auto max-w-5xl bg-white text-[#003260] shadow-sm">

        {{-- Header --}}
        <header class="report-header border-b-2 border-[#003260] px-5 py-4 sm:px-7">
            <div class="grid grid-cols-3 items-center gap-3">

                {{-- Brand --}}
                <div class="flex items-center gap-2">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#003260] text-white">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             width="25" height="25" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor"
                             stroke-width="1.7" stroke-linecap="round"
                             stroke-linejoin="round" aria-hidden="true">
                            <path d="M3 21h18"/>
                            <path d="M5 21V7l7-4 7 4v14"/>
                            <path d="M9 21v-4h6v4"/>
                            <path d="M9 9h.01M15 9h.01M9 13h.01M15 13h.01"/>
                        </svg>
                    </div>

                    <div class="min-w-0">
                        <div class="text-sm font-black modir-bold">مدیر خوب</div>
                        <div class="mt-0.5 text-[10px] text-[#003260]/65">
                            سامانه مدیریت ساختمان
                        </div>
                        <div class="mt-1 text-[10px]">
                            مدیر ساختمان:
                            {{ $manager->first_name }} {{ $manager->last_name }}
                        </div>
                    </div>
                </div>

                {{-- Report title --}}
                <div class="text-center">
                    <h2 class="text-base font-black modir-bold">
                        {{ $building->name }}
                    </h2>
                    <p class="mt-1 text-xs font-bold">
                        لیست بدهکاران ساختمان
                    </p>
                    <p class="mt-1 text-[10px] text-[#003260]/70">
                        {{ $reportSubtitle }}
                    </p>
                </div>

                {{-- Report statistics --}}
                <div class="text-left">
                    <div class="text-[10px] text-[#003260]/60">
                        تعداد واحدهای بدهکار
                    </div>
                    <div class="mt-1 text-sm font-bold">
                        {{ $persianDigits($units->count()) }} واحد
                    </div>
                    <div class="mt-2 text-[10px] text-[#003260]/60">
                        مجموع بدهی‌ها
                    </div>
                    <div class="mt-1 text-xs font-bold">
                        {{ $persianDigits($formatAmount($units->sum('total_debt'))) }}
                        تومان
                    </div>
                </div>

            </div>
        </header>

        {{-- Table --}}
        <div class="report-table-wrap px-3 py-4 sm:px-7">
            <table class="report-table w-full border-collapse text-right text-sm">
                <thead>
                    <tr class="bg-[#003260] text-white">
                        <th class="w-12 border border-[#003260]/20 px-2 py-3 text-center modir-bold">
                            ردیف
                        </th>
                        <th class="border border-[#003260]/20 px-3 py-3 text-center modir-bold">
                            نام واحد
                        </th>
                        <th class="border border-[#003260]/20 px-3 py-3 text-center modir-bold">
                            تعداد بدهی
                        </th>
                        <th class="border border-[#003260]/20 px-3 py-3 text-center modir-bold">
                            مجموع بدهی
                            <span class="block pt-1 text-[9px] font-normal text-white/70">
                                تومان
                            </span>
                        </th>
                        <th class="border border-[#003260]/20 px-3 py-3 text-center modir-bold">
                            توضیحات
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($units as $unit)
                        <tr class="{{ $loop->even ? 'bg-slate-50' : 'bg-white' }}">
                            <td class="border border-slate-200 px-2 py-3 text-center">
                                {{ $persianDigits($loop->iteration) }}
                            </td>

                            <td class="border border-slate-200 px-3 py-3 text-center font-bold">
                                {{ $unit['name'] }}
                            </td>

                            <td class="border border-slate-200 px-3 py-3 text-center">
                                {{ $persianDigits($unit['debt_count']) }}
                            </td>

                            <td class="border border-slate-200 px-3 py-3 text-center font-bold tabular-nums">
                                {{ $persianDigits($formatAmount($unit['total_debt'])) }}
                            </td>

                            <td class="description-cell border border-slate-200 px-3 py-3">
                                <span class="description-line"></span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5"
                                class="border border-slate-200 px-4 py-10 text-center text-slate-500 modir-bold">
                                در حال حاضر واحدی با بدهی پرداخت‌نشده برای
                                {{ $isResidentReport ? 'ساکنین' : 'مالکین' }}
                                وجود ندارد.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        {{-- Footer --}}
        <footer class="report-footer border-t border-slate-200 px-5 py-4 sm:px-7">
            <p class="text-[10px] leading-6">
                لطفاً واحدهای دارای بدهی هر چه زودتر نسبت به پرداخت بدهی اقدام کنند، با تشکر.
            </p>

            <p class="mt-1 text-[10px] leading-6">
                جهت کسب اطلاعات بیشتر می‌توانید با شماره تماس
                <span class="font-bold">
                    {{ $manager->phone ?: 'ثبت نشده' }}
                </span>
                در ارتباط باشید.
            </p>
        </footer>

    </section>
</main>

<style>
    .report-sheet {
        direction: rtl;
        font-family: inherit;
        min-height: 267mm;
        box-sizing: border-box;
    }

    .report-table {
        width: 100%;
        table-layout: fixed;
        border-collapse: collapse;
    }

    .report-table th,
    .report-table td {
        overflow-wrap: anywhere;
    }

    .description-line {
        display: block;
        min-height: 1.2rem;
    }

    @media print {
        @page {
            size: A4 portrait;
            margin: 10mm 8mm;
        }

        html,
        body {
            width: auto !important;
            min-height: 0 !important;
            margin: 0 !important;
            padding: 0 !important;
            background: #fff !important;
            print-color-adjust: exact !important;
            -webkit-print-color-adjust: exact !important;
        }

        body * {
            visibility: hidden;
        }

        #debtors-report,
        #debtors-report * {
            visibility: visible;
        }

        #debtors-report {
            position: absolute !important;
            top: 0 !important;
            right: 0 !important;
            left: 0 !important;
            display: block !important;
            width: auto !important;
            height: auto !important;
            min-height: 0 !important;
            max-width: none !important;
            margin: 0 !important;
            padding: 0 !important;
            box-sizing: border-box !important;
            box-shadow: none !important;
            overflow: visible !important;
            transform: none !important;
        }

        .report-header {
            display: block !important;
            width: 100% !important;
            height: auto !important;
            margin: 0 0 5mm !important;
            padding: 3mm 2mm !important;
            background: #fff !important;
            border-bottom: 1px solid #003260 !important;
        }

        .report-table-wrap {
            display: block !important;
            width: 100% !important;
            height: auto !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow: visible !important;
        }

        .report-table {
            display: table !important;
            width: 100% !important;
            height: auto !important;
            table-layout: fixed !important;
            border-collapse: collapse !important;
        }

        .report-table thead {
            display: table-header-group;
        }

        .report-table tbody {
            display: table-row-group;
        }

        .report-table tr {
            break-inside: avoid;
            page-break-inside: avoid;
        }

        .report-table th,
        .report-table td {
            padding: 3mm 1.5mm !important;
            font-size: 9pt !important;
            overflow-wrap: anywhere;
        }

        .description-cell {
            min-width: 0;
        }

        .description-line {
            min-height: 5mm;
        }

        .report-footer {
            display: block !important;
            width: 100% !important;
            height: auto !important;
            margin: 5mm 0 0 !important;
            padding: 3mm 2mm !important;
            background: #fff !important;
            border-top: 1px solid #cbd5e1 !important;
            break-inside: avoid;
            page-break-inside: avoid;
        }

        .print\:hidden {
            display: none !important;
        }
    }
</style>

@endsection