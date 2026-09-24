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

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <!-- کارت نامه (Document Card) -->
                <div class="card border-0 shadow-lg border-start border-4 @if($task->priority == 'high') border-danger @else border-primary @endif">
                    <div class="card-body p-5">

                        <!-- هدر نامه -->
                        <div class="text-center mb-5">
                            <h1 class="fw-bold text-dark">{{ $task->title }}</h1>
                            <div class="d-flex justify-content-center gap-2 mt-2">
                            <span class="badge @if($task->status == 'completed') bg-success @else bg-warning text-dark @endif px-3">
                                @if($task->status == 'completed')
                                    تکمیل شده
                                @elseif($task->status == 'in_progress')
                                    در جریان
                                @endif
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
                                        <span class="text-dark">
                                            @if($task->status == 'in_progress')
                                                <form action="{{ route('user.tasks.status', $task) }}" method="POST">
                                                     @csrf
                                                    @method('PATCH')

                                                    <select name="new_status" class="form-select form-select-sm" required>

                                                     <option value="in_progress" @selected($task->pivot->state_of_this_task_user === 'in_progress')>⏳ در جریان</option>
                                                     <option value="completed" @selected($task->pivot->state_of_this_task_user === 'completed')>✅ تکمیل شد</option>

                                                    </select>

                                                    <button type="submit" class="btn btn-sm btn-primary mt-1">
                                                         تغییر وضعیت
                                                    </button>
                                                </form>
                                            @else
                                                @if($task->pivot->state_of_this_task_user=='in_progress')
                                                    انجام نیافت
                                                @else
                                                    ✅انجام یافته
                                                @endif
                                            @endif
                                        </span>
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
