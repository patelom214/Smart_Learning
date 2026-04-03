@extends('layouts.app')

@section('title', 'Reset Password')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">

<style>
    .rp-page {
        min-height: 100vh;
        background: linear-gradient(135deg, #e8f4fd 0%, #f0ebff 50%, #fde8f0 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'DM Sans', sans-serif;
        padding: 2rem;
    }

    .rp-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 2.5rem 2.25rem;
        width: 100%;
        max-width: 420px;
        border: 0.5px solid rgba(0, 0, 0, 0.08);
        box-shadow: 0 4px 40px rgba(0, 0, 0, 0.06);
    }

    .rp-logo-row {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 2rem;
    }

    .rp-logo-icon {
        width: 36px;
        height: 36px;
        background: #2563eb;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .rp-logo-icon svg {
        width: 20px;
        height: 20px;
        fill: white;
    }

    .rp-brand {
        font-size: 17px;
        font-weight: 500;
        color: #1a1a2e;
    }

    .rp-brand span { color: #2563eb; }

    .rp-icon-wrap {
        width: 56px;
        height: 56px;
        background: rgba(37, 99, 235, 0.08);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.25rem;
    }

    .rp-icon-wrap svg {
        width: 26px;
        height: 26px;
        fill: #2563eb;
    }

    .rp-title {
        font-family: 'Playfair Display', serif;
        font-size: 24px;
        font-weight: 600;
        color: #1a1a2e;
        margin-bottom: 0.35rem;
    }

    .rp-subtitle {
        font-size: 13.5px;
        color: #6b7280;
        line-height: 1.65;
        margin-bottom: 1.75rem;
    }

    /* Error alert */
    .rp-alert-danger {
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

    .rp-alert-danger svg {
        width: 16px;
        height: 16px;
        fill: #dc2626;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .rp-alert-danger ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .rp-alert-danger ul li + li {
        margin-top: 4px;
    }

    /* Fields */
    .rp-field { margin-bottom: 1.1rem; }

    .rp-field label {
        display: block;
        font-size: 12.5px;
        font-weight: 500;
        color: #374151;
        margin-bottom: 6px;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }

    .rp-field input {
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

    .rp-field input:focus {
        border-color: #2563eb;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08);
    }

    /* Read-only email field */
    .rp-field input[readonly] {
        background: #f3f4f6;
        color: #6b7280;
        cursor: default;
    }

    .rp-field input[readonly]:focus {
        border-color: #e5e7eb;
        box-shadow: none;
    }

    /* Submit */
    .btn-rp-main {
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
        margin-top: 0.5rem;
    }

    .btn-rp-main:hover { background: #1d4ed8; }
    .btn-rp-main:active { transform: scale(0.99); }
    .btn-rp-main svg { width: 16px; height: 16px; fill: currentColor; }

    /* Divider */
    .rp-divider {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 1.25rem 0;
    }

    .rp-divider::before,
    .rp-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #e5e7eb;
    }

    .rp-divider span {
        font-size: 12px;
        color: #9ca3af;
    }

    /* Footer */
    .rp-footer {
        text-align: center;
        font-size: 13px;
        color: #6b7280;
    }

    .rp-footer a {
        color: #2563eb;
        font-weight: 500;
        text-decoration: none;
    }

    .rp-footer a:hover { text-decoration: underline; }
</style>
@endpush

@section('content')

<div class="rp-page">
    <div class="rp-card">

        {{-- Logo --}}
        <div class="rp-logo-row">
            <div class="rp-logo-icon">
                <svg viewBox="0 0 24 24"><path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/></svg>
            </div>
            <div class="rp-brand"><span>Smart</span> Learn</div>
        </div>

        {{-- Icon --}}
        <div class="rp-icon-wrap">
            <svg viewBox="0 0 24 24"><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/></svg>
        </div>

        <h2 class="rp-title">Reset Your Password</h2>
        <p class="rp-subtitle">Choose a strong new password for your account.</p>

        {{-- RESET PASSWORD FORM (original logic) --}}
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            {{-- Password Reset Token (original logic) --}}
            <input type="hidden" name="token" value="{{ $token }}">

            {{-- Error messages (original logic) --}}
            @if ($errors->any())
                <div class="rp-alert-danger">
                    <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="rp-field">
                <label for="email">Email Address</label>
                <input type="email"
                       name="email"
                       id="email"
                       required
                       value="{{ request()->email ?? old('email') }}">
            </div>

            <div class="rp-field">
                <label for="password">New Password</label>
                <input type="password"
                       name="password"
                       id="password"
                       placeholder="Min. 8 characters"
                       required>
            </div>

            <div class="rp-field">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password"
                       name="password_confirmation"
                       id="password_confirmation"
                       placeholder="Re-enter new password"
                       required>
            </div>

            <button type="submit" class="btn-rp-main">
                <svg viewBox="0 0 24 24"><path d="M17 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V7l-4-4zm-5 16c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm3-10H5V5h10v4z"/></svg>
                Reset Password
            </button>
        </form>

        {{-- Divider --}}
        <div class="rp-divider"><span>or</span></div>

        {{-- Back to login (original logic) --}}
        <p class="rp-footer">
            Remembered your password?
            <a href="{{ route('login') }}">Sign in</a>
        </p>

    </div>
</div>

@endsection