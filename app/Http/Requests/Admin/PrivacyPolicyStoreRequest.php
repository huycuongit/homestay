<?php

namespace App\Http\Requests\Admin;

use App\Models\PrivacyPolicy;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PrivacyPolicyStoreRequest extends FormRequest
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
            'title' => [
                'required', 
                'string', 
                'min:5', 
                Rule::unique(PrivacyPolicy::class)
            ],
            'content' => [ 'required', 'string']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Vui lòng nhập thông tin title.',
            'title.min' => 'Vui lòng nhập tiêu đề ít nhất 5 ký tự.',
            'title.unique' => 'Tiêu đề câu hỏi đã tồn tại',
            'content.required' => 'Vui lòng nhập thông tin content.',
        ];
    }
}
