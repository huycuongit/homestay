<?php

namespace App\Http\Requests\Admin;

use App\Models\Customer;
use App\Rules\Base64ImageSize;
use App\Rules\EndDateAfterStartDate;
use App\Rules\UniqueButAcceptNull;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|string|min:5',
            'email' => [
                'required',
                'string',
                'min:5',
                'email',
                Rule::unique((new Customer())->getTable())->ignore($this->id),
            ],
            // 'phone' => [
            //     Rule::unique((new Customer)->getTable())->ignore($this->id),
            // ],

            'avatar' => [new Base64ImageSize(2)],
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập thông tin Tên.',
            'name.min' => 'Vui lòng nhập Tên ít nhất 5 ký tự.',

            'email.required' => 'Vui lòng nhập thông tin Email.',
            'email.min' => 'Vui lòng nhập Email ít nhất 10 ký tự.',
            'email.email' => 'Sai định dạng Email.',
            'email.unique' => 'Email đã tồn tại.',

            // 'phone.required' => 'Vui lòng nhập thông tin Phone.',
            // 'phone.min' => 'Vui lòng nhập Phone ít nhất 10 ký tự.',
            // 'phone.max' => 'Vui lòng nhập Phone lớn nhất 11 ký tự.',
            // 'phone.unique' => 'Phone đã tồn tại.',

            'birthday.required' => 'Vui lòng chọn ngày sinh.',
            'avatar.max' => 'Hình ảnh có kích thước tối đa 1MB.',

        ];
    }
}
