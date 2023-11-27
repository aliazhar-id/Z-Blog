<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
  public function index()
  {

    // return Category::all();
    return view('blog.page.posts', [
      'title' => 'Post',
      'posts' => Post::latest()->paginate(12)->withQueryString(),
      'categories' => Category::all()
    ]);
  }
}
