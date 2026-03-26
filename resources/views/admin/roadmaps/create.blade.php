@extends('layouts.admin')

@section('title','Create Roadmap')
@section('page-title','Create Roadmap')

@push('styles')
<style>
:root{
    --gradient: linear-gradient(135deg,#667eea,#764ba2);
}

/* Card */
.roadmap-card{
    border-radius:18px;
    overflow:hidden;
}

/* Gradient header */
.roadmap-header{
    
    color:#000;
    padding:18px 24px;
}

/* Input focus */
.form-control:focus{
    border-color:#667eea;
    box-shadow:0 0 0 .2rem rgba(102,126,234,.2);
}

/* Gradient button */
.btn-gradient{
    background:var(--gradient);
    color:#fff;
    border:none;
    border-radius:10px;
    padding:.6rem 1.6rem;
    font-weight:600;
}
.btn-gradient:hover{
    opacity:.9;
    color:#fff;
}
</style>
@endpush

@section('content')

<div class="card roadmap-card shadow-sm border-0">

    {{-- Header --}}
    <div class="roadmap-header d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold mb-0">Create Roadmap</h5>
            <small class="opacity-75">Add a new learning path for this skill</small>
        </div>
        <a href="{{ route('skills.roadmaps.index',$skill->id) }}"
           class="btn btn-outline-secondary btn-sm rounded-3">
            ← Back
        </a>
    </div>

    {{-- Body --}}
    <div class="card-body p-4">

        <form method="POST" action="{{ route('skills.roadmaps.store', $skill->id) }}">
            @csrf

            {{-- Skill Display --}}
            <div class="mb-4">
                <label class="fw-semibold mb-2">Skill</label>

                <div class="d-flex align-items-center gap-2 p-3 rounded-3"
                     style="background:#f8f9fc; border:1px solid #eef0f4;">

                    <i class="bi bi-book text-primary"></i>
                    <span class="fw-semibold">{{ $skill->skill_name }}</span>
                </div>

                <input type="hidden" name="skill_id" value="{{ $skill->id }}">
            </div>

            {{-- Roadmap Title --}}
            <div class="mb-4">
                <label class="fw-semibold mb-2">Roadmap Title</label>
                <input type="text"
                       name="title"
                       class="form-control rounded-3"
                       placeholder="e.g. Laravel Beginner to Advanced"
                       required>
            </div>

            {{-- Buttons --}}
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('skills.roadmaps.index',$skill->id) }}"
                   class="btn btn-light border rounded-3 px-4">
                    Cancel
                </a>

                <button type="submit" class="btn btn-gradient">
                    <i class="bi bi-check2-circle me-1"></i>
                    Save Roadmap
                </button>
            </div>

        </form>

    </div>
</div>

@endsection