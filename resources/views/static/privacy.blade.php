@extends('layouts.app')

@section('title', 'Privacy Policy')

@section('content')
<div class="container py-5" style="max-width: 900px;">

    <!-- Header -->
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-shield-lock-fill me-2"></i>
            Privacy Policy
        </h2>
        <p class="text-muted">
            Your privacy and data protection are important to us.
        </p>
    </div>

    <!-- Card -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            <!-- Section -->
            <div class="mb-4">
                <h5 class="fw-bold">
                    <i class="bi bi-person-fill text-primary me-2"></i>
                    Information We Collect
                </h5>
                <p class="text-muted">
                    We collect basic personal information such as your name, email address,
                    profile photo, and other details you provide while creating or updating
                    your account. We also collect activity data like posts, comments,
                    likes, and connections to improve the platform experience.
                </p>
            </div>

            <!-- Section -->
            <div class="mb-4">
                <h5 class="fw-bold">
                    <i class="bi bi-gear-fill text-primary me-2"></i>
                    How We Use Your Information
                </h5>
                <ul class="text-muted">
                    <li>To create and manage your account</li>
                    <li>To personalize your learning experience</li>
                    <li>To connect you with other learners</li>
                    <li>To improve platform features and performance</li>
                    <li>To send important updates or notifications</li>
                </ul>
            </div>

            <!-- Section -->
            <div class="mb-4">
                <h5 class="fw-bold">
                    <i class="bi bi-lock-fill text-primary me-2"></i>
                    Data Protection
                </h5>
                <p class="text-muted">
                    We implement appropriate security measures to protect your personal
                    information from unauthorized access, alteration, disclosure, or destruction.
                    Your password is securely encrypted and never stored in plain text.
                </p>
            </div>

            <!-- Section -->
            <div class="mb-4">
                <h5 class="fw-bold">
                    <i class="bi bi-share-fill text-primary me-2"></i>
                    Information Sharing
                </h5>
                <p class="text-muted">
                    We do not sell or rent your personal information. Your data is only
                    shared when necessary to operate the platform, comply with legal
                    requirements, or protect the safety of users.
                </p>
            </div>

            <!-- Section -->
            <div class="mb-4">
                <h5 class="fw-bold">
                    <i class="bi bi-clock-history text-primary me-2"></i>
                    Data Retention
                </h5>
                <p class="text-muted">
                    We retain your information as long as your account is active or
                    as needed to provide services. You may request deletion of your
                    account at any time.
                </p>
            </div>

            <!-- Section -->
            <div>
                <h5 class="fw-bold">
                    <i class="bi bi-envelope-fill text-primary me-2"></i>
                    Contact Us
                </h5>
                <p class="text-muted mb-0">
                    If you have any questions about this Privacy Policy,
                    please contact us through the Contact page.
                </p>
            </div>

        </div>
    </div>

</div>
@endsection
