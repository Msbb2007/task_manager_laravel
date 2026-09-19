<?php

namespace App\Http\Controllers;


use App\Http\Requests\categoryRequest;
use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('', compact('categories'));
    }


    public function create()
    {
        return view('');
    }

    public function store(categoryRequest $request)
    {
        Category::query()->create([
            'name' => $request->name,
        ]);

        return redirect()->route('')->with('success', 'دسته‌بندی با موفقیت ساخته شد');
    }

    public function show(category $category)
    {
        //filter tasks
        $tasks = $category->tasks();
        return view('', compact('category', 'tasks'));
    }

    public function edit(category $category)
    {
        return view('', compact('category'));
    }

    public function update(Request $request, category $category)
    {
        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('')->with('success', 'دسته‌بندی به‌روزرسانی شد');
    }

    public function destroy(category $category)
    {
        $category->delete();
        return redirect()->route('')->with('success', 'دسته‌بندی حذف شد');
    }
}
