<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id', 'name', 'level', 'nature', 'pokeball', 'addon', 'boost', 'price'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
