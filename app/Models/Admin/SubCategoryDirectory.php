<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;

class SubCategoryDirectory extends Model
{
    protected $fillable = ['sub_category_id', 'directory_type_id'];
    public $timestamps = false;

    public function store($subCategoryId, $directories)
    {
        $data = $this->makeInsertData($subCategoryId, $directories);
        SubCategoryDirectory::insert($data);
    }

    private function makeInsertData($subCategoryId, $directories)
    {
        $data = [];
        foreach ($directories as $key => $value) {
            $data[$key]['sub_category_id'] = $subCategoryId;
            $data[$key]['directory_type_id'] = $value->id;
        }
        return $data;
    }

    public function updateDirectories($subCategoryId, $directories)
    {
        $this->delete($subCategoryId);
        $this->store($subCategoryId, $directories);
    }

    private function deleteDirectories($subCategoryId)
    {
        SubCategoryDirectory::where('sub_category_id', $subCategoryId)->delete();
    }
}
