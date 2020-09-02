<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\Product;

class SubCategory extends Model
{

    protected $fillable = ['name', 'category_id', 'serial_number', 'in_index', 'avatar'];
    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo('App\Models\Admin\Category');
    }

    public function directoryTypes()
    {
        return $this->belongsToMany(
            'App\Models\Admin\DirectoryType',
            'sub_category_directories',
            'sub_category_id',
            'directory_type_id'
        );
    }

    public function products()
    {
        return $this->hasMany('App\Models\Admin\Product');
    }

    public static function updData($request, $id)
    {
        $updData = [
            'name' => $request->name,
            'category_id' => $request->category_id,
            'serial_number' => $request->serial_number,
            'in_index' => (int)$request->in_index
        ];
        if ($request->has('delAvatar')) {
            $updData['avatar'] = $request->file('updAvatar')->store('images/subCategories');
            $updData['avatar'] = '';
        }
        if ($request->has('updAvatar')) {
            $updData['avatar'] = $request->file('updAvatar')->store('images/subCategories');
            if ($request->avatar) {
                Storage::delete($request->avatar);
            }
        }

        $subCategory = SubCategory::where('id', $id)->update($updData);
    }

    public function getProductsWithPaginate($id, $paginate = 24)
    {
        $products = Product::with(['images' => function ($query) {
            $query->where('avatar', 1);
        }])->select('id', 'name', 'price')->where('sub_category_id', $id)->paginate($paginate);

        return $products;
    }
}
