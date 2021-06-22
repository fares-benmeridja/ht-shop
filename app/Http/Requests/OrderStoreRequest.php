<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class OrderStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
//            'commune_id'    => ['bail', 'required', 'exists:communes,id'],
//            'daira_id'      => ['bail', 'required', 'exists:dairas,id'],
//            'wilaya_id'     => ['bail', 'required', 'exists:wilayas,id'],
//            'description'   => ['bail', 'nullable', 'max:9999'],
//            'zip_code'      => ['bail', 'required', 'integer'],
            "address"       => ['bail', 'required', 'min:8', 'max:255'],

        ];
    }

//    public function attributes()
//    {
//        return [
//            'commune_id' => 'commune',
//            'daira_id'   => 'daira',
//            'wilaya_id'  => 'wilaya',
//            'zip_code'   => 'zip code'
//        ];
//    }
}
