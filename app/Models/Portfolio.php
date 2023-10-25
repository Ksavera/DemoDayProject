<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'photo',
        'description',
        'github',
        'likes',
        'category_id',
        'account_id'
    ];

    public function accounts()
    {
        return $this->belongsTo(Account::class);
    }
}
