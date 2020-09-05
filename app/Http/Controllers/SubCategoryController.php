<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\SubCategory;
use App\Http\Requests\SubCategoryRequest;

class SubCategoryController extends Controller
{

    private $subCategoryModel;

    public function __construct()
    {
        $this->subCategoryModel = new SubCategory();
    }

    public function show($id, SubCategoryRequest $request)
    {
        $data['subCategory'] =  SubCategory::where('id', $id)->first();
        $data['products'] = $this->subCategoryModel->getProducts($id, $request->all());
        $data['pageInfo'] = $this->subCategoryModel->getPageInfo($id);

        // return response()->json($data['products']);
        return view('subCategory', $data);
    }
}
