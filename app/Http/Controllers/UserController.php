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

    public function index(Request $request)
    {
        $search = trim($request->input('search', ''));

        $users = User::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();
        return view('admin.users.superAdmin.index', compact('users'));
    }

    public function showUsers(Request $request)
    {
        $search = trim($request->input('search', ''));

        $users = User::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();
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


    public function showTasks(Request $request,$userId)
    {
        $user = User::findOrFail($userId);

        $search = trim($request->input('search', ''));
        $userTasks = Task::query()
            ->whereHas('users', fn ($query) => $query->where('users.id', $user->id))
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.tasks', compact('user', 'userTasks'));
    }

    public function edit(User $user)
    {
            $user=auth()->user();
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
        $user=auth()->user();
        return view('admin.users.superAdmin.editProfile', compact('user'));
    }

    public function updateProfile( updateProfileRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // ذخیره سازی
        $user->update($data);
        return redirect()->route('admin.users')->with('success', 'اطلاعات شما آپدیت شد.');
    }
}
