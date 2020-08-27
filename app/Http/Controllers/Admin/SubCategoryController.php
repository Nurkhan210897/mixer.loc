<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use App\Models\Admin\DirectoryType;
use App\Models\Admin\SubCategoryDirectory;

class SubCategoryController extends Controller
{

    private $directory;

    public function __construct()
    {
        $this->subCategoryDirectory = new SubCategoryDirectory();
    }

    public function index()
    {
        $data['categories'] = Category::orderBy('id', 'DESC')->get();
        $data['subCategories'] = SubCategory::orderBy('id', 'DESC')->with(['category', 'directories'])->get();
        $data['directoryTypes'] = DirectoryType::all();
        return response()->json(['success' => true, 'data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subCategory = SubCategory::create([
            'name' => $request->name,
            'category_id' => $request->category_id
        ]);
        $this->subCategoryDirectory->store($subCategory->id, $request->directories);
        return response()->json(['success' => true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $subCategory = SubCategory::where('id', $id)->update([
            'name' => $request->name,
            'category_id' => $request->category_id
        ]);
        $this->subCategoryDirectory->updateDirectories($id, $request->directories);
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SubCategory::where('id', $id)->delete();
        return response()->json(['success' => true]);
    }
}
