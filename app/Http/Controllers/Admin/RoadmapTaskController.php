<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Roadmap;
use App\Models\RoadmapTask;
use Illuminate\Http\Request;

class RoadmapTaskController extends Controller
{
    public function index(Roadmap $roadmap)
    {
        $tasks = $roadmap->tasks()->latest()->get();
        return view('admin.tasks.index', compact('roadmap', 'tasks'));
    }
   public function create($roadmapId)
{
    $roadmap = Roadmap::findOrFail($roadmapId);

    return view('admin.tasks.create', compact('roadmap'));
}

    public function store(Request $request, $roadmapId)
{
    RoadmapTask::create([
        'roadmap_id' => $roadmapId,
        'task_name' => $request->task_name,
        'is_completed' => 0
    ]);

    return redirect()->route('roadmaps.tasks.index', $roadmapId);
}

public function edit(Roadmap $roadmap, RoadmapTask $task)
{
    return view('admin.tasks.edit', compact('roadmap', 'task'));
}

public function update(Request $request, Roadmap $roadmap, RoadmapTask $task)
{
    $request->validate([
        'task_name' => 'required|string|max:255',
        'is_completed' => 'nullable|boolean'
    ]);

    $task->update([
        'task_name'   => $request->task_name,
        'is_completed'=> $request->has('is_completed') ? 1 : 0,
    ]);

    return redirect()
        ->route('roadmaps.tasks.index', $roadmap->id)
        ->with('success', 'Task updated successfully');
}

    public function destroy($roadmapId, $taskId)
    {
        $task = \App\Models\RoadmapTask::findOrFail($taskId);
        $task->delete();

        return redirect()->route('roadmaps.tasks.index', $roadmapId);
    }
}
