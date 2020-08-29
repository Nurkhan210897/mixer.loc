<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ProductDirectory extends Model
{
    protected $table = 'product_directory';
    protected $fillable = ['product_id', 'directory_id'];
    public $timestamps = false;

    public function directory()
    {
        return $this->hasOne('App\Models\Admin\Directory');
    }
}
