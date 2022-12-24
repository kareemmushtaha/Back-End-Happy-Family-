<?php

namespace App\Http\Requests;

use App\Models\Governorate;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateGovernorateRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('governorate_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'branch_number' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'title_ar' => [
                'string',
                'required',
            ],
            'count' => [
                'string',
                'required',
            ],
        ];
    }
}
