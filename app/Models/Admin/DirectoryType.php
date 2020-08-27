<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class DirectoryType extends Model
{
    public function getSubCategoryDirectories($directories)
    {
        $ids = $this->implodeDirectoryTypeId($directories);
        $data = DirectoryType::whereIn('id', $ids)->with('directories')->get();
        return $data;
    }

    public function directories()
    {
        return $this->hasMany('App\Models\Admin\Directory');
    }

    private function implodeDirectoryTypeId($directories)
    {
        $ids = [];
        foreach ($directories as $value) {
            $directory = json_decode($value);
            $ids[] = $directory->pivot->directory_type_id;
        }
        return $ids;
    }
}
