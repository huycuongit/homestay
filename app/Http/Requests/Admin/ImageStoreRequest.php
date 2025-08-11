<?php

namespace App\Http\Requests\Admin;

use App\Models\FrequentQuestion;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ImageStoreRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => [
                'required', 
                'string', 
                'min:5', 
            ],
            'url' => [
                'required', 
                'string', 
                'min:5', 
            ],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Vui lòng nhập thông tin title.',
            'title.min' => 'Vui lòng nhập tiêu đề ít nhất 5 ký tự.',
            'title.unique' => 'Tiêu đề câu hỏi đã tồn tại',
        ];
    }
}
