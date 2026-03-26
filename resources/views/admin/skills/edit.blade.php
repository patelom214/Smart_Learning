@extends('layouts.admin')

@section('title','Edit Skill')
@section('page-title','Edit Skill')

@push('styles')
<style>
:root {
    --gradient: linear-gradient(135deg,#667eea,#764ba2);
}

.edit-card {
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
</style>
@endpush

@section('content')

<div class="card edit-card shadow-sm border-0">
    <div class="card-body p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="fw-bold mb-0">Edit Skill</h5>
                <small class="text-muted">Update skill details</small>
            </div>

            <a href="{{ route('skills.index') }}"
               class="btn btn-sm btn-light border rounded-3">
                ← Back
            </a>
        </div>

        <form method="POST" action="{{ route('skills.update',$skill->id) }}">
            @csrf
            @method('PUT')

            {{-- Skill Name --}}
            <div class="mb-4">
                <label class="fw-semibold mb-2">Skill Name *</label>
                <input type="text"
                       name="skill_name"
                       value="{{ old('skill_name',$skill->skill_name) }}"
                       class="form-control rounded-3"
                       required>
            </div>

            {{-- Description --}}
            <div class="mb-4">
                <label class="fw-semibold mb-2">Description</label>
                <textarea name="description"
                          rows="4"
                          class="form-control rounded-3">{{ old('description',$skill->description) }}</textarea>
            </div>

            {{-- Buttons --}}
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('skills.index') }}"
                   class="btn btn-light border rounded-3 px-4">
                    Cancel
                </a>

                <button type="submit" class="btn btn-gradient">
                    Update Skill
                </button>
            </div>

        </form>

    </div>
</div>

@endsection