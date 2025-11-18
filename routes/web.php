<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialController;

Route::get('/', [MaterialController::class, 'index'])->name('dashboard');
Route::resource('materials', MaterialController::class)->except(['show']);

// Route::get('/', function () {
//     return view('welcome');
// });
