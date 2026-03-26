<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::withCount('roadmaps')->get();
        return view('admin.skills.index', compact('skills'));
    }

    public function create()
    {
        return view('admin.skills.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'skill_name' => 'required',
            'description' => 'required'
        ]);

        Skill::create($request->all());

        return redirect()->route('skills.index')
            ->with('success', 'Skill created successfully');
    }
    public function edit($id)
    {
        $skill = Skill::findOrFail($id);
        return view('admin.skills.edit', compact('skill'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'skill_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $skill = Skill::findOrFail($id);

        $skill->update([
            'skill_name' => $request->skill_name,
            'description' => $request->description,
        ]);

        return redirect()->route('skills.index')
            ->with('success', 'Skill updated successfully!');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return back()->with('success', 'Skill deleted');
    }
}
