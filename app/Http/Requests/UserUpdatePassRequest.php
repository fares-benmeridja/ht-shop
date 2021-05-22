<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\MatchOldPassword;

class UserUpdatePassRequest extends FormRequest
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
            'current_password' => ['bail', 'required', new MatchOldPassword],
            'password' => ['bail','required', 'min:8', 'max:16','confirmed'],
            'password_confirmation' => ['bail','required', 'min:8', 'max:16', 'same:password'],
        ];
    }
}
