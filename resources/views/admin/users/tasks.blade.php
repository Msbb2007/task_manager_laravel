@extends('layouts.admin.admin-layout')

@section('title', 'تسک‌های کاربر: ' . $user->name)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/users.css') }}">
@endpush

@section('content')
    <div class="user-container">
        <div class="mb-3">
            <a href="{{ route('admin.task_user',$user->id) }}" class="btn-back">
                <i class="fas fa-arrow-right"></i> بازگشت به لیست کاربران
            </a>
        </div>

        <div class="page-header d-flex justify-content-between align-items-center">
            <div>
                <h2>تسک‌های کاربر: {{ $user->name }}</h2>
                <p class="text-muted">لیست تمام وظایف اختصاص یافته به این کاربر</p>
            </div>
            <a href="{{ route('admin.task_user.assignTask', $user->id) }}" class="btn-assign-new">
                <i class="fas fa-plus-circle"></i> تخصیص تسک جدید
            </a>
        </div>

        <form action="{{ route('admin.task_user.showTasks',$user->id) }}" method="GET" class="d-flex gap-2 mb-3">
            <input
                type="search"
                name="search"
                class="form-control"
                placeholder="جست‌وجو با عنوان یا توضیخات تسک..."
                value="{{ request('search') }}"
            >

            <button type="submit" class="btn btn-primary">جست‌وجو</button>

            @if(request('search'))
                <a href="{{ route('admin.task_user.showTasks',$user->id) }}" class="btn btn-outline-secondary">
                    پاک‌کردن
                </a>
            @endif
        </form>

        <x-alert/>

        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                <tr>
                    <th>عنوان تسک</th>
                    <th>دسته بندی</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @forelse($userTasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>
                        <span class="badge" style="background-color: {{ $task->category->color ?? '#6c757d' }};">
                            {{ $task->category->name }}
                        </span>
                        </td>
                        <td>
                        <span class="status-badge {{ $task->status }}">
                            @if($task->status=='in_progress')
                                {{'در حال انجام'}}
                            @elseif($task->status=='pending')
                                {{'در انتظار'}}
                            @else
                                {{'تکمیل شده'}}
                            @endif
                        </span>
                        </td>
                        <td>
                            <form action="{{ route('admin.users.detach', $user->id) }}" method="POST" onsubmit="return confirm('آیا از قطع ارتباط این تسک با کاربر مطمئن هستید؟')">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="task_id" value="{{ $task->id }}">
                                <button type="submit" class="btn-detach">
                                    <i class="fas fa-unlink"></i> قطع ارتباط
                                </button>
                            </form>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">هیچ تسکی برای این کاربر یافت نشد.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            {{ $userTasks->links() }}
        </div>
    </div>
@endsection
