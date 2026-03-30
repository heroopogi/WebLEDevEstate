<?php

namespace App\Http\Controllers;

use App\Models\Login;

class LoginController extends Controller
{
    public function index()
    {
        $login = Login::query()->firstOrFail();

        return view('pages.login', compact('login'));
    }
}
