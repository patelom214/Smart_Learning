@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')

<div class="auth-wrapper">

    <h2 class="auth-title">Reset Your Password</h2>

    <!-- RESET PASSWORD FORM -->
    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $token }}">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email"
                   name="email"
                   class="form-control"
                   required
                   value="{{ request()->email ?? old('email') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">New Password</label>
            <input type="password"
                   name="password"
                   class="form-control"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password"
                   name="password_confirmation"
                   class="form-control"
                   required>
        </div>

        <button type="submit" class="btn btn-main w-100">
            Reset Password
        </button>
    </form>

    <div class="divider"><span>or</span></div>

    <p class="text-center mt-3 small">
        Remembered your password?
        <a href="{{ route('login') }}" class="fw-semibold text-primary text-decoration-none">
            Sign in
        </a>
    </p>

</div>

@endsection
