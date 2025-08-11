<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use App\Models\Admin;

class UserUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'min:5',
                Rule::unique((new Admin)->getTable())->ignore($this->id)
            ],
            'email' => [
                'required',
                'email',
                Rule::unique((new Admin)->getTable())->ignore($this->id)
            ],
            // 'phone' => [
            //     'numeric',
            //     Rule::unique((new Admin)->getTable())->ignore($this->id)
            // ],
            'department_id' => 'required',
            'roles' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập thông tin name.',
            'name.min' => 'Vui lòng nhập tên ít nhất 5 ký tự.',
            'name.unique' => 'Tên đã tồn tại.',

            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại.',

            'phone.numeric' => 'Số điện thoại phải là chữ số.',
            'phone.unique' => 'Số điện thoại đã tồn tại.',

            'department_id.required' => 'Phòng ban không được trống.',
            'roles.required' => 'Role không được trống.',
        ];
    }
}
