<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Question;

class QuestionController extends Controller
{
    public function create(Request $request)
    {
        Question::create($request->all());
        return response()->json(['success' => true]);
    }
}
