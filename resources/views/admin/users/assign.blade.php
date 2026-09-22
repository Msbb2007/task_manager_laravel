@extends('layouts.admin.admin-layout')

@section('title', 'تخصیص تسک جدید')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/users.css') }}">
@endpush

@section('content')
<div class="user-container">
    <div class="mb-3">
        <a href="{{ route('admin.task_user.showTasks',$user->id) }}" class="btn-back">
            <i class="fas fa-arrow-right"></i> بازگشت به لیست تسک های کاربر
        </a>
    </div>
    <div class="page-header">
        <h2>تخصیص تسک به: {{ $user->name }}</h2>
        <p>از لیست زیر، تسک‌هایی که کاربر هنوز به آن‌ها دسترسی ندارد را انتخاب کنید.</p>
    </div>

    <form action="{{ route('admin.task_user.assignTask.store', $user->id) }}" method="POST" class="assign-form">
        @csrf
        <div class="form-group">
            <label for="task_id">انتخاب تسک:</label>
            <select name="task_id" id="task_id" class="custom-select" required>
                <option value="" disabled selected>-- یک تسک را انتخاب کنید --</option>
                @foreach($availableTasks as $task)
                <option value="{{ $task->id }}">
                    {{ $task->title }} ({{ $task->category->name }})
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.task_user.showTasks', $user->id) }}" class="btn-cancel">انصراف</a>
            <button type="submit" class="btn-submit">تایید و ثبت تخصیص</button>
        </div>
    </form>
</div>
@endsection
