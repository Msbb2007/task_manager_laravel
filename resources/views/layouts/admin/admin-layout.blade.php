<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'پنل مدیریت')</title>
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100;400;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="admin-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <h2>پنل مدیریت</h2>
        <nav>
            <a href="{{route('admin.dashboard')}}" class="nav-link active">داشبورد</a>
            <a href="/admin/tasks" class="nav-link">مدیریت تسک‌ها</a>
            <a href="/admin/tasks" class="nav-link">انتصاب تسک</a>

            {{-- سایدبار اختصاصی ادمین اصلی (Admin) با استفاده از Gate --}}
            @can('access-admin-panel')
                <div style="margin-top: 20px; font-size: 0.8rem; color: #7f8c8d;">مدیریت سیستم</div>
                <a href="" class="nav-link">مدیریت کاربران</a>
                <a href="" class="nav-link">ساخت کاربر جدید</a>
                <a href="" class="nav-link">دسته بندی ها</a>
            @endcan

            <div style="margin-top: 20px; border-top: 1px solid #3e4f5f; padding-top: 10px;">
                <a href="{{route('logout')}}" class="nav-link" style="color: #e74c3c;">خروج</a>
            </div>
        </nav>
    </aside>

    <!-- Main Content Area -->
    <main class="main-content">
        @yield('content')
    </main>
</div>

</body>
</html>

