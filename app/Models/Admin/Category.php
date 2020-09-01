<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;

class Category extends Model
{
    protected $fillable = ['name', 'serial_number', 'in_index'];
    public $timestamps = false;

    public function subCategories()
    {
        return $this->hasMany('App\Models\Admin\SubCategory');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Admin\Product');
    }

    public function getIndexData()
    {
        return Category::with([
            'subCategories' => function ($query) {
                $query->where('in_index', 1)->orderBy('serial_number', 'ASC');
            },
            'products' => function ($query) {
                $query->with(
                    ['images' => function ($query) {
                        $query->where('avatar', 1);
                    }]
                )->limit(4);
            }
        ])->withCount('products')
            ->where('in_index', 1)
            ->orderBy('serial_number', 'ASC')
            ->get();
    }
}
