<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\SubCategory;

class ProductController extends Controller
{
    private $productModel;
    private $subCategoryModel;

    public function __construct(Product $products, SubCategory $subCategory)
    {
        $this->productModel = $products;
        $this->subCategoryModel = $subCategory;
    }
    public function index($id)
    {
        $product = $this->productModel->getSelectedProduct($id);
        $data['product'] = $product;
        $data['subCategoryProducts'] = $this->subCategoryModel->getProducts($product->sub_category_id);
        return view('product', $data);
    }

    public function search(Request $request)
    {
        $products = $this->productModel->search($request->searched);
        return response()->json($products);
    }
}
