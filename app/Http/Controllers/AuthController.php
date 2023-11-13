<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
  public function login()
  {
    if (Auth::check()) {
      return redirect('dashboard');
    } else {
      return view('auth.login', ['title' => 'SB Admin 2 - Login']);
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
      return view('auth.register', ['title' => 'SB Admin 2 - Register']);
    }
  }
}
