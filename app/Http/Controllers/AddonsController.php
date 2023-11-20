<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AddonsController extends Controller
{
    public function index($pages, $addon = null)
    {
        if ($addon) {
            $view = "addons.$pages.$addon";
        } else {
            $view = "addons.$pages";
        }


        if (View::exists($view)) {
            return view($view, [
                'title' => 'Buttons',
                'active' => $pages
            ]);
        } else {
            abort(404);
        }
    }
}
