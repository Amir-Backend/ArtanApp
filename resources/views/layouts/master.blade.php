<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'آرتان اپ') | آرتان اپ</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link
    rel="stylesheet"href="https://cdn.jsdelivr.net/gh/AmirAbbasVafaee/persian-fonts-cdn@main/css/dana.css">
    @stack('styles')
</head>
<body>

    <div class="app-shell">

        {{-- Sidebar --}}
        <aside class="sidebar">
            <div class="sidebar-brand">
                <img src="{{ asset('images/logo.png') }}" alt="آرتان اپ" class="sidebar-brand-logo">
                <div>
                    آرتان اپ
                    <span>مدیریت آموزشگاه موسیقی</span>
                </div>
            </div>

            <ul class="sidebar-nav">
                <li>
                    <a href="{{ route('students.index') }}"
                       class="{{ request()->routeIs('students.*') ? 'active' : '' }}">
                        هنرجویان
                    </a>
                </li>
                <li>
                    <a href="{{ route('teachers.index') }}"
                       class="{{ request()->routeIs('teachers.*') ? 'active' : '' }}">
                        اساتید
                    </a>
                </li>
                <li>
                    <a href="{{ route('instruments.index') }}"
                       class="{{ request()->routeIs('instruments.*') ? 'active' : '' }}">
                        سازها
                    </a>
                </li>
                <li>
                    <a href="{{ route('teacher-skills.index') }}"
                       class="{{ request()->routeIs('teacher-skills.*') ? 'active' : '' }}">
                        مهارت اساتید
                    </a>
                </li>
                <li class="disabled">
                    <a href="#">دوره‌ها</a>
                </li>
                <li class="disabled">
                    <a href="#">کلاس‌ها</a>
                </li>
                <li class="disabled">
                    <a href="#">پرداخت‌ها</a>
                </li>
            </ul>
        </aside>

        {{-- Main column --}}
        <div class="main-column">

            <header class="app-header">
                <h1>@yield('title', 'داشبورد')</h1>
            </header>

            <main class="app-content">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')

            </main>

        </div>

    </div>

    @stack('scripts')

</body>
</html>
