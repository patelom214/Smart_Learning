@extends('layouts.admin')

@section('title','Roadmap Tasks')
@section('page-title','Roadmap Tasks')

@section('content')

<style>
.btn-gradient {
    background: linear-gradient(135deg,#667eea,#764ba2);
    color: #fff;
    border: none;
}
.btn-gradient:hover { opacity: .9; }

.action-btn {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #e9ecef;
    background: #fff;
    transition: 0.2s;
}

.action-btn:hover {
    background: #f8f9fa;
}

.edit-btn i { color: #667eea; }
.delete-btn i { color: #dc3545; }

.status-badge {
    font-size: .7rem;
    padding: .35rem .7rem;
    border-radius: 20px;
    font-weight: 600;
}
.status-complete {
    background: rgba(40,167,69,.1);
    color: #28a745;
}
.status-pending {
    background: rgba(255,193,7,.15);
    color: #ffc107;
}
.task-card {
    transition: 0.2s;
}
.task-card:hover {
    box-shadow: 0 8px 20px rgba(0,0,0,.05);
    transform: translateY(-2px);
}
</style>

<div class="card shadow-sm rounded-4 border-0">
    <div class="card-body">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h5 class="fw-bold mb-1">{{ $roadmap->title }}</h5>
                <small class="text-muted">
                    {{ $tasks->count() }} Tasks
                </small>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('skills.roadmaps.index',$roadmap->skill_id) }}"
                   class="btn btn-sm btn-light border rounded-3">
                   ← Back
                </a>

                <a href="{{ route('roadmaps.tasks.create',$roadmap->id) }}"
                   class="btn btn-gradient rounded-3 px-4">
                    + Add Task
                </a>
            </div>

        </div>

        {{-- Tasks List --}}
        @forelse($tasks as $task)

        <div class="task-card d-flex align-items-center justify-content-between p-3 border rounded-4 mb-3">

            <div>
                <div class="fw-semibold mb-1">
                    {{ $task->task_name }}
                </div>

                <span class="status-badge 
                    {{ $task->is_completed ? 'status-complete' : 'status-pending' }}">
                    {{ $task->is_completed ? 'Completed' : 'Pending' }}
                </span>
            </div>

            <div class="d-flex gap-2">

                {{-- Edit --}}
                <a href="{{ route('roadmaps.tasks.edit',[$roadmap->id,$task->id]) }}"
                   class="action-btn edit-btn">
                    <i class="bi bi-pencil-square"></i>
                </a>

                {{-- Delete --}}
                <form method="POST"
                      action="{{ route('roadmaps.tasks.destroy',[$roadmap->id,$task->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button class="action-btn delete-btn">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>

            </div>

        </div>

        @empty
        <div class="text-center py-5">
            <h6 class="text-muted">No tasks added yet</h6>
        </div>
        @endforelse

    </div>
</div>

@endsection