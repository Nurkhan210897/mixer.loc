<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\SubCategory;
use App\Http\Requests\SubCategoryRequest;

class SubCategoryController extends Controller
{

    private $subCategoryModel;

    public function __construct(SubCategory $subCategory)
    {
        $this->subCategoryModel = $subCategory;
    }

    public function show($id, SubCategoryRequest $request)
    {
        $data['subCategory'] = $this->subCategoryModel->where('id', $id)->first();
        $data['products'] = $this->subCategoryModel->getProducts($id, $request->all());
        $data['pageInfo'] = $this->subCategoryModel->getPageInfo($id);
        return view('subCategory', $data);
    }
}
