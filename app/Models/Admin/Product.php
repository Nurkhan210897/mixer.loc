<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\ProductDirectory;
use App\Models\Admin\Image;
use Illuminate\Support\Facades\Storage;
use DB;

class Product extends Model
{

    public function category()
    {
        return $this->belongsTo('App\Models\Admin\Category');
    }

    public function subCategory()
    {
        return $this->belongsTo('App\Models\Admin\SubCategory');
    }

    public function directories()
    {
        return $this->belongsToMany(
            'App\Models\Admin\Directory',
            'product_directory',
            'product_id',
            'directory_id'
        );
    }

    public function images()
    {
        return $this->hasMany('App\Models\Admin\Image');
    }

    public function updateDirectories($directories)
    {
        ProductDirectory::where('product_id', $this->id)->delete();
        $this->storeDirectories($directories);
    }

    public function storeDirectories($directories)
    {
        $data = $this->getDataForStore($directories);
        ProductDirectory::insert($data);
    }

    private function getDataForStore($directories)
    {
        $data = [];
        $directories = explode(',', $directories);
        foreach ($directories as $key => $value) {
            $data[$key]['product_id'] = $this->id;
            $data[$key]['directory_id'] = $value;
        }
        return $data;
    }

    public function updateImages($avatar, $images)
    {
        Image::where('id', $this->id)->delete();
        $this->storeImages($avatar, $images);
    }

    public function storeImages($avatar, $images)
    {
        if (!empty($avatar) and !empty($images)) {
            $imagesInfo = [];
            $imagesInfo[] = $this->saveAndGetImageInfoForStore($avatar, true);
            foreach ($images as $value) {
                $imagesInfo[] = $this->saveAndGetImageInfoForStore($value);
            }
            Image::insert($imagesInfo);
        }
    }

    private function saveAndGetImageInfoForStore($image, $avatar = false)
    {
        return [
            'path' => Storage::putFile('images', $image),
            'name' => $image->getClientOriginalName(),
            'avatar' => $avatar,
            'product_id' => $this->id
        ];
    }

    public function deleteAllData()
    {
        ProductDirectory::where('product_id', $this->id)->delete();
        Image::where('product_id', $this->id)->delete();
        Product::where('id', $this->id)->delete();
    }

    // public function getIndexData()
    // {
    //     $products = DB::table('products')
    //         ->join('product_directory', 'products.id', '=', 'product_directory.product_id')
    //         ->join('directories', 'product_directory.directory_id', '=', 'directories.id')
    //         ->join('directory_types', 'directories.directory_type_id', '=', 'directory_types.id')
    //         ->join('categories', 'products.category_id', '=', 'categories.id')
    //         ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
    //         ->select(
    //             'products.name',
    //             'products.price',
    //             'products.count',
    //             'products.length',
    //             'products.height',
    //             'products.width',
    //             'products.weight',
    //             'categories.name as category',
    //             'sub_categories.name as subCategory',
    //             'directories.name as directory',
    //             'directory_types.name as directoryType'
    //         )
    //         ->get();
    //     return $products;
    // }
}
