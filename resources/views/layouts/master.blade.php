<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    @include('partials.head')
</head>
<body>
<header>
    {{--components/navbar --}}
    <x-navbar/>
</header>

<main class="container">
    @yield('content')
</main>

</body>
</html>

