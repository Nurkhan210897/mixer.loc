<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Directory extends Model
{
    public $timestamps = false;

    public function directoryTypes()
    {
        return $this->belongsTo('App\Models\Admin\DirectoryType', 'directory_type_id');
    }
}
