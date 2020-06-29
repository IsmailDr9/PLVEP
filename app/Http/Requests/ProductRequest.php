<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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

        $rules['title'] = 'required';
        $rules['content'] = 'required';
        $rules['department_id'] = 'required|numeric';
        $rules['brand_id'] = 'required|numeric';
        $rules['manu_id'] = 'required|numeric';
        $rules['color_id'] = 'nullable|numeric';
        $rules['size_id'] = 'nullable|numeric';
        $rules['weight'] = 'sometimes|nullable';
        $rules['size'] = 'sometimes|nullable';
        $rules['weight_id'] = 'required|nullable|numeric';
        $rules['currency_id'] = 'nullable|numeric';
        $rules['stock'] = 'required|numeric';
        $rules['price'] = 'required|numeric';
        $rules['start_at'] = 'nullable|date';
        $rules['end_at'] = 'nullable|date';
        $rules['price_offer'] = 'sometimes|nullable|numeric';
        $rules['start_offer_at'] = 'sometimes|nullable|date';
        $rules['end_offer_at'] = 'sometimes|nullable|date';
        $rules['status'] = 'sometimes|nullable|in:pending,refused,active';
        $rules['reason'] ='sometimes|nullable';

        return $rules;
    }
}
