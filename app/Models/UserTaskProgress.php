<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTaskProgress extends Model
{
    protected $table = 'user_task_progress';

    protected $fillable = [
        'user_id',
        'task_id',
        'is_completed'
    ];

    // ✅ Relation: belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ✅ Relation: belongs to Task
    public function task()
    {
        return $this->belongsTo(RoadmapTask::class, 'task_id');
    }
}