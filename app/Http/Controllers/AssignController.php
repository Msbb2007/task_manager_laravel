<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;

class AssignController extends Controller
{

    public function create($userId)
    {
        $user = User::query()->findOrFail($userId);

        $availableTasks = Task::query()->whereDoesntHave('users', function ($query) use ($userId) {
            $query->where('users.id', $userId);
        })->get();

        return view('admin.users.assign', compact('user', 'availableTasks'));
    }

    public function store(Request $request, $userId)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
        ]);

        $user = User::query()->findOrFail($userId);
        $taskId = $request->task_id;

        $user->tasks()->syncWithoutDetaching([$taskId]);

        return redirect()
            ->route('admin.task_user.showTasks', $user->id)
            ->with('success', 'تسک با موفقیت به کاربر اختصاص یافت.');
    }

    public function detach(Request $request, $userId)
    {
        $user = User::query()->findOrFail($userId);
        $taskId = $request->task_id;

        $user->tasks()->detach($taskId);

        return redirect()->back()->with('success', 'تسک با موفقیت از کاربر حذف شد.');
    }
}
