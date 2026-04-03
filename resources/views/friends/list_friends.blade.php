@extends('layouts.app')

@section('title', 'Friends')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --f-bg: #f0f4ff;
        --f-surface: #ffffff;
        --f-primary: #4f6ef7;
        --f-primary-d: #3a56d4;
        --f-primary-soft: rgba(79,110,247,.09);
        --f-success: #10b77f;
        --f-success-soft: rgba(16,183,127,.1);
        --f-danger: #ef4444;
        --f-danger-soft: rgba(239,68,68,.08);
        --f-warning: #f59e0b;
        --f-text: #0f172a;
        --f-text-sec: #64748b;
        --f-border: #e8edf5;
        --f-radius: 18px;
        --f-shadow: 0 2px 12px rgba(15,23,42,.07);
        --f-shadow-h: 0 8px 28px rgba(15,23,42,.12);
        --f-grad: linear-gradient(135deg, #4f6ef7 0%, #7c3aed 100%);
    }

    * { font-family: 'Plus Jakarta Sans', sans-serif; }

    /* ── PAGE BG ── */
    .friends-page {
        background: var(--f-bg);
        min-height: 100vh;
        padding: 2rem 0 4rem;
    }

    /* ── ALERT ── */
    .f-alert {
        border: none;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 500;
        padding: .75rem 1.1rem;
        margin-bottom: 1.25rem;
    }

    /* ── SECTION HEADERS ── */
    .f-section-head {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 1.25rem;
    }
    .f-section-head .f-icon {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }
    .f-section-head .f-icon.blue  { background: var(--f-primary-soft); color: var(--f-primary); }
    .f-section-head .f-icon.green { background: var(--f-success-soft); color: var(--f-success); }
    .f-section-head .f-icon.gray  { background: #f1f5f9; color: var(--f-text-sec); }
    .f-section-head h4 {
        font-size: 17px;
        font-weight: 800;
        margin: 0;
        color: var(--f-text);
        letter-spacing: -.3px;
    }
    .f-count-badge {
        font-size: 11.5px;
        font-weight: 700;
        padding: 2px 9px;
        border-radius: 20px;
        line-height: 1.6;
    }
    .f-count-badge.blue  { background: var(--f-primary-soft); color: var(--f-primary); }
    .f-count-badge.green { background: var(--f-success-soft); color: var(--f-success); }

    /* ── CARDS ── */
    .f-card {
        background: var(--f-surface);
        border: 1.5px solid var(--f-border);
        border-radius: var(--f-radius);
        box-shadow: var(--f-shadow);
        transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease;
        overflow: hidden;
        height: 100%;
    }
    .f-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--f-shadow-h);
        border-color: rgba(79,110,247,.2);
    }
    .f-card-body {
        padding: 1.1rem 1.2rem;
    }

    /* ── AVATAR ── */
    .f-avatar {
        border-radius: 50%;
        object-fit: cover;
        flex-shrink: 0;
    }
    .f-avatar-placeholder {
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        color: #fff;
        flex-shrink: 0;
        background: var(--f-grad);
    }

    /* ── NAME / PROFESSION ── */
    .f-name {
        font-size: 14.5px;
        font-weight: 700;
        color: var(--f-text);
        margin: 0 0 2px;
        line-height: 1.3;
    }
    .f-prof {
        font-size: 12.5px;
        color: var(--f-text-sec);
        font-weight: 500;
    }
    .f-time {
        font-size: 11.5px;
        color: #94a3b8;
        font-weight: 500;
    }

    /* ── FOLLOWING BADGE ── */
    .f-following-tag {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 11.5px;
        font-weight: 700;
        color: var(--f-success);
        background: var(--f-success-soft);
        border: 1.5px solid rgba(16,183,127,.2);
        border-radius: 20px;
        padding: 3px 10px;
        margin-top: 10px;
    }

    /* ── BUTTONS ── */
    .f-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 700;
        padding: 7px 14px;
        cursor: pointer;
        border: none;
        transition: all .2s ease;
        white-space: nowrap;
    }
    .f-btn-primary {
        background: var(--f-primary);
        color: #fff;
    }
    .f-btn-primary:hover { background: var(--f-primary-d); transform: scale(1.03); }

    .f-btn-outline {
        background: transparent;
        color: var(--f-text-sec);
        border: 1.5px solid var(--f-border);
    }
    .f-btn-outline:hover { background: #f8faff; border-color: #cbd5e1; }

    .f-btn-danger-outline {
        background: transparent;
        color: var(--f-danger);
        border: 1.5px solid rgba(239,68,68,.25);
        border-radius: 10px;
        padding: 6px 10px;
        font-size: 14px;
        cursor: pointer;
        transition: all .2s;
    }
    .f-btn-danger-outline:hover { background: var(--f-danger-soft); border-color: var(--f-danger); }

    .f-btn-disabled {
        background: #f1f5f9;
        color: #94a3b8;
        border: 1.5px solid var(--f-border);
        border-radius: 10px;
        font-size: 13px;
        font-weight: 700;
        padding: 7px 14px;
        cursor: not-allowed;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    /* ── ACCEPT / DECLINE row ── */
    .f-req-actions {
        display: flex;
        gap: 8px;
        margin-top: 12px;
    }
    .f-req-actions .f-btn { flex: 1; justify-content: center; }
    .f-btn-accept {
        background: var(--f-primary);
        color: #fff;
    }
    .f-btn-accept:hover { background: var(--f-primary-d); }
    .f-btn-decline {
        background: #f8faff;
        color: var(--f-text-sec);
        border: 1.5px solid var(--f-border);
    }
    .f-btn-decline:hover { background: #f1f5f9; }

    /* ── SEARCH BOX ── */
    .f-search-wrap {
        position: relative;
        max-width: 420px;
        margin-bottom: 1.5rem;
    }
    .f-search-wrap .f-search-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 15px;
        pointer-events: none;
    }
    .f-search-input {
        width: 100%;
        padding: 11px 44px 11px 42px;
        border: 1.5px solid var(--f-border);
        border-radius: 14px;
        font-size: 14px;
        font-weight: 500;
        color: var(--f-text);
        background: var(--f-surface);
        box-shadow: var(--f-shadow);
        outline: none;
        transition: border-color .2s, box-shadow .2s;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .f-search-input::placeholder { color: #b0bac9; }
    .f-search-input:focus {
        border-color: var(--f-primary);
        box-shadow: 0 0 0 3px rgba(79,110,247,.12);
    }
    .f-search-spinner {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
    }

    /* ── DIVIDER ── */
    .f-section-divider {
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--f-border), transparent);
        margin: 2.5rem 0;
    }

    /* ── EMPTY STATE ── */
    .f-no-results {
        background: var(--f-surface);
        border: 1.5px solid var(--f-border);
        border-radius: var(--f-radius);
        padding: 1.1rem 1.4rem;
        font-size: 14px;
        font-weight: 500;
        color: var(--f-text-sec);
        display: none;
    }
    .f-no-results.show { display: block; }

    /* ── STAGGER ANIMATION ── */
    .f-card-wrap {
        animation: fCardIn .35s ease both;
    }
    @keyframes fCardIn {
        from { opacity: 0; transform: translateY(14px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .f-card-wrap:nth-child(1) { animation-delay: .04s; }
    .f-card-wrap:nth-child(2) { animation-delay: .09s; }
    .f-card-wrap:nth-child(3) { animation-delay: .14s; }
    .f-card-wrap:nth-child(4) { animation-delay: .19s; }
    .f-card-wrap:nth-child(5) { animation-delay: .24s; }
    .f-card-wrap:nth-child(6) { animation-delay: .29s; }

    /* ── CONFIRM MODAL OVERLAY ── */
    .f-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15,23,42,.45);
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        pointer-events: none;
        transition: opacity .22s ease;
    }
    .f-modal-overlay.show {
        opacity: 1;
        pointer-events: all;
    }
    .f-modal-box {
        background: #fff;
        border-radius: 22px;
        box-shadow: 0 24px 60px rgba(15,23,42,.18);
        padding: 2rem 2rem 1.6rem;
        max-width: 360px;
        width: 90%;
        transform: scale(.92) translateY(12px);
        transition: transform .25s cubic-bezier(.34,1.56,.64,1), opacity .22s ease;
        opacity: 0;
        text-align: center;
    }
    .f-modal-overlay.show .f-modal-box {
        transform: scale(1) translateY(0);
        opacity: 1;
    }
    .f-modal-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: rgba(239,68,68,.1);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 26px;
        color: var(--f-danger);
    }
    .f-modal-title {
        font-size: 17px;
        font-weight: 800;
        color: var(--f-text);
        margin-bottom: .4rem;
        letter-spacing: -.3px;
    }
    .f-modal-desc {
        font-size: 13.5px;
        color: var(--f-text-sec);
        line-height: 1.6;
        margin-bottom: 1.4rem;
    }
    .f-modal-friend-chip {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: #f8faff;
        border: 1.5px solid var(--f-border);
        border-radius: 30px;
        padding: 5px 14px 5px 7px;
        margin-bottom: 1.2rem;
    }
    .f-modal-friend-chip img,
    .f-modal-friend-chip .f-chip-av {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        object-fit: cover;
        flex-shrink: 0;
    }
    .f-modal-friend-chip .f-chip-av {
        background: var(--f-grad);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 800;
    }
    .f-modal-friend-chip span {
        font-size: 13.5px;
        font-weight: 700;
        color: var(--f-text);
    }
    .f-modal-actions {
        display: flex;
        gap: 9px;
    }
    .f-modal-actions button {
        flex: 1;
        padding: 10px 0;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        border: none;
        transition: all .2s;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .f-modal-btn-cancel {
        background: #f1f5f9;
        color: var(--f-text-sec);
    }
    .f-modal-btn-cancel:hover { background: #e2e8f0; }
    .f-modal-btn-remove {
        background: var(--f-danger);
        color: #fff;
    }
    .f-modal-btn-remove:hover { background: #dc2626; transform: scale(1.02); }
</style>

<div class="friends-page">
<div class="container">

    {{-- ── ALERTS ── --}}
    @if(session('success'))
    <div class="f-alert alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    @if(session('error'))
    <div class="f-alert alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- ══ PENDING FRIEND REQUESTS ══ --}}
    @if($pendingRequests->count() > 0)
    <div class="mb-5">
        <div class="f-section-head">
            <div class="f-icon blue"><i class="bi bi-bell-fill"></i></div>
            <h4>Friend Requests</h4>
            <span class="f-count-badge blue">{{ $pendingRequests->count() }}</span>
        </div>

        <div class="row g-3">
            @foreach($pendingRequests as $request)
            <div class="col-md-6 col-lg-4 f-card-wrap">
                <div class="f-card">
                    <div class="f-card-body">
                        <div class="d-flex align-items-center gap-3">
                            @if($request->sender->profile_photo)
                            <img src="{{ $request->sender->profile_photo ? $request->sender->profile_photo : asset('images/default.png') }}"
                                class="f-avatar" width="56" height="56" alt="{{ $request->sender->name }}">
                            @else
                            <div class="f-avatar-placeholder" style="width:56px;height:56px;font-size:20px;">
                                {{ strtoupper(substr($request->sender->name, 0, 1)) }}
                            </div>
                            @endif
                            <div class="flex-grow-1 min-w-0">
                                <div class="f-name">{{ $request->sender->name }}</div>
                                <div class="f-prof">{{ $request->sender->profession ?? 'Smart Learner' }}</div>
                                <div class="f-time mt-1">{{ $request->created_at->diffForHumans() }}</div>
                            </div>
                        </div>

                        <div class="f-req-actions">
                            <form action="{{ route('friend.accept', $request->id) }}" method="POST" class="flex-fill">
                                @csrf
                                <button type="submit" class="f-btn f-btn-accept w-100">
                                    <i class="bi bi-check-circle"></i> Accept
                                </button>
                            </form>
                            <form action="{{ route('friend.decline', $request->id) }}" method="POST" class="flex-fill">
                                @csrf
                                <button type="submit" class="f-btn f-btn-decline w-100">
                                    <i class="bi bi-x-circle"></i> Decline
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="f-section-divider"></div>
    @endif

    {{-- ══ MY FRIENDS ══ --}}
    @if($myFriends->count() > 0)
    <div class="mb-5">
        <div class="f-section-head">
            <div class="f-icon green"><i class="bi bi-people-fill"></i></div>
            <h4>My Friends</h4>
            <span class="f-count-badge green">{{ $myFriends->count() }}</span>
        </div>

        <div class="row g-3">
            @foreach($myFriends as $friend)
            <div class="col-md-6 col-lg-4 f-card-wrap">
                <div class="f-card">
                    <div class="f-card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                @if($friend->profile_photo)
                                <img src="{{ $friend->profile_photo ? $friend->profile_photo : asset('images/default.png') }}"
                                    class="f-avatar" width="50" height="50" alt="{{ $friend->name }}">
                                @else
                                <div class="f-avatar-placeholder" style="width:50px;height:50px;font-size:17px;">
                                    {{ strtoupper(substr($friend->name, 0, 1)) }}
                                </div>
                                @endif
                                <div>
                                    <div class="f-name">{{ $friend->name }}</div>
                                    <div class="f-prof">{{ $friend->profession ?? 'Smart Learner' }}</div>
                                </div>
                            </div>

                            {{-- Hidden form — submitted by modal confirm button --}}
                            <form id="removeForm-{{ $friend->id }}" action="{{ route('friend.remove', $friend->id) }}" method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="button" class="f-btn-danger-outline f-remove-btn"
                                data-id="{{ $friend->id }}"
                                data-name="{{ $friend->name }}"
                                data-photo="{{ $friend->profile_photo ?? '' }}">
                                <i class="bi bi-person-x"></i>
                            </button>
                        </div>

                        <div class="f-following-tag">
                            <i class="bi bi-arrow-left-right"></i>
                            Following each other
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="f-section-divider"></div>
    @endif

    {{-- ══ FIND FRIENDS ══ --}}
    <div>
        <div class="f-section-head">
            <div class="f-icon gray"><i class="bi bi-search"></i></div>
            <h4>Find Friends</h4>
        </div>

        {{-- Search Input --}}
        <div class="f-search-wrap">
            <i class="bi bi-search f-search-icon"></i>
            <input
                type="text"
                id="friendSearch"
                class="f-search-input"
                placeholder="Search by name or profession..."
                autocomplete="off">
            <span id="searchSpinner" class="f-search-spinner d-none">
                <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
            </span>
        </div>

        {{-- Results --}}
        <div id="friendResults" class="row g-3">
            @foreach($users as $user)
            @php
            $sentRequest = \App\Models\FriendRequest::where('sender_id', auth()->id())->where('receiver_id', $user->id)->first();
            $receivedRequest = \App\Models\FriendRequest::where('sender_id', $user->id)->where('receiver_id', auth()->id())->first();
            $isFriend = ($sentRequest && $sentRequest->status == 'accepted') || ($receivedRequest && $receivedRequest->status == 'accepted');
            $isPending = ($sentRequest && $sentRequest->status == 'pending') || ($receivedRequest && $receivedRequest->status == 'pending');
            @endphp

            @if(!$isFriend)
            <div class="col-md-6 col-lg-4 f-card-wrap">
                <div class="f-card">
                    <div class="f-card-body d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            @if($user->profile_photo)
                            <img src="{{ $user->profile_photo ? $user->profile_photo : asset('images/default.png') }}"
                                class="f-avatar" width="50" height="50" alt="{{ $user->name }}">
                            @else
                            <div class="f-avatar-placeholder" style="width:50px;height:50px;font-size:17px;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            @endif
                            <div>
                                <div class="f-name">{{ $user->name }}</div>
                                <div class="f-prof">{{ $user->profession ?? 'Smart Learner' }}</div>
                            </div>
                        </div>

                        @if($isPending)
                        <span class="f-btn-disabled">
                            <i class="bi bi-clock-history"></i> Pending
                        </span>
                        @else
                        <form action="{{ route('friend.request', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="f-btn f-btn-primary">
                                <i class="bi bi-person-plus"></i> Add
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>

        <div id="noResults" class="f-no-results mt-2">
            <i class="bi bi-info-circle me-2"></i> No users found matching your search.
        </div>
    </div>

</div>
</div>

{{-- ── SEARCH JS — LOGIC UNCHANGED ── --}}
<script>
    (function() {
        const input = document.getElementById('friendSearch');
        const results = document.getElementById('friendResults');
        const noRes = document.getElementById('noResults');
        const spinner = document.getElementById('searchSpinner');
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

        // Save original HTML to restore when search is cleared
        const originalHTML = results.innerHTML;
        let debounceTimer;

        input.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            const query = this.value.trim();

            if (query.length === 0) {
                results.innerHTML = originalHTML;
                noRes.classList.remove('show');
                noRes.classList.add('d-none');
                return;
            }

            if (query.length < 2) return; // wait for at least 2 chars

            debounceTimer = setTimeout(() => {
                spinner.classList.remove('d-none');
                results.innerHTML = '';
                noRes.classList.remove('show');
                noRes.classList.add('d-none');

                fetch(`/friends/search?q=${encodeURIComponent(query)}`, {
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(r => {
                        if (!r.ok) throw new Error('Network error: ' + r.status);
                        return r.json();
                    })
                    .then(users => {
                        spinner.classList.add('d-none');

                        if (!users || users.length === 0) {
                            noRes.classList.remove('d-none');
                            noRes.classList.add('show');
                            return;
                        }

                        users.forEach(user => {
                            const avatar = user.profile_photo ?
                                `<img src="${user.profile_photo}" class="f-avatar" width="50" height="50" style="object-fit:cover;" alt="${user.name}">` :
                                `<div class="f-avatar-placeholder" style="width:50px;height:50px;font-size:17px;">${user.name.charAt(0).toUpperCase()}</div>`;

                            const action = user.is_pending ?
                                `<span class="f-btn-disabled"><i class="bi bi-clock-history"></i> Pending</span>` :
                                `<form action="/friend-request/${user.id}" method="POST">
                                    <input type="hidden" name="_token" value="${csrfToken}">
                                    <button type="submit" class="f-btn f-btn-primary">
                                        <i class="bi bi-person-plus"></i> Add
                                    </button>
                                </form>`;

                            results.innerHTML += `
                                <div class="col-md-6 col-lg-4 f-card-wrap">
                                    <div class="f-card">
                                        <div class="f-card-body d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-3">
                                                ${avatar}
                                                <div>
                                                    <div class="f-name">${user.name}</div>
                                                    <div class="f-prof">${user.profession ?? 'Smart Learner'}</div>
                                                </div>
                                            </div>
                                            ${action}
                                        </div>
                                    </div>
                                </div>`;
                        });
                    })
                    .catch(err => {
                        spinner.classList.add('d-none');
                        results.innerHTML = `<div class="col-12"><div class="f-no-results show"><i class="bi bi-exclamation-triangle me-2"></i>Search failed. Please try again. (${err.message})</div></div>`;
                    });
            }, 300);
        });
    })();
</script>


{{-- ══ CUSTOM REMOVE FRIEND MODAL ══ --}}
<div class="f-modal-overlay" id="fRemoveModal">
    <div class="f-modal-box">
        <div class="f-modal-icon">
            <i class="bi bi-person-dash-fill"></i>
        </div>
        <div class="f-modal-title">Remove Friend?</div>
        <div class="f-modal-desc">You're about to remove this friend.<br>You'll both unfollow each other.</div>

        <div class="f-modal-friend-chip" id="fModalChip">
            <div class="f-chip-av" id="fModalAv"></div>
            <span id="fModalName"></span>
        </div>

        <div class="f-modal-actions">
            <button type="button" class="f-modal-btn-cancel" id="fModalCancel">Cancel</button>
            <button type="button" class="f-modal-btn-remove" id="fModalConfirm">
                <i class="bi bi-person-x me-1"></i> Remove
            </button>
        </div>
    </div>
</div>

<script>
(function () {
    const overlay  = document.getElementById('fRemoveModal');
    const chip     = document.getElementById('fModalChip');
    const avEl     = document.getElementById('fModalAv');
    const nameEl   = document.getElementById('fModalName');
    const cancelBtn  = document.getElementById('fModalCancel');
    const confirmBtn = document.getElementById('fModalConfirm');
    let targetFormId = null;

    // Open modal when remove button clicked
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.f-remove-btn');
        if (!btn) return;

        const id    = btn.dataset.id;
        const name  = btn.dataset.name;
        const photo = btn.dataset.photo;

        targetFormId = 'removeForm-' + id;
        nameEl.textContent = name;

        // Build avatar inside chip
        avEl.innerHTML = '';
        if (photo) {
            const img = document.createElement('img');
            img.src = photo;
            img.className = 'f-chip-av';
            img.alt = name;
            avEl.parentNode.replaceChild(img, avEl);
        } else {
            avEl.textContent = name.charAt(0).toUpperCase();
        }

        overlay.classList.add('show');
        document.body.style.overflow = 'hidden';
    });

    // Cancel
    cancelBtn.addEventListener('click', closeModal);
    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) closeModal();
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeModal();
    });

    // Confirm remove — submit the hidden form
    confirmBtn.addEventListener('click', function () {
        if (!targetFormId) return;
        const form = document.getElementById(targetFormId);
        if (form) form.submit();
    });

    function closeModal() {
        overlay.classList.remove('show');
        document.body.style.overflow = '';
        targetFormId = null;
    }
})();
</script>

@endsection