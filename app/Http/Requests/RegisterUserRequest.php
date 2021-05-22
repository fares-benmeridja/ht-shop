<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return isset(request()->role_id)
            ? Auth::user()->is_main_admin
            : true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['bail','required', 'string', 'max:255'],
            'last_name' => ['bail','required', 'string', 'max:255'],
            'role_id' => ['bail','sometimes', 'required','exists:roles,id'],
            'email' => ['bail','required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['bail','required', 'min:8', 'max:16','confirmed'],
            'password_confirmation' => ['bail','required', 'min:8', 'max:16'],
            "phone" => ['bail', 'required', 'regex:/^[5-7]([.\s]?[0-9]{2}){4}$|^[2-4][1-9]([.\s]?[0-9]{2}){3}$/','unique:users,phone'],
            'commune_id' => ['bail','required','exists:communes,id'],
            'daira_id' => ['bail','required', 'exists:dairas,id'],
            'wilaya_id' => ['bail','required','exists:wilayas,id'],
            "address"   => ['bail', 'required', 'min:8', 'max:255'],
            'facebook' => ['bail', 'nullable','string', 'max:90'],
        ];
    }
}
