<?php

namespace App\Http\Requests\Admin;

use App\Models\Report;
use App\Rules\Base64ImageSize;
use App\Rules\EndDateAfterStartDate;
use App\Rules\UniqueButAcceptNull;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReportUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        $rules = [


            'report_type_id' => 'required',
            'title' => [
                'required',
                'string',
                'min:5',
                Rule::unique((new Report())->getTable())->ignore($this->id),
            ],
            // 'quarter' => ['required'],
            // 'report_file' => [new Base64ImageSize(30)],
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'report_type_id.required' => 'Vui lòng chọn loại báo cáo.',
            //'name.min' => 'Vui lòng nhập Tên ít nhất 5 ký tự.',

            'title.required' => 'Vui lòng nhập thông tin tiêu đề.',
            'title.min' => 'Vui lòng nhập tiêu đề ít nhất 10 ký tự.',


            // 'phone.required' => 'Vui lòng nhập thông tin Phone.',
            // 'phone.min' => 'Vui lòng nhập Phone ít nhất 10 ký tự.',
            // 'phone.max' => 'Vui lòng nhập Phone lớn nhất 11 ký tự.',
            // 'phone.unique' => 'Phone đã tồn tại.',

            // 'birthday.required' => 'Vui lòng chọn ngày sinh.',
            //'report_file.max' => 'Tệp có kích thước tối đa 30MB.',
        ];
    }
}
