@extends('layouts.app')
@section('title', 'All Roadmaps')

@push('styles')
<style>
    /* ── Wrap — matches Skills page bg ── */
    .all-wrap {
        background: #f0f0ec;
        min-height: 100vh;
        padding-bottom: 60px;
    }

    /* ── Hero ── */
    .all-hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 52px 0 76px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .all-hero::before {
        content: '';
        position: absolute; inset: 0;
        background-image: radial-gradient(rgba(255,255,255,.1) 1px, transparent 1px);
        background-size: 22px 22px;
        pointer-events: none;
    }
    .all-hero::after {
        content: '';
        position: absolute; bottom: -2px; left: 0; right: 0;
        height: 52px;
        background: #f0f0ec;
        clip-path: ellipse(55% 100% at 50% 100%);
    }
    .all-hero h1 {
        position: relative; z-index: 1;
        font-size: clamp(26px, 4vw, 42px);
        font-weight: 800; color: #fff !important; margin-bottom: 8px;
    }
    .all-hero p {
        position: relative; z-index: 1;
        color: rgba(255,255,255,.75) !important; font-size: 15px;
    }

    /* ── Skill group label ── */
    .skill-group { margin: 36px 0 14px; }
    .skill-group-label {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: 17px; font-weight: 700; color: #1a1a2e;
    }
    .skill-group-label span {
        font-size: 12px; font-weight: 600; color: #667eea;
        background: rgba(102,126,234,.1);
        border: 1px solid rgba(102,126,234,.2);
        padding: 3px 10px; border-radius: 20px;
    }

    /* ── Grid ── */
    .rm-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(295px, 1fr));
        gap: 20px; padding-bottom: 20px;
    }

    /* ── Card ── */
    .rm-card {
        background: #fff;
        border-radius: 18px;
        border: 1.5px solid #e4e6f0;
        overflow: hidden; display: flex; flex-direction: column;
        transition: transform .3s, box-shadow .3s, border-color .3s;
        animation: fadeUp .4s ease both;
        box-shadow: 0 2px 8px rgba(0,0,0,.04);
    }
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(14px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .rm-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 40px rgba(102,126,234,.13);
        border-color: rgba(102,126,234,.28);
    }

    /* Band — cycles per card position */
    .rm-band { height: 4px; flex-shrink: 0; }
    .rm-card:nth-child(4n+1) .rm-band { background: linear-gradient(90deg, #667eea, #764ba2); }
    .rm-card:nth-child(4n+2) .rm-band { background: linear-gradient(90deg, #ff5fa0, #ff8ecb); }
    .rm-card:nth-child(4n+3) .rm-band { background: linear-gradient(90deg, #00c48c, #00e5a8); }
    .rm-card:nth-child(4n+0) .rm-band { background: linear-gradient(90deg, #ff9f43, #ffbe76); }

    .rm-body { padding: 20px 20px 14px; flex: 1; }

    .rm-level {
        display: inline-flex; font-size: 11px; font-weight: 700;
        letter-spacing: .05em; text-transform: uppercase;
        padding: 3px 10px; border-radius: 20px; margin-bottom: 10px;
    }
    .level-beginner     { background: rgba(0,196,140,.1);   color: #00a376; }
    .level-intermediate { background: rgba(255,159,67,.1);  color: #e07b00; }
    .level-advanced     { background: rgba(102,126,234,.1); color: #667eea; }

    .rm-title { font-size: 16px; font-weight: 700; color: #1a1a2e; margin-bottom: 6px; }
    .rm-desc  { font-size: 13px; color: #8a8fad; line-height: 1.5; margin-bottom: 12px; }
    .rm-stats { display: flex; gap: 14px; flex-wrap: wrap; }
    .rm-stat  { font-size: 12px; color: #8a8fad; }

    /* Footer */
    .rm-footer {
        padding: 12px 20px; border-top: 1px solid #e4e6f0;
        background: #fafbff;
        display: flex; align-items: center; justify-content: space-between; gap: 12px;
    }
    .rm-pw { flex: 1; }
    .rm-pw-label { display: flex; justify-content: space-between; font-size: 11px; color: #8a8fad; margin-bottom: 4px; }
    .rm-pw-track { height: 4px; background: #e4e6f0; border-radius: 99px; overflow: hidden; }
    .rm-pw-fill  { height: 100%; background: linear-gradient(90deg, #667eea, #764ba2); border-radius: 99px; }
    .rm-pw-fill.full { background: linear-gradient(90deg, #00c48c, #00e5a8); }

    /* Start button — matches "+ Add Skill" */
    .rm-go {
        display: inline-flex; align-items: center; gap: 5px;
        background: linear-gradient(135deg, #667eea, #764ba2) !important;
        color: #fff !important; font-size: 13px; font-weight: 700;
        padding: 8px 18px; border-radius: 30px;
        text-decoration: none !important; white-space: nowrap;
        transition: all .2s; font-family: inherit;
        box-shadow: 0 4px 12px rgba(102,126,234,.3);
    }
    .rm-go:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(102,126,234,.45);
        color: #fff !important;
    }

    /* Empty state */
    .all-empty {
        text-align: center; padding: 80px 20px; color: #8a8fad;
    }
    .all-empty .all-empty-icon { font-size: 48px; margin-bottom: 12px; }
    .all-empty h5 { font-size: 18px; color: #1a1a2e; margin-top: 10px; font-weight: 700; }
</style>
@endpush

@section('content')

<div class="all-wrap">

    {{-- Hero --}}
    <div class="all-hero">
        <div class="container">
            <h1>🗺 All Roadmaps</h1>
            <p>Browse all learning paths across every skill.</p>
        </div>
    </div>

    <div class="container">
        @forelse($roadmaps as $skillId => $group)
        @php $skill = $skills[$skillId] ?? null; @endphp

        <div class="skill-group">
            <div class="skill-group-label">
                🎯 {{ $skill->skill_name ?? 'Unknown Skill' }}
                <span>{{ $group->count() }} {{ Str::plural('roadmap', $group->count()) }}</span>
            </div>
        </div>

        <div class="rm-grid">
            @foreach($group as $roadmap)
            @php
                $total   = $roadmap->tasks->count();
                $taskIds = $roadmap->tasks->pluck('id');
                $done    = \App\Models\UserTaskProgress::where('user_id', auth()->id())
                               ->whereIn('task_id', $taskIds)
                               ->where('is_completed', 1)
                               ->count();
                $pct     = $total > 0 ? round(($done / $total) * 100) : 0;
                $lc      = match(strtolower($roadmap->level ?? 'beginner')) {
                    'intermediate' => 'level-intermediate',
                    'advanced'     => 'level-advanced',
                    default        => 'level-beginner',
                };
            @endphp

            <div class="rm-card">
                <div class="rm-band"></div>
                <div class="rm-body">
                    <span class="rm-level {{ $lc }}">{{ ucfirst($roadmap->level ?? 'Beginner') }}</span>
                    <div class="rm-title">{{ $roadmap->title }}</div>
                    <div class="rm-desc">{{ Str::limit($roadmap->description, 90) }}</div>
                    <div class="rm-stats">
                        <span class="rm-stat">📋 {{ $total }} tasks</span>
                        @if($roadmap->duration)
                            <span class="rm-stat">⏱ {{ $roadmap->duration }}</span>
                        @endif
                        @if($done > 0)
                            <span class="rm-stat" style="color:#00c48c">✔ {{ $done }} done</span>
                        @endif
                    </div>
                </div>
                <div class="rm-footer">
                    <div class="rm-pw">
                        <div class="rm-pw-label">
                            <span>Progress</span><span>{{ $pct }}%</span>
                        </div>
                        <div class="rm-pw-track">
                            <div class="rm-pw-fill {{ $pct >= 100 ? 'full' : '' }}" style="width: {{ $pct }}%"></div>
                        </div>
                    </div>
                    <a href="{{ route('roadmap.tasks', $roadmap->id) }}" class="rm-go">
                        {{ $pct > 0 ? 'Continue' : 'Start' }} →
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        @empty
        <div class="all-empty">
            <div class="all-empty-icon">🗺</div>
            <h5>No roadmaps available yet</h5>
            <p>Check back later for new learning paths.</p>
        </div>
        @endforelse
    </div>

</div>

@endsection