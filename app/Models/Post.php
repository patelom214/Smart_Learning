<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'media',
        'type',
        'tags',
    ];

    // Post belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Post can have many likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Post can have many comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function shares()
    {
        return $this->hasMany(Share::class);
    }
}
