<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Admin\Question;

class QuestionController extends Controller
{
    public function create(QuestionRequest $request)
    {
        Question::create($request->all());
        return response()->json(['success' => true]);
    }
}
