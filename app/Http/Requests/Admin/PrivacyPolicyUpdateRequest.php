<?php

namespace App\Http\Requests\Admin;

use App\Models\PrivacyPolicy;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PrivacyPolicyUpdateRequest extends FormRequest
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
                'string', 
                'min:5', 
                Rule::unique(PrivacyPolicy::class)->ignore($this->id)
            ],
            'content' => [ 'string']
        ];
    }

    public function messages()
    {
        return [
            'title.min' => 'Vui lòng nhập tiêu đề ít nhất 5 ký tự.',
            'title.unique' => 'Tiêu đề câu hỏi đã tồn tại',
        ];
    }
}
