@extends('layouts.admin.admin-layout')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/users.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/tasks.css') }}">
@endpush

@section('content')
    <div class="container-custom">
        <div class="card-custom">
            <div class="card-header-custom">
                <h2>کاربران حذف شده (سطل زباله)</h2>
            </div>

            <div class="card-body-custom">
                @if($deleted_users->isEmpty())
                    <p style="text-align: center;">هیچ کاربری در سطل زباله نیست.</p>
                @else
                    <table class="admin-table">
                        <thead>
                        <tr>
                            <th>نام</th>
                            <th>نام خانوادگی</th>
                            <th>ایمیل</th>
                            <th>تاریخ حذف</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($deleted_users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->family }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->deleted_at ? $user->deleted_at->diffForHumans() : '---' }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <form action="{{ route('admin.users.restore', $user->id) }}" method="post" style="display:inline;">
                                            @method('PUT')
                                            @csrf
                                            <button type="submit" class="btn-cancel" title="بازیابی">
                                                بازیابی
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.users.force_delete', $user->id) }}" method="POST" onsubmit="return confirm('هشدار! این کاربر برای همیشه حذف خواهد شد. آیا مطمئن هستید؟');" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn-hard-delete" title="حذف قطعی">
                                                حذف از دیتابیس
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection

