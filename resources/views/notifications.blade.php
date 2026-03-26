@extends('layouts.app')

@section('content')
<div class="container py-4" style="max-width: 700px;">

    <!-- Page Title -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="fw-bold m-0">
            <i class="bi bi-bell-fill text-primary me-2"></i>
            All Notifications
        </h4>

        <a href="{{ route('feed') }}" class="btn btn-sm btn-outline-primary rounded-pill">
            Back to Feed
        </a>
    </div>

    @forelse($notifications as $n)
    <a href="{{ $n->url ?? '#' }}" class="text-decoration-none text-dark">
        <div class="card border-0 shadow-sm rounded-4 mb-3 notification-card">
            <div class="card-body d-flex align-items-center gap-3">

                <!-- Icon -->
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:48px;height:48px;background:#f1f3f5;">

                    @if($n->type == 'follow')
                        <i class="bi bi-person-plus-fill text-success fs-4"></i>
                    @elseif($n->type == 'like')
                        <i class="bi bi-heart-fill text-danger fs-4"></i>
                    @elseif($n->type == 'comment')
                        <i class="bi bi-chat-dots-fill text-primary fs-4"></i>
                    @else
                        <i class="bi bi-bell-fill text-secondary fs-4"></i>
                    @endif

                </div>

                <!-- Text -->
                <div>
                    <div class="fw-semibold">
                        {{ $n->name }}
                        @if($n->type == 'follow')
                            started following you
                        @elseif($n->type == 'like')
                            liked your post
                        @elseif($n->type == 'comment')
                            commented on your post
                        @endif
                    </div>

                    <small class="text-muted">
                        {{ \Carbon\Carbon::parse($n->created_at)->diffForHumans() }}
                    </small>
                </div>

            </div>
        </div>
    </a>
    @empty
    <div class="text-center text-muted py-5">
        <i class="bi bi-bell-slash fs-1"></i>
        <p class="mt-2">No notifications yet</p>
    </div>
    @endforelse

</div>

<style>
.notification-card {
    transition: 0.2s ease;
}
.notification-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 18px rgba(0,0,0,0.08);
}
</style>
@endsection
