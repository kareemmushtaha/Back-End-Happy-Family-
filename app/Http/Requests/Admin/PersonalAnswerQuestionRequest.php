<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PersonalAnswerQuestionRequest extends FormRequest
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
            'answer_title_ar' => [
                'required',
                'string',
            ],
            'question_id' => [
                'sometimes',
                'exists:questions,id',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
