@extends('layouts.app')

<style>
    .feed-container {
        background: #f3f2ef;
        min-height: 100vh;
    }

    .sticky-sidebar {
        position: sticky;
        top: 80px;
    }

    @media (max-width: 768px) {
        .sticky-sidebar {
            position: relative;
            top: 0;
        }
    }

    .action-btn {
        border: none;
        background: transparent;
        padding: 0.6rem 1rem;
        border-radius: 12px;
        transition: all 0.2s;
        font-weight: 500;
        color: #666;
    }

    .action-btn:hover {
        background: #667eea15;
        color: #667eea;
    }

    .action-btn i {
        font-size: 1.1rem;
        margin-right: 4px;
    }

    .like-btn i {
        color: #6c757d;
        transition: all 0.3s;
    }

    .like-btn.liked i {
        color: #0d6efd;
        transform: scale(1.2);
    }
</style>

@section('content')
<div class="feed-container">
    <div class="container py-4">
        <div class="row">

            <!-- Left Sidebar -->
            <div class="col-md-3 d-none d-md-block">
                <div class="sticky-sidebar">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body text-center">
                            @if(auth()->user()->profile_photo)
                                <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                                     class="rounded-circle mb-3"
                                     width="80" height="80"
                                     style="object-fit:cover;">
                            @else
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3"
                                     style="width:80px;height:80px;">
                                    <i class="bi bi-person-fill fs-2 text-secondary"></i>
                                </div>
                            @endif

                            <h6 class="fw-bold mb-1">{{ auth()->user()->name }}</h6>
                            <p class="small text-muted mb-0">
                                {{ auth()->user()->bio ?? 'No bio yet' }}
                            </p>
                            <hr class="my-3">

                            <a href="{{ route('posts.my') }}"
                                class="sidebar-link text-decoration-none text-muted d-flex align-items-center gap-2 mb-3">
                                <i class="bi bi-file-earmark-post"></i> My Posts
                            </a>

                            <a href="{{ url('/friends') }}"
                                class="sidebar-link text-decoration-none text-muted d-flex align-items-center gap-2 mb-3">
                                <i class="bi bi-people-fill"></i> Friends
                            </a>

                            <a href="{{ url('/skills') }}"
                                class="sidebar-link text-decoration-none text-muted d-flex align-items-center gap-2 mb-3">
                                <i class="bi bi-lightbulb-fill"></i> My Skills
                            </a>

                            <a href="{{ url('/roadmaps') }}"
                                class="sidebar-link text-decoration-none text-muted d-flex align-items-center gap-2 mb-3">
                                <i class="bi bi-map-fill"></i> Learning Roadmap
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Post Column -->
            <div class="col-md-6">

                <!-- Back button -->
                <a href="{{ route('feed') }}" class="btn btn-light rounded-pill mb-3">
                    ← Back to Feed
                </a>

                <!-- Post Card -->
                <div class="card shadow-sm border-0 rounded-4">

                    <!-- Post Header -->
                    <div class="card-body border-bottom">
                        <div class="d-flex align-items-center gap-2">

                            @if($post->user->profile_photo)
                                <img src="{{ asset('storage/' . $post->user->profile_photo) }}"
                                     width="48" height="48"
                                     class="rounded-circle border object-fit-cover">
                            @else
                                <div class="d-flex align-items-center justify-content-center rounded-circle border bg-light"
                                     style="width:48px;height:48px;">
                                    <i class="bi bi-person-fill fs-5 text-secondary"></i>
                                </div>
                            @endif

                            <div>
                                <h6 class="mb-0 fw-bold">{{ $post->user->name }}</h6>
                                <small class="text-muted">
                                    <i class="bi bi-clock"></i>
                                    {{ $post->created_at->diffForHumans() }}
                                </small>
                            </div>

                            @if(auth()->id() !== $post->user->id)
                                <form method="POST" action="{{ route('follow.toggle', $post->user->id) }}" class="ms-auto">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-primary rounded-pill">
                                        {{ auth()->user()->followings->contains('id', $post->user->id) ? 'Unfollow' : 'Follow' }}
                                    </button>
                                </form>
                            @endif

                        </div>
                    </div>

                    <!-- Post Content -->
                    <div class="card-body px-4 py-3">
                        <p class="card-text mb-0">{!! $post->content !!}</p>
                    </div>

                    <!-- Post Media -->
                    @if($post->media)
                        <div style="width:100%;height:450px;display:flex;align-items:center;justify-content:center;">
                            <img src="{{ asset('storage/' . $post->media) }}"
                                 style="width:100%;height:100%;object-fit:cover;"
                                 class="img-fluid"
                                 alt="Post media">
                        </div>
                    @endif

                    <!-- Post Actions -->
                    <div class="card-footer bg-white border-0 py-2 px-3">
                        <div class="d-flex justify-content-around">

                            <!-- Like -->
                            <button type="button"
                                class="action-btn like-btn {{ $post->likes->where('user_id', auth()->id())->count() ? 'liked' : '' }}"
                                data-post="{{ $post->id }}">
                                <i class="bi bi-hand-thumbs-up-fill"></i>
                                <span class="like-count">{{ $post->likes->count() }}</span>
                            </button>

                            <!-- Comment -->
                            <button class="action-btn"
                                onclick="document.getElementById('comment-box-{{ $post->id }}').classList.toggle('d-none')">
                                <i class="bi bi-chat-fill"></i> Comment
                            </button>

                            <!-- Share -->
                            <button type="button"
                                class="action-btn"
                                data-bs-toggle="modal"
                                data-bs-target="#shareModal-{{ $post->id }}">
                                <i class="bi bi-share-fill"></i> Share
                            </button>
                        </div>

                        @php
                            $likedUsers = $post->likes->take(2);
                            $remainingLikes = $post->likes->count() - 2;
                        @endphp

                        @if($post->likes->count() > 0)
                            <div class="px-3 pb-2 small text-muted">
                                Liked by
                                @foreach($likedUsers as $like)
                                    {{ $like->user->name }}@if(!$loop->last), @endif
                                @endforeach

                                @if($remainingLikes > 0)
                                    and
                                    <a href="#"
                                       class="text-dark fw-semibold text-decoration-none"
                                       data-bs-toggle="modal"
                                       data-bs-target="#likesModal-{{ $post->id }}">
                                        {{ $remainingLikes }} others
                                    </a>
                                @endif
                            </div>
                        @endif

                        <!-- Comment Input -->
                        <div id="comment-box-{{ $post->id }}" class="d-none mt-3">
                            <form method="POST" action="/posts/{{ $post->id }}/comment">
                                @csrf
                                <div class="d-flex gap-2">
                                    <input type="text"
                                           name="comment"
                                           class="form-control"
                                           placeholder="Write a comment..."
                                           required>
                                    <button class="btn btn-primary">Post</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="col-md-3 d-none d-lg-block">
                <div class="sticky-sidebar">

                    <!-- News -->
                    <div class="card border-0 shadow-sm rounded-4 mb-3">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3">
                                <i class="bi bi-newspaper me-2"></i>Smart Learners News
                            </h6>
                            <ul class="list-unstyled small mb-0">
                                <li class="mb-2">
                                    <a href="#" class="news-link text-decoration-none text-black">
                                        • AI-Powered Creative Co-Pilots
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a href="#" class="news-link text-decoration-none text-black">
                                        • Hyper-Personalization Standard
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a href="#" class="news-link text-decoration-none text-black">
                                        • Gamification 2.0: Emotional Design
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a href="#" class="news-link text-decoration-none text-black">
                                        • Collaborative In-Flow Learning
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="news-link text-decoration-none text-black">
                                        • Emerging Risks & Regulations
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Puzzle -->
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body text-center">
                            <h6 class="fw-bold mb-3">
                                <i class="bi bi-puzzle-fill me-2"></i>Today's Puzzle
                            </h6>
                            <img src="{{ asset('images/Sliding Puzzle.gif') }}"
                                 class="img-fluid rounded-3"
                                 style="max-height:220px;">
                        </div>
                    </div>
                     <!-- Sidebar Footer -->
                    <div class="card border-0 mt-3 shadow-sm rounded-4">
                        <div class="card-body text-center small">

                            <p class="fw-semibold text-primary mb-2">
                                Smart Social Learning Platform
                            </p>

                            <div class="d-flex flex-wrap justify-content-center gap-2 mb-2">
                                <a href="{{ route('about') }}" class="text-muted text-decoration-none">About</a>
                                <span class="text-muted">•</span>
                                <a href="{{ route('contact') }}" class="text-muted text-decoration-none">Contact</a>
                                <span class="text-muted">•</span>
                                <a href="{{ route('privacy') }}" class="text-muted text-decoration-none">Privacy</a>
                                <span class="text-muted">•</span>
                                <a href="{{ route('terms') }}" class="text-muted text-decoration-none">Terms</a>
                            </div>

                            <small class="text-muted">
                                © {{ date('Y') }} SmartLearn
                            </small>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- Like JS -->
<script>
document.addEventListener('click', function(e) {
    const btn = e.target.closest('.like-btn');
    if (!btn) return;

    const postId = btn.dataset.post;

    fetch(`/posts/${postId}/like`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        btn.querySelector('.like-count').innerText = data.likes_count;
        btn.classList.toggle('liked', data.liked);
    });
});
</script>
@endsection