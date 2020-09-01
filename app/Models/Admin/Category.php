<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'serial_number', 'in_index'];
    public $timestamps = false;

    public function subCategories()
    {
        return $this->hasMany('App\Models\Admin\SubCategory');
    }
}
