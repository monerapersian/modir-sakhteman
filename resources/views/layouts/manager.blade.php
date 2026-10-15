<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'مدیر خوب - پنل مدیریت ساختمان')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="icon" href="{{ asset('img/modir-logo.png') }}" type="image/x-icon">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    
    <script src="{{ asset('js/modirchart.umd.min.js') }}"></script>

</head>

<body class="bg-[#e5e2dd] text-[#003260] antialiased">

    <div class="min-h-screen lg:flex">

        <!-- ============================= -->
        <!-- Desktop Sidebar -->
        <!-- ============================= -->
        @include('partials.manager.sidebar')

        <div class="flex-1 flex flex-col">
            @include('partials.manager.header')

            <!-- ============================= -->
            <!-- Main Area -->
            <!-- ============================= -->
            <div class="flex-1 flex flex-col">
                @yield('content')
            </div>
        </div>

    </div>

    <!-- ============================= -->
    <!-- Bottom Navigation (Mobile) -->
    <!-- ============================= -->
    @include('partials.manager.mobile-nav')


    <script>

    let lastScroll = 0;
    const header = document.getElementById("mobileHeader");

    window.addEventListener("scroll", () => {

        const current = window.pageYOffset;

        if(current > lastScroll && current > 50){
            header.style.transform = "translateY(-100%)";
        }else{
            header.style.transform = "translateY(0)";
        }

        lastScroll = current;

    });

    </script>
    @stack('scripts')

</body>

</html>