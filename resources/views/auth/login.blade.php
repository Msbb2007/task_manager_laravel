@extends('layouts.master')

@section('title', 'ورود به سیستم')

@section('content')
    <div class="auth-container">
        <div class="auth-card">
            <h2>ورود به حساب کاربری</h2>

            {{--components/alert --}}
            <x-alert />

            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email">ایمیل:</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="password">رمز عبور:</label>
                    <input type="password" id="password" name="password" >
                </div>

                <button type="submit" class="btn-submit">ورود</button>
            </form>

            <p class="auth-footer-text">
                حساب کاربری ندارید؟ <a href="{{ route('register') }}">ثبت‌نام کن</a>
            </p>
        </div>
    </div>
@endsection

