<?php

namespace App\Http\Controllers;

use App\Models\AdminUpload;

class AdminUploadController extends Controller
{
    public function index()
    {
        $adminUpload = AdminUpload::query()->firstOrFail();

        return view('pages.admin-upload', compact('adminUpload'));
    }
}
