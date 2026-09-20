@extends('layouts.master')

@section('title', 'ثبت‌نام')

@section('content')
    <main class="auth-page">
        <section class="auth-card" aria-labelledby="register-title">

            <div class="auth-header">
                <div class="auth-logo">TM</div>

                <h1 id="register-title">ایجاد حساب کاربری</h1>
                <p>برای شروع کار با Task Manager ثبت‌نام کنید</p>
            </div>

            {{--components/alert --}}
            <x-alert />

            <form action="{{ route('register.post') }}" method="POST" class="auth-form">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label for="name">نام</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control @error('name') input-error @enderror"
                            value="{{ old('name') }}"
                            placeholder="نام خود را وارد کنید"
                            autocomplete="given-name"
                        >
                    </div>

                    <div class="form-group">
                        <label for="family">نام خانوادگی</label>
                        <input
                            type="text"
                            id="family"
                            name="family"
                            class="form-control @error('family') input-error @enderror"
                            value="{{ old('family') }}"
                            placeholder="نام خانوادگی خود را وارد کنید"
                            autocomplete="family-name"
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">ایمیل</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control @error('email') input-error @enderror"
                        value="{{ old('email') }}"
                        placeholder="example@gmail.com"
                        autocomplete="email"
                        dir="ltr"
                    >
                </div>

                <div class="form-group">
                    <label for="password">رمز عبور</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control @error('password') input-error @enderror"
                        placeholder="رمز عبور خود را وارد کنید"
                        autocomplete="new-password"
                    >
                </div>

                <div class="form-group">
                    <label for="password_confirmation">تکرار رمز عبور</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-control"
                        placeholder="رمز عبور را دوباره وارد کنید"
                        autocomplete="new-password"
                    >
                </div>

                <button type="submit" class="btn-submit">
                    ثبت‌نام
                </button>
            </form>

            <div class="auth-footer">
                قبلاً حساب ساخته‌اید؟
                <a href="{{ route('login')}}">ورود به حساب</a>
            </div>
        </section>
    </main>
@endsection
