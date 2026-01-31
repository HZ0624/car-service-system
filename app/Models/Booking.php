<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id', 'vehicle_id', 'service_id', 'booking_date', 
        'status', 'total_price', 'notes'
    ];

    // Connects to User table but we call it 'customer' for clarity
    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}