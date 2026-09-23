@extends('layouts.user.userLayout')

@section('title', 'داشبورد')

@section('content')

    <div class="card border-0 shadow-sm">
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
                    @forelse($tasks as $task)
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

