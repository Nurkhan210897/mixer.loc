<?php

namespace App\Http\Controllers\Admin\Filter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Filter\MixerShape;

class MixerShapeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = MixerShape::orderBy('id', 'DESC')->get();
        return response()->json(['success' => true, 'data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = MixerShape::create($request->all());
        return response()->json(['success' => true, 'data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = MixerShape::where('id', $id)->update($request->all());
        return response()->json(['success' => true, 'data' => $data]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MixerShape::where('id', $id)->delete();
        return response()->json(['success' => true]);
    }
}
