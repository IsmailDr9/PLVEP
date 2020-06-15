<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StateRequest extends FormRequest
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
        $rules = [];

        $rules['state_name_ar'] = 'required';

        $rules['state_name_en'] = 'required';

        $rules['city_id'] = 'required|numeric';

        $rules['country_id'] = 'required|numeric';

        return $rules;
    }
}
