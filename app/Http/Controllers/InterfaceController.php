<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class InterfaceController extends Controller
{
    public function index($groups, $interface)
    {
        $view = "interfaces.$groups.$interface";

        if (View::exists($view)) {
            return view($view, ['title' => 'Buttons']);
        } else {
            abort(404);
        }
    }
}
