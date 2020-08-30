<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use App\Models\Admin\Product;
use App\Models\Admin\DirectoryType;
use App\Models\Admin\ProductDirectory;

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
        $data['products'] = Product::with('category', 'subCategory', 'directories', 'images')->get();
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function show()
    {
        $data['categories'] = Category::all();
        $data['subCategories'] = SubCategory::with('directories')->get();
        $data['products'] = Product::with('directories')->get();
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function getDirectories(Request $request)
    {
        $data = $this->directoryType->getSubCategoryDirectories($request->directories);
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->count = $request->count;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->height = $request->height;
        $product->width = $request->width;
        $product->length = $request->length;
        $product->weight = $request->weight;
        $product->save();

        $product->storeDirectories($request->directories);

        $product->storeImages($request->avatar);
        $product->storeImages($request->images);

        $resData = Product::where('id', $product->id)->with('category', 'subCategory', 'directories', 'images')->get();
        return response()->json(['success' => true, 'data' => $resData]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->count = $request->count;
        $product->weight = $request->weight;
        $product->height = $request->height;
        $product->width = $request->width;
        $product->length = $request->length;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->save();

        $product->updateDirectories($request->directories);
        if ($request->has('updAvatar')) {
            $product->storeImages($request->updAvatar);
            if ($request->has('avatar')) {
                $product->delImages(json_decode($request->avatar));
            }
        }
        if ($request->has('delAvatar')) {
            $product->delImages(json_decode($request->delAvatar));
        }
        if ($request->has('updImages')) {
            $product->storeImages($request->updImages);
        }
        if ($request->has('delImages')) {
            $product->delImages(json_decode($request->delImages));
        }

        $resData = Product::where('id', $product->id)->with('category', 'subCategory', 'directories', 'images')->get();
        return response()->json(['success' => true, 'data' => $resData]);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->deleteAllData();
        return response()->json(['success' => true]);
    }
}
