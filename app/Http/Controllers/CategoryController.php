<?php

namespace App\Http\Controllers;


use App\Http\Requests\categoryRequest;
use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()->withCount('tasks')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }


    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(categoryRequest $request)
    {
        Category::query()->create([
            'name' => $request->name,
            'color'=>$request->color,
        ]);

        return redirect()->route('admin.categories')->with('success', 'دسته‌بندی با موفقیت ساخته شد');
    }

    public function show(category $category)
    {
        //filter tasks
        $tasks = $category->tasks();
        return view('', compact('category', 'tasks'));
    }

    public function edit(category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, category $category)
    {
        $category->update([
            'name' => $request->name,
            'color'=>$request->color,
        ]);

        return redirect()->route('admin.categories')->with('success', 'دسته‌بندی به‌روزرسانی شد');
    }

    public function destroy(category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories')->with('success', 'دسته‌بندی حذف شد');
    }
}
