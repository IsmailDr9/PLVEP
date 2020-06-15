<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
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

        $rules['country_name_ar'] = 'required';

        $rules['country_name_en'] = 'required';

        $rules['mob'] = 'required';

        $rules['code'] = 'required';

        if ($this->method() == 'POST'){

            $rules['logo'] = 'required|'.validateImage();

        }else{

            $rules['logo'] = 'nullable|'.validateImage();
        }

        return $rules;
    }
}
