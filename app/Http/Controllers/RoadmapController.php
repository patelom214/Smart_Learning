<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\Roadmap;
use App\Models\RoadmapTask;
use App\Models\UserSkill;
use Illuminate\Support\Facades\Auth;
use App\Models\UserTaskProgress;

class RoadmapController extends Controller
{
    public function index()
    {
        $roadmaps = Roadmap::with(['skill', 'tasks'])
            ->withCount('tasks')
            ->get()
            ->groupBy('skill_id'); // group by skill

        $skills = Skill::whereIn('id', $roadmaps->keys())->get()->keyBy('id');

        return view('skills.all_roadmaps', compact('skills', 'roadmaps'));
    }
    // public function show($skill_id)
    // {
    //     $skill = Skill::findOrFail($skill_id);
    //     $roadmap = $skill->roadmaps()->with('tasks')->first();

    //     return view('skills.roadmap_list', compact('skill', 'roadmap'));
    // }

    public function show(Skill $skill)
    {
        $roadmaps = Roadmap::where('skill_id', $skill->id)
            ->withCount('tasks')
            ->with('tasks')
            ->get();

        // Only 1 roadmap? Skip the list, go straight to tasks
        if ($roadmaps->count() === 1) {
            return redirect()->route('roadmap.tasks', $roadmaps->first()->id);
        }

        return view('skills.roadmap_list', compact('skill', 'roadmaps'));
    }
    public function tasks(Roadmap $roadmap)
    {
        $tasks = RoadmapTask::where('roadmap_id', $roadmap->id)
            ->orderBy('id')  // id column keeps tasks sorted
            ->get();

        return view('skills.roadmap_tasks', compact('roadmap', 'tasks'));
    }

   public function toggleTask(RoadmapTask $task)
{
    $userId = Auth::id();
    $skillId = $task->roadmap->skill_id;
    $roadmapId = $task->roadmap_id;

    // Find or create progress for THIS USER + THIS TASK
    $progress = UserTaskProgress::firstOrCreate(
        [
            'user_id' => $userId,
            'task_id' => $task->id
        ],
        [
            'is_completed' => 0
        ]
    );

    // Toggle
    $wasCompleted = $progress->is_completed;
    $progress->is_completed = !$progress->is_completed;
    $progress->save();

    // Update user_skill counts
    $userSkill = UserSkill::where('user_id', $userId)
        ->where('skill_id', $skillId)
        ->where('roadmap_id', $roadmapId)
        ->firstOrFail();

    if ($wasCompleted) {
        // was completed → now uncomplete
        if ($userSkill->completed_tasks > 0) {
            $userSkill->decrement('completed_tasks');
        }
    } else {
        // was not completed → now completed
        $userSkill->increment('completed_tasks');
    }

    $this->updateProgress($userId, $skillId, $roadmapId);

    return back();
}
   public function updateProgress($userId, $skillId, $roadmapId)
{
    $totalTasks = RoadmapTask::where('roadmap_id', $roadmapId)->count();

    $userSkill = UserSkill::where('user_id', $userId)
        ->where('skill_id', $skillId)
        ->where('roadmap_id', $roadmapId) // ✅ MUST
        ->firstOrFail();

    $completedTasks = $userSkill->completed_tasks ?? 0;

    $progress = ($totalTasks > 0)
        ? round(($completedTasks / $totalTasks) * 100)
        : 0;

    $userSkill->update([
        'progress_percentage' => $progress
    ]);
}
}
