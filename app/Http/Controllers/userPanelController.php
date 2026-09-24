<?php

namespace App\Http\Controllers;

use App\Http\Requests\updateProfileRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userPanelController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        $stats = [
            'total'      => $user->tasks()->count(),
            'completed'  => $user->tasks()->where('status', 'completed')->count(),
            'in_progress'    => $user->tasks()->where('status', 'in_progress')->count(),
            'high_priority'  => $user->tasks()->where('priority', 'high')->count(),
        ];
        $recentTasks = $user->tasks()
            ->latest()
            ->take(5)
            ->get();

        return view('user.dashboard', compact('stats', 'recentTasks'));
    }

    public function showTask(string $taskId)
    {
        $task = auth()->user()->tasks()->findOrFail($taskId);
        return view('user.showTask', compact('task'));
    }

    public function updateStatusOfTask(Request $request, $taskId)
    {
        $user = auth()->user();
        $task = $user->tasks()->findOrFail($taskId);

        if ($task->status !== 'in_progress') {
            return back()->with('error', 'فقط تسک‌های در حال انجام قابل تغییر وضعیت هستند.');
        }

        $request->validate([
            'new_status' => 'required|in:completed,in_progress'
        ]);

        $user->tasks()->updateExistingPivot($taskId, [
            'state_of_this_task_user' => $request->new_status
        ]);

        return back()->with('success', 'وضعیت تسک با موفقیت تغییر کرد.');
    }

    public function hideTask($taskId)
    {
        $user = auth()->user();
        $task = $user->tasks()->findOrFail($taskId);

        if ($task->status!== 'completed') {
            return back()->with('error', 'فقط تسک‌های تکمیل شده را می‌توان مخفی کرد.');
        }

        $user->tasks()->updateExistingPivot($taskId, [
            'is_hidden' => true
        ]);

        return back()->with('success', 'تسک به تاریخچه منتقل شد.');
    }

    public function archive()
    {
        $user = auth()->user();

        $archivedTasks = $user->tasks()
            ->wherePivot('is_hidden', true)
            ->latest('tasks.created_at')
            ->paginate(10);

        return view('user.archive', compact('archivedTasks'));
    }


    public function showAllTasks(Request $request)
    {
        $user = auth()->user();
        $query = $user->tasks()->withPivot('is_hidden', 'state_of_this_task_user');

        $search = trim($request->input('search', ''));
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }
        $query->wherePivot('is_hidden', false);

        $tasks = $query->latest()->paginate(10)->withQueryString();


        return view('user.showAllTasks', compact('tasks'));
    }


    public function profile()
    {
        $user = auth()->user();
        return view('user.profile', compact('user'));
    }

    public function updateProfile(updateProfileRequest $request)
    {
        $user = auth()->user();
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);
        $data = [
            'name' => $request->name,
            'family' => $request->family,
            'email' => $request->email,
        ];
        if ($request->filled('password')) {
            $data['password'] =  Hash::make($request->password);
        }

        $user->update($data);

        return back()->with('success', 'پروفایل با موفقیت بروزرسانی شد ');
    }


}
