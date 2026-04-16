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
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::post('/login', function (Request $request) {
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    if ($request->input('username') === 'Admin' && $request->input('password') === '123') {
        $request->session()->put('logged_in', true);
        $request->session()->put('username', 'Admin');

        return redirect('/properties');
    }

    return back()->withErrors(['credentials' => 'Invalid username or password'])->withInput();
});

Route::post('/logout', function (Request $request) {
    $request->session()->flush();
    return redirect('/');
});

Route::get('/properties', function () {
    if (!session('logged_in')) {
        return redirect('/');
    }

    return view('welcome');
});
