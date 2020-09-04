<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\SubCategory;

class ProductController extends Controller
{
    private $productModel;
    private $subCategoryModel;

    public function __construct()
    {
        $this->productModel = new Product();
        $this->subCategoryModel = new SubCategory();
    }
    public function show($id)
    {
        $product = $this->productModel->getSelectedProduct($id);
        $data['product'] = $product;
        $data['subCategoryProducts'] = $this->subCategoryModel->getProducts($product->sub_category_id);
        // return response()->json($data);
        return view('product', $data);
    }
}
