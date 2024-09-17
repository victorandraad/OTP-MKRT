<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pokemon()
    {
        return $this->hasMany(Pokemon::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
