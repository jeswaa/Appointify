<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    use HasFactory;

    protected $table = 'admintbl';

    protected $fillable = [
        'fullname',
        'address',
        'phonenumber',
        'uploadimage',
        'username',
        'password',
    ];
}
