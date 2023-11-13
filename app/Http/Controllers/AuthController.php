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

    $data = [
      'firstName' => $request->firstName,
      'lastName' => $request->lastName,
      'email' => $request->email,
      'password' => $request->password,
      'repeatPassword' => $request->repeatPassword,
    ];

    if ($data['password'] !== $data['repeatPassword']) {
      Session::flash('error', 'Password yang anda masukkan tidak sama!');
      return redirect('register');
    }

    if (User::where('email', $data['email'])->first()) {
      Session::flash('error', 'Email ini sudah didaftarkan, silahkan login!');
      return redirect('register');
    }

    $user = User::create($data);

    Session::flash('message', 'Register Berhasil. Silahkan Login menggunakan email dan password.');
    return redirect('register');
  }

  public function forgotPassword()
  {
    return view('auth.forgot-password', ['title' => 'Forgot Password']);
  }
}
