<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'پنل مدیریت')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    @stack('styles')
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100;400;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="admin-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <h2>پنل مدیریت</h2>
        <nav>
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                داشبورد
            </a>
            <a href="{{ route('admin.tasks') }}"
               class="nav-link {{ request()->routeIs('admin.tasks') ? 'active' : '' }}">
                مدیریت تسک ها
            </a>
            <a href="{{ route('admin.categories') }}"
               class="nav-link {{ request()->routeIs('admin.categories') ? 'active' : '' }}">
                دسته بندی ها
            </a>
            {{-- فعلا ادرس غلط می دهیم بعدا اضافه کنیم--}}
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                انتصاب تسک ها
            </a>

            {{-- سایدبار اختصاصی ادمین اصلی (Admin) با استفاده از Gate --}}
            @can('access-admin-panel')
                <div style="margin-top: 20px; font-size: 0.8rem; color: #7f8c8d;">مدیریت سیستم</div>
                {{-- فعلا ادرس غلط می دهیم بعدا اضافه کنیم--}}
                <a href="{{ route('admin.dashboard') }}"
                   class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    مدیریت کاربران
                </a>
                {{-- فعلا ادرس غلط می دهیم بعدا اضافه کنیم--}}
                <a href="{{ route('admin.dashboard') }}"
                   class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    ساخت کاربر جدید
                </a>
            @endcan

            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <div class="logout-wrapper">
                    <button type="submit" class="btn-logout">
                        خروج از سیستم
                    </button>
                </div>
            </form>

        </nav>
    </aside>

    <!-- Main Content Area -->
    <main class="main-content">
        @yield('content')
    </main>
</div>

</body>
</html>

