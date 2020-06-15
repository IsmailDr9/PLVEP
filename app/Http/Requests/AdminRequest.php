<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AdminRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $rules = [];

        if ($this->method() == 'POST') {

            $rules['email'] = 'required|min:2|max:100|unique:admins';

            $rules['name'] = 'required|min:2|max:120';

            $rules['password'] = 'required|min:6';

        } else {
            $rules['email'] = "required|min:2|max:100|unique:admins,email,$this->id,id";

            $rules['name'] = 'required|min:2|max:120';

            $rules['password'] = 'sometimes|nullable|min:6';
        }

        return $rules;
    }
}
