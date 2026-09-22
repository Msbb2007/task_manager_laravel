@extends('layouts.admin.admin-layout')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/tasks.css') }}">
@endpush

@section('content')
    <div class="container">
        <div class="card shadow task-form-card">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">ایجاد تسک جدید</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.tasks.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <!-- عنوان -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">عنوان تسک</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- دسته بندی -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">دسته بندی</label>
                            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                <option value="">انتخاب کنید...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- وضعیت -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">وضعیت</label>
                            <select name="status" class="form-control  @error('status') is-invalid @enderror">
                                <option value="pending">در انتظار</option>
                                <option value="in_progress">در حال انجام</option>
                                <option value="completed">تکمیل شده</option>
                            </select>
                        </div>

                        <!-- اولویت -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">اولویت</label>
                            <select name="priority" class="form-control @error('priority') is-invalid @enderror">
                                <option value="low">کم</option>
                                <option value="medium">متوسط</option>
                                <option value="high">زیاد</option>
                            </select>
                        </div>

                        <!-- تاریخ -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">تاریخ انجام</label>
                            <input type="date" name="due_date" class="form-control @error('due_date') is-invalid @enderror" value="{{ old('due_date') }}">
                        </div>

                        <!-- توضیحات -->
                        <div class="col-12 mb-3">
                            <label class="form-label">توضیحات</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description') }}</textarea>

                            @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                    </div>

                    <div class="text-left mt-3">
                        <button type="submit" class="btn btn-success btn-save">ذخیره تسک</button>
                        <a href="{{ route('admin.tasks') }}" class="btn btn-secondary">انصراف</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
