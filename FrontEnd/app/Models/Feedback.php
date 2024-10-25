<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AppointifyUser;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = ['feedback_message', 'star'];
    protected $table = 'feedbacks';

    
}
