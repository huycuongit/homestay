<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use App\Models\DevelopmentMilestone;

class CompanyHistoryStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // 'name' => [
            //     'string',
            //     'max:255',
            //     'min:5',
            // ]
        ];
    }

    public function messages()
    {
        return [
            'name.max' => 'Vui lòng nhập tên tối đa  255 ký tự.',
            'name.min' => 'Vui lòng nhập tên ít nhất 5 ký tự.'
        ];
    }
}
