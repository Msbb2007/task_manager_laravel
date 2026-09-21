@extends('layouts.admin.admin-layout')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/tasks.css') }}">
@endpush

@section('content')
    <div class="container-custom">
        <div class="card-custom">
            <div class="card-header-custom">
                <h2>ویرایش تسک: {{ $task->title }}</h2>
            </div>

            <div class="card-body-custom">
                <form action="{{ route('admin.tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- نمایش کلی ارورها --}}
                    <x-alert/>

                    <div class="form-group-custom">
                        <label class="label-custom">عنوان تسک</label>
                        <input type="text" name="title"
                               class="input-custom @error('title') is-invalid @enderror"
                               value="{{ old('title', $task->title) }}">
                        @error('title') <span class="error-text">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group-custom">
                        <label class="label-custom">دسته بندی</label>
                        <select name="category_id" class="select-custom @error('category_id') is-invalid @enderror">
                            <option value="">انتخاب کنید...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $task->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="error-text">{{ $message }}</span> @enderror
                    </div>


                    <div class="row-custom">
                        <div class="col-custom">
                            <div class="form-group-custom">
                                <label class="label-custom">اولویت</label>
                                <select name="priority" class="select-custom @error('priority') is-invalid @enderror">
                                    <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>کم</option>
                                    <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>متوسط</option>
                                    <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>زیاد</option>
                                </select>
                                @error('priority') <span class="error-text">{{ $message }}</span > @enderror
                            </div>
                        </div>

                        <div class="col-custom">
                            <div class="form-group-custom">
                                <label class="label-custom">وضعیت</label>
                                <select name="status" class="select-custom @error('status') is-invalid @enderror">
                                    <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>در انتظار</option>
                                    <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>در حال انجام</option>
                                    <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>انجام شده</option>
                                </select>
                                @error('status') <span class="error-text">{{ $message }}</span > @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group-custom">
                        <label class="label-custom">تاریخ مهلت (Due Date)</label>
                        <input type="date" name="due_date" class="input-custom @error('due_date') is-invalid @enderror"
                               value="{{ old('due_date', $task->due_date ? date('Y-m-d', strtotime($task->due_date)) : '') }}">
                        @error('due_date') <span class="error-text">{{ $message }}</span > @enderror
                    </div>

                    <div class="form-group-custom">
                        <label class="label-custom">توضیحات</label>
                        <textarea name="description" rows="5"
                                  class="textarea-custom @error('description') is-invalid @enderror">{{ old('description', $task->description) }}</textarea>
                        @error('description') <span class="error-text">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-actions-custom">
                        <button type="submit" class="btn-save">بروزرسانی</button>
                        <a href="{{ route('admin.tasks') }}" class="btn-cancel">انصراف</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
