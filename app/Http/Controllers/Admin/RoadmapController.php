<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Roadmap;
use App\Models\Skill;
use Illuminate\Http\Request;

class RoadmapController extends Controller
{
    public function index(Skill $skill)
    {
        $roadmaps = $skill->roadmaps()
        ->withCount('tasks') 
        ->latest()
        ->get();
        return view('admin.roadmaps.index', compact('skill', 'roadmaps'));
    }
    public function create(Skill $skill)
    {
        return view('admin.roadmaps.create', compact('skill'));
    }

    public function store(Request $request, Skill $skill)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $skill->roadmaps()->create([
            'title' => $request->title,
        ]);

        return redirect()
            ->route('skills.roadmaps.index', $skill->id)
            ->with('success', 'Roadmap created successfully.');
    }
    public function edit($skillId, $roadmapId)
    {
        $skill = Skill::findOrFail($skillId);
        $roadmap = Roadmap::findOrFail($roadmapId);

        return view('admin.roadmaps.edit', compact('skill', 'roadmap'));
    }

    public function update(Request $request, $skillId, $roadmapId)
    {
        $roadmap = Roadmap::findOrFail($roadmapId);

        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        $roadmap->update([
            'title' => $request->title,
        ]);

        return redirect()
            ->route('skills.roadmaps.index', $skillId)
            ->with('success', 'Roadmap updated successfully.');
    }
    public function destroy($skillId, $roadmapId)
    {
        $roadmap = \App\Models\Roadmap::where('skill_id', $skillId)
            ->where('id', $roadmapId)
            ->firstOrFail();

        $roadmap->delete();

        return redirect()
            ->route('skills.roadmaps.index', $skillId)
            ->with('success', 'Roadmap deleted successfully');
    }
}
