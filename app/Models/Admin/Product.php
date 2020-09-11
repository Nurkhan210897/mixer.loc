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

    public function updateImages($images)
    {
        Image::where('id', $this->id)->delete();
        $this->storeImages($images);
    }

    public function storeImages($data)
    {
        if (is_array($data)) {
            foreach ($data as $value) {
                $imagesInfo[] = $this->saveAndGetImageInfoForStore($value);
            }
        } else {
            $imagesInfo[] = $this->saveAndGetImageInfoForStore($data, true);
        }
        Image::insert($imagesInfo);
    }

    private function saveAndGetImageInfoForStore($image, $avatar = false)
    {
        return [
            'path' => Storage::putFile('images/products', $image),
            'name' => $image->getClientOriginalName(),
            'avatar' => $avatar,
            'product_id' => $this->id
        ];
    }

    public function delImages($images)
    {
        if (is_array($images)) {
            $ids = [];
            foreach ($images as $value) {
                Storage::delete($value->path);
                Image::where('id', $value->id)->delete();
            }
        } else {
            Storage::delete($images->path);
            Image::where('id', $images->id)->delete();
        }
    }

    public function deleteAllData()
    {
        ProductDirectory::where('product_id', $this->id)->delete();
        $images = Image::where('product_id', $this->id)->get();
        foreach ($images as $value) {
            $this->delImages($value);
        }
        Product::where('id', $this->id)->delete();
    }

    public function getSelectedProduct($id)
    {
        $data = Product::with([
            'directories' => function ($query) {
                $query->with('directoryTypes')->get();
            },
            'images'
        ])->where('id', $id)->first();
        return $data;
    }

    public function search($searched)
    {
        return Product::where('name', 'like', '%' . $searched . '%')
            ->select('id', 'name', 'price', 'code')
            ->take(10)
            ->get();
    }

    public function getToSession($id)
    {
        $product = Product::where('id', $id)
            ->with(['images' => function ($query) {
                $query->where('avatar', 1)->first();
            }])
            ->select('id', 'name', 'price', 'code')
            ->first()->toArray();
        return $product;
    }
}
