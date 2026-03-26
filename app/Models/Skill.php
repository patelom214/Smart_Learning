<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['skill_name', 'description'];

    // A skill has many roadmaps
    public function roadmaps()
    {
        return $this->hasMany(Roadmap::class);
    }

    // A skill belongs to many users
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_skills')
                    ->withPivot('level', 'progress_percentage')
                    ->withTimestamps();
    }
}
