@extends('layouts.admin.admin-layout')

@section('title', 'لیست کاربران')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/users.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/tasks.css') }}">
@endpush

@section('content')
    <div class="user-container">
        <div class="page-header d-flex justify-content-between align-items-center">
            <div>
                <h2>مدیریت کاربران</h2>
                <p>در این بخش می‌توانید کاربران را مشاهده و اطلاعات آن ها را ویرایش کنید.</p>
            </div>
            <a href="{{ route('admin.users.create') }}" class="btn-assign-new">
                <i class="fas fa-plus-circle"></i>   ایجاد کاربر جدید
            </a>
        </div>

        <form action="{{ route('admin.users') }}" method="GET" class="d-flex gap-2 mb-3">
            <input
                type="search"
                name="search"
                class="form-control"
                placeholder="جست‌وجو با نام یا ایمیل..."
                value="{{ request('search') }}"
            >

            <button type="submit" class="btn btn-primary">جست‌وجو</button>

            @if(request('search'))
                <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary">
                    پاک‌کردن
                </a>
            @endif
        </form>

        <x-alert/>

        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th>نام کاربر</th>
                    <th>ایمیل</th>
                    <th>نقش کاربر</th>
                    <th>تاریخ عضویت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="role-badge {{ $user->role }}">
                                @if($user->role=='admin')
                                    {{'مدیر سیستم'}}
                                @elseif($user->role=='editor')
                                    {{'ادمین محتوا'}}
                                @else
                                    {{' کاربر عادی'}}
                                @endif
                            </span>
                        </td>
                        <td>{{ $user->created_at->format('Y/m/d') }}</td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-assign">
                                ویرایش
                            </a>
                            <form action="{{ route('admin.users.soft', $user->id) }}" method="POST" onsubmit="return confirm('آیا از حذف این کاربر اطمینان دارید؟');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">حذف</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection


