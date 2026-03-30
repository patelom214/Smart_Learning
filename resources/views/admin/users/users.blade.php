@extends('layouts.admin')

@section('title', 'Manage Users')
@section('page-title', 'Users')

@push('styles')
<style>
    :root {
        --gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    /* ── Table row hover ── */
    .users-table tbody tr {
        transition: background .15s;
    }

    .users-table tbody tr:hover {
        background: rgba(102, 126, 234, .04);
    }

    /* ── Avatar circle ── */
    .user-avatar {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: var(--gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 700;
        font-size: .82rem;
        flex-shrink: 0;
    }

    /* ── Role badge ── */
    .role-admin {
        background: rgba(102, 126, 234, .12);
        color: #667eea;
    }

    .role-user {
        background: rgba(108, 117, 125, .10);
        color: #6c757d;
    }

    .role-mod {
        background: rgba(255, 193, 7, .12);
        color: #d39e00;
    }

    /* ── Search input focus ── */
    #userSearch:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 .2rem rgba(102, 126, 234, .2);
    }

    /* ── Fade-up ── */
    .fu {
        animation: fadeUp .4s ease both;
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(12px);
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
        animation-delay: .10s
    }

    .d3 {
        animation-delay: .15s
    }
.user-row {
    word-break: break-word;
}
.user-row .text-muted.small {
    word-break: break-all;   /* FIX email breaking */
    font-size: 13px;
}
@media (max-width: 768px) {
    .user-row .card-body {
        flex-direction: column !important;
        align-items: flex-start !important;
    }
}
    /* ── Confirm delete modal backdrop ── */
    .delete-row {
        cursor: pointer;
    }
    @media (max-width: 576px) {
    .user-row .btn {
        padding: 4px 8px;
        font-size: 12px;
    }

    .user-row .btn span {
        display: none; /* hide "Delete" text, keep icon */
    }

    .user-row .btn i {
        margin: 0 !important;
    }
}
</style>
@endpush

@section('content')

{{-- ── Top bar: heading + action ── --}}
<div class="d-flex align-items-center justify-content-between mb-4 fu d1">
    <div>
        <h5 class="fw-bold mb-0">All Users</h5>
        <small class="text-muted">Manage, search and remove platform users</small>
    </div>
    <a href="/admin/users/create" class="btn btn-sm text-white rounded-pill px-4 py-2 fw-semibold d-flex align-items-center gap-2"
        style="background:var(--gradient); box-shadow:0 4px 15px rgba(102,126,234,.35);">
        <i class="bi bi-person-plus-fill"></i> Add User
    </a>
</div>

{{-- ── Summary cards ── --}}
<div class="row g-3 mb-4 fu d2">
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm rounded-4 p-3 text-center">
            <div class="fw-bold fs-4" style="background:var(--gradient);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                {{ $users->count() }}
            </div>
            <div class="text-muted small">Total Users</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm rounded-4 p-3 text-center">
            <div class="fw-bold fs-4 text-primary">
                {{ $users->where('role','admin')->count() }}
            </div>
            <div class="text-muted small">Admins</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm rounded-4 p-3 text-center">
            <div class="fw-bold fs-4 text-success">
                {{ $users->where('role','user')->count() }}
            </div>
            <div class="text-muted small">Regular Users</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm rounded-4 p-3 text-center">
            <div class="fw-bold fs-4 text-warning">
                {{ $users->where('role','moderator')->count() }}
            </div>
            <div class="text-muted small">Moderators</div>
        </div>
    </div>
</div>

{{-- ── Main card ── --}}
<div class="card border-0 shadow-sm rounded-4 fu d3">

    {{-- Card header: search + filter ── --}}
    <div class="card-header bg-transparent border-bottom py-3 px-4">
        <div class="row g-2 align-items-center">
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-light border-end-0 text-muted">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" id="userSearch"
                        class="form-control border-start-0 bg-light"
                        placeholder="Search by name or email…"
                        oninput="filterUsers()">
                </div>
            </div>
            <div class="col-md-3">
                <select class="form-select form-select-sm bg-light" id="roleFilter" onchange="filterUsers()">
                    <option value="">All Roles</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            <div class="col-md-3 text-md-end">
                <span class="text-muted small" id="userCount">
                    {{ $users->count() }} users
                </span>
            </div>
        </div>
    </div>

    {{-- Table ── --}}
    <div class="card-body p-4">

        <div id="usersContainer" class="d-flex flex-column gap-3">

            @foreach($users as $i => $user)
            <div class="card border-0 shadow-sm rounded-4 user-row"
                data-name="{{ strtolower($user->name) }}"
                data-email="{{ strtolower($user->email) }}"
                data-role="{{ strtolower($user->role) }}">

                <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">

                    {{-- Left: Avatar + Info --}}
                    <div class="d-flex align-items-start gap-3 w-100">

                       <div class="flex-shrink-0">
    @if($user->profile_photo)
        <img src="{{ asset($user->profile_photo) }}"
            class="rounded-circle"
            style="width:40px;height:40px;object-fit:cover;">
    @else
        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center"
            style="width:40px;height:40px;font-size:14px;">
            {{ strtoupper(substr($user->name,0,1)) }}
        </div>
    @endif
</div>

                        <div>
                            <div class="fw-semibold small">
                                {{ $user->name }}
                                @if($user->id === auth()->id())
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill ms-2" style="font-size:.6rem;">
                                    You
                                </span>
                                @endif
                            </div>

                            <div class="text-muted small">
                                {{ $user->email }}
                            </div>

                            <div class="mt-1">
                                <span class="badge rounded-pill px-3 py-1 fw-semibold
                                {{ $user->role === 'admin' ? 'role-admin' :
                                   ($user->role === 'moderator' ? 'role-mod' : 'role-user') }}"
                                    style="font-size:.7rem;">
                                    {{ ucfirst($user->role) }}
                                </span>

                                <span class="text-muted small ms-2">
                                    Joined {{ $user->created_at->format('M d, Y') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Right: Actions --}}
                    <div class="d-flex flex-wrap align-items-center gap-2 w-100 w-md-auto justify-content-start justify-content-md-end">
                        {{-- Edit --}}
                        <a href="{{ route('admin.users.edit',$user->id) }}"
                            class="btn btn-sm btn-light border rounded-3 d-flex align-items-center justify-content-center"
                            style="width:34px;height:34px;">
                            <i class="bi bi-pencil-square text-primary"></i>
                        </a>
                        {{-- Block/Unblock --}}
                        @if($user->status === 'active')

                        <form method="POST" action="{{ route('admin.users.block', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-sm btn-outline-warning rounded-pill px-3 fw-semibold d-flex align-items-center gap-1">
                                <i class="bi bi-slash-circle"></i> Block
                            </button>
                        </form>

                        @else

                        <form method="POST" action="{{ route('admin.users.unblock', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-sm btn-outline-success rounded-pill px-3 fw-semibold d-flex align-items-center gap-1">
                                <i class="bi bi-check-circle"></i> Unblock
                            </button>
                        </form>

                        @endif
                        {{-- Delete --}}
                        @if($user->id !== auth()->id())
                        <button type="button"
                            class="btn btn-sm btn-light border rounded-3 px-3 py-1 d-flex align-items-center gap-1 btn-delete"
                            data-id="{{ $user->id }}"
                            data-name="{{ $user->name }}">
                            <i class="bi bi-trash small text-danger"></i>
                            <span class="small fw-medium">Delete</span>
                        </button>
                        @else
                        <button class="btn btn-sm btn-light border rounded-3 px-3 py-1 d-flex align-items-center gap-1" disabled>
                            <i class="bi bi-trash small text-muted opacity-25"></i>
                        </button>
                        @endif

                    </div>

                </div>
            </div>
            @endforeach

        </div>

        {{-- Empty state --}}
        <div id="emptyState" class="text-center py-5 d-none">
            <div style="font-size:2.5rem;">🔍</div>
            <p class="text-muted mt-2 mb-0">No users match your search.</p>
        </div>

    </div>

    {{-- Pagination --}}
    @if($users instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="card-footer bg-transparent border-top py-3 px-4 d-flex justify-content-between align-items-center">
        <small class="text-muted">
            Showing {{ $users->firstItem() }}–{{ $users->lastItem() }} of {{ $users->total() }} users
        </small>
        {{ $users->links('pagination::bootstrap-5') }}
    </div>
    @endif

</div>

{{-- ════════ DELETE CONFIRM MODAL ════════ --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow rounded-4">
            <div class="modal-body text-center p-4">
                <div style="font-size:2.5rem;">⚠️</div>
                <h6 class="fw-bold mt-2 mb-1">Delete User?</h6>
                <p class="text-muted small mb-3" id="deleteModalName">
                    This action cannot be undone.
                </p>
                <div class="d-flex gap-2 justify-content-center">
                    <button class="btn btn-sm btn-light border rounded-3 px-3"
                        data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger rounded-3 px-3">
                            <i class="bi bi-trash me-1"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    /* ── Delete buttons — read from data attributes ── */
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.btn-delete');
        if (!btn) return;
        const id = btn.getAttribute('data-id');
        const name = btn.getAttribute('data-name');
        document.getElementById('deleteModalName').textContent =
            'Are you sure you want to delete "' + name + '"? This cannot be undone.';
        document.getElementById('deleteForm').action = '/admin/users/' + id;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    });

    /* ── Live search + role filter ── */
    function filterUsers() {
        const search = document.getElementById('userSearch').value.toLowerCase();
        const role = document.getElementById('roleFilter').value.toLowerCase();
        const rows = document.querySelectorAll('.user-row');
        let visible = 0;

        rows.forEach(row => {
            const nameMatch = row.dataset.name.includes(search) || row.dataset.email.includes(search);
            const roleMatch = role === '' || row.dataset.role === role;
            const show = nameMatch && roleMatch;
            row.style.display = show ? '' : 'none';
            if (show) visible++;
        });

        document.getElementById('userCount').textContent = visible + ' users';
        document.getElementById('emptyState').classList.toggle('d-none', visible > 0);
    }
</script>
@endpush