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
}
