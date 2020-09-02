<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\SubCategory;

class SubCategoryController extends Controller
{

    private $subCategoryModel;

    public function __construct()
    {
        $this->subCategoryModel = new SubCategory();
    }

    public function show($id, Request $request)
    {
        $data['subCategory'] = SubCategory::with(['directoryTypes' => function ($query) {
            $query->with('directories')->get();
        }])->where('id', $id)->get()[0];

        $data['products'] = $this->subCategoryModel->getProductsWithPaginate($id, 1);
        // return response()->json($data);
        return view('subCategory', $data);
    }
}
