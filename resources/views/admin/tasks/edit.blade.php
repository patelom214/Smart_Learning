@extends('layouts.admin')

@section('title','Edit Task')
@section('page-title','Edit Task')

@push('styles')
<style>
:root {
    --gradient: linear-gradient(135deg,#667eea,#764ba2);
}

.btn-gradient {
    background: var(--gradient);
    color: #fff;
    border: none;
    border-radius: 10px;
    padding: .55rem 1.5rem;
    font-weight: 600;
}

.btn-gradient:hover {
    opacity: .9;
}
</style>
@endpush

@section('content')

<div class="card shadow-sm border-0 rounded-4 p-4">

    <div class="mb-4">
        <h5 class="fw-bold mb-1">Edit Task</h5>
        <small class="text-muted">
            Roadmap: {{ $roadmap->title }}
        </small>
    </div>

    <form method="POST"
          action="{{ route('roadmaps.tasks.update', [$roadmap->id, $task->id]) }}">
        @csrf
        @method('PUT')

        {{-- Task Name --}}
        <div class="mb-4">
            <label class="fw-semibold">Task Name</label>
            <input type="text"
                   name="task_name"
                   value="{{ old('task_name', $task->task_name) }}"
                   class="form-control rounded-3"
                   required>
        </div>


        {{-- Buttons --}}
        <div class="d-flex justify-content-between">

            <a href="{{ route('roadmaps.tasks.index',$roadmap->id) }}"
               class="btn btn-light border rounded-3 px-4">
                ← Cancel
            </a>

            <button type="submit" class="btn btn-gradient">
                Update Task
            </button>

        </div>

    </form>

</div>

@endsection