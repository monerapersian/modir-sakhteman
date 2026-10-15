@extends('layouts.public')

@section('title', 'مدیر خوب - سامانه مدیریت ساختمان')

@section('content')

    <main>
        {{-- Hero --}}
        <section class="relative isolate overflow-hidden pb-20 pt-36 sm:pb-28 sm:pt-44 lg:pb-32 lg:pt-48">
            <div class="modir-grid absolute inset-0 -z-20"></div>

            <div class="modir-orb modir-parallax -right-32 top-28 -z-10 h-80 w-80 bg-[#aebfce]/40 sm:h-[480px] sm:w-[480px]" data-parallax="0.12"></div>
            <div class="modir-orb modir-parallax -left-28 top-64 -z-10 h-64 w-64 bg-white/70 sm:h-96 sm:w-96" data-parallax="-0.08"></div>

            <div class="modir-container grid items-center gap-14 lg:grid-cols-[.92fr_1.08fr] lg:gap-12">
                <div class="modir-reveal relative z-10">
                    <div class="mb-7 inline-flex items-center gap-2 rounded-full border border-[#003260]/10 bg-white/60 px-4 py-2.5 text-xs font-extrabold text-[#003260]">
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="modir-pulse absolute inline-flex h-full w-full rounded-full bg-[#003260]"></span>
                            <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-[#003260]"></span>
                        </span>
                        مدیریت هوشمند، تجربه‌ای متفاوت
                    </div>

                    <h1 class="max-w-2xl text-4xl font-black leading-[1.5] tracking-tight text-[#003260] sm:text-5xl sm:leading-[1.45] lg:text-[58px]">
                        مدیریت ساختمان،
                        <span class="modir-gradient-text block">یک قدم جلوتر</span>
                    </h1>

                    <p class="mt-6 max-w-xl text-base leading-9 text-[#526b81] sm:text-lg sm:leading-10">
                        از ثبت واحدها تا مدیریت شارژ، پرداخت‌ها و هزینه‌ها؛
                        همه‌چیز را شفاف، منظم و یکپارچه در «مدیر خوب» مدیریت کنید.
                    </p>

                    <div class="mt-9 flex flex-col gap-3 sm:flex-row">
                        <a href="{{ route('subscription') }}" class="modir-primary-btn modir-bold">
                            شروع مدیریت ساختمان
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M19 12H5m0 0 7 7m-7-7 7-7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        <a href="#features" class="modir-secondary-btn">
                            آشنایی با امکانات
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="m7 10 5 5 5-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>

                    <div class="mt-9 flex flex-wrap items-center gap-x-6 gap-y-3 text-xs font-bold text-[#6c8093]">
                        <span class="inline-flex items-center gap-2">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="m5 12 4 4L19 6" stroke="#003260" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            اطلاعات یکپارچه
                        </span>
                        <span class="inline-flex items-center gap-2">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="m5 12 4 4L19 6" stroke="#003260" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            گزارش‌های شفاف
                        </span>
                        <span class="inline-flex items-center gap-2">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="m5 12 4 4L19 6" stroke="#003260" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            دسترسی آسان
                        </span>
                    </div>
                </div>

                {{-- Decorative dashboard preview --}}
                <div class="modir-reveal relative mx-auto w-full max-w-[600px] lg:me-0" style="transition-delay: .12s">
                    <div class="modir-orb absolute -right-8 top-8 -z-10 h-36 w-36 bg-white/80" data-parallax="-0.14"></div>
                    <div class="modir-orb absolute -bottom-10 -left-8 -z-10 h-44 w-44 bg-[#b8c9d7]/60" data-parallax="0.1"></div>

                    <div class="modir-dashboard relative z-10">
                        <div class="modir-dashboard-top"></div>

                        <div class="flex items-center justify-between border-b border-[#edf0f3] px-5 py-4 sm:px-7">
                            <div class="flex items-center gap-3">
                                <span class="grid h-10 w-10 place-items-center rounded-xl bg-[#003260] text-white">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M3 10.5 12 3l9 7.5V21H3V10.5Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
                                        <path d="M9 21v-7h6v7" stroke="currentColor" stroke-width="1.7"/>
                                    </svg>
                                </span>
                                <div>
                                    <div class="text-sm font-black text-[#003260]">نمای کلی ساختمان</div>
                                    <div class="mt-1 text-[10px] font-semibold text-slate-400">داشبورد مدیریت</div>
                                </div>
                            </div>
                            <span class="rounded-full bg-[#e5e2dd]/70 px-3 py-2 text-[10px] font-bold text-[#003260]">پیش‌نمایش سامانه</span>
                        </div>

                        <div class="space-y-5 p-4 sm:p-6">
                            <div class="grid grid-cols-3 gap-2.5 sm:gap-3">
                                <div class="modir-mini-card">
                                    <div class="mb-3 flex h-8 w-8 items-center justify-center rounded-lg bg-[#003260]/10 text-[#003260]">
                                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                            <path d="M3 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16M7 7h2m-2 4h2m4-4h1m-1 4h1M2 21h20M9 21v-4h4v4m6-11h1a2 2 0 0 1 2 2v9" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                                        </svg>
                                    </div>
                                    <div class="text-[10px] font-bold text-slate-400 sm:text-xs">تعداد واحدها</div>
                                    <div class="mt-2 text-lg font-black text-[#003260] sm:text-2xl">۲۴</div>
                                    <div class="mt-1 text-[9px] text-slate-400">واحد ثبت‌شده</div>
                                </div>

                                <div class="modir-mini-card">
                                    <div class="mb-3 flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-700">
                                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                            <path d="M12 3v18m5-13H9.5a3 3 0 0 0 0 6h5a3 3 0 0 1 0 6H6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                                        </svg>
                                    </div>
                                    <div class="text-[10px] font-bold text-slate-400 sm:text-xs">شارژ ماهانه</div>
                                    <div class="mt-2 text-lg font-black text-[#003260] sm:text-2xl">منظم</div>
                                    <div class="mt-1 text-[9px] text-slate-400">مدیریت پرداخت‌ها</div>
                                </div>

                                <div class="modir-mini-card">
                                    <div class="mb-3 flex h-8 w-8 items-center justify-center rounded-lg bg-sky-50 text-sky-700">
                                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                            <path d="M4 19V5m0 14h17M8 15l4-5 3 2 5-7" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <div class="text-[10px] font-bold text-slate-400 sm:text-xs">گزارش مالی</div>
                                    <div class="mt-2 text-lg font-black text-[#003260] sm:text-2xl">شفاف</div>
                                    <div class="mt-1 text-[9px] text-slate-400">نمای کلی هزینه‌ها</div>
                                </div>
                            </div>

                            <div class="rounded-2xl border border-[#edf0f3] p-4 sm:p-5">
                                <div class="mb-5 flex items-center justify-between gap-3">
                                    <div>
                                        <div class="text-xs font-black text-[#003260] sm:text-sm">وضعیت پرداخت شارژ</div>
                                        <div class="mt-1 text-[10px] text-slate-400">نمایش نمونه وضعیت واحدها</div>
                                    </div>
                                    <span class="rounded-lg bg-[#e5e2dd]/70 px-2.5 py-2 text-[9px] font-bold text-[#003260]">ماه جاری</span>
                                </div>

                                <div class="space-y-4">
                                    <div>
                                        <div class="mb-2 flex justify-between text-[10px] font-bold">
                                            <span class="text-slate-500">تسویه‌شده</span>
                                            <span class="text-[#003260]">۷۰٪</span>
                                        </div>
                                        <div class="modir-line"><div class="modir-line-fill" style="width:70%"></div></div>
                                    </div>
                                    <div>
                                        <div class="mb-2 flex justify-between text-[10px] font-bold">
                                            <span class="text-slate-500">در انتظار پرداخت</span>
                                            <span class="text-slate-500">۲۰٪</span>
                                        </div>
                                        <div class="modir-line"><div class="modir-line-fill bg-[#9aabb9]" style="width:20%"></div></div>
                                    </div>
                                    <div>
                                        <div class="mb-2 flex justify-between text-[10px] font-bold">
                                            <span class="text-slate-500">نیازمند بررسی</span>
                                            <span class="text-slate-500">۱۰٪</span>
                                        </div>
                                        <div class="modir-line"><div class="modir-line-fill bg-[#c8d1d9]" style="width:10%"></div></div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between gap-4 rounded-2xl bg-[#003260] p-4 text-white sm:p-5">
                                <div class="flex items-center gap-3">
                                    <span class="grid h-10 w-10 place-items-center rounded-xl bg-white/10">
                                        <svg width="21" height="21" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                            <path d="M12 3 4 6v5c0 5 3.4 8.5 8 10 4.6-1.5 8-5 8-10V6l-8-3Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/>
                                            <path d="m9 12 2 2 4-4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                    <div>
                                        <div class="text-xs font-extrabold modir-bold">مدیریت متمرکز</div>
                                        <div class="mt-1 text-[10px] text-white/60">اطلاعات در یک نمای یکپارچه</div>
                                    </div>
                                </div>
                                <span class="modir-pulse h-2.5 w-2.5 rounded-full bg-white"></span>
                            </div>
                        </div>
                    </div>

                    <div class="modir-glass modir-float absolute -right-3 top-24 z-20 hidden items-center gap-3 rounded-2xl p-4 sm:flex xl:-right-12">
                        <span class="grid h-10 w-10 place-items-center rounded-xl bg-[#003260] text-white">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M5 12.5 9.5 17 19 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <div>
                            <div class="text-xs font-black text-[#003260]">نظم بیشتر</div>
                            <div class="mt-1 text-[10px] text-slate-500">مدیریت آسان‌تر امور</div>
                        </div>
                    </div>

                    <div class="modir-glass modir-float-delayed absolute -bottom-7 left-2 z-20 hidden items-center gap-3 rounded-2xl p-4 sm:flex xl:-left-9">
                        <span class="grid h-10 w-10 place-items-center rounded-xl bg-white text-[#003260] shadow-sm">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M4 19V5m0 14h16M8 15l3-4 3 2 4-6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <div>
                            <div class="text-xs font-black text-[#003260]">گزارش‌گیری سریع</div>
                            <div class="mt-1 text-[10px] text-slate-500">تصمیم‌گیری با دید بهتر</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modir-container mt-20 grid grid-cols-2 gap-3 sm:mt-28 sm:grid-cols-4 sm:gap-5">
                <div class="modir-reveal rounded-2xl border border-[#003260]/10 bg-white/35 px-4 py-5 text-center">
                    <div class="text-sm font-black text-[#003260] sm:text-base">واحدها</div>
                    <div class="mt-2 text-xs text-[#718497]">ثبت و سامان‌دهی</div>
                </div>
                <div class="modir-reveal rounded-2xl border border-[#003260]/10 bg-white/35 px-4 py-5 text-center" style="transition-delay:.08s">
                    <div class="text-sm font-black text-[#003260] sm:text-base">شارژ ساختمان</div>
                    <div class="mt-2 text-xs text-[#718497]">مدیریت دوره‌ای</div>
                </div>
                <div class="modir-reveal rounded-2xl border border-[#003260]/10 bg-white/35 px-4 py-5 text-center" style="transition-delay:.16s">
                    <div class="text-sm font-black text-[#003260] sm:text-base">هزینه‌ها</div>
                    <div class="mt-2 text-xs text-[#718497]">ثبت و پیگیری</div>
                </div>
                <div class="modir-reveal rounded-2xl border border-[#003260]/10 bg-white/35 px-4 py-5 text-center" style="transition-delay:.24s">
                    <div class="text-sm font-black text-[#003260] sm:text-base">گزارش‌ها</div>
                    <div class="mt-2 text-xs text-[#718497]">اطلاعات قابل بررسی</div>
                </div>
            </div>
        </section>

        {{-- Features --}}
        <section id="features" class="relative overflow-hidden bg-white py-20 sm:py-28">
            <div class="modir-orb absolute -left-32 top-10 h-72 w-72 bg-[#e5e2dd]/60"></div>

            <div class="modir-container relative">
                <div class="modir-reveal mx-auto mb-14 max-w-2xl text-center sm:mb-16">
                    <span class="text-xs font-black tracking-widest text-[#718497]">امکانات سامانه</span>
                    <h2 class="mt-4 text-3xl font-black leading-relaxed text-[#003260] sm:text-4xl">
                        همه امور ساختمان،
                        <span class="modir-gradient-text">در یک مسیر روشن</span>
                    </h2>
                    <p class="mt-4 text-sm leading-8 text-[#718497] sm:text-base">
                        ابزارهای کاربردی برای نظم‌بخشیدن به امور روزمره و مالی ساختمان، بدون پراکندگی اطلاعات.
                    </p>
                </div>

                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    <article class="modir-feature-card modir-reveal">
                        <div class="modir-icon">
                            <svg width="25" height="25" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M3 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16M7 7h2m-2 4h2m4-4h1m-1 4h1M2 21h20M9 21v-4h4v4m6-11h1a2 2 0 0 1 2 2v9" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <h3 class="mt-6 text-lg font-black text-[#003260]">مدیریت واحدها و ساکنان</h3>
                        <p class="mt-3 text-sm leading-8 text-[#6c8093]">اطلاعات واحدها، وضعیت سکونت و مشخصات ساکنان را منظم ثبت و در زمان نیاز پیدا کنید.</p>
                        <span class="mt-5 inline-flex items-center gap-2 text-xs font-extrabold text-[#003260]">اطلاعات منظم <span>←</span></span>
                    </article>

                    <article class="modir-feature-card modir-reveal" style="transition-delay:.07s">
                        <div class="modir-icon">
                            <svg width="25" height="25" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M12 3v18m5-13H9.5a3 3 0 0 0 0 6h5a3 3 0 0 1 0 6H6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <h3 class="mt-6 text-lg font-black text-[#003260]">شارژ ماهانه ساختمان</h3>
                        <p class="mt-3 text-sm leading-8 text-[#6c8093]">مبالغ شارژ را تعریف کنید و وضعیت مالی واحدها و دوره‌های شارژ را پیگیری کنید.</p>
                        <span class="mt-5 inline-flex items-center gap-2 text-xs font-extrabold text-[#003260]">پیگیری ساده‌تر <span>←</span></span>
                    </article>

                    <article class="modir-feature-card modir-reveal" style="transition-delay:.14s">
                        <div class="modir-icon">
                            <svg width="25" height="25" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M4 4h16v16H4zM8 8h8m-8 4h8m-8 4h5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h3 class="mt-6 text-lg font-black text-[#003260]">ثبت قبوض و هزینه‌ها</h3>
                        <p class="mt-3 text-sm leading-8 text-[#6c8093]">هزینه‌های جاری، قبوض و خدمات ساختمان را همراه با اطلاعات لازم ثبت و دسته‌بندی کنید.</p>
                        <span class="mt-5 inline-flex items-center gap-2 text-xs font-extrabold text-[#003260]">کنترل هزینه‌ها <span>←</span></span>
                    </article>

                    <article class="modir-feature-card modir-reveal" style="transition-delay:.04s">
                        <div class="modir-icon">
                            <svg width="25" height="25" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M4 19V5m0 14h16M7 15l4-4 3 2 5-7" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h3 class="mt-6 text-lg font-black text-[#003260]">گزارش‌های کاربردی</h3>
                        <p class="mt-3 text-sm leading-8 text-[#6c8093]">گزارش‌های مورد نیاز مدیریت را برای بررسی وضعیت شارژ، هزینه‌ها و امور مالی در اختیار داشته باشید.</p>
                        <span class="mt-5 inline-flex items-center gap-2 text-xs font-extrabold text-[#003260]">دید بهتر <span>←</span></span>
                    </article>

                    <article class="modir-feature-card modir-reveal" style="transition-delay:.11s">
                        <div class="modir-icon">
                            <svg width="25" height="25" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M5 4h14v16H5zM8 8h8m-8 4h8m-8 4h4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="m15 16 2 2 4-4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h3 class="mt-6 text-lg font-black text-[#003260]">ثبت و پیگیری پرداخت‌ها</h3>
                        <p class="mt-3 text-sm leading-8 text-[#6c8093]">پرداخت‌ها را ثبت کنید و برای بررسی مانده حساب و وضعیت تعهدات هر واحد به اطلاعات منسجم دسترسی داشته باشید.</p>
                        <span class="mt-5 inline-flex items-center gap-2 text-xs font-extrabold text-[#003260]">پیگیری دقیق‌تر <span>←</span></span>
                    </article>

                    <article class="modir-feature-card modir-reveal" style="transition-delay:.18s">
                        <div class="modir-icon">
                            <svg width="25" height="25" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M12 3 4 6v5c0 5 3.4 8.5 8 10 4.6-1.5 8-5 8-10V6l-8-3Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/>
                                <path d="m9 12 2 2 4-4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h3 class="mt-6 text-lg font-black text-[#003260]">فضای کاری یکپارچه</h3>
                        <p class="mt-3 text-sm leading-8 text-[#6c8093]">به‌جای پراکندگی اطلاعات در فایل‌ها و یادداشت‌ها، امور ساختمان را در یک محیط متمرکز دنبال کنید.</p>
                        <span class="mt-5 inline-flex items-center gap-2 text-xs font-extrabold text-[#003260]">مدیریت متمرکز <span>←</span></span>
                    </article>
                </div>
            </div>
        </section>

        {{-- How it works --}}
        <section id="how-it-works" class="relative overflow-hidden py-20 sm:py-28">
            <div class="modir-grid absolute inset-0 -z-10 opacity-50"></div>

            <div class="modir-container">
                <div class="modir-reveal mx-auto mb-14 max-w-2xl text-center">
                    <span class="text-xs font-black tracking-widest text-[#718497]">شروعی ساده</span>
                    <h2 class="mt-4 text-3xl font-black leading-relaxed text-[#003260] sm:text-4xl">از ثبت اطلاعات تا مدیریت روزانه</h2>
                    <p class="mt-4 text-sm leading-8 text-[#718497]">اطلاعات ساختمان را مرحله‌به‌مرحله وارد کنید و کارهای روزمره را با نظم بیشتری پیش ببرید.</p>
                </div>

                <div class="relative grid gap-5 md:grid-cols-3">
                    <div class="absolute left-[17%] right-[17%] top-10 hidden border-t border-dashed border-[#003260]/20 md:block"></div>

                    <article class="modir-reveal relative rounded-3xl border border-[#003260]/10 bg-white/65 p-7 text-center backdrop-blur-lg">
                        <div class="relative mx-auto grid h-20 w-20 place-items-center rounded-[25px] bg-[#003260] text-white shadow-xl shadow-[#003260]/15">
                            <span class="absolute -right-2 -top-2 grid h-7 w-7 place-items-center rounded-full border-2 border-[#e5e2dd] bg-white text-xs font-black text-[#003260]">۱</span>
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M3 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16M7 7h2m-2 4h2m4-4h1m-1 4h1M2 21h20M9 21v-4h4v4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <h3 class="mt-6 text-lg font-black text-[#003260]">ساختمان را ثبت کنید</h3>
                        <p class="mt-3 text-sm leading-8 text-[#718497]">مشخصات ساختمان و واحدها را وارد کنید و اطلاعات اولیه را بسازید.</p>
                    </article>

                    <article class="modir-reveal relative rounded-3xl border border-[#003260]/10 bg-white/65 p-7 text-center backdrop-blur-lg" style="transition-delay:.1s">
                        <div class="relative mx-auto grid h-20 w-20 place-items-center rounded-[25px] bg-[#003260] text-white shadow-xl shadow-[#003260]/15">
                            <span class="absolute -right-2 -top-2 grid h-7 w-7 place-items-center rounded-full border-2 border-[#e5e2dd] bg-white text-xs font-black text-[#003260]">۲</span>
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M12 3v18m5-13H9.5a3 3 0 0 0 0 6h5a3 3 0 0 1 0 6H6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <h3 class="mt-6 text-lg font-black text-[#003260]">امور مالی را سامان دهید</h3>
                        <p class="mt-3 text-sm leading-8 text-[#718497]">شارژها، پرداخت‌ها و هزینه‌های ساختمان را ثبت و پیگیری کنید.</p>
                    </article>

                    <article class="modir-reveal relative rounded-3xl border border-[#003260]/10 bg-white/65 p-7 text-center backdrop-blur-lg" style="transition-delay:.2s">
                        <div class="relative mx-auto grid h-20 w-20 place-items-center rounded-[25px] bg-[#003260] text-white shadow-xl shadow-[#003260]/15">
                            <span class="absolute -right-2 -top-2 grid h-7 w-7 place-items-center rounded-full border-2 border-[#e5e2dd] bg-white text-xs font-black text-[#003260]">۳</span>
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M4 19V5m0 14h16M7 15l4-4 3 2 5-7" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h3 class="mt-6 text-lg font-black text-[#003260]">گزارش‌ها را بررسی کنید</h3>
                        <p class="mt-3 text-sm leading-8 text-[#718497]">با دسترسی به اطلاعات ثبت‌شده، وضعیت ساختمان را روشن‌تر دنبال کنید.</p>
                    </article>
                </div>
            </div>
        </section>

        {{-- Benefits --}}
        <section id="benefits" class="bg-white py-20 sm:py-28">
            <div class="modir-container grid items-center gap-12 lg:grid-cols-2 lg:gap-20">
                <div class="modir-reveal">
                    <span class="text-xs font-black tracking-widest text-[#718497]">مدیریت با دید روشن‌تر</span>
                    <h2 class="mt-4 text-3xl font-black leading-relaxed text-[#003260] sm:text-4xl">
                        نظم بیشتر برای مدیر،
                        <span class="modir-gradient-text">شفافیت بیشتر برای ساختمان</span>
                    </h2>
                    <p class="mt-5 text-sm leading-9 text-[#718497] sm:text-base">
                        مدیر خوب برای سامان‌دهی اطلاعات و پیگیری امور ساختمان طراحی شده است؛
                        تا ثبت اطلاعات، بررسی هزینه‌ها و تهیه گزارش‌ها در محیطی منظم‌تر انجام شود.
                    </p>

                    <div class="mt-8 space-y-5">
                        <div class="flex items-start gap-4">
                            <span class="mt-1 grid h-8 w-8 shrink-0 place-items-center rounded-xl bg-[#e5e2dd] text-[#003260]">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="m5 12 4 4L19 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <div>
                                <h3 class="text-sm font-black text-[#003260]">اطلاعات در دسترس و دسته‌بندی‌شده</h3>
                                <p class="mt-2 text-xs leading-7 text-[#718497]">برای بررسی واحدها، هزینه‌ها و وضعیت مالی، مسیر مشخص‌تری داشته باشید.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <span class="mt-1 grid h-8 w-8 shrink-0 place-items-center rounded-xl bg-[#e5e2dd] text-[#003260]">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="m5 12 4 4L19 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <div>
                                <h3 class="text-sm font-black text-[#003260]">پیگیری ساده‌تر امور مالی</h3>
                                <p class="mt-2 text-xs leading-7 text-[#718497]">اطلاعات شارژ، پرداخت‌ها و هزینه‌ها را در یک جریان کاری منظم دنبال کنید.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <span class="mt-1 grid h-8 w-8 shrink-0 place-items-center rounded-xl bg-[#e5e2dd] text-[#003260]">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="m5 12 4 4L19 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <div>
                                <h3 class="text-sm font-black text-[#003260]">گزارش‌گیری هدفمند</h3>
                                <p class="mt-2 text-xs leading-7 text-[#718497]">گزارش‌های کاربردی برای مرور و بررسی بهتر وضعیت ساختمان در اختیار داشته باشید.</p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('subscription') }}" class="modir-primary-btn mt-9 modir-bold">
                        مشاهده مسیر تهیه اشتراک
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M19 12H5m0 0 7 7m-7-7 7-7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>

                <div class="modir-reveal relative" style="transition-delay:.12s">
                    <div class="absolute -inset-5 rounded-[35px] bg-[#e5e2dd]/70"></div>

                    <div class="relative overflow-hidden rounded-[28px] bg-[#003260] p-6 text-white sm:p-9">
                        <div class="absolute -left-16 -top-16 h-56 w-56 rounded-full border border-white/10"></div>
                        <div class="absolute -left-5 -top-5 h-36 w-36 rounded-full border border-white/10"></div>
                        <div class="modir-grid absolute inset-0 opacity-20"></div>

                        <div class="relative">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <div class="text-xs font-bold text-white/60 modir-bold">یک نمای کلی از امور</div>
                                    <h3 class="mt-2 text-xl font-black sm:text-2xl">ساختمان در یک نگاه</h3>
                                </div>
                                <span class="grid h-12 w-12 place-items-center rounded-2xl border border-white/15 bg-white/10">
                                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M3 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16M7 7h2m-2 4h2m4-4h1m-1 4h1M2 21h20M9 21v-4h4v4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                                    </svg>
                                </span>
                            </div>

                            <div class="mt-8 grid grid-cols-2 gap-3">
                                <div class="rounded-2xl border border-white/10 bg-white/[.07] p-4">
                                    <div class="text-xs text-white/60">اطلاعات واحدها</div>
                                    <div class="mt-3 text-sm font-extrabold modir-bold">ساختارمند</div>
                                    <div class="mt-4 h-1.5 rounded-full bg-white/10"><div class="h-full w-4/5 rounded-full bg-white/80"></div></div>
                                </div>
                                <div class="rounded-2xl border border-white/10 bg-white/[.07] p-4">
                                    <div class="text-xs text-white/60">هزینه‌های ساختمان</div>
                                    <div class="mt-3 text-sm font-extrabold modir-bold">قابل پیگیری</div>
                                    <div class="mt-4 h-1.5 rounded-full bg-white/10"><div class="h-full w-3/5 rounded-full bg-white/80"></div></div>
                                </div>
                                <div class="rounded-2xl border border-white/10 bg-white/[.07] p-4">
                                    <div class="text-xs text-white/60">وضعیت پرداخت‌ها</div>
                                    <div class="mt-3 text-sm font-extrabold modir-bold">قابل بررسی</div>
                                    <div class="mt-4 h-1.5 rounded-full bg-white/10"><div class="h-full w-2/3 rounded-full bg-white/80"></div></div>
                                </div>
                                <div class="rounded-2xl border border-white/10 bg-white/[.07] p-4">
                                    <div class="text-xs text-white/60">گزارش‌ها</div>
                                    <div class="mt-3 text-sm font-extrabold modir-bold">یکپارچه</div>
                                    <div class="mt-4 h-1.5 rounded-full bg-white/10"><div class="h-full w-5/6 rounded-full bg-white/80"></div></div>
                                </div>
                            </div>

                            <div class="mt-5 flex items-center gap-3 rounded-2xl border border-white/10 bg-white/[.07] p-4">
                                <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-white text-[#003260]">
                                    <svg width="21" height="21" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M12 3 4 6v5c0 5 3.4 8.5 8 10 4.6-1.5 8-5 8-10V6l-8-3Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/>
                                        <path d="m9 12 2 2 4-4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <div>
                                    <div class="text-xs font-extrabold modir-bold">سامان‌دهی در یک محیط</div>
                                    <div class="mt-1 text-[10px] leading-6 text-white/60">برای مدیریت روشن‌تر و منظم‌تر ساختمان</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- CTA --}}
        <section class="relative isolate overflow-hidden py-20 sm:py-28">
            <div class="modir-container">
                <div class="modir-reveal relative overflow-hidden rounded-[30px] bg-[#003260] px-6 py-12 text-center text-white sm:rounded-[40px] sm:px-12 sm:py-16 lg:px-20 lg:py-20">
                    <div class="absolute inset-0 -z-10 opacity-20">
                        <div class="modir-grid absolute inset-0"></div>
                        <div class="absolute -left-20 -top-24 h-80 w-80 rounded-full border border-white/30"></div>
                        <div class="absolute -left-5 -top-9 h-52 w-52 rounded-full border border-white/20"></div>
                        <div class="absolute -bottom-32 -right-12 h-80 w-80 rounded-full bg-white/5 blur-2xl"></div>
                    </div>

                    <span class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-xs font-bold text-white/80 modir-bold">
                        <span class="h-2 w-2 rounded-full bg-white"></span>
                        قدم بعدی برای مدیریت بهتر
                    </span>

                    <h2 class="mx-auto mt-6 max-w-3xl text-3xl font-black leading-relaxed sm:text-4xl lg:text-5xl">
                        وقت آن رسیده مدیریت ساختمان را ساده‌تر کنید.
                    </h2>

                    <p class="mx-auto mt-5 max-w-2xl text-sm leading-8 text-white/65 sm:text-base">
                        با مدیر خوب، اطلاعات ساختمان را منظم کنید و امور روزمره را با دیدی روشن‌تر پیش ببرید.
                    </p>

                    <div class="mt-9 flex flex-col justify-center gap-3 sm:flex-row">
                        <a href="{{ route('subscription') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-white px-7 py-4 text-sm font-black text-[#003260] transition hover:-translate-y-1 hover:bg-[#e5e2dd]">
                            تهیه یا خرید اشتراک
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M19 12H5m0 0 7 7m-7-7 7-7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        <a href="{{ url('/login') }}" class="inline-flex items-center justify-center rounded-2xl border border-white/25 px-7 py-4 text-sm font-extrabold text-white transition hover:bg-white/10 modir-bold">
                            ورود به سامانه
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection