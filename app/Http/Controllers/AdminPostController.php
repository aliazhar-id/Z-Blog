<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class AdminPostController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('dashboard.admin.posts.index', [
      'title' => 'Admin Posts',
      'posts' => Post::whereRelation('author', fn ($query) => $query->whereNotIn('role', ['owner', 'admin']))
        ->filter(request(['search']))
        ->latest()
        ->get(),
    ]);
  }

  /**
   * Display the specified resource.
   */
  public function show(Post $post)
  {
    $this->authorize('view', $post);

    return view('dashboard.admin.posts.show', [
      'post' => $post,
      'title' => 'Admin Post'
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Post $post)
  {
    $this->authorize('update', $post);

    return view('dashboard.admin.posts.edit', [
      'title' => 'Edit',
      'post' => $post,
      'categories' => Category::all()
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Post $post)
  {
    $this->authorize('update', $post);

    $customError = [
      'title.unique' => "@{$post->author->username} already have post with this title!"
    ];

    $isPostUpdated = false;
    $rules = [];

    if ($request->title != $post->title) {
      $rules['title'] = [
        'required',
        'min:3',
        'max:255',
        Rule::unique('posts')->where(fn ($query) => $query->where('title', request()->title)->where('id_user', $post->id_user))
      ];

      $isPostUpdated = true;
    }

    if ($request->id_category != $post->id_category) {
      $rules['id_category'] = 'required';
      $isPostUpdated = true;
    }

    if ($request->file('image')) {
      $rules['image'] = 'image|file|max:2048';
      $isPostUpdated = true;
    }

    if ($request->body != $post->body) {
      $rules['body'] = 'required';
      $isPostUpdated = true;
    }

    if (!$isPostUpdated) {
      return back()->with('error', 'No profile changes detected!');
    }

    $validatedData = $request->validate($rules, $customError);

    if (isset($validatedData['title'])) {
      $validatedData['slug'] = SlugService::createSlug(Post::class, 'slug', $validatedData['title']);
    }

    if ($request->file('image')) {
      if ($post->image) {
        Storage::delete($post->image);
      }

      $validatedData['image'] = $request->file('image')->store('post-banners');
    }

    if (isset($validatedData['body'])) {
      $validatedData['excerpt'] = Str::limit(strip_tags($validatedData['body']), 150, '...');
    }

    Post::where('id_post', $post->id_post)->update($validatedData);
    return redirect()->route('admin.posts.index')->with('success', 'The Post has been updated successfully.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Post $post)
  {
    $this->authorize('delete', $post);

    Post::destroy($post->id_post);

    if ($post->image) {
      Storage::delete($post->image);
    }

    return redirect()->route('admin.posts.index')->with('success', 'The post has been deleted successfully.');
  }
}
