<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use Illuminate\Support\Facades\Auth;
use App\Models\Roadmap;
use App\Models\UserSkill;
use App\Models\RoadmapTask;
use App\Models\User;
use App\Models\UserTaskProgress;

class SkillController extends Controller
{
     public function index()
    {
        $skills = Skill::all();
        $userSkills = Auth::user()->skills->pluck('id')->toArray();

        return view('skills.skill', compact('skills', 'userSkills'));
    }



public function toggle($id)
{
    $user = Auth::user();

    $exists = UserSkill::where('user_id', $user->id)
        ->where('skill_id', $id)
        ->exists();

    if ($exists) {

        // ✅ STEP 1: get roadmap IDs
        $roadmapIds = Roadmap::where('skill_id', $id)->pluck('id');

        // ✅ STEP 2: get task IDs
        $taskIds = RoadmapTask::whereIn('roadmap_id', $roadmapIds)->pluck('id');

        // ✅ STEP 3: delete ONLY this user's progress
        UserTaskProgress::where('user_id', $user->id)
            ->whereIn('task_id', $taskIds)
            ->delete();

        // ✅ STEP 4: delete user skill
        UserSkill::where('user_id', $user->id)
            ->where('skill_id', $id)
            ->delete();

        return back()->with('success', 'Skill removed and progress reset');
    } 
    else {

        // ✅ add skill fresh
        $roadmaps = Roadmap::where('skill_id', $id)->get();

        foreach ($roadmaps as $roadmap) {

            UserSkill::firstOrCreate(
                [
                    'user_id' => $user->id,
                    'skill_id' => $id,
                    'roadmap_id' => $roadmap->id
                ],
                [
                    'progress_percentage' => 0,
                    'completed_tasks' => 0,
                    'level' => 'Beginner'
                ]
            );
        }

        return back()->with('success', 'Skill added');
    }
}
}
