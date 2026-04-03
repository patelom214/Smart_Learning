@extends('layouts.app')

@section('title', 'Home')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,600;1,600&display=swap" rel="stylesheet">

<style>
    /* ===== BASE ===== */
    body { font-family: 'DM Sans', sans-serif; }

    :root {
        --blue: #2563eb;
        --blue-dark: #1d4ed8;
        --blue-soft: rgba(37,99,235,0.08);
        --text-dark: #1a1a2e;
        --text-mid: #374151;
        --text-muted: #6b7280;
        --border: rgba(0,0,0,0.07);
        --bg-gradient: linear-gradient(135deg, #e8f4fd 0%, #f0ebff 50%, #fde8f0 100%);
    }

    /* ===== HERO ===== */
    .hl-hero {
        background: var(--bg-gradient);
        padding: 5rem 0 4rem;
        position: relative;
        overflow: hidden;
    }

    .hl-hero::before {
        content: '';
        position: absolute;
        top: -140px; left: -140px;
        width: 500px; height: 500px;
        background: radial-gradient(circle, rgba(37,99,235,0.07) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .hl-hero::after {
        content: '';
        position: absolute;
        bottom: -100px; right: -80px;
        width: 400px; height: 400px;
        background: radial-gradient(circle, rgba(168,85,247,0.06) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .hl-hero-inner { position: relative; z-index: 1; }

    .hl-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--blue-soft);
        color: var(--blue);
        font-size: 12.5px;
        font-weight: 500;
        padding: 5px 14px;
        border-radius: 20px;
        margin-bottom: 1.25rem;
    }

    .hl-badge-dot {
        width: 6px; height: 6px;
        background: var(--blue);
        border-radius: 50%;
        display: inline-block;
    }

    .hl-hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 52px;
        font-weight: 600;
        color: var(--text-dark);
        line-height: 1.13;
        margin-bottom: 1.25rem;
    }

    .hl-hero-title em {
        font-style: italic;
        color: var(--blue);
    }

    .hl-hero-sub {
        font-size: 16.5px;
        color: var(--text-muted);
        line-height: 1.75;
        margin-bottom: 2rem;
        max-width: 480px;
    }

    .hl-cta-row {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 2.5rem;
    }

    .btn-hl-main {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--blue);
        color: #fff;
        padding: 13px 26px;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 600;
        font-family: 'DM Sans', sans-serif;
        text-decoration: none;
        border: none;
        transition: background 0.2s, transform 0.15s;
    }

    .btn-hl-main:hover {
        background: var(--blue-dark);
        color: #fff;
        text-decoration: none;
        transform: translateY(-1px);
    }

    .btn-hl-outline {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #fff;
        color: var(--text-mid);
        padding: 13px 26px;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 500;
        font-family: 'DM Sans', sans-serif;
        text-decoration: none;
        border: 1.5px solid #e5e7eb;
        transition: background 0.2s, border-color 0.2s, transform 0.15s;
    }

    .btn-hl-outline:hover {
        background: #f9fafb;
        border-color: #d1d5db;
        color: var(--text-mid);
        text-decoration: none;
        transform: translateY(-1px);
    }

    /* Hero feature pills */
    .hl-pill-row {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .hl-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #fff;
        border: 0.5px solid var(--border);
        border-radius: 20px;
        padding: 5px 13px;
        font-size: 12.5px;
        color: var(--text-mid);
    }

    /* Hero right image */
    .hl-hero-right {
        position: relative;
        padding: 55px 0 65px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .hl-hero-img-wrap {
        border-radius: 50%;
        overflow: hidden;
        width: 360px;
        height: 360px;
        margin: 0 auto;
        box-shadow: 0 20px 60px rgba(0,0,0,0.12);
        border: 4px solid rgba(255,255,255,0.9);
        background: #e8f4fd;
        flex-shrink: 0;
        position: relative;
        z-index: 1;
    }

    .hl-hero-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center top;
        display: block;
    }

    .hl-float-tag {
        position: absolute;
        top: 8px;
        right: calc(50% - 195px);
        background: var(--blue);
        color: #fff;
        border-radius: 12px;
        padding: 9px 16px;
        font-size: 13px;
        font-weight: 500;
        font-family: 'DM Sans', sans-serif;
        box-shadow: 0 6px 20px rgba(37,99,235,0.28);
        white-space: nowrap;
        z-index: 2;
    }

    .hl-float-stat {
        position: absolute;
        bottom: 8px;
        left: calc(50% - 195px);
        background: #fff;
        border-radius: 14px;
        padding: 12px 16px;
        box-shadow: 0 8px 28px rgba(0,0,0,0.09);
        display: flex;
        align-items: center;
        gap: 10px;
        border: 0.5px solid var(--border);
        z-index: 2;
    }

    .hl-stat-icon {
        width: 36px; height: 36px;
        background: var(--blue-soft);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .hl-stat-icon svg { width: 18px; height: 18px; fill: var(--blue); }

    .hl-stat-text strong {
        display: block;
        font-size: 15px;
        font-weight: 600;
        color: var(--text-dark);
        line-height: 1.2;
    }

    .hl-stat-text span { font-size: 11.5px; color: #9ca3af; }

    /* Profile hero image */
    .hl-profile-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center top;
        display: block;
    }

    /* ===== SLIDER ===== */
    .hl-slider-wrap {
        background: #fff;
        border-radius: 20px;
        padding: 2.5rem 2rem;
        box-shadow: 0 4px 30px rgba(0,0,0,0.06);
        border: 0.5px solid var(--border);
        overflow: hidden;
        position: relative;
    }

    .hl-slides { display: flex; transition: transform 0.6s ease; }

    .hl-slide {
        min-width: 100%;
        text-align: center;
        padding: 0 1rem;
    }

    .hl-slide-emoji {
        font-size: 2.5rem;
        margin-bottom: 0.75rem;
        display: block;
    }

    .hl-slide h4 {
        font-family: 'Playfair Display', serif;
        font-size: 22px;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }

    .hl-slide p {
        font-size: 15px;
        color: var(--text-muted);
        max-width: 420px;
        margin: 0 auto;
        line-height: 1.7;
    }

    .hl-slide-dots {
        display: flex;
        justify-content: center;
        gap: 6px;
        margin-top: 1.5rem;
    }

    .hl-dot {
        width: 7px; height: 7px;
        border-radius: 50%;
        background: #e5e7eb;
        transition: background 0.3s, width 0.3s;
        cursor: pointer;
    }

    .hl-dot.active {
        background: var(--blue);
        width: 20px;
        border-radius: 4px;
    }

    /* ===== SECTION LABEL ===== */
    .hl-section-label {
        display: inline-block;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--blue);
        background: var(--blue-soft);
        padding: 4px 12px;
        border-radius: 20px;
        margin-bottom: 0.75rem;
    }

    .hl-section-title {
        font-family: 'Playfair Display', serif;
        font-size: 36px;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }

    .hl-section-sub {
        font-size: 15px;
        color: var(--text-muted);
        margin-bottom: 2.5rem;
    }

    /* ===== FEATURE CARDS ===== */
    .hl-features { background: #f9fafb; padding: 5rem 0; }

    .hl-feature-card {
        background: #fff;
        border-radius: 18px;
        padding: 2rem 1.75rem;
        border: 0.5px solid var(--border);
        height: 100%;
        transition: transform 0.25s, box-shadow 0.25s;
    }

    .hl-feature-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 40px rgba(0,0,0,0.08);
    }

    .hl-feature-icon {
        width: 52px; height: 52px;
        border-radius: 14px;
        background: var(--blue-soft);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.25rem;
        font-size: 1.5rem;
    }

    .hl-feature-card h5 {
        font-size: 17px;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }

    .hl-feature-card p {
        font-size: 14px;
        color: var(--text-muted);
        line-height: 1.7;
        margin: 0;
    }

    /* ===== TRENDING SKILLS ===== */
    .hl-skills { padding: 5rem 0; background: #fff; }

    .hl-skill-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 9px 18px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 500;
        font-family: 'DM Sans', sans-serif;
        border: 1.5px solid #e5e7eb;
        background: #fff;
        color: var(--text-mid);
        cursor: pointer;
        transition: all 0.2s;
    }

    .hl-skill-tag:hover {
        border-color: var(--blue);
        color: var(--blue);
        background: var(--blue-soft);
        transform: translateY(-2px);
        box-shadow: 0 4px 14px rgba(37,99,235,0.12);
    }

    /* ===== STATS ===== */
    .hl-stats {
        background: var(--text-dark);
        padding: 5rem 0;
        position: relative;
        overflow: hidden;
    }

    .hl-stats::before {
        content: '';
        position: absolute;
        top: -100px; left: -100px;
        width: 350px; height: 350px;
        background: radial-gradient(circle, rgba(37,99,235,0.15) 0%, transparent 70%);
        border-radius: 50%;
    }

    .hl-stats::after {
        content: '';
        position: absolute;
        bottom: -80px; right: -80px;
        width: 300px; height: 300px;
        background: radial-gradient(circle, rgba(168,85,247,0.12) 0%, transparent 70%);
        border-radius: 50%;
    }

    .hl-stat-card {
        position: relative;
        z-index: 1;
        padding: 2rem 1.5rem;
        border-radius: 16px;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        text-align: center;
        transition: background 0.25s, transform 0.25s;
    }

    .hl-stat-card:hover {
        background: rgba(255,255,255,0.09);
        transform: translateY(-4px);
    }

    .hl-stat-card .counter {
        font-family: 'Playfair Display', serif;
        font-size: 3rem;
        font-weight: 600;
        color: #fff;
        display: block;
        margin-bottom: 0.25rem;
    }

    .hl-stat-card p {
        font-size: 13.5px;
        color: rgba(255,255,255,0.5);
        font-weight: 500;
        margin: 0;
        letter-spacing: 0.03em;
    }

    /* ===== CTA ===== */
    .hl-cta {
        background: var(--bg-gradient);
        padding: 5rem 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .hl-cta::before {
        content: '';
        position: absolute;
        top: -80px; left: 50%;
        transform: translateX(-50%);
        width: 600px; height: 300px;
        background: radial-gradient(ellipse, rgba(37,99,235,0.08) 0%, transparent 70%);
    }

    .hl-cta-inner { position: relative; z-index: 1; }

    .hl-cta h2 {
        font-family: 'Playfair Display', serif;
        font-size: 38px;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.75rem;
    }

    .hl-cta p {
        font-size: 16px;
        color: var(--text-muted);
        margin-bottom: 2rem;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 991px) {
        .hl-hero-title { font-size: 38px; }
        .hl-hero-sub { max-width: 100%; }
        .hl-hero-right { padding: 44px 0; }
        .hl-float-tag { right: 10px; }
        .hl-float-stat { left: 10px; }
    }

    @media (max-width: 767px) {
        .hl-hero { padding: 3rem 0 2.5rem; }
        .hl-hero-title { font-size: 30px; }
        .hl-section-title { font-size: 26px; }
        .hl-cta h2 { font-size: 26px; }
        .hl-stat-card .counter { font-size: 2.2rem; }
        .hl-cta-row { justify-content: center; }
        .hl-pill-row { justify-content: center; }
        .hl-hero-sub { text-align: center; }
        .hl-badge { display: none; }
    }
</style>

<!-- ===== HERO ===== -->
<section class="hl-hero">
    <div class="container hl-hero-inner">
        <div class="row align-items-center g-5">

            <div class="col-lg-6">
                <div class="hl-badge">
                    <span class="hl-badge-dot"></span>
                    Social Learning Platform
                </div>

                <h1 class="hl-hero-title">
                    Learn. Share.<br>
                    <em>Grow Together</em> 🚀
                </h1>

                <p class="hl-hero-sub">
                    A smart social learning platform to build skills, share knowledge,
                    track progress, and grow your professional career.
                </p>

                @guest
                <div class="hl-cta-row">
                    <a href="{{ route('register') }}" class="btn-hl-main">
                        <i class="bi bi-rocket-takeoff"></i> Join Now
                    </a>
                    <a href="{{ route('login') }}" class="btn-hl-outline">
                        <i class="bi bi-box-arrow-in-right"></i> Sign In
                    </a>
                </div>

                <div class="hl-pill-row">
                    <span class="hl-pill">🧠 Build skills</span>
                    <span class="hl-pill">👥 Follow learners</span>
                    <span class="hl-pill">📈 Track progress</span>
                    <span class="hl-pill">🏆 Earn reputation</span>
                </div>
                @endguest

                @auth
                <div class="hl-cta-row">
                    <a href="{{ route('feed') }}" class="btn-hl-main">
                        <i class="bi bi-grid-3x3-gap-fill"></i> Go to Feed
                    </a>
                </div>
                <div class="hl-pill-row">
                    <span class="hl-pill">🧠 Build skills</span>
                    <span class="hl-pill">👥 Follow learners</span>
                    <span class="hl-pill">📈 Track progress</span>
                    <span class="hl-pill">🏆 Earn reputation</span>
                </div>
                @endauth
            </div>

            <div class="col-lg-6">
                <div class="hl-hero-right">
                    <div class="hl-float-tag">🎓 10k+ Active Learners</div>

                    @auth
                    @if(Auth::user()->profile_photo)
                    <div class="hl-hero-img-wrap">
                        <img src="{{ Auth::user()->profile_photo ? Auth::user()->profile_photo : asset('images/default.png') }}"
                             alt="Profile" loading="lazy" class="hl-profile-img">
                    </div>
                    @else
                    <div class="hl-hero-img-wrap" style="background:#f0f4ff; padding:2rem; border-radius:50%;">
                        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                             alt="Learning" loading="lazy"
                             style="width:100%; height:100%; object-fit:contain;">
                    </div>
                    @endif
                    @else
                    <div class="hl-hero-img-wrap">
                        <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=700"
                             alt="Learning community" loading="lazy">
                    </div>
                    @endguest

                    <div class="hl-float-stat">
                        <div class="hl-stat-icon">
                            <svg viewBox="0 0 24 24"><path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/></svg>
                        </div>
                        <div class="hl-stat-text">
                            <strong>500+ Courses</strong>
                            <span>Across all skill levels</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ===== SLIDER ===== -->
<section class="py-5" style="background:#f9fafb;">
    <div class="container">
        <div class="hl-slider-wrap">
            <div class="hl-slides">
                <div class="hl-slide">
                    <span class="hl-slide-emoji">📚</span>
                    <h4>Learn Skills with Roadmaps</h4>
                    <p>Follow structured learning paths and track progress milestone by milestone.</p>
                </div>
                <div class="hl-slide">
                    <span class="hl-slide-emoji">💬</span>
                    <h4>Share Knowledge</h4>
                    <p>Post learning tips, code snippets, and resources with your community.</p>
                </div>
                <div class="hl-slide">
                    <span class="hl-slide-emoji">🏆</span>
                    <h4>Earn Reputation & Badges</h4>
                    <p>Get rewarded for helping the community and completing your goals.</p>
                </div>
            </div>
            <div class="hl-slide-dots">
                <div class="hl-dot active"></div>
                <div class="hl-dot"></div>
                <div class="hl-dot"></div>
            </div>
        </div>
    </div>
</section>

<!-- ===== FEATURES ===== -->
<section class="hl-features">
    <div class="container">
        <div class="text-center">
            <span class="hl-section-label">Why Smart Learning?</span>
            <h2 class="hl-section-title">Everything you need to grow</h2>
            <p class="hl-section-sub">Tools and community to accelerate your learning journey</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="hl-feature-card">
                    <div class="hl-feature-icon">🧠</div>
                    <h5>Social Learning</h5>
                    <p>Learn together by sharing posts, liking, commenting, and following others.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="hl-feature-card">
                    <div class="hl-feature-icon">📈</div>
                    <h5>Skill Tracking</h5>
                    <p>Track your skill progress with milestones and completion status.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="hl-feature-card">
                    <div class="hl-feature-icon">🛡️</div>
                    <h5>Admin Moderation</h5>
                    <p>Safe and moderated environment for quality learning content.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== TRENDING SKILLS ===== -->
<section class="hl-skills">
    <div class="container">
        <div class="text-center mb-4">
            <span class="hl-section-label">Trending Now</span>
            <h2 class="hl-section-title">Popular Skills</h2>
            <p class="hl-section-sub">Join learners mastering the most in-demand technologies</p>
        </div>

        <div class="d-flex flex-wrap justify-content-center gap-3">
            <span class="hl-skill-tag">💻 PHP</span>
            <span class="hl-skill-tag">⚡ Laravel</span>
            <span class="hl-skill-tag">🚀 JavaScript</span>
            <span class="hl-skill-tag">⚛️ React</span>
            <span class="hl-skill-tag">🗄️ MySQL</span>
            <span class="hl-skill-tag">🐍 Python</span>
            <span class="hl-skill-tag">📱 React Native</span>
        </div>
    </div>
</section>

<!-- ===== STATS ===== -->
<section class="hl-stats">
    <div class="container">
        <div class="text-center mb-4" style="position:relative;z-index:1;">
            <span class="hl-section-label" style="background:rgba(255,255,255,0.1);color:rgba(255,255,255,0.7);">By the numbers</span>
            <h2 class="hl-section-title" style="color:#fff; margin-bottom:2.5rem;">Growing every day</h2>
        </div>
        <div class="row g-4 text-center">
            <div class="col-md-3 col-sm-6">
                <div class="hl-stat-card">
                    <span class="counter" data-target="10">0</span>
                    <p>Active Learners</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="hl-stat-card">
                    <span class="counter" data-target="25">0</span>
                    <p>Learning Posts</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="hl-stat-card">
                    <span class="counter" data-target="10">0</span>
                    <p>Skills</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="hl-stat-card">
                    <span class="counter" data-target="20">0</span>
                    <p>Top Roadmaps</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== CTA ===== -->
<section class="hl-cta">
    <div class="container hl-cta-inner">
        <h2>Ready to Start Your Learning Journey?</h2>
        <p>Join thousands of learners growing their skills every day</p>
        @guest
        <a href="{{ route('register') }}" class="btn-hl-main" style="display:inline-flex;">
            Get Started Free <i class="bi bi-arrow-right ms-2"></i>
        </a>
        @endguest
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        /* ===== COUNTER ANIMATION (original logic) ===== */
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

        const statsSection = document.querySelector('.hl-stats');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => { if (entry.isIntersecting) animateCounters(); });
        }, { threshold: 0.5 });
        if (statsSection) observer.observe(statsSection);

        /* ===== SLIDER (original logic + dot sync) ===== */
        window.addEventListener('load', function () {
            const slideContainer = document.querySelector('.hl-slides');
            const slides = document.querySelectorAll('.hl-slide');
            const dots = document.querySelectorAll('.hl-dot');
            if (!slideContainer || slides.length === 0) return;

            let index = 0;

            function goTo(i) {
                index = i;
                slideContainer.style.transform = 'translateX(-' + (index * 100) + '%)';
                dots.forEach((d, di) => d.classList.toggle('active', di === index));
            }

            dots.forEach((dot, di) => dot.addEventListener('click', () => goTo(di)));

            setInterval(() => goTo((index + 1) % slides.length), 4000);
        });

        /* ===== SMOOTH SCROLL (original logic) ===== */
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });
    });
</script>

@endsection