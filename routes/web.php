<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssignController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\userPanelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login',[AuthController::class,'showLogin'])->name('login');
    Route::post('/login',[AuthController::class,'login'])->name('login.post');

    Route::get('/register',[AuthController::class,'showRegister'])->name('register');
    Route::post('/register',[AuthController::class,'register'])->name('register.post');;
});

//admin's panel
Route::middleware('role')->prefix('/admin')->group(function() {

    //dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    //tasks
    Route::get('/tasks', [TaskController::class, 'index'])->name('admin.tasks');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('admin.tasks.create');
    Route::post('/tasks/create', [TaskController::class, 'store'])->name('admin.tasks.store');
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('admin.tasks.edit');
    Route::put('/tasks/{task}/edit', [TaskController::class, 'update'])->name('admin.tasks.update');

    //trash_tasks
    Route::get('admin/tasks/trash', [TaskController::class, 'trash'])->name('admin.tasks.trash');
    Route::post('admin/tasks/{id}/restore', [TaskController::class, 'restore'])->name('admin.tasks.restore');
    Route::delete('admin/tasks/{id}/delete', [TaskController::class, 'softDelete'])->name('admin.tasks.softDelete');
    Route::delete('admin/tasks/{id}/force-delete', [TaskController::class, 'forceDelete'])->name('admin.tasks.forceDelete');

    //categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories/create', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/categories/{category}/edit', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{category}/edit', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

    //task_user
    Route::get('/task_user', [UserController::class, 'showUsers'])->name('admin.task_user');
    Route::get('/task_user/show_tasks/{id}', [UserController::class, 'showTasks'])->name('admin.task_user.showTasks');
    Route::get('/task_user/assign_task/{id}', [AssignController::class, 'create'])->name('admin.task_user.assignTask');
    Route::post('/task_user/assign_task/{id}', [AssignController::class, 'store'])->name('admin.task_user.assignTask.store');
    Route::delete('task_user/detach/{id}', [AssignController::class, 'detach'])->name('admin.users.detach');

});
    //دسترسی فقط برای admin
    Route::middleware(['role:admin'])->prefix('/admin')->group(function (){
        Route::get('/users', [UserController::class, 'index'])->name('admin.users');
        Route::get('/users/{user}/edit',[UserController::class,'edit'])->name('admin.users.edit');
        Route::put('/users/{user}',[UserController::class,'update'])->name('admin.users.update');

        Route::get('/user/profile/{user}/edit',[UserController::class,'editProfile'])->name('admin.users.editProfile');
        Route::put('/user/profile/{user}',[UserController::class,'updateProfile'])->name('admin.users.updateProfile');

        Route::get('user/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('user/create', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/user/deleted_users',[UserController::class,'deleted_users'])->name('admin.users.deleted_users');
        Route::put('/user/{id}/restore',[UserController::class,'restore'])->name('admin.users.restore');
        Route::delete('/users/{id}',[UserController::class,'soft_delete'])->name('admin.users.soft');
        Route::put('/user/{id}/force',[UserController::class,'force_delete'])->name('admin.users.force_delete');
    });

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

//user's panel
Route::middleware('auth')->prefix('/user')->group(function(){
    Route::get('/dashboard', [userPanelController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/tasks', [userPanelController::class, 'showAllTasks'])->name('user.tasks');
    Route::get('/task/{task}', [userPanelController::class, 'showTask'])->name('user.task.show');
    Route::get('/profile', [userPanelController::class, 'profile'])->name('user.profile');
    Route::post('/profile/update', [userPanelController::class, 'updateProfile'])->name('user.profile.update');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
