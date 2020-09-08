<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Question;

class QuestionController extends Controller
{
    public function index()
    {
        $data = Question::all();
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function update(Request $request, $id)
    {
        Question::where('id', $id)->update([
            'status' => $request->status
        ]);
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Question::destroy($id);
        return response()->json(['success' => true]);
    }
}
