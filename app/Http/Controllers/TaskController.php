<?php

namespace App\Http\Controllers;

use App\Http\Requests\taskRequest;
use App\Models\category;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks=Task::query()->paginate(6);
        return view('',compact('tasks'));
    }

    public function create(Request $request)
    {
        $categories = Category::all();
        return view('',compact('categories'));
    }


    public function store(taskRequest $request)
    {
        Task::query()->create([
            'title'=>$request->name,
            'description'=>$request->description,
            'status'=>$request->status,
            'category_id'=>$request->category_id,
            'priority'=>$request->priority,
            'due_date' =>$request->due_date,
        ]);
        return redirect()->route('')->with('success', 'تسک با موفقیت ساخته شد');
    }

    public function show(Task $task)
    {
        return view('',compact('task'));
    }

    public function edit(Task $task)
    {
        $categories = Category::all();
        return view('', compact('task','categories'));
    }

    public function update(Request $request, Task $task)
    {
        $task->update([
            'title'       => $request->name,
            'description' => $request->description,
            'status'      => $request->status,
            'category_id' => $request->category_id,
            'priority'    => $request->priority,
            'due_date'    => $request->due_date,
        ]);

        return redirect()->route('')->with('success', 'تسک با موفقیت به‌روزرسانی شد');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('')->with('success', 'تسک با موفقیت حذف شد');
    }
}
