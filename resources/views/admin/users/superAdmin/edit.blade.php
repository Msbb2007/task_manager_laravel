@extends('layouts.admin.admin-layout')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/tasks.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/users.css') }}">
@endpush

@section('content')
    <div class="container-custom">
        <div class="card-custom">
            <div class="card-header-custom">
                <h2>ویرایش کاربر: {{ $user->name }} {{ $user->family }}</h2>
            </div>

            <div class="card-body-custom">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
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

                    {{-- فیلد ایمیل (نمایش فقط) --}}
                    <div class="form-group-custom">
                        <label class="label-custom">ایمیل (غیرقابل تغییر)</label>
                        <input type="email"
                               class="input-custom disabled-input"
                               value="{{ $user->email }}"
                               readonly>
                        <small class="help-text">برای تغییر ایمیل باید خود کاربر باید اقدام کند.</small>
                    </div>

                    {{-- فیلد پسورد (قفل شده) --}}
                    <div class="form-group-custom">
                        <label class="label-custom">رمز عبور</label>
                        <input type="password"
                               class="input-custom disabled-input"
                               value="********"
                               readonly>
                        <small class="help-text">برای تغییر پسورد خود کاربر باید اقدام کند.</small>
                    </div>

                    {{-- فیلد نقش کاربر (Select) --}}
                    <div class="form-group-custom">
                        <label class="label-custom">نقش کاربر (Role)</label>
                        <select name="role" class="select-custom @error('role') is-invalid @enderror">
                            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>کاربر (User)</option>
                            <option value="editor" {{ old('role', $user->role) == 'editor' ? 'selected' : '' }}>ادمین محتوا (Editor)</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>مدیر (Admin)</option>
                        </select>
                        @error('role') <span class="error-text">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-actions-custom">
                        <button type="submit" class="btn-save">بروزرسانی اطلاعات</button>
                        <a href="{{ route('admin.users') }}" class="btn-cancel">انصراف</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
