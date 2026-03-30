<?php

namespace App\Http\Controllers;

use App\Models\Home;

class HomeController extends Controller
{
    public function index()
    {
        $home = Home::query()->firstOrFail();

        return view('pages.home', compact('home'));
    }
}
