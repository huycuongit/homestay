<?php

namespace App\Rules;

use App\Models\Classes;
use Illuminate\Contracts\Validation\Rule;

class UniqueClassSchedule implements Rule
{
    protected $classId;
    protected $branchIds;
    protected $startDate;
    protected $endDate;
    protected $daysOfWeek;
    protected $startTime;
    protected $endTime;

    /**
     * Create a new rule instance.
     *
     * @param mixed $branchIds
     * @param string $startDate
     * @param string $endDate
     * @param array $daysOfWeek
     * @param string $startTime
     * @param string $endTime
     * @param int|null $classId
     */
    public function __construct($branchIds, $startDate, $endDate, $daysOfWeek, $startTime, $endTime, $classId = null)
    {
        // Normalize branchIds to always be an array
        $this->branchIds = is_array($branchIds) ? $branchIds : [$branchIds];
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->daysOfWeek = $daysOfWeek;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->classId = $classId;
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
        if (in_array('all', $this->branchIds)) {
            $query = Classes::query();
        } else {
            $query = Classes::query()->whereIn('branch_id', $this->branchIds);
        }

        $query->where(function ($query) {
            $query->whereBetween('classes.start_date', [$this->startDate, $this->endDate])
                ->orWhereBetween('classes.end_date', [$this->startDate, $this->endDate])
                ->orWhere(function ($query) {
                    $query->where('classes.start_date', '<=', $this->startDate)
                        ->where('classes.end_date', '>=', $this->endDate);
                });
        })
            ->where(function ($query) {
                foreach ($this->daysOfWeek as $day) {
                    $query->orWhere("classes.{$day}", true);
                }
            })
            ->where(function ($query) {
                $query->where(function ($query) {
                    $query->where('classes.start_time', '<', $this->endTime)
                        ->where('classes.end_time', '>', $this->startTime);
                });
            });

        if ($this->classId) {
            $query->where('classes.id', '!=', $this->classId);
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
        return 'Lịch học của lớp bị trùng với lớp khác trong cùng một chi nhánh.';
    }
}
