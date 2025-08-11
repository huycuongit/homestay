<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Rules\Recaptcha;

class StoreEventContactRequest extends FormRequest
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
            'full_name' => 'required|max:255',
            'phone' => 'required|max:20|min:10',
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
            'full_name.required' => __('contact.required', ['field' => 'Họ Tên']),
            'full_name.max' => __('contact.max_255', ['field' => 'Họ Tên']),
            'phone.required' => __('contact.required', ['field' => 'Số điện thoại']),
            'phone.max' => __('contact.max_20', ['field' => 'Số điện thoại']),
            'phone.min' => __('contact.min_10', ['field' => 'Số điện thoại']),
            'g-recaptcha-response.required' =>  __('contact.recaptcha'),
        ];
    }
}
