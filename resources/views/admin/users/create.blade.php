@extends('layouts.admin')

@section('title','Add User')
@section('page-title','Add User')

@push('styles')
<style>
/* ── Avatar ── */
.avatar-wrap {
    position: relative;
    width: 100px;
    height: 100px;
    margin: 0 auto 8px;
}
.avatar-circle {
    width: 100px; height: 100px;
    border-radius: 50%;
    border: 3px solid #fff;
    box-shadow: 0 4px 16px rgba(102,126,234,.25);
    overflow: hidden;
    background: linear-gradient(135deg, #eef0fd 0%, #dde2fa 100%);
    display: flex; align-items: center; justify-content: center;
}
.avatar-circle svg { width: 52px; height: 52px; opacity: .55; flex-shrink: 0; }
.avatar-circle img {
    width: 100%; height: 100%;
    object-fit: cover; border-radius: 50%;
    display: none;
    position: absolute; inset: 0;
}
.avatar-cam {
    position: absolute; bottom: 0; right: 0;
    width: 30px; height: 30px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    border: 2px solid #fff; cursor: pointer;
    transition: transform .2s, box-shadow .2s; z-index: 5;
}
.avatar-cam:hover { transform: scale(1.13); box-shadow: 0 4px 12px rgba(102,126,234,.45); }
.avatar-cam svg { width: 14px; height: 14px; stroke: #fff; fill: none; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; pointer-events: none; }
.avatar-cam input { position: absolute; inset: 0; opacity: 0; cursor: pointer; border-radius: 50%; }

/* ── Input error state ── */
.form-control.is-invalid,
.form-select.is-invalid {
    border-color: #dc3545;
    background-image: none;
    box-shadow: 0 0 0 3px rgba(220,53,69,.1);
}
.field-error {
    font-size: .75rem;
    color: #dc3545;
    margin-top: .3rem;
    display: flex;
    align-items: center;
    gap: .3rem;
}
.field-error svg { width: 13px; height: 13px; flex-shrink: 0; }

/* ── Toast popup ── */
.toast-stack {
    position: fixed;
    top: 1.25rem; right: 1.25rem;
    z-index: 9999;
    display: flex;
    flex-direction: column;
    gap: .6rem;
    pointer-events: none;
}
.toast-popup {
    display: flex;
    align-items: flex-start;
    gap: .75rem;
    background: #fff;
    border: 1px solid #fde8e8;
    border-left: 4px solid #e53e3e;
    border-radius: 12px;
    padding: .9rem 1.1rem;
    min-width: 300px;
    max-width: 380px;
    box-shadow: 0 8px 32px rgba(0,0,0,.12);
    pointer-events: all;
    animation: slideIn .35s cubic-bezier(.22,.68,0,1.2) both;
}
.toast-popup.toast-success {
    border-color: #c6f6d5;
    border-left-color: #38a169;
}
@keyframes slideIn {
    from { opacity: 0; transform: translateX(30px); }
    to   { opacity: 1; transform: translateX(0); }
}
@keyframes slideOut {
    from { opacity: 1; transform: translateX(0); }
    to   { opacity: 0; transform: translateX(30px); }
}
.toast-popup.hiding { animation: slideOut .28s ease forwards; }

.toast-icon {
    width: 34px; height: 34px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    background: #fff5f5;
}
.toast-popup.toast-success .toast-icon { background: #f0fff4; }
.toast-icon svg { width: 17px; height: 17px; }

.toast-body { flex: 1; min-width: 0; }
.toast-title {
    font-size: .82rem;
    font-weight: 700;
    color: #1e2340;
    margin: 0 0 .15rem;
}
.toast-msg {
    font-size: .77rem;
    color: #5a6080;
    margin: 0;
    line-height: 1.45;
}
.toast-close {
    background: none; border: none; cursor: pointer;
    color: #9ea5c0; padding: 0; line-height: 1;
    transition: color .15s; flex-shrink: 0;
}
.toast-close:hover { color: #1e2340; }
.toast-close svg { width: 15px; height: 15px; display: block; }

/* ── Highlight email field when duplicate ── */
.input-shake {
    animation: shake .4s cubic-bezier(.36,.07,.19,.97) both;
}
@keyframes shake {
    10%, 90% { transform: translateX(-2px); }
    20%, 80% { transform: translateX(4px); }
    30%, 50%, 70% { transform: translateX(-5px); }
    40%, 60% { transform: translateX(5px); }
}
</style>
@endpush

@section('content')

{{-- ── Toast Stack ── --}}
<div class="toast-stack" id="toastStack"></div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <form method="POST"
              action="{{ route('admin.users.store') }}"
              enctype="multipart/form-data"
              id="createUserForm">
            @csrf

            {{-- ── Avatar ── --}}
            <div class="mb-4 text-center">
                <div class="avatar-wrap">
                    <div class="avatar-circle" id="avatarCircle">
                        <svg id="avatarIcon" viewBox="0 0 24 24" fill="none"
                             stroke="#667eea" stroke-width="1.5"
                             stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="8" r="4"/>
                            <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                        </svg>
                        <img id="avatarPreview" src="" alt="Preview">
                    </div>
                    <label class="avatar-cam" title="Upload photo">
                        <svg viewBox="0 0 24 24">
                            <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                            <circle cx="12" cy="13" r="4"/>
                        </svg>
                        <input type="file" name="profile_photo" id="photoInput" accept="image/*">
                    </label>
                </div>
                <small class="text-muted d-block mt-1">Click camera to upload photo</small>
            </div>

            {{-- ── Name ── --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Name</label>
                <input type="text" name="name" id="nameInput"
                       class="form-control rounded-3 @error('name') is-invalid @enderror"
                       value="{{ old('name') }}" required>
                @error('name')
                    <div class="field-error">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#dc3545" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                        </svg>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- ── Email ── --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" id="emailInput"
                       class="form-control rounded-3 @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" required>
                @error('email')
                    <div class="field-error">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#dc3545" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                        </svg>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- ── Password ── --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" name="password" id="passwordInput"
                       class="form-control rounded-3 @error('password') is-invalid @enderror"
                       required>
                @error('password')
                    <div class="field-error">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#dc3545" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                        </svg>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- ── Role ── --}}
            <div class="mb-4">
                <label class="form-label fw-semibold">Role</label>
                <select name="role" class="form-select rounded-3">
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <button type="submit" class="btn text-white rounded-pill px-4"
                    style="background: linear-gradient(135deg,#667eea,#764ba2);">
                Create User
            </button>
            <a href="{{ route('admin.users.users') }}"
               class="btn btn-light border rounded-pill px-4 ms-2">Cancel</a>

        </form>
    </div>
    {{-- Hidden error data element --}}
<div id="blade-errors"
     data-errors="{{ htmlspecialchars(json_encode($errors->all()), ENT_QUOTES, 'UTF-8') }}"
     style="display:none"></div>
</div>

@endsection

@push('scripts')
<script>
/* ── Avatar preview ── */
document.getElementById('photoInput').addEventListener('change', function () {
    if (!this.files[0]) return;
    const r = new FileReader();
    r.onload = e => {
        document.getElementById('avatarPreview').src = e.target.result;
        document.getElementById('avatarPreview').style.display = 'block';
        document.getElementById('avatarIcon').style.display    = 'none';
    };
    r.readAsDataURL(this.files[0]);
});

/* ── Toast helper ── */
function showToast(title, message, type = 'error') {
    const stack = document.getElementById('toastStack');

    const isError = type === 'error';
    const iconSvg = isError
        ? `<svg viewBox="0 0 24 24" fill="none" stroke="#e53e3e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
               <circle cx="12" cy="12" r="10"/>
               <line x1="15" y1="9" x2="9" y2="15"/>
               <line x1="9" y1="9" x2="15" y2="15"/>
           </svg>`
        : `<svg viewBox="0 0 24 24" fill="none" stroke="#38a169" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
               <circle cx="12" cy="12" r="10"/>
               <polyline points="9 12 11 14 15 10"/>
           </svg>`;

    const toast = document.createElement('div');
    toast.className = 'toast-popup' + (isError ? '' : ' toast-success');
    toast.innerHTML = `
        <div class="toast-icon">${iconSvg}</div>
        <div class="toast-body">
            <p class="toast-title">${title}</p>
            <p class="toast-msg">${message}</p>
        </div>
        <button class="toast-close" onclick="dismissToast(this.closest('.toast-popup'))">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>`;

    stack.appendChild(toast);

    // Shake the email field on duplicate email error
    if (message.toLowerCase().includes('email') && message.toLowerCase().includes('taken') ||
        message.toLowerCase().includes('already')) {
        const emailEl = document.getElementById('emailInput');
        if (emailEl) {
            emailEl.classList.add('is-invalid', 'input-shake');
            emailEl.addEventListener('animationend', () => emailEl.classList.remove('input-shake'), { once: true });
        }
    }

    // Auto-dismiss after 5 s
    setTimeout(() => dismissToast(toast), 5000);
}

function dismissToast(toast) {
    if (!toast || toast.classList.contains('hiding')) return;
    toast.classList.add('hiding');
    toast.addEventListener('animationend', () => toast.remove(), { once: true });
}
// Name field — allow only alphabetic characters + spaces
document.getElementById('nameInput').addEventListener('input', function () {
    // Strip any non-alpha, non-space character as user types
    var cleaned = this.value.replace(/[^a-zA-Z\s]/g, '');
    if (this.value !== cleaned) {
        this.value = cleaned;
        showNameError('Name may only contain alphabetic characters and spaces.');
    } else {
        clearNameError();
    }
});

document.getElementById('nameInput').addEventListener('blur', function () {
    if (this.value.trim() === '') {
        showNameError('Name is required.');
    } else if (!/^[a-zA-Z\s]+$/.test(this.value)) {
        showNameError('Name may only contain alphabetic characters and spaces.');
    } else {
        clearNameError();
    }
});

function showNameError(msg) {
    var input = document.getElementById('nameInput');
    input.classList.add('is-invalid');

    var existing = document.getElementById('nameError');
    if (existing) { existing.querySelector('.name-err-msg').textContent = msg; return; }

    var div = document.createElement('div');
    div.className = 'field-error';
    div.id = 'nameError';
    div.innerHTML =
        '<svg viewBox="0 0 24 24" fill="none" stroke="#dc3545" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:13px;height:13px;flex-shrink:0">' +
            '<circle cx="12" cy="12" r="10"/>' +
            '<line x1="12" y1="8" x2="12" y2="12"/>' +
            '<line x1="12" y1="16" x2="12.01" y2="16"/>' +
        '</svg>' +
        '<span class="name-err-msg">' + msg + '</span>';
    input.insertAdjacentElement('afterend', div);
}

function clearNameError() {
    document.getElementById('nameInput').classList.remove('is-invalid');
    var existing = document.getElementById('nameError');
    if (existing) existing.remove();
}
// Read errors safely from data attribute
var errorsEl = document.getElementById('blade-errors');
if (errorsEl) {
    var errors = JSON.parse(errorsEl.getAttribute('data-errors') || '[]');
    errors.forEach(function(msg) {
        showToast('Validation Error', msg, 'error');
    });
}
</script>
@endpush