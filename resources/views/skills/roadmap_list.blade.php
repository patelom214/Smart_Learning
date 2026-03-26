@extends('layouts.app')
@section('title', 'Roadmaps — ' . $skill->skill_name)

@push('styles')
<style>
.rm-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 40px 0 52px;
    position: relative;
    overflow: hidden;
    width: 100%;
}
body {
    overflow-x: hidden;
}
.rm-hero::before {
    content: '';
    position: absolute; inset: 0;
    background-image: radial-gradient(rgba(255,255,255,.1) 1px, transparent 1px);
    background-size: 22px 22px;
    pointer-events: none;
}
.rm-hero::after {
    content: '';
    position: absolute;
    bottom: -2px; left: 0; right: 0;
    height: 50px;
    background: #f0f2fb;
    clip-path: ellipse(55% 100% at 50% 100%);
}

/* ✅ Match Bootstrap's navbar container padding exactly */
.rm-hero-inner {
    position: relative; z-index: 1;
    padding-left: max(24px, calc((100vw - 1320px) / 2 + 12px));
    padding-right: max(24px, calc((100vw - 1320px) / 2 + 12px));
}

.rm-top-row {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 16px;
}

.rm-back {
    display: inline-flex; align-items: center; gap: 6px;
    color: rgba(255,255,255,.85); font-size: 13px; font-weight: 600;
    text-decoration: none; padding: 7px 16px; border-radius: 30px;
    border: 1px solid rgba(255,255,255,.3);
    transition: all .2s;
}
.rm-back:hover { color:#fff; background:rgba(255,255,255,.15); border-color:rgba(255,255,255,.55); }

.rm-chip {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(255,255,255,.18);
    border: 1px solid rgba(255,255,255,.3);
    color: #fff; font-size: 12px; font-weight: 700;
    padding: 6px 14px; border-radius: 20px;
}

.rm-hero h1 {
    font-size: clamp(24px, 4vw, 38px);
    font-weight: 800; color: #fff;
    margin: 0 0 8px; letter-spacing: -.3px;
}
.rm-hero p {
    color: rgba(255,255,255,.7);
    font-size: 14px; margin: 0;
}

/* ── Count row ── */
.rm-count {
    display: flex; align-items: center; justify-content: space-between;
    margin: 32px 0 14px;
}
.rm-count h2 { font-size: 18px; font-weight: 700; color: #1a1a2e; }
.rm-count span {
    font-size: 13px; color: #8a8fad;
    background: #fff; border: 1px solid #e4e6f0;
    border-radius: 30px; padding: 4px 14px;
}

/* ── Grid ── */
.rm-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(295px, 1fr));
    gap: 20px; padding-bottom: 60px;
}

/* ── Card ── */
.rm-card {
    background: #fff; border-radius: 18px;
    border: 1.5px solid #e4e6f0; overflow: hidden;
    display: flex; flex-direction: column;
    transition: transform .3s, box-shadow .3s, border-color .3s;
    animation: fadeUp .4s ease both;
}
@keyframes fadeUp {
    from { opacity:0; transform:translateY(14px); }
    to   { opacity:1; transform:translateY(0); }
}
.rm-card:nth-child(1){animation-delay:.05s}
.rm-card:nth-child(2){animation-delay:.10s}
.rm-card:nth-child(3){animation-delay:.15s}
.rm-card:nth-child(4){animation-delay:.20s}
.rm-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 16px 40px rgba(102,126,234,.13);
    border-color: rgba(102,126,234,.28);
}
.rm-band { height: 4px; background: linear-gradient(90deg,#667eea,#764ba2); }
.rm-card:nth-child(2) .rm-band { background: linear-gradient(90deg,#ff5fa0,#ff8ecb); }
.rm-card:nth-child(3) .rm-band { background: linear-gradient(90deg,#00c48c,#00e5a8); }
.rm-card:nth-child(4) .rm-band { background: linear-gradient(90deg,#ff9f43,#ffbe76); }

.rm-body { padding: 20px 20px 14px; flex: 1; }
.rm-level {
    display: inline-flex; font-size: 11px; font-weight: 700;
    letter-spacing: .05em; text-transform: uppercase;
    padding: 3px 10px; border-radius: 20px; margin-bottom: 10px;
}
.level-beginner     { background:rgba(0,196,140,.1);   color:#00a376; }
.level-intermediate { background:rgba(255,159,67,.1);  color:#e07b00; }
.level-advanced     { background:rgba(102,126,234,.1); color:#667eea; }

.rm-title { font-size: 16px; font-weight: 700; color: #1a1a2e; margin-bottom: 6px; }
.rm-desc  { font-size: 13px; color: #8a8fad; line-height: 1.5; margin-bottom: 12px; }
.rm-stats { display: flex; gap: 14px; }
.rm-stat  { font-size: 12px; color: #8a8fad; }

.rm-footer {
    padding: 12px 20px; border-top: 1px solid #e4e6f0;
    background: #fafbff;
    display: flex; align-items: center; justify-content: space-between; gap: 12px;
}
.rm-pw { flex: 1; }
.rm-pw-label { display:flex; justify-content:space-between; font-size:11px; color:#8a8fad; margin-bottom:4px; }
.rm-pw-track { height:4px; background:#e4e6f0; border-radius:99px; overflow:hidden; }
.rm-pw-fill  { height:100%; background:linear-gradient(90deg,#667eea,#764ba2); border-radius:99px; }
.rm-go {
    display: inline-flex; align-items: center; gap: 5px;
    background: #1a1a2e; color: #fff;
    font-size: 13px; font-weight: 700;
    padding: 8px 18px; border-radius: 30px;
    text-decoration: none; white-space: nowrap; transition: all .2s;
}
.rm-go:hover { background: #667eea; color: #fff; }
</style>
@endpush
@php
use App\Models\UserTaskProgress;
@endphp

@section('content')
<div class="rm-hero">
    <div class="rm-hero-inner">

        {{-- ✅ Back + chip on same row, aligned to navbar logo --}}
        <div class="rm-top-row">
            <a href="{{ route('skills.skill') }}" class="rm-back">← Back to Skills</a>
            <span class="rm-chip">🎯 {{ $skill->skill_name }}</span>
        </div>

        <h1>Choose Your Roadmap</h1>
        <p>Pick the learning path that matches your current level and goals.</p>
    </div>
</div>

<div class="container">
    <div class="rm-count">
        <h2>Available Roadmaps</h2>
        <span>{{ $roadmaps->count() }} paths</span>
    </div>

    <div class="rm-grid">
        @foreach($roadmaps as $roadmap)
        @php

$total = $roadmap->tasks->count();

$taskIds = $roadmap->tasks->pluck('id');

$done = UserTaskProgress::where('user_id', auth()->id())
    ->whereIn('task_id', $taskIds)
    ->where('is_completed', 1)
    ->count();

$pct = $total > 0 ? round(($done / $total) * 100) : 0;
            $lc    = match(strtolower($roadmap->level ?? 'beginner')) {
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
                <div class="rm-desc">{{ Str::limit($roadmap->description, 100) }}</div>
                <div class="rm-stats">
                    <span class="rm-stat">📋 {{ $total }} tasks</span>
                    @if($roadmap->duration)<span class="rm-stat">⏱ {{ $roadmap->duration }}</span>@endif
                    @if($done > 0)<span class="rm-stat" style="color:#00c48c">✔ {{ $done }} done</span>@endif
                </div>
            </div>
            <div class="rm-footer">
                <div class="rm-pw">
                    <div class="rm-pw-label"><span>Progress</span><span>{{ $pct }}%</span></div>
                    <div class="rm-pw-track">
                        <div class="rm-pw-fill" style="width: {{ $pct }}%"></div>
                    </div>
                </div>
                <a href="{{ route('roadmap.tasks', $roadmap->id) }}" class="rm-go">Start →</a>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection