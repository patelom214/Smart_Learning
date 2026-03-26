@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<style>
    .hero-section {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border-radius: 20px;
        padding: 60px 40px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .feature-card {
        border: none;
        border-radius: 18px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: 0.3s;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.12);
    }

    .icon-circle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin: 0 auto 15px;
    }
</style>

<div class="container py-5">

    <!-- Hero Section -->
    <div class="hero-section mb-5">
        <h2 class="fw-bold mb-3">Welcome to Smart Learners</h2>
        <p class="lead mb-0">
            A social learning platform where students connect, share knowledge,
            build skills, and grow together.
        </p>
    </div>

    <!-- Mission -->
    <div class="row mb-5">
        <div class="col-md-8 mx-auto text-center">
            <h3 class="fw-bold mb-3">Our Mission</h3>
            <p class="text-muted">
                Smart Learners is designed to help students collaborate,
                share knowledge, and build practical skills in a
                social environment. We aim to create a platform
                where learning becomes interactive, engaging,
                and community-driven.
            </p>
        </div>
    </div>

    <!-- Features -->
    <div class="row g-4">

        <div class="col-md-4">
            <div class="card feature-card text-center p-4">
                <div class="icon-circle">
                    <i class="bi bi-people-fill"></i>
                </div>
                <h5 class="fw-bold">Connect with Friends</h5>
                <p class="text-muted small">
                    Follow and interact with other learners,
                    build your network, and grow together.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card feature-card text-center p-4">
                <div class="icon-circle">
                    <i class="bi bi-lightbulb-fill"></i>
                </div>
                <h5 class="fw-bold">Share Knowledge</h5>
                <p class="text-muted small">
                    Post ideas, tips, and learning resources
                    to help others and build your reputation.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card feature-card text-center p-4">
                <div class="icon-circle">
                    <i class="bi bi-graph-up-arrow"></i>
                </div>
                <h5 class="fw-bold">Track Your Growth</h5>
                <p class="text-muted small">
                    Show your skills, progress, and achievements
                    to stand out during placements.
                </p>
            </div>
        </div>

    </div>

</div>
@endsection
