<?php

namespace App\Http\Controllers;

use App\Models\Map;

class MapController extends Controller
{
    public function index()
    {
        $maps = Map::query()->orderBy('distance_minutes')->get();

        return view('pages.map', compact('maps'));
    }
}
