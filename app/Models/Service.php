<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'duration_minutes',
        'category',
        'is_active',
    ];

    /**
     * Get the appointments for the service.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
