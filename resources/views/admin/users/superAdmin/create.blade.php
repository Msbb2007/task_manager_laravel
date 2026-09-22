@extends('layouts.admin.admin-layout')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/users.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/tasks.css') }}">
@endpush

@section('content')
    <div class="container-custom">
        <div class="card-custom">
            <div class="card-header-custom">
                <h2>ایجاد کاربر جدید</h2>
            </div>

            <div class="card-body-custom">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <x-alert/>

                    <div class="form-group-custom">
                        <label class="label-custom">نام</label>
                        <input type="text" name="name" class="input-custom @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name') <span class="error-text">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group-custom">
                        <label class="label-custom">نام خانوادگی</label>
                        <input type="text" name="family" class="input-custom @error('family') is-invalid @enderror" value="{{ old('family') }}">
                        @error('family') <span class="error-text">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group-custom">
                        <label class="label-custom">ایمیل</label>
                        <input type="email" name="email" class="input-custom @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="example@mail.com">
                        @error('email') <span class="error-text">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group-custom">
                        <label class="label-custom">رمز عبور</label>
                        <input type="password" name="password" class="input-custom @error('password') is-invalid @enderror" placeholder="********">
                        @error('password') <span class="error-text">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group-custom">
                        <label class="label-custom">نقش کاربر</label>
                        <select name="role" class="select-custom @error('role') is-invalid @enderror">
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>کاربر</option>
                            <option value="editor" {{ old('role') == 'editor' ? 'selected' : '' }}>ادمین محتوا</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>مدیر کل</option>
                        </select>
                        @error('role') <span class="error-text">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-actions-custom">
                        <button type="submit" class="btn-save">ثبت کاربر جدید</button>
                        <a href="{{ route('admin.users') }}" class="btn-cancel">انصراف</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
