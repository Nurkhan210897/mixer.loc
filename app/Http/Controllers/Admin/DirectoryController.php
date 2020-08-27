<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Directory;

class DirectoryController extends Controller
{

    public function index(Request $request)
    {
        $data = Directory::where('directory_type_id', $request->directoryTypeId)->get();
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function store(Request $request)
    {
        $directory = new Directory();
        $directory->name = $request->name;
        $directory->directory_type_id = $request->directoryTypeId;
        $directory->save();
        return response()->json(['success' => true, 'id' => $directory->id]);
    }

    public function update(Request $request, $id)
    {
        Directory::where('id', $id)->update([
            'name' => $request->name
        ]);
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Directory::destroy($id);
        return response()->json(['success' => true]);
    }
}
