<?php

namespace App\Http\Requests\Admin;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpgradeSubscriptionRequest extends FormRequest
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
            'start_date' => [
                'required',
                'date',
                'after_or_equal:' . Carbon::now()->format('Y-m-d'),
            ],
            'end_subscription_date' => [
                'required',
                'date',
                'after_or_equal:' . Carbon::now()->format('Y-m-d'),

            ],

            'price' => [
                'required',
                'numeric',
            ],


        ];
    }
}
