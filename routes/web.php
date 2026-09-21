<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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
Route::middleware('auth')->prefix('/admin')->group(function(){
    Route::get('/dashboard',function (){
        return view('admin.dashboard');
    })->name('admin.dashboard');

    //tasks
    Route::get('/tasks',[TaskController::class,'index'])->name('admin.tasks');
    Route::get('/tasks/create',[TaskController::class,'create'])->name('admin.tasks.create');
    Route::post('/tasks/create',[TaskController::class,'store'])->name('admin.tasks.store');
    Route::get('/tasks/{task}/edit',[TaskController::class,'edit'])->name('admin.tasks.edit');
    Route::put('/tasks/{task}/edit',[TaskController::class,'update'])->name('admin.tasks.update');
    Route::delete('/tasks/{task}/edit',[TaskController::class,'destroy'])->name('admin.tasks.destroy');

    //categories
    Route::get('categories',[CategoryController::class,'index'])->name('admin.categories');
    Route::get('categories/create',[CategoryController::class,'create'])->name('admin.categories.create');
    Route::post('categories/create',[CategoryController::class,'store'])->name('admin.categories.store');
    Route::get('categories/{category}/edit',[CategoryController::class,'edit'])->name('admin.categories.edit');
    Route::put('categories/{category}/edit',[CategoryController::class,'update'])->name('admin.categories.update');
    Route::delete('categories/{category}/edit',[CategoryController::class,'destroy'])->name('admin.categories.destroy');

    //users
    Route::get('/users',[UserController::class,'index'])->name('admin.users');
    Route::get('/users/{user}',[UserController::class,'show'])->name('admin.users.show');

    //دسترسی فقط برای ادمین
    Route::middleware(['role:admin'])->group(function (){
        Route::get('/users/{user}/edit',[UserController::class,'edit'])->name('admin.users.edit');
        Route::put('/users/{user}',[UserController::class,'update'])->name('admin.users.update');
        Route::delete('/users/{user}',[UserController::class,'destroy'])->name('admin.users.destroy');
    });

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

//user's panel
Route::middleware('auth')->prefix('/user')->group(function(){
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
