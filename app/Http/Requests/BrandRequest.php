<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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

        $rules['brand_name_ar'] = 'required';

        $rules['brand_name_en'] = 'required';

        if ($this->method() == 'POST'){

            $rules['logo'] = 'required|'.validateImage();

        }else{

            $rules['logo'] = 'nullable|'.validateImage();
        }

        return $rules;
    }
}
