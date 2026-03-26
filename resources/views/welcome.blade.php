@extends('layouts.app')
@section('hideFooter', true)

@section('title', 'Smart Learning Platform')

@section('content')

<style>
    .hero-section {
        padding: 80px 0;
    }

    .hero-title {
        font-size: 42px;
        font-weight: 700;
        color: #1f2937;
    }

    .hero-subtitle {
        font-size: 18px;
        color: #4b5563;
        margin: 20px 0;
    }

    .btn-main {
        background: #4f46e5;
        color: #fff;
        padding: 12px 20px;
        border-radius: 30px;
        font-weight: 600;
    }

    .btn-main:hover {
        background: #4338ca;
        color: #fff;
    }

    .btn-outline {
        border-radius: 30px;
        padding: 12px 20px;
        font-weight: 600;
    }

    .hero-img {
        border-radius: 20px;
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        max-width: 100%;
    }

    @media(max-width:768px){
        .hero-title {
            font-size: 32px;
        }
    }
</style>

<div class="container hero-section">
    <div class="row align-items-center">

        <!-- LEFT CONTENT -->
        <div class="col-lg-6 mb-4">
            <h1 class="hero-title">
                Learn Smarter. <br>
                Share Knowledge. <br>
                Grow Your Skills.
            </h1>

            <p class="hero-subtitle">
                A social learning platform where learners share posts,
                follow skills, track progress, and grow together.
            </p>

            <div class="d-flex flex-wrap gap-3">
                <a href="/register" class="btn btn-main">
                    Join & Start Learning
                </a>

                <a href="/login" class="btn btn-outline-primary btn-outline">
                    Sign In
                </a>
            </div>

            <p class="text-muted mt-4 small">
                Build skills • Follow learners • Track progress • Earn reputation
            </p>
        </div>

        <!-- RIGHT IMAGE -->
        <div class="col-lg-6 text-center">
            <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d"
                 alt="Learning Community"
                 class="hero-img">
        </div>

    </div>
</div>

@endsection
