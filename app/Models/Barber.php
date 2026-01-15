<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'bio',
        'image_url',
        'is_active',
    ];

    /**
     * Get the appointments for the barber.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
