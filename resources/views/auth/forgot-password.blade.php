@extends('layouts.app')

@section('title', 'Forgot Password')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">

<style>
    .fp-page {
        min-height: 100vh;
        background: linear-gradient(135deg, #e8f4fd 0%, #f0ebff 50%, #fde8f0 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'DM Sans', sans-serif;
        padding: 2rem;
    }

    .fp-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 2.5rem 2.25rem;
        width: 100%;
        max-width: 420px;
        border: 0.5px solid rgba(0, 0, 0, 0.08);
        box-shadow: 0 4px 40px rgba(0, 0, 0, 0.06);
    }

    .fp-logo-row {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 2rem;
    }

    .fp-logo-icon {
        width: 36px;
        height: 36px;
        background: #2563eb;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .fp-logo-icon svg {
        width: 20px;
        height: 20px;
        fill: white;
    }

    .fp-brand {
        font-size: 17px;
        font-weight: 500;
        color: #1a1a2e;
    }

    .fp-brand span { color: #2563eb; }

    .fp-icon-wrap {
        width: 56px;
        height: 56px;
        background: rgba(37, 99, 235, 0.08);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.25rem;
    }

    .fp-icon-wrap svg {
        width: 26px;
        height: 26px;
        fill: #2563eb;
    }

    .fp-title {
        font-family: 'Playfair Display', serif;
        font-size: 24px;
        font-weight: 600;
        color: #1a1a2e;
        margin-bottom: 0.35rem;
    }

    .fp-subtitle {
        font-size: 13.5px;
        color: #6b7280;
        line-height: 1.65;
        margin-bottom: 1.75rem;
    }

    .fp-alert-success {
        background: #f0fdf4;
        color: #166534;
        border: 1px solid #bbf7d0;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 13px;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: flex-start;
        gap: 8px;
    }

    .fp-alert-success svg {
        width: 16px;
        height: 16px;
        fill: #16a34a;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .fp-alert-danger {
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fecaca;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 13px;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: flex-start;
        gap: 8px;
    }

    .fp-alert-danger svg {
        width: 16px;
        height: 16px;
        fill: #dc2626;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .fp-field { margin-bottom: 1.25rem; }

    .fp-field label {
        display: block;
        font-size: 12.5px;
        font-weight: 500;
        color: #374151;
        margin-bottom: 6px;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }

    .fp-field input[type="email"] {
        width: 100%;
        padding: 11px 14px;
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
        font-family: 'DM Sans', sans-serif;
        color: #1a1a2e;
        background: #fafafa;
        transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
        outline: none;
    }

    .fp-field input[type="email"]:focus {
        border-color: #2563eb;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08);
    }

    .btn-fp-main {
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
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-fp-main:hover { background: #1d4ed8; }
    .btn-fp-main:active { transform: scale(0.99); }

    .btn-fp-main svg {
        width: 16px;
        height: 16px;
        fill: currentColor;
    }

    .fp-back {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        margin-top: 1.25rem;
        font-size: 13px;
        color: #6b7280;
        text-decoration: none;
        transition: color 0.2s;
    }

    .fp-back:hover {
        color: #2563eb;
        text-decoration: none;
    }

    .fp-back svg {
        width: 14px;
        height: 14px;
        fill: currentColor;
    }
</style>
@endpush

@section('content')

<div class="fp-page">
    <div class="fp-card">

        {{-- Logo --}}
        <div class="fp-logo-row">
            <div class="fp-logo-icon">
                <svg viewBox="0 0 24 24"><path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/></svg>
            </div>
            <div class="fp-brand"><span>Smart</span> Learn</div>
        </div>

        {{-- Icon --}}
        <div class="fp-icon-wrap">
            <svg viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
        </div>

        <h2 class="fp-title">Forgot Password?</h2>
        <p class="fp-subtitle">
            Enter your registered email and we'll send you a password reset link.
        </p>

        {{-- Success Message (original logic) --}}
        @if(session('success'))
            <div class="fp-alert-success">
                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14l-4-4 1.41-1.41L10 13.17l6.59-6.59L18 8l-8 8z"/></svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Error Message (original logic) --}}
        @if($errors->any())
            <div class="fp-alert-danger">
                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Form (original logic) --}}
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="fp-field">
                <label for="email">Email Address</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    placeholder="Enter your email"
                    required>
            </div>

            <button type="submit" class="btn-fp-main">
                <svg viewBox="0 0 24 24"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
                Send Reset Link
            </button>
        </form>

        {{-- Back to Login (original logic) --}}
        <a href="{{ route('login') }}" class="fp-back">
            <svg viewBox="0 0 24 24"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
            Back to Login
        </a>

    </div>
</div>

@endsection