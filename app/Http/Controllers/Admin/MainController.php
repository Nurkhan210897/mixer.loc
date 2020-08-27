<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\DirectoryType;

class MainController extends Controller
{
    public function index()
    {
        $directoryTypes = DirectoryType::all();
        return view('admin.main', ['directoryTypes' => $directoryTypes]);
    }
}
