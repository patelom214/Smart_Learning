@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')

<style>
    /* Enhanced Profile Edit Styles */
    .edit-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 20px 20px 0 0;
        padding: 2.5rem 2rem;
        position: relative;
        overflow: hidden;
    }

    .edit-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,101.3C1248,85,1344,75,1392,69.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
        background-size: cover;
    }

    .profile-photo-wrapper {
        position: relative;
        display: inline-block;
        margin-bottom: 1rem;
    }

    .profile-photo-preview {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border: 5px solid white;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s;
    }

    .profile-photo-preview:hover {
        transform: scale(1.05);
    }

    .profile-placeholder {
        width: 150px;
        height: 150px;
        border: 5px solid white;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .photo-upload-overlay {
        position: absolute;
        bottom: 5px;
        right: 5px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        border: 3px solid white;
    }

    .photo-upload-overlay:hover {
        transform: scale(1.15) rotate(15deg);
    }

    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-control {
        border-radius: 10px;
        border: 2px solid #e9ecef;
        padding: 0.75rem 1rem;
        transition: all 0.3s;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
        transform: translateY(-2px);
    }

    .btn-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        padding: 0.75rem 2rem;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .btn-gradient:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-outline-gradient {
        background: transparent;
        border: 2px solid #667eea;
        color: #667eea;
        padding: 0.75rem 2rem;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.3s;
    }

    .btn-outline-gradient:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-color: transparent;
        transform: translateY(-3px);
    }

    .alert-success {
        background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
        border: 2px solid #667eea;
        border-radius: 15px;
        color: #667eea;
        font-weight: 500;
    }

    .photo-hint {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 1rem;
        margin-top: 1rem;
    }

    .char-counter {
        font-size: 0.85rem;
        color: #6c757d;
    }

    @media (max-width: 768px) {
        .edit-header {
            padding: 2rem 1rem;
        }

        .profile-photo-preview,
        .profile-placeholder {
            width: 120px;
            height: 120px;
        }
    }

    .back-btn {
        position: absolute;
        top: 20px;
        left: 20px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 50px;
        font-weight: 500;
        color: white;
        text-decoration: none;
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
        z-index: 2;
    }

    .back-btn:hover {
        background: white;
        color: #667eea;
        transform: translateX(-3px);
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">

            <div class="card shadow-lg border-0 overflow-hidden">
                <!-- Enhanced Header -->
                <div class="edit-header text-center">
                    <a href="{{ url('/index') }}" class="back-btn">
                        <i class="bi bi-arrow-left"></i>
                        <span>Back</span>
                    </a>
                    <div style="position: relative; z-index: 1;">
                        <h2 class="mb-2 fw-bold">
                            <i class="bi bi-pencil-square me-2"></i>Edit Profile
                        </h2>
                        <p class="mb-0 opacity-90">Update your personal information</p>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">

                    <!-- Success Message -->
                    @if(session('success'))
                    <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Profile Photo Section -->
                        <div class="text-center mb-4">
                            <div class="profile-photo-wrapper">
                                @if(Auth::user()->profile_photo)
                                <!-- Profile Image -->
                                <img src="{{ $user->profile_photo ?? asset('images/default.png') }}"
                                    class="rounded-circle border shadow"
                                    width="150"
                                    height="150"
                                    style="object-fit: cover;">

                                @else
                                <div class="rounded-circle profile-placeholder d-flex align-items-center justify-content-center mx-auto" id="photoPreview">
                                    <i class="bi bi-person-fill fs-1 text-white"></i>
                                </div>
                                @endif

                                <label for="profile_photo" class="photo-upload-overlay">
                                    <i class="bi bi-camera-fill fs-5"></i>
                                </label>
                            </div>

                            <input type="file"
                                name="profile_photo"
                                id="profile_photo"
                                class="d-none"
                                accept="image/*"
                                onchange="previewPhoto(event)">

                            <p class="text-muted small mt-2 mb-0">
                                <i class="bi bi-info-circle me-1"></i>
                                Click the camera icon to change your photo
                            </p>

                            @error('profile_photo')
                            <small class="text-danger d-block mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </small>
                            @enderror

                            <div class="photo-hint">
                                <small class="text-muted">
                                    <i class="bi bi-lightbulb me-1"></i>
                                    <strong>Tip:</strong> Use a clear photo where your face is visible. JPG, PNG, or GIF (max 2MB)
                                </small>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Name Field -->
                        <div class="mb-4">
                            <label class="form-label">
                                <i class="bi bi-person-fill text-primary"></i>
                                Full Name
                            </label>
                            <input type="text"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $user->name) }}"
                                placeholder="Enter your full name"
                                required>
                            @error('name')
                            <div class="invalid-feedback">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="mb-4">
                            <label class="form-label">
                                <i class="bi bi-envelope-fill text-primary"></i>
                                Email Address
                            </label>
                            <input type="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $user->email) }}"
                                placeholder="your.email@example.com"
                                required>
                            @error('email')
                            <div class="invalid-feedback">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Bio Field -->
                        <div class="mb-4">
                            <label class="form-label">
                                <i class="bi bi-chat-left-text-fill text-primary"></i>
                                Bio
                                <span class="badge bg-secondary ms-2">Optional</span>
                            </label>
                            <textarea name="bio"
                                class="form-control @error('bio') is-invalid @enderror"
                                rows="4"
                                id="bioField"
                                maxlength="500"
                                placeholder="Tell us about yourself... (Max 500 characters)">{{ old('bio', $user->bio ?? '') }}</textarea>

                            <div class="d-flex justify-content-between align-items-center mt-1">
                                @error('bio')
                                <small class="text-danger">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </small>
                                @else
                                <small class="text-muted">
                                    <i class="bi bi-chat-dots me-1"></i>
                                    Share your interests, skills, or a fun fact!
                                </small>
                                @enderror

                                <small class="char-counter">
                                    <span id="charCount">{{ strlen($user->bio ?? '') }}</span>/500
                                </small>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-3 justify-content-center flex-wrap mt-5">
                            <a href="{{ route('profile.show', ['user' => $user->id]) }}" class="btn btn-outline-gradient">
                                <i class="bi bi-x-circle me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-gradient">
                                <i class="bi bi-check-circle me-2"></i>Save Changes
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
    // Preview photo before upload
    function previewPhoto(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('photoPreview');

        if (file) {
            // Validate file size (2MB max)
            if (file.size > 2048000) {
                alert('File size must be less than 2MB!');
                event.target.value = '';
                return;
            }

            // Validate file type
            if (!file.type.match('image.*')) {
                alert('Please select an image file!');
                event.target.value = '';
                return;
            }

            const reader = new FileReader();

            reader.onload = function(e) {
                preview.outerHTML = `<img src="${e.target.result}" 
                                      class="rounded-circle profile-photo-preview"
                                      id="photoPreview"
                                      alt="Preview">`;
            }

            reader.readAsDataURL(file);
        }
    }

    // Character counter for bio
    document.addEventListener('DOMContentLoaded', function() {
        const bioField = document.getElementById('bioField');
        const charCount = document.getElementById('charCount');

        if (bioField && charCount) {
            bioField.addEventListener('input', function() {
                charCount.textContent = this.value.length;

                // Change color when approaching limit
                if (this.value.length > 450) {
                    charCount.classList.add('text-danger');
                    charCount.classList.remove('text-muted');
                } else {
                    charCount.classList.add('text-muted');
                    charCount.classList.remove('text-danger');
                }
            });
        }

        // Auto-hide success message
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert-success');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    });
</script>

@endsection