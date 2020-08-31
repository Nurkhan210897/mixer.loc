<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use App\Models\Admin\DirectoryType;
use App\Models\Admin\SubCategoryDirectory;
use Illuminate\Support\Facades\Storage;

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
            'category_id' => $request->category_id,
            'serial_number' => $request->serial_number,
            'in_index' => (int)$request->in_index,
            'avatar' => $request->file('avatar')->store('images/subCategories'),
        ]);
        $this->subCategoryDirectory->store($subCategory->id, json_decode($request->directories));
        $data = SubCategory::where('id', $subCategory->id)->orderBy('id', 'DESC')->with(['category', 'directories'])->get();
        return response()->json(['success' => true, 'data' => $data]);
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
        SubCategory::updData($request, $id);
        $this->subCategoryDirectory->updateDirectories($id, json_decode($request->directories));
        $data = SubCategory::where('id', $id)->orderBy('id', 'DESC')->with(['category', 'directories'])->get();
        return response()->json(['success' => true, 'data' => $data]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if (!empty($request->avatar)) {
            Storage::delete($request->avatar);
        }
        SubCategory::where('id', $id)->delete();
        return response()->json(['success' => true]);
    }
}
