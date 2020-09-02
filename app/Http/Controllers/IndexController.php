<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\Slider;

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
        $data['sliders'] = Slider::orderBy('serial_number', 'ASC')->get();
        return view('index', $data);
    }
}
