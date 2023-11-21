<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
  public function login()
  {
    if (Auth::check()) {
      return redirect('dashboard');
    } else {
      return view('auth.login', ['title' => 'Login']);
    }
  }

  public function actionlogin(Request $request)
  {
    $data = [
      'email' => $request->input('email'),
      'password' => $request->input('password'),
    ];

    if (Auth::Attempt($data)) {
      return redirect('dashboard');
    } else {
      Session::flash('error', 'Email atau Password Salah');
      return redirect('/');
    }
  }

  public function actionlogout()
  {
    Auth::logout();
    return redirect('/');
  }

  public function register()
  {
    if (Auth::check()) {
      return redirect('dashboard');
    } else {
      return view('auth.register', ['title' => 'Register']);
    }
  }

  public function actionRegister(Request $request)
  {
    if (Auth::check()) {
      return redirect('dashboard');
    }

    // $errorMessage = [
    //   'required' => ':Attribute tidak boleh kosong.',
    //   'email' => 'Format :Attribute tidak valid.',
    //   'unique' => ':Attribute ini sudah didaftarkan, silahkan login.',
    //   'min' => ':Attribute minimal :min karakter.',
    //   'confirmed' => 'Konfirmasi password tidak sama.',
    // ];

    $validatedData = $request->validate([
      'firstName' => 'required|string|min:3|max:100',
      'lastName' => 'required|string|min:3|max:100',
      'password' => 'required|string|min:6|confirmed',
      'email' => 'required|email:dns|unique:users|max:30',
    ]);

    $validatedData['password'] = Hash::make($validatedData['password']);

    try {
      $user = User::create($validatedData);
      Session::flash('success', 'Register Berhasil. Silahkan login menggunakan email dan password.');
      return redirect('/login');
    } catch (\Exception $e) {
      Session::flash('error', 'Register Gagal. Silahkan coba lagi :)');
      return back()->withInput();
    }
  }

  public function forgotPassword()
  {
    return view('auth.forgot-password', ['title' => 'Forgot Password']);
  }
}
