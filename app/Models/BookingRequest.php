<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vehicle_id',
        'booking_date',
        'status',
        // tambahkan atribut lain yang diperlukan
    ];

    /**
     * Get the vehicle that owns the booking request.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
