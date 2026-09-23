@extends('layouts.user.userLayout')

@section('title', $task->title)

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8"> <!-- عرض کمتر برای اینکه شبیه نامه وسط صفحه باشه -->

                <!-- دکمه بازگشت -->
                <div class="mb-4">
                    <a href="{{ route('user.dashboard') }}" class="text-decoration-none text-muted">
                        <i class="fas fa-arrow-left me-1"></i> بازگشت به لیست
                    </a>
                </div>

                <!-- کارت نامه (Document Card) -->
                <div class="card border-0 shadow-lg border-start border-4 @if($task->priority == 'high') border-danger @else border-primary @endif">
                    <div class="card-body p-5">

                        <!-- هدر نامه -->
                        <div class="text-center mb-5">
                            <h1 class="fw-bold text-dark">{{ $task->title }}</h1>
                            <div class="d-flex justify-content-center gap-2 mt-2">
                            <span class="badge {{ $task->is_completed ? 'bg-success' : 'bg-warning text-dark' }} px-3">
                                {{ $task->is_completed ? 'تکمیل شده' : 'در جریان' }}
                            </div>
                        </div>

                        <hr class="my-4 opacity-10">

                        <!-- محتوای اصلی نامه -->
                        <div class="task-details">
                            <div class="mb-4">
                                <label class="text-muted small d-block mb-2">شرح تسک:</label>
                                <p class="fs-5 text-dark" style="line-height: 1.8;">
                                    {{ $task->description ?? 'متنی برای این تسک ثبت نشده است.' }}
                                </p>
                            </div>

                            <div class="row mt-5 pt-4 border-top">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="text-muted small d-block">تاریخ ایجاد:</label>
                                        <span class="fw-bold">{{ $task->created_at->format('Y/m/d')}}</span>
                                    </div>
                                    <div class="mb-3">
                                        <label class="text-muted small d-block">تاریخ ددلاین:</label>
                                        <span class="fw-bold">{{ $task->due_date->format('Y/m/d') }}</span>
                                    </div>
                                    <div>
                                        <label class="text-muted small d-block">اولویت:</label>
                                        <span class="{{ $task->priority == 'high' ? 'text-danger' : 'text-primary' }} fw-bold">
                                        {{ $task->priority == 'high' ? 'بسیار بالا' : 'معمولی' }}
                                    </span>
                                    </div>
                                </div>
                                <div class="col-6 text-end">
                                    <div class="mb-3">
                                        <label class="text-muted small d-block">دسته‌بندی:</label>
                                        <span class="badge bg-light text-dark border">{{ $task->category->name ?? 'بدون دسته‌بندی' }}</span>
                                    </div>
                                    <div>
                                        <label class="text-muted small d-block">وضعیت نهایی:</label>
                                        <span class="text-dark">{{ $task->is_completed ? '✅ انجام شد' : '⏳ در جریان' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- فوتر نامه (لینک‌های عملیاتی غیر ویرایشی) -->
                <div class="text-center mt-4">
                    <p class="text-muted small italic">این گزارش به صورت خودکار تولید شده و قابل ویرایش نیست.</p>
                </div>

            </div>
        </div>
    </div>

    <style>
        body {
            background-color: #f8f9fa; /* پس‌زمینه خاکستری روشن برای اینکه کارت سفید بدرخشد */
        }
        .card {
            border-radius: 15px; /* لبه‌های گردتر برای زیبایی بیشتر */
        }
    </style>
@endsection
