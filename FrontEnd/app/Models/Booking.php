<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Define the table associated with the Booking model
    protected $table = 'bookings';

    // Specify the fillable properties to allow mass assignment
    protected $fillable = [
        'user_id',
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
        return $this->belongsTo(AppontifyUser::class, 'id');
    }
}
