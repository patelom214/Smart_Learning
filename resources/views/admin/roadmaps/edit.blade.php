@extends('layouts.admin')

@section('title','Edit Roadmap')
@section('page-title','Edit Roadmap')

@push('styles')
<style>
:root {
    --gradient: linear-gradient(135deg,#667eea,#764ba2);
}

/* Card */
.roadmap-edit-card {
    border-radius: 20px;
    overflow: hidden;
}

/* Gradient header */
.edit-header {
    background: var(--gradient);
    padding: 18px 24px;
    color: #fff;
}

/* Input styling */
.form-control {
    border-radius: 12px;
    padding: .7rem 1rem;
    font-size: .9rem;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 .2rem rgba(102,126,234,.2);
}

/* Buttons */
.btn-gradient {
    background: var(--gradient);
    color: #fff;
    border: none;
    border-radius: 12px;
    padding: .6rem 1.8rem;
    font-weight: 600;
}

.btn-gradient:hover {
    opacity: .9;
}

.btn-cancel {
    border-radius: 12px;
    padding: .6rem 1.8rem;
}

/* Label */
.form-label {
    font-weight: 600;
    font-size: .9rem;
}
</style>
@endpush

@section('content')

<div class="card roadmap-edit-card shadow-sm border-0">

    {{-- Header --}}
    <div class="edit-header d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold mb-0">Edit Roadmap</h5>
            <small class="opacity-75">
                Skill: {{ $skill->skill_name }}
            </small>
        </div>

        <a href="{{ route('skills.roadmaps.index',$skill->id) }}"
           class="btn btn-light btn-sm rounded-3">
            ← Back
        </a>
    </div>

    {{-- Body --}}
    <div class="card-body p-4">

        <form method="POST"
              action="{{ route('skills.roadmaps.update',[$skill->id,$roadmap->id]) }}">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div class="mb-4">
                <label class="form-label">Roadmap Title *</label>
                <input type="text"
                       name="title"
                       value="{{ old('title',$roadmap->title) }}"
                       class="form-control @error('title') is-invalid @enderror"
                       placeholder="Enter roadmap title"
                       required>

                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Buttons --}}
            <div class="d-flex justify-content-between">

                <a href="{{ route('skills.roadmaps.index',$skill->id) }}"
                   class="btn btn-light border btn-cancel">
                    Cancel
                </a>

                <button type="submit" class="btn btn-gradient">
                    Update Roadmap
                </button>

            </div>

        </form>

    </div>
</div>

@endsection