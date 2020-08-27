<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{

    protected $fillable = ['name', 'category_id'];
    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo('App\Models\Admin\Category');
    }

    public function directories()
    {
        return $this->belongsToMany(
            'App\Models\Admin\DirectoryType',
            'sub_category_directories',
            'sub_category_id',
            'directory_type_id'
        );
    }
}
