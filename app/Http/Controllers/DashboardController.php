<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index()
    {
        return view('dashboard', [
            'title' => 'Dashboard',
        ]);
    }

    function show()
    {
        return view('products', [
            'title' => 'Products',
        ]);
    }
}
