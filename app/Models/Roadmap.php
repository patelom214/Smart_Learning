<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roadmap extends Model
{
    use HasFactory;

    protected $fillable = ['skill_id', 'title'];

    // A roadmap belongs to a skill
    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }

    // A roadmap has many tasks
     public function tasks()
    {
        return $this->hasMany(RoadmapTask::class)->orderBy('id');
    }
}
