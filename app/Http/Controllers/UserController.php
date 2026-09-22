<?php

namespace App\Http\Controllers;

use App\Http\Requests\adminEditUserRequest;
use App\Http\Requests\updateProfileRequest;
use App\Http\Requests\userRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users = User::query()->paginate(10);
        return view('admin.users.superAdmin.index', compact('users'));
    }

    public function showUsers()
    {
        $users = User::query()->paginate(10);
        return view('admin.users.index', compact('users'));
    }


    public function create()
    {
        return view('admin.users.superAdmin.create');
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
        return redirect()->route('admin.users')->with('success', 'کاربر با موفقیت ساخته شد');
    }


    public function showTasks($userId)
    {
        $user = User::query()->findOrFail($userId);

        // گرفتن تمام تسک‌هایی که این کاربر در حال حاضر به آن‌ها وصل است
        $userTasks = $user->tasks()->with('category')->paginate(5);

        return view('admin.users.tasks', compact('user', 'userTasks'));
    }

    public function edit(User $user)
    {
        return view('admin.users.superAdmin.edit', compact('user'));
    }

    public function update(adminEditUserRequest $request, User $user)
    {
        $user->update([
            'name' => $request->name,
            'family' => $request->family,
        ]);
        return redirect()->route('admin.users')->with('success', 'اطلاعات کاربر آپدیت شد.');
    }


    public function deleted_users()
    {
        $deleted_users=User::onlyTrashed()->get();
        return view('admin.users.superAdmin.deleted_users', compact('deleted_users'));
    }
    public function force_delete(string $id)
    {
        $user = User::onlyTrashed()->find($id);
        $user->forceDelete();
        $deleted_users=User::onlyTrashed()->get();
        return redirect()->route('admin.users.deleted_users',compact('deleted_users'));
    }

    public function restore(string $id)
    {
        $user = User::onlyTrashed()->find($id);
        $user->restore();

        $deleted_users=User::onlyTrashed()->get();
        return redirect()->route('admin.users.deleted_users',compact('deleted_users'));
    }

    public function soft_delete(string $id)
    {
        $user = User::query()->find($id);
        $user->delete();

        $deleted_users=User::onlyTrashed()->get();
        return redirect()->route('admin.users.deleted_users',compact('deleted_users'));
    }

    public function editProfile(User $user)
    {
        return view('admin.users.superAdmin.editProfile', compact('user'));
    }

    public function updateProfile(string $id, updateProfileRequest $request)
    {
        $user = User::query()->findOrFail($id);
        $data = $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);
        if ($request->filled('password')) {
            $data['password'] =  Hash::make($request->password);
        }

        $user->update($data);
        return redirect()->route('admin.users')->with('success', 'اطلاعات شما آپدیت شد.');
    }
}
