<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;

class IndexController extends Controller
{
    public function show()
    {
        return view('index');
    }
}
