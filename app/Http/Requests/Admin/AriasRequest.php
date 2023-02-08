<?php

namespace App\Http\Requests\Admin;

 use Illuminate\Foundation\Http\FormRequest;

class AriasRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title_ar' => [
                'string',
                'required',
            ],

        ];
    }
}
