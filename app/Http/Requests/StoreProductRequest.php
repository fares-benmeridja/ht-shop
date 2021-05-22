<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            "title"         => ['bail', 'required', 'string', 'min:3', 'max:100'],
            "price"         => ['bail', 'required', 'integer', 'min:0'],
            "quantity"      => ['bail', 'required', 'integer', 'min:1', 'max:9999'],
            "description"   => ['bail', 'required', 'string', 'min:3', 'max:999999'],
            "category_id"   => ['bail', 'required', "exists:categories,id"],
            'images'        => ['required'],
            "images.*"      => ['bail','image', 'mimes:jpg, jpeg, png, gif', 'max:30000'],
        ];
    }

    public function attributes()
    {
        return [
            'category_id' => 'category'
        ];
    }
}
