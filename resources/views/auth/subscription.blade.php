@extends('layouts.auth')

@section('title', 'مدیر خوب - تهیه اشتراک')

@section('content')

    <div class="min-h-screen lg:flex">

        <!-- ============================= -->
        <!-- Main Area -->
        <!-- ============================= -->
        <main class="flex-1 px-5 lg:px-8 pt-6 pb-28 lg:pb-8">

            <!-- =========================================================
                 Subscription Hero
            ========================================================= -->
            <section class="relative overflow-hidden rounded-[28px] bg-[#003260] text-white shadow-xl shadow-[#003260]/10">

                <!-- Decorative Elements -->
                <div class="absolute -top-24 -left-24 w-72 h-72 rounded-full border border-white/10"></div>
                <div class="absolute -bottom-32 right-1/3 w-80 h-80 rounded-full border border-white/5"></div>

                <div class="absolute top-10 right-10 w-24 h-24 rounded-full bg-white/5 blur-sm"></div>
                <div class="absolute bottom-8 left-1/4 w-16 h-16 rounded-full bg-white/5"></div>


                <div class="relative px-6 py-10 sm:px-8 md:px-10 lg:px-12 lg:py-12">

                    <div class="max-w-4xl">

                        <!-- Badge -->
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/10 border border-white/10 text-white/80 text-xs sm:text-sm">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 width="17"
                                 height="17"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 stroke-linecap="round"
                                 stroke-linejoin="round">
                                <path d="M12 2l2.7 5.5 6.3.9-4.5 4.4 1.1 6.2L12 16l-5.6 3 1.1-6.2L3 8.4l6.3-.9L12 2z"/>
                            </svg>

                            <span>اشتراک مدیر خوب</span>

                        </div>


                        <!-- Title -->
                        <h1 class="mt-5 text-3xl sm:text-4xl lg:text-5xl leading-[1.5] modir-bold">
                            مدیریت ساختمان را
                            <span class="text-white/70">با مدیر خوب</span>
                            شروع کنید
                        </h1>


                        <!-- Description -->
                        <p class="mt-5 max-w-2xl text-sm sm:text-base text-white/70 leading-8">
                            با تهیه اشتراک یک‌ساله، مدیریت ساختمان خود را ساده‌تر و منظم‌تر کنید.
                            اطلاعات مدیر و ساختمان را ثبت کنید و پس از پرداخت، مدیریت ساختمان را آغاز کنید.
                        </p>


                        <!-- Bottom Info -->
                        <div class="mt-8 flex flex-col sm:flex-row sm:items-center gap-4 sm:gap-8">

                            <!-- Subscription -->
                            <div class="flex items-center gap-3">

                                <div class="w-11 h-11 rounded-2xl bg-white/10 border border-white/10 flex items-center justify-center shrink-0">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="21"
                                         height="21"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <rect x="3" y="5" width="18" height="14" rx="2"/>
                                        <path d="M3 10h18"/>
                                        <path d="M7 15h3"/>
                                    </svg>

                                </div>

                                <div>
                                    <p class="text-xs text-white/50">
                                        نوع اشتراک
                                    </p>

                                    <p class="mt-1 text-sm font-semibold text-white modir-bold">
                                        یک‌ساله
                                    </p>
                                </div>

                            </div>


                            <!-- Divider -->
                            <div class="hidden sm:block w-px h-10 bg-white/10"></div>


                            <!-- Activation -->
                            <div class="flex items-center gap-3">

                                <div class="w-11 h-11 rounded-2xl bg-white/10 border border-white/10 flex items-center justify-center shrink-0">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="21"
                                         height="21"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <path d="M12 2a10 10 0 1 0 10 10"/>
                                        <path d="m12 6 1.5 1.5"/>
                                        <path d="M12 12l4-4"/>
                                        <path d="M16 2v4h4"/>
                                    </svg>

                                </div>

                                <div>
                                    <p class="text-xs text-white/50">
                                        فعال‌سازی
                                    </p>

                                    <p class="mt-1 text-sm font-semibold text-white modir-bold">
                                        بلافاصله پس از پرداخت
                                    </p>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </section>
            <form method="POST" action="{{ route('subscription.store') }}">
                @csrf
                <!-- اطلاعات مدیر -->
                <section class="mt-6">
                    <div class="bg-white rounded-[28px] border border-slate-200/80 shadow-sm overflow-hidden">

                        <!-- Header -->
                        <div class="px-6 py-6 sm:px-8 border-b border-slate-100">
                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 rounded-2xl bg-[#003260]/8 text-[#003260] flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="22"
                                         height="22"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                    </svg>
                                </div>

                                <div>
                                    <h2 class="text-lg sm:text-xl font-bold text-slate-900 modir-bold">
                                        اطلاعات مدیر
                                    </h2>
                                    <p class="mt-1 text-sm text-slate-500 leading-7">
                                        اطلاعات مدیر ساختمان را برای ایجاد حساب کاربری وارد کنید.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Form -->
                        <div class="p-6 sm:p-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                <!-- First Name -->
                                <div>
                                    <label for="firstName" class="block text-sm font-medium text-slate-700 mb-2">
                                        نام
                                    </label>

                                    <div class="relative">
                                        <div class="absolute inset-y-0 right-4 flex items-center text-slate-400 pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 width="20"
                                                 height="20"
                                                 viewBox="0 0 24 24"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 stroke-width="1.8"
                                                 stroke-linecap="round"
                                                 stroke-linejoin="round">
                                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                            </svg>
                                        </div>

                                        <input
                                            type="text"
                                            id="firstName"
                                            name="first_name"
                                            placeholder="مثلاً محمد"
                                            autocomplete="given-name"
                                            class="w-full h-12 pr-12 pl-4 rounded-2xl border border-slate-200 bg-slate-50 text-sm text-slate-900 placeholder:text-slate-400 outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/8"
                                        >
                                    </div>
                                </div>

                                <!-- Last Name -->
                                <div>
                                    <label for="lastName" class="block text-sm font-medium text-slate-700 mb-2">
                                        نام خانوادگی
                                    </label>

                                    <div class="relative">
                                        <div class="absolute inset-y-0 right-4 flex items-center text-slate-400 pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 width="20"
                                                 height="20"
                                                 viewBox="0 0 24 24"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 stroke-width="1.8"
                                                 stroke-linecap="round"
                                                 stroke-linejoin="round">
                                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                            </svg>
                                        </div>

                                        <input
                                            type="text"
                                            id="lastName"
                                            name="last_name"
                                            placeholder="مثلاً احمدی"
                                            autocomplete="family-name"
                                            class="w-full h-12 pr-12 pl-4 rounded-2xl border border-slate-200 bg-slate-50 text-sm text-slate-900 placeholder:text-slate-400 outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/8"
                                        >
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="md:col-span-2">
                                    <label for="phone" class="block text-sm font-medium text-slate-700 mb-2">
                                        شماره تلفن همراه
                                    </label>

                                    <div class="relative">
                                        <div class="absolute inset-y-0 right-4 flex items-center text-slate-400 pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 width="20"
                                                 height="20"
                                                 viewBox="0 0 24 24"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 stroke-width="1.8"
                                                 stroke-linecap="round"
                                                 stroke-linejoin="round">
                                                <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2c-8.837 0 -16 -7.163 -16 -16a2 2 0 0 1 2 -2" />
                                            </svg>
                                        </div>

                                        <input
                                            type="tel"
                                            id="phone"
                                            name="phone"
                                            placeholder="مثلاً ۰۹۱۲۱۲۳۴۵۶۷۸"
                                            inputmode="tel"
                                            autocomplete="tel"
                                            dir="rtl"
                                            class="w-full h-12 pr-12 pl-4 rounded-2xl border border-slate-200 bg-slate-50 text-sm text-slate-900 placeholder:text-slate-400 outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/8"
                                        >
                                    </div>

                                    <p class="mt-2 text-xs text-slate-400">
                                        شماره تلفن همراه برای ورود و مدیریت حساب شما استفاده خواهد شد.
                                    </p>
                                </div>

                                <!-- Password -->
                                <div>
                                    <label for="password" class="block text-sm font-medium text-slate-700 mb-2">
                                        رمز عبور
                                    </label>

                                    <div class="relative">
                                        <div class="absolute inset-y-0 right-4 flex items-center text-slate-400 pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 width="20"
                                                 height="20"
                                                 viewBox="0 0 24 24"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 stroke-width="1.8"
                                                 stroke-linecap="round"
                                                 stroke-linejoin="round">
                                                <rect x="3" y="11" width="18" height="10" rx="2" />
                                                <path d="M7 11v-4a5 5 0 0 1 10 0v4" />
                                            </svg>
                                        </div>

                                        <input
                                            type="password"
                                            id="password"
                                            name="password"
                                            placeholder="رمز عبور خود را وارد کنید"
                                            autocomplete="new-password"
                                            class="w-full h-12 pr-12 pl-4 rounded-2xl border border-slate-200 bg-slate-50 text-sm text-slate-900 placeholder:text-slate-400 outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/8"
                                        >
                                    </div>
                                </div>

                                <!-- Password Confirmation -->
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-2">
                                        تکرار رمز عبور
                                    </label>

                                    <div class="relative">
                                        <div class="absolute inset-y-0 right-4 flex items-center text-slate-400 pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 width="20"
                                                 height="20"
                                                 viewBox="0 0 24 24"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 stroke-width="1.8"
                                                 stroke-linecap="round"
                                                 stroke-linejoin="round">
                                                <rect x="3" y="11" width="18" height="10" rx="2" />
                                                <path d="M7 11v-4a5 5 0 0 1 10 0v4" />
                                            </svg>
                                        </div>

                                        <input
                                            type="password"
                                            id="password_confirmation"
                                            name="password_confirmation"
                                            placeholder="رمز عبور را دوباره وارد کنید"
                                            autocomplete="new-password"
                                            class="w-full h-12 pr-12 pl-4 rounded-2xl border border-slate-200 bg-slate-50 text-sm text-slate-900 placeholder:text-slate-400 outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/8"
                                        >
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </section>

                <!-- اطلاعات ساختمان -->
                <section class="mt-6">
                    <div class="bg-white rounded-[28px] border border-slate-200/80 shadow-sm overflow-hidden">

                        <!-- Header -->
                        <div class="px-6 py-6 sm:px-8 border-b border-slate-100">
                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 rounded-2xl bg-[#003260]/8 text-[#003260] flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="22"
                                         height="22"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <path d="M3 21l18 0" />
                                        <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16" />
                                        <path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4" />
                                        <path d="M9 8l1 0" />
                                        <path d="M14 8l1 0" />
                                        <path d="M9 12l1 0" />
                                        <path d="M14 12l1 0" />
                                    </svg>
                                </div>

                                <div>
                                    <h2 class="text-lg sm:text-xl font-bold text-slate-900 modir-bold">
                                        اطلاعات ساختمان
                                    </h2>
                                    <p class="mt-1 text-sm text-slate-500 leading-7">
                                        اطلاعات ساختمان تحت مدیریت خود را وارد کنید.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Form -->
                        <div class="p-6 sm:p-8">
                            <div class="space-y-5">

                                <!-- Building Name -->
                                <div>
                                    <label for="buildingName" class="block text-sm font-medium text-slate-700 mb-2">
                                        نام ساختمان
                                    </label>

                                    <div class="relative">
                                        <div class="absolute inset-y-0 right-4 flex items-center text-slate-400 pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 width="20"
                                                 height="20"
                                                 viewBox="0 0 24 24"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 stroke-width="1.8"
                                                 stroke-linecap="round"
                                                 stroke-linejoin="round">
                                                <path d="M3 21l18 0" />
                                                <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16" />
                                                <path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4" />
                                                <path d="M9 8l1 0" />
                                                <path d="M14 8l1 0" />
                                                <path d="M9 12l1 0" />
                                                <path d="M14 12l1 0" />
                                            </svg>
                                        </div>

                                        <input
                                            type="text"
                                            id="buildingName"
                                            name="building_name"
                                            placeholder="مثلاً مجتمع آسمان"
                                            autocomplete="organization"
                                            class="w-full h-12 pr-12 pl-4 rounded-2xl border border-slate-200 bg-slate-50 text-sm text-slate-900 placeholder:text-slate-400 outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/8"
                                        >
                                    </div>
                                </div>

                                <!-- Building Address -->
                                <div>
                                    <label for="buildingAddress" class="block text-sm font-medium text-slate-700 mb-2">
                                        آدرس ساختمان (ابتدا نام شهر را وارد کنید)
                                    </label>

                                    <div class="relative">
                                        <div class="absolute top-4 right-4 flex items-center text-slate-400 pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 width="20"
                                                 height="20"
                                                 viewBox="0 0 24 24"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 stroke-width="1.8"
                                                 stroke-linecap="round"
                                                 stroke-linejoin="round">
                                                <path d="M12 21s8 -7 8 -12a8 8 0 1 0 -16 0c0 5 8 12 8 12" />
                                                <circle cx="12" cy="9" r="2" />
                                            </svg>
                                        </div>

                                        <textarea
                                            id="buildingAddress"
                                            name="building_address"
                                            rows="4"
                                            placeholder="آدرس کامل ساختمان را وارد کنید..."
                                            class="w-full min-h-[120px] resize-none pr-12 pl-4 py-3.5 rounded-2xl border border-slate-200 bg-slate-50 text-sm text-slate-900 placeholder:text-slate-400 leading-7 outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/8"
                                        ></textarea>
                                    </div>

                                    <p class="mt-2 text-xs text-slate-400">
                                        آدرس ساختمان برای ثبت و مدیریت اطلاعات ساختمان شما استفاده می‌شود.
                                    </p>
                                </div>

                            </div>
                        </div>

                    </div>
                </section>

                <!-- اشتراک یک‌ساله -->
                <section class="mt-6">
                    <div class="bg-white rounded-[28px] border border-slate-200/80 shadow-sm overflow-hidden">

                        <!-- Header -->
                        <div class="px-6 py-6 sm:px-8 border-b border-slate-100">
                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 rounded-2xl bg-[#003260]/8 text-[#003260] flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="22"
                                         height="22"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <path d="M12 3l8 4v5c0 5 -3.5 8 -8 9c-4.5 -1 -8 -4 -8 -9v-5l8 -4" />
                                        <path d="M9 12l2 2l4 -4" />
                                    </svg>
                                </div>

                                <div>
                                    <h2 class="text-lg sm:text-xl font-bold text-slate-900 modir-bold">
                                        اشتراک یک‌ساله
                                    </h2>
                                    <p class="mt-1 text-sm text-slate-500 leading-7">
                                        با فعال‌سازی اشتراک، مدیریت ساختمان خود را به‌صورت کامل آغاز کنید.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Subscription Card -->
                        <div class="p-6 sm:p-8">
                            <div class="relative overflow-hidden rounded-[24px] bg-[#023e00] text-white p-6 sm:p-8">

                                <!-- Decorative Elements -->
                                <div class="absolute -top-24 -left-24 w-72 h-72 rounded-full border border-white/10"></div>
                                <div class="absolute -bottom-32 right-1/3 w-80 h-80 rounded-full border border-white/5"></div>

                                <div class="absolute top-10 right-10 w-24 h-24 rounded-full bg-white/5 blur-sm"></div>
                                <div class="absolute bottom-8 left-1/4 w-16 h-16 rounded-full bg-white/5"></div>

                                <div class="relative">

                                    <!-- Top -->
                                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-6">

                                        <div>
                                            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 border border-white/10 text-xs text-white/80">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     width="16"
                                                     height="16"
                                                     viewBox="0 0 24 24"
                                                     fill="none"
                                                     stroke="currentColor"
                                                     stroke-width="1.8"
                                                     stroke-linecap="round"
                                                     stroke-linejoin="round">
                                                    <path d="M12 3l8 4v5c0 5 -3.5 8 -8 9c-4.5 -1 -8 -4 -8 -9v-5l8 -4" />
                                                    <path d="M9 12l2 2l4 -4" />
                                                </svg>
                                                اشتراک فعال‌سازی مدیریت ساختمان
                                            </div>

                                            <h3 class="mt-5 text-2xl sm:text-3xl font-bold modir-bold">
                                                اشتراک مدیر خوب
                                            </h3>

                                            <p class="mt-3 text-sm sm:text-base text-white/70 leading-8 max-w-xl">
                                                دسترسی کامل به امکانات مدیریت ساختمان برای مدت یک سال،
                                                از زمان فعال‌سازی اشتراک.
                                            </p>
                                        </div>

                                        <!-- Price -->
                                        <div class="sm:text-left shrink-0">
                                            <span class="block text-xs text-white/60 mb-2">
                                                مبلغ اشتراک
                                            </span>

                                            <div class="flex items-baseline gap-2 sm:justify-end">
                                                <span class="text-3xl sm:text-4xl font-bold modir-bold">
                                                    {{ toPersianDigits(number_format($plan->price)) }}
                                                </span>
                                                <span class="text-sm text-white/70">
                                                    تومان
                                                </span>
                                            </div>

                                            <span class="block mt-2 text-xs text-white/50 sm:text-left">
                                                اعتبار یک‌ساله
                                            </span>
                                        </div>

                                    </div>

                                    <!-- Divider -->
                                    <div class="my-7 h-px bg-white/10"></div>

                                    <!-- Features -->
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-xl bg-white/10 flex items-center justify-center shrink-0">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     width="17"
                                                     height="17"
                                                     viewBox="0 0 24 24"
                                                     fill="none"
                                                     stroke="currentColor"
                                                     stroke-width="1.8"
                                                     stroke-linecap="round"
                                                     stroke-linejoin="round">
                                                    <path d="M5 12l5 5l10 -10" />
                                                </svg>
                                            </div>
                                            <span class="text-sm text-white/85">
                                                مدیریت کامل ساختمان
                                            </span>
                                        </div>

                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-xl bg-white/10 flex items-center justify-center shrink-0">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     width="17"
                                                     height="17"
                                                     viewBox="0 0 24 24"
                                                     fill="none"
                                                     stroke="currentColor"
                                                     stroke-width="1.8"
                                                     stroke-linecap="round"
                                                     stroke-linejoin="round">
                                                    <path d="M5 12l5 5l10 -10" />
                                                </svg>
                                            </div>
                                            <span class="text-sm text-white/85">
                                                مدیریت واحدها و ساکنین
                                            </span>
                                        </div>

                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-xl bg-white/10 flex items-center justify-center shrink-0">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     width="17"
                                                     height="17"
                                                     viewBox="0 0 24 24"
                                                     fill="none"
                                                     stroke="currentColor"
                                                     stroke-width="1.8"
                                                     stroke-linecap="round"
                                                     stroke-linejoin="round">
                                                    <path d="M5 12l5 5l10 -10" />
                                                </svg>
                                            </div>
                                            <span class="text-sm text-white/85">
                                                مدیریت شارژ و هزینه‌ها
                                            </span>
                                        </div>

                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-xl bg-white/10 flex items-center justify-center shrink-0">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     width="17"
                                                     height="17"
                                                     viewBox="0 0 24 24"
                                                     fill="none"
                                                     stroke="currentColor"
                                                     stroke-width="1.8"
                                                     stroke-linecap="round"
                                                     stroke-linejoin="round">
                                                    <path d="M5 12l5 5l10 -10" />
                                                </svg>
                                            </div>
                                            <span class="text-sm text-white/85">
                                                گزارش‌گیری و چاپ گزارش‌ها
                                            </span>
                                        </div>

                                    </div>

                                    <!-- Activation -->
                                    <div class="mt-7 flex items-center gap-3 rounded-2xl bg-white/8 border border-white/10 px-4 py-3.5">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="20"
                                             height="20"
                                             viewBox="0 0 24 24"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8"
                                             stroke-linecap="round"
                                             stroke-linejoin="round"
                                             class="shrink-0">
                                            <path d="M12 8v4l3 3" />
                                            <circle cx="12" cy="12" r="9" />
                                        </svg>

                                        <div>
                                            <p class="text-sm font-medium">
                                                فعال‌سازی بلافاصله پس از پرداخت
                                            </p>
                                            <p class="mt-1 text-xs text-white/55">
                                                اشتراک شما پس از پرداخت موفق فعال خواهد شد.
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </section>

                <!-- تست انسانی -->
                <section class="mt-6">
                    <div class="bg-white rounded-[28px] border border-slate-200/80 shadow-sm overflow-hidden">

                        <!-- Header -->
                        <div class="px-6 py-6 sm:px-8 border-b border-slate-100">
                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 rounded-2xl bg-[#003260]/8 text-[#003260] flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="22"
                                         height="22"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <path d="M12 3l8 4v5c0 5 -3.5 8 -8 9c-4.5 -1 -8 -4 -8 -9v-5l8 -4" />
                                        <path d="M9 12l2 2l4 -4" />
                                    </svg>
                                </div>

                                <div>
                                    <h2 class="text-lg sm:text-xl font-bold text-slate-900 modir-bold">
                                        تست انسانی
                                    </h2>
                                    <p class="mt-1 text-sm text-slate-500 leading-7">
                                        برای ادامه فرایند تهیه اشتراک، تأیید کنید که ربات نیستید.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Human Verification -->
                        <div class="p-6 sm:p-8">

                            <label
                                for="humanVerification"
                                class="flex items-center gap-4 p-4 sm:p-5 rounded-2xl border border-slate-200 bg-slate-50 cursor-pointer transition hover:border-[#003260]/30 hover:bg-[#003260]/[0.02]">

                                <input
                                    type="checkbox"
                                    id="humanVerification"
                                    name="human_verification"
                                    class="w-5 h-5 rounded border-slate-300 text-[#003260] focus:ring-[#003260]/20 cursor-pointer shrink-0"
                                >

                                <div class="flex-1">
                                    <span class="block text-sm font-medium text-slate-800">
                                        من ربات نیستم
                                    </span>
                                    <span class="block mt-1 text-xs text-slate-400">
                                        برای ادامه، این گزینه را تأیید کنید.
                                    </span>
                                </div>

                                <div class="w-10 h-10 rounded-xl bg-white border border-slate-200 text-[#003260] flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="21"
                                         height="21"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <path d="M9 12l2 2l4 -4" />
                                        <path d="M12 3l7 4v5c0 4.5 -3 7.5 -7 9c-4 -1.5 -7 -4.5 -7 -9v-5l7 -4" />
                                    </svg>
                                </div>

                            </label>

                        </div>

                    </div>
                </section>

                <!-- اعتماد و امنیت -->
                <section class="mt-6">
                    <div class="bg-white rounded-[28px] border border-slate-200/80 shadow-sm overflow-hidden">

                        <!-- Header -->
                        <div class="px-6 py-6 sm:px-8 border-b border-slate-100">
                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 rounded-2xl bg-[#003260]/8 text-[#003260] flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="22"
                                         height="22"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <path d="M12 3l8 4v5c0 5 -3.5 8 -8 9c-4.5 -1 -8 -4 -8 -9v-5l8 -4" />
                                        <path d="M9 12l2 2l4 -4" />
                                    </svg>
                                </div>

                                <div>
                                    <h2 class="text-lg sm:text-xl font-bold text-slate-900 modir-bold">
                                        اعتماد و امنیت
                                    </h2>
                                    <p class="mt-1 text-sm text-slate-500 leading-7">
                                        با خیال راحت اشتراک خود را تهیه کنید.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Trust Items -->
                        <div class="p-6 sm:p-8">
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                                <!-- Secure Payment -->
                                <div class="flex items-center gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-100">
                                    <div class="w-10 h-10 rounded-xl bg-[#003260]/8 text-[#003260] flex items-center justify-center shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="20"
                                             height="20"
                                             viewBox="0 0 24 24"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8"
                                             stroke-linecap="round"
                                             stroke-linejoin="round">
                                            <rect x="3" y="5" width="18" height="14" rx="2" />
                                            <path d="M3 10h18" />
                                            <path d="M7 15h3" />
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="text-sm font-medium text-slate-800">
                                            پرداخت امن
                                        </p>
                                        <p class="mt-1 text-xs text-slate-400">
                                            پرداخت از درگاه بانکی
                                        </p>
                                    </div>
                                </div>

                                <!-- Activation -->
                                <div class="flex items-center gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-100">
                                    <div class="w-10 h-10 rounded-xl bg-[#003260]/8 text-[#003260] flex items-center justify-center shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="20"
                                             height="20"
                                             viewBox="0 0 24 24"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8"
                                             stroke-linecap="round"
                                             stroke-linejoin="round">
                                            <path d="M12 8v4l3 3" />
                                            <circle cx="12" cy="12" r="9" />
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="text-sm font-medium text-slate-800">
                                            فعال‌سازی سریع
                                        </p>
                                        <p class="mt-1 text-xs text-slate-400">
                                            بلافاصله پس از پرداخت
                                        </p>
                                    </div>
                                </div>

                                <!-- Privacy -->
                                <div class="flex items-center gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-100">
                                    <div class="w-10 h-10 rounded-xl bg-[#003260]/8 text-[#003260] flex items-center justify-center shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="20"
                                             height="20"
                                             viewBox="0 0 24 24"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8"
                                             stroke-linecap="round"
                                             stroke-linejoin="round">
                                            <rect x="5" y="11" width="14" height="10" rx="2" />
                                            <path d="M8 11v-4a4 4 0 0 1 8 0v4" />
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="text-sm font-medium text-slate-800">
                                            حفظ اطلاعات شما
                                        </p>
                                        <p class="mt-1 text-xs text-slate-400">
                                            اطلاعات شما محفوظ می‌ماند
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </section>

                            <!-- کد تخفیف -->
                <section class="mt-6">
                    <div class="bg-white rounded-[28px] border border-slate-200/80 shadow-sm overflow-hidden">

                        <!-- Header -->
                        <div class="px-6 py-6 sm:px-8 border-b border-slate-100">
                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 rounded-2xl bg-[#003260]/8 text-[#003260] flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="22"
                                         height="22"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <path d="M15 5l4 4" />
                                        <path d="M13 7l4 4" />
                                        <path d="M6 20l-2 -2a2 2 0 0 1 0 -3l9 -9l5 5l-9 9a2 2 0 0 1 -3 0z" />
                                        <path d="M16 16l4 4" />
                                        <path d="M20 16l-4 4" />
                                    </svg>
                                </div>

                                <div>
                                    <h2 class="text-lg sm:text-xl font-bold text-slate-900 modir-bold">
                                        کد تخفیف
                                    </h2>
                                    <p class="mt-1 text-sm text-slate-500 leading-7">
                                        اگر کد تخفیف دارید، آن را وارد کنید تا مبلغ تخفیف از هزینه اشتراک کسر شود.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Discount Form -->
                        <div class="p-6 sm:p-8">
                            <div class="flex flex-col sm:flex-row gap-3">

                                <div class="relative flex-1">
                                    <div class="absolute inset-y-0 right-4 flex items-center text-slate-400 pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="20"
                                             height="20"
                                             viewBox="0 0 24 24"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8"
                                             stroke-linecap="round"
                                             stroke-linejoin="round">
                                            <path d="M9 5h-2a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-10a2 2 0 0 0 -2 -2h-2" />
                                            <path d="M9 5a3 3 0 0 1 6 0" />
                                            <path d="M9 12h6" />
                                            <path d="M9 16h4" />
                                        </svg>
                                    </div>

                                    <input
                                        type="text"
                                        id="discountCode"
                                        name="discount_code"
                                        placeholder="کد تخفیف را وارد کنید"
                                        autocomplete="off"
                                        class="w-full h-12 pr-12 pl-4 rounded-2xl border border-slate-200 bg-slate-50 text-sm text-slate-900 placeholder:text-slate-400 outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/8"
                                    >
                                </div>

                                <button
                                    type="button"
                                    id="applyDiscountBtn"
                                    class="h-12 px-7 rounded-2xl bg-[#003260] text-white text-sm font-medium transition hover:bg-[#004276] active:scale-[0.98] whitespace-nowrap">
                                    اعمال کد تخفیف
                                </button>

                            </div>
                            @error('discount_code')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                            <!-- Discount Result -->
                            <div id="discountResult" class="hidden mt-4 rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3.5">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-white text-emerald-600 flex items-center justify-center shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="19"
                                             height="19"
                                             viewBox="0 0 24 24"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8"
                                             stroke-linecap="round"
                                             stroke-linejoin="round">
                                            <path d="M5 12l5 5l10 -10" />
                                        </svg>
                                    </div>

                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-emerald-800">
                                            کد تخفیف با موفقیت اعمال شد.
                                        </p>
                                        <p class="mt-1 text-xs text-emerald-600">
                                            ۲۰٪ تخفیف از مبلغ اشتراک شما کسر شد.
                                        </p>
                                    </div>

                                    <span class="text-sm font-bold text-emerald-700">
                                        ۳۹۶,۰۰۰ تومان
                                    </span>
                                </div>
                            </div>

                        </div>

                    </div>
                </section>

                <!-- خلاصه پرداخت -->
                <section class="mt-6">
                    <div class="bg-white rounded-[28px] border border-slate-200/80 shadow-sm overflow-hidden">

                        <!-- Header -->
                        <div class="px-6 py-6 sm:px-8 border-b border-slate-100">
                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 rounded-2xl bg-[#003260]/8 text-[#003260] flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="22"
                                         height="22"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <path d="M3 5h18v14h-18z" />
                                        <path d="M3 10h18" />
                                        <path d="M7 15h2" />
                                        <path d="M11 15h2" />
                                    </svg>
                                </div>

                                <div>
                                    <h2 class="text-lg sm:text-xl font-bold text-slate-900 modir-bold">
                                        خلاصه پرداخت
                                    </h2>
                                    <p class="mt-1 text-sm text-slate-500 leading-7">
                                        جزئیات مبلغ اشتراک و مبلغ نهایی قابل پرداخت را بررسی کنید.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Summary -->
                        <div class="p-6 sm:p-8">

                            <div class="rounded-[24px] border border-slate-200 bg-slate-50 overflow-hidden">

                                <!-- Subscription -->
                                <div class="flex items-center justify-between gap-4 px-5 sm:px-6 py-5 border-b border-slate-200">
                                    <div>
                                        <p class="text-sm font-medium text-slate-800">
                                            اشتراک یک‌ساله مدیر خوب
                                        </p>
                                        <p class="mt-1 text-xs text-slate-400">
                                            اعتبار یک‌ساله
                                        </p>
                                    </div>

                                    <span
                                        id="summaryPlanPrice"
                                        data-price="{{ $plan->price }}"
                                        class="text-sm font-semibold text-slate-700 whitespace-nowrap modir-bold"
                                    >
                                        {{ toPersianDigits(number_format($plan->price)) }} تومان
                                    </span>
                                </div>

                                <!-- Discount -->
                                <div class="flex items-center justify-between gap-4 px-5 sm:px-6 py-5 border-b border-slate-200">
                                    <div>
                                        <p class="text-sm font-medium text-emerald-700">
                                            تخفیف
                                        </p>
                                        <p class="mt-1 text-xs text-slate-400">
                                            کد تخفیف اعمال‌شده
                                        </p>
                                    </div>

                                    <span
                                        id="summaryDiscountAmount"
                                        class="text-sm font-semibold text-emerald-600 whitespace-nowrap"
                                    >
                                        ۰ تومان
                                    </span>
                                </div>

                                <!-- Final Amount -->
                                <div class="px-5 sm:px-6 py-5 bg-white">
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                                        <div>
                                            <p class="text-sm text-slate-500">
                                                مبلغ قابل پرداخت
                                            </p>

                                            <div class="mt-1 flex items-baseline gap-2">
                                                <span
                                                    id="summaryFinalAmount"
                                                    class="text-2xl sm:text-3xl font-bold text-[#003260] modir-bold"
                                                >
                                                    {{ toPersianDigits(number_format($plan->price)) }}
                                                </span>

                                                <span class="text-sm text-slate-500">
                                                    تومان
                                                </span>
                                            </div>
                                        </div>

                                        <button
                                            type="submit"
                                            id="paymentBtn"
                                            class="w-full sm:w-auto min-w-[220px] h-13 px-7 rounded-2xl bg-[#003260] text-white text-sm font-medium shadow-lg shadow-[#003260]/15 transition hover:bg-[#004276] active:scale-[0.98] flex items-center justify-center gap-2 cursor-pointer">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 width="20"
                                                 height="20"
                                                 viewBox="0 0 24 24"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 stroke-width="1.8"
                                                 stroke-linecap="round"
                                                 stroke-linejoin="round">
                                                <rect x="3" y="5" width="18" height="14" rx="2" />
                                                <path d="M3 10h18" />
                                                <path d="M7 15h3" />
                                            </svg>

                                            <span>
                                                فعال‌سازی اشتراک
                                            </span>
                                        </button>

                                    </div>
                                </div>

                            </div>

                            <!-- Payment Note -->
                            <div class="mt-4 flex items-start gap-3 px-1">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="18"
                                     height="18"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.8"
                                     stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="text-slate-400 shrink-0 mt-0.5">
                                    <circle cx="12" cy="12" r="9" />
                                    <path d="M12 8v4" />
                                    <path d="M12 16h.01" />
                                </svg>

                                <p class="text-xs text-slate-400 leading-6">
                                    پس از پرداخت موفق، اشتراک یک‌ساله شما فعال شده و اطلاعات ساختمان
                                    برای مدیریت در حساب شما ثبت خواهد شد.
                                </p>
                            </div>

                        </div>

                    </div>
                </section>
            </form>
        </main>

    </div>

    <script>
        const applyDiscountBtn = document.getElementById('applyDiscountBtn');
        const discountCodeInput = document.querySelector('input[name="discount_code"]');

        const planPriceElement = document.getElementById('summaryPlanPrice');
        const discountAmountElement = document.getElementById('summaryDiscountAmount');
        const finalAmountElement = document.getElementById('summaryFinalAmount');

        const planPrice = Number(planPriceElement.dataset.price);

        let appliedDiscountPercent = 0;

        function toPersianNumber(value) {
            return new Intl.NumberFormat('fa-IR').format(value);
        }

        function updatePaymentSummary(discountPercent = 0) {
            const discountAmount = Math.round(
                planPrice * discountPercent / 100
            );

            const finalAmount = Math.max(
                0,
                planPrice - discountAmount
            );

            discountAmountElement.textContent =
                `${toPersianNumber(discountAmount)}- تومان`;

            finalAmountElement.textContent =
                toPersianNumber(finalAmount);
        }

        applyDiscountBtn.addEventListener('click', async () => {
            const discountCode = discountCodeInput.value.trim();

            if (!discountCode) {
                appliedDiscountPercent = 0;
                updatePaymentSummary();
                showDiscountMessage('لطفاً کد تخفیف را وارد کنید.', false);
                return;
            }

            applyDiscountBtn.disabled = true;
            applyDiscountBtn.textContent = 'در حال بررسی...';

            try {
                const response = await fetch('{{ route('subscription.check-coupon') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        discount_code: discountCode,
                    }),
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    appliedDiscountPercent = Math.min(
                        100,
                        Math.max(0, Number(data.discount_percent) || 0)
                    );

                    updatePaymentSummary(appliedDiscountPercent);
                    showDiscountMessage(data.message, true);
                } else {
                    appliedDiscountPercent = 0;
                    updatePaymentSummary();
                    showDiscountMessage(
                        data.message || 'کد تخفیف معتبر نیست.',
                        false
                    );
                }
            } catch (error) {
                appliedDiscountPercent = 0;
                updatePaymentSummary();

                showDiscountMessage(
                    'در بررسی کد تخفیف مشکلی پیش آمد. لطفاً دوباره تلاش کنید.',
                    false
                );
            } finally {
                applyDiscountBtn.disabled = false;
                applyDiscountBtn.textContent = 'اعمال کد تخفیف';
            }
        });

        function showDiscountMessage(message, success) {
            let messageElement = document.getElementById('discountMessage');

            if (!messageElement) {
                messageElement = document.createElement('p');
                messageElement.id = 'discountMessage';
                messageElement.className = 'mt-2 text-sm';

                discountCodeInput.parentElement.parentElement.appendChild(
                    messageElement
                );
            }

            messageElement.textContent = message;

            messageElement.classList.remove(
                'text-green-600',
                'text-red-600'
            );

            messageElement.classList.add(
                success ? 'text-green-600' : 'text-red-600'
            );
        }

        updatePaymentSummary();
    </script>

@endsection