@extends('layouts.admin')

@section('title','Create Post')
@section('page-title','Create Post')

@push('styles')
<style>
:root {
    --gradient: linear-gradient(135deg,#667eea,#764ba2);
}

/* Card */
.post-create-card {
    border-radius: 18px;
    overflow: hidden;
}

/* Step header */
.step-pill {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #e9ecef;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: .85rem;
}

.step-pill.active {
    background: var(--gradient);
    color: #fff;
}

.step-label {
    font-size: .9rem;
    font-weight: 600;
    color: #6c757d;
}

.step-label.active {
    color: #000;
}

/* Form inputs */
.form-control:focus,
.form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 .2rem rgba(102,126,234,.2);
}

/* Next button */
.btn-gradient {
    background: var(--gradient);
    color: #fff;
    border-radius: 10px;
    padding: .6rem 1.8rem;
    font-weight: 600;
    border: none;
}
@media (max-width: 768px) {
    .form-control-lg {
        font-size: 14px;
        padding: 10px;
    }

    .btn-gradient {
        width: 100%;
        text-align: center;
    }
}

.btn-gradient:hover {
 opacity: .9;
}
@media (max-width: 768px) {
    .post-create-card .card-body {
        padding: 16px !important;
    }
}
@media (max-width: 768px) {
    .step-nav {
        flex-wrap: wrap;
        gap: 10px;
    }

    .step-nav .border-bottom {
        display: none; /* remove lines on mobile */
    }

    .step-label {
        font-size: .75rem;
    }

    .step-pill {
        width: 26px;
        height: 26px;
        font-size: .7rem;
    }
}
@media (max-width: 768px) {
    .btn-cancel {
        padding: 4px 8px;
        font-size: 12px;
    }
}
</style>
@endpush

@section('content')

<div class="card post-create-card shadow-sm border-0">

    <div class="card-body p-4">

        {{-- Step Navigation --}}
        <div class="d-flex align-items-center mb-4 gap-3 step-nav flex-wrap">
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('admin.posts') }}" class="btn btn-light border btn-cancel">
                    ← Back
                </a>
            </div>
            <div class="d-flex align-items-center gap-2">
                <div class="step-pill active">1</div>
                <div class="step-label active">Summarize</div>
            </div>

            <div class="flex-grow-1 border-bottom mx-3"></div>

            <div class="d-flex align-items-center gap-2">
                <div class="step-pill">2</div>
                <div class="step-label">Details</div>
            </div>

            <div class="flex-grow-1 border-bottom mx-3"></div>

            <div class="d-flex align-items-center gap-2">
                <div class="step-pill">3</div>
                <div class="step-label">Type & Tags</div>
            </div>

        </div>

        <form method="POST" action="{{ route('admin.posts.store') }}">
            @csrf

            {{-- STEP 1 --}}
            <div id="step1">
                <div class="mb-4">
                    <label class="fw-semibold mb-2">Post Title *</label>
                    <small class="text-muted d-block mb-2">
                        Be specific — minimum 15 characters
                    </small>

                    <input type="text"
                           name="title"
                           id="titleInput"
                           maxlength="200"
                           class="form-control form-control-lg rounded-3"
                           placeholder="e.g. How to optimize Laravel performance?"
                           required>

                    <div class="text-end text-muted small mt-1">
                        <span id="charCount">0</span> / 200
                    </div>
                </div>

                <div class="text-end">
                    <button type="button" class="btn btn-gradient" onclick="nextStep(2)">
                        Next →
                    </button>
                </div>
            </div>

            {{-- STEP 2 --}}
            <div id="step2" style="display:none;">
                <div class="mb-4">
                    <label class="fw-semibold mb-2">Post Details *</label>
                    <textarea name="content"
                              rows="6"
                              class="form-control rounded-3"
                              placeholder="Explain your post clearly..."
                              required></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-light rounded-3 px-4" onclick="nextStep(1)">
                        ← Back
                    </button>
                    <button type="button" class="btn btn-gradient" onclick="nextStep(3)">
                        Next →
                    </button>
                </div>
            </div>

            {{-- STEP 3 --}}
            <div id="step3" style="display:none;">
                <div class="mb-3">
                    <label class="fw-semibold">Type</label>
                    <select name="type" class="form-select rounded-3">
                        <option value="public">public</option>
                        <option value="friends">friends</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="fw-semibold">Tags (comma separated)</label>
                    <input type="text"
                           name="tags"
                           class="form-control rounded-3"
                           placeholder="laravel, php, backend">
                </div>

                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-light rounded-3 px-4" onclick="nextStep(2)">
                        ← Back
                    </button>

                    <button type="submit" class="btn btn-gradient">
                        Publish Post
                    </button>
                </div>
            </div>

        </form>

    </div>
</div>

@endsection


@push('scripts')
<script>
// Character counter
const titleInput = document.getElementById('titleInput');
const charCount = document.getElementById('charCount');

titleInput.addEventListener('input', function(){
    charCount.innerText = this.value.length;
});

// Step switching
function nextStep(step){

    // Hide all steps
    document.getElementById('step1').style.display = 'none';
    document.getElementById('step2').style.display = 'none';
    document.getElementById('step3').style.display = 'none';

    // Show selected step
    document.getElementById('step' + step).style.display = 'block';

    // Remove active class from all step pills & labels
    document.querySelectorAll('.step-pill').forEach(el => {
        el.classList.remove('active');
    });

    document.querySelectorAll('.step-label').forEach(el => {
        el.classList.remove('active');
    });

    // Add active class to current step
    document.querySelectorAll('.step-pill')[step-1].classList.add('active');
    document.querySelectorAll('.step-label')[step-1].classList.add('active');
}
</script>
@endpush