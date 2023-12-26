<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserPostController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// MAIN
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/{post}/read', [PageController::class, 'read'])->name('read');
Route::get('/trends', [PageController::class, 'trends'])->name('trends');
Route::get('/about', [PageController::class, 'about'])->name('about');

// LOGIN
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('actionLogin')->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// REGISTER
Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'register'])->name('actionRegister')->middleware('guest');

// DASHBOARD
Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::resource('/dashboard/posts', UserPostController::class)->middleware('auth');
Route::resource('/profile', UserController::class)->parameters(['profile' => 'user'])->only(['index', 'update'])->middleware('auth');

// ADMIN
Route::resource('/dashboard/admin/users', AdminUserController::class, ['as' => 'admin'])->middleware('admin');
Route::resource('/dashboard/admin/posts', AdminPostController::class, ['as' => 'admin'])->except(['create', 'store'])->middleware('admin');

// ROUTES FALLBACK
Route::fallback([PageController::class, 'home']);
