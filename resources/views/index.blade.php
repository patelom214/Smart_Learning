@extends('layouts.app')

@section('title', 'Home')

@section('content')

<style>
    /* ================= CUSTOM STYLES ================= */
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --success-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --info-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --dark-gradient: linear-gradient(135deg, #434343 0%, #000000 100%);
    }

    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,101.3C1248,85,1344,75,1392,69.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
        background-size: cover;
    }

    .hero-content {
        position: relative;
        z-index: 1;
    }

    .hero-image {
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    .btn-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-outline-gradient {
        background: white;
        border: 2px solid #667eea;
        color: #667eea;
        transition: all 0.3s;
    }

    .btn-outline-gradient:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-color: transparent;
        transform: translateY(-2px);
    }

    .feature-card {
        border: none;
        border-radius: 20px;
        transition: all 0.3s ease;
        background: white;
        overflow: hidden;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .feature-card .icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        display: inline-block;
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }
    }

    .skill-badge {
        font-size: 1rem;
        padding: 0.75rem 1.5rem !important;
        border-radius: 50px;
        transition: all 0.3s;
        cursor: pointer;
        border: 2px solid transparent;
    }

    .skill-badge:hover {
        transform: scale(1.1);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .stats-section {
        background: var(--dark-gradient);
        position: relative;
    }

    .stats-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23667eea" fill-opacity="0.1" d="M0,224L48,197.3C96,171,192,117,288,112C384,107,480,149,576,165.3C672,181,768,171,864,154.7C960,139,1056,117,1152,122.7C1248,128,1344,160,1392,176L1440,192L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>') no-repeat top;
        background-size: cover;
    }

    .stat-card {
        position: relative;
        z-index: 1;
        padding: 2rem;
        border-radius: 15px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s;
    }

    .stat-card:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateY(-5px);
    }

    .stat-card h2 {
        font-size: 3rem;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .carousel-item {
        padding: 3rem 1rem;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
        border-radius: 15px;
        margin: 0 1rem;
    }

    .carousel-item h4 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #667eea;
        margin-bottom: 1rem;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        position: relative;
        display: inline-block;
        margin-bottom: 3rem;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 4px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 2px;
    }

    .profile-hero-image {
        max-height: 400px;
        width: 400px;
        object-fit: cover;
        border: 5px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }

    .feature-slider {
        position: relative;
        overflow: hidden;
        background: white;
        border-radius: 20px;
        padding: 40px 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    }

    .slides {
        display: flex;
        transition: transform 0.6s ease;
    }

    .slide {
        min-width: 100%;
        text-align: center;
    }

    @media (max-width: 768px) {
        .hero-section {
            padding: 3rem 0 !important;
        }

        .section-title {
            font-size: 2rem;
        }

        .stat-card h2 {
            font-size: 2rem;
        }
    }
</style>

<!-- ================= HERO SECTION ================= -->
<section class="hero-section py-5">
    <div class="container py-5">
        <div class="row align-items-center hero-content">
            <div class="col-md-6 mb-4 mb-md-0">
                <h1 class="fw-bold mb-3 display-4">
                    Learn. Share. Grow Together 🚀
                </h1>
                <p class="mb-4 fs-5 opacity-90">
                    A smart social learning platform to build skills, share knowledge,
                    track progress, and grow your professional career.
                </p>

                @guest
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg rounded-pill px-4 py-3 fw-semibold">
                        <i class="bi bi-rocket-takeoff me-2"></i>Join Now
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg rounded-pill px-4 py-3 fw-semibold">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                    </a>
                </div>
                @endguest

                @auth
                <a href="{{ route('feed') }}" class="btn btn-light btn-lg rounded-pill px-5 py-3 fw-semibold">
                    <i class="bi bi-grid-3x3-gap-fill me-2"></i>Go to Feed
                </a>
                @endauth
            </div>

            <div class="col-md-6 text-center">
                <div class="hero-image">
                    @auth
                    @if(auth()->user()->profile_photo)
                    <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                        alt="Profile"
                       loading="lazy"  class="img-fluid rounded-circle profile-hero-image">
                    @else
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                        alt="Learning"
                        loading="lazy" class="img-fluid"
                        style="max-height:400px; filter: drop-shadow(0 20px 40px rgba(0,0,0,0.3));">
                    @endif
                    @else
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                        alt="Learning"
                         class="img-fluid"
                        style="max-height:400px; filter: drop-shadow(0 20px 40px rgba(0,0,0,0.3));">
                    @endguest
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= SLIDER SECTION ================= -->
<section class="py-5">
    <div class="container">
        <div class="feature-slider">

            <div class="slides">
                <div class="slide active">
                    <h4>📚 Learn Skills with Roadmaps</h4>
                    <p class="text-muted fs-5">
                        Follow structured learning paths and track progress.
                    </p>
                </div>

                <div class="slide">
                    <h4>💬 Share Knowledge</h4>
                    <p class="text-muted fs-5">
                        Post learning tips, code snippets, and resources.
                    </p>
                </div>

                <div class="slide">
                    <h4>🏆 Earn Reputation & Badges</h4>
                    <p class="text-muted fs-5">
                        Get rewarded for helping the community.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>



<!-- ================= FEATURES SECTION ================= -->
<section class="bg-light py-5">
    <div class="container py-4">
        <h2 class="text-center section-title mb-5">Why Use Smart Learning?</h2>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card feature-card h-100 text-center p-4">
                    <div class="icon">🧠</div>
                    <h5 class="fw-bold mb-3">Social Learning</h5>
                    <p class="text-muted">
                        Learn together by sharing posts, liking, commenting, and following others.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card feature-card h-100 text-center p-4">
                    <div class="icon">📈</div>
                    <h5 class="fw-bold mb-3">Skill Tracking</h5>
                    <p class="text-muted">
                        Track your skill progress with milestones and completion status.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card feature-card h-100 text-center p-4">
                    <div class="icon">🛡</div>
                    <h5 class="fw-bold mb-3">Admin Moderation</h5>
                    <p class="text-muted">
                        Safe and moderated environment for quality learning content.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= TRENDING SKILLS ================= -->
<section class="py-5">
    <div class="container py-4">
        <h2 class="section-title text-center mb-5">Trending Skills</h2>

        <div class="d-flex flex-wrap justify-content-center gap-3">
            <span class="badge bg-primary skill-badge">💻 PHP</span>
            <span class="badge bg-success skill-badge">⚡ Laravel</span>
            <span class="badge bg-warning text-dark skill-badge">🚀 JavaScript</span>
            <span class="badge bg-info text-dark skill-badge">⚛️ React</span>
            <span class="badge bg-secondary skill-badge">🗄️ MySQL</span>
            <span class="badge bg-danger skill-badge">🐍 Python</span>
            <span class="badge bg-dark skill-badge">📱 React Native</span>
        </div>
    </div>
</section>

<!-- ================= STATS SECTION ================= -->
<section class="stats-section py-5">
    <div class="container py-5">
        <div class="row g-4 text-center">
            <div class="col-md-3 col-sm-6">
                <div class="stat-card">
                    <h2 class="counter text-white" data-target="10">0</h2>
                    <p class="text-white-50 mb-0 fw-semibold">Active Learners</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-card">
                    <h2 class="counter text-white" data-target="25">0</h2>
                    <p class="text-white-50 mb-0 fw-semibold">Learning Posts</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-card">
                    <h2 class="counter text-white" data-target="10">0</h2>
                    <p class="text-white-50 mb-0 fw-semibold">Skills</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-card">
                    <h2 class="counter text-white" data-target="20">0</h2>
                    <p class="text-white-50 mb-0 fw-semibold">Top Roadmaps</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= CTA SECTION ================= -->
<section class="py-5 bg-light">
    <div class="container text-center py-4">
        <h2 class="fw-bold mb-3">Ready to Start Your Learning Journey?</h2>
        <p class="text-muted mb-4 fs-5">Join thousands of learners growing their skills every day</p>
        @guest
        <a href="{{ route('register') }}" class="btn btn-gradient btn-lg rounded-pill px-5 py-3 fw-semibold">
            Get Started Free <i class="bi bi-arrow-right ms-2"></i>
        </a>
        @endguest
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        /* ================= COUNTER ANIMATION ================= */
        const counters = document.querySelectorAll('.counter');
        let animated = false;

        const animateCounters = () => {
            if (animated) return;

            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                let count = 0;
                const duration = 2000;
                const increment = target / (duration / 16);

                const updateCounter = () => {
                    count += increment;

                    if (count < target) {
                        counter.innerText = Math.floor(count);
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.innerText = target + '+';
                    }
                };

                updateCounter();
            });

            animated = true;
        };

        // Trigger animation when stats section is in view
        const statsSection = document.querySelector('.stats-section');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                }
            });
        }, {
            threshold: 0.5
        });

        if (statsSection) {
            observer.observe(statsSection);
        }

        /* ================= SLIDER SPEED CONTROL ================= */
        window.addEventListener("load", function() {
            const slideContainer = document.querySelector(".slides");
            const slides = document.querySelectorAll(".slide");

            if (!slideContainer || slides.length === 0) return;

            let index = 0;

            function nextSlide() {
                index++;
                if (index >= slides.length) {
                    index = 0;
                }
                slideContainer.style.transform = "translateX(-" + (index * 100) + "%)";
            }

            setInterval(nextSlide, 4000); // auto move every 4 seconds
        });


        /* ================= SMOOTH SCROLL ================= */
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

    });
</script>
@endsection
