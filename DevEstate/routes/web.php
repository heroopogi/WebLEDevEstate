<?php

use App\Http\Controllers\AdminUploadController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\MobileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/listings', [ListingController::class, 'index'])->name('listings.index');
Route::get('/details', [DetailController::class, 'index'])->name('details.index');
Route::get('/map', [MapController::class, 'index'])->name('maps.index');
Route::get('/admin-upload', [AdminUploadController::class, 'index'])->name('admin-uploads.index');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboards.index');
Route::get('/login', [LoginController::class, 'index'])->name('logins.index');
Route::get('/mobile', [MobileController::class, 'index'])->name('mobiles.index');
