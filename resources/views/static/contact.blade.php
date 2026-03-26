@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<style>
    .contact-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    }

    .contact-header {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 40px;
        border-radius: 20px 20px 0 0;
        text-align: center;
    }

    .form-control {
        border-radius: 12px;
    }

    .btn-gradient {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 10px 25px;
    }

    .btn-gradient:hover {
        opacity: 0.9;
    }
</style>

<div class="container py-5" style="max-width: 700px;">

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <h3 class="fw-bold mb-3 text-primary">
                <i class="bi bi-envelope-paper-fill me-2"></i>
                Get in Touch
            </h3>

            <p class="text-muted mb-3">
                We’d love to hear from you! Whether you have a question, feedback, or
                need help using the platform, our team is here to support you.
            </p>

            <ul class="list-unstyled text-muted small mb-3">
                <li class="mb-2">
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    Report a technical issue
                </li>
                <li class="mb-2">
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    Share feedback or suggestions
                </li>
                <li class="mb-2">
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    Ask questions about features
                </li>
                <li>
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    Request collaboration or partnership
                </li>
            </ul>

            <p class="text-muted small mb-0">
                Fill out the form below and we’ll get back to you as soon as possible.
            </p>
        </div>
    </div>


    <div class="card contact-card">
        <div class="contact-header">
            <h3 class="fw-bold mb-2">Contact Us</h3>
            <p class="mb-0">
                Have questions or suggestions? We’d love to hear from you.
            </p>
        </div>

        <div class="card-body p-4">

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <form method="POST" action="{{ route('contact.send') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Your Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Email Address</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Message</label>
                    <textarea name="message" rows="4" class="form-control" required></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-gradient">
                        Send Message
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection