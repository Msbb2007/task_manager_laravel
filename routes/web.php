<?php

use App\Http\Controllers\AuthController;
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
