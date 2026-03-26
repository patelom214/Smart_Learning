@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg border-0 p-4" style="max-width:420px; width:100%;">
        
        <!-- Title -->
        <h3 class="text-center mb-2">Forgot Password?</h3>
        <p class="text-center text-muted mb-4">
            Enter your registered email and we’ll send you a password reset link.
        </p>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Message -->
        @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input 
                    type="email" 
                    name="email" 
                    class="form-control" 
                    placeholder="Enter your email"
                    required
                >
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-primary w-100 rounded-pill">
                Send Reset Link
            </button>
        </form>

        <!-- Back to Login -->
        <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="text-decoration-none">
                ← Back to Login
            </a>
        </div>
    </div>
</div>
@endsection
