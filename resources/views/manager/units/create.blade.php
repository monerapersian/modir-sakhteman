@extends('layouts.manager')

@section('title', 'مدیر خوب - ثبت واحد')

@section('content')

        <main class="flex-1 px-5 lg:px-8 pt-6 pb-28 lg:pb-8">

            <!-- Hero | Add Unit -->
            <section class="relative overflow-hidden rounded-[28px] bg-[#003260] text-white shadow-xl shadow-[#003260]/10">

                <!-- Decorative Elements -->
                <div class="absolute -top-20 -left-20 w-56 h-56 rounded-full bg-white/5"></div>
                <div class="absolute -bottom-24 right-1/4 w-72 h-72 rounded-full bg-white/5"></div>

                <div class="relative z-10 p-6 sm:p-8 lg:p-10">

                    <!-- Hero Content -->
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">

                        <div class="max-w-2xl">

                            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 border border-white/10 text-xs text-white/75">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="20"
                                     height="20"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.8"
                                     stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="w-4 h-4">
                                    <path d="M4 21h16" />
                                    <path d="M6 21v-14l6-4l6 4v14" />
                                    <path d="M9 21v-5h6v5" />
                                    <path d="M9 10h.01" />
                                    <path d="M15 10h.01" />
                                </svg>

                                <span>
                                    مدیریت واحدها
                                </span>

                            </div>


                            <h1 class="mt-4 text-2xl sm:text-3xl lg:text-4xl modir-bold leading-tight">
                                ثبت واحد جدید
                            </h1>


                            <p class="mt-4 text-sm sm:text-base text-white/65 leading-7 max-w-xl">
                                اطلاعات اصلی واحد را ثبت کنید تا بتوانید وضعیت، ساکنین و امور مالی آن را در ادامه مدیریت کنید.
                            </p>

                        </div>


                        <!-- Back Button -->
                        <a
                            href="{{ route('manager.units') }}"
                            class="inline-flex items-center justify-center gap-2 h-11 px-5 rounded-xl bg-white/10 border border-white/10 text-white text-sm modir-bold hover:bg-white/15 transition shrink-0"
                        >

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 width="20"
                                 height="20"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 stroke-linecap="round"
                                 stroke-linejoin="round"
                                 class="w-4 h-4">
                                <path d="M5 12h14" />
                                <path d="M5 12l6 -6" />
                                <path d="M5 12l6 6" />
                            </svg>

                            <span>
                                بازگشت به واحدها
                            </span>

                        </a>

                    </div>

                </div>

            </section>

            <form method="POST" action="{{ route('manager.units.store') }}">
                @csrf
                <!-- Add Unit | Form -->
                <section class="mt-6">

                    <div class="bg-white rounded-[28px] border border-[#e5e2dd] shadow-sm overflow-hidden">

                        <!-- Section Header -->
                        <div class="px-6 sm:px-8 py-6 border-b border-[#e5e2dd]">

                            <div class="flex items-start gap-4">

                                <div class="w-11 h-11 rounded-2xl bg-[#003260]/5 text-[#003260] flex items-center justify-center shrink-0">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="24"
                                         height="24"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         stroke-linecap="round"
                                         stroke-linejoin="round"
                                         class="w-5 h-5">
                                        <path d="M4 21h16" />
                                        <path d="M6 21v-14l6-4l6 4v14" />
                                        <path d="M9 21v-5h6v5" />
                                        <path d="M9 10h.01" />
                                        <path d="M15 10h.01" />
                                    </svg>

                                </div>

                                <div>

                                    <h2 class="text-lg sm:text-xl modir-bold text-[#003260]">
                                        اطلاعات واحد
                                    </h2>

                                    <p class="mt-1.5 text-sm text-slate-500 leading-6">
                                        اطلاعات اصلی این واحد را وارد کنید.
                                    </p>

                                </div>

                            </div>

                        </div>


                        <!-- Form Body -->
                        <div class="p-6 sm:p-8">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                                <!-- نام واحد -->
                                <div>

                                    <label for="unit_name" class="block text-sm modir-bold text-slate-700 mb-2">
                                        نام واحد
                                        <span class="text-red-500">*</span>
                                    </label>

                                    <input
                                        type="text"
                                        id="unit_name"
                                        name="unit_name"
                                        maxlength="24"
                                        placeholder="مثلاً ۱۰۱ یا 11A"
                                        value="{{ old('unit_name') }}"
                                        class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white text-slate-700 text-sm outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/5"
                                    >

                                    <p class="mt-1.5 text-xs text-slate-400">
                                        حداکثر ۲۴ کاراکتر
                                    </p>

                                    @error('unit_name')
                                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                    @enderror

                                </div>


                                <!-- طبقه -->
                                <div>

                                    <label for="floor" class="block text-sm modir-bold text-slate-700 mb-2">
                                        طبقه
                                        <span class="text-red-500">*</span>
                                    </label>

                                    <input
                                        type="text"
                                        id="floor"
                                        name="floor"
                                        maxlength="2"
                                        inputmode="numeric"
                                        pattern="[0-9۰-۹]{1,2}"
                                        placeholder="مثلاً ۱"
                                        value="{{ old('floor') }}"
                                        class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white text-slate-700 text-sm outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/5"
                                    >

                                    <p class="mt-1.5 text-xs text-slate-400">
                                        طبقه همکف را با عدد ۰ وارد کنید.
                                    </p>

                                    @error('floor')
                                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                    @enderror

                                </div>


                                <!-- نوع واحد -->
                                <div>

                                    <label for="unit_type" class="block text-sm modir-bold text-slate-700 mb-2">
                                        نوع واحد
                                        <span class="text-red-500">*</span>
                                    </label>

                                    <div class="relative">

                                        <select
                                            id="unit_type"
                                            name="unit_type"
                                            class="appearance-none w-full h-12 px-4 pl-11 rounded-xl border border-slate-200 bg-white text-slate-700 text-sm outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/5"
                                        >
                                            <option value="">انتخاب نوع واحد</option>

                                            <option value="residential" @selected(old('unit_type') === 'residential')>
                                                مسکونی
                                            </option>

                                            <option value="administrative" @selected(old('unit_type') === 'administrative')>
                                                اداری
                                            </option>

                                            <option value="commercial" @selected(old('unit_type') === 'commercial')>
                                                تجاری
                                            </option>
                                        </select>

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="20"
                                             height="20"
                                             viewBox="0 0 24 24"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8"
                                             stroke-linecap="round"
                                             stroke-linejoin="round"
                                             class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none">
                                            <path d="m6 9 6 6 6-6" />
                                        </svg>

                                    </div>

                                    @error('unit_type')
                                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                    @enderror

                                </div>


                                <!-- متراژ -->
                                <div>

                                    <label for="area" class="block text-sm modir-bold text-slate-700 mb-2">
                                        متراژ
                                        <span class="text-red-500">*</span>
                                    </label>

                                    <div class="relative">

                                        <input
                                            type="text"
                                            id="area"
                                            name="area"
                                            maxlength="3"
                                            inputmode="numeric"
                                            pattern="[0-9۰-۹]{1,3}"
                                            placeholder="مثلاً ۱۲۰"
                                            value="{{ old('area') }}"
                                            class="w-full h-12 px-4 pl-14 rounded-xl border border-slate-200 bg-white text-slate-700 text-sm outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/5"
                                        >

                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-xs text-slate-400">
                                            متر
                                        </span>

                                    </div>

                                    <p class="mt-1.5 text-xs text-slate-400">
                                        حداکثر ۳ رقم
                                    </p>

                                    @error('area')
                                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                    @enderror

                                </div>


                                <!-- پارکینگ -->
                                <div>

                                    <label for="parking" class="block text-sm modir-bold text-slate-700 mb-2">
                                        پارکینگ
                                    </label>

                                    <input
                                        type="text"
                                        id="parking"
                                        name="parking"
                                        maxlength="5"
                                        placeholder="مثلاً P1"
                                        value="{{ old('parking') }}"
                                        class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white text-slate-700 text-sm outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/5"
                                    >

                                    <p class="mt-1.5 text-xs text-slate-400">
                                        شماره یا شناسه پارکینگ، حداکثر ۵ کاراکتر
                                    </p>

                                    @error('parking')
                                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                    @enderror

                                </div>


                                <!-- انباری -->
                                <div>

                                    <label for="storage" class="block text-sm modir-bold text-slate-700 mb-2">
                                        انباری
                                    </label>

                                    <div class="relative">

                                        <select
                                            id="storage"
                                            name="storage"
                                            class="appearance-none w-full h-12 px-4 pl-11 rounded-xl border border-slate-200 bg-white text-slate-700 text-sm outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/5"
                                        >

                                            <option value="0" @selected(old('storage', '0') === '0')>
                                                ندارد
                                            </option>

                                            <option value="1" @selected(old('storage') === '1')>
                                                دارد
                                            </option>

                                        </select>

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="20"
                                             height="20"
                                             viewBox="0 0 24 24"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8"
                                             stroke-linecap="round"
                                             stroke-linejoin="round"
                                             class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none">
                                            <path d="m6 9 6 6 6-6" />
                                        </svg>

                                    </div>

                                    @error('storage')
                                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                    @enderror

                                </div>


                                <!-- وضعیت سکونت -->
                                <div>

                                    <label for="occupancy_status" class="block text-sm modir-bold text-slate-700 mb-2">
                                        وضعیت سکونت
                                        <span class="text-red-500">*</span>
                                    </label>

                                    <div class="relative">

                                        <select
                                            id="occupancy_status"
                                            name="occupancy_status"
                                            class="appearance-none w-full h-12 px-4 pl-11 rounded-xl border border-slate-200 bg-white text-slate-700 text-sm outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/5"
                                        >

                                            <option value="occupied" @selected(old('occupancy_status', 'occupied') === 'occupied')>
                                                دارای ساکن
                                            </option>

                                            <option value="vacant" @selected(old('occupancy_status') === 'vacant')>
                                                بدون ساکن
                                            </option>

                                        </select>

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="20"
                                             height="20"
                                             viewBox="0 0 24 24"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8"
                                             stroke-linecap="round"
                                             stroke-linejoin="round"
                                             class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none">
                                            <path d="m6 9 6 6 6-6" />
                                        </svg>

                                    </div>

                                    <p class="mt-1.5 text-xs text-slate-400">
                                        در صورت خالی بودن واحد، اطلاعات ساکن فعلی غیرفعال می‌شود.
                                    </p>

                                    @error('occupancy_status')
                                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                    @enderror

                                </div>


                                <!-- توضیحات -->
                                <div class="md:col-span-2">

                                    <label for="description" class="block text-sm modir-bold text-slate-700 mb-2">
                                        توضیحات
                                    </label>

                                    <textarea
                                        id="description"
                                        name="description"
                                        rows="4"
                                        placeholder="اگر توضیحی درباره این واحد وجود دارد، اینجا وارد کنید..."
                                        class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-white text-slate-700 text-sm leading-7 outline-none resize-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/5"
                                    >{{ old('description') }}</textarea>

                                    <p class="mt-1.5 text-xs text-slate-400">
                                        توضیحات اختیاری است.
                                    </p>

                                    @error('description')
                                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                    @enderror

                                </div>


                            </div>

                        </div>

                    </div>

                </section>


                <!-- Current Resident -->
                <section class="mt-6">

                    <div class="bg-white rounded-[28px] border border-[#e5e2dd] shadow-sm overflow-hidden">

                        <!-- Section Header -->
                        <div class="px-6 sm:px-8 py-6 border-b border-[#e5e2dd]">

                            <div class="flex flex-col sm:flex-row sm:items-center gap-4">

                                <div class="flex items-center gap-4">

                                    <div class="w-11 h-11 rounded-2xl bg-[#003260]/5 text-[#003260] flex items-center justify-center shrink-0">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="24"
                                             height="24"
                                             viewBox="0 0 24 24"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8"
                                             stroke-linecap="round"
                                             stroke-linejoin="round"
                                             class="w-5 h-5">
                                            <circle cx="12" cy="8" r="3" />
                                            <path d="M5 21a7 7 0 0 1 14 0" />
                                        </svg>

                                    </div>

                                    <div>

                                        <h2 class="text-lg sm:text-xl modir-bold text-[#003260]">
                                            ساکن فعلی
                                        </h2>

                                        <p class="mt-1.5 text-sm text-slate-500 leading-6">
                                            اطلاعات فرد یا افرادی که در حال حاضر در این واحد سکونت دارند.
                                        </p>

                                    </div>

                                </div>


                                <!-- Vacant Notice -->
                                <div
                                    id="residentDisabledNotice"
                                    class="hidden sm:mr-auto items-center gap-2 px-3.5 py-2 rounded-xl bg-orange-50 border border-orange-100 text-orange-700 text-xs leading-5"
                                >

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="20"
                                         height="20"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         stroke-linecap="round"
                                         stroke-linejoin="round"
                                         class="w-4 h-4 shrink-0">
                                        <path d="M12 9v4" />
                                        <path d="M12 17h.01" />
                                        <path d="M10.3 3.7 2.9 17a2 2 0 0 0 1.75 3h14.7a2 2 0 0 0 1.75 0L13.7 3.7a2 2 0 0 0-3.4 0Z" />
                                    </svg>

                                    <span>
                                        وضعیت واحد «خالی» است؛ امکان ثبت اطلاعات ساکن وجود ندارد.
                                    </span>

                                </div>

                            </div>

                        </div>


                        <!-- Form Body -->
                        <div
                            id="residentSection"
                            class="p-6 sm:p-8"
                        >

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                <!-- نام و نام خانوادگی -->
                                <div>
                                    <label for="resident_name" class="block text-sm modir-bold text-slate-700 mb-2">
                                        نام و نام خانوادگی
                                    </label>

                                    <input
                                        type="text"
                                        id="resident_name"
                                        name="resident_name"
                                        value="{{ old('resident_name') }}"
                                        placeholder="مثلاً علی رضایی"
                                        class="resident-field w-full h-12 px-4 rounded-xl border border-slate-200 bg-white text-slate-700 text-sm outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/5"
                                    >
                                </div>


                                <!-- شماره تماس -->
                                <div>
                                    <label for="resident_phone" class="block text-sm modir-bold text-slate-700 mb-2">
                                        شماره تماس
                                    </label>

                                    <input
                                        type="text"
                                        id="resident_phone"
                                        name="resident_phone"
                                        value="{{ old('resident_phone') }}"
                                        placeholder="مثلاً ۰۹۱۲۱۲۳۴۵۶۷"
                                        inputmode="numeric"
                                        maxlength="11"
                                        class="resident-field w-full h-12 px-4 rounded-xl border border-slate-200 bg-white text-slate-700 text-sm outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/5"
                                    >

                                    <p id="residentPhoneError" class="hidden mt-1.5 text-xs text-red-500"></p>
                                </div>


                                <!-- تعداد افراد -->
                                <div>
                                    <label for="resident_count" class="block text-sm modir-bold text-slate-700 mb-2">
                                        تعداد افراد
                                    </label>

                                    <input
                                        type="text"
                                        id="resident_count"
                                        name="resident_count"
                                        value="{{ old('resident_count') }}"
                                        placeholder="مثلاً ۳"
                                        inputmode="numeric"
                                        maxlength="2"
                                        class="resident-field w-full h-12 px-4 rounded-xl border border-slate-200 bg-white text-slate-700 text-sm outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/5"
                                    >

                                    <p id="residentCountError" class="hidden mt-1.5 text-xs text-red-500"></p>
                                </div>


                                <!-- نوع سکونت -->
                                <div>
                                    <label for="residency_type" class="block text-sm modir-bold text-slate-700 mb-2">
                                        نوع سکونت
                                    </label>

                                    <div class="relative">

                                        <select
                                            id="residency_type"
                                            name="residency_type"
                                            class="resident-field appearance-none w-full h-12 px-4 pl-11 rounded-xl border border-slate-200 bg-white text-slate-700 text-sm outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/5"
                                        >
                                            <option value="tenant" @selected(old('residency_type', 'tenant') === 'tenant')>
                                                مستاجر
                                            </option>

                                            <option value="owner" @selected(old('residency_type') === 'owner')>
                                                مالک
                                            </option>
                                        </select>

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="20"
                                             height="20"
                                             viewBox="0 0 24 24"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8"
                                             stroke-linecap="round"
                                             stroke-linejoin="round"
                                             class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none">
                                            <path d="m6 9 6 6 6-6" />
                                        </svg>

                                    </div>
                                </div>


                                <!-- شروع سکونت -->
                                <div>
                                    <label for="resident_move_in_date" class="block text-sm modir-bold text-slate-700 mb-2">
                                        شروع سکونت
                                    </label>

                                    <button
                                        type="button"
                                        id="resident_move_in_date"
                                        data-date-picker="resident"
                                        class="resident-field w-full h-12 px-4 rounded-xl border border-slate-200 bg-white text-slate-400 text-sm text-right outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/5"
                                    >
                                        انتخاب تاریخ شروع سکونت
                                    </button>

                                    <input
                                        type="hidden"
                                        id="resident_move_in_date_value"
                                        name="resident_move_in_date"
                                        value="{{ old('resident_move_in_date') }}"
                                    >
                                </div>


                                <!-- توضیحات تکمیلی ساکن -->
                                <div class="md:col-span-2">

                                    <label for="resident_description" class="block text-sm modir-bold text-slate-700 mb-2">
                                        توضیحات تکمیلی ساکن
                                    </label>

                                    <textarea
                                        id="resident_description"
                                        name="resident_description"
                                        rows="4"
                                        maxlength="460"
                                        placeholder="توضیحات تکمیلی مربوط به ساکن را وارد کنید..."
                                        class="resident-field w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-white text-slate-700 text-sm leading-7 outline-none resize-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/5"
                                    >{{ old('resident_description') }}</textarea>

                                </div>

                            </div>


                            <!-- Previous Debt -->
                            <div class="mt-8 pt-7 border-t border-slate-100">

                                <div class="mb-5">

                                    <h3 class="text-base modir-bold text-[#003260]">
                                        بدهی قبلی
                                    </h3>

                                    <p class="mt-1 text-xs text-slate-400">
                                        در صورت وجود بدهی قبلی، اطلاعات آن را وارد کنید.
                                    </p>

                                </div>


                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                    <!-- عنوان بدهی -->
                                    <div>
                                        <label for="resident_debt_title" class="block text-sm modir-bold text-slate-700 mb-2">
                                            عنوان بدهی
                                        </label>

                                        <input
                                            type="text"
                                            id="resident_debt_title"
                                            name="resident_debt_title"
                                            value="{{ old('resident_debt_title') }}"
                                            maxlength="210"
                                            placeholder="مثلاً شارژ معوقه"
                                            class="resident-field w-full h-12 px-4 rounded-xl border border-slate-200 bg-white text-slate-700 text-sm outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/5"
                                        >
                                    </div>


                                    <!-- مبلغ بدهی -->
                                    <div>
                                        <label for="resident_debt_amount" class="block text-sm modir-bold text-slate-700 mb-2">
                                            مبلغ بدهی
                                        </label>

                                        <div class="relative">

                                            <input
                                                type="text"
                                                id="resident_debt_amount"
                                                name="resident_debt_amount"
                                                value="{{ old('resident_debt_amount') }}"
                                                min="0"
                                                inputmode="numeric"
                                                placeholder="مثلاً ۲۵۰۰۰۰۰"
                                                class="resident-field w-full h-12 px-4 pl-16 rounded-xl border border-slate-200 bg-white text-slate-700 text-sm outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/5"
                                            >

                                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-xs text-slate-400">
                                                تومان
                                            </span>

                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </section>


                <!-- Current Owner -->
                <section class="mt-6">

                    <div class="bg-white rounded-[28px] border border-[#e5e2dd] shadow-sm overflow-hidden">

                        <!-- Section Header -->
                        <div class="px-6 sm:px-8 py-6 border-b border-[#e5e2dd]">

                            <div class="flex items-center gap-4">

                                <div class="w-11 h-11 rounded-2xl bg-[#003260]/5 text-[#003260] flex items-center justify-center shrink-0">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="24"
                                         height="24"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         stroke-linecap="round"
                                         stroke-linejoin="round"
                                         class="w-5 h-5">
                                        <circle cx="12" cy="8" r="3" />
                                        <path d="M5 21a7 7 0 0 1 14 0" />
                                        <path d="M18 5.5 20 7l-2 1.5" />
                                    </svg>

                                </div>

                                <div>

                                    <h2 class="text-lg sm:text-xl modir-bold text-[#003260]">
                                        مالک فعلی
                                    </h2>

                                    <p class="mt-1.5 text-sm text-slate-500 leading-6">
                                        اطلاعات مالک فعلی این واحد را وارد کنید.
                                    </p>

                                </div>

                            </div>

                        </div>


                        <!-- Form Body -->
                        <div class="p-6 sm:p-8">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                <!-- نام و نام خانوادگی -->
                                <div>
                                    <label for="owner_name" class="block text-sm modir-bold text-slate-700 mb-2">
                                        نام و نام خانوادگی
                                    </label>

                                    <input
                                        type="text"
                                        id="owner_name"
                                        name="owner_name"
                                        value="{{ old('owner_name') }}"
                                        placeholder="مثلاً محمد رضایی"
                                        class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white text-slate-700 text-sm outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/5"
                                    >
                                </div>


                                <!-- شماره تماس -->
                                <div>
                                    <label for="owner_phone" class="block text-sm modir-bold text-slate-700 mb-2">
                                        شماره تماس
                                    </label>

                                    <input
                                        type="text"
                                        id="owner_phone"
                                        name="owner_phone"
                                        value="{{ old('owner_phone') }}"
                                        placeholder="مثلاً ۰۹۱۲۱۲۳۴۵۶۷"
                                        inputmode="numeric"
                                        maxlength="11"
                                        class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white text-slate-700 text-sm outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/5"
                                    >

                                    <p id="ownerPhoneError" class="hidden mt-1.5 text-xs text-red-500"></p>
                                </div>


                                <!-- شروع مالکیت -->
                                <div class="md:col-span-2">

                                    <label for="ownership_start_date" class="block text-sm modir-bold text-slate-700 mb-2">
                                        شروع مالکیت
                                    </label>

                                    <button
                                        type="button"
                                        id="ownership_start_date"
                                        data-date-picker="owner"
                                        class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white text-slate-400 text-sm text-right outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/5"
                                    >
                                        انتخاب تاریخ شروع مالکیت
                                    </button>

                                    <input
                                        type="hidden"
                                        id="ownership_start_date_value"
                                        name="ownership_start_date"
                                        value="{{ old('ownership_start_date') }}"
                                    >

                                </div>

                            </div>


                            <!-- Owner Additional Description -->
                            <div class="mt-8 pt-7 border-t border-slate-100">

                                <label for="owner_description" class="block text-sm modir-bold text-slate-700 mb-2">
                                    توضیحات تکمیلی مالک
                                </label>

                                <textarea
                                    id="owner_description"
                                    name="owner_description"
                                    rows="4"
                                    maxlength="460"
                                    placeholder="توضیحات تکمیلی مربوط به مالک را وارد کنید..."
                                    class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-white text-slate-700 text-sm leading-7 outline-none resize-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/5"
                                >{{ old('owner_description') }}</textarea>

                            </div>


                            <!-- Previous Debt -->
                            <div class="mt-8 pt-7 border-t border-slate-100">

                                <div class="mb-5">

                                    <h3 class="text-base modir-bold text-[#003260]">
                                        بدهی قبلی
                                    </h3>

                                    <p class="mt-1 text-xs text-slate-400">
                                        در صورت وجود بدهی قبلی مالک، اطلاعات آن را وارد کنید.
                                    </p>

                                </div>


                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                    <!-- عنوان بدهی -->
                                    <div>
                                        <label for="owner_debt_title" class="block text-sm modir-bold text-slate-700 mb-2">
                                            عنوان بدهی
                                        </label>

                                        <input
                                            type="text"
                                            id="owner_debt_title"
                                            name="owner_debt_title"
                                            value="{{ old('owner_debt_title') }}"
                                            maxlength="210"
                                            placeholder="مثلاً بدهی شارژ"
                                            class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white text-slate-700 text-sm outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/5"
                                        >
                                    </div>


                                    <!-- مبلغ بدهی -->
                                    <div>
                                        <label for="owner_debt_amount" class="block text-sm modir-bold text-slate-700 mb-2">
                                            مبلغ بدهی
                                        </label>

                                        <div class="relative">

                                            <input
                                                type="text"
                                                id="owner_debt_amount"
                                                name="owner_debt_amount"
                                                value="{{ old('owner_debt_amount') }}"
                                                inputmode="numeric"
                                                placeholder="مثلاً ۲۵۰۰۰۰۰"
                                                class="w-full h-12 px-4 pl-16 rounded-xl border border-slate-200 bg-white text-slate-700 text-sm outline-none transition focus:border-[#003260] focus:ring-4 focus:ring-[#003260]/5"
                                            >

                                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-xs text-slate-400">
                                                تومان
                                            </span>

                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </section>


                <!-- Form Actions -->
                <section class="mt-6">

                    <div class="flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-between gap-3">

                        <!-- Cancel -->
                        <a
                            href="{{ route('manager.units') }}"
                            class="inline-flex items-center justify-center gap-2 h-12 px-6 rounded-xl border border-slate-200 bg-white text-slate-600 text-sm modir-bold hover:bg-slate-50 hover:border-slate-300 transition"
                        >

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 width="20"
                                 height="20"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 stroke-linecap="round"
                                 stroke-linejoin="round"
                                 class="w-4 h-4">
                                <path d="M6 6l12 12" />
                                <path d="M18 6 6 18" />
                            </svg>

                            <span>
                                انصراف
                            </span>

                        </a>


                        <!-- Submit -->
                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 h-12 px-8 rounded-xl bg-[#003260] text-white text-sm modir-bold shadow-lg shadow-[#003260]/10 hover:bg-[#003260]/90 transition cursor-pointer"
                        >

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 width="20"
                                 height="20"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 stroke-linecap="round"
                                 stroke-linejoin="round"
                                 class="w-4 h-4">
                                <path d="M12 3v12" />
                                <path d="m7 10 5 5 5-5" />
                                <path d="M5 21h14" />
                            </svg>

                            <span>
                                ثبت واحد
                            </span>

                        </button>

                    </div>

                </section>
            </form>

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
                            class="w-10 h-10 rounded-xl bg-slate-50 text-slate-500 flex items-center justify-center hover:bg-slate-100 transition"
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
                        class="w-full h-12 rounded-xl bg-[#003260] text-white text-sm modir-bold shadow-lg shadow-[#003260]/15 hover:bg-[#003260]/90 active:scale-[0.99] transition"
                    >
                        تأیید تاریخ
                    </button>

                </div>

            </div>
        </div>


        <style>

            .wheel-column {
                position: relative;
                height: 270px;
                overflow: hidden;
                touch-action: none;
                cursor: grab;
            }

            .wheel-column.dragging {
                cursor: grabbing;
            }

            .wheel-track {
                position: absolute;
                inset: 0;
                pointer-events: none;
                will-change: transform;
            }

            .wheel-item {
                position: absolute;
                left: 0;
                right: 0;

                height: 54px;

                display: flex;
                align-items: center;
                justify-content: center;

                color: #94a3b8;
                font-size: 14px;

                opacity: .45;

                transform-origin: center center;

                will-change: transform, opacity;

                user-select: none;

                transition:
                    color 80ms linear,
                    opacity 80ms linear,
                    font-size 80ms linear;
            }

            .wheel-item.near {
                color: #64748b;
                opacity: .72;
            }

            .wheel-item.active {
                color: #003260;
                opacity: 1;
                font-size: 16px;
                font-weight: 700;
            }

        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function () {

                /*
                |--------------------------------------------------------------------------
                | اطلاعات واحد
                |--------------------------------------------------------------------------
                */

                const unitName = document.getElementById('unit_name');
                const floor = document.getElementById('floor');
                const area = document.getElementById('area');
                const parking = document.getElementById('parking');


                /*
                |--------------------------------------------------------------------------
                | نام واحد - حداکثر ۲۴ کاراکتر
                |--------------------------------------------------------------------------
                */

                if (unitName) {

                    unitName.addEventListener('input', function () {

                        if (this.value.length > 24) {
                            this.value = this.value.slice(0, 24);
                        }

                    });

                }


                /*
                |--------------------------------------------------------------------------
                | طبقه - فقط عدد و حداکثر ۲ رقم
                |--------------------------------------------------------------------------
                */

                if (floor) {

                    floor.addEventListener('input', function () {

                        this.value = this.value
                            .replace(/[^\d۰-۹]/g, '')
                            .slice(0, 2);

                    });

                }


                /*
                |--------------------------------------------------------------------------
                | متراژ - فقط عدد و حداکثر ۳ رقم
                |--------------------------------------------------------------------------
                */

                if (area) {

                    area.addEventListener('input', function () {

                        this.value = this.value
                            .replace(/[^\d۰-۹]/g, '')
                            .slice(0, 3);

                    });

                }


                /*
                |--------------------------------------------------------------------------
                | پارکینگ - حداکثر ۵ کاراکتر
                |--------------------------------------------------------------------------
                */

                if (parking) {

                    parking.addEventListener('input', function () {

                        if (this.value.length > 5) {
                            this.value = this.value.slice(0, 5);
                        }

                    });

                }


                /*
                |--------------------------------------------------------------------------
                | ساکن فعلی
                |--------------------------------------------------------------------------
                */

                const occupancyStatus =
                    document.getElementById('occupancy_status');

                const residentSection =
                    document.getElementById('residentSection');

                const residentNotice =
                    document.getElementById('residentDisabledNotice');

                const residentFields =
                    residentSection
                        ? residentSection.querySelectorAll('.resident-field')
                        : [];

                const residentPhone =
                    document.getElementById('resident_phone');

                const residentPhoneError =
                    document.getElementById('residentPhoneError');

                const residentCount =
                    document.getElementById('resident_count');

                const residentCountError =
                    document.getElementById('residentCountError');

                const residentDebtAmount =
                    document.getElementById('resident_debt_amount');


                /*
                |--------------------------------------------------------------------------
                | فعال / غیرفعال کردن بخش ساکن
                |--------------------------------------------------------------------------
                */

                function updateResidentState() {

                    if (!occupancyStatus) {
                        return;
                    }

                    const isVacant =
                        occupancyStatus.value === 'vacant';


                    residentFields.forEach(function (field) {

                        field.disabled = isVacant;

                    });


                    if (residentSection) {

                        if (isVacant) {

                            residentSection.classList.add(
                                'opacity-50'
                            );

                        } else {

                            residentSection.classList.remove(
                                'opacity-50'
                            );

                        }

                    }


                    if (residentNotice) {

                        if (isVacant) {

                            residentNotice.classList.remove(
                                'hidden'
                            );

                            residentNotice.classList.add(
                                'sm:inline-flex'
                            );

                        } else {

                            residentNotice.classList.add(
                                'hidden'
                            );

                            residentNotice.classList.remove(
                                'sm:inline-flex'
                            );

                        }

                    }

                }


                if (occupancyStatus) {

                    occupancyStatus.addEventListener(
                        'change',
                        updateResidentState
                    );

                    updateResidentState();

                }


                /*
                |--------------------------------------------------------------------------
                | شماره تماس ساکن
                |--------------------------------------------------------------------------
                */

                if (residentPhone) {

                    residentPhone.addEventListener(
                        'input',
                        function () {

                            this.value = this.value
                                .replace(/[^\d۰-۹]/g, '')
                                .slice(0, 11);


                            if (residentPhoneError) {

                                residentPhoneError.classList.add(
                                    'hidden'
                                );

                                residentPhoneError.textContent =
                                    '';

                            }

                        }
                    );


                    residentPhone.addEventListener(
                        'blur',
                        function () {

                            const value = this.value;


                            if (!value) {

                                residentPhoneError.classList.add(
                                    'hidden'
                                );

                                residentPhoneError.textContent =
                                    '';

                                return;

                            }


                            if (!/^[0۰]/.test(value)) {

                                residentPhoneError.textContent =
                                    'شماره تماس نمی‌تواند با عددی به جز ۰ شروع شود.';

                                residentPhoneError.classList.remove(
                                    'hidden'
                                );

                                return;

                            }


                            if (value.length < 11) {

                                residentPhoneError.textContent =
                                    'شماره تماس نمی‌تواند کمتر از ۱۱ رقم باشد.';

                                residentPhoneError.classList.remove(
                                    'hidden'
                                );

                                return;

                            }


                            residentPhoneError.classList.add(
                                'hidden'
                            );

                            residentPhoneError.textContent =
                                '';

                        }
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | تعداد افراد ساکن
                |--------------------------------------------------------------------------
                */

                if (residentCount) {

                    residentCount.addEventListener(
                        'input',
                        function () {

                            this.value = this.value
                                .replace(/[^\d۰-۹]/g, '')
                                .slice(0, 2);


                            if (residentCountError) {

                                residentCountError.classList.add(
                                    'hidden'
                                );

                                residentCountError.textContent =
                                    '';

                            }

                        }
                    );


                    residentCount.addEventListener(
                        'blur',
                        function () {

                            const value = this.value;


                            if (!value) {

                                residentCountError.classList.add(
                                    'hidden'
                                );

                                residentCountError.textContent =
                                    '';

                                return;

                            }


                            const normalizedValue =
                                value.replace(
                                    /[۰-۹]/g,
                                    function (digit) {

                                        return '۰۱۲۳۴۵۶۷۸۹'.indexOf(
                                            digit
                                        );

                                    }
                                );


                            if (Number(normalizedValue) < 1) {

                                residentCountError.textContent =
                                    'تعداد افراد نمی‌تواند کمتر از ۱ باشد.';

                                residentCountError.classList.remove(
                                    'hidden'
                                );

                                return;

                            }


                            residentCountError.classList.add(
                                'hidden'
                            );

                            residentCountError.textContent =
                                '';

                        }
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | مبلغ بدهی ساکن
                |--------------------------------------------------------------------------
                */

                if (residentDebtAmount) {

                    residentDebtAmount.addEventListener(
                        'input',
                        function () {

                            let value = this.value
                                .replace(/[^\d۰-۹]/g, '');


                            const westernValue =
                                value.replace(
                                    /[۰-۹]/g,
                                    function (digit) {

                                        return '۰۱۲۳۴۵۶۷۸۹'.indexOf(
                                            digit
                                        );

                                    }
                                );


                            if (!westernValue) {

                                this.value = '';

                                return;

                            }


                            this.value =
                                Number(
                                    westernValue
                                ).toLocaleString('en-US');

                        }
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | مالک فعلی
                |--------------------------------------------------------------------------
                */

                const ownerPhone =
                    document.getElementById('owner_phone');

                const ownerPhoneError =
                    document.getElementById('ownerPhoneError');

                const ownerDebtAmount =
                    document.getElementById('owner_debt_amount');


                /*
                |--------------------------------------------------------------------------
                | شماره تماس مالک
                |--------------------------------------------------------------------------
                */

                if (ownerPhone) {

                    ownerPhone.addEventListener(
                        'input',
                        function () {

                            this.value = this.value
                                .replace(/[^\d۰-۹]/g, '')
                                .slice(0, 11);


                            if (ownerPhoneError) {

                                ownerPhoneError.classList.add(
                                    'hidden'
                                );

                                ownerPhoneError.textContent =
                                    '';

                            }

                        }
                    );


                    ownerPhone.addEventListener(
                        'blur',
                        function () {

                            const value = this.value;


                            if (!value) {

                                ownerPhoneError.classList.add(
                                    'hidden'
                                );

                                ownerPhoneError.textContent =
                                    '';

                                return;

                            }


                            if (!/^[0۰]/.test(value)) {

                                ownerPhoneError.textContent =
                                    'شماره تماس نمی‌تواند با عددی به جز ۰ شروع شود.';

                                ownerPhoneError.classList.remove(
                                    'hidden'
                                );

                                return;

                            }


                            if (value.length < 11) {

                                ownerPhoneError.textContent =
                                    'شماره تماس نمی‌تواند کمتر از ۱۱ رقم باشد.';

                                ownerPhoneError.classList.remove(
                                    'hidden'
                                );

                                return;

                            }


                            ownerPhoneError.classList.add(
                                'hidden'
                            );

                            ownerPhoneError.textContent =
                                '';

                        }
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | مبلغ بدهی مالک
                |--------------------------------------------------------------------------
                */

                if (ownerDebtAmount) {

                    ownerDebtAmount.addEventListener(
                        'input',
                        function () {

                            let value = this.value
                                .replace(/[^\d۰-۹]/g, '');


                            const westernValue =
                                value.replace(
                                    /[۰-۹]/g,
                                    function (digit) {

                                        return '۰۱۲۳۴۵۶۷۸۹'.indexOf(
                                            digit
                                        );

                                    }
                                );


                            if (!westernValue) {

                                this.value = '';

                                return;

                            }


                            this.value =
                                Number(
                                    westernValue
                                ).toLocaleString('en-US');

                        }
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | انتخاب تاریخ جلالی
                |--------------------------------------------------------------------------
                */

                const picker =
                    document.getElementById(
                        'jalaliDatePicker'
                    );

                const overlay =
                    document.getElementById(
                        'jalaliDatePickerOverlay'
                    );

                const closeButton =
                    document.getElementById(
                        'jalaliDatePickerClose'
                    );

                const confirmButton =
                    document.getElementById(
                        'jalaliDatePickerConfirm'
                    );

                const preview =
                    document.getElementById(
                        'jalaliDatePickerPreview'
                    );


                /*
                |--------------------------------------------------------------------------
                | Jalali
                |--------------------------------------------------------------------------
                */

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


                function toPersianNumber(value) {

                    return String(value).replace(
                        /\d/g,
                        function (digit) {

                            return '۰۱۲۳۴۵۶۷۸۹'[digit];

                        }
                    );

                }


                function mod(value, length) {

                    return (
                        (value % length) +
                        length
                    ) % length;

                }


                function isLeapJalaliYear(year) {

                    const breaks = [
                        -61,
                        9,
                        38,
                        199,
                        426,
                        686,
                        756,
                        818,
                        1111,
                        1181,
                        1210,
                        1635,
                        2060,
                        2097,
                        2192,
                        2262,
                        2347,
                        2381,
                        2454,
                        3178
                    ];


                    let leapJ = -14;

                    let jp = breaks[0];

                    let jump = 0;


                    for (
                        let i = 1;
                        i < breaks.length;
                        i++
                    ) {

                        const jm =
                            breaks[i];


                        jump =
                            jm - jp;


                        if (year < jm) {
                            break;
                        }


                        leapJ +=
                            Math.floor(
                                jump / 33
                            ) * 8 +
                            Math.floor(
                                (jump % 33) / 4
                            );


                        jp = jm;

                    }


                    let n =
                        year - jp;


                    if (jump - n < 6) {

                        n =
                            n -
                            jump +
                            Math.floor(
                                (jump + 4) / 33
                            ) * 33;

                    }


                    let leap =
                        (
                            (n + 1) % 33 -
                            1
                        ) % 4;


                    if (leap === -1) {
                        leap = 4;
                    }


                    return leap === 0;

                }


                function daysInMonth(year, month) {

                    if (month <= 6) {
                        return 31;
                    }

                    if (month <= 11) {
                        return 30;
                    }

                    return isLeapJalaliYear(year)
                        ? 30
                        : 29;

                }


                /*
                |--------------------------------------------------------------------------
                | Circular Wheel
                |--------------------------------------------------------------------------
                */

                class CircularWheel {

                    constructor(
                        element,
                        values,
                        initialIndex,
                        changeCallback
                    ) {

                        this.element = element;

                        this.values = values;

                        this.length =
                            values.length;

                        this.itemHeight = 54;

                        this.centerY = 135;

                        this.position =
                            initialIndex;

                        this.velocity = 0;

                        this.dragging = false;

                        this.pointerId = null;

                        this.lastY = 0;

                        this.lastTime = 0;

                        this.animationFrame = null;

                        this.changeCallback =
                            changeCallback;


                        this.track =
                            document.createElement(
                                'div'
                            );


                        this.track.className =
                            'wheel-track';


                        this.element.appendChild(
                            this.track
                        );


                        this.items = [];


                        for (
                            let i = -3;
                            i <= 3;
                            i++
                        ) {

                            const item =
                                document.createElement(
                                    'div'
                                );


                            item.className =
                                'wheel-item';


                            this.track.appendChild(
                                item
                            );


                            this.items.push({
                                element: item,
                                slot: i
                            });

                        }


                        this.render();

                        this.bind();

                    }


                    render() {

                        const base =
                            Math.floor(
                                this.position
                            );


                        const fraction =
                            this.position -
                            base;


                        this.items.forEach(
                            ({ element, slot }) => {

                                const logicalIndex =
                                    mod(
                                        base + slot,
                                        this.length
                                    );


                                const distance =
                                    slot - fraction;


                                const y =
                                    this.centerY -
                                    this.itemHeight / 2 +
                                    distance *
                                    this.itemHeight;


                                const absoluteDistance =
                                    Math.abs(
                                        distance
                                    );


                                element.style.transform =
                                    `translateY(${y}px) scale(${this.getScale(absoluteDistance)})`;


                                element.style.opacity =
                                    this.getOpacity(
                                        absoluteDistance
                                    );


                                element.textContent =
                                    this.values[
                                        logicalIndex
                                    ];


                                element.classList.toggle(
                                    'active',
                                    absoluteDistance < 0.5
                                );


                                element.classList.toggle(
                                    'near',
                                    absoluteDistance >= 0.5 &&
                                    absoluteDistance < 1.6
                                );

                            }
                        );

                    }


                    getScale(distance) {

                        if (distance < 0.5) {
                            return 1.08;
                        }

                        if (distance < 1.5) {
                            return 1;
                        }

                        return 0.92;

                    }


                    getOpacity(distance) {

                        if (distance < 0.5) {
                            return 1;
                        }

                        if (distance < 1.5) {
                            return 0.65;
                        }

                        if (distance < 2.5) {
                            return 0.32;
                        }

                        return 0;

                    }


                    getSelectedIndex() {

                        return mod(
                            Math.round(
                                this.position
                            ),
                            this.length
                        );

                    }


                    getSelectedValue() {

                        return this.values[
                            this.getSelectedIndex()
                        ];

                    }


                    bind() {

                        this.element.addEventListener(
                            'pointerdown',
                            event => {

                                this.stop();

                                this.dragging = true;

                                this.pointerId =
                                    event.pointerId;

                                this.lastY =
                                    event.clientY;

                                this.lastTime =
                                    performance.now();

                                this.velocity = 0;


                                this.element.classList.add(
                                    'dragging'
                                );


                                this.element.setPointerCapture?.(
                                    event.pointerId
                                );

                            }
                        );


                        this.element.addEventListener(
                            'pointermove',
                            event => {

                                if (
                                    !this.dragging ||
                                    event.pointerId !==
                                    this.pointerId
                                ) {
                                    return;
                                }


                                const now =
                                    performance.now();


                                const deltaY =
                                    event.clientY -
                                    this.lastY;


                                const deltaTime =
                                    Math.max(
                                        1,
                                        now -
                                        this.lastTime
                                    );


                                this.lastY =
                                    event.clientY;


                                this.lastTime =
                                    now;


                                this.position -=
                                    deltaY /
                                    this.itemHeight;


                                this.velocity =
                                    (
                                        -deltaY /
                                        this.itemHeight
                                    ) /
                                    deltaTime;


                                this.render();

                            }
                        );


                        this.element.addEventListener(
                            'pointerup',
                            event => {

                                if (
                                    event.pointerId !==
                                    this.pointerId
                                ) {
                                    return;
                                }

                                this.endDrag();

                            }
                        );


                        this.element.addEventListener(
                            'pointercancel',
                            event => {

                                if (
                                    event.pointerId !==
                                    this.pointerId
                                ) {
                                    return;
                                }

                                this.endDrag();

                            }
                        );


                        this.element.addEventListener(
                            'click',
                            () => {

                                if (
                                    Math.abs(
                                        this.velocity
                                    ) > 0.01
                                ) {

                                    this.stop();

                                    this.snap();

                                }

                            }
                        );

                    }


                    endDrag() {

                        if (!this.dragging) {
                            return;
                        }


                        this.dragging = false;


                        this.element.classList.remove(
                            'dragging'
                        );


                        let velocity =
                            this.velocity *
                            110;


                        velocity =
                            Math.max(
                                -18,
                                Math.min(
                                    18,
                                    velocity
                                )
                            );


                        this.velocity =
                            velocity;


                        if (
                            Math.abs(
                                velocity
                            ) < 0.08
                        ) {

                            this.snap();

                            return;

                        }


                        this.inertia();

                    }


                    inertia() {

                        const friction =
                            0.94;


                        const animate = () => {

                            if (this.dragging) {
                                return;
                            }


                            this.position +=
                                this.velocity;


                            this.velocity *=
                                friction;


                            this.render();


                            if (
                                Math.abs(
                                    this.velocity
                                ) > 0.012
                            ) {

                                this.animationFrame =
                                    requestAnimationFrame(
                                        animate
                                    );

                                return;

                            }


                            this.snap();

                        };


                        this.animationFrame =
                            requestAnimationFrame(
                                animate
                            );

                    }


                    snap() {

                        this.stop();


                        const target =
                            Math.round(
                                this.position
                            );


                        const start =
                            this.position;


                        const distance =
                            target -
                            start;


                        const duration =
                            220;


                        const startTime =
                            performance.now();


                        const animate = now => {

                            const progress =
                                Math.min(
                                    1,
                                    (
                                        now -
                                        startTime
                                    ) /
                                    duration
                                );


                            const eased =
                                1 -
                                Math.pow(
                                    1 - progress,
                                    3
                                );


                            this.position =
                                start +
                                distance *
                                eased;


                            this.render();


                            if (progress < 1) {

                                this.animationFrame =
                                    requestAnimationFrame(
                                        animate
                                    );

                                return;

                            }


                            this.position =
                                target;


                            this.render();

                            this.velocity = 0;


                            if (this.changeCallback) {

                                this.changeCallback(
                                    this.getSelectedIndex()
                                );

                            }

                        };


                        this.animationFrame =
                            requestAnimationFrame(
                                animate
                            );

                    }


                    stop() {

                        if (
                            this.animationFrame !==
                            null
                        ) {

                            cancelAnimationFrame(
                                this.animationFrame
                            );

                            this.animationFrame =
                                null;

                        }

                    }


                    setIndex(index) {

                        this.stop();


                        this.position =
                            index;


                        this.velocity = 0;


                        this.render();

                    }

                }


                /*
                |--------------------------------------------------------------------------
                | Date State
                |--------------------------------------------------------------------------
                */

                let activeTarget = null;

                let selectedDay = 1;

                let selectedMonth = 1;

                let selectedYear = 1405;


                let dayWheel = null;

                let monthWheel = null;

                let yearWheel = null;


                /*
                |--------------------------------------------------------------------------
                | Create Day Wheel
                |--------------------------------------------------------------------------
                */

                function createDayWheel() {

                    if (dayWheel) {
                        dayWheel.stop();
                    }


                    const totalDays =
                        daysInMonth(
                            selectedYear,
                            selectedMonth
                        );


                    const values =
                        Array.from(
                            {
                                length: totalDays
                            },
                            (_, index) =>
                                toPersianNumber(
                                    index + 1
                                )
                        );


                    selectedDay =
                        Math.min(
                            selectedDay,
                            totalDays
                        );


                    dayWheel =
                        new CircularWheel(
                            document.getElementById(
                                'wheelDay'
                            ),
                            values,
                            selectedDay - 1,
                            function (index) {

                                selectedDay =
                                    index + 1;


                                updatePreview();

                            }
                        );

                }


                /*
                |--------------------------------------------------------------------------
                | Create Month Wheel
                |--------------------------------------------------------------------------
                */

                function createMonthWheel() {

                    if (monthWheel) {
                        monthWheel.stop();
                    }


                    monthWheel =
                        new CircularWheel(
                            document.getElementById(
                                'wheelMonth'
                            ),
                            months,
                            selectedMonth - 1,
                            function (index) {

                                selectedMonth =
                                    index + 1;


                                const maxDays =
                                    daysInMonth(
                                        selectedYear,
                                        selectedMonth
                                    );


                                if (
                                    selectedDay >
                                    maxDays
                                ) {

                                    selectedDay =
                                        maxDays;

                                }


                                rebuildDayWheel();

                                updatePreview();

                            }
                        );

                }


                /*
                |--------------------------------------------------------------------------
                | Create Year Wheel
                |--------------------------------------------------------------------------
                */

                function createYearWheel() {

                    if (yearWheel) {
                        yearWheel.stop();
                    }


                    const startYear = 1340;

                    const endYear = 1405;


                    const years =
                        Array.from(
                            {
                                length:
                                    endYear -
                                    startYear +
                                    1
                            },
                            (_, index) =>
                                toPersianNumber(
                                    startYear +
                                    index
                                )
                        );


                    yearWheel =
                        new CircularWheel(
                            document.getElementById(
                                'wheelYear'
                            ),
                            years,
                            selectedYear - startYear,
                            function (index) {

                                selectedYear =
                                    startYear +
                                    index;


                                const maxDays =
                                    daysInMonth(
                                        selectedYear,
                                        selectedMonth
                                    );


                                if (
                                    selectedDay >
                                    maxDays
                                ) {

                                    selectedDay =
                                        maxDays;

                                }


                                rebuildDayWheel();

                                updatePreview();

                            }
                        );

                }


                /*
                |--------------------------------------------------------------------------
                | Rebuild Day Wheel
                |--------------------------------------------------------------------------
                */

                function rebuildDayWheel() {

                    const container =
                        document.getElementById(
                            'wheelDay'
                        );


                    container.innerHTML = '';


                    createDayWheel();

                }


                /*
                |--------------------------------------------------------------------------
                | Preview
                |--------------------------------------------------------------------------
                */

                function updatePreview() {

                    if (!preview) {
                        return;
                    }


                    preview.textContent =
                        toPersianNumber(
                            selectedDay
                        ) +
                        ' ' +
                        months[
                            selectedMonth - 1
                        ] +
                        ' ' +
                        toPersianNumber(
                            selectedYear
                        );

                }


                /*
                |--------------------------------------------------------------------------
                | Open Picker
                |--------------------------------------------------------------------------
                */

                function openPicker(target) {

                    activeTarget =
                        target;


                    let hiddenInput;


                    if (
                        target ===
                        'resident'
                    ) {

                        hiddenInput =
                            document.getElementById(
                                'resident_move_in_date_value'
                            );

                    } else {

                        hiddenInput =
                            document.getElementById(
                                'ownership_start_date_value'
                            );

                    }


                    if (
                        hiddenInput &&
                        hiddenInput.value
                    ) {

                        const parts =
                            hiddenInput.value.split('-');


                        if (
                            parts.length === 3
                        ) {

                            selectedYear =
                                parseInt(
                                    parts[0]
                                );

                            selectedMonth =
                                parseInt(
                                    parts[1]
                                );

                            selectedDay =
                                parseInt(
                                    parts[2]
                                );

                        }

                    } else {

                        selectedYear = 1405;

                        selectedMonth = 1;

                        selectedDay = 1;

                    }


                    const wheelDay =
                        document.getElementById(
                            'wheelDay'
                        );

                    const wheelMonth =
                        document.getElementById(
                            'wheelMonth'
                        );

                    const wheelYear =
                        document.getElementById(
                            'wheelYear'
                        );


                    if (wheelDay) {
                        wheelDay.innerHTML = '';
                    }

                    if (wheelMonth) {
                        wheelMonth.innerHTML = '';
                    }

                    if (wheelYear) {
                        wheelYear.innerHTML = '';
                    }


                    createDayWheel();

                    createMonthWheel();

                    createYearWheel();


                    updatePreview();


                    if (picker) {

                        picker.classList.remove(
                            'hidden'
                        );

                        picker.classList.add(
                            'flex'
                        );

                    }


                    document.body.classList.add(
                        'overflow-hidden'
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | Close Picker
                |--------------------------------------------------------------------------
                */

                function closePicker() {

                    if (picker) {

                        picker.classList.add(
                            'hidden'
                        );

                        picker.classList.remove(
                            'flex'
                        );

                    }


                    document.body.classList.remove(
                        'overflow-hidden'
                    );


                    if (dayWheel) {
                        dayWheel.stop();
                    }

                    if (monthWheel) {
                        monthWheel.stop();
                    }

                    if (yearWheel) {
                        yearWheel.stop();
                    }


                    activeTarget = null;

                }


                /*
                |--------------------------------------------------------------------------
                | Date Picker Buttons
                |--------------------------------------------------------------------------
                */

                document
                    .querySelectorAll(
                        '[data-date-picker]'
                    )
                    .forEach(
                        function (button) {

                            button.addEventListener(
                                'click',
                                function () {

                                    openPicker(
                                        button.dataset.datePicker
                                    );

                                }
                            );

                        }
                    );


                /*
                |--------------------------------------------------------------------------
                | Close Button
                |--------------------------------------------------------------------------
                */

                if (closeButton) {

                    closeButton.addEventListener(
                        'click',
                        closePicker
                    );

                }


                if (overlay) {

                    overlay.addEventListener(
                        'click',
                        closePicker
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | Confirm Date
                |--------------------------------------------------------------------------
                */

                if (confirmButton) {

                    confirmButton.addEventListener(
                        'click',
                        function () {

                            if (!activeTarget) {
                                return;
                            }


                            const formattedDate =
                                selectedYear +
                                '-' +
                                String(
                                    selectedMonth
                                ).padStart(2, '0') +
                                '-' +
                                String(
                                    selectedDay
                                ).padStart(2, '0');


                            let hiddenInput;

                            let displayButton;


                            if (
                                activeTarget ===
                                'resident'
                            ) {

                                hiddenInput =
                                    document.getElementById(
                                        'resident_move_in_date_value'
                                    );

                                displayButton =
                                    document.getElementById(
                                        'resident_move_in_date'
                                    );

                            } else {

                                hiddenInput =
                                    document.getElementById(
                                        'ownership_start_date_value'
                                    );

                                displayButton =
                                    document.getElementById(
                                        'ownership_start_date'
                                    );

                            }


                            if (
                                hiddenInput &&
                                displayButton
                            ) {

                                hiddenInput.value =
                                    formattedDate;


                                displayButton.textContent =
                                    toPersianNumber(
                                        selectedDay
                                    ) +
                                    ' ' +
                                    months[
                                        selectedMonth - 1
                                    ] +
                                    ' ' +
                                    toPersianNumber(
                                        selectedYear
                                    );


                                displayButton.classList.remove(
                                    'text-slate-400'
                                );


                                displayButton.classList.add(
                                    'text-slate-700'
                                );

                            }


                            closePicker();

                        }
                    );

                }

            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {

                const fields = [
                    'unit_name',
                    'floor',
                    'area',
                    'description',
                    'resident_phone',
                    'resident_count',
                    'resident_description',
                    'resident_debt_title',
                    'resident_debt_amount',
                    'owner_phone',
                    'owner_description',
                    'owner_debt_title',
                    'owner_debt_amount'
                ];

                const toPersianDigits = function (value) {
                    return value.replace(/[0-9]/g, function (digit) {
                        return '۰۱۲۳۴۵۶۷۸۹'[digit];
                    });
                };

                fields.forEach(function (fieldId) {

                    const field = document.getElementById(fieldId);

                    if (!field) {
                        return;
                    }

                    field.addEventListener('input', function () {

                        const start = this.selectionStart;
                        const end = this.selectionEnd;

                        this.value = toPersianDigits(this.value);

                        this.setSelectionRange(start, end);
                    });

                });

            });
        </script>


@endsection