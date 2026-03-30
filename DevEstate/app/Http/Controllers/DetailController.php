<?php

namespace App\Http\Controllers;

use App\Models\Detail;

class DetailController extends Controller
{
    public function index()
    {
        $detail = Detail::query()->firstOrFail();

        return view('pages.details', compact('detail'));
    }
}
