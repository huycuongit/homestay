<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Base64ImageSize implements Rule
{
    protected $maxSize;

    public function __construct($maxSize)
    {
        $this->maxSize = $maxSize; // Max size in MB
    }

    public function passes($attribute, $value)
    {
        // Remove the data URL part if present
        $data = preg_replace('/^data:image\/\w+;base64,/', '', $value);
        $data = base64_decode($data);

        // Check if the size exceeds the limit
        return strlen($data) <= $this->maxSize * 1024 * 1024; // Convert MB to bytes
    }

    public function message()
    {
        return ':attribute phải nhỏ hơn hoặc bằng ' . $this->maxSize . ' MB.';
    }
}
