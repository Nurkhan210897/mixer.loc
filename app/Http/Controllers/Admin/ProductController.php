<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use App\Models\Admin\Product;
use App\Models\Admin\DirectoryType;

class ProductController extends Controller
{
    private $directoryType;

    public function __construct()
    {
        $this->directoryType = new DirectoryType();
    }

    public function index()
    {
        $data['categories'] = Category::all();
        $data['subCategories'] = SubCategory::with('directories')->get();
        $data['products'] = Product::all();
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function getDirectories(Request $request)
    {
        $data = $this->directoryType->getSubCategoryDirectories($request->directories);
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
