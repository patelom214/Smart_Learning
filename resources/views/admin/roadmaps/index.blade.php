@extends('layouts.admin')

@section('title','Roadmaps')
@section('page-title','Roadmaps')

@push('styles')
<style>
    :root {
        --gradient: linear-gradient(135deg, #667eea, #764ba2);
    }

    .roadmap-card {
        border-radius: 16px;
        transition: .25s;
    }

    .roadmap-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, .08) !important;
    }

    .roadmap-badge {
        background: rgba(102, 126, 234, .12);
        color: #667eea;
        font-size: .7rem;
        padding: .35rem .7rem;
        border-radius: 20px;
        font-weight: 600;
    }

    .btn-gradient {
        background: var(--gradient);
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: .5rem 1.4rem;
        font-weight: 600;
    }

    .btn-gradient:hover {
        opacity: .9;
    }
</style>
@endpush


@section('content')

<div class="card shadow-sm border-0 rounded-4">

    <div class="card-body p-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h5 class="fw-bold mb-1">{{ $skill->skill_name }} Roadmaps</h5>
                <small class="text-muted">Manage learning path structure</small>
            </div>
             <div class="d-flex gap-2">
            <a href="{{ route('skills.index') }}" class="btn btn-sm btn-outline-secondary border rounded-3 mr-2">
                   ← Back
                </a>
            <a href="{{ route('skills.roadmaps.create',$skill->id) }}"
                class="btn btn-gradient">
                + Add Roadmap
            </a>
             </div>
        </div>

        {{-- Roadmap List --}}
        @forelse($roadmaps as $roadmap)
        <div class="roadmap-card card border-0 shadow-sm mb-3">

            <div class="card-body d-flex justify-content-between align-items-center">

                <div>
                    <div class="fw-semibold mb-1">
                        {{ $roadmap->title }}
                    </div>

                    <span class="roadmap-badge">
                        {{ $roadmap->tasks_count ?? 0 }} Tasks
                    </span>
                </div>

                <div class="d-flex align-items-center gap-2">

                    {{-- Manage Tasks --}}
                    <a href="{{ route('roadmaps.tasks.index',$roadmap->id) }}"
                        class="btn btn-sm btn-light border rounded-3">
                        Manage Tasks →
                    </a>

                    {{-- Edit --}}
                    <a href="{{ route('skills.roadmaps.edit',[$skill->id,$roadmap->id]) }}"
                        class="btn btn-sm btn-light border rounded-3 d-flex align-items-center justify-content-center"
                        style="width:34px;height:34px;">
                        <i class="bi bi-pencil-square text-primary"></i>
                    </a>

                    {{-- Delete --}}
                    <form method="POST"
                        action="{{ route('skills.roadmaps.destroy',[$skill->id,$roadmap->id]) }}">
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
            <div style="font-size:2.5rem;">📂</div>
            <p class="text-muted mt-2 mb-0">
                No roadmaps created for this skill yet.
            </p>
        </div>
        @endforelse

    </div>

</div>

@endsection