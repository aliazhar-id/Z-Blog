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

    $validatedData = $request->validate([
      'firstName' => 'required|string',
      'lastName' => 'required|string',
      'password' => 'required|string|min:6|confirmed',
      'email' => 'required|email|unique:users',
    ], [
      'required' => ':attribute tidak boleh kosong.',
      'email' => 'Format :attribute tidak valid.',
      'unique' => ':attribute ini sudah didaftarkan, silahkan login.',
      'min' => ':attribute minimal :min karakter.',
      'confirmed' => 'Password yang anda masukkan tidak sama.',
    ]);

    $data = [
      'firstName' => $validatedData['firstName'],
      'lastName' => $validatedData['lastName'],
      'email' => $validatedData['email'],
      'password' => bcrypt($validatedData['password']),
    ];

    try {
      $user = User::create($data);
      Session::flash('message', 'Register Berhasil. Silahkan Login menggunakan email dan password.');
      return redirect('register');
    } catch (\Exception $e) {
      Session::flash('error', 'Gagal mendaftarkan pengguna. Silahkan coba lagi.');
      return back()->withInput();
    }
  }

  public function forgotPassword()
  {
    return view('auth.forgot-password', ['title' => 'Forgot Password']);
  }
}
