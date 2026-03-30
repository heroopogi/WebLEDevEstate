<?php

namespace App\Http\Controllers;

use App\Models\Listing;

class ListingController extends Controller
{
    public function index()
    {
        $listings = Listing::query()->latest('id')->get();

        return view('pages.listings', compact('listings'));
    }
}
