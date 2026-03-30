<?php

namespace App\Http\Controllers;

use App\Models\Mobile;

class MobileController extends Controller
{
    public function index()
    {
        $mobile = Mobile::query()->firstOrFail();

        return view('pages.mobile', compact('mobile'));
    }
}
