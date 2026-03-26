@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@push('styles')
<style>
/* ── Design Tokens — original purple scheme ── */
:root {
    --primary:      #667eea;
    --gradient:     linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --pink-grad:    linear-gradient(135deg, #f093fb, #f5576c);
    --green-grad:   linear-gradient(135deg, #43e97b, #38f9d7);
    --blue-grad:    linear-gradient(135deg, #4facfe, #00f2fe);

    --bg:           #f4f6fb;
    --surface:      #ffffff;
    --border:       #eaecf4;
    --ink:          #1e2340;
    --ink-mid:      #5a6080;
    --ink-soft:     #9ea5c0;
    --ink-ghost:    #c8cedf;

    --purple-lt:    #eef0fd;
    --pink-lt:      #fde8f0;
    --green-lt:     #e4faf2;
    --blue-lt:      #e6f4fe;

    --shadow-sm:    0 2px 8px rgba(102,126,234,.08), 0 1px 3px rgba(0,0,0,.04);
    --shadow-md:    0 8px 28px rgba(102,126,234,.14), 0 2px 8px rgba(0,0,0,.05);

    --r-sm:  8px;
    --r-md:  14px;
    --r-lg:  18px;
    --r-xl:  22px;
}

* { box-sizing: border-box; }
body { background: var(--bg); font-family: 'Segoe UI', system-ui, -apple-system, sans-serif; color: var(--ink); }

/* ── Welcome Banner ── */
.welcome-banner {
    background: var(--gradient);
    border-radius: var(--r-xl);
    padding: 1.9rem 2.4rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1.5rem;
    box-shadow: 0 12px 40px rgba(102,126,234,.38);
    position: relative;
    overflow: hidden;
    margin-bottom: 1.75rem;
}
.welcome-banner::after {
    content: '';
    position: absolute;
    right: -30px; top: -50px;
    width: 190px; height: 190px;
    border-radius: 50%;
    background: rgba(255,255,255,.07);
    pointer-events: none;
}
.welcome-banner .greeting { font-size: 1.45rem; font-weight: 700; color: #fff; margin: 0 0 .3rem; }
.welcome-banner .sub { font-size: .84rem; color: rgba(255,255,255,.75); margin: 0; }
.welcome-banner .rocket { font-size: 3rem; opacity: .25; flex-shrink: 0; }

/* ── Stats Grid ── */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.2rem;
    margin-bottom: 1.75rem;
}
@media (max-width: 1100px) { .stats-grid { grid-template-columns: repeat(2,1fr); } }
@media (max-width: 600px)  { .stats-grid { grid-template-columns: 1fr; } }

.stat-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--r-lg);
    padding: 1.4rem 1.4rem 1.2rem;
    box-shadow: var(--shadow-sm);
    transition: box-shadow .22s, transform .22s;
    position: relative;
    overflow: hidden;
}
.stat-card:hover { box-shadow: var(--shadow-md); transform: translateY(-3px); }

.accent-bar { position: absolute; top: 0; left: 0; right: 0; height: 3px; border-radius: var(--r-lg) var(--r-lg) 0 0; }
.ab-purple { background: var(--gradient); }
.ab-pink   { background: var(--pink-grad); }
.ab-green  { background: var(--green-grad); }
.ab-blue   { background: var(--blue-grad); }

.card-top { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: .9rem; }
.card-label { font-size: .65rem; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; color: var(--ink-soft); margin: 0 0 .55rem; }
.card-num { font-size: 2.35rem; font-weight: 800; line-height: 1; color: var(--ink); letter-spacing: -.02em; }

/* icon boxes */
.stat-icon { width: 46px; height: 46px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.stat-icon svg { width: 21px; height: 21px; display: block; }
.ic-purple { background: var(--purple-lt); }
.ic-pink   { background: var(--pink-lt); }
.ic-green  { background: var(--green-lt); }
.ic-blue   { background: var(--blue-lt); }
.ic-purple svg { stroke: #667eea; }
.ic-pink   svg { stroke: #f5576c; }
.ic-green  svg { stroke: #22c17b; }
.ic-blue   svg { stroke: #4facfe; }

.card-foot { display: flex; align-items: center; justify-content: space-between; border-top: 1px solid var(--border); padding-top: .8rem; margin-top: .8rem; }
.trend { font-size: .71rem; font-weight: 600; display: flex; align-items: center; gap: .25rem; }
.trend-up      { color: #22c17b; }
.trend-neutral { color: var(--ink-soft); }
.trend svg { width: 12px; height: 12px; flex-shrink: 0; }

.manage-link {
    font-size: .71rem; font-weight: 700; text-decoration: none; letter-spacing: .02em; transition: opacity .15s;
    background: var(--gradient);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.manage-link:hover { opacity: .65; }

/* ── Bottom Row ── */
.bottom-row { display: grid; grid-template-columns: 1fr 340px; gap: 1.2rem; }
@media (max-width: 960px) { .bottom-row { grid-template-columns: 1fr; } }

.panel { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r-lg); box-shadow: var(--shadow-sm); overflow: hidden; }

.panel-head { display: flex; align-items: center; justify-content: space-between; padding: 1.1rem 1.5rem; border-bottom: 1px solid var(--border); }
.panel-title { font-size: .88rem; font-weight: 700; color: var(--ink); position: relative; padding-bottom: 7px; }
.panel-title::after { content: ''; position: absolute; bottom: 0; left: 0; width: 28px; height: 2.5px; background: var(--gradient); border-radius: 2px; }
.panel-link { font-size: .75rem; font-weight: 600; text-decoration: none; background: var(--gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
.panel-link:hover { opacity: .7; }

/* ── Feed ── */
.feed-item { display: flex; align-items: flex-start; gap: .9rem; padding: .9rem 1.5rem; border-bottom: 1px solid var(--border); transition: background .15s; }
.feed-item:last-child { border-bottom: none; }
.feed-item:hover { background: #f6f7ff; }

.feed-avatar { width: 36px; height: 36px; border-radius: 50%; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: .74rem; font-weight: 800; overflow: hidden; }
.feed-avatar img { width: 100%; height: 100%; object-fit: cover; }
.av-purple { background: var(--purple-lt); color: #667eea; }
.av-green  { background: var(--green-lt);  color: #22c17b; }
.av-pink   { background: var(--pink-lt);   color: #f5576c; }

.feed-body { flex: 1; min-width: 0; }
.feed-text { font-size: .8rem; color: var(--ink-mid); line-height: 1.5; margin: 0 0 .16rem; }
.feed-text strong { color: var(--ink); font-weight: 700; }
.feed-text em { font-style: italic; color: var(--ink); }
.feed-time { font-size: .68rem; color: var(--ink-ghost); }

.feed-badge { font-size: .59rem; font-weight: 700; letter-spacing: .07em; text-transform: uppercase; padding: .22rem .6rem; border-radius: 100px; flex-shrink: 0; margin-top: .15rem; }
.badge-post     { background: var(--purple-lt); color: #667eea; }
.badge-user     { background: var(--green-lt);  color: #22c17b; }
.badge-trending { background: var(--pink-lt);   color: #f5576c; }

/* ── Quick Actions ── */
.action-list { display: flex; flex-direction: column; padding: 1rem; gap: .5rem; }
.action-item { display: flex; align-items: center; gap: .85rem; padding: .85rem 1rem; border-radius: var(--r-sm); border: 1px solid var(--border); text-decoration: none; color: inherit; background: var(--surface); transition: background .16s, border-color .16s, box-shadow .16s, transform .16s; }
.action-item:hover { background: #f6f7ff; border-color: #d0d5f0; box-shadow: var(--shadow-sm); transform: translateX(2px); color: inherit; }

.action-icon { width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.action-icon svg { width: 18px; height: 18px; display: block; }

.action-label { font-size: .81rem; font-weight: 700; color: var(--ink); margin: 0 0 .1rem; }
.action-sub   { font-size: .7rem; color: var(--ink-soft); margin: 0; }

.action-arrow { margin-left: auto; color: var(--ink-ghost); display: flex; align-items: center; transition: transform .16s, color .16s; }
.action-arrow svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
.action-item:hover .action-arrow { transform: translateX(3px); color: #667eea; }

/* ── Animations ── */
.fu { opacity: 0; animation: fadeUp .48s cubic-bezier(.22,.68,0,1.2) both; }
@keyframes fadeUp { from { opacity:0; transform:translateY(14px); } to { opacity:1; transform:translateY(0); } }
.d1{animation-delay:.04s}.d2{animation-delay:.10s}.d3{animation-delay:.16s}
.d4{animation-delay:.22s}.d5{animation-delay:.28s}.d6{animation-delay:.34s}.d7{animation-delay:.40s}
</style>
@endpush

@section('content')

{{-- ── SVG Sprite ── --}}
<svg xmlns="http://www.w3.org/2000/svg" style="display:none">
  <symbol id="ico-users" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
  </symbol>
  <symbol id="ico-post" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
    <polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>
  </symbol>
  <symbol id="ico-comment" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
  </symbol>
  <symbol id="ico-heart" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
  </symbol>
  <symbol id="ico-user-plus" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/>
    <line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/>
  </symbol>
  <symbol id="ico-edit" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
  </symbol>
  <symbol id="ico-book" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
  </symbol>
  <symbol id="ico-chevron-r" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <polyline points="9 18 15 12 9 6"/>
  </symbol>
</svg>

{{-- ── Welcome Banner ── --}}
<div class="welcome-banner fu d1">
    <div>
        <h4 class="greeting">Welcome back, {{ auth()->user()->name ?? 'Admin' }}! 👋</h4>
        <p class="sub">Here's what's happening on your platform today.</p>
    </div>
    <div class="rocket d-none d-md-block">🚀</div>
</div>

{{-- ── Stat Cards ── --}}
<div class="stats-grid">

    <div class="stat-card fu d2">
        <div class="accent-bar ab-purple"></div>
        <div class="card-top">
            <div>
                <p class="card-label">Total Users</p>
                <div class="card-num">{{ number_format($totalUsers) }}</div>
            </div>
            <div class="stat-icon ic-purple">
                <svg><use href="#ico-users"/></svg>
            </div>
        </div>
        <div class="card-foot">
            <span class="trend trend-up">
                <svg viewBox="0 0 24 24" fill="none" stroke="#22c17b" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="19" x2="12" y2="5"/><polyline points="5 12 12 5 19 12"/></svg>
                +12% this month
            </span>
            <a href="{{ route('admin.users.users') }}" class="manage-link">Manage →</a>
        </div>
    </div>

    <div class="stat-card fu d3">
        <div class="accent-bar ab-pink"></div>
        <div class="card-top">
            <div>
                <p class="card-label">Total Posts</p>
                <div class="card-num">{{ number_format($totalPosts) }}</div>
            </div>
            <div class="stat-icon ic-pink">
                <svg><use href="#ico-post"/></svg>
            </div>
        </div>
        <div class="card-foot">
            <span class="trend trend-up">
                <svg viewBox="0 0 24 24" fill="none" stroke="#22c17b" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="19" x2="12" y2="5"/><polyline points="5 12 12 5 19 12"/></svg>
                +8% this month
            </span>
            <a href="{{ route('admin.posts') }}" class="manage-link">Manage →</a>
        </div>
    </div>

    <div class="stat-card fu d4">
        <div class="accent-bar ab-green"></div>
        <div class="card-top">
            <div>
                <p class="card-label">Comments</p>
                <div class="card-num">{{ number_format($totalComments ?? 0) }}</div>
            </div>
            <div class="stat-icon ic-green">
                <svg><use href="#ico-comment"/></svg>
            </div>
        </div>
        <div class="card-foot">
            <span class="trend trend-up">
                <svg viewBox="0 0 24 24" fill="none" stroke="#22c17b" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="19" x2="12" y2="5"/><polyline points="5 12 12 5 19 12"/></svg>
                +5% this month
            </span>
            <a href="{{ route('admin.comments') }}" class="manage-link">View →</a>
        </div>
    </div>

    <div class="stat-card fu d5">
        <div class="accent-bar ab-blue"></div>
        <div class="card-top">
            <div>
                <p class="card-label">Total Likes</p>
                <div class="card-num">{{ number_format($totalLikes) }}</div>
            </div>
            <div class="stat-icon ic-blue">
                <svg><use href="#ico-heart"/></svg>
            </div>
        </div>
        <div class="card-foot">
            <span class="trend trend-neutral">
                <svg viewBox="0 0 24 24" fill="none" stroke="#9ea5c0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                Active Engagement
            </span>
            <a href="{{ route('admin.likes') }}" class="manage-link">View Details →</a>
        </div>
    </div>

</div>

{{-- ── Bottom Row ── --}}
<div class="bottom-row">

    {{-- Recent Activity --}}
    <div class="panel fu d6">
        <div class="panel-head">
            <span class="panel-title">Recent Activity</span>
            <a href="{{ route('admin.notifications') }}" class="panel-link">View all →</a>
        </div>

        @foreach($recentPosts as $post)
        <div class="feed-item">
            @if($post->user && $post->user->profile_photo)
                <div class="feed-avatar"><img src="{{ asset('storage/'.$post->user->profile_photo) }}" alt="{{ $post->user->name }}"></div>
            @else
                <div class="feed-avatar av-purple">{{ strtoupper(substr($post->user->name ?? 'U', 0, 1)) }}</div>
            @endif
            <div class="feed-body">
                <p class="feed-text"><strong>{{ $post->user->name ?? 'Unknown' }}</strong> published <em>"{{ Str::limit($post->title, 42) }}"</em></p>
                <span class="feed-time">{{ $post->created_at->diffForHumans() }}</span>
            </div>
            <span class="feed-badge badge-post">Post</span>
        </div>
        @endforeach

        @foreach($recentUsers as $user)
        <div class="feed-item">
            @if($user->profile_photo)
                <div class="feed-avatar"><img src="{{ asset('storage/'.$user->profile_photo) }}" alt="{{ $user->name }}"></div>
            @else
                <div class="feed-avatar av-green">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
            @endif
            <div class="feed-body">
                <p class="feed-text"><strong>{{ $user->name }}</strong> registered a new account</p>
                <span class="feed-time">{{ $user->created_at->diffForHumans() }}</span>
            </div>
            <span class="feed-badge badge-user">User</span>
        </div>
        @endforeach

        @if($trendingPost)
        <div class="feed-item">
            <div class="feed-avatar av-pink">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#f5576c" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/>
                </svg>
            </div>
            <div class="feed-body">
                <p class="feed-text"><em>"{{ Str::limit($trendingPost->title, 42) }}"</em> is trending with <strong>{{ $trendingPost->likes_count }}+</strong> reactions</p>
                <span class="feed-time">{{ $trendingPost->updated_at->diffForHumans() }}</span>
            </div>
            <span class="feed-badge badge-trending">Trending</span>
        </div>
        @endif

    </div>

    {{-- Quick Actions --}}
    <div class="panel fu d7">
        <div class="panel-head">
            <span class="panel-title">Quick Actions</span>
        </div>
        <div class="action-list">

            <a href="/admin/users/create" class="action-item">
                <div class="action-icon ic-purple">
                    <svg><use href="#ico-user-plus"/></svg>
                </div>
                <div>
                    <p class="action-label">Add New User</p>
                    <p class="action-sub">Create a new account</p>
                </div>
                <span class="action-arrow"><svg><use href="#ico-chevron-r"/></svg></span>
            </a>

            <a href="/admin/posts/create" class="action-item">
                <div class="action-icon ic-pink">
                    <svg><use href="#ico-edit"/></svg>
                </div>
                <div>
                    <p class="action-label">Create Post</p>
                    <p class="action-sub">Publish new content</p>
                </div>
                <span class="action-arrow"><svg><use href="#ico-chevron-r"/></svg></span>
            </a>

            <a href="/admin/skills" class="action-item">
                <div class="action-icon ic-green">
                    <svg><use href="#ico-book"/></svg>
                </div>
                <div>
                    <p class="action-label">Manage Skills</p>
                    <p class="action-sub">Add or edit skill topics</p>
                </div>
                <span class="action-arrow"><svg><use href="#ico-chevron-r"/></svg></span>
            </a>

        </div>
    </div>

</div>

@endsection