@extends('layouts.app')

@section('title', 'My Profile')

@section('content')

<style>
    /* Profile Page Styles */
    .profile-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 20px 20px 0 0;
        padding: 3rem 2rem 5rem 2rem;
        position: relative;
        overflow: hidden;
    }

    .profile-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,101.3C1248,85,1344,75,1392,69.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
        background-size: cover;
    }

    .profile-photo-wrapper {
        position: relative;
        margin-top: -4rem;
        margin-bottom: 1.5rem;
    }

    .profile-photo {
        width: 150px;
        height: 150px;
        border: 5px solid white;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        object-fit: cover;
        transition: transform 0.3s;
    }

    .profile-photo:hover {
        transform: scale(1.05);
    }

    .profile-placeholder {
        width: 150px;
        height: 150px;
        border: 5px solid white;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .stats-card {
        border: none;
        border-radius: 15px;
        transition: all 0.3s;
        background: white;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .btn-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        transition: all 0.3s;
    }

    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-outline-gradient {
        background: transparent;
        border: 2px solid #667eea;
        color: #667eea;
        transition: all 0.3s;
    }

    .btn-outline-gradient:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-color: transparent;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        position: relative;
        display: inline-block;
        margin-bottom: 1.5rem;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 50px;
        height: 3px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 2px;
    }

    .friend-card {
        border: none;
        border-radius: 15px;
        transition: all 0.3s;
        background: white;
    }

    .friend-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .friend-avatar {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border: 3px solid #f8f9fa;
        transition: all 0.3s;
    }

    .friend-card:hover .friend-avatar {
        border-color: #667eea;
    }

    .badge-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 4rem;
        opacity: 0.3;
        margin-bottom: 1rem;
    }

    @media (max-width: 768px) {
        .profile-header {
            padding: 2rem 1rem 4rem 1rem;
        }

        .profile-photo,
        .profile-placeholder {
            width: 120px;
            height: 120px;
        }

        .stat-number {
            font-size: 1.5rem;
        }
    }

    .back-btn {
        position: absolute;
        top: 20px;
        left: 20px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 50px;
        font-weight: 500;
        color: white;
        text-decoration: none;
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
        z-index: 2;
    }

    .back-btn:hover {
        background: white;
        color: #667eea;
        transform: translateX(-3px);
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <!-- Profile Card -->
            <div class="card shadow-lg border-0 overflow-hidden">
                <!-- Profile Header -->
                <div class="profile-header text-center">
                    <a href="{{ url('/index') }}" class="back-btn">
                        <i class="bi bi-arrow-left"></i>
                        <span>Back</span>
                    </a>
                    <div style="position: relative; z-index: 1;">
                        <h2 class="mb-2">{{ $user->name }}</h2>
                        <p class="mb-0 opacity-90">
                            <i class="bi bi-envelope me-2"></i>{{ $user->email }}
                        </p>
                    </div>
                </div>

                <!-- Profile Photo -->
                <div class="card-body text-center pt-0">
                    <div class="profile-photo-wrapper">
                        @if($user->profile_photo)
                        <!-- Profile Image -->
                        <img src="{{ $user->profile_photo ?? asset('images/default.png') }}"
                            class="rounded-circle border shadow"
                            width="150"
                            height="150"
                            style="object-fit: cover;" alt="{{ $user->name }}">
                        @else
                        <div class="rounded-circle profile-placeholder d-flex align-items-center justify-content-center mx-auto">
                            <i class="bi bi-person-fill fs-1 text-white"></i>
                        </div>
                        @endif
                    </div>

                    <!-- Bio -->
                    @if($user->bio)
                    <p class="text-muted mb-4 fs-5">{{ $user->bio }}</p>
                    @else
                    <p class="text-muted mb-4 fst-italic">No bio added yet</p>
                    @endif

                    <!-- Stats Cards -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="stats-card p-3 shadow-sm">
                                <div class="stat-number">{{ $followers->count() }}</div>
                                <div class="text-muted">Followers</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stats-card p-3 shadow-sm">
                                <div class="stat-number">{{ $following->count() }}</div>
                                <div class="text-muted">Following</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stats-card p-3 shadow-sm">
                                <div class="stat-number">{{ $user->posts->count() }}</div>
                                <div class="text-muted">Posts</div>
                            </div>
                        </div>

                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-center align-items-center gap-3 mt-3 mb-3">

                        <!-- Edit Profile -->
                        <a href="{{ route('profile.edit', $user->id) }}"
                            class="btn btn-gradient rounded-pill px-4 py-2 d-flex align-items-center">
                            <i class="bi bi-pencil me-2"></i>
                            Edit Profile
                        </a>

                        <!-- Share Profile -->
                        <a href="https://wa.me/?text={{ urlencode(url()->current()) }}"
                            target="_blank"
                            class="btn btn-gradient rounded-pill px-4 py-2 d-flex align-items-center">
                            <i class="bi bi-whatsapp me-2"></i>
                            Share Profile
                        </a>

                    </div>

                    <hr class="my-0">

                    <!-- Followers & Following Section -->
                    <div class="card-body">
                        <div class="row">
                            <!-- Followers -->
                            <div class="col-md-6 mb-4 mb-md-0">
                                <h5 class="section-title">
                                    <i class="bi bi-people-fill me-2 text-primary"></i>Followers
                                </h5>

                                @if($followers->count() > 0)
                                <div class="list-group list-group-flush">
                                    @foreach($followers as $follower)
                                    <div class="list-group-item border-0 px-0">
                                        <div class="friend-card p-3">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    @if($follower->profile_photo)
                                                    
                                                    <img src="{{ $follower->profile_photo ?? asset('images/default.png') }}"
                                                        class="rounded-circle friend-avatar me-3"
                                                        alt="{{ $follower->name }}">
                                                    @else
                                                    <div class="rounded-circle friend-avatar d-flex align-items-center justify-content-center me-3 bg-light">
                                                        <i class="bi bi-person-fill text-secondary"></i>
                                                    </div>
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-0">{{ $follower->name }}</h6>
                                                        <small class="text-muted">{{ '@' . strtolower(str_replace(' ', '', $follower->name)) }}</small>
                                                    </div>
                                                </div>
                                                <a href="{{ route('user.profile', $follower->id) }}"
                                                    class="btn btn-sm btn-outline-gradient rounded-pill px-3">
                                                    View
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                <div class="empty-state">
                                    <i class="bi bi-person-x"></i>
                                    <p class="mb-0">No followers yet</p>
                                    <small>Share your profile to get followers!</small>
                                </div>
                                @endif
                            </div>

                            <!-- Following -->
                            <div class="col-md-6">
                                <h5 class="section-title">
                                    <i class="bi bi-person-check-fill me-2 text-success"></i>Following
                                </h5>

                                @if($following->count() > 0)
                                <div class="list-group list-group-flush">
                                    @foreach($following as $followed)
                                    <div class="list-group-item border-0 px-0">
                                        <div class="friend-card p-3">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    @if($followed->profile_photo)
                                                    <img src="{{ $followed->profile_photo ?? asset('images/default.png') }}"
                                                        class="rounded-circle friend-avatar me-3"
                                                        alt="{{ $followed->name }}">
                                                    @else
                                                    <div class="rounded-circle friend-avatar d-flex align-items-center justify-content-center me-3 bg-light">
                                                        <i class="bi bi-person-fill text-secondary"></i>
                                                    </div>
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-0">{{ $followed->name }}</h6>
                                                        <small class="text-muted">{{ '@' . strtolower(str_replace(' ', '', $followed->name)) }}</small>
                                                    </div>
                                                </div>
                                                <form action="{{ route('follow.toggle', $followed->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                                        Unfollow
                                                    </button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                <div class="empty-state">
                                    <i class="bi bi-person-plus"></i>
                                    <p class="mb-0">Not following anyone yet</p>
                                    <small>Find people to follow!</small>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer text-center bg-light border-0 py-3">
                        <small class="text-muted">
                            <i class="bi bi-calendar3 me-1"></i>
                            Member since {{ $user->created_at->format('M d, Y') }}
                        </small>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add animation to stats on scroll
            const statsCards = document.querySelectorAll('.stats-card');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '0';
                        entry.target.style.transform = 'translateY(20px)';

                        setTimeout(() => {
                            entry.target.style.transition = 'all 0.5s ease';
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }, 100);
                    }
                });
            }, {
                threshold: 0.1
            });

            statsCards.forEach(card => observer.observe(card));
        });
    </script>

    @endsection