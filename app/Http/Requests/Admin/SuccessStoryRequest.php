<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SuccessStoryRequest extends FormRequest
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
        if (request()->isMethod('put')) {
            return [
                'name' => [
                    'required',
                    'string',
                ],

                'title' => [
                    'required',
                    'string',
                ],

                'description' => [
                    'required',
                    'string',
                ],

                'status' => [
                    'required',
                ],

            ];
        } else {
            return [
                'name' => [
                    'required',
                    'string',
                ],

                'title' => [
                    'required',
                    'string',
                ],

                'description' => [
                    'required',
                    'string',
                ],

                'status' => [
                    'required',
                ],

                'photo' => [
                    'required_without:id',
                ],
            ];
        }

    }
}
