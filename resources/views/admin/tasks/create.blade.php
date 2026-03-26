@extends('layouts.admin')

@section('title','Add Roadmap Task')
@section('page-title','Add Roadmap Task')

@push('styles')
<style>
:root {
    --gradient: linear-gradient(135deg,#667eea,#764ba2);
}

/* Card */
.task-card {
    border-radius: 18px;
}

/* Gradient Button */
.btn-gradient {
    background: var(--gradient);
    color: #fff;
    border: none;
    border-radius: 10px;
    padding: .6rem 1.6rem;
    font-weight: 600;
}

.btn-gradient:hover {
    opacity: .9;
}

/* Input Focus */
.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 .2rem rgba(102,126,234,.2);
}
</style>
@endpush

@section('content')

<div class="card task-card shadow-sm border-0">

    <div class="card-body p-4">

        {{-- Header --}}
        <div class="mb-4">
            <h5 class="fw-bold mb-1">Add Task</h5>
            <small class="text-muted">
                Roadmap: <strong>{{ $roadmap->title }}</strong>
            </small>
        </div>

        <form method="POST"
              action="{{ route('roadmaps.tasks.store', $roadmap->id) }}">
            @csrf

            {{-- Task Name --}}
            <div class="mb-4">
                <label class="fw-semibold mb-2">Task Name</label>
                <input type="text"
                       name="task_name"
                       class="form-control rounded-3"
                       placeholder="e.g. Learn Routing in Laravel"
                       required>
            </div>

            {{-- Buttons --}}
            <div class="d-flex justify-content-between align-items-center">

                <a href="{{ route('roadmaps.tasks.index', $roadmap->id) }}"
                   class="btn btn-light border rounded-3 px-4">
                    ← Cancel
                </a>

                <button type="submit" class="btn btn-gradient">
                    + Add Task
                </button>

            </div>

        </form>

    </div>
</div>

@endsection