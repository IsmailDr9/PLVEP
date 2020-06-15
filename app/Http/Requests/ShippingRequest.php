<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingRequest extends FormRequest
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

        $rules['lat'] = 'nullable';

        $rules['lan'] = 'nullable';

        $rules['user_id'] = 'required|numeric';

        if ($this->method() == 'POST'){

            $rules['icon'] = 'nullable|'.validateImage();

        }else{

            $rules['icon'] = 'nullable|'.validateImage();
        }

        return $rules;
    }
}
