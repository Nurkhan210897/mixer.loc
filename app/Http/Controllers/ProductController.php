<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Product;

class ProductController extends Controller
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new Product();
    }
    public function show($id)
    {
        $data['product'] = $this->productModel->getSelectedProduct($id);
        $data['subCategoryProducts']=$this->productModel->get
        return view('product', $data);
    }
}
