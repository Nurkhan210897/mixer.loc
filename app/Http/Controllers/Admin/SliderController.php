<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    private $sliderModel;

    public function __construct()
    {
        $this->sliderModel = new Slider();
    }

    public function index()
    {
        $data = Slider::all();
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function store(Request $request)
    {
        $data = $this->sliderModel->storeData($request->all());
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $data = $this->sliderModel->updateData($request, $id);
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function destroy(Request $request, $id)
    {
        $this->sliderModel->deleteData($request, $id);
        return response()->json(['success' => true]);
    }
}
