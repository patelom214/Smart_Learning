@extends('layouts.app')

@section('title', 'Join Smart Learning')

@push('styles')
<style>
.field-error { font-size:.73rem; color:#dc3545; margin-top:.25rem; display:none; }
.is-invalid  { border-color:#dc3545 !important; box-shadow:0 0 0 3px rgba(220,53,69,.1) !important; }

/* Toast */
#toast {
    position:fixed; top:1rem; right:1rem; z-index:9999;
    background:#fff; border-left:4px solid #dc3545;
    border-radius:10px; padding:.8rem 1.1rem;
    box-shadow:0 6px 24px rgba(0,0,0,.12);
    font-size:.82rem; max-width:320px;
    display:none; animation:tIn .3s ease;
}
#toast.show { display:block; }
@keyframes tIn { from{opacity:0;transform:translateX(20px)} to{opacity:1;transform:translateX(0)} }

/* Password strength */
#strengthBar { height:3px; border-radius:3px; width:0; transition:width .3s,background .3s; margin-top:5px; }
</style>
@endpush

@section('content')

<div id="toast"></div>
<div id="blade-errors"
     data-errors="{{ htmlspecialchars(json_encode($errors->all()), ENT_QUOTES, 'UTF-8') }}"
     style="display:none"></div>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg border-0 p-4" style="max-width:560px;width:100%">
        <h3 class="text-center mb-3">Make the most of your learning</h3>

        <form action="{{ route('register.store') }}" method="POST" id="regForm" novalidate>
            @csrf

            <!-- Name -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Full Name</label>
                <input type="text" name="name" id="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}" placeholder="Letters only">
                <div class="field-error" id="nameErr">
                    @error('name'){{ $message }}@else Name may only contain letters and spaces. @enderror
                </div>
                @error('name') <script>document.getElementById('nameErr').style.display='block'</script> @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Email Address</label>
                <input type="email" name="email" id="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" placeholder="you@example.com">
                <div class="field-error" id="emailErr">
                    @error('email'){{ $message }}@else Please enter a valid email. @enderror
                </div>
                @error('email') <script>document.getElementById('emailErr').style.display='block'</script> @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" name="password" id="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="Min. 8 characters">
                <div id="strengthBar"></div>
                <div class="field-error" id="passErr">
                    @error('password'){{ $message }}@else Password must be at least 8 characters. @enderror
                </div>
                @error('password') <script>document.getElementById('passErr').style.display='block'</script> @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Confirm Password</label>
                <input type="password" name="password_confirmation" id="confirm"
                       class="form-control" placeholder="Re-enter password">
                <div class="field-error" id="confirmErr">Passwords do not match.</div>
            </div>

            <!-- Bio -->
            <div class="mb-3">
                <label class="form-label fw-semibold">
                    Short Bio <span class="text-muted fw-normal">(optional)</span>
                </label>
                <textarea name="bio" id="bio"
                          class="form-control @error('bio') is-invalid @enderror"
                          rows="2" maxlength="300"
                          placeholder="Tell us a little about yourself...">{{ old('bio') }}</textarea>
                <div class="d-flex justify-content-between">
                    <div class="field-error @error('bio') d-block @enderror">@error('bio'){{ $message }}@enderror</div>
                    <small class="text-muted ms-auto" id="bioCount">{{ strlen(old('bio','')) }} / 300</small>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 rounded-pill">Agree &amp; Join</button>

            <p class="text-center mt-3 small">
                Already have an account? <a href="{{ route('login') }}">Sign in</a>
            </p>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Helpers
var $ = id => document.getElementById(id);

function err(inputId, errId, show) {
    $( inputId).classList.toggle('is-invalid', show);
    $(errId).style.display = show ? 'block' : 'none';
}

function toast(msg) {
    var t = $('toast');
    t.textContent = msg;
    t.classList.add('show');
    setTimeout(() => { t.classList.remove('show'); }, 4000);
}

// Name — block non-alpha as you type
$('name').addEventListener('input', function() {
    this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
    err('name', 'nameErr', this.value.trim() === '');
});

// Email — check on blur
$('email').addEventListener('blur', function() {
    var ok = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.value.trim());
    err('email', 'emailErr', !ok && this.value.trim() !== '');
});

// Password — strength bar
$('password').addEventListener('input', function() {
    var v = this.value, score = 0;
    if (v.length >= 8)           score++;
    if (/[A-Z]/.test(v))        score++;
    if (/[0-9]/.test(v))        score++;
    if (/[^a-zA-Z0-9]/.test(v)) score++;
    var colors = ['#e53e3e','#e53e3e','#d69e2e','#38a169','#276749'];
    var widths  = ['0%','30%','55%','78%','100%'];
    var bar = $('strengthBar');
    bar.style.width      = v.length ? widths[score] : '0%';
    bar.style.background = colors[score];
    err('password', 'passErr', v.length > 0 && v.length < 8);
    if ($('confirm').value) checkConfirm();
});

// Confirm match
function checkConfirm() {
    var match = $('password').value === $('confirm').value;
    err('confirm', 'confirmErr', !match && $('confirm').value !== '');
}
$('confirm').addEventListener('input', checkConfirm);

// Bio counter
$('bio').addEventListener('input', function() {
    $('bioCount').textContent = this.value.length + ' / 300';
});

// Submit gate
$('regForm').addEventListener('submit', function(e) {
    var ok = true;

    if (!/^[a-zA-Z\s]+$/.test($('name').value.trim())) {
        err('name', 'nameErr', true); ok = false;
    }
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test($('email').value.trim())) {
        err('email', 'emailErr', true); ok = false;
    }
    if ($('password').value.length < 8) {
        err('password', 'passErr', true); ok = false;
    }
    if ($('password').value !== $('confirm').value) {
        err('confirm', 'confirmErr', true); ok = false;
    }

    if (!ok) { e.preventDefault(); toast('Please fix the errors and try again.'); }
});

// Server errors → toast
var errs = JSON.parse($('blade-errors').dataset.errors || '[]');
errs.forEach(msg => toast(msg));
</script>
@endpush