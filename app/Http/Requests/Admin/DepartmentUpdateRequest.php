<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use App\Models\Department;

class DepartmentUpdateRequest extends FormRequest
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
                Rule::unique((new Department)->getTable())->ignore($this->id)
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập thông tin tên.',
            'name.min' => 'Vui lòng nhập tên ít nhất 5 ký tự.',
            'name.string' => 'Vui lòng nhập thông tin  tên là chuỗi.',
            'name.unique' => 'Tên đã tồn tại trong hệ thống.',
        ];
    }
}
