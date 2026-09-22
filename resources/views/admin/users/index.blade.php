@extends('layouts.admin.admin-layout')

@section('title', 'لیست کاربران')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/users.css') }}">
@endpush

@section('content')
    <div class="user-container">
        <div class="page-header">
            <h2>مدیریت کاربران</h2>
            <p>در این بخش می‌توانید کاربران را مشاهده و به آن‌ها تسک اختصاص دهید.</p>
        </div>

        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th>نام کاربر</th>
                    <th>ایمیل</th>
                    <th>تاریخ عضویت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    @csrf
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('Y/m/d') }}</td>
                        <td>
                            <a href="{{ route('admin.task_user.showTasks', $user->id) }}" class="btn-assign">
                                تسک ها
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

