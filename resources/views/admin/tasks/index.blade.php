@extends('layouts.admin.admin-layout')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/tasks.css') }}">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 mb-0 text-gray-800">مدیریت تسک‌ها</h2>
            <a href="{{ route('admin.tasks.create') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus"></i> ایجاد تسک جدید
            </a>
        </div>

        <form action="{{ route('admin.tasks') }}" method="GET" class="d-flex gap-2 mb-4">
            <input
                type="search"
                name="search"
                class="form-control"
                placeholder="جست‌وجو بین عنوان یا توضیحات..."
                value="{{ request('search') }}"
            >
            <button type="submit" class="btn btn-primary">جست‌وجو</button>
            @if(request('search'))
                <a href="{{ route('admin.tasks') }}" class="btn btn-outline-secondary">پاک‌کردن</a>
            @endif
        </form>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-task">
                        <thead>
                        <tr>
                            <th>عنوان</th>
                            <th>دسته بندی</th>
                            <th>اولویت</th>
                            <th>وضعیت</th>
                            <th>تاریخ انجام</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($tasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>
                                    <span class="badge" style="background-color: {{ $task->category->color ?? '#6c757d' }};">
                                        {{ $task->category->name }}
                                    </span>
                                </td>
                                <td class="priority-{{ $task->priority }}">
                                    {{ $task->priority }}
                                </td>
                                <td>
                                    <span class="status-badge {{ $task->status }}">
                                        @if($task->status == 'in_progress')
                                            در حال انجام
                                        @elseif($task->status == 'pending')
                                            در انتظار
                                        @else
                                            تکمیل شده
                                        @endif
                                    </span>
                                </td>
                                <td>{{ $task->due_date }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">ویرایش</a>

                                        <form action="{{ route('admin.tasks.softDelete', $task->id) }}" method="POST" onsubmit="return confirm('آیا مطمئن هستید؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn_warning" onclick="return confirm('آیا مطمئن هستید؟')">
                                                حذف
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">هیچ تسکی یافت نشد.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- صفحه‌بندی -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $tasks->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
