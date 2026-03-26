@extends('layouts.admin')

@section('title','Skills')
@section('page-title','Skills')

@push('styles')
<style>
    .skill-card {
        transition: .25s;
    }

    .skill-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, .08) !important;
    }
</style>
@endpush

@section('content')

<div class="card shadow-sm rounded-4 border-0">
    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0">All Skills</h5>

            <a href="{{ route('skills.create') }}"
                class="btn btn-sm text-white rounded-pill px-4"
                style="background:linear-gradient(135deg,#667eea,#764ba2);">
                + Add Skill
            </a>
        </div>

        @forelse($skills as $skill)
        <div class="card border-0 shadow-sm rounded-4 mb-3 p-3 skill-card">

            <div class="d-flex justify-content-between align-items-center">

                {{-- LEFT --}}
                <div>
                    <h6 class="fw-bold mb-1">{{ $skill->skill_name }}</h6>
                    <small class="text-muted">{{ $skill->description }}</small>
                </div>

                {{-- RIGHT ACTIONS --}}
                <div class="d-flex align-items-center gap-2">

                    {{-- Roadmap Count --}}
                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2">
                        {{ $skill->roadmaps_count ?? 0 }} Roadmaps
                    </span>

                    {{-- Manage Roadmaps --}}
                    <a href="{{ route('skills.roadmaps.index',$skill->id) }}"
                        class="btn btn-sm btn-light border rounded-3">
                        Manage →
                    </a>

                    {{-- Edit Button --}}
                    <a href="{{ route('skills.edit',$skill->id) }}"
                        class="btn btn-sm btn-light border rounded-3 d-flex align-items-center justify-content-center"
                        style="width:34px;height:34px;">
                        <i class="bi bi-pencil-square text-primary"></i>
                    </a>

                    {{-- Delete Button --}}
                    <form method="POST"
                        action="{{ route('skills.destroy',$skill->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="btn btn-sm btn-light border rounded-3 d-flex align-items-center justify-content-center"
                            style="width:34px;height:34px;">
                            <i class="bi bi-trash text-danger"></i>
                        </button>
                    </form>

                </div>

            </div>

        </div>
        @empty
        <div class="text-center py-5">
            <h6 class="text-muted">No skills added yet</h6>
        </div>
        @endforelse

    </div>
</div>

@endsection