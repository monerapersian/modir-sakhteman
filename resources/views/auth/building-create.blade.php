@extends('layouts.auth')

@section('title', 'مدیر خوب - تهیه اشتراک')

@section('content')

    <div class="min-h-screen lg:flex">

        <!-- ============================= -->
        <!-- Main Area -->
        <!-- ============================= -->
        <main class="flex-1 px-5 lg:px-8 pt-6 pb-28 lg:pb-8">

            <!-- =========================================================
                Hero
            ========================================================= -->
            <section class="relative overflow-hidden rounded-[28px] bg-[#003260] text-white shadow-xl shadow-[#003260]/10">

                <!-- Decorative Elements -->
                <div class="absolute -top-24 -left-24 w-72 h-72 rounded-full border border-white/10"></div>
                <div class="absolute -bottom-32 right-1/3 w-80 h-80 rounded-full border border-white/5"></div>

                <div class="absolute top-10 right-10 w-24 h-24 rounded-full bg-white/5 blur-sm"></div>
                <div class="absolute bottom-8 left-1/4 w-16 h-16 rounded-full bg-white/5"></div>

                <div class="relative px-6 py-8 sm:px-8 lg:px-10 lg:py-10">

                    <!-- Badge -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-full bg-white/10 border border-white/10 text-xs sm:text-sm text-white/80">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             width="17"
                             height="17"
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

                        ثبت ساختمان
                    </div>

                    <!-- Content -->
                    <div class="mt-6 max-w-3xl">
                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold leading-[1.7] modir-bold">
                            اطلاعات ساختمان خود را ثبت کنید
                        </h1>

                        <p class="mt-4 text-sm sm:text-base text-white/70 leading-8 max-w-2xl">
                            اطلاعات ساختمان را وارد کنید تا ساختار مدیریت ساختمان شما در
                            «مدیر خوب» ایجاد و آماده استفاده شود.
                        </p>
                    </div>

                    <!-- Building & Manager Info -->
                    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-3xl">

                        <!-- Building -->
                        <div class="flex items-center gap-4 rounded-2xl bg-white/10 border border-white/10 px-4 py-4">

                            <div class="w-11 h-11 rounded-xl bg-white/10 flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="21"
                                     height="21"
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

                            <div class="min-w-0">
                                <span class="block text-xs text-white/50">
                                    نام ساختمان
                                </span>

                                <span class="block mt-1 text-sm sm:text-base font-medium truncate">
                                    مجتمع آسمان
                                </span>
                            </div>

                        </div>

                        <!-- Manager -->
                        <div class="flex items-center gap-4 rounded-2xl bg-white/10 border border-white/10 px-4 py-4">

                            <div class="w-11 h-11 rounded-xl bg-white/10 flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="21"
                                     height="21"
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

                            <div class="min-w-0">
                                <span class="block text-xs text-white/50">
                                    مدیر ساختمان
                                </span>

                                <span class="block mt-1 text-sm sm:text-base font-medium truncate">
                                    محمد احمدی
                                </span>
                            </div>

                        </div>

                    </div>

                </div>
            </section>

            <form method="POST" action="{{ route('building.store') }}">
            @csrf
                <!-- اطلاعات پایه ساختمان -->
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
                                        اطلاعات پایه ساختمان
                                    </h2>

                                    <p class="mt-1 text-sm text-slate-500 leading-7">
                                        مشخصات کلی ساختمان را برای ایجاد ساختار مدیریت آن وارد کنید.
                                    </p>
                                </div>

                            </div>
                        </div>

                        <!-- Form -->
                        <div class="p-6 sm:p-8">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                                <!-- Construction Year -->
                                <div>
                                    <label for="constructionYear" class="block text-sm font-medium text-slate-700 mb-2">
                                        سال ساخت ساختمان
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
                                                <rect x="4" y="5" width="16" height="16" rx="2" />
                                                <path d="M16 3v4" />
                                                <path d="M8 3v4" />
                                                <path d="M4 11h16" />
                                            </svg>
                                        </div>

                                        <input
                                            type="number"
                                            id="constructionYear"
                                            name="construction_year"
                                            placeholder="مثلاً ۱۴۰۰"
                                            inputmode="numeric"
                                            class="w-full h-12 pr-12 pl-4 rounded-2xl border border-slate-200 bg-slate-50 text-sm text-slate-900 placeholder:text-slate-400 outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/8"
                                        >
                                    </div>
                                </div>

                                <!-- Floors -->
                                <div>
                                    <label for="floorCount" class="block text-sm font-medium text-slate-700 mb-2">
                                        تعداد طبقات
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
                                                <path d="M3 21h18" />
                                                <path d="M5 21v-14" />
                                                <path d="M9 21v-10" />
                                                <path d="M13 21v-16" />
                                                <path d="M17 21v-12" />
                                            </svg>
                                        </div>

                                        <input
                                            type="number"
                                            id="floorCount"
                                            name="floor_count"
                                            placeholder="مثلاً ۵"
                                            min="1"
                                            inputmode="numeric"
                                            class="w-full h-12 pr-12 pl-4 rounded-2xl border border-slate-200 bg-slate-50 text-sm text-slate-900 placeholder:text-slate-400 outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/8"
                                        >
                                    </div>
                                </div>

                                <!-- Residential Units -->
                                <div>
                                    <label for="residentialUnits" class="block text-sm font-medium text-slate-700 mb-2">
                                        تعداد واحدهای مسکونی
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
                                                <path d="M4 20v-10l8-6l8 6v10" />
                                                <path d="M9 20v-6h6v6" />
                                                <path d="M9 10h.01" />
                                                <path d="M15 10h.01" />
                                            </svg>
                                        </div>

                                        <input
                                            type="number"
                                            id="residentialUnits"
                                            name="residential_units"
                                            placeholder="مثلاً ۲۰"
                                            min="0"
                                            inputmode="numeric"
                                            class="w-full h-12 pr-12 pl-4 rounded-2xl border border-slate-200 bg-slate-50 text-sm text-slate-900 placeholder:text-slate-400 outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/8"
                                        >
                                    </div>
                                </div>

                                <!-- Administrative Units -->
                                <div>
                                    <label for="administrativeUnits" class="block text-sm font-medium text-slate-700 mb-2">
                                        تعداد واحدهای اداری
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
                                                <path d="M4 21v-15l8-3l8 3v15" />
                                                <path d="M8 9h2" />
                                                <path d="M14 9h2" />
                                                <path d="M8 13h2" />
                                                <path d="M14 13h2" />
                                                <path d="M10 21v-4h4v4" />
                                            </svg>
                                        </div>

                                        <input
                                            type="number"
                                            id="administrativeUnits"
                                            name="administrative_units"
                                            placeholder="مثلاً ۲"
                                            min="0"
                                            inputmode="numeric"
                                            class="w-full h-12 pr-12 pl-4 rounded-2xl border border-slate-200 bg-slate-50 text-sm text-slate-900 placeholder:text-slate-400 outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/8"
                                        >
                                    </div>
                                </div>

                                <!-- Commercial Units -->
                                <div>
                                    <label for="commercialUnits" class="block text-sm font-medium text-slate-700 mb-2">
                                        تعداد واحدهای تجاری
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
                                                <path d="M4 20h16" />
                                                <path d="M5 20v-9h14v9" />
                                                <path d="M7 11v-5h10v5" />
                                                <path d="M9 6v-3h6v3" />
                                                <path d="M8 15h2" />
                                                <path d="M14 15h2" />
                                            </svg>
                                        </div>

                                        <input
                                            type="number"
                                            id="commercialUnits"
                                            name="commercial_units"
                                            placeholder="مثلاً ۱"
                                            min="0"
                                            inputmode="numeric"
                                            class="w-full h-12 pr-12 pl-4 rounded-2xl border border-slate-200 bg-slate-50 text-sm text-slate-900 placeholder:text-slate-400 outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/8"
                                        >
                                    </div>
                                </div>

                                <!-- Elevator Lanes -->
                                <div>
                                    <label for="elevatorLanes" class="block text-sm font-medium text-slate-700 mb-2">
                                        تعداد لاین آسانسور
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
                                                <rect x="5" y="3" width="14" height="18" rx="2" />
                                                <path d="M9 7l3-3l3 3" />
                                                <path d="M9 17l3 3l3-3" />
                                                <path d="M12 4v16" />
                                            </svg>
                                        </div>

                                        <input
                                            type="number"
                                            id="elevatorLanes"
                                            name="elevator_lanes"
                                            placeholder="مثلاً ۲"
                                            min="0"
                                            inputmode="numeric"
                                            class="w-full h-12 pr-12 pl-4 rounded-2xl border border-slate-200 bg-slate-50 text-sm text-slate-900 placeholder:text-slate-400 outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/8"
                                        >
                                    </div>
                                </div>

                                <!-- Parking Spaces -->
                                <div>
                                    <label for="parkingSpaces" class="block text-sm font-medium text-slate-700 mb-2">
                                        تعداد جای پارکینگ
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
                                                <path d="M5 11l1 -5h12l1 5" />
                                                <path d="M5 11v7h14v-7" />
                                                <path d="M8 18v2" />
                                                <path d="M16 18v2" />
                                                <path d="M7 14h.01" />
                                                <path d="M17 14h.01" />
                                                <path d="M9 11v-3h6v3" />
                                            </svg>
                                        </div>

                                        <input
                                            type="number"
                                            id="parkingSpaces"
                                            name="parking_spaces"
                                            placeholder="مثلاً ۲۴"
                                            min="0"
                                            inputmode="numeric"
                                            class="w-full h-12 pr-12 pl-4 rounded-2xl border border-slate-200 bg-slate-50 text-sm text-slate-900 placeholder:text-slate-400 outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/8"
                                        >
                                    </div>
                                </div>

                                <!-- Storage Rooms -->
                                <div>
                                    <label for="storageRooms" class="block text-sm font-medium text-slate-700 mb-2">
                                        تعداد انباری
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
                                                <path d="M3 21h18" />
                                                <path d="M5 21v-12l7-5l7 5v12" />
                                                <path d="M9 21v-5h6v5" />
                                                <path d="M9 10h6" />
                                                <path d="M12 7v6" />
                                            </svg>
                                        </div>

                                        <input
                                            type="number"
                                            id="storageRooms"
                                            name="storage_rooms"
                                            placeholder="مثلاً ۲۴"
                                            min="0"
                                            inputmode="numeric"
                                            class="w-full h-12 pr-12 pl-4 rounded-2xl border border-slate-200 bg-slate-50 text-sm text-slate-900 placeholder:text-slate-400 outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/8"
                                        >
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </section>

                <!-- امکانات ساختمان -->
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
                                        امکانات ساختمان
                                    </h2>

                                    <p class="mt-1 text-sm text-slate-500 leading-7">
                                        امکانات و خدمات موجود در ساختمان را انتخاب کنید.
                                    </p>
                                </div>

                            </div>
                        </div>

                        <!-- Facilities -->
                        <div class="p-6 sm:p-8">

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                                <!-- Community Hall -->
                                <label class="facility-option group cursor-pointer">
                                    <input type="checkbox"
                                           name="facilities[]"
                                           value="community_hall"
                                           class="peer sr-only">

                                    <div class="flex items-center gap-4 p-4 rounded-2xl border border-slate-200 bg-slate-50 transition-all duration-200
                                                group-hover:border-[#003260]/30 group-hover:bg-[#003260]/[0.02]
                                                peer-checked:border-[#003260] peer-checked:bg-[#003260]/[0.04]">

                                        <div class="w-11 h-11 rounded-xl bg-white border border-slate-200 text-slate-500 flex items-center justify-center shrink-0
                                                    transition-colors peer-checked:text-[#003260] peer-checked:border-[#003260]/20">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 width="21"
                                                 height="21"
                                                 viewBox="0 0 24 24"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 stroke-width="1.8"
                                                 stroke-linecap="round"
                                                 stroke-linejoin="round">
                                                <path d="M4 19h16" />
                                                <path d="M6 19v-8h12v8" />
                                                <path d="M4 11l8-6l8 6" />
                                                <path d="M9 15h6" />
                                            </svg>
                                        </div>

                                        <span class="flex-1 text-sm font-medium text-slate-700">
                                            سالن اجتماعات
                                        </span>

                                        <!-- <div class="w-5 h-5 rounded-md border border-slate-300 bg-white flex items-center justify-center
                                                    peer-checked:bg-[#003260] peer-checked:border-[#003260]">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 width="14"
                                                 height="14"
                                                 viewBox="0 0 24 24"
                                                 fill="none"
                                                 stroke="white"
                                                 stroke-width="2"
                                                 stroke-linecap="round"
                                                 stroke-linejoin="round"
                                                 class="hidden peer-checked:block">
                                                <path d="M5 12l4 4l10-10" />
                                            </svg>
                                        </div> -->

                                    </div>
                                </label>

                                <!-- Pool -->
                                <label class="facility-option group cursor-pointer">
                                    <input type="checkbox" name="facilities[]" value="pool" class="peer sr-only">

                                    <div class="flex items-center gap-4 p-4 rounded-2xl border border-slate-200 bg-slate-50 transition-all duration-200 group-hover:border-[#003260]/30 group-hover:bg-[#003260]/[0.02] peer-checked:border-[#003260] peer-checked:bg-[#003260]/[0.04]">
                                        <div class="w-11 h-11 rounded-xl bg-white border border-slate-200 text-slate-500 flex items-center justify-center shrink-0 peer-checked:text-[#003260]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M3 18c1.5 0 1.5 1 3 1s1.5-1 3-1s1.5 1 3 1s1.5-1 3-1s1.5 1 3 1s1.5-1 3-1" />
                                                <path d="M5 14c1.5 0 1.5 1 3 1s1.5-1 3-1s1.5 1 3 1s1.5-1 3-1s1.5 1 3 1" />
                                                <path d="M8 10c0-2 1.5-3 3-3c1.2 0 2.2 .7 2.7 1.7" />
                                            </svg>
                                        </div>
                                        <span class="flex-1 text-sm font-medium text-slate-700">استخر</span>
                                        <!-- <div class="w-5 h-5 rounded-md border border-slate-300 bg-white flex items-center justify-center peer-checked:bg-[#003260] peer-checked:border-[#003260]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden peer-checked:block"><path d="M5 12l4 4l10-10" /></svg>
                                        </div> -->
                                    </div>
                                </label>

                                <!-- Sauna -->
                                <label class="facility-option group cursor-pointer">
                                    <input type="checkbox" name="facilities[]" value="sauna" class="peer sr-only">

                                    <div class="flex items-center gap-4 p-4 rounded-2xl border border-slate-200 bg-slate-50 transition-all duration-200 group-hover:border-[#003260]/30 group-hover:bg-[#003260]/[0.02] peer-checked:border-[#003260] peer-checked:bg-[#003260]/[0.04]">
                                        <div class="w-11 h-11 rounded-xl bg-white border border-slate-200 text-slate-500 flex items-center justify-center shrink-0 peer-checked:text-[#003260]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M7 20v-3" />
                                                <path d="M12 20v-3" />
                                                <path d="M17 20v-3" />
                                                <path d="M6 14c0-2 1-3 1-5" />
                                                <path d="M12 14c0-2 1-3 1-5" />
                                                <path d="M18 14c0-2 1-3 1-5" />
                                                <path d="M4 20h16" />
                                            </svg>
                                        </div>
                                        <span class="flex-1 text-sm font-medium text-slate-700">سونا</span>
                                        <!-- <div class="w-5 h-5 rounded-md border border-slate-300 bg-white flex items-center justify-center peer-checked:bg-[#003260] peer-checked:border-[#003260]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden peer-checked:block"><path d="M5 12l4 4l10-10" /></svg>
                                        </div> -->
                                    </div>
                                </label>

                                <!-- Jacuzzi -->
                                <label class="facility-option group cursor-pointer">
                                    <input type="checkbox" name="facilities[]" value="jacuzzi" class="peer sr-only">

                                    <div class="flex items-center gap-4 p-4 rounded-2xl border border-slate-200 bg-slate-50 transition-all duration-200 group-hover:border-[#003260]/30 group-hover:bg-[#003260]/[0.02] peer-checked:border-[#003260] peer-checked:bg-[#003260]/[0.04]">
                                        <div class="w-11 h-11 rounded-xl bg-white border border-slate-200 text-slate-500 flex items-center justify-center shrink-0 peer-checked:text-[#003260]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M3 17c1.5 0 1.5-1 3-1s1.5 1 3 1s1.5-1 3-1s1.5 1 3 1s1.5-1 3-1s1.5 1 3 1" />
                                                <path d="M6 13c0-2 1-3 3-3s3 1 3 3" />
                                                <path d="M15 10c0-1.1 .9-2 2-2s2 .9 2 2" />
                                                <path d="M4 21h16" />
                                            </svg>
                                        </div>
                                        <span class="flex-1 text-sm font-medium text-slate-700">جکوزی</span>
                                        <!-- <div class="w-5 h-5 rounded-md border border-slate-300 bg-white flex items-center justify-center peer-checked:bg-[#003260] peer-checked:border-[#003260]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden peer-checked:block"><path d="M5 12l4 4l10-10" /></svg>
                                        </div> -->
                                    </div>
                                </label>

                                <!-- Rooftop Garden -->
                                <label class="facility-option group cursor-pointer">
                                    <input type="checkbox" name="facilities[]" value="rooftop_garden" class="peer sr-only">

                                    <div class="flex items-center gap-4 p-4 rounded-2xl border border-slate-200 bg-slate-50 transition-all duration-200 group-hover:border-[#003260]/30 group-hover:bg-[#003260]/[0.02] peer-checked:border-[#003260] peer-checked:bg-[#003260]/[0.04]">
                                        <div class="w-11 h-11 rounded-xl bg-white border border-slate-200 text-slate-500 flex items-center justify-center shrink-0 peer-checked:text-[#003260]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M12 21v-10" />
                                                <path d="M7 21h10" />
                                                <path d="M12 11c-3 0-5-2-5-5c3 0 5 2 5 5" />
                                                <path d="M12 9c0-3 2-5 5-5c0 3-2 5-5 5" />
                                            </svg>
                                        </div>
                                        <span class="flex-1 text-sm font-medium text-slate-700">روف‌گاردن</span>
                                        <!-- <div class="w-5 h-5 rounded-md border border-slate-300 bg-white flex items-center justify-center peer-checked:bg-[#003260] peer-checked:border-[#003260]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden peer-checked:block"><path d="M5 12l4 4l10-10" /></svg>
                                        </div> -->
                                    </div>
                                </label>

                                <!-- Security -->
                                <label class="facility-option group cursor-pointer">
                                    <input type="checkbox" name="facilities[]" value="security" class="peer sr-only">

                                    <div class="flex items-center gap-4 p-4 rounded-2xl border border-slate-200 bg-slate-50 transition-all duration-200 group-hover:border-[#003260]/30 group-hover:bg-[#003260]/[0.02] peer-checked:border-[#003260] peer-checked:bg-[#003260]/[0.04]">
                                        <div class="w-11 h-11 rounded-xl bg-white border border-slate-200 text-slate-500 flex items-center justify-center shrink-0 peer-checked:text-[#003260]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M12 3l8 4v5c0 5-3.5 8-8 9c-4.5-1-8-4-8-9v-5l8-4" />
                                                <path d="M9 12l2 2l4-4" />
                                            </svg>
                                        </div>
                                        <span class="flex-1 text-sm font-medium text-slate-700">نگهبانی</span>
                                        <!-- <div class="w-5 h-5 rounded-md border border-slate-300 bg-white flex items-center justify-center peer-checked:bg-[#003260] peer-checked:border-[#003260]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden peer-checked:block"><path d="M5 12l4 4l10-10" /></svg>
                                        </div> -->
                                    </div>
                                </label>

                                <!-- Caretaker -->
                                <label class="facility-option group cursor-pointer">
                                    <input type="checkbox" name="facilities[]" value="caretaker" class="peer sr-only">

                                    <div class="flex items-center gap-4 p-4 rounded-2xl border border-slate-200 bg-slate-50 transition-all duration-200 group-hover:border-[#003260]/30 group-hover:bg-[#003260]/[0.02] peer-checked:border-[#003260] peer-checked:bg-[#003260]/[0.04]">
                                        <div class="w-11 h-11 rounded-xl bg-white border border-slate-200 text-slate-500 flex items-center justify-center shrink-0 peer-checked:text-[#003260]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M4 21h16" />
                                                <path d="M6 21v-8a6 6 0 0 1 12 0v8" />
                                                <path d="M9 9a3 3 0 0 1 6 0" />
                                                <path d="M10 17h4" />
                                            </svg>
                                        </div>
                                        <span class="flex-1 text-sm font-medium text-slate-700">سرایداری</span>
                                        <!-- <div class="w-5 h-5 rounded-md border border-slate-300 bg-white flex items-center justify-center peer-checked:bg-[#003260] peer-checked:border-[#003260]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden peer-checked:block"><path d="M5 12l4 4l10-10" /></svg>
                                        </div> -->
                                    </div>
                                </label>

                                <!-- Garbage Chute -->
                                <label class="facility-option group cursor-pointer">
                                    <input type="checkbox" name="facilities[]" value="garbage_chute" class="peer sr-only">

                                    <div class="flex items-center gap-4 p-4 rounded-2xl border border-slate-200 bg-slate-50 transition-all duration-200 group-hover:border-[#003260]/30 group-hover:bg-[#003260]/[0.02] peer-checked:border-[#003260] peer-checked:bg-[#003260]/[0.04]">
                                        <div class="w-11 h-11 rounded-xl bg-white border border-slate-200 text-slate-500 flex items-center justify-center shrink-0 peer-checked:text-[#003260]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M7 4h10" />
                                                <path d="M6 8h12" />
                                                <path d="M8 8v12h8v-12" />
                                                <path d="M10 12v4" />
                                                <path d="M14 12v4" />
                                            </svg>
                                        </div>
                                        <span class="flex-1 text-sm font-medium text-slate-700">شوتینگ</span>
                                        <!-- <div class="w-5 h-5 rounded-md border border-slate-300 bg-white flex items-center justify-center peer-checked:bg-[#003260] peer-checked:border-[#003260]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden peer-checked:block"><path d="M5 12l4 4l10-10" /></svg>
                                        </div> -->
                                    </div>
                                </label>

                                <!-- Playground -->
                                <label class="facility-option group cursor-pointer">
                                    <input type="checkbox" name="facilities[]" value="playground" class="peer sr-only">

                                    <div class="flex items-center gap-4 p-4 rounded-2xl border border-slate-200 bg-slate-50 transition-all duration-200 group-hover:border-[#003260]/30 group-hover:bg-[#003260]/[0.02] peer-checked:border-[#003260] peer-checked:bg-[#003260]/[0.04]">
                                        <div class="w-11 h-11 rounded-xl bg-white border border-slate-200 text-slate-500 flex items-center justify-center shrink-0 peer-checked:text-[#003260]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M5 21v-7" />
                                                <path d="M5 14l6-5l6 5" />
                                                <path d="M11 9v12" />
                                                <path d="M17 21v-7" />
                                                <circle cx="12" cy="5" r="2" />
                                            </svg>
                                        </div>
                                        <span class="flex-1 text-sm font-medium text-slate-700">زمین بازی کودکان</span>
                                        <!-- <div class="w-5 h-5 rounded-md border border-slate-300 bg-white flex items-center justify-center peer-checked:bg-[#003260] peer-checked:border-[#003260]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden peer-checked:block"><path d="M5 12l4 4l10-10" /></svg>
                                        </div> -->
                                    </div>
                                </label>

                                <!-- Green Space -->
                                <label class="facility-option group cursor-pointer">
                                    <input type="checkbox" name="facilities[]" value="green_space" class="peer sr-only">

                                    <div class="flex items-center gap-4 p-4 rounded-2xl border border-slate-200 bg-slate-50 transition-all duration-200 group-hover:border-[#003260]/30 group-hover:bg-[#003260]/[0.02] peer-checked:border-[#003260] peer-checked:bg-[#003260]/[0.04]">
                                        <div class="w-11 h-11 rounded-xl bg-white border border-slate-200 text-slate-500 flex items-center justify-center shrink-0 peer-checked:text-[#003260]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M12 21v-7" />
                                                <path d="M8 21h8" />
                                                <path d="M12 14c-3 0-5-2-5-5c3 0 5 2 5 5" />
                                                <path d="M12 12c0-3 2-5 5-5c0 3-2 5-5 5" />
                                            </svg>
                                        </div>
                                        <span class="flex-1 text-sm font-medium text-slate-700">فضای سبز</span>
                                        <!-- <div class="w-5 h-5 rounded-md border border-slate-300 bg-white flex items-center justify-center peer-checked:bg-[#003260] peer-checked:border-[#003260]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden peer-checked:block"><path d="M5 12l4 4l10-10" /></svg>
                                        </div> -->
                                    </div>
                                </label>

                                <!-- Fire Alarm -->
                                <label class="facility-option group cursor-pointer">
                                    <input type="checkbox" name="facilities[]" value="fire_alarm" class="peer sr-only">

                                    <div class="flex items-center gap-4 p-4 rounded-2xl border border-slate-200 bg-slate-50 transition-all duration-200 group-hover:border-[#003260]/30 group-hover:bg-[#003260]/[0.02] peer-checked:border-[#003260] peer-checked:bg-[#003260]/[0.04]">
                                        <div class="w-11 h-11 rounded-xl bg-white border border-slate-200 text-slate-500 flex items-center justify-center shrink-0 peer-checked:text-[#003260]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M12 3c3 3 5 5.5 5 9a5 5 0 0 1-10 0c0-3.5 2-6 5-9z" />
                                                <path d="M12 12c1 1 1.5 2 1.5 3" />
                                            </svg>
                                        </div>
                                        <span class="flex-1 text-sm font-medium text-slate-700">سیستم اعلام حریق</span>
                                        <!-- <div class="w-5 h-5 rounded-md border border-slate-300 bg-white flex items-center justify-center peer-checked:bg-[#003260] peer-checked:border-[#003260]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden peer-checked:block"><path d="M5 12l4 4l10-10" /></svg>
                                        </div> -->
                                    </div>
                                </label>

                                <!-- Fire Suppression -->
                                <label class="facility-option group cursor-pointer">
                                    <input type="checkbox" name="facilities[]" value="fire_suppression" class="peer sr-only">

                                    <div class="flex items-center gap-4 p-4 rounded-2xl border border-slate-200 bg-slate-50 transition-all duration-200 group-hover:border-[#003260]/30 group-hover:bg-[#003260]/[0.02] peer-checked:border-[#003260] peer-checked:bg-[#003260]/[0.04]">
                                        <div class="w-11 h-11 rounded-xl bg-white border border-slate-200 text-slate-500 flex items-center justify-center shrink-0 peer-checked:text-[#003260]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M12 3a7 7 0 0 0-7 7v4a7 7 0 0 0 14 0v-4a7 7 0 0 0-7-7z" />
                                                <path d="M12 7v5" />
                                                <path d="M9 12h6" />
                                            </svg>
                                        </div>
                                        <span class="flex-1 text-sm font-medium text-slate-700">سیستم اطفای حریق</span>
                                        <!-- <div class="w-5 h-5 rounded-md border border-slate-300 bg-white flex items-center justify-center peer-checked:bg-[#003260] peer-checked:border-[#003260]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden peer-checked:block"><path d="M5 12l4 4l10-10" /></svg>
                                        </div> -->
                                    </div>
                                </label>

                                <!-- Public Restroom -->
                                <label class="facility-option group cursor-pointer">
                                    <input type="checkbox" name="facilities[]" value="public_restroom" class="peer sr-only">

                                    <div class="flex items-center gap-4 p-4 rounded-2xl border border-slate-200 bg-slate-50 transition-all duration-200 group-hover:border-[#003260]/30 group-hover:bg-[#003260]/[0.02] peer-checked:border-[#003260] peer-checked:bg-[#003260]/[0.04]">
                                        <div class="w-11 h-11 rounded-xl bg-white border border-slate-200 text-slate-500 flex items-center justify-center shrink-0 peer-checked:text-[#003260]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M8 5a2 2 0 1 0 4 0a2 2 0 0 0-4 0" />
                                                <path d="M10 7v6" />
                                                <path d="M7 10h6" />
                                                <path d="M16 4v8" />
                                                <path d="M14 12h4" />
                                                <path d="M16 12v8" />
                                            </svg>
                                        </div>
                                        <span class="flex-1 text-sm font-medium text-slate-700">سرویس بهداشتی عمومی</span>
                                        <!-- <div class="w-5 h-5 rounded-md border border-slate-300 bg-white flex items-center justify-center peer-checked:bg-[#003260] peer-checked:border-[#003260]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden peer-checked:block"><path d="M5 12l4 4l10-10" /></svg>
                                        </div> -->
                                    </div>
                                </label>

                            </div>

                            <!-- Helper -->
                            <div class="mt-5 flex items-start gap-3 rounded-2xl bg-slate-50 border border-slate-100 px-4 py-3.5">
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
                                    هر موردی که ساختمان شما دارای آن است انتخاب کنید. این اطلاعات بعداً
                                    در پروفایل و مدیریت ساختمان قابل مشاهده و ویرایش خواهد بود.
                                </p>
                            </div>

                        </div>

                    </div>
                </section>

                <!-- توضیحات و موارد اضافه -->
                <section class="mt-6">
                    <div class="bg-white rounded-[28px] border border-slate-200 shadow-sm p-6 sm:p-8">

                        <div class="mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-11 h-11 rounded-2xl bg-[#003260]/5 text-[#003260] flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="22"
                                         height="22"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                        <path d="M14 2v6h6"/>
                                        <path d="M8 13h8"/>
                                        <path d="M8 17h6"/>
                                    </svg>
                                </div>

                                <div>
                                    <h2 class="text-lg sm:text-xl font-bold text-slate-900">
                                        توضیحات و موارد اضافه
                                    </h2>

                                    <p class="mt-1 text-sm text-slate-500">
                                        در صورت نیاز، توضیحات یا اطلاعات تکمیلی درباره ساختمان را وارد کنید.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="buildingDescription"
                                   class="block text-sm font-medium text-slate-700 mb-2">
                                توضیحات
                            </label>

                            <textarea
                                id="buildingDescription"
                                name="description"
                                rows="7"
                                placeholder="مثلاً توضیحات مربوط به ساختمان، قوانین خاص، امکانات ویژه یا هر مورد دیگری که لازم است ثبت شود..."
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-sm text-slate-800 placeholder:text-slate-400 outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/5 resize-none"
                            ></textarea>

                            <p class="mt-2 text-xs text-slate-400">
                                این بخش اختیاری است و می‌توانید اطلاعات تکمیلی موردنظر خود را در آن ثبت کنید.
                            </p>
                        </div>

                    </div>
                </section>

                <!-- ثبت نهایی -->
                <section class="mt-6">
                    <div class="bg-white rounded-[28px] border border-slate-200 shadow-sm p-6 sm:p-8">

                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">

                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 shrink-0 rounded-2xl bg-[#003260]/5 text-[#003260] flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="22"
                                         height="22"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <path d="M20 6 9 17l-5-5"/>
                                    </svg>
                                </div>

                                <div>
                                    <h2 class="text-lg sm:text-xl font-bold text-slate-900">
                                        ثبت نهایی ساختمان
                                    </h2>

                                    <p class="mt-1 text-sm leading-6 text-slate-500">
                                        اطلاعات واردشده را بررسی کنید و برای ایجاد ساختمان روی دکمه ثبت نهایی کلیک کنید.
                                    </p>
                                </div>
                            </div>

                            <button
                                type="submit"
                                class="w-full sm:w-auto shrink-0 inline-flex items-center justify-center gap-2.5 px-7 py-3.5 rounded-2xl bg-[#003260] text-white text-sm font-semibold shadow-lg shadow-[#003260]/15 hover:bg-[#004477] transition modir-bold cursor-pointer"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="20"
                                     height="20"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.8"
                                     stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path d="M20 6 9 17l-5-5"/>
                                </svg>

                                ذخیره و ثبت ساختمان
                            </button>

                        </div>

                    </div>
                </section>
            </form>
        </main>

    </div>

@endsection