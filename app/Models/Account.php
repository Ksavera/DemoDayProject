<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'profile_image',
        'skills',
        'about',
        'location',
        'views',
        'user_id'
    ];
}
