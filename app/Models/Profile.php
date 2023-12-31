<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'profile_image',
        'skills',
        'about',
        'linkedin',
        'github',
        'phone',
        'views',
        'user_id',
        'location_id',
        'category_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
