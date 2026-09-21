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

        <x-alert />

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
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>
                                    <span class="badge" style="background-color: {{ $task->category->color ?? '#6c757d' }};">
                                          {{ $task->category->name }}
                                    </span>
                                </td>
                                <td>
                                    <span class="priority-{{ $task->priority }}">
                                        {{ $task->priority }}
                                    </span>
                                </td>
                                <td>{{ $task->status }}</td>
                                <td>{{ $task->due_date }}</td>
                                <td>
                                    <a href="{{ route('admin.tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">ویرایش</a>
                                </td>
                            </tr>
                        @endforeach
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
