@extends('layouts.admin.admin-layout')

@section('title', 'داشبورد اصلی ادمین')

@section('content')
    <header style="margin-bottom: 30px;">
        <h1>خوش آمدید، {{ auth()->user()->name }} {{ auth()->user()->family }}</h1>
        <p>خلاصه‌ای از وضعیت سیستم در یک نگاه</p>
    </header>

    <!-- بخش کارت‌های آماری -->
    <div class="stats-grid">
        <x-card title="تسک‌های فعال" value="{{ $activeTasksCount }}">
            <span style="color: #f39c12;">{{ $activeTasksCount }} مورد در جریان</span>
        </x-card>

        <x-card title="کاربران جدید" value="{{ $newUsersCount }}">
            <span style="color: #27ae60;">در ۳۰ روز اخیر</span>
        </x-card>

        <x-card title="تسک‌های تکمیل شده" value="{{ $completedTasksCount }}">
            <span style="color: #2980b9;">مجموع تسک‌های پایان یافته</span>
        </x-card>
    </div>

    <!-- بخش پایین داشبورد -->
    <div style="background: white; padding: 25px; border-radius: 12px; min-height: 200px; margin-top: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
        <h3 style="margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px;">آخرین فعالیت‌ها</h3>
    </div>
@endsection
