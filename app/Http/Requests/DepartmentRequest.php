<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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

        $rules['dep_name_ar'] = 'required';

        $rules['dep_name_en'] = 'required';

        $rules['parent'] = 'sometimes|nullable|numeric';

        $rules['icon'] = 'nullable|'.validateImage();

        $rules['description'] = 'sometimes|nullable';

        $rules['keyword'] = 'sometimes|nullable';

        return $rules;
    }
}
