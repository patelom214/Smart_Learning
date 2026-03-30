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

    /* Card body: stack vertically — name top, buttons bottom */
    .skill-row {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    /* Line 1: name + description */
    .skill-info h6 {
        font-weight: 600;
        margin-bottom: 2px;
        word-break: break-word;
    }

    .skill-info small {
        color: #6c757d;
        word-break: break-word;
    }

    /* Line 2: actions — always one row, never wrap */
    .skill-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: nowrap;
    }

    .btn-manage {
        white-space: nowrap;
    }

    /* Fixed square icon buttons */
    .btn-icon {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        padding: 0;
    }

    /* Push edit+delete to the far right */
    .ms-auto-group {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-left: auto;
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
            <div class="skill-row">

                {{-- LINE 1: Skill name + description --}}
                <div class="skill-info">
                    <h6 class="mb-1">{{ $skill->skill_name }}</h6>
                    <small>{{ $skill->description }}</small>
                </div>

                {{-- LINE 2: Badge | Manage | Edit | Delete --}}
                <div class="skill-actions">

                    {{-- Roadmap Count --}}
                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2"
                          style="white-space:nowrap;">
                        {{ $skill->roadmaps_count ?? 0 }} Roadmaps
                    </span>

                    {{-- Manage Roadmaps --}}
                    <a href="{{ route('skills.roadmaps.index', $skill->id) }}"
                       class="btn btn-sm btn-light btn-manage border rounded-3">
                        Manage →
                    </a>

                    {{-- Edit + Delete pushed to right --}}
                    <div class="ms-auto-group">

                        <a href="{{ route('skills.edit', $skill->id) }}"
                           class="btn btn-sm btn-light btn-icon border rounded-3"
                           title="Edit">
                            <i class="bi bi-pencil-square text-primary"></i>
                        </a>

                        <form method="POST"
                              action="{{ route('skills.destroy', $skill->id) }}"
                              style="margin:0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="btn btn-sm btn-light btn-icon border rounded-3"
                                    title="Delete">
                                <i class="bi bi-trash text-danger"></i>
                            </button>
                        </form>

                    </div>

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