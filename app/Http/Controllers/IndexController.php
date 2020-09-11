<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\Slider;

class IndexController extends Controller
{
    private $categoryModel;

    public function __construct(Category $category)
    {
        $this->categoryModel = $category;
    }
    public function show()
    {
        $data['categories'] = $this->categoryModel->getIndexData();
        $data['sliders'] = Slider::orderBy('serial_number', 'ASC')->get();
        return view('index', $data);
    }
}
