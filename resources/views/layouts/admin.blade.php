<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,
<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'>
  <defs>
    <linearGradient id='g' x1='0' y1='0' x2='1' y2='1'>
      <stop offset='0%25' stop-color='%233b82f6'/>
      <stop offset='100%25' stop-color='%230d6efd'/>
    </linearGradient>
  </defs>
  <rect width='32' height='32' rx='8' fill='url(%23g)'/>
  <polygon points='16,6 28,12 16,18 4,12' fill='white'/>
  <line x1='16' y1='18' x2='16' y2='27' stroke='white' stroke-width='2' stroke-linecap='round'/>
  <rect x='10' y='26' width='12' height='3.5' rx='1.75' fill='white'/>
  <line x1='28' y1='12' x2='28' y2='22' stroke='rgba(255,255,255,0.7)' stroke-width='1.5' stroke-linecap='round'/>
  <circle cx='28' cy='24' r='2' fill='rgba(255,255,255,0.7)'/>
</svg>">
    <title>@yield('title', 'Admin') — SmartAdmin</title>

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        /* ── Brand gradient vars (matches your frontend) ── */
        :root {
            --grad-start: #667eea;
            --grad-end: #764ba2;
            --gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --sidebar-w: 260px;
        }

        /* ── Reset body ── */
        body {
            background-color: #f8f9fb;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        /* ── Sidebar ── */
        #adminSidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 1040;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            transition: transform .3s ease;
            background: #fff;
            border-right: 1px solid #e9ecef;
            box-shadow: 2px 0 15px rgba(0, 0, 0, .05);
        }

        /* ── Active nav pill — gradient (same as your .btn-gradient) ── */
        #adminSidebar .sb-link.sb-active {
            background: var(--gradient) !important;
            color: #fff !important;
            box-shadow: 0 4px 15px rgba(102, 126, 234, .3);
        }

        #adminSidebar .sb-link:not(.sb-active):hover {
            background: rgba(102, 126, 234, .09) !important;
            color: var(--grad-start) !important;
        }

        .sb-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: .55rem .85rem;
            border-radius: 10px;
            font-size: .875rem;
            font-weight: 500;
            color: #6c757d;
            text-decoration: none;
            transition: all .18s;
        }

        /* ── Logo gradient text ── */
        .sb-brand {
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 800;
            font-size: 1.2rem;
        }

        .sb-logo-icon {
            width: 36px;
            height: 36px;
            background: var(--gradient);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(102, 126, 234, .4);
            font-size: 1rem;
            flex-shrink: 0;
        }

        .sb-section-label {
            font-size: .67rem;
            letter-spacing: 1.1px;
            text-transform: uppercase;
            font-weight: 700;
            color: #adb5bd;
            padding: .2rem .85rem;
        }

        .sb-badge {
            margin-left: auto;
            font-size: .63rem;
            padding: .18rem .5rem;
            border-radius: 20px;
            font-weight: 600;
        }

        .sb-avatar {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: var(--gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: .8rem;
            flex-shrink: 0;
        }

        /* ── Main area ── */
        .admin-main {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── Topbar ── */
        .admin-topbar {
            position: sticky;
            top: 0;
            z-index: 900;
            background: #fff;
            border-bottom: 1px solid #e9ecef;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .05);
        }

        .admin-topbar-accent {
            height: 3px;
            background: var(--gradient);
        }

        .tb-btn {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .95rem;
            transition: all .18s;
            text-decoration: none;
            color: #6c757d;
        }

        .tb-btn:hover {
            background: rgba(102, 126, 234, .09);
            color: var(--grad-start);
        }

        /* ── Theme toggle ── */
        [data-bs-theme="dark"] #adminSidebar {
            background: #1a1d27 !important;
            border-right-color: #2a2d3e !important;
        }

        [data-bs-theme="dark"] .admin-topbar {
            background: #1a1d27 !important;
            border-bottom-color: #2a2d3e !important;
        }

        [data-bs-theme="dark"] body {
            background-color: #12141e !important;
        }

        /* ── Mobile ── */
        #sbMobileToggle {
            display: none;
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 1050;
        }

        /* MOBILE SIDEBAR FIX */
        @media (max-width: 991px) {

            #adminSidebar {
                position: fixed;
                top: 0;
                left: -260px;
                width: 260px;
                height: 100vh;
                background: #fff;
                transition: 0.3s ease;
                z-index: 1050;
                transform: translateX(-100%);
            }

            #adminSidebar.show {
                left: 0;
                transform: translateX(0);
                box-shadow: 0 0 40px rgba(0, 0, 0, .2);
            }

            #sbMobileToggle {
                display: flex;
            }

            .admin-main {
                margin-left: 0 !important;
            }
        }

        @media (max-width: 991.98px) {

            .admin-topbar .px-4 {
                justify-content: space-between !important;
            }

            .admin-topbar .px-4>div:first-child {
                margin-left: auto;
                /* Push title/date to right */
                text-align: right;
            }
        }

        #adminSidebar::-webkit-scrollbar {
            width: 3px;
        }

        #adminSidebar::-webkit-scrollbar-thumb {
            background: rgba(102, 126, 234, .2);
            border-radius: 4px;
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- ══════════════════════════════════════
     MOBILE TOGGLE
══════════════════════════════════════ --}}
    <button id="sbMobileToggle"
        class="btn btn-white border shadow-sm rounded-3 px-2 py-1 
               d-lg-none"
        onclick="document.getElementById('adminSidebar').classList.toggle('show')">
        <i class="bi bi-list fs-5"></i>
    </button>

    {{-- ══════════════════════════════════════
     SIDEBAR
══════════════════════════════════════ --}}
    <nav id="adminSidebar" class="p-3">

        {{-- Logo --}}
        <div class="d-flex align-items-center gap-2 pb-3 mb-1 border-bottom">
            <div class="sb-logo-icon">
                <i class="bi bi-person" style="color: white;"></i>
            </div>
            <span class="sb-brand">SmartAdmin</span>
        </div>

        {{-- Overview --}}
        <div class="mt-3 mb-1"><span class="sb-section-label">Overview</span></div>
        <div class="d-flex flex-column gap-1">
            <a href="{{ route('admin.dashboard') }}"
                class="sb-link {{ request()->routeIs('admin.dashboard') ? 'sb-active' : '' }}">
                <i class="bi bi-grid-1x2-fill fs-6"></i> Dashboard
            </a>
            <a href="{{ route('admin.analytics') }}"
                class="sb-link {{ request()->routeIs('admin.analytics*') ? 'sb-active' : '' }}">
                <i class="bi bi-graph-up-arrow fs-6"></i> Analytics
            </a>
        </div>

        {{-- Management --}}
        <div class="mt-3 mb-1"><span class="sb-section-label">Management</span></div>
        <div class="d-flex flex-column gap-1">
            <a href="{{ route('admin.users.users') }}"
                class="sb-link {{ request()->routeIs('admin.users*') ? 'sb-active' : '' }}">
                <i class="bi bi-people-fill fs-6"></i>
                <span class="flex-grow-1">Users</span>
                @if(isset($totalUsers))
                <span class="sb-badge bg-primary bg-opacity-10 text-primary">{{ $totalUsers }}</span>
                @endif
            </a>
            <a href="{{ route('admin.posts') }}"
                class="sb-link {{ request()->routeIs('admin.posts*') ? 'sb-active' : '' }}">
                <i class="bi bi-file-earmark-text-fill fs-6"></i>
                <span class="flex-grow-1">Posts</span>
                @if(isset($totalPosts))
                <span class="sb-badge bg-danger bg-opacity-10 text-danger">{{ $totalPosts }}</span>
                @endif
            </a>
            <a href="{{ route('skills.index') }}"
                class="sb-link {{ request()->routeIs('skills*') ? 'sb-active' : '' }}">
                <i class="bi bi-book"></i>
                <span>Skills</span>
                @if(isset($totalSkills))
                <span class="sb-badge bg-warning bg-opacity-10 text-warning">
                    {{ $totalSkills }}
                </span>
                @endif
            </a>
            <a href="{{ route('admin.comments') }}"
                class="sb-link {{ request()->routeIs('admin.comments*') ? 'sb-active' : '' }}">
                <i class="bi bi-chat-dots-fill fs-6"></i>
                <span class="flex-grow-1">Comments</span>
                @if(isset($totalComments))
                <span class="sb-badge bg-warning bg-opacity-10 text-warning">{{ $totalComments   }}</span>
                @endif
            </a>
            <a href="{{ route('admin.likes') }}"
                class="sb-link {{ request()->routeIs('admin.likes*') ? 'sb-active' : '' }}">

                <i class="bi bi-heart-fill fs-6"></i>
                <span class="flex-grow-1">Likes</span>

                @if(isset($totalLikes))
                <span class="sb-badge bg-danger bg-opacity-10 text-danger">
                    {{ $totalLikes }}
                </span>
                @endif
            </a>
        </div>

        {{-- Spacer --}}
        <div class="flex-grow-1 mt-3"></div>

        {{-- Footer --}}
        <div class="border-top pt-3 mt-2">

            {{-- Theme toggle --}}
            <div class="d-flex align-items-center justify-content-between mb-3 px-1">
                <span class="small text-muted fw-semibold">
                    <i class="bi bi-circle-half me-1"></i> Appearance
                </span>
                <button class="btn btn-sm btn-light border rounded-3 px-2 py-1 d-flex align-items-center gap-1"
                    id="themeToggle" onclick="toggleAdminTheme()">
                    <i class="bi bi-moon-stars" id="themeIcon"></i>
                    <span id="themeLabel" class="small" style="font-size:.75rem;">Dark</span>
                </button>
            </div>

            {{-- User card --}}
            <div class="d-flex align-items-center gap-2 rounded-3 p-2"
                style="background:rgba(102,126,234,.07); border:1px solid rgba(102,126,234,.15);">
                <!-- User Profile Image -->
                {{-- Profile Image --}}
                @if(auth()->user()->profile_photo)
                <img src="{{ asset('storage/'.auth()->user()->profile_photo) }}"
                    width="35" height="35"
                    class="rounded-circle"
                    style="object-fit:cover;">
                @else
                <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center"
                    style="width:35px;height:35px;font-size:13px;">
                    {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                </div>
                @endif
                <div class="overflow-hidden flex-grow-1">
                    <div class="fw-semibold text-truncate" style="font-size:.82rem;">
                        {{ auth()->user()->name ?? 'Admin User' }}
                    </div>
                    <div class="text-muted" style="font-size:.68rem;">Super Administrator</div>
                </div>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('sbLogoutForm').submit();"
                    class="btn btn-sm btn-outline-danger rounded-2 px-2 py-1" title="Logout">
                    <i class="bi bi-box-arrow-right small"></i>
                </a>
            </div>
            <form id="sbLogoutForm" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </div>
    </nav>

    {{-- ══════════════════════════════════════
     MAIN AREA
══════════════════════════════════════ --}}
    <div class="admin-main">

        {{-- Topbar --}}
        <div class="admin-topbar">
            <div class="admin-topbar-accent"></div>
            <div class="px-4 py-2 d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="fw-bold mb-0" style="font-size:1.1rem;">@yield('page-title', 'Dashboard')</h5>
                    <small class="text-muted" style="font-size:.75rem;">{{ now()->format('l, F j, Y') }}</small>
                </div>
                <div class="d-flex align-items-center gap-2">
                    {{-- Notification bell --}}
                    <a href="{{ route('admin.notifications') }}" class="tb-btn border rounded-3 position-relative">
                        <i class="bi bi-bell-fill"></i>
                    </a>
                    <div class="vr opacity-25 mx-1"></div>
                    {{-- Back to site --}}
                    <a href="{{ route('home') ?? '/' }}" class="btn btn-sm btn-light border rounded-3 px-2 py-1 d-flex align-items-center gap-1 text-muted"
                        style="font-size:.75rem;" title="Back to site">
                        <i class="bi bi-box-arrow-up-left small"></i>
                        <span class="d-none d-md-inline">Site</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Page content --}}
        <div class="flex-grow-1 p-4">
            @yield('content')
        </div>

    </div>{{-- /admin-main --}}

    {{-- Bootstrap 5 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Theme script (runs before paint to avoid flash) --}}
    <script>
        (function() {
            var t = localStorage.getItem('adminTheme') || 'light';
            _applyAdminTheme(t);
        })();

        function _applyAdminTheme(theme) {
            var body = document.body;
            var icon = document.getElementById('themeIcon');
            var label = document.getElementById('themeLabel');

            if (theme === 'dark') {
                body.setAttribute('data-bs-theme', 'dark');
                if (icon) icon.className = 'bi bi-sun-fill text-warning';
                if (label) label.textContent = 'Light';
            } else {
                body.removeAttribute('data-bs-theme');
                if (icon) icon.className = 'bi bi-moon-stars';
                if (label) label.textContent = 'Dark';
            }
        }

        function toggleAdminTheme() {
            var current = localStorage.getItem('adminTheme') || 'light';
            var next = current === 'light' ? 'dark' : 'light';
            localStorage.setItem('adminTheme', next);
            _applyAdminTheme(next);
        }
    </script>

    @stack('scripts')
</body>

</html>