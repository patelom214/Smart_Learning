@extends('layouts.app')

@section('title', 'Sign In')

@section('content')

<div class="auth-wrapper">

    <h2 class="auth-title">
        Sign in to Smart Learning
    </h2>

    <!-- LOGIN FORM -->
    <form action="{{ route('login.authenticate') }}" method="POST">
        @csrf
        @if ($errors->has('email'))
        <div class="alert alert-danger">
            {{ $errors->first('email') }}
        </div>
        @endif
        <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember">
                <label class="form-check-label small">
                    Remember me
                </label>
            </div>

            <a href="/forgot-password" class="small text-decoration-none">
                Forgot password?
            </a>
        </div>

        <button class="btn btn-main w-100">
            Sign In
        </button>
    </form>

    <!-- DIVIDER -->
    <div class="divider">
        <span>or</span>
    </div>

    <!-- SOCIAL LOGIN (UI ONLY) -->
    <button class="social-btn w-100 mb-2"><a href="{{ url('/auth/google') }}" style="text-decoration: none; color: inherit;">
            <img src="https://img.icons8.com/color/20/google-logo.png" />
            Continue with Google
        </a></button>

    <p class="text-center mt-3 small">
        New to Smart Learning?
        <a href="/register" class="fw-semibold text-primary text-decoration-none">
            Join now
        </a>
    </p>

</div>

@endsection