@extends('layouts.admin.admin-layout')

@section('title', 'داشبورد اصلی ادمین')

@section('content')
    <header style="margin-bottom: 30px;">
        <h1>خوش آمدید، {{ auth()->user()->name.auth()->user()->family }}</h1>
        <p>خلاصه‌ای از وضعیت سیستم در یک نگاه</p>
    </header>

    <!-- بخش کارت‌های آماری با استفاده از کامپوننت -->
    <div class="stats-grid">
        <x-card title="تسک‌های فعال" value="">
            <span style="color: var(--admin-success);"></span>
        </x-card>

        <x-card title="کاربران جدید" value="">
            <span style="color: var(--admin-success);"></span>
        </x-card>

        <x-card title="تسک‌های تکمیل شده" value="">
            <span></span>
        </x-card>

    </div>

    <!-- بخش پایین داشبورد -->
    <div style="background: white; padding: 20px; border-radius: 12px; min-height: 200px;">
        <h3>آخرین فعالیت‌ها</h3>
        <p style="color: #7f8c8d;">هنوز فعالیتی ثبت نشده است.</p>
    </div>
@endsection

