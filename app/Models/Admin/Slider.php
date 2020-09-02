<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Slider extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function storeData($request)
    {
        $request['image'] = Storage::putFile('images/sliders', $request['image']);
        $data = Slider::create($request);
        return $data;
    }

    public function updateData($request, $id)
    {
        $slider = Slider::find($id);
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->serial_number = $request->serial_number;
        $slider->link_name = $request->link_name;
        $slider->link = $request->link;
        $slider->image = $this->handleImage($request);
        $slider->save();
        return $slider;
    }

    private function handleImage($request)
    {
        if ($request->has('delImage')) {
            Storage::delete($request->delImage);
            $newImage = "";
        }
        if ($request->has('updImage')) {
            Storage::delete($request->image);
            $newImage = Storage::putFile('images/sliders', $request->updImage);
        }
        return $newImage;
    }

    public function deleteData($request, $id)
    {
        if (!empty($request->image)) {
            Storage::delete($request->image);
        }
        Slider::destroy($id);
    }
}
