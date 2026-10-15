<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'مدیر خوب - ورود')</title>

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    <!-- /Styles -->

    <link rel="icon" href="{{ asset('img/modir-logo.png') }}" type="image/x-icon">

    <!-- Tailwind CSS -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="min-h-screen bg-[#e5e2dd] text-[#003260] antialiased">

    @yield('content')

    <!-- Password Toggle -->
    <script>

        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeOpen = document.getElementById('eyeOpen');
        const eyeClosed = document.getElementById('eyeClosed');

        togglePassword.addEventListener('click', function () {

            const isPassword = passwordInput.type === 'password';

            passwordInput.type = isPassword ? 'text' : 'password';

            eyeOpen.classList.toggle('hidden', isPassword);
            eyeClosed.classList.toggle('hidden', !isPassword);

            togglePassword.setAttribute(
                'aria-label',
                isPassword ? 'مخفی کردن رمز عبور' : 'نمایش رمز عبور'
            );

        });

    </script>

</body>

</html>