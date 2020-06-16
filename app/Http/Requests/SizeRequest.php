<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SizeRequest extends FormRequest
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

        $rules['name_ar'] = 'required';

        $rules['name_en'] = 'required';

        $rules['department_id'] = 'required|numeric';

        $rules['is_public'] = 'required';

        return $rules;
    }
}
