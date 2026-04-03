@extends('layouts.app')

@section('title', 'Sign In')

@section('content')

{{-- Google Fonts --}}
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">

<style>
    .auth-page {
        min-height: 100vh;
        background: linear-gradient(135deg, #e8f4fd 0%, #f0ebff 50%, #fde8f0 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'DM Sans', sans-serif;
        padding: 2rem;
    }

    .auth-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 2.5rem 2.25rem;
        width: 100%;
        max-width: 420px;
        border: 0.5px solid rgba(0, 0, 0, 0.08);
        box-shadow: 0 4px 40px rgba(0, 0, 0, 0.06);
    }

    /* Logo Row */
    .auth-logo-row {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 2rem;
    }

    .auth-logo-icon {
        width: 36px;
        height: 36px;
        background: #2563eb;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .auth-logo-icon svg {
        width: 20px;
        height: 20px;
        fill: white;
    }

    .auth-brand {
        font-size: 17px;
        font-weight: 500;
        color: #1a1a2e;
    }

    .auth-brand span {
        color: #2563eb;
    }

    /* Title */
    .auth-title {
        font-family: 'Playfair Display', serif;
        font-size: 24px;
        font-weight: 600;
        color: #1a1a2e;
        margin-bottom: 0.25rem;
    }

    .auth-subtitle {
        font-size: 13.5px;
        color: #6b7280;
        margin-bottom: 1.75rem;
    }

    /* Alert */
    .auth-alert {
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fecaca;
        border-radius: 8px;
        padding: 9px 12px;
        font-size: 13px;
        margin-bottom: 1rem;
    }

    /* Form fields */
    .auth-field {
        margin-bottom: 1.1rem;
    }

    .auth-field label {
        display: block;
        font-size: 12.5px;
        font-weight: 500;
        color: #374151;
        margin-bottom: 6px;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }

    .auth-field input[type="email"],
    .auth-field input[type="password"] {
        width: 100%;
        padding: 11px 14px;
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
        font-family: 'DM Sans', sans-serif;
        color: #1a1a2e;
        background: #fafafa;
        transition: border-color 0.2s, background 0.2s;
        outline: none;
    }

    .auth-field input[type="email"]:focus,
    .auth-field input[type="password"]:focus {
        border-color: #2563eb;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08);
    }

    /* Remember me + Forgot password row */
    .auth-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        margin-top: 0.25rem;
    }

    .auth-check-wrap {
        display: flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
    }

    .auth-check-wrap input[type="checkbox"] {
        width: 15px;
        height: 15px;
        accent-color: #2563eb;
        cursor: pointer;
    }

    .auth-check-wrap span {
        font-size: 13px;
        color: #6b7280;
    }

    .auth-forgot {
        font-size: 13px;
        color: #2563eb;
        text-decoration: none;
        font-weight: 500;
    }

    .auth-forgot:hover {
        text-decoration: underline;
    }

    /* Sign In button */
    .btn-auth-main {
        width: 100%;
        padding: 13px;
        background: #2563eb;
        color: #ffffff;
        border: none;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 600;
        font-family: 'DM Sans', sans-serif;
        cursor: pointer;
        letter-spacing: 0.01em;
        transition: background 0.2s, transform 0.1s;
    }

    .btn-auth-main:hover {
        background: #1d4ed8;
    }

    .btn-auth-main:active {
        transform: scale(0.99);
    }

    /* Divider */
    .auth-divider {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 1.25rem 0;
    }

    .auth-divider::before,
    .auth-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #e5e7eb;
    }

    .auth-divider span {
        font-size: 12px;
        color: #9ca3af;
    }

    /* Google button */
    .btn-auth-google {
        width: 100%;
        padding: 12px;
        background: #ffffff;
        color: #374151;
        border: 1.5px solid #e5e7eb;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 500;
        font-family: 'DM Sans', sans-serif;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: background 0.2s, border-color 0.2s;
        text-decoration: none;
    }

    .btn-auth-google:hover {
        background: #f9fafb;
        border-color: #d1d5db;
        color: #374151;
        text-decoration: none;
    }

    .btn-auth-google svg {
        width: 18px;
        height: 18px;
        flex-shrink: 0;
    }

    /* Footer */
    .auth-footer {
        text-align: center;
        font-size: 13px;
        color: #6b7280;
        margin-top: 1.25rem;
    }

    .auth-footer a {
        color: #2563eb;
        font-weight: 500;
        text-decoration: none;
    }

    .auth-footer a:hover {
        text-decoration: underline;
    }
</style>

<div class="auth-page">
    <div class="auth-card">

        {{-- Logo --}}
        <div class="auth-logo-row">
            <div class="auth-logo-icon">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/>
                </svg>
            </div>
            <div class="auth-brand"><span>Smart</span> Learn</div>
        </div>

        {{-- Heading --}}
        <h2 class="auth-title">Welcome back</h2>
        <p class="auth-subtitle">Sign in to continue your learning journey</p>

        {{-- LOGIN FORM --}}
        <form action="{{ route('login.authenticate') }}" method="POST">
            @csrf

            @if ($errors->has('email'))
                <div class="auth-alert">
                    {{ $errors->first('email') }}
                </div>
            @endif

            <div class="auth-field">
                <label for="email">Email address</label>
                <input type="email" id="email" name="email" placeholder="you@example.com" required>
            </div>

            <div class="auth-field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>

            <div class="auth-row">
                <label class="auth-check-wrap">
                    <input type="checkbox" name="remember">
                    <span>Remember me</span>
                </label>
                <a href="/forgot-password" class="auth-forgot">Forgot password?</a>
            </div>

            <button type="submit" class="btn-auth-main">Sign In</button>
        </form>

        {{-- DIVIDER --}}
        <div class="auth-divider">
            <span>or</span>
        </div>

        {{-- SOCIAL LOGIN --}}
        <a href="{{ url('/auth/google') }}" class="btn-auth-google">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/>
                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
            </svg>
            Continue with Google
        </a>

        <p class="auth-footer">
            New to Smart Learning?
            <a href="/register">Join now</a>
        </p>

    </div>
</div>

@endsection