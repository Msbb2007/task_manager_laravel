<?php

namespace App\Http\Controllers;

use App\Http\Requests\updateProfileRequest;
use App\Models\Task;
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

    public function showTask(Task $task)
    {
        return view('user.showTask', compact('task'));
    }

    public function showAllTasks(Task $task)
    {
        $user = auth()->user();
        $tasks = $user->tasks()->with('category')->paginate(5);
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
