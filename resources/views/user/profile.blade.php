@extends('layouts.user.userLayout')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/users.css') }}">
@endpush


@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <x-alert/>

                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-primary text-white text-center py-4">
                        <i class="fas fa-user-circle fa-4x mb-3"></i>
                        <h3 class="mb-0">تنظیمات پروفایل</h3>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('user.profile.update') }}" method="POST">
                            @csrf

                            <!-- نام -->
                            <div class="mb-4">
                                <label class="form-label fw-bold text-secondary">نام </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-user text-muted"></i></span>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name', $user->name) }}">
                                </div>
                                @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold text-secondary">نام خانوادگی</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-user text-muted"></i></span>
                                    <input type="text" name="family" class="form-control @error('family') is-invalid @enderror"
                                           value="{{ old('family', $user->family) }}">
                                </div>
                                @error('family')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- ایمیل -->
                            <div class="mb-4">
                                <label class="form-label fw-bold text-secondary">ایمیل</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-envelope text-muted"></i></span>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                           value="{{ old('email', $user->email) }}" >
                                </div>
                                @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- رمز عبور جدید (اختیاری) -->
                            <div class="mb-4">
                                <label class="form-label fw-bold text-secondary">رمز عبور جدید (ترجیحاً خالی بگذارید)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-lock text-muted"></i></span>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="اگر می‌خواهید تغییر کند، وارد کنید">
                                </div>
                                <div class="form-text text-muted small">اگر رمز عبور را وارد نکنید، رمز قبلی حفظ می‌شود.</div>
                                @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold text-secondary">تکرار رمز عبور</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-check-double text-muted"></i></span>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>
                            </div>



                            <hr class="my-4 opacity-25">

                            <!-- دکمه ذخیره-->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save me-2"></i> ذخیره تغییرات
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="mt-4 text-center">
                    <p class="text-muted small">
                        <i class="fas fa-shield-alt me-1"></i>  عضو از: {{ $user->created_at->format('Y/m/d') }}
                    </p>
                </div>

            </div>
        </div>
    </div>
@endsection
