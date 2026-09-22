@extends('layouts.admin.admin-layout')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/trash.css') }}">
@endpush

@section('content')

    <div class="container mt-5">
        <div class="trash-container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="trash-header"><i class="fas fa-trash-alt"></i> سطل زباله تسک‌ها</h2>
                <a href="{{ route('admin.tasks') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> بازگشت به لیست تسک ها
                </a>
            </div>

            <x-alert/>

            <div class="table-responsive">
                <table class="table table-hover table-trash align-middle">
                    <thead class="table-dark">
                    <tr>
                        <th>عنوان تسک</th>
                        <th>تاریخ حذف</th>
                        <th class="text-center">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($tasks as $task)
                        <tr class="task-is-deleted">
                            <td>
                                <strong>{{ $task->title }}</strong>
                            </td>
                            <td>
                                <small class="text-muted">{{ $task->deleted_at->format('Y/m/d H:i') }}</small>
                            </td>
                            <td class="text-center">
                                <!-- دکمه بازیابی -->
                                <form action="{{ route('admin.tasks.restore', $task->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-restore btn-sm shadow-sm" title="بازیابی تسک">
                                        <i class="fas fa-undo"></i> بازیابی
                                    </button>
                                </form>

                                <!-- دکمه حذف قطعی -->
                                <form action="{{ route('admin.tasks.forceDelete', $task->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-force-delete btn-sm shadow-sm" onclick="return confirm(' این عمل غیرقابل بازگشت است! آیا مطمئن هستید؟')" title="حذف همیشگی">
                                        <i class="fas fa-exclamation-triangle"></i> حذف قطعی
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="fas fa-folder-open fa-3x mb-3"></i><br>
                                سطل زباله خالی است.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
