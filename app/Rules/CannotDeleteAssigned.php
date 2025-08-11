<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CannotDeleteAssigned implements Rule
{
    protected $model;
    protected $relation;

    public function __construct($model, $relation)
    {
        $this->model = $model;
        $this->relation = $relation;
    }

    public function passes($attribute, $value)
    {
        $item = $this->model::find($value);
        return $item && !$item->{$this->relation}->count();
    }

    public function message()
    {
        return 'Không thể xoá dữ liệu đã được liên kết';
    }
}
