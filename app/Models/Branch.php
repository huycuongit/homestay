<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use App\Traits\UploadsImageTrait;

class Branch extends Model
{
    use UploadsImageTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'address',
        'sort_name',
        'description',
        'active',
        'position',

        'ward_id',
        'district_id',
        'province_id',

        'lat',
        'lng',
        'iframe',

        'created_by_id',
        'updated_by_id',

        'avatar',

        'full_address',

        'name_gym_master'
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

    public function userCreated()
    {
        return $this->belongsTo(Admin::class, 'created_by_id');
    }

    public function userUpdated()
    {
        return $this->belongsTo(Admin::class, 'updated_by_id');
    }

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }

    public function classLessons()
    {
        return $this->hasMany(ClassLesson::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function admins()
    {
        return $this->belongsToMany(Admin::class, 'admin_branch')
            ->withTimestamps();
    }

    public function classes()
    {
        return $this->belongsToMany(Classes::class, 'branch_class', 'branch_id', 'class_id')
            ->withTimestamps();
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_branches')->withTimestamps();
    }

    public function coaches()
    {
        return $this->belongsToMany(Coach::class, 'coach_branches')->withTimestamps();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_branch')->withTimestamps();
    }

    public function promotions()
    {
        return $this->belongsToMany(Promotion::class, 'promotion_branch')->withTimestamps();
    }

    public function contracts()
    {
        return $this->belongsToMany(Promotion::class, 'contract_branch')->withTimestamps();
    }

    public function getTotalInstrumentAttribute()
    {
        return $this->classrooms()->whereHas('classtype', function ($query) {
            $query->where('key', 'CLASS_PRACTICE');
        })->withCount('instruments')->get()->sum('instruments_count');
    }

    /**
     * Scope a query to only include inactive contact.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeInActive($query)
    {
        $query->where('active', 0);
    }

    /**
     * Scope a query to only include active contact.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeActive($query)
    {
        $query->where('active', 1);
    }


    /**
     * Scope a query to order results by multiple columns.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  array  $columns
     * @param  string  $direction
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderByMultipleColumns($query, array $columns, $direction = 'asc')
    {
        foreach ($columns as $column) {
            $query->orderBy($column, $direction);
        }

        return $query;
    }

    public function setFullAddressAttribute()
    {
        $address = '';

        if ($this->address) {
            $address .= $this->address;
        }

        if ($this->ward) {
            if ($address) {
                $address .= ', ';
            }
            $address .= $this->ward->name;
        }

        if ($this->district) {
            if ($address) {
                $address .= ', ';
            }
            $address .= $this->district->name;
        }

        if ($this->province) {
            if ($address) {
                $address .= ', ';
            }
            $address .= $this->province->name;
        }

        $this->attributes['full_address'] = $address;
    }

    public function getFullAddressAttribute()
    {
        $address = '';

        if ($this->address) {
            $address .= $this->address;
        }

        if ($this->ward) {
            if ($address) {
                $address .= ', ';
            }
            $address .= $this->ward->name;
        }

        if ($this->district) {
            if ($address) {
                $address .= ', ';
            }
            $address .= $this->district->name;
        }

        if ($this->province) {
            if ($address) {
                $address .= ', ';
            }
            $address .= $this->province->name;
        }

        return $address;
    }

    public function getBookingFutureAttribute()
    {
        $now = Carbon::now();
        $total = 0;

        // Have classlesson BOOKING_TYPE_CLASS
        $classLessonsCount = $this->classLessons()
            ->where(function ($q) use ($now) {
                $q->where(function ($query) use ($now) {
                    $query->where('class_start_datetime', '<=', $now)
                        ->where('class_end_datetime', '>=', $now);
                })
                    ->orWhere('class_start_datetime', '>', $now);
            })
            ->where('status', '<>', STATUS_OCCURRED)
            ->count();

        // Have booking BOOKING_TYPE_PRACTICE
        $bookingsCount = $this->bookings()
            ->where(function ($query) use ($now) {
                $query->where(function ($subQuery) use ($now) {
                    $subQuery->where('instrument_start_datetime', '<=', $now)
                        ->where('instrument_end_datetime', '>=', $now);
                })
                    ->orWhere('instrument_start_datetime', '>', $now);
            })
            ->where('status_booking', BOOKING_ORDER)
            ->count();


        $total = $classLessonsCount + $bookingsCount;

        return $total;
    }

    public function getBookingExitsAttribute()
    {
        $total = 0;
        $classesCount = $this->classes()->count();
        $classLessonsCount = $this->classLessons()->count();
        $bookingsCount = $this->bookings()->count();
        $total = $classesCount + $classLessonsCount + $bookingsCount;
        return  $total;
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->setFullAddressAttribute();
        });
    }
}
