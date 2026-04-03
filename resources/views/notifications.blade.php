@extends('layouts.app')

@push('styles')
<style>
/* ── Wrap ── */
.notif-wrap {
    background: #f0f0ec;
    min-height: 100vh;
    padding-bottom: 60px;
}

/* ── Hero ── */
.notif-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 44px 0 72px;
    position: relative;
    overflow: hidden;
    width: 100%;
    text-align: center;
}
.notif-hero::before {
    content: '';
    position: absolute; inset: 0;
    background-image: radial-gradient(rgba(255,255,255,.1) 1px, transparent 1px);
    background-size: 22px 22px;
    pointer-events: none;
}
.notif-hero::after {
    content: '';
    position: absolute; bottom: -2px; left: 0; right: 0;
    height: 52px;
    background: #f0f0ec;
    clip-path: ellipse(55% 100% at 50% 100%);
}
.notif-hero-inner { position: relative; z-index: 1; }
.notif-hero h1 {
    font-size: clamp(22px, 4vw, 36px); font-weight: 800;
    color: #fff !important; margin-bottom: 6px; letter-spacing: -.3px;
}
.notif-hero p { color: rgba(255,255,255,.72) !important; font-size: 14px; margin: 0; }

/* ── Content area ── */
.notif-body { max-width: 680px; margin: 0 auto; padding-top: 8px; }

/* ── Topbar ── */
.notif-topbar {
    display: flex; align-items: center; justify-content: space-between;
    margin: 32px 0 20px;
}
.notif-topbar h2 { font-size: 17px; font-weight: 700; color: #1a1a2e; margin: 0; }
.notif-back {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 13px; font-weight: 700; color: #667eea !important;
    background: rgba(102,126,234,.08);
    border: 1.5px solid rgba(102,126,234,.2);
    padding: 6px 16px; border-radius: 30px;
    text-decoration: none !important;
    transition: all .2s;
}
.notif-back:hover {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: #fff !important;
    border-color: transparent;
}

/* ── Notification card ── */
.notif-card {
    background: #fff;
    border-radius: 16px;
    border: 1.5px solid #e4e6f0;
    margin-bottom: 12px;
    display: flex; align-items: center; gap: 14px;
    padding: 16px 20px;
    text-decoration: none !important;
    color: #1a1a2e !important;
    transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    animation: notifIn .35s ease both;
    box-shadow: 0 2px 6px rgba(0,0,0,.04);
    position: relative;
    overflow: hidden;
}
.notif-card::before {
    content: '';
    position: absolute; left: 0; top: 0; bottom: 0;
    width: 3px;
    background: linear-gradient(180deg, #667eea, #764ba2);
    opacity: 0;
    transition: opacity .2s;
}
.notif-card:hover::before { opacity: 1; }
.notif-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 32px rgba(102,126,234,.12);
    border-color: rgba(102,126,234,.28);
}

/* Staggered animation */
.notif-card:nth-child(1)  { animation-delay: .04s; }
.notif-card:nth-child(2)  { animation-delay: .08s; }
.notif-card:nth-child(3)  { animation-delay: .12s; }
.notif-card:nth-child(4)  { animation-delay: .16s; }
.notif-card:nth-child(5)  { animation-delay: .20s; }
.notif-card:nth-child(6)  { animation-delay: .24s; }
.notif-card:nth-child(n+7){ animation-delay: .28s; }
@keyframes notifIn {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* Icon blob */
.notif-icon {
    flex-shrink: 0;
    width: 46px; height: 46px; border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px;
}
.notif-icon.follow  { background: rgba(0,196,140,.1);   }
.notif-icon.like    { background: rgba(255,77,109,.1);  }
.notif-icon.comment { background: rgba(102,126,234,.1); }
.notif-icon.default { background: rgba(138,143,173,.1); }

/* Text */
.notif-text { flex: 1; }
.notif-name  { font-size: 14px; font-weight: 700; color: #1a1a2e; margin-bottom: 3px; }
.notif-time  { font-size: 12px; color: #8a8fad; font-weight: 500; }

/* Chevron */
.notif-arrow {
    color: #c8cce0; font-size: 16px;
    transition: transform .2s, color .2s;
    flex-shrink: 0;
}
.notif-card:hover .notif-arrow { transform: translateX(3px); color: #667eea; }

/* ── Empty state ── */
.notif-empty {
    text-align: center; padding: 72px 20px; color: #8a8fad;
}
.notif-empty-icon { font-size: 52px; margin-bottom: 14px; }
.notif-empty h4   { font-size: 18px; font-weight: 700; color: #1a1a2e; margin-bottom: 6px; }
.notif-empty p    { font-size: 14px; }
</style>
@endpush

@section('content')
<div class="notif-wrap">

    {{-- Hero --}}
    <div class="notif-hero">
        <div class="container notif-hero-inner">
            <h1>🔔 Notifications</h1>
            <p>Stay up to date with your learning community.</p>
        </div>
    </div>

    {{-- Body --}}
    <div class="container">
        <div class="notif-body">

            <div class="notif-topbar">
                <h2>All Notifications</h2>
                <a href="{{ route('feed') }}" class="notif-back">← Back to Feed</a>
            </div>

            @forelse($notifications as $n)
            <a href="{{ $n->url ?? '#' }}" class="notif-card">

                {{-- Icon --}}
                @if($n->type == 'follow')
                    <div class="notif-icon follow">👤</div>
                @elseif($n->type == 'like')
                    <div class="notif-icon like">❤️</div>
                @elseif($n->type == 'comment')
                    <div class="notif-icon comment">💬</div>
                @else
                    <div class="notif-icon default">🔔</div>
                @endif

                {{-- Text --}}
                <div class="notif-text">
                    <div class="notif-name">
                        {{ $n->name }}
                        @if($n->type == 'follow')
                            started following you
                        @elseif($n->type == 'like')
                            liked your post
                        @elseif($n->type == 'comment')
                            commented on your post
                        @endif
                    </div>
                    <div class="notif-time">{{ \Carbon\Carbon::parse($n->created_at)->diffForHumans() }}</div>
                </div>

                {{-- Arrow --}}
                <span class="notif-arrow">›</span>

            </a>
            @empty
            <div class="notif-empty">
                <div class="notif-empty-icon">🔕</div>
                <h4>No notifications yet</h4>
                <p>When someone follows, likes, or comments — it'll show up here.</p>
            </div>
            @endforelse

        </div>
    </div>

</div>
@endsection