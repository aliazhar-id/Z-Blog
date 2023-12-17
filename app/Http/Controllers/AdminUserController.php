<?php

namespace App\Http\Controllers;

use App\Models\DeletedUser;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class AdminUserController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('dashboard.admin.users.index', [
      'title' => 'Users',
      'users' => User::whereNotIn('role', ['admin', 'owner'])
        ->where('id_user', '!=', auth()->user()->id_user)
        ->filter(request(['search']))
        ->latest()
        ->get()
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('dashboard.admin.users.create', [
      'title' => 'Create User'
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required|min:3|max:100',
      'username' => 'required|alpha_dash|unique:users|min:3|max:15',
      'password' => 'required|min:6|max:255|confirmed',
      'password_confirmation' => 'required|max:50',
      'email' => 'required|email:dns|unique:users|max:30',
      'image' => 'nullable|image|file|max:2048',
    ]);

    if ($request->file('image')) {
      $image = Image::make($request->file('image'));
      $ratio = 1 / 1;

      if (intval($image->width() / $ratio > $image->height())) {
        $image->fit(intval($image->height() * $ratio), $image->height());
      } else {
        $image->fit($image->width(), intval($image->width() / $ratio));
      }

      $filePath = 'profile-images/' . uniqid() . uniqid() . '.jpg';
      $image->save(storage_path('app/public/' . $filePath));

      $validatedData['image'] = $filePath;
    }

    $validatedData['password'] = Hash::make($validatedData['password']);
    $validatedData['username'] = strtolower($validatedData['username']);

    User::create($validatedData);
    return redirect()->route('users.index')->with('success', 'New account added successfully');
  }

  /**
   * Display the specified resource.
   */
  public function show(User $user)
  {
    if ($user->role !== 'member') {
      abort(403);
    }

    return view('dashboard.admin.users.show', [
      'title' => 'User Info',
      'user' => $user,
      'posts' => Post::where('id_user', $user->id_user)->get(),
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(User $user)
  {
    if (auth()->user()->id_user === $user->id_user) {
      return redirect(route('profile.index'));
    }

    if ($user->role !== 'member') {
      abort(403);
    }

    return view('dashboard.admin.users.edit', [
      'title' => 'Edit User',
      'user' => $user,
      'posts' => $user->posts()
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, User $user)
  {
    if ($user->role !== 'member') {
      abort(403);
    }

    $isProfileUpdated = false;

    $rules = [
      'new_password' => 'nullable|min:6|max:255|confirmed',
      'new_password_confirmation' => 'max:255',
    ];

    if ($request->name != $user->name) {
      $rules['name'] = 'required|min:3|max:100';
      $isProfileUpdated = true;
    }

    if ($request->username != $user->username) {
      $rules['username'] = 'required|alpha_dash|unique:users|min:3|max:15';
      $isProfileUpdated = true;
    }

    if ($request->email != $user->email) {
      $rules['email'] = 'required|email:dns|unique:users|max:30';
      $isProfileUpdated = true;
    }

    if ($request->file('image')) {
      $rules['image'] = 'image|file|max:2048';
      $isProfileUpdated = true;
    }

    $validatedData = $request->validate($rules);

    if ($request->new_password) {
      $validatedData['password'] = Hash::make($validatedData['new_password']);
      $isProfileUpdated = true;
    }

    if ($request->file('image')) {
      if ($user->image) {
        Storage::delete($user->image);
      }

      $image = Image::make($request->file('image'));
      $ratio = 1 / 1;

      if (intval($image->width() / $ratio > $image->height())) {
        $image->fit(intval($image->height() * $ratio), $image->height());
      } else {
        $image->fit($image->width(), intval($image->width() / $ratio));
      }

      $filePath = 'profile-images/' . uniqid() . uniqid() . '.jpg';
      $image->save(storage_path('app/public/' . $filePath));

      $validatedData['image'] = $filePath;
    }

    if (!$isProfileUpdated) {
      return back()->with('error', 'No changes detected!');
    }

    unset($validatedData['new_password']);
    unset($validatedData['new_password_confirmation']);

    User::where('id_user', $user->id_user)->update($validatedData);

    return redirect(route('admin.users.edit', $validatedData['username'] ?? $user->username))->with('success', 'User updated successfully!');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(User $user)
  {
    if ($user->role !== 'member') {
      abort(403);
    }

    if ($user->image) {
      Storage::delete($user->image);
      $user['image'] = null;
    }

    $userData = $user->toArray();
    $userData['password'] = $user->password;

    User::destroy($user->id_user);
    DeletedUser::create($userData);

    return back()->with('success', "@$user->username has been removed successfully.");
  }
}
