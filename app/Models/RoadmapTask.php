<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoadmapTask extends Model
{
    use HasFactory;

    protected $fillable = ['roadmap_id', 'task_name', 'description', 'tags', 'order', 'is_completed'];
    protected $casts = ['is_completed' => 'boolean'];

    // A task belongs to a roadmap
    public function roadmap()
    {
        return $this->belongsTo(Roadmap::class);
    }
    
}
