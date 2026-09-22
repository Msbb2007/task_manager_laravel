@extends('layouts.admin.admin-layout')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/tasks.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/users.css') }}">
@endpush

@section('content')
    <div class="container-custom">
        <div class="card-custom">
            <div class="card-header-custom">
                <h2>ویرایش پروفایل شما  </h2>
            </div>

            <div class="card-body-custom">
                <form action="{{ route('admin.users.updateProfile', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- نمایش کلی ارورها --}}
                    <x-alert/>

                    {{-- فیلد نام --}}
                    <div class="form-group-custom">
                        <label class="label-custom">نام</label>
                        <input type="text" name="name"
                               class="input-custom @error('name') is-invalid @enderror"
                               value="{{ old('name', $user->name) }}">
                        @error('name') <span class="error-text">{{ $message }}</span> @enderror
                    </div>

                    {{-- فیلد نام خانوادگی --}}
                    <div class="form-group-custom">
                        <label class="label-custom">نام خانوادگی</label>
                        <input type="text" name="family"
                               class="input-custom @error('family') is-invalid @enderror"
                               value="{{ old('family', $user->family) }}">
                        @error('family') <span class="error-text">{{ $message }}</span> @enderror
                    </div>

                    {{-- فیلد ایمیل  --}}
                    <div class="form-group-custom">
                        <label class="label-custom">ایمیل</label>
                        <input type="email" name="email"
                               class="input-custom "
                               value="{{ $user->email }}">
                        @error('email') <span class="error-text">{{ $message }}</span> @enderror
                    </div>

                    {{-- فیلد پسورد --}}
                    <div class="form-group-custom">
                        <label class="label-custom">رمز عبور</label>
                        <input type="password" name="password"
                               class="input-custom " placeholder="اگر نمی‌خواهید تغییر کند، خالی بگذارید">
                        @error('password') <span class="error-text">{{ $message }}</span> @enderror
                    </div>

                    {{-- فیلد نقش کاربر (فقط نمایش) --}}
                    <div class="form-group-custom">
                        <label class="label-custom">نقش کاربر</label>
                        <input type="text"
                               class="input-custom disabled-input"
                               value="{{ $user->role }}" readonly>
                        @error('role') <span class="error-text">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-actions-custom">
                        <button type="submit" class="btn-save">بروزرسانی پروفایل</button>
                        <a href="{{ route('admin.dashboard') }}" class="btn-cancel">انصراف</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
