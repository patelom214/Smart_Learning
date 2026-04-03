@extends('layouts.app')

@section('title', 'Join Smart Learning')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">

<style>
    .reg-page {
        min-height: 100vh;
        background: linear-gradient(135deg, #e8f4fd 0%, #f0ebff 50%, #fde8f0 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'DM Sans', sans-serif;
        padding: 2rem;
    }

    .reg-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 2.5rem 2.25rem;
        width: 100%;
        max-width: 580px;
        border: 0.5px solid rgba(0, 0, 0, 0.08);
        box-shadow: 0 4px 40px rgba(0, 0, 0, 0.06);
    }

    /* Logo */
    .reg-logo-row {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 2rem;
    }

    .reg-logo-icon {
        width: 36px;
        height: 36px;
        background: #2563eb;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .reg-logo-icon svg {
        width: 20px;
        height: 20px;
        fill: white;
    }

    .reg-brand {
        font-size: 17px;
        font-weight: 500;
        color: #1a1a2e;
    }

    .reg-brand span {
        color: #2563eb;
    }

    /* Title */
    .reg-title {
        font-family: 'Playfair Display', serif;
        font-size: 24px;
        font-weight: 600;
        color: #1a1a2e;
        margin-bottom: 0.25rem;
    }

    .reg-subtitle {
        font-size: 13.5px;
        color: #6b7280;
        margin-bottom: 1.75rem;
    }

    /* Fields */
    .reg-field {
        margin-bottom: 1.1rem;
    }

    .reg-field label {
        display: block;
        font-size: 12.5px;
        font-weight: 500;
        color: #374151;
        margin-bottom: 6px;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }

    .reg-field label .opt {
        font-size: 11px;
        color: #9ca3af;
        font-weight: 400;
        text-transform: none;
        letter-spacing: 0;
    }

    .reg-field input[type="text"],
    .reg-field input[type="email"],
    .reg-field input[type="password"],
    .reg-field textarea {
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
        resize: none;
    }

    .reg-field input:focus,
    .reg-field textarea:focus {
        border-color: #2563eb;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08);
    }

    .reg-field input.is-invalid,
    .reg-field textarea.is-invalid {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.08) !important;
    }

    /* Field error */
    .field-error {
        font-size: 12px;
        color: #dc3545;
        margin-top: 5px;
        display: none;
    }

    /* Strength bar */
    #strengthBar {
        height: 3px;
        border-radius: 3px;
        width: 0;
        transition: width 0.3s, background 0.3s;
        margin-top: 6px;
    }

    /* Bio counter row */
    .bio-footer {
        display: flex;
        justify-content: flex-end;
        margin-top: 4px;
    }

    .bio-footer small {
        font-size: 12px;
        color: #9ca3af;
    }

    /* Submit button */
    .btn-reg-main {
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
        margin-top: 0.5rem;
    }

    .btn-reg-main:hover {
        background: #1d4ed8;
    }

    .btn-reg-main:active {
        transform: scale(0.99);
    }

    /* Footer */
    .reg-footer {
        text-align: center;
        font-size: 13px;
        color: #6b7280;
        margin-top: 1.25rem;
    }

    .reg-footer a {
        color: #2563eb;
        font-weight: 500;
        text-decoration: none;
    }

    .reg-footer a:hover {
        text-decoration: underline;
    }

    /* Toast */
    #toast {
        position: fixed;
        top: 1rem;
        right: 1rem;
        z-index: 9999;
        background: #ffffff;
        border-left: 4px solid #dc3545;
        border-radius: 12px;
        padding: 0.85rem 1.1rem;
        box-shadow: 0 6px 24px rgba(0, 0, 0, 0.12);
        font-size: 13px;
        font-family: 'DM Sans', sans-serif;
        max-width: 320px;
        display: none;
        animation: tIn 0.3s ease;
    }

    #toast.show {
        display: block;
    }

    @keyframes tIn {
        from { opacity: 0; transform: translateX(20px); }
        to   { opacity: 1; transform: translateX(0); }
    }
</style>
@endpush

@section('content')

<div id="toast"></div>
<div id="blade-errors"
     data-errors="{{ htmlspecialchars(json_encode($errors->all()), ENT_QUOTES, 'UTF-8') }}"
     style="display:none"></div>

<div class="reg-page">
    <div class="reg-card">

        {{-- Logo --}}
        <div class="reg-logo-row">
            <div class="reg-logo-icon">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/>
                </svg>
            </div>
            <div class="reg-brand"><span>Smart</span> Learn</div>
        </div>

        {{-- Heading --}}
        <h2 class="reg-title">Create your account</h2>
        <p class="reg-subtitle">Make the most of your learning journey</p>

        <form action="{{ route('register.store') }}" method="POST" id="regForm" novalidate>
            @csrf

            {{-- Full Name --}}
            <div class="reg-field">
                <label for="name">Full Name</label>
                <input type="text" name="name" id="name"
                       class="@error('name') is-invalid @enderror"
                       value="{{ old('name') }}" placeholder="Letters only">
                <div class="field-error" id="nameErr">
                    @error('name'){{ $message }}@else Name may only contain letters and spaces. @enderror
                </div>
                @error('name') <script>document.getElementById('nameErr').style.display='block'</script> @enderror
            </div>

            {{-- Email --}}
            <div class="reg-field">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email"
                       class="@error('email') is-invalid @enderror"
                       value="{{ old('email') }}" placeholder="you@example.com">
                <div class="field-error" id="emailErr">
                    @error('email'){{ $message }}@else Please enter a valid email. @enderror
                </div>
                @error('email') <script>document.getElementById('emailErr').style.display='block'</script> @enderror
            </div>

            {{-- Password --}}
            <div class="reg-field">
                <label for="password">Password</label>
                <input type="password" name="password" id="password"
                       class="@error('password') is-invalid @enderror"
                       placeholder="Min. 8 characters">
                <div id="strengthBar"></div>
                <div class="field-error" id="passErr">
                    @error('password'){{ $message }}@else Password must be at least 8 characters. @enderror
                </div>
                @error('password') <script>document.getElementById('passErr').style.display='block'</script> @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="reg-field">
                <label for="confirm">Confirm Password</label>
                <input type="password" name="password_confirmation" id="confirm"
                       placeholder="Re-enter password">
                <div class="field-error" id="confirmErr">Passwords do not match.</div>
            </div>

            {{-- Bio --}}
            <div class="reg-field">
                <label for="bio">Short Bio <span class="opt">(optional)</span></label>
                <textarea name="bio" id="bio"
                          class="@error('bio') is-invalid @enderror"
                          rows="2" maxlength="300"
                          placeholder="Tell us a little about yourself...">{{ old('bio') }}</textarea>
                <div class="bio-footer">
                    <small id="bioCount">{{ strlen(old('bio', '')) }} / 300</small>
                </div>
                <div class="field-error @error('bio') d-block @enderror">@error('bio'){{ $message }}@enderror</div>
            </div>

            <button type="submit" class="btn-reg-main">Agree &amp; Join</button>

            <p class="reg-footer">
                Already have an account? <a href="{{ route('login') }}">Sign in</a>
            </p>
        </form>

    </div>
</div>

@endsection

@push('scripts')
<script>
var $ = id => document.getElementById(id);

function err(inputId, errId, show) {
    $(inputId).classList.toggle('is-invalid', show);
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