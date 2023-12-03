<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PageController extends Controller
{

  public function home()
  {
    return view('blog.page.home', ['title' => 'Home']);
  }

  public function blog()
  {
    return view('blog.page.posts', [
      'title' => 'Post',
      'posts' => Post::latest()->paginate(12)->withQueryString(),
      'categories' => Category::all()
    ]);
  }

  public function trends()
  {
    return view('blog.page.trends', [
      'title' => 'Post',
      'posts' => Post::where('click', '>', 0)->orderByDesc('click')->orderByDesc('created_at')->paginate(12)->withQueryString(),
      'categories' => Category::all()
    ]);
  }

  public function about()
  {
    return view('blog.page.about', ['title' => 'About']);
  }

  public function read(Post $post)
  {
    Post::withoutTimestamps(fn () => $post->increment('click'));

    return view('blog.page.post', [
      'title' => 'Post',
      'post' => $post
    ]);
  }
}
