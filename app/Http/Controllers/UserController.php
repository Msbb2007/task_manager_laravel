<?php

namespace App\Http\Controllers;

use App\Http\Requests\userRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users = User::query()->paginate(10);
        return view('', compact('users'));
    }


    public function create()
    {
        return view('');
    }

    public function store(userRequest $request)
    {
        User::query()->create([
            'name' => $request->name,
            'family' => $request->family,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        return redirect()->route('')->with('success', 'کاربر با موفقیت ساخته شد');
    }


    public function show(User $user)
    {
        return view('', compact('user'));
    }

    public function edit(User $user)
    {
        return view('', compact('user'));
    }

    public function update(userRequest $request, User $user)
    {
        $user->update([
            'name' => $request->name,
            'family' => $request->family,
            'email' => $request->email,
        ]);
        return redirect()->route('')->with('success', 'اطلاعات کاربر آپدیت شد.');
    }


    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('')->with('success', 'کاربر با موفقیت حذف شد');
    }
}
