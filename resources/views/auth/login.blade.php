@extends('layouts.auth')

@section('title', 'مدیر خوب - ورود')

@section('content')

    <main class="max-h-screen p-1">

        <div class="relative min-h-[calc(100vh-1.5rem)] sm:min-h-[calc(100vh-2.5rem)] lg:min-h-[calc(100vh-3.5rem)] overflow-hidden rounded-[2rem] lg:rounded-[2.5rem] bg-[#003260] shadow-2xl shadow-[#003260]/20">

            <!-- Background Decoration -->
            <div class="absolute inset-0 pointer-events-none overflow-hidden">

                <div class="absolute -top-40 -right-40 w-[32rem] h-[32rem] rounded-full border border-white/5"></div>
                <div class="absolute -top-24 -right-24 w-[24rem] h-[24rem] rounded-full border border-white/5"></div>

                <div class="absolute -bottom-48 -left-48 w-[38rem] h-[38rem] rounded-full border border-white/5"></div>
                <div class="absolute -bottom-32 -left-32 w-[27rem] h-[27rem] rounded-full border border-white/5"></div>

                <div class="absolute top-1/3 right-1/3 w-2 h-2 rounded-full bg-[#e5e2dd]/30"></div>
                <div class="absolute top-1/4 left-1/4 w-1.5 h-1.5 rounded-full bg-[#e5e2dd]/20"></div>
                <div class="absolute bottom-1/3 left-1/3 w-2 h-2 rounded-full bg-[#e5e2dd]/20"></div>

            </div>


            <!-- Main Content -->
            <div class="relative z-10 min-h-full lg:min-h-[calc(100vh-3.5rem)] grid lg:grid-cols-2">


                <!-- ========================================= -->
                <!-- BRAND / VISUAL SIDE -->
                <!-- ========================================= -->

                <section class="hidden lg:flex relative flex-col justify-between p-4 xl:p-6 2xl:p-7 text-white overflow-hidden">

                    <!-- Top Brand -->
                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12 rounded-2xl bg-[#e5e2dd] flex items-center justify-center shadow-lg">

                            <img
                                src="{{ asset('img/modir-logo.png') }}"
                                alt="مدیر خوب"
                                class="w-11 h-11 object-contain"
                            >

                        </div>

                        <div>
                            <div class="text-lg font-bold modir-bold">
                                مدیر خوب
                            </div>

                            <div class="text-xs text-white/45 mt-0.5">
                                سامانه مدیریت ساختمان
                            </div>
                        </div>

                    </div>


                    <!-- Center Visual -->
                    <div class="relative flex-1 flex items-center justify-center min-h-[420px]">

                        <!-- Glow -->
                        <div class="absolute w-[25rem] h-[25rem] rounded-full bg-[#e5e2dd]/5 blur-3xl"></div>


                        <!-- Building Illustration -->
                        <div class="relative w-[27rem] h-[27rem] xl:w-[31rem] xl:h-[31rem]">

                            <!-- Outer Circle -->
                            <div class="absolute inset-5 rounded-full border border-white/8"></div>

                            <div class="absolute inset-14 rounded-full border border-white/6"></div>


                            <!-- Building -->
                            <div class="absolute left-1/2 bottom-12 -translate-x-1/2 w-56 xl:w-64">

                                <!-- Building Shadow -->
                                <div class="absolute -bottom-3 left-1/2 -translate-x-1/2 w-72 h-8 rounded-[50%] bg-black/20 blur-xl"></div>


                                <!-- Main Building -->
                                <div class="relative rounded-t-[2rem] bg-[#e5e2dd] p-4 shadow-2xl">

                                    <!-- Roof -->
                                    <div class="absolute -top-5 left-1/2 -translate-x-1/2 w-[calc(100%-2rem)] h-7 rounded-t-2xl bg-[#e5e2dd]"></div>

                                    <!-- Building Top -->
                                    <div class="h-10 rounded-xl bg-[#003260] flex items-center justify-center mb-4">

                                        <div class="w-16 h-1.5 rounded-full bg-[#e5e2dd]/30"></div>

                                    </div>


                                    <!-- Windows -->
                                    <div class="grid grid-cols-3 gap-3">

                                        <div class="aspect-square rounded-lg bg-[#003260]"></div>
                                        <div class="aspect-square rounded-lg bg-[#003260]"></div>
                                        <div class="aspect-square rounded-lg bg-[#003260]"></div>

                                        <div class="aspect-square rounded-lg bg-[#003260]"></div>
                                        <div class="aspect-square rounded-lg bg-[#003260]"></div>
                                        <div class="aspect-square rounded-lg bg-[#003260]"></div>

                                        <div class="aspect-square rounded-lg bg-[#003260]"></div>
                                        <div class="aspect-square rounded-lg bg-[#003260]"></div>
                                        <div class="aspect-square rounded-lg bg-[#003260]"></div>

                                    </div>


                                    <!-- Entrance -->
                                    <div class="mt-4 flex justify-center">

                                        <div class="w-16 h-20 rounded-t-xl bg-[#003260] flex items-end justify-center">

                                            <div class="w-2 h-2 rounded-full bg-[#e5e2dd]/60 mb-8 mr-2"></div>

                                        </div>

                                    </div>

                                </div>

                            </div>


                            <!-- Floating Card: Units -->
                            <div class="absolute top-12 -right-2 xl:right-0 bg-white/10 backdrop-blur-xl border border-white/10 rounded-2xl p-4 w-40 shadow-xl">

                                <div class="flex items-center justify-between mb-3">

                                    <span class="text-xs text-white/55">
                                        واحدهای فعال
                                    </span>

                                    <div class="w-7 h-7 rounded-lg bg-[#e5e2dd]/10 flex items-center justify-center">

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            class="w-4 h-4 text-[#e5e2dd]"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.7"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        >
                                            <path d="M3 21h18"/>
                                            <path d="M5 21V5l7-3 7 3v16"/>
                                            <path d="M9 21v-5h6v5"/>
                                            <path d="M8 8h1"/>
                                            <path d="M15 8h1"/>
                                            <path d="M8 11h1"/>
                                            <path d="M15 11h1"/>
                                        </svg>

                                    </div>

                                </div>

                                <div class="text-2xl font-bold">
                                    ۲۴
                                </div>

                                <div class="mt-1 text-[10px] text-white/40">
                                    در حال مدیریت
                                </div>

                            </div>


                            <!-- Floating Card: Payment -->
                            <div class="absolute bottom-16 -left-4 xl:left-0 bg-white/10 backdrop-blur-xl border border-white/10 rounded-2xl p-4 w-48 shadow-xl">

                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10 rounded-xl bg-[#e5e2dd] flex items-center justify-center shrink-0">

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            class="w-5 h-5 text-[#003260]"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        >
                                            <rect width="18" height="14" x="3" y="5" rx="2"/>
                                            <path d="M3 10h18"/>
                                            <path d="M7 15h4"/>
                                        </svg>

                                    </div>

                                    <div>

                                        <div class="text-xs text-white/45">
                                            وضعیت پرداخت
                                        </div>

                                        <div class="text-sm font-bold mt-1 modir-bold">
                                            پرداخت‌ها به‌روز است
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- Bottom Text -->
                    <div class="max-w-md">

                        <div class="flex items-center gap-2 mb-4">

                            <span class="w-8 h-px bg-[#e5e2dd]/40"></span>

                            <span class="text-xs text-white/45">
                                مدیریت، ساده‌تر از همیشه
                            </span>

                        </div>

                        <h2 class="text-3xl xl:text-4xl 2xl:text-5xl leading-[1.4] font-bold modir-bold">
                            همه چیزِ ساختمان،
                            <span class="text-[#e5e2dd]/70">
                                یک‌جا
                            </span>
                            در اختیار شماست.
                        </h2>

                        <p class="mt-5 text-sm leading-7 text-white/45 max-w-sm">
                            مدیریت واحدها، شارژ، پرداخت‌ها و هزینه‌های ساختمان را ساده، سریع و منظم انجام دهید.
                        </p>

                    </div>

                </section>



                <!-- ========================================= -->
                <!-- LOGIN SIDE -->
                <!-- ========================================= -->

                <section class="flex items-center justify-center p-5 sm:p-8 lg:p-10 xl:p-14 bg-white">

                    <div class="w-full max-w-md">


                        <!-- Mobile Brand -->
                        <div class="lg:hidden flex flex-col items-center text-center mb-8">

                            <div class="w-16 h-16 rounded-2xl bg-white flex items-center justify-center shadow-lg shadow-[#003260]/15 mb-4">
                                <img
                                    src="{{ asset('img/modir-logo.png') }}"
                                    alt="مدیر خوب"
                                    class="w-14 h-14 object-contain"
                                >
                            </div>

                            <h1 class="text-2xl font-bold modir-bold">
                                مدیر خوب
                            </h1>

                            <p class="mt-1 text-xs text-[#003260]/50">
                                سامانه مدیریت ساختمان
                            </p>

                        </div>


                        <!-- Login Header -->
                        <div class="mb-8">

                            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-[#003260]/6 text-[#003260] text-[11px] font-medium mb-4">

                                <span class="w-1.5 h-1.5 rounded-full bg-[#003260]"></span>

                                ورود امن به سامانه

                            </div>

                            <h2 class="text-2xl sm:text-3xl font-bold modir-bold tracking-tight">
                                خوش آمدید
                            </h2>

                            <p class="mt-2.5 text-sm leading-6 text-gray-500">
                                برای ورود به پنل مدیریت ساختمان، اطلاعات حساب خود را وارد کنید.
                            </p>

                        </div>


                        <!-- Login Form -->
                        <form method="POST" action="{{ route('login.store') }}" class="space-y-5">
                            @csrf

                            <!-- Phone -->
                            <div>

                                <label
                                    for="phone"
                                    class="block text-sm font-semibold text-[#003260] mb-2.5"
                                >
                                    شماره موبایل
                                </label>

                                <div class="relative group">

                                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-[#003260]/35 group-focus-within:text-[#003260] transition-colors">

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            class="w-5 h-5"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.7"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        >
                                            <rect width="14" height="20" x="5" y="2" rx="2"/>
                                            <path d="M12 18h.01"/>
                                        </svg>

                                    </div>

                                    <input
                                        id="phone"
                                        name="phone"
                                        type="tel"
                                        inputmode="numeric"
                                        autocomplete="tel"
                                        value="{{ old('phone') }}"
                                        placeholder="۰۹۱۲ ۱۲۳ ۴۵۶۷"
                                        class="w-full h-14 rounded-2xl border {{ $errors->has('phone') ? 'border-red-400 focus:border-red-400 focus:ring-red-500/10' : 'border-[#003260]/10 focus:border-[#003260]/40 focus:ring-[#003260]/7' }} bg-white pr-12 pl-4 text-sm text-[#003260] outline-none transition-all placeholder:text-gray-400 focus:ring-4"
                                    >

                                </div>

                                @error('phone')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            <!-- Password -->
                            <div>

                                <div class="flex items-center justify-between mb-2.5">

                                    <label
                                        for="password"
                                        class="block text-sm font-semibold text-[#003260]"
                                    >
                                        رمز عبور
                                    </label>

                                    <a
                                        href="#"
                                        class="text-xs font-semibold text-[#003260]/65 hover:text-[#003260] transition-colors"
                                    >
                                        فراموشی رمز عبور؟
                                    </a>

                                </div>

                                <div class="relative group">

                                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-[#003260]/35 group-focus-within:text-[#003260] transition-colors">

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            class="w-5 h-5"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.7"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        >
                                            <rect width="18" height="11" x="3" y="11" rx="2"/>
                                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                        </svg>

                                    </div>

                                    <input
                                        id="password"
                                        name="password"
                                        type="password"
                                        autocomplete="current-password"
                                        placeholder="رمز عبور خود را وارد کنید"
                                        class="w-full h-14 rounded-2xl border {{ $errors->has('password') ? 'border-red-400 focus:border-red-400 focus:ring-red-500/10' : 'border-[#003260]/10 focus:border-[#003260]/40 focus:ring-[#003260]/7' }} bg-white pr-12 pl-12 text-sm text-[#003260] outline-none transition-all placeholder:text-gray-400 focus:ring-4"
                                    >


                                    <!-- Toggle Password -->
                                    <button
                                        type="button"
                                        id="togglePassword"
                                        aria-label="نمایش رمز عبور"
                                        class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 hover:text-[#003260] transition-colors"
                                    >

                                        <!-- Eye -->
                                        <svg
                                            id="eyeOpen"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            class="w-5 h-5"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.7"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        >
                                            <path d="M2.06 12.35a1 1 0 0 1 0-.7 10.75 10.75 0 0 1 19.88 0 1 1 0 0 1 0 .7 10.75 10.75 0 0 1-19.88 0"/>
                                            <circle cx="12" cy="12" r="3"/>
                                        </svg>


                                        <!-- Eye Off -->
                                        <svg
                                            id="eyeClosed"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            class="hidden w-5 h-5"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.7"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        >
                                            <path d="M3 3l18 18"/>
                                            <path d="M10.58 10.58a2 2 0 0 0 2.83 2.83"/>
                                            <path d="M9.88 5.09A10.77 10.77 0 0 1 12 4.87c5 0 8.73 4.11 9.84 6.73a1 1 0 0 1 0 .8 15.8 15.8 0 0 1-3.15 4.48"/>
                                            <path d="M6.61 6.61A15.78 15.78 0 0 0 2.16 11.6a1 1 0 0 0 0 .8c1.11 2.62 4.84 6.73 9.84 6.73a10.7 10.7 0 0 0 3.12-.46"/>
                                        </svg>

                                    </button>

                                </div>

                                @error('password')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            <!-- Remember -->
                            <div class="flex items-center justify-between pt-1">

                                <label class="inline-flex items-center gap-2.5 cursor-pointer select-none">

                                    <input
                                        id="remember"
                                        name="remember"
                                        type="checkbox"
                                        value="1"
                                        class="peer sr-only"
                                        {{ old('remember') ? 'checked' : '' }}
                                    >

                                    <span class="w-5 h-5 rounded-md border border-[#003260]/15 bg-white flex items-center justify-center transition-all peer-checked:bg-[#003260] peer-checked:border-[#003260]">

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            class="w-3.5 h-3.5 text-white opacity-0 peer-checked:opacity-100 transition-opacity color-white"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        >
                                            <path d="m5 12 4 4L19 6"/>
                                        </svg>

                                    </span>

                                    <span class="text-xs sm:text-sm text-gray-500">
                                        مرا به خاطر بسپار
                                    </span>

                                </label>

                            </div>


                            <!-- Submit -->
                            <button
                                type="submit"
                                class="group w-full h-14 inline-flex items-center justify-center gap-3 rounded-2xl bg-[#003260] px-5 text-sm font-bold text-white shadow-lg shadow-[#003260]/15 transition-all duration-300 hover:bg-[#003260]/90 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-[#003260]/20 active:translate-y-0 focus:outline-none focus:ring-4 focus:ring-[#003260]/15 modir-bold cursor-pointer"
                            >

                                <span>
                                    ورود به حساب
                                </span>

                                <span class="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center transition-transform duration-300 group-hover:-translate-x-1">

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        class="w-4 h-4"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >
                                        <path d="M19 12H5"/>
                                        <path d="m12 19-7-7 7-7"/>
                                    </svg>

                                </span>

                            </button>

                        </form>


                        <!-- Security Note -->
                        <div class="mt-7 flex items-center justify-center gap-2 text-[11px] text-gray-400">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                class="w-3.5 h-3.5"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.7"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <rect width="18" height="11" x="3" y="11" rx="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>

                            ورود شما با امنیت کامل انجام می‌شود.

                        </div>


                        <!-- Footer -->
                        <div class="mt-8 pt-5 border-t border-[#003260]/8 text-center">

                            <p class="text-[11px] text-gray-400">
                                © ۱۴۰۵ مدیر خوب — تمامی حقوق محفوظ است.
                            </p>

                        </div>

                    </div>

                </section>

            </div>

        </div>

    </main>

@endsection