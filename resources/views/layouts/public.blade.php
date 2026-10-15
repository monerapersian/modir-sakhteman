<!DOCTYPE html>
<html lang="fa" dir="rtl" class="scroll-smooth">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'مدیر خوب - سامانه مدیریت ساختمان')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="icon" href="{{ asset('img/modir-logo.png') }}" type="image/x-icon">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        :root {
            --modir-primary: #003260;
            --modir-surface: #e5e2dd;
            --modir-white: #ffffff;
            --modir-muted: #73869a;
            --modir-border: rgba(0, 50, 96, .12);
        }

        * {
            box-sizing: border-box;
        }

        @font-face {
          font-family: 'modir';
          src: url('../fonts/mr-modir-Medium.woff2');
        }

        @font-face {
          font-family: 'modirBold';
          src: url('../fonts/mr-modir-Bold.woff2');
        }

        body {
            margin: 0;
            background: var(--modir-surface);
            color: var(--modir-primary);
            font-family: 'modir';
            overflow-x: hidden;
        }

        h1, h2, h3, h4{
          font-family: 'modirBold';
        }

        .modir-bold{
            font-family: modirBold;
        }

        a, button {
            -webkit-tap-highlight-color: transparent;
        }

        .modir-container {
            width: min(1180px, calc(100% - 40px));
            margin-inline: auto;
        }

        .modir-glass {
            background: rgba(255, 255, 255, .66);
            border: 1px solid rgba(255, 255, 255, .85);
            box-shadow: 0 24px 80px rgba(0, 50, 96, .08);
            backdrop-filter: blur(22px);
            -webkit-backdrop-filter: blur(22px);
        }

        .modir-grid {
            background-image:
                linear-gradient(rgba(0, 50, 96, .055) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 50, 96, .055) 1px, transparent 1px);
            background-size: 46px 46px;
            mask-image: linear-gradient(to bottom, black, transparent 90%);
        }

        .modir-orb {
            position: absolute;
            border-radius: 9999px;
            pointer-events: none;
            filter: blur(1px);
            will-change: transform;
        }

        .modir-gradient-text {
            background: linear-gradient(110deg, #003260 15%, #2873a6 58%, #003260 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .modir-primary-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border: 1px solid var(--modir-primary);
            border-radius: 15px;
            padding: 14px 22px;
            background: var(--modir-primary);
            color: white;
            font-size: 14px;
            font-weight: 800;
            transition: transform .25s, box-shadow .25s, background .25s;
        }

        .modir-primary-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 30px rgba(0, 50, 96, .2);
            background: #064779;
        }

        .modir-secondary-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border: 1px solid rgba(0, 50, 96, .16);
            border-radius: 15px;
            padding: 14px 22px;
            color: var(--modir-primary);
            background: rgba(255, 255, 255, .55);
            font-size: 14px;
            font-weight: 800;
            transition: .25s;
        }

        .modir-secondary-btn:hover {
            background: white;
            transform: translateY(-3px);
        }

        .modir-feature-card {
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(0, 50, 96, .09);
            border-radius: 24px;
            background: rgba(255, 255, 255, .52);
            padding: 27px;
            transition: transform .3s, box-shadow .3s, border-color .3s;
        }

        .modir-feature-card:hover {
            transform: translateY(-7px);
            border-color: rgba(0, 50, 96, .2);
            box-shadow: 0 24px 50px rgba(0, 50, 96, .09);
        }

        .modir-feature-card::after {
            content: "";
            position: absolute;
            inset-inline-end: -45px;
            bottom: -65px;
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: rgba(0, 50, 96, .045);
            transition: transform .4s;
        }

        .modir-feature-card:hover::after {
            transform: scale(1.5);
        }

        .modir-icon {
            display: grid;
            width: 50px;
            height: 50px;
            place-items: center;
            border-radius: 16px;
            background: var(--modir-primary);
            color: white;
        }

        .modir-reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity .7s ease, transform .7s ease;
        }

        .modir-reveal.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        .modir-parallax {
            transform: translate3d(0, var(--parallax-y, 0px), 0);
            will-change: transform;
        }

        .modir-nav-link {
            color: #506982;
            font-size: 13px;
            font-weight: 700;
            transition: color .2s;
        }

        .modir-nav-link:hover {
            color: var(--modir-primary);
        }

        .modir-dashboard {
            border-radius: 28px;
            background: #fff;
            border: 1px solid rgba(255, 255, 255, .9);
            box-shadow: 0 35px 100px rgba(0, 50, 96, .17);
            overflow: hidden;
        }

        .modir-dashboard-top {
            height: 8px;
            background: linear-gradient(90deg, #003260, #397aa7, #003260);
        }

        .modir-mini-card {
            border: 1px solid #edf0f3;
            background: #fbfcfd;
            border-radius: 15px;
            padding: 15px;
        }

        .modir-line {
            height: 7px;
            border-radius: 999px;
            background: #e8edf2;
        }

        .modir-line-fill {
            height: 100%;
            border-radius: inherit;
            background: var(--modir-primary);
        }

        .modir-float {
            animation: modir-float 6s ease-in-out infinite;
        }

        .modir-float-delayed {
            animation: modir-float 7s ease-in-out 1s infinite;
        }

        @keyframes modir-float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @keyframes modir-pulse {
            0%, 100% { opacity: .45; }
            50% { opacity: 1; }
        }

        .modir-pulse {
            animation: modir-pulse 2.4s ease-in-out infinite;
        }

        @media (max-width: 768px) {
            .modir-container {
                width: min(100% - 30px, 1180px);
            }

            .modir-feature-card {
                padding: 22px;
            }

            .modir-dashboard {
                border-radius: 20px;
            }

            .modir-grid {
                background-size: 30px 30px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                scroll-behavior: auto !important;
                transition-duration: .01ms !important;
            }

            .modir-reveal {
                opacity: 1;
                transform: none;
            }
        }
    </style>
</head>

<body class="antialiased">

    @include('partials.public.header')

    @yield('content')

    @include('partials.public.footer')

    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const menuButton = document.getElementById('mobileMenuButton');
            const mobileMenu = document.getElementById('mobileMenu');

            menuButton?.addEventListener('click', () => {
                const isHidden = mobileMenu.classList.toggle('hidden');
                menuButton.setAttribute('aria-expanded', String(!isHidden));
            });

            mobileMenu?.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.add('hidden');
                    menuButton?.setAttribute('aria-expanded', 'false');
                });
            });

            const revealItems = document.querySelectorAll('.modir-reveal');

            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-visible');
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.12 });

                revealItems.forEach(item => observer.observe(item));
            } else {
                revealItems.forEach(item => item.classList.add('is-visible'));
            }

            const parallaxItems = document.querySelectorAll('[data-parallax]');
            const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            if (!reduceMotion && parallaxItems.length) {
                let ticking = false;

                const updateParallax = () => {
                    const scrollY = window.scrollY;

                    parallaxItems.forEach(item => {
                        const speed = Number(item.dataset.parallax || 0);
                        item.style.setProperty('--parallax-y', `${scrollY * speed}px`);
                    });

                    ticking = false;
                };

                window.addEventListener('scroll', () => {
                    if (!ticking) {
                        window.requestAnimationFrame(updateParallax);
                        ticking = true;
                    }
                }, { passive: true });

                updateParallax();
            }
        });
    </script>
</body>
</html>