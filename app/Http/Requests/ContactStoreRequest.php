<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactStoreRequest extends FormRequest
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
            'email' => ['bail', 'sometimes', 'required', 'email','min:3', 'max:90'],
            'object' => ['bail', 'required', 'min:3', 'max:150'],
            "message" => ['bail', 'required', 'min:5', "max:10000"]
        ];
    }
}
