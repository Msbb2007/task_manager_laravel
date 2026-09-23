<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'پنل کاربری') | Task Manager</title>

    <!-- Bootstrap 5 RTL -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Vazirmatn Font (Assuming you have it or using a web font) -->
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet" type="text/css" />

    @stack('styles')

    <style>
        body { font-family: 'Vazirmatn', sans-serif; background-color: #f4f7f6; }

        /* Sidebar Style */
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            min-height: 100vh;
            background: #2c3e50;
            color: #fff;
            transition: all 0.3s;
        }
        #sidebar .sidebar-header { padding: 20px; background: #1a252f; text-align: center; }
        #sidebar ul.components { padding: 20px 0; }
        #sidebar ul li a {
            padding: 15px 25px;
            display: block;
            color: #bdc3c7;
            text-decoration: none;
        }
        #sidebar ul li a:hover { background: #34495e; color: #fff; }
        #sidebar ul li.active > a { color: #fff; background: #3498db; }

        /* Content Style */
        #content { width: 100%; }
        .navbar { background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }

        .stat-card {
            border: none;
            border-radius: 10px;
            transition: transform 0.3s;
        }
        .stat-card:hover { transform: translateY(-5px); }
    </style>
    @yield('extra_css')
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h4>پنل کاربری</h4>
            <small>خوش آمدی، {{ Auth::user()->name ?? '' }}</small>
        </div>

        <ul class="list-unstyled components">
            <li class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                <a href="{{ route('user.dashboard') }}"><i class="fas fa-home me-2"></i> داشبورد</a>
            </li>
            <li class="{{ request()->routeIs('user.tasks') ? 'active' : '' }}">
                <a href="{{ route('user.tasks') }}"><i class="fas fa-tasks me-2"></i> تسک‌های من</a>
            </li>
            <li class="{{ request()->routeIs('user.profile') ? 'active' : '' }}">
                <a href="{{ route('user.profile') }}"><i class="fas fa-tasks me-2"></i> پروفایل</a>
            </li>
            <hr>
            <li>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-lg border-0">
                        <i class="fas fa-sign-out-alt me-1"></i> خروج
                    </button>
                </form>
            </li>
        </ul>
    </nav>

    <!-- Main Content Area -->
    <div id="content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light px-4 py-3">
            <div class="container-fluid">
                <div class="ms-auto d-flex align-items-center">
                    <span class="me-3 d-none d-md-inline">{{ Auth::user()->name ?? 'کاربر' }}</span>
                    <a href="{{route('user.profile')}}"><i class="fas fa-user-circle fa-2x me-2"></i></a>

                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="container-fluid p-4">
            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('extra_js')
</body>
</html>

