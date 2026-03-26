@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@push('styles')
<style>
    :root { --gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }

    /* ── Stat card accent bar ── */
    .stat-card { border-radius: 18px; overflow: hidden; transition: transform .25s, box-shadow .25s; }
    .stat-card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,.10) !important; }
    .stat-card .accent { height: 4px; }
    .a-purple { background: var(--gradient); }
    .a-pink   { background: linear-gradient(135deg, #f093fb, #f5576c); }
    .a-green  { background: linear-gradient(135deg, #43e97b, #38f9d7); }
    .a-blue   { background: linear-gradient(135deg, #4facfe, #00f2fe); }

    /* ── Gradient number ── */
    .stat-num {
        font-size: 2.4rem;
        font-weight: 800;
        line-height: 1;
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* ── Icon box ── */
    .stat-icon {
        width: 50px; height: 50px;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.35rem;
        flex-shrink: 0;
    }

    /* ── Quick action card ── */
    .quick-card {
        border-radius: 14px;
        transition: transform .2s, box-shadow .2s;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 14px;
        padding: .9rem 1rem;
        color: inherit;
    }
    .quick-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102,126,234,.18) !important;
        color: inherit;
    }

    /* ── Activity dot ── */
    .act-dot { width: 9px; height: 9px; border-radius: 50%; flex-shrink: 0; margin-top: 5px; }

    /* ── Section heading underline (matches your .section-title) ── */
    .panel-heading {
        font-weight: 700;
        font-size: 1rem;
        position: relative;
        display: inline-block;
        padding-bottom: 8px;
    }
    .panel-heading::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0;
        width: 40px; height: 3px;
        background: var(--gradient);
        border-radius: 2px;
    }

    /* ── Fade-up stagger ── */
    .fu { animation: fadeUp .45s ease both; }
    @keyframes fadeUp { from { opacity:0; transform:translateY(14px); } to { opacity:1; transform:translateY(0); } }
    .d1{animation-delay:.05s} .d2{animation-delay:.10s} .d3{animation-delay:.15s}
    .d4{animation-delay:.20s} .d5{animation-delay:.25s} .d6{animation-delay:.30s}
</style>
@endpush

@section('content')

{{-- ── Welcome Banner ── --}}
<div class="rounded-4 p-4 mb-4 text-white fu d1"
     style="background:var(--gradient); box-shadow:0 10px 30px rgba(102,126,234,.35);">

    <div class="row align-items-center">

        <div class="col">
            <h4 class="fw-bold mb-1">Notifications</h4>
            <p class="mb-0 opacity-75 small">
                Here's what's happening on your platform today.
            </p>
        </div>

        <!-- BACK BUTTON -->
        <div class="col-auto">
            <a href="{{ route('admin.dashboard') }}"
               class="btn btn-light btn-sm rounded-pill px-3 fw-semibold">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
        </div>

    </div>
</div>
{{-- ── Stat Cards ── --}}
@forelse($activities as $n)
<a href="{{ $n['url'] ?? '#' }}" class="text-decoration-none text-dark">
    <div class="card border-0 shadow-sm rounded-4 mb-3 notification-card">
        <div class="card-body d-flex align-items-center gap-3">

            <div class="rounded-circle d-flex align-items-center justify-content-center"
                 style="width:48px;height:48px;background:#f1f3f5;">

                @if($n['type'] == 'user')
                    <i class="bi bi-person-plus-fill text-success fs-4"></i>
                @elseif($n['type'] == 'post')
                    <i class="bi bi-file-earmark-text-fill text-primary fs-4"></i>
                @elseif($n['type'] == 'like')
                    <i class="bi bi-heart-fill text-danger fs-4"></i>
                @elseif($n['type'] == 'comment')
                    <i class="bi bi-chat-dots-fill text-warning fs-4"></i>
                @else
                    <i class="bi bi-bell-fill text-secondary fs-4"></i>
                @endif

            </div>

            <div>
                <div class="fw-semibold">
                    {{ $n['name'] }} {{ $n['message'] }}
                </div>

                <small class="text-muted">
                    {{ \Carbon\Carbon::parse($n['time'])->diffForHumans() }}
                </small>
            </div>

        </div>
    </div>
</a>
@empty
<div class="text-center text-muted py-5">
    <i class="bi bi-bell-slash fs-1"></i>
    <p class="mt-2">No recent activity</p>
</div>
@endforelse
@endsection