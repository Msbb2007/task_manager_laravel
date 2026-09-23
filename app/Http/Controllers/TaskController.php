<?php

namespace App\Http\Controllers;

use App\Http\Requests\taskRequest;
use App\Models\category;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->input('search', ''));
        $tasks = Task::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();
        return view('admin.tasks.index',compact('tasks'));
    }

    public function create(Request $request)
    {
        $categories = Category::all();
        return view('admin.tasks.create',compact('categories'));
    }


    public function store(taskRequest $request)
    {
        Task::query()->create([
            'title'=>$request->title,
            'description'=>$request->description,
            'status'=>$request->status,
            'category_id'=>$request->category_id,
            'priority'=>$request->priority,
            'due_date' =>$request->due_date,
        ]);
        return redirect()->route('admin.tasks')->with('success', 'تسک با موفقیت ساخته شد');
    }

    public function show(Task $task)
    {
        return view('',compact('task'));
    }

    public function edit(Task $task)
    {
        $categories = Category::all();
        return view('admin.tasks.edit', compact('task','categories'));
    }

    public function update(taskRequest $request, Task $task)
    {
        $task->update([
            'title'       => $request->title,
            'description' => $request->description,
            'status'      => $request->status,
            'category_id' => $request->category_id,
            'priority'    => $request->priority,
            'due_date'    => $request->due_date,
        ]);

        return redirect()->route('admin.tasks')->with('success', 'تسک با موفقیت به‌روزرسانی شد');
    }

    public function trash()
    {
        $tasks = Task::onlyTrashed()->get();
        return view('admin.tasks.trash', compact('tasks'));
    }

    public function softDelete(string $id)
    {
        $task = Task::query()->findOrFail($id);
        $task->delete();
        return redirect()->route('admin.tasks.trash')->with('success', 'تسک به سطل زباله منتقل شد.');
    }

    public function restore(string $id)
    {
        $task = Task::onlyTrashed()->findOrFail($id);
        $task->restore();
        return redirect()->route('admin.tasks.trash')->with('success', 'تسک با موفقیت بازیابی شد.');
    }

    public function forceDelete(string $id)
    {
        $task = Task::onlyTrashed()->findOrFail($id);
        $task->forceDelete();
        return redirect()->route('admin.tasks.trash')->with('success', 'تسک برای همیشه حذف شد.');
    }
}
