<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;

class DashboardController extends Controller
{
    public function index()
    {
        $dashboards = Dashboard::query()->orderBy('sort_order')->get();

        return view('pages.dashboard', compact('dashboards'));
    }
}
