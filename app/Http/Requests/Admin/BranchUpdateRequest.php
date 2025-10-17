<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Branch;

class BranchUpdateRequest extends FormRequest
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
                Rule::unique((new Branch)->getTable())->ignore($this->id)
            ],
            // 'province_id' => [
            //     'required',
            // ],
            // 'district_id' => [
            //     'required',
            // ],
            // 'ward_id' => [
            //     'required',
            // ],
            // 'address' => [
            //     'required',
            //     'string',
            // ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập thông tin tên.',
            'name.min' => 'Vui lòng nhập tên ít nhất 5 ký tự.',
            'name.string' => 'Vui lòng nhập thông tin  tên là chuỗi.',
            'name.unique' => 'Tên đã tồn tại trong hệ thống.',

            'province_id.required' => 'Vui lòng chọn thông tin Tỉnh/Thành.',
            'district_id.required' => 'Vui lòng chọn thông tin Tỉnh/Thành.',
            'ward_id.required' => 'Vui lòng chọn thông tin Tỉnh/Thành.',

            'address.required' => 'Vui lòng nhập thông tin địa chỉ chi tiết.',
            'address.string' => 'Vui lòng nhập thông tin địa chỉ chi tiết là chuỗi.',
        ];
    }
}
