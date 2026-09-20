<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login',[AuthController::class,'showLogin'])->name('login');
    Route::post('/login',[AuthController::class,'login'])->name('login.post');

    Route::get('/register',[AuthController::class,'showRegister'])->name('register');
    Route::post('/register',[AuthController::class,'register']);
});

//admin's panel
Route::middleware('')->prefix('/admin')->group(function(){
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

//user's panel
Route::middleware('auth')->prefix('/user')->group(function(){
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
