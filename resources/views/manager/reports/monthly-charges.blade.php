@extends('layouts.manager')

@section('title', 'مدیر خوب - لیست شارژ ساختمان')

@section('content')

@php
    use Morilog\Jalali\Jalalian;

    $periodTitle = $period->title
        ?: 'لیست شارژ ساختمان دوره ' .
            Jalalian::fromCarbon($period->starts_at)->format('%B %Y');

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
                    لیست شارژ ساختمان
                </h1>
                <p class="mt-1 text-sm text-[#003260]/60">
                    گزارش مالی واحدهای ساختمان
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <button onclick="window.print()"
                    class="rounded-xl bg-[#003260] px-4 py-2.5 text-sm font-semibold text-white modir-bold cursor-pointer transition hover:bg-[#003260]/90">
                    چاپ و دانلود PDF
                </button>

                <a href="{{ route('manager.reports') }}"
                   class="rounded-xl border border-[#003260]/15 bg-white px-4 py-2.5 text-sm font-semibold modir-bold cursor-pointer text-[#003260] transition hover:bg-gray-50">
                    بازگشت به گزارش‌ها
                </a>
            </div>
        </div>

        {{-- Report --}}
        <section id="monthly-charges-report"
                 class="report-sheet mx-auto max-w-5xl bg-white text-[#003260] shadow-sm">

            {{-- Compact header --}}
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
                            <div class="mt-0.5 text-[10px] text-[#003260]/65">سامانه مدیریت ساختمان</div>
                            <div class="mt-1 truncate text-[10px]">
                                مدیر ساختمان: {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                            </div>
                        </div>
                    </div>

                    {{-- Report title --}}
                    <div class="text-center">
                        <h2 class="text-lg modir-bold">
                            {{ $building->name }}
                        </h2>
                    </div>

                    {{-- Period --}}
                    <div class="text-left">
                        <div class="text-[10px] text-[#003260]/60">دوره گزارش</div>
                        <div class="mt-1 text-xs font-bold">
                            {{ $periodTitle }}
                        </div>
                        <div class="mt-1 text-[10px] text-[#003260]/70">
                            تعداد واحدها:
                            {{ $persianDigits($units->count()) }}
                        </div>
                    </div>

                </div>

            </header>

            {{-- Table --}}
            <div class="report-table-wrap hidden md:block px-4 py-4 sm:px-7">

                <table class="report-table w-full border-collapse text-right text-sm">
                    <thead>
                        <tr class="bg-[#003260] text-white">
                            <th class="w-12 border border-[#003260]/20 px-2 py-3 text-center modir-bold">ردیف</th>
                            <th class="border border-[#003260]/20 px-3 py-3 text-center modir-bold">نام واحد</th>
                            <th class="border border-[#003260]/20 px-3 py-3 text-center modir-bold">دارای ساکن</th>
                            <th class="border border-[#003260]/20 px-3 py-3 text-center modir-bold">شارژ این دوره <span class="block pt-1 text-[9px] font-normal text-white/70">تومان</span></th>
                            <th class="border border-[#003260]/20 px-3 py-3 text-center modir-bold">سهم آب <span class="block pt-1 text-[9px] font-normal text-white/70 modir-bold">تومان</span></th>
                            <th class="border border-[#003260]/20 px-3 py-3 text-center modir-bold">مبلغ پرداخت‌شده <span class="block pt-1 text-[9px] font-normal text-white/70">تومان</span></th>
                            <th class="border border-[#003260]/20 px-3 py-3 text-center modir-bold">مانده <span class="block pt-1 text-[9px] font-normal text-white/70">تومان</span></th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($units as $unit)
                            <tr class="{{ $loop->even ? 'bg-slate-50' : 'bg-white' }}">
                                <td class="border border-slate-200 px-2 py-3 text-center">
                                    {{ $persianDigits($loop->iteration) }}
                                </td>

                                <td class="border border-slate-200 px-3 py-3 font-bold text-center">
                                    {{ $unit['name'] }}
                                </td>

                                <td class="border border-slate-200 px-3 py-3 text-center">
                                    @if ($unit['has_resident'])
                                        <span class="font-bold text-emerald-700">✓</span>
                                    @else
                                        <span class="font-bold text-rose-600">✕</span>
                                    @endif
                                </td>

                                <td class="border border-slate-200 px-3 py-3 text-center tabular-nums">
                                    {{ $persianDigits($formatAmount($unit['charge_amount'])) }}
                                </td>

                                <td class="border border-slate-200 px-3 py-3 text-center tabular-nums">
                                    {{ $persianDigits($formatAmount($unit['water_amount'])) }}
                                </td>

                                <td class="border border-slate-200 px-3 py-3 text-center tabular-nums">
                                    {{ $persianDigits($formatAmount($unit['paid_amount'])) }}
                                </td>

                                <td class="border border-slate-200 px-3 py-3 text-center font-bold tabular-nums">
                                    {{ $persianDigits($formatAmount($unit['remaining_amount'])) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="border border-slate-200 px-4 py-10 text-center text-slate-500 modir-bold">
                                    هنوز واحدی برای این ساختمان ثبت نشده است.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>

            {{-- Mobile cards --}}
            <div class="mobile-report-cards space-y-3 p-3 md:hidden">
                @forelse ($units as $unit)
                    <article class="rounded-2xl border border-[#003260]/15 bg-white p-4">
                        <div class="mb-3 flex items-center justify-between gap-3 border-b border-slate-100 pb-3">
                            <div>
                                <div class="text-xs text-[#003260]/60">نام واحد</div>
                                <div class="mt-1 font-bold">{{ $unit['name'] }}</div>
                            </div>

                            <div class="text-sm font-bold">
                                @if ($unit['has_resident'])
                                    <span class="text-emerald-700">✓ دارای ساکن</span>
                                @else
                                    <span class="text-rose-600">✕ بدون ساکن</span>
                                @endif
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3 text-sm">
                            <div class="rounded-xl bg-slate-50 p-3">
                                <div class="text-xs text-[#003260]/60">شارژ این دوره</div>
                                <div class="mt-2 font-bold">
                                    {{ $persianDigits($formatAmount($unit['charge_amount'])) }}
                                    <span class="text-xs font-normal">تومان</span>
                                </div>
                            </div>

                            <div class="rounded-xl bg-slate-50 p-3">
                                <div class="text-xs text-[#003260]/60">سهم آب</div>
                                <div class="mt-2 font-bold">
                                    {{ $persianDigits($formatAmount($unit['water_amount'])) }}
                                    <span class="text-xs font-normal">تومان</span>
                                </div>
                            </div>

                            <div class="rounded-xl bg-slate-50 p-3">
                                <div class="text-xs text-[#003260]/60">مبلغ پرداخت‌شده</div>
                                <div class="mt-2 font-bold">
                                    {{ $persianDigits($formatAmount($unit['paid_amount'])) }}
                                    <span class="text-xs font-normal">تومان</span>
                                </div>
                            </div>

                            <div class="rounded-xl bg-[#EEF5FF] p-3">
                                <div class="text-xs text-[#003260]/60">مانده</div>
                                <div class="mt-2 font-bold text-[#003260]">
                                    {{ $persianDigits($formatAmount($unit['remaining_amount'])) }}
                                    <span class="text-xs font-normal">تومان</span>
                                </div>
                            </div>
                        </div>
                    </article>
                @empty
                    <p class="py-8 text-center text-sm text-slate-500">
                        هنوز واحدی برای این ساختمان ثبت نشده است.
                    </p>
                @endforelse
            </div>

            {{-- Compact footer --}}
            <footer class="report-footer border-t border-slate-200 px-5 py-3 sm:px-7">
                <p class="text-[10px] leading-5">
                    مهلت پرداخت شارژ ساختمان حداکثر یک هفته بعد از صدور دوره می‌باشد.
                </p>

                <p class="mt-1 text-[10px] leading-5">
                    در صورت نیاز برای مشاوره، اطلاع‌رسانی یا ارتباط با مدیریت ساختمان با شماره:
                    <span class="font-bold">{{ $manager->phone ?: 'ثبت نشده' }}</span>
                    تماس بگیرید.
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

            #monthly-charges-report,
            #monthly-charges-report * {
                visibility: visible;
            }

            #monthly-charges-report {
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
                position: static !important;
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

            .mobile-report-cards {
                display: none !important;
            }

            .report-footer {
                position: static !important;
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
                padding: 2.5mm 1mm !important;
                font-size: 8pt !important;
                overflow-wrap: anywhere;
            }

            .print\:hidden {
                display: none !important;
            }
        }
    </style>

@endsection