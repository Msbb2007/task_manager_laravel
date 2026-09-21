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
                        <h4 class="mb-0">ویرایش دسته بندی</h4>
                    </div>
                    <div class="category-card-body">
                        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">نام دسته بندی</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name', $category->name) }}">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">رنگ نمایش</label>
                                <div class="d-flex gap-2">
                                    <input type="color" name="color" class="form-control form-control-color"
                                           value="{{ old('color', $category->color) }}">
                                    <input type="text" name="color_text" class="form-control"
                                           value="{{ old('color', $category->color) }}">
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-update">
                                    <i class="fas fa-sync"></i> بروزرسانی تغییرات
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
