<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'user_id',
        'barber_id',
        'service_id',
        'appointment_date',
        'start_time',
        'end_time',
        'status',
        'total_price',
        'notes',
    ];

    /**
     * Get the user that made the appointment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the barber assigned to the appointment.
     */
    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }

    /**
     * Get the service for the appointment.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
