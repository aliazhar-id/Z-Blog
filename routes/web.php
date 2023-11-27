<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
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

Route::get('/', function () {
  return view('blog.page.home', [
    'title' => 'Home'
  ]);
})->name('home');

Route::get('/about', function () {
  return view('blog.page.about', [
    'title' => 'About'
  ]);
})->name('about');

Route::get('/posts', [PostController::class, 'index'])->name('blog');

Route::get('/posts/{post}', [PostController::class, 'show']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('actionLogin');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
