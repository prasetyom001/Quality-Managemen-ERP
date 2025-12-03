<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\AuthController;

// Homepage diarahkan ke Register
Route::get('/', function () {
    return redirect()->route('register');
});

// Dashboard (hanya bisa diakses setelah login)
Route::get('/dashboard', [MaterialController::class, 'index'])->name('dashboard')->middleware('auth');

// Materials CRUD
Route::resource('materials', MaterialController::class)
    ->except(['show'])
    ->middleware('auth');

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

