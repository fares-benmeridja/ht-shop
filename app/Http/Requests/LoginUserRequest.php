<?php

namespace App\Http\Requests;

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{

    /**
     * get login username.
     *
     * @return string
     */
    public function username()
    {
        return (new LoginController())->username();
    }

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
            $this->username() => 'required|string',
            'password' => 'required|string',
        ];
    }
}
