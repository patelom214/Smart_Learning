@extends('layouts.app')
@section('hideFooter', true)

@section('title', 'Smart Learning Platform')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,600;1,600&display=swap" rel="stylesheet">

<style>
    .hero-page {
        min-height: 100vh;
        background: linear-gradient(135deg, #e8f4fd 0%, #f0ebff 50%, #fde8f0 100%);
        display: flex;
        align-items: center;
        font-family: 'DM Sans', sans-serif;
        padding: 3rem 2rem;
        position: relative;
        overflow: hidden;
    }

    .hero-page::before {
        content: '';
        position: absolute;
        top: -120px;
        left: -120px;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(37,99,235,0.08) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .hero-page::after {
        content: '';
        position: absolute;
        bottom: -100px;
        right: -100px;
        width: 350px;
        height: 350px;
        background: radial-gradient(circle, rgba(168,85,247,0.07) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .hero-inner {
        max-width: 1100px;
        margin: 0 auto;
        width: 100%;
        display: flex;
        align-items: center;
        gap: 4rem;
        position: relative;
        z-index: 1;
    }

    /* LEFT */
    .hero-left {
        flex: 1;
        min-width: 0;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(37,99,235,0.08);
        color: #2563eb;
        font-size: 12.5px;
        font-weight: 500;
        padding: 5px 13px;
        border-radius: 20px;
        margin-bottom: 1.5rem;
        letter-spacing: 0.02em;
    }

    .hero-badge span {
        width: 6px;
        height: 6px;
        background: #2563eb;
        border-radius: 50%;
        display: inline-block;
    }

    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 48px;
        font-weight: 600;
        color: #1a1a2e;
        line-height: 1.15;
        margin-bottom: 1.25rem;
    }

    .hero-title em {
        font-style: italic;
        color: #2563eb;
    }

    .hero-subtitle {
        font-size: 16px;
        color: #6b7280;
        line-height: 1.75;
        margin-bottom: 2rem;
        max-width: 440px;
    }

    /* CTA Buttons */
    .hero-cta {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 2.25rem;
    }

    .btn-hero-main {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #2563eb;
        color: #ffffff;
        padding: 13px 24px;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 600;
        font-family: 'DM Sans', sans-serif;
        text-decoration: none;
        transition: background 0.2s, transform 0.15s;
        border: none;
    }

    .btn-hero-main:hover {
        background: #1d4ed8;
        color: #ffffff;
        text-decoration: none;
        transform: translateY(-1px);
    }

    .btn-hero-outline {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #ffffff;
        color: #374151;
        padding: 13px 24px;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 500;
        font-family: 'DM Sans', sans-serif;
        text-decoration: none;
        border: 1.5px solid #e5e7eb;
        transition: background 0.2s, border-color 0.2s, transform 0.15s;
    }

    .btn-hero-outline:hover {
        background: #f9fafb;
        border-color: #d1d5db;
        color: #374151;
        text-decoration: none;
        transform: translateY(-1px);
    }

    /* Feature pills */
    .hero-features {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .hero-feature-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #ffffff;
        border: 0.5px solid rgba(0,0,0,0.08);
        border-radius: 20px;
        padding: 5px 12px;
        font-size: 12.5px;
        color: #374151;
        font-weight: 400;
    }

    .hero-feature-pill svg {
        width: 13px;
        height: 13px;
        color: #2563eb;
        flex-shrink: 0;
    }

    /* RIGHT — extra top/bottom padding gives room for floating cards */
    .hero-right {
        flex: 1;
        min-width: 0;
        padding: 44px 0 44px 0;
        position: relative;
    }

    .hero-img-wrap {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,0,0,0.12);
        position: relative;
        z-index: 1;
    }

    .hero-img-wrap img {
        width: 100%;
        display: block;
        border-radius: 20px;
    }

    /* Tag card — above image, right-aligned, fully inside the column */
    .hero-tag-card {
        position: absolute;
        top: 6px;
        right: 16px;
        background: #2563eb;
        color: #ffffff;
        border-radius: 12px;
        padding: 9px 16px;
        font-size: 13px;
        font-weight: 500;
        font-family: 'DM Sans', sans-serif;
        box-shadow: 0 6px 20px rgba(37,99,235,0.30);
        white-space: nowrap;
        z-index: 2;
    }

    /* Stat card — below image, left-aligned, fully inside the column */
    .hero-stat-card {
        position: absolute;
        bottom: 4px;
        left: 16px;
        background: #ffffff;
        border-radius: 14px;
        padding: 12px 16px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.10);
        display: flex;
        align-items: center;
        gap: 10px;
        border: 0.5px solid rgba(0,0,0,0.06);
        z-index: 2;
    }

    .stat-icon {
        width: 36px;
        height: 36px;
        background: rgba(37,99,235,0.1);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stat-icon svg {
        width: 18px;
        height: 18px;
        fill: #2563eb;
    }

    .stat-text strong {
        display: block;
        font-size: 15px;
        font-weight: 600;
        color: #1a1a2e;
        line-height: 1.2;
    }

    .stat-text span {
        font-size: 11.5px;
        color: #9ca3af;
    }

    /* Responsive */
    @media (max-width: 960px) {
        .hero-inner {
            flex-direction: column;
            gap: 2.5rem;
            text-align: center;
        }

        .hero-subtitle { max-width: 100%; }
        .hero-cta { justify-content: center; }
        .hero-features { justify-content: center; }
        .hero-title { font-size: 34px; }

        .hero-right {
            width: 100%;
            padding: 44px 0 44px 0;
        }
    }
</style>
@endpush

@section('content')

<div class="hero-page">
    <div class="hero-inner">

        {{-- LEFT CONTENT --}}
        <div class="hero-left">

            <div class="hero-badge">
                <span></span>
                Social Learning Platform
            </div>

            <h1 class="hero-title">
                Learn <em>Smarter.</em><br>
                Share Knowledge.<br>
                Grow Your Skills.
            </h1>

            <p class="hero-subtitle">
                A social learning platform where learners share posts,
                follow skills, track progress, and grow together.
            </p>

            <div class="hero-cta">
                <a href="/register" class="btn-hero-main">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/>
                    </svg>
                    Join & Start Learning
                </a>

                <a href="/login" class="btn-hero-outline">
                    Sign In
                </a>
            </div>

            <div class="hero-features">
                <div class="hero-feature-pill">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    Build skills
                </div>
                <div class="hero-feature-pill">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
                    Follow learners
                </div>
                <div class="hero-feature-pill">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 14l-5-5 1.41-1.41L12 14.17l7.59-7.59L21 8l-9 9z"/></svg>
                    Track progress
                </div>
                <div class="hero-feature-pill">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20 6h-2.18c.07-.44.18-.88.18-1.34C18 2.54 15.46.06 12.29.06c-1.85 0-3.47.8-4.62 2.06L12 6.5l4.33-4.38C17.22 2.73 18 3.98 18 5.34c0 .46-.11.9-.18 1.34H14l2 2H4c-1.1 0-2 .9-2 2v11c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2z"/></svg>
                    Earn reputation
                </div>
            </div>
        </div>

        {{-- RIGHT IMAGE --}}
        <div class="hero-right">

            {{-- Floating tag card: above image, inside right column --}}
            <div class="hero-tag-card">
                🎓 10k+ Active Learners
            </div>

            <div class="hero-img-wrap">
                <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d"
                     alt="Learning Community">
            </div>

            {{-- Floating stat card: below image, inside right column --}}
            <div class="hero-stat-card">
                <div class="stat-icon">
                    <svg viewBox="0 0 24 24"><path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/></svg>
                </div>
                <div class="stat-text">
                    <strong>500+ Courses</strong>
                    <span>Across all skill levels</span>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection