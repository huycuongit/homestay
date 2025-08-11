<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Student;

class CccdUniqueValidation implements Rule
{
    protected $errorMessage;
    protected $id;

    public function __construct($id = null)
    {
        $this->id = $id;
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
        if (!ctype_digit($value)) {
            return true;
        }

        $exists = Student::where('cccd', $value)
            ->when($this->id, function ($query) {
                return $query->where('id', '!=', $this->id);
            })
            ->exists();

        if ($exists) {
            $this->errorMessage = 'CCCD đã tồn tại.';
            return false;
        }

        return true; // Không tồn tại, xác thực thành công
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->errorMessage ?: 'CCCD không hợp lệ.';
    }
}
