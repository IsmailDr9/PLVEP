<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManufacturerRequest extends FormRequest
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

        $rules['facebook'] = 'nullable|url';

        $rules['twitter'] = 'nullable|url';

        $rules['website'] = 'nullable|url';

        $rules['contact_name'] = 'nullable';

        $rules['email'] = 'required|email';

        $rules['mobile'] = 'required|numeric';

        $rules['lat'] = 'nullable';

        $rules['lan'] = 'nullable';

        $rules['address'] = 'nullable';

        if ($this->method() == 'POST'){

            $rules['icon'] = 'nullable|'.validateImage();

        }else{

            $rules['icon'] = 'nullable|'.validateImage();
        }

        return $rules;
    }
}
