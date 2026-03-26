@extends('layouts.app')
@section('title', $roadmap->title . ' — Tasks')

@push('styles')
<style>
    :root {
        --grad: linear-gradient(135deg, #667eea, #764ba2);
        --ink: #1a1a2e;
        --soft: #f0f2fb;
        --card: #fff;
        --muted: #8a8fad;
        --border: #e4e6f0;
        --done: #00c48c;
        --accent: #667eea;
    }

    /* ── Hero ── */
    .rt-hero {
        background: var(--grad);
        padding: 48px 0 44px;
        position: relative;
        overflow: hidden;
    }

    .rt-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(255, 255, 255, .1) 1px, transparent 1px);
        background-size: 22px 22px;
    }

    .rt-hero::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        right: 0;
        height: 48px;
        background: var(--soft);
        clip-path: ellipse(55% 100% at 50% 100%);
    }

    .rt-hero-inner {
        position: relative;
    }

    .rt-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: rgba(255, 255, 255, .75);
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        padding: 6px 14px;
        border-radius: 30px;
        border: 1px solid rgba(255, 255, 255, .25);
        margin-bottom: 18px;
        transition: all .2s;
    }

    .rt-back:hover {
        color: #fff;
        background: rgba(255, 255, 255, .1);
        border-color: rgba(255, 255, 255, .45);
    }

    .rt-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255, 255, 255, .18);
        border: 1px solid rgba(255, 255, 255, .3);
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 20px;
        margin-bottom: 10px;
    }

    .rt-hero h1 {
        font-size: clamp(20px, 4vw, 34px);
        font-weight: 800;
        color: #fff;
        margin-bottom: 6px;
        letter-spacing: -.3px;
    }

    .rt-hero p {
        color: rgba(255, 255, 255, .65);
        font-size: 14px;
    }

    /* Progress in hero */
    .rt-prog {
        max-width: 380px;
        margin-top: 20px;
    }

    .rt-prog-top {
        display: flex;
        justify-content: space-between;
        font-size: 13px;
        color: rgba(255, 255, 255, .7);
        margin-bottom: 7px;
    }

    .rt-prog-top b {
        color: #fff;
    }

    .rt-prog-track {
        height: 7px;
        background: rgba(255, 255, 255, .15);
        border-radius: 99px;
        overflow: hidden;
    }

    .rt-prog-fill {
        height: 100%;
        background: rgba(255, 255, 255, .85);
        border-radius: 99px;
        transition: width .8s ease;
    }

    /* Stats strip */
    .rt-stats {
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
        margin: 28px 0 8px;
        padding: 16px 22px;
        background: #fff;
        border-radius: 14px;
        border: 1.5px solid var(--border);
        box-shadow: 0 2px 10px rgba(0, 0, 0, .04);
    }

    .rt-stat {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: var(--muted);
        font-weight: 500;
    }

    .rt-stat b {
        font-size: 18px;
        font-weight: 800;
        color: var(--ink);
    }

    .rt-divider {
        width: 1px;
        background: var(--border);
        align-self: stretch;
    }

    /* Timeline */
    .rt-timeline {
        position: relative;
        padding: 28px 0 60px;
    }

    .rt-timeline::before {
        content: '';
        position: absolute;
        left: 23px;
        top: 28px;
        bottom: 60px;
        width: 2px;
        background: linear-gradient(180deg, #667eea 0%, var(--border) 100%);
    }

    /* Task row */
    .rt-task {
        display: flex;
        gap: 18px;
        margin-bottom: 14px;
        animation: taskIn .4s ease both;
        position: relative;
    }

    .rt-task:nth-child(1) {
        animation-delay: .06s
    }

    .rt-task:nth-child(2) {
        animation-delay: .10s
    }

    .rt-task:nth-child(3) {
        animation-delay: .14s
    }

    .rt-task:nth-child(4) {
        animation-delay: .18s
    }

    .rt-task:nth-child(5) {
        animation-delay: .22s
    }

    @keyframes taskIn {
        from {
            opacity: 0;
            transform: translateX(-10px)
        }

        to {
            opacity: 1;
            transform: translateX(0)
        }
    }

    /* Node */
    .rt-node {
        flex-shrink: 0;
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 15px;
        position: relative;
        z-index: 1;
        border: 3px solid #fff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, .08);
        transition: transform .2s;
    }

    .rt-task:hover .rt-node {
        transform: scale(1.1);
    }

    .rt-task.done .rt-node {
        background: var(--done);
        color: #fff;
    }

    .rt-task.pending .rt-node {
        background: #fff;
        border-color: #e4e6f0;
        color: var(--muted);
    }

    /* Card */
    .rt-card {
        flex: 1;
        background: var(--card);
        border-radius: 14px;
        border: 1.5px solid var(--border);
        padding: 16px 20px;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 14px;
        transition: all .25s ease;
    }

    .rt-card:hover {
        border-color: rgba(102, 126, 234, .28);
        box-shadow: 0 8px 24px rgba(102, 126, 234, .1);
        transform: translateX(4px);
    }

    .rt-task.done .rt-card {
        background: #f0fdf8;
        border-color: rgba(0, 196, 140, .2);
    }

    .rt-card-left {
        flex: 1;
    }

    .rt-task-num {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .06em;
        color: var(--muted);
        text-transform: uppercase;
        margin-bottom: 3px;
    }

    .rt-task.done .rt-task-num {
        color: var(--done);
    }

    .rt-task-title {
        font-size: 15px;
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 4px;
    }

    .rt-task.done .rt-task-title {
        text-decoration: line-through;
        color: var(--muted);
    }

    .rt-task-desc {
        font-size: 13px;
        color: var(--muted);
        line-height: 1.5;
    }

    /* Button */
    .rt-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        border: none;
        transition: all .2s;
        white-space: nowrap;
        font-family: inherit;
    }

    .rt-task.pending .rt-btn {
        background: var(--grad);
        color: #fff;
        box-shadow: 0 4px 12px rgba(102, 126, 234, .3);
    }

    .rt-task.pending .rt-btn:hover {
        opacity: .9;
        transform: translateY(-1px);
    }

    .rt-task.done .rt-btn {
        background: rgba(0, 196, 140, .1);
        color: var(--done);
        border: 1.5px solid rgba(0, 196, 140, .25);
    }

    .rt-task.done .rt-btn:hover {
        background: #ff4d6d;
        color: #fff;
        border-color: #ff4d6d;
    }

    /* Complete banner */
    .rt-win {
        background: linear-gradient(135deg, #00c48c, #00e5a8);
        border-radius: 16px;
        padding: 28px 24px;
        text-align: center;
        color: #fff;
        margin-bottom: 24px;
        animation: fadeUp .5s ease both;
    }
</style>
@endpush
@section('content')

@php
$completedTaskIds = \App\Models\UserTaskProgress::where('user_id', Auth::id())
    ->whereIn('task_id', $tasks->pluck('id'))
    ->where('is_completed', 1)
    ->pluck('task_id')
    ->toArray();

$total = $tasks->count();
$done = count($completedTaskIds);
$pct = ($total > 0) ? round(($done / $total) * 100) : 0;
@endphp

<div class="rt-hero">
    <div class="container rt-hero-inner">
        @if($roadmap->skill->roadmaps->count() > 1)
        <a href="{{ route('roadmap.show', $roadmap->skill_id) }}" class="rt-back">
            ← Back to Roadmaps
        </a>
        @else
        <a href="{{ route('skills.skill') }}" class="rt-back">
            ← Back to Skills
        </a>
        @endif
        <div class="rt-chip">🎯 {{ $roadmap->skill->skill_name ?? 'Skill' }}</div>
        <h1>{{ $roadmap->title }}</h1>
        <p>{{ $roadmap->description }}</p>

        <!-- ✅ Progress -->
        <div class="rt-prog">
            <div class="rt-prog-top">
                <span>Overall Progress</span><b>{{ $pct }}%</b>
            </div>
            <div class="rt-prog-track">
                <div class="rt-prog-fill" style="width: {{ $pct }}%"></div>
            </div>
        </div>
    </div>
</div>

<div class="container">

    <div class="rt-stats">
        <div class="rt-stat"><b>{{ $total }}</b> Total Tasks</div>
        <div class="rt-divider"></div>
        <div class="rt-stat"><b style="color:var(--done)">{{ $done }}</b> Completed</div>
        <div class="rt-divider"></div>
        <div class="rt-stat"><b style="color:#ff9f43">{{ max(0, $total - $done) }}</b> Remaining</div>
    </div>

    {{-- 🎉 Completed Banner --}}
    @if($pct === 100)
    <div class="rt-win">
        <div style="font-size:36px;margin-bottom:8px">🎉</div>
        <h3>Roadmap Complete!</h3>
        <p>You've finished all tasks. Great work!</p>
    </div>
    @endif

    <div class="rt-timeline">
        @foreach($tasks as $task)
       @php $isDone = in_array($task->id, $completedTaskIds); @endphp

        <div class="rt-task {{ $isDone ? 'done' : 'pending' }}">
            <div class="rt-node">{{ $isDone ? '✔' : $loop->iteration }}</div>

            <div class="rt-card">
                <div class="rt-card-left">
                    <div class="rt-task-num">Task {{ $loop->iteration }}</div>
                    <div class="rt-task-title">{{ $task->task_name }}</div>

                    @if($task->description)
                    <div class="rt-task-desc">{{ $task->description }}</div>
                    @endif
                </div>

                <div>
                    <form action="{{ route('roadmap.task.toggle', $task->id) }}" method="POST">
                        @csrf @method('PATCH')
                        <button class="rt-btn">
                            {{ $isDone ? '✔ Done' : 'Mark Done' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>

@endsection