<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BreakTimeValidation implements Rule
{
    protected $shiftStartTime;
    protected $shiftEndTime;
    protected $errorMessage;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($shiftStartTime, $shiftEndTime)
    {
        $this->shiftStartTime = $shiftStartTime;
        $this->shiftEndTime = $shiftEndTime;
        $this->errorMessage = '';
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->errorMessage = '';

        $breakStartTime = request()->input('break_start_time');
        $breakEndTime = request()->input('break_end_time');

        if ($attribute === 'break_start_time') {
            if ($breakStartTime && ($breakStartTime < $this->shiftStartTime || $breakStartTime > $this->shiftEndTime)) {
                $this->errorMessage = 'Thời gian bắt đầu nghỉ phải nằm trong khoảng thời gian làm việc.';
                return false;
            }
            if ($breakEndTime && $breakStartTime >= $breakEndTime) {
                $this->errorMessage = 'Thời gian bắt đầu nghỉ phải trước thời gian kết thúc nghỉ.';
                return false;
            }
        }

        if ($attribute === 'break_end_time') {
            if ($breakEndTime && ($breakEndTime < $this->shiftStartTime || $breakEndTime > $this->shiftEndTime)) {
                $this->errorMessage = 'Thời gian kết thúc nghỉ phải nằm trong khoảng thời gian làm việc.';
                return false;
            }
            if ($breakStartTime && $breakEndTime <= $breakStartTime) {
                $this->errorMessage = 'Thời gian kết thúc nghỉ phải sau thời gian bắt đầu nghỉ.';
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->errorMessage ?: 'Thời gian nghỉ không hợp lệ.';
    }
}
