@extends('layouts.app')

@section('title', $user->name . ' Profile')

@section('content')

<style>
    .profile-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 20px 20px 0 0;
        padding: 3rem 2rem 5rem 2rem;
        position: relative;
        overflow: hidden;
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
    }

    .profile-placeholder {
        width: 150px;
        height: 150px;
        border: 5px solid white;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .stats-card {
        border: none;
        border-radius: 15px;
        background: white;
        transition: all 0.3s;
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
    }

    .btn-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
    }

    .btn-gradient:hover {
        color: white;
        opacity: 0.9;
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

            <div class="card shadow-lg border-0 overflow-hidden">

                <!-- Header -->
                <div class="profile-header text-center">
                    <a href="{{ url()->previous() }}" class="back-btn">
                        <i class="bi bi-arrow-left"></i>
                        <span>Back</span>
                    </a>
                    <h2 class="mb-2">{{ $user->name }}</h2>
                    <p class="mb-0 opacity-90">
                        <i class="bi bi-envelope me-2"></i>{{ $user->email }}
                    </p>
                </div>

                <!-- Body -->
                <div class="card-body text-center pt-0">

                    <!-- Profile Photo -->
                    <div class="profile-photo-wrapper">
                        @if($user->profile_photo)
                        <img src="{{ $user->profile_photo ?? asset('images/default.png') }}"
                            class="rounded-circle profile-photo">
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

                    <!-- Stats -->
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

                    <!-- Follow / Unfollow Button -->
                    <div class="mt-4">
                        <form action="{{ route('follow.toggle', $user->id) }}" method="POST">
                            @csrf

                            @if(auth()->user()->friends()->where('id', $user->id)->exists())
                            <button class="btn btn-danger rounded-pill px-4">
                                Unfollow
                            </button>
                            @else
                            <button class="btn btn-gradient rounded-pill px-4 py-2">
                                Follow
                            </button>
                            @endif

                        </form>
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

@endsection