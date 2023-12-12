<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Cookie;

class PageController extends Controller
{

  public function home()
  {
    return view('blog.page.home', [
      'title' => 'Home',
      'posts' => Post::latest()->filter(request(['search', 'body']))->paginate(12)->withQueryString(),
      'categories' => Category::all()
    ]);
  }

  public function trends()
  {
    return view('blog.page.trends', [
      'title' => 'Trends',
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
    if (!Cookie::has("$post->id_post")) {
      Post::withoutTimestamps(fn () => $post->increment('click'));
      Cookie::queue(Cookie::make("$post->id_post", '1', 1));
    }

    return view('blog.page.post', [
      'title' => 'Post',
      'isHome' => true,
      'post' => $post,
      'canonicalURL' => URL::current()
    ]);
  }

  public function dashboard()
  {
    return view('dashboard.main.dashboard', [
      'title' => 'Dashboard',
      'posts' => Post::where('id_user', auth()->user()->id_user)->get()
    ]);
  }
}
