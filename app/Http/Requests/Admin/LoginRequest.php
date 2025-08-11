<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

use App\Rules\Recaptcha;

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
            'email' => 'required|max:255',
            'password' => 'required|max:20|min:4',
            'g-recaptcha-response' => ['required', new Recaptcha]
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => __('admin/login.required', ['field' => 'Email']),
            'email.max' => __('admin/login.max_255', ['field' => 'Email']),
            'password.required' => __('admin/login.required', ['field' => 'Mật khẩu']),
            'password.max' => __('admin/login.max_255', ['field' => 'Mật khẩu']),
            'password.min' => __('admin/login.min_4', ['field' => 'Mật khẩu']),
            'g-recaptcha-response.required' =>  __('admin/login.recaptcha'),
        ];
    }
}
