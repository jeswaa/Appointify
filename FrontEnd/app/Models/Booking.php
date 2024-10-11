<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AppointifyUser; // Corrected class name

class Booking extends Model
{
    use HasFactory;

    // Define the table associated with the Booking model
    protected $table = 'bookings';

    // Specify the fillable properties to allow mass assignment
    protected $fillable = [
        'id',
        'fullname',
        'address',
        'phonenumber',
        'email',
        'session_time',
        'payment_method',
    ];

    // Define the relationship with the User model (assuming you have a User model for tblsignup)
    public function user()
    {
        return $this->belongsTo(AppointifyUser::class, 'user_id'); // Ensure 'user_id' matches the column in bookings table
    }
    
}
