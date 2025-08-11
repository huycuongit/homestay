<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\News;

class NewsUpdateRequest extends FormRequest
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
                Rule::unique((new News)->getTable())->ignore($this->id)
            ],
            // 'news_category_id' => [
            //     'required',
            // ],
            'avatar' => [
                'required',
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập thông tin tên.',

            'news_category_id.required' => 'Vui lòng nhập thông tin loại bài viết.',
            'avatar.required' => 'Vui lòng nhập thông tin avatar.',
        ];
    }
}
