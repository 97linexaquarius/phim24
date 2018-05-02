<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'txtEmail' => 'required|email',
            'txtPass' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'txtEmail.required' => 'Vui lòng nhập Email',
            'txtPass.required'  => 'Vui lòng nhập Password',
            'txtEmail.email' => 'Email bạn nhập không hợp lệ',
        ];
    }
}
