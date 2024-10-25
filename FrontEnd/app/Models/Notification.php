<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications'; // Specify the table if not following naming convention
    protected $fillable = ['user_id', 'message', 'date', 'session_time', 'created_at', 'updated_at']; // Add user_id if needed
}
