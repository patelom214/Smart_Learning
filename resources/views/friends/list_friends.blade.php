@extends('layouts.app')

@section('title', 'Friends')

@section('content')
<div class="container py-4">

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Pending Friend Requests -->
    @if($pendingRequests->count() > 0)
    <div class="mb-5">
        <h4 class="mb-3 fw-bold">
            <i class="bi bi-bell-fill text-primary me-2"></i>
            Friend Requests
            <span class="badge bg-primary rounded-pill">{{ $pendingRequests->count() }}</span>
        </h4>

        <div class="row g-3">
            @foreach($pendingRequests as $request)
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 rounded-4 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            @if($request->sender->profile_photo)
                            <img src="{{ $request->sender->profile_photo 
                         ? $request->sender->profile_photo 
                         : asset('images/default.png') }}"
                                class="rounded-circle"
                                alt="{{ $request->sender->name }}"
                                width="60" height="60"
                                style="object-fit: cover;">
                            @else
                            <div class="rounded-circle bg-gradient text-white d-flex align-items-center justify-content-center"
                                style="width:60px;height:60px;background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                <span class="fs-4 fw-bold">{{ strtoupper(substr($request->sender->name, 0, 1)) }}</span>
                            </div>
                            @endif

                            <div class="flex-grow-1">
                                <div class="fw-bold fs-6">{{ $request->sender->name }}</div>
                                <small class="text-muted">{{ $request->sender->profession ?? 'Smart Learner' }}</small>
                                <div><small class="text-muted">{{ $request->created_at->diffForHumans() }}</small></div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <form action="{{ route('friend.accept', $request->id) }}" method="POST" class="flex-fill">
                                @csrf
                                <button class="btn btn-primary btn-sm w-100">
                                    <i class="bi bi-check-circle me-1"></i> Accept
                                </button>
                            </form>
                            <form action="{{ route('friend.decline', $request->id) }}" method="POST" class="flex-fill">
                                @csrf
                                <button class="btn btn-outline-secondary btn-sm w-100">
                                    <i class="bi bi-x-circle me-1"></i> Decline
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- My Friends -->
    @if($myFriends->count() > 0)
    <div class="mb-5">

        <h4 class="mb-3 fw-bold">
            <i class="bi bi-people-fill text-success me-2"></i>
            My Friends
            <span class="badge bg-success rounded-pill">{{ $myFriends->count() }}</span>
        </h4>

        <div class="row g-3">
            @foreach($myFriends as $friend)
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 rounded-4 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="d-flex align-items-center gap-3">
                                @if($friend->profile_photo)
                                <img src="{{ $friend->profile_photo 
                         ? $friend->profile_photo 
                         : asset('images/default.png') }}"
                                    class="rounded-circle"
                                    alt="{{ $friend->name }}"
                                    width="50" height="50"
                                    style="object-fit: cover;">
                                @else
                                <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center"
                                    style="width:50px;height:50px;">
                                    {{ strtoupper(substr($friend->name, 0, 1)) }}
                                </div>
                                @endif

                                <div>
                                    <div class="fw-semibold">{{ $friend->name }}</div>
                                    <small class="text-muted">{{ $friend->profession ?? 'Smart Learner' }}</small>
                                </div>
                            </div>

                            <form action="{{ route('friend.remove', $friend->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm"
                                    onclick="return confirm('Remove this friend? This will also unfollow each other.')">
                                    <i class="bi bi-person-x"></i>
                                </button>
                            </form>
                        </div>

                        <div class="d-flex align-items-center gap-2 mt-2">
                            <span class="badge bg-success-subtle text-success border border-success">
                                <i class="bi bi-arrow-left-right me-1"></i>
                                Following each other
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Find Friends -->
    <div>
        <h4 class="mb-3 fw-bold">
            <i class="bi bi-search me-2"></i>
            Find Friends
        </h4>

        <!-- Search Input -->
        <div class="mb-4 position-relative" style="max-width: 400px;">
            <span class="position-absolute top-50 translate-middle-y ms-3" style="left:0; z-index:1;">
                <i class="bi bi-search text-muted"></i>
            </span>
            <input
                type="text"
                id="friendSearch"
                class="form-control ps-5 rounded-pill shadow-sm border"
                placeholder="Search by name or profession..."
                autocomplete="off">
            <span id="searchSpinner" class="position-absolute top-50 translate-middle-y me-3 d-none" style="right:0;">
                <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
            </span>
        </div>

        <!-- Results -->
        <div id="friendResults" class="row g-3">
            @foreach($users as $user)
            @php
            $sentRequest = \App\Models\FriendRequest::where('sender_id', auth()->id())->where('receiver_id', $user->id)->first();
            $receivedRequest = \App\Models\FriendRequest::where('sender_id', $user->id)->where('receiver_id', auth()->id())->first();
            $isFriend = ($sentRequest && $sentRequest->status == 'accepted') || ($receivedRequest && $receivedRequest->status == 'accepted');
            $isPending = ($sentRequest && $sentRequest->status == 'pending') || ($receivedRequest && $receivedRequest->status == 'pending');
            @endphp

            @if(!$isFriend)
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 rounded-4 h-100 hover-card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            @if($user->profile_photo)
                            
                            <img src="{{ $user->profile_photo 
                         ? $user->profile_photo 
                         : asset('images/default.png') }}" class="rounded-circle" alt="{{ $user->name }}" width="50" height="50" style="object-fit:cover;">
                            @else
                            <div class="rounded-circle text-white d-flex align-items-center justify-content-center" style="width:50px;height:50px;background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            @endif
                            <div>
                                <div class="fw-semibold">{{ $user->name }}</div>
                                <small class="text-muted">{{ $user->profession ?? 'Smart Learner' }}</small>
                            </div>
                        </div>

                        @if($isPending)
                        <button class="btn btn-secondary btn-sm" disabled>
                            <i class="bi bi-clock-history me-1"></i> Pending
                        </button>
                        @else
                        <form action="{{ route('friend.request', $user->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-primary btn-sm">
                                <i class="bi bi-person-plus me-1"></i> Add Friend
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>

        <div id="noResults" class="alert alert-info d-none">
            <i class="bi bi-info-circle me-2"></i> No users found matching your search.
        </div>
    </div>

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
                    noRes.classList.add('d-none');
                    return;
                }

                if (query.length < 2) return; // wait for at least 2 chars

                debounceTimer = setTimeout(() => {
                    spinner.classList.remove('d-none');
                    results.innerHTML = '';
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
                                return;
                            }

                            users.forEach(user => {
                                
                                const avatar = user.profile_photo ?
                                    `<img src="{{ $user->profile_photo 
                         ? $user->profile_photo 
                         : asset('images/default.png') }}" class="rounded-circle" width="50" height="50" style="object-fit:cover;" alt="${user.name}">` :
                                    `<div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold" style="width:50px;height:50px;min-width:50px;background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);">${user.name.charAt(0).toUpperCase()}</div>`;

                                const action = user.is_pending ?
                                    `<button class="btn btn-secondary btn-sm" disabled>
         <i class="bi bi-clock-history me-1"></i>Pending
       </button>` :
                                    `<form action="/friend-request/${user.id}" method="POST">
         <input type="hidden" name="_token" value="${csrfToken}">
         <button type="submit" class="btn btn-primary btn-sm">
           <i class="bi bi-person-plus me-1"></i>Add Friend
         </button>
       </form>`;

                                results.innerHTML += `
                        <div class="col-md-6 col-lg-4">
                            <div class="card shadow-sm border-0 rounded-4 h-100 hover-card">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        ${avatar}
                                        <div>
                                            <div class="fw-semibold">${user.name}</div>
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
                            results.innerHTML = `<div class="col-12"><div class="alert alert-danger"><i class="bi bi-exclamation-triangle me-2"></i>Search failed. Please try again. (${err.message})</div></div>`;
                        });
                }, 300);
            });
        })();
    </script>

</div>

<style>
    .hover-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1) !important;
    }

    .bg-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .badge {
        font-weight: 500;
        padding: 0.4em 0.8em;
    }
</style>
@endsection