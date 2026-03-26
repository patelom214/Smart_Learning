@extends('layouts.app')

@section('title', 'Terms & Conditions')

@section('content')
<div class="container py-5" style="max-width: 900px;">

    <!-- Header -->
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-file-text-fill me-2"></i>
            Terms & Conditions
        </h2>
        <p class="text-muted">
            Please read these terms carefully before using the platform.
        </p>
    </div>

    <!-- Card -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            <!-- Section -->
            <div class="mb-4">
                <h5 class="fw-bold">
                    <i class="bi bi-person-check-fill text-primary me-2"></i>
                    User Responsibilities
                </h5>
                <p class="text-muted">
                    By using this platform, you agree to provide accurate information,
                    respect other users, and use the platform only for educational
                    and professional purposes.
                </p>
            </div>

            <!-- Section -->
            <div class="mb-4">
                <h5 class="fw-bold">
                    <i class="bi bi-chat-dots-fill text-primary me-2"></i>
                    Content Guidelines
                </h5>
                <ul class="text-muted">
                    <li>No offensive, harmful, or illegal content</li>
                    <li>No spam or misleading information</li>
                    <li>Respect intellectual property rights</li>
                    <li>Maintain a positive learning environment</li>
                </ul>
            </div>

            <!-- Section -->
            <div class="mb-4">
                <h5 class="fw-bold">
                    <i class="bi bi-shield-exclamation text-primary me-2"></i>
                    Account Security
                </h5>
                <p class="text-muted">
                    You are responsible for maintaining the confidentiality of your
                    account credentials. Any activity performed through your account
                    is considered your responsibility.
                </p>
            </div>

            <!-- Section -->
            <div class="mb-4">
                <h5 class="fw-bold">
                    <i class="bi bi-ban text-primary me-2"></i>
                    Prohibited Activities
                </h5>
                <ul class="text-muted">
                    <li>Harassment or abuse of other users</li>
                    <li>Posting false or misleading information</li>
                    <li>Attempting to hack or disrupt the platform</li>
                    <li>Using the platform for illegal activities</li>
                </ul>
            </div>

            <!-- Section -->
            <div class="mb-4">
                <h5 class="fw-bold">
                    <i class="bi bi-exclamation-circle-fill text-primary me-2"></i>
                    Limitation of Liability
                </h5>
                <p class="text-muted">
                    The platform is provided “as is” without warranties.
                    We are not responsible for any damages resulting from
                    the use of the platform.
                </p>
            </div>

            <!-- Section -->
            <div>
                <h5 class="fw-bold">
                    <i class="bi bi-arrow-repeat text-primary me-2"></i>
                    Changes to Terms
                </h5>
                <p class="text-muted mb-0">
                    We may update these Terms & Conditions at any time.
                    Continued use of the platform means you accept the changes.
                </p>
            </div>

        </div>
    </div>

</div>
@endsection
