{{--
╔══════════════════════════════════════════════════════╗
║  Admin Sidebar Partial — Bootstrap 5                 ║
║  Place at: resources/views/partials/admin-sidebar    ║
║  Usage:    @include('partials.admin-sidebar')         ║
╚══════════════════════════════════════════════════════╝
--}}

<style>
    /* ── Brand vars (exact match to your frontend) ── */
    :root {
        --grad-start: #667eea;
        --grad-end:   #764ba2;
        --gradient:   linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    /* ── Sidebar shell ── */
    #adminSidebar {
        width: 260px;
        min-height: 100vh;
        position: fixed;
        top: 0; left: 0; bottom: 0;
        z-index: 1040;
        display: flex;
        flex-direction: column;
        transition: transform .3s ease;
        overflow-y: auto;
    }

    /* ── Active link: gradient pill (same style as your .btn-gradient) ── */
    #adminSidebar .nav-link.sb-active {
        background: var(--gradient) !important;
        color: #fff !important;
        box-shadow: 0 4px 15px rgba(102,126,234,.35);
    }

    #adminSidebar .nav-link:not(.sb-active):hover {
        background: rgba(102,126,234,.09) !important;
        color: var(--grad-start) !important;
    }

    /* ── Gradient text for logo ── */
    .sb-brand {
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800;
        font-size: 1.25rem;
    }

    /* ── Logo icon pill ── */
    .sb-logo-icon {
        width: 38px; height: 38px;
        background: var(--gradient);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 4px 14px rgba(102,126,234,.4);
        font-size: 1.05rem;
        flex-shrink: 0;
    }

    /* ── Section label ── */
    .sb-label {
        font-size: .67rem;
        letter-spacing: 1.2px;
        text-transform: uppercase;
        font-weight: 600;
    }

    /* ── Avatar ── */
    .sb-avatar {
        width: 34px; height: 34px;
        border-radius: 9px;
        background: var(--gradient);
        display: flex; align-items: center; justify-content: center;
        color: #fff;
        font-weight: 700;
        font-size: .85rem;
        flex-shrink: 0;
    }

    /* ── Mobile toggle ── */
    #sbToggle {
        display: none;
        position: fixed;
        top: 12px; left: 12px;
        z-index: 1050;
        width: 40px; height: 40px;
        border-radius: 10px;
        align-items: center; justify-content: center;
    }

    @media (max-width: 991.98px) {
        #adminSidebar      { transform: translateX(-100%); }
        #adminSidebar.show { transform: translateX(0); box-shadow: 0 0 40px rgba(0,0,0,.15); }
        #sbToggle          { display: flex; }
        .admin-main        { margin-left: 0 !important; }
    }

    #adminSidebar::-webkit-scrollbar { width: 3px; }
    #adminSidebar::-webkit-scrollbar-thumb { background: rgba(102,126,234,.25); border-radius: 4px; }
</style>

{{-- Mobile toggle --}}
<button id="sbToggle" class="btn btn-light border shadow-sm"
        onclick="document.getElementById('adminSidebar').classList.toggle('show')">
    <i class="bi bi-list fs-5"></i>
</button>

{{-- ════════════════ SIDEBAR ════════════════ --}}
<nav id="adminSidebar" class="p-3">

    {{-- Logo --}}
    <div class="d-flex align-items-center gap-2 pb-3 mb-1 border-bottom">
        <div class="sb-logo-icon">🚀</div>
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
        <a href="{{ route('admin.users') }}"
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
        <a href="/admin/skills"
           class="sb-link {{ request()->is('admin/skills*') ? 'sb-active' : '' }}">
            <i class="bi bi-book-fill fs-6"></i>
            <span class="flex-grow-1">Skills</span>
        </a>
        <a href="/admin/comments"
           class="sb-link {{ request()->is('admin/comments*') ? 'sb-active' : '' }}">
            <i class="bi bi-chat-dots-fill fs-6"></i>
            <span class="flex-grow-1">Comments</span>
            <span class="sb-badge bg-warning bg-opacity-10 text-warning">4</span>
        </a>
    </div>

    {{-- System --}}
    <div class="mt-3 mb-1"><span class="sb-section-label">System</span></div>
    <div class="d-flex flex-column gap-1">
        <a href="/admin/settings"
           class="sb-link {{ request()->is('admin/settings*') ? 'sb-active' : '' }}">
            <i class="bi bi-gear-fill fs-6"></i> Settings
        </a>
        <a href="/admin/logs"
           class="sb-link {{ request()->is('admin/logs*') ? 'sb-active' : '' }}">
            <i class="bi bi-journal-text fs-6"></i> System Logs
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
            <div class="sb-avatar">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </div>
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

{{-- ════════════════ THEME SCRIPT ════════════════ --}}
<script>
(function () {
    // Auto-apply saved theme immediately on include
    var t = localStorage.getItem('adminTheme') || 'light';
    _applyAdminTheme(t, false);
})();

function _applyAdminTheme(theme, animate) {
    var body     = document.body;
    var sidebar  = document.getElementById('adminSidebar');
    var icon     = document.getElementById('themeIcon');
    var label    = document.getElementById('themeLabel');

    if (theme === 'dark') {
        body.setAttribute('data-bs-theme', 'dark');
        if (sidebar) {
            sidebar.classList.remove('bg-white', 'border-end', 'shadow-sm');
            sidebar.classList.add('bg-dark', 'border-secondary');
        }
        if (icon)  icon.className = 'bi bi-sun-fill text-warning';
        if (label) label.textContent = 'Light';
    } else {
        body.removeAttribute('data-bs-theme');
        if (sidebar) {
            sidebar.classList.remove('bg-dark', 'border-secondary');
            sidebar.classList.add('bg-white', 'border-end', 'shadow-sm');
        }
        if (icon)  icon.className = 'bi bi-moon-stars';
        if (label) label.textContent = 'Dark';
    }
}

function toggleAdminTheme() {
    var current = localStorage.getItem('adminTheme') || 'light';
    var next    = current === 'light' ? 'dark' : 'light';
    localStorage.setItem('adminTheme', next);
    _applyAdminTheme(next, true);
}
</script>