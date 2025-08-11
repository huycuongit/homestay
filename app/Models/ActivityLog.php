<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'customer_name',
        'action',
        'description',
        'file_name',
        'file_path',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
