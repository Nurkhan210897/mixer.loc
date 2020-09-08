<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Category;

class CategoryController extends Controller
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new Category();
    }

    public function show($id)
    {
        $data = $this->categoryModel->getSelectedData($id);
        return view('category', $data);
    }
}
