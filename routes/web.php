<?php

use App\Http\Controllers\AddonsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InterfaceController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [AuthController::class, 'login']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'actionLogin'])->name('actionLogin');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'actionRegister'])->name('actionRegister');

Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/logout', [AuthController::class, 'actionlogout'])->name('logout')->middleware('auth');

Route::get('/interfaces/{groups}/{interface}', [InterfaceController::class, 'index'])->middleware('auth');

Route::get('/addons/{pages}/{addon?}', [AddonsController::class, 'index'])->middleware('auth');