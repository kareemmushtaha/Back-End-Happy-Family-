<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class InformationUserRequest extends FormRequest
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
            'municipal_name' => 'required|max:100',
            'count_population' => 'required|max:100',
            'aria_name' => 'required|max:100',
            'category_local_government' => 'required|max:100',
            'marker_municipal_fund' => 'required|max:100',
            'mayor_email' => 'required|email',
            'mayor_phone' => 'required|numeric',
            'engineer_email' => 'required|email',
            'engineer_phone' => 'required|numeric',
        ];
    }


    public function messages()
    {
        return [
            'municipal_name.required' => __('validation.required'),
            'count_population.required' => __('validation.required'),
            'aria_name.required' => __('validation.required'),
            'category_local_government.required' => __('validation.required'),
            'marker_municipal_fund.required' => __('validation.required'),
            'mayor_email.required' => __('validation.required'),
            'mayor_phone.required' => __('validation.required'),
            'engineer_email.required' => __('validation.required'),
            'engineer_phone.required' => __('validation.required'),
            'mayor_email.email' => __('validation.email'),
            'engineer_email.email' => __('validation.email'),
            'max' => __('validation.required'),
            'numeric' => __('validation.numeric'),
        ];
    }
}
