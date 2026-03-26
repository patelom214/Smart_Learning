@extends('layouts.admin')

@section('title','Create Skill')
@section('page-title','Create Skill')

@push('styles')
<style>
:root {
    --gradient: linear-gradient(135deg,#667eea,#764ba2);
}

.skill-card {
    border-radius: 20px;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 .2rem rgba(102,126,234,.2);
}

.btn-gradient {
    background: var(--gradient);
    color: #fff;
    border: none;
    border-radius: 10px;
    padding: .6rem 1.8rem;
    font-weight: 600;
}

.btn-gradient:hover {
    opacity: .9;
}

.btn-cancel {
    border-radius: 10px;
    padding: .6rem 1.8rem;
}
</style>
@endpush

@section('content')

<div class="card shadow-sm border-0 skill-card">
    <div class="card-body p-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="fw-bold mb-0">Add New Skill</h5>
                <small class="text-muted">Create a new learning skill for roadmap</small>
            </div>

            <a href="{{ route('skills.index') }}"
               class="btn btn-light border btn-cancel">
                ← Back
            </a>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('skills.store') }}">
            @csrf

            {{-- Skill Name --}}
            <div class="mb-4">
                <label class="fw-semibold mb-2">Skill Name *</label>
                <input type="text"
                       name="skill_name"
                       class="form-control rounded-3"
                       placeholder="e.g. Laravel"
                       required>
            </div>

            {{-- Description --}}
            <div class="mb-4">
                <label class="fw-semibold mb-2">Description *</label>
                <textarea name="description"
                          class="form-control rounded-3"
                          rows="4"
                          placeholder="Brief description about this skill..."
                          required></textarea>
            </div>

            {{-- Buttons --}}
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('skills.index') }}"
                   class="btn btn-light border btn-cancel">
                    Cancel
                </a>

                <button type="submit" class="btn btn-gradient">
                    Save Skill
                </button>
            </div>

        </form>

    </div>
</div>

@endsection