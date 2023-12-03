<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardController extends Controller
{
  public function index()
  {
    return view('dashboard.posts', [
      'title' => 'My Post',
      'posts' => Post::latest()->where('id_user', auth()->user()->id_user)->paginate(10)
    ]);
  }

  public function dashboard()
  {
    return view('dashboard.dashboard', [
      'title' => 'Dashboard',
      'posts' => Post::where('id_user', auth()->user()->id_user)->get()
    ]);
  }
}
