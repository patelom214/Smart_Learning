@extends('layouts.admin')

@section('title', 'Analytics')
@section('page-title', 'Analytics')

@push('styles')
<style>
    :root {
        --gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --grad-start: #667eea;
        --grad-end: #764ba2;
    }

    /* ── Stat cards ── */
    .an-card {
        border-radius: 18px;
        overflow: hidden;
        transition: transform .25s, box-shadow .25s;
    }

    .an-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 40px rgba(0, 0, 0, .10) !important;
    }

    .an-card .accent {
        height: 4px;
    }

    .ac-1 {
        background: var(--gradient);
    }

    .ac-2 {
        background: linear-gradient(135deg, #f093fb, #f5576c);
    }

    .ac-3 {
        background: linear-gradient(135deg, #43e97b, #38f9d7);
    }

    .ac-4 {
        background: linear-gradient(135deg, #4facfe, #00f2fe);
    }

    .ac-5 {
        background: linear-gradient(135deg, #f7971e, #ffd200);
    }

    .ac-6 {
        background: linear-gradient(135deg, #ee9ca7, #ffdde1);
    }

    /* ── Gradient number ── */
    .an-num {
        font-size: 2.2rem;
        font-weight: 800;
        line-height: 1;
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* ── Icon box ── */
    .an-icon {
        width: 48px;
        height: 48px;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        flex-shrink: 0;
    }

    /* ── Chart panels ── */
    .chart-panel {
        border-radius: 18px;
        transition: box-shadow .2s;
    }

    .chart-panel:hover {
        box-shadow: 0 10px 30px rgba(0, 0, 0, .08) !important;
    }

    /* ── Panel heading underline ── */
    .panel-heading {
        font-weight: 700;
        font-size: .95rem;
        position: relative;
        display: inline-block;
        padding-bottom: 8px;
    }

    .panel-heading::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 36px;
        height: 3px;
        background: var(--gradient);
        border-radius: 2px;
    }

    /* ── Top users list ── */
    .top-user-row {
        padding: .65rem .5rem;
        border-radius: 10px;
        transition: background .15s;
    }

    .top-user-row:hover {
        background: rgba(102, 126, 234, .05);
    }

    .top-avatar {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        background: var(--gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 700;
        font-size: .8rem;
        flex-shrink: 0;
    }

    /* ── Period tabs ── */
    .period-tab {
        border: none;
        background: transparent;
        padding: .35rem .9rem;
        border-radius: 20px;
        font-size: .8rem;
        font-weight: 600;
        color: #6c757d;
        transition: all .18s;
        cursor: pointer;
    }

    .period-tab.active {
        background: var(--gradient);
        color: #fff;
        box-shadow: 0 3px 10px rgba(102, 126, 234, .35);
    }

    /* ── Progress bar gradient ── */
    .prog-bar {
        height: 7px;
        border-radius: 10px;
        background: var(--gradient);
    }

    /* ── Skill bar track ── */
    .skill-track {
        height: 7px;
        border-radius: 10px;
        background: #e9ecef;
        overflow: hidden;
    }

    /* ── Fade-up ── */
    .fu {
        animation: fadeUp .45s ease both;
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(14px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .d1 {
        animation-delay: .05s
    }

    .d2 {
        animation-delay: .08s
    }

    .d3 {
        animation-delay: .11s
    }

    .d4 {
        animation-delay: .14s
    }

    .d5 {
        animation-delay: .20s
    }

    .d6 {
        animation-delay: .25s
    }

    .d7 {
        animation-delay: .30s
    }

    .d8 {
        animation-delay: .35s
    }
</style>
@endpush

@section('content')

{{-- ── Page header ── --}}
<div class="d-flex align-items-center justify-content-between mb-4 fu d1">
    <div>
        <h5 class="fw-bold mb-0">Platform Analytics</h5>
        <small class="text-muted">Overview of your SmartLearn platform activity</small>
    </div>
    {{-- Period selector --}}
    <div class="d-flex gap-1 p-1 rounded-3 bg-light border">
        <button
            class="period-tab {{ request('period',7)==7 ? 'active' : '' }}"
            onclick="switchPeriod(this,7)">
            7 Days
        </button>

        <button
            class="period-tab {{ request('period')==30 ? 'active' : '' }}"
            onclick="switchPeriod(this,30)">
            30 Days
        </button>

        <button
            class="period-tab {{ request('period')==90 ? 'active' : '' }}"
            onclick="switchPeriod(this,90)">
            90 Days
        </button>
    </div>
</div>

{{-- ── Stat Cards Row 1 ── --}}
{{-- ── Stat Cards Row 1 ── --}}
<div class="row g-3 mb-4">

    {{-- USERS --}}
    <div class="col-6 col-xl-2 fu d2">
        <div class="an-card card border-0 shadow-sm h-100">
            <div class="accent ac-1"></div>
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="an-icon bg-primary bg-opacity-10">
                        {{-- Users / people icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                            stroke="#667eea" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="7" r="3"/>
                            <path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            <path d="M21 21v-2a4 4 0 0 0-3-3.87"/>
                        </svg>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill" style="font-size:.62rem;">+12%</span>
                </div>
                <div class="an-num">{{ $totalUsers ?? 0 }}</div>
                <div class="text-muted mt-1" style="font-size:.72rem; letter-spacing:.5px; text-transform:uppercase; font-weight:600;">Users</div>
            </div>
        </div>
    </div>

    {{-- POSTS --}}
    <div class="col-6 col-xl-2 fu d2">
        <div class="an-card card border-0 shadow-sm h-100">
            <div class="accent ac-2"></div>
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="an-icon bg-danger bg-opacity-10">
                        {{-- Document / post icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                            stroke="#f5576c" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="16" y1="13" x2="8" y2="13"/>
                            <line x1="16" y1="17" x2="8" y2="17"/>
                            <line x1="10" y1="9" x2="8" y2="9"/>
                        </svg>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill" style="font-size:.62rem;">+8%</span>
                </div>
                <div class="an-num">{{ $totalPosts ?? 0 }}</div>
                <div class="text-muted mt-1" style="font-size:.72rem; letter-spacing:.5px; text-transform:uppercase; font-weight:600;">Posts</div>
            </div>
        </div>
    </div>

    {{-- COMMENTS --}}
    <div class="col-6 col-xl-2 fu d3">
        <div class="an-card card border-0 shadow-sm h-100">
            <div class="accent ac-3"></div>
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="an-icon bg-success bg-opacity-10">
                        {{-- Chat bubble / comment icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                            stroke="#43e97b" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                            <line x1="9" y1="10" x2="15" y2="10"/>
                            <line x1="9" y1="14" x2="13" y2="14"/>
                        </svg>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill" style="font-size:.62rem;">+5%</span>
                </div>
                <div class="an-num">{{ $totalComments ?? 0 }}</div>
                <div class="text-muted mt-1" style="font-size:.72rem; letter-spacing:.5px; text-transform:uppercase; font-weight:600;">Comments</div>
            </div>
        </div>
    </div>

    {{-- LIKES --}}
    <div class="col-6 col-xl-2 fu d3">
        <div class="an-card card border-0 shadow-sm h-100">
            <div class="accent ac-4"></div>
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="an-icon bg-info bg-opacity-10">
                        {{-- Heart / like icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                            stroke="#4facfe" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                        </svg>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill" style="font-size:.62rem;">+18%</span>
                </div>
                <div class="an-num">{{ $totalLikes ?? 0 }}</div>
                <div class="text-muted mt-1" style="font-size:.72rem; letter-spacing:.5px; text-transform:uppercase; font-weight:600;">Likes</div>
            </div>
        </div>
    </div>

    {{-- SKILLS --}}
    <div class="col-6 col-xl-2 fu d4">
        <div class="an-card card border-0 shadow-sm h-100">
            <div class="accent ac-5"></div>
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="an-icon bg-warning bg-opacity-10">
                        {{-- Graduation cap / skills icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                            stroke="#f7971e" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                            <path d="M6 12v5c0 2 2 3 6 3s6-1 6-3v-5"/>
                        </svg>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill" style="font-size:.62rem;">+3%</span>
                </div>
                <div class="an-num">{{ $totalSkills ?? 0 }}</div>
                <div class="text-muted mt-1" style="font-size:.72rem; letter-spacing:.5px; text-transform:uppercase; font-weight:600;">Skills</div>
            </div>
        </div>
    </div>

    {{-- CONNECTIONS --}}
    <div class="col-6 col-xl-2 fu d4">
        <div class="an-card card border-0 shadow-sm h-100">
            <div class="accent ac-6"></div>
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="an-icon bg-danger bg-opacity-10">
                        {{-- Handshake / connections icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                            stroke="#ee9ca7" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="18" cy="5" r="3"/>
                            <circle cx="6" cy="12" r="3"/>
                            <circle cx="18" cy="19" r="3"/>
                            <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/>
                            <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/>
                        </svg>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill" style="font-size:.62rem;">+7%</span>
                </div>
                <div class="an-num">{{ $totalFriends ?? 0 }}</div>
                <div class="text-muted mt-1" style="font-size:.72rem; letter-spacing:.5px; text-transform:uppercase; font-weight:600;">Connections</div>
            </div>
        </div>
    </div>

</div>

{{-- ── Charts Row 1 ── --}}
<div class="row g-4 mb-4">

    {{-- User growth line chart --}}
    <div class="col-lg-8 fu d5">
        <div class="chart-panel card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-bottom py-3 px-4 d-flex align-items-center justify-content-between">
                <span class="panel-heading">User Growth</span>
               <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill">
Last {{ request('period',7) }} days
</span>
            </div>
            <div class="card-body p-4">
                <canvas id="userGrowthChart" height="100"></canvas>
            </div>
        </div>
    </div>

    {{-- Role distribution doughnut --}}
    <div class="col-lg-4 fu d5">
        <div class="chart-panel card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-bottom py-3 px-4">
                <span class="panel-heading">User Roles</span>
            </div>
            <div class="card-body p-4 d-flex flex-column align-items-center justify-content-center">
                <canvas id="rolesChart" height="180"></canvas>
                <div class="d-flex gap-3 mt-3 flex-wrap justify-content-center">
                    <div class="d-flex align-items-center gap-1 small">
                        <span style="width:10px;height:10px;border-radius:3px;background:#667eea;display:inline-block;"></span>
                        Admin
                    </div>
                    <div class="d-flex align-items-center gap-1 small">
                        <span style="width:10px;height:10px;border-radius:3px;background:#43e97b;display:inline-block;"></span>
                        User
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- ── Charts Row 2 ── --}}
<div class="row g-4 mb-4">

    {{-- Posts activity bar chart --}}
    <div class="col-lg-6 fu d6">
        <div class="chart-panel card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-bottom py-3 px-4 d-flex justify-content-between align-items-center">
                <span class="panel-heading">Posts Activity</span>
                <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill" style="font-size:.7rem;">Per Day</span>
            </div>
            <div class="card-body p-4">
                <canvas id="postsChart" height="140"></canvas>
            </div>
        </div>
    </div>

    {{-- Engagement line chart --}}
    <div class="col-lg-6 fu d6">
        <div class="chart-panel card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-bottom py-3 px-4 d-flex justify-content-between align-items-center">
                <span class="panel-heading">Engagement</span>
                <span class="badge bg-success bg-opacity-10 text-success rounded-pill" style="font-size:.7rem;">Likes & Comments</span>
            </div>
            <div class="card-body p-4">
                <canvas id="engagementChart" height="140"></canvas>
            </div>
        </div>
    </div>

</div>

{{-- ── Bottom Row ── --}}
<div class="row g-4">

    {{-- Top active users --}}
    <div class="col-lg-4 fu d7">
        <div class="chart-panel card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-bottom py-3 px-4 d-flex justify-content-between align-items-center">
                <span class="panel-heading">Top Active Users</span>
                <span class="text-muted small">by posts</span>
            </div>
            <div class="card-body p-3">
                @php
                $topUsers = isset($topUsers) ? $topUsers : \App\Models\User::withCount('posts')->orderByDesc('posts_count')->take(6)->get();
                @endphp
                @php $maxPosts = $topUsers->max('posts_count') ?: 1; @endphp
                @foreach($topUsers as $i => $user)
                @php $barWidth = min(100, ($user->posts_count / $maxPosts) * 100); @endphp
                <div class="top-user-row d-flex align-items-center gap-2">
                    <span class="text-muted fw-bold" style="width:18px;font-size:.75rem;">{{ $i+1 }}</span>
                    {{-- Profile Photo --}}
                    @if($user && $user->profile_photo)
                    <img src="{{ asset('storage/' . $user->profile_photo) }}"
                        class="rounded-circle"
                        width="48" height="48"
                        style="object-fit:cover;">
                    @else
                    <div class="post-avatar">
                        {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                    </div>
                    @endif
                    <div class="flex-grow-1 overflow-hidden">
                        <div class="fw-semibold small text-truncate">{{ $user->name }}</div>
                        <div class="skill-track mt-1">
                            <div class="prog-bar" style="width: '{{ $barWidth }}%';"></div>
                        </div>
                    </div>
                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill"
                        style="font-size:.65rem; flex-shrink:0;">
                        {{ $user->posts_count }} posts
                    </span>
                </div>

                @endforeach
            </div>
        </div>
    </div>

    {{-- Skill popularity --}}
    <div class="col-lg-4 fu d7">
        <div class="chart-panel card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-bottom py-3 px-4">
                <span class="panel-heading">Skill Popularity</span>
            </div>
            <div class="card-body p-4">
                <canvas id="skillsChart" height="220"></canvas>
            </div>
        </div>
    </div>

    {{-- Recent signups ── --}}
    <div class="col-lg-4 fu d8">
        <div class="chart-panel card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-bottom py-3 px-4 d-flex justify-content-between align-items-center">
                <span class="panel-heading">Recent Signups</span>
                <a href="{{ route('admin.users.users') }}" class="small fw-semibold text-decoration-none" style="color:#667eea;">View all →</a>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush rounded-bottom-4">
                    @php
                    $recentUsers = isset($recentUsers) ? $recentUsers : \App\Models\User::latest()->take(6)->get();
                    @endphp
                    @foreach($recentUsers as $user)
                    <li class="list-group-item border-0 px-4 py-3 d-flex align-items-center gap-3">
                        {{-- Profile Photo --}}
                        @if($user && $user->profile_photo)
                        <img src="{{ asset('storage/' . $user->profile_photo) }}"
                            class="rounded-circle"
                            width="48" height="48"
                            style="object-fit:cover;">
                        @else
                        <div class="post-avatar">
                            {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                        </div>
                        @endif
                        <div class="flex-grow-1 overflow-hidden">
                            <div class="fw-semibold small text-truncate">{{ $user->name }}</div>
                            <div class="text-muted" style="font-size:.7rem;">{{ $user->created_at->diffForHumans() }}</div>
                        </div>
                        <span class="badge rounded-pill px-2 py-1
                            {{ $user->role === 'admin' ? 'bg-primary bg-opacity-10 text-primary' : 'bg-secondary bg-opacity-10 text-secondary' }}"
                            style="font-size:.63rem;">
                            {{ ucfirst($user->role) }}
                        </span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

{{-- ── All PHP data passed safely to JS via hidden element ── --}}
<script>
window.analyticsData = {
    userGrowthLabels: @json($labels),
    userGrowthData: @json($userGrowthData),
    postLabels: @json($labels),
    postData: @json($postActivityData),
    engLabels: @json($labels),
    likesData: @json($likesData),
    commentsData: @json($commentsData),

    skillLabels: @json($skillLabels),
    skillData: @json($skillData),

    rolesData: [{{ $adminCount }}, {{ $userCount }}, {{ $modCount }}]
};
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        // ── Read all data from the JSON block — zero Blade/JS conflict ──
        const d = window.analyticsData;

        Chart.defaults.font.family = "'Segoe UI', system-ui, sans-serif";
        Chart.defaults.color = '#9ca3af';

        const GS = '#667eea'; // grad start

        // gradient helper
        function grad(ctx, hex) {
            const g = ctx.createLinearGradient(0, 0, 0, 280);
            g.addColorStop(0, hex + '44');
            g.addColorStop(1, hex + '05');
            return g;
        }

        // ── 1. User Growth ──
        const ugCtx = document.getElementById('userGrowthChart').getContext('2d');
        new Chart(ugCtx, {
            type: 'line',
            data: {
                labels: d.userGrowthLabels,
                datasets: [{
                    label: 'New Users',
                    data: d.userGrowthData,
                    borderColor: GS,
                    backgroundColor: grad(ugCtx, GS),
                    borderWidth: 2.5,
                    pointBackgroundColor: GS,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f0f0f0'
                        }
                    }
                }
            }
        });

        // ── 2. Roles Doughnut ──
        new Chart(document.getElementById('rolesChart'), {
            type: 'doughnut',
            data: {
                labels: ['Admin', 'User', 'Moderator'],
                datasets: [{
                    data: d.rolesData,
                    backgroundColor: ['#667eea', '#43e97b', '#f093fb'],
                    borderWidth: 0,
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                cutout: '70%',
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // ── 3. Posts Bar ──
        new Chart(document.getElementById('postsChart'), {
            type: 'bar',
            data: {
                labels: d.postLabels,
                datasets: [{
                    label: 'Posts',
                    data: d.postData,
                    backgroundColor: '#f093fb44',
                    borderColor: '#f093fb',
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f0f0f0'
                        }
                    }
                }
            }
        });

        // ── 4. Engagement ──
        new Chart(document.getElementById('engagementChart'), {
            type: 'line',
            data: {
                labels: d.engLabels,
                datasets: [{
                        label: 'Likes',
                        data: d.likesData,
                        borderColor: '#43e97b',
                        backgroundColor: 'rgba(67,233,123,.08)',
                        borderWidth: 2.5,
                        pointRadius: 3,
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Comments',
                        data: d.commentsData,
                        borderColor: '#4facfe',
                        backgroundColor: 'rgba(79,172,254,.08)',
                        borderWidth: 2.5,
                        pointRadius: 3,
                        fill: true,
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            pointStyleWidth: 8,
                            boxHeight: 8
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f0f0f0'
                        }
                    }
                }
            }
        });

        // ── 5. Skills Horizontal Bar ──
        new Chart(document.getElementById('skillsChart'), {
            type: 'bar',
            data: {
                labels: d.skillLabels,
                datasets: [{
                    label: 'Learners',
                    data: d.skillData,
                    backgroundColor: ['#667eea', '#764ba2', '#f093fb', '#43e97b', '#4facfe', '#f7971e'],
                    borderRadius: 6,
                    borderSkipped: false
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: {
                            color: '#f0f0f0'
                        }
                    },
                    y: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

    });

    // ── Period switcher ──
    function switchPeriod(btn, days) {

        document.querySelectorAll('.period-tab')
            .forEach(b => b.classList.remove('active'));

        btn.classList.add('active');

        // reload page with period parameter
        const url = new URL(window.location.href);
        url.searchParams.set('period', days);

        window.location.href = url.toString();
    }
</script>
@endpush