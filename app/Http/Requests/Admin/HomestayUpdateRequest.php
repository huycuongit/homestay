<?php

namespace App\Http\Requests\Admin;

use App\Models\Service;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HomestayUpdateRequest extends FormRequest
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
                'string', 
                'min:5', 
                Rule::unique(Service::class)->ignore($this->id)
            ],
            'content' => ['string']
        ];
    }

    public function messages()
    {
        return [
            'name.min' => 'Vui lòng nhập tiêu đề ít nhất 5 ký tự.',
            'name.unique' => 'Tiêu đề câu hỏi đã tồn tại',
        ];
    }
}
