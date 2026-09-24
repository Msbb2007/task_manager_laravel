@extends('layouts.user.userLayout')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-history text-secondary"></i> تاریخچه تسک‌ها</h2>
            <a href="{{ route('user.tasks') }}" class="btn btn-outline-primary btn-sm">
                <i class="fas fa-arrow-left"></i> بازگشت به لیست جاری
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                    <tr>
                        <th>عنوان تسک</th>
                        <th>وضعیت</th>
                        <th> وضعیت تسک کاربر</th>
                        <th>تاریخ ایجاد</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($archivedTasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>
                                <span class="badge bg-info text-dark">
                                    {{ $task->status }}
                                </span>
                            </td>
                            <td>
                                <span class="badge  text-dark">
                                    @if($task->pivot->state_of_this_task_user=='completed')
                                        انجام یافت
                                    @else
                                        انجام نیافت
                                    @endif
                                </span>
                            </td>
                            <td>{{ $task->created_at->format('Y/m/d') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-muted">
                                هیچ تسک مخفی شده‌ای در تاریخچه وجود ندارد.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3 d-flex justify-content-center">
            {{ $archivedTasks->links() }}
        </div>
    </div>
@endsection

