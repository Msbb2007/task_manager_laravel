@extends('layouts.admin.admin-layout')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/categories.css') }}">
@endpush

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="category-card">
                    <div class="category-card-header">
                        <h4 class="mb-0">افزودن دسته بندی جدید</h4>
                    </div>
                    <div class="category-card-body">
                        <form action="{{ route('admin.categories.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">نام دسته بندی</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                       placeholder="مثلاً: برنامه‌نویسی، شخصی، کاری..." value="{{ old('name') }}">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">رنگ نمایش (Hex Code)</label>
                                <div class="d-flex gap-2">
                                    <input type="color" name="color" class="form-control form-control-color"
                                           value="{{ old('color', '#6c757d') }}" title="انتخاب رنگ">
                                    <input type="text" name="color_text" class="form-control" placeholder="#6c757d" value="{{ old('color') }}">
                                </div>
                                <small class="text-muted">این رنگ در کنار نام دسته بندی در لیست تسک‌ها نمایش داده می‌شود.</small>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-save">
                                    <i class="fas fa-save"></i> ذخیره دسته بندی
                                </button>
                                <a href="{{ route('admin.categories') }}" class="btn btn-light">انصراف</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
