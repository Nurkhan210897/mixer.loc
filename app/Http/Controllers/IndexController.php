<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;

class IndexController extends Controller
{
    private $category;

    public function __construct()
    {
        $this->categoryModel = new Category();
    }
    public function show()
    {
        $data['categories'] = $this->categoryModel->getIndexData();
        // return response()->json($data);
        return view('index', $data);
    }
}
