<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group.
|
*/

Route::get('/', function () {
    if (session('logged_in')) {
        return redirect()->route('properties');
    }
    return view('guest-dashboard');
})->name('home');

Route::get('/login', function () {
    if (session('logged_in')) {
        return redirect()->route('properties');
    }
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    if ($request->input('username') === 'Admin' && $request->input('password') === '123') {
        $request->session()->put('logged_in', true);
        $request->session()->put('username', 'Admin');

        return redirect()->route('properties');
    }

    return back()->withErrors(['credentials' => 'Invalid username or password'])->withInput();
})->name('login.submit');

Route::post('/logout', function (Request $request) {
    $request->session()->flush();
    return redirect()->route('home');
})->name('logout');

Route::get('/properties', function () {
    if (!session('logged_in')) {
        return redirect()->route('home');
    }

    return view('dashboard');
})->name('properties');

Route::get('/listings', function () {
    return view('listings');
})->name('listings');

Route::get('/details', function () {
    return view('details');
})->name('details');

Route::get('/map', function () {
    return view('map');
})->name('map');
