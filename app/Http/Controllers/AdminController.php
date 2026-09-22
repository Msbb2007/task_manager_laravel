<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $activeTasksCount = Task::query()->where('status', 'in_progress')->count();

        $newUsersCount = User::query()->where('created_at', '>=', now()->subDays(30))->count();

        $completedTasksCount = Task::query()->where('status', 'completed')->count();


        return view('admin.dashboard', compact(
            'activeTasksCount',
            'newUsersCount',
            'completedTasksCount',
        ));
    }

}
