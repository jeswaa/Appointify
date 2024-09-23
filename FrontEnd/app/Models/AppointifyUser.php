<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointifyUser extends Model
{
    use HasFactory;

    protected $table = "tblsignup";

    protected $fillable = [
        'fullname',
        'address',
        'phonenumber',
        'gender',
        'uploadimage',
        'username',
        'password',
    ];
}
