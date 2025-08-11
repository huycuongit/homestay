<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueButAcceptNull implements Rule
{
    protected $model;
    protected $column;
    protected $ignoreId;
    protected $name;

    /**
     * Create a new rule instance.
     *
     * @param  string  $table
     * @param  string  $column
     * @param  int|null  $ignoreId
     * @return void
     */
    public function __construct($model, $column, $ignoreId = null, $name = null)
    {
        $this->model = $model;
        $this->column = $column;
        $this->ignoreId = $ignoreId;
        $this->name = $name;
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
        if (!$this->name) {
            $this->name = $attribute;
        }

        if (is_null($value)) {
            return true;
        }

        $query = $this->model::where($this->column, $value);
        if ($this->ignoreId) {
            $query->where('id', '<>', $this->ignoreId);
        }

        return !$query->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "{$this->name} đã tồn tại trong hệ thống.";
    }
}
