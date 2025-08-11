<?php

namespace App\Http\Requests\Admin;

use App\Models\Commit;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommitStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique(Commit::class)
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập thông tin Tiêu đề.',
            'name.string' => 'Vui lòng nhập thông tin Tiêu đề là chuỗi.',
            'name.unique' => 'Tiêu đề đã tồn tại trong hệ thống.',
        ];
    }
}
