<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PageUpdateRequest extends FormRequest
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
            'image_ids' => [
                'required', 
            ],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Vui lòng nhập thông tin title.',
        ];
    }
}
