<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sort' => 'sometimes|required|in:ASC,DESC',
            'page' => 'sometimes|required|integer',
            'dir' => 'sometimes|required|array',
            'dir.*' => 'sometimes|required|integer'
        ];
    }
}
