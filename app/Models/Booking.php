<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // The $fillable array tells Laravel which columns are safe to save data into.
    // Notice 'notes' is added here so your problem descriptions save perfectly!
    protected $fillable = [
        'user_id',
        'vehicle_id',
        'service_id',
        'booking_date',
        'status',
        'total_price',
        'notes', 
    ];

    /**
     * 1. This fixes your Admin error! 
     * It tells Laravel how to find the User (Customer) for this booking.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 2. This links the booking to the specific vehicle.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * 3. This links the booking to the service package chosen.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}