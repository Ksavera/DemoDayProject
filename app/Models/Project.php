<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'photo',
        'description',
        'github',
        'likes',
        'category_id',
        'profile_id'
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function likes()
    {
        return $this->hasmany(Like::class);
    }
    public function isLikedByUser($userId)
    {
        return optional($this->likes)->contains('user_id', $userId);
    }
}
