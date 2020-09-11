<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Category;

class CategoryController extends Controller
{
    private $categoryModel;

    public function __construct(Category $category)
    {
        $this->categoryModel = $category;
    }

    public function show($id)
    {
        $data = $this->categoryModel->getSelectedData($id);
        return view('category', $data);
    }
}
