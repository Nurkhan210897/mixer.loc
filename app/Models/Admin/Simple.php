<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;

class Simple
{
    private $table;

    public function __construct($table)
    {
        $this->table = DB::table($table);
    }

    public function all()
    {
        $data = $this->table->orderBy("id", "DESC")->get();
        return $data;
    }

    public function insert($name)
    {
        $id = $this->table->insertGetId(
            ['name' => $name]
        );
        return $id;
    }

    public function update($name, $id)
    {
        $this->table->where('id', $id)->update([
            'name' => $name
        ]);
    }

    public function delete($id)
    {
        $this->table->where('id', $id)->delete();
    }
}
