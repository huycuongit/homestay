<?php

namespace App\Http\Requests\Admin;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleUpdateRequest extends FormRequest
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
                'string',
                'min:5',
                Rule::unique(Role::class, 'name')->ignore($this->id)
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập thông tin name.',
            'name.min' => 'Vui lòng nhập tên ít nhất 5 ký tự.',
            'name.unique' => 'Tên role đã tồn tại trong hệ thống',
        ];
    }
}
