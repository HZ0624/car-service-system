<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    // Allow these fields to be filled by forms
    protected $fillable = ['user_id', 'license_plate', 'make', 'model', 'year'];

    // Relationship: A vehicle belongs to a User (Customer)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: A vehicle has many Bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
