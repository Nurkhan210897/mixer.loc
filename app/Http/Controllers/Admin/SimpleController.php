<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Simple;

class SimpleController extends Controller
{

    private $model;

    public function __construct(Request $request)
    {
        $this->model = new simple($request->table);
    }

    public function index()
    {
        $data = $this->model->all();
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function store(Request $request)
    {
        $id = $this->model->insert($request->name);
        return response()->json(['success' => true, 'id' => $id]);
    }

    public function update(Request $request, $id)
    {
        $this->model->update($request->name, $id);
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $this->model->delete($id);
        return response()->json(['success' => true]);
    }
}
