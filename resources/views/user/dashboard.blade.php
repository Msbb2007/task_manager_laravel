@extends('layouts.user.userLayout')

@section('title', 'داشبورد')

@section('content')
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card stat-card bg-primary text-white shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">کل تسک‌ها</h6>
                            <h2 class="mb-0">{{ $stats['total'] }}</h2>
                        </div>
                        <i class="fas fa-list fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card bg-success text-white shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">تکمیل شده</h6>
                            <h2 class="mb-0">{{ $stats['completed'] }}</h2>
                        </div>
                        <i class="fas fa-check-circle fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card bg-warning text-dark shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">در جریان</h6>
                            <h2 class="mb-0">{{ $stats['in_progress'] }}</h2>
                        </div>
                        <i class="fas fa-spinner fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card bg-danger text-white shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">اولویت بالا</h6>
                            <h2 class="mb-0">{{ $stats['high_priority'] }}</h2>
                        </div>
                        <i class="fas fa-exclamation-circle fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-clock text-primary me-2"></i> آخرین فعالیت‌ها</h5>
            <a href="{{ route('user.tasks') }}" class="btn btn-sm btn-outline-primary">مشاهده همه</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                    <tr>
                        <th class="ps-4">عنوان تسک</th>
                        <th>اولویت</th>
                        <th>وضعیت</th>
                        <th class="text-center">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($recentTasks as $task)
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold">{{ $task->title }}</div>
                                <small class="text-muted">{{ $task->created_at->format('Y/m/d') }}</small>
                            </td>
                            <td>
                                @if($task->priority == 'high')
                                    <span class="badge bg-danger">بالا</span>
                                @else
                                    <span class="badge bg-info">معمولی</span>
                                @endif
                            </td>
                            <td class="align-middle">
                                 <span class="badge @if($task->status == 'completed') bg-success @elseif($task->status == 'in_progress') bg-warning text-dark @else bg-secondary @endif">
                                      @if($task->status == 'completed')
                                              تکمیل شده
                                      @elseif($task->status == 'in_progress')
                                             در حال انجام
                                     @else
                                             در انتظار
                                     @endif
                                 </span>
                            </td>

                            <td class="text-center">
                                @if(!($task->status == 'pending'))
                                    <a href="{{ route('user.task.show',$task) }}" class="btn btn-sm btn-light border">
                                        <i class="fas fa-eye"></i> مشاهده
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">هیچ تسکی یافت نشد.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

