@extends('layouts.admin')

@section('title','Edit User')
@section('page-title','Edit User')

@push('styles')
<style>
.avatar-wrap { position: relative; width: 90px; margin: 0 auto 8px; }
.avatar-wrap img {
    width: 90px; height: 90px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #fff;
    box-shadow: 0 4px 14px rgba(102,126,234,.25);
    display: block;
}
.avatar-cam {
    position: absolute;
    bottom: 2px; right: 2px;
    width: 28px; height: 28px;
    background: linear-gradient(135deg,#667eea,#764ba2);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    border: 2px solid #fff;
    cursor: pointer;
    transition: transform .2s;
}
.avatar-cam:hover { transform: scale(1.12); }
.avatar-cam i { color: #fff; font-size: 12px; }
.avatar-cam input { position: absolute; inset: 0; opacity: 0; cursor: pointer; border-radius: 50%; }
</style>
@endpush

@section('content')

<div class="card shadow-sm border-0 rounded-4 p-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-0">Edit User</h5>
            <small class="text-muted">Update user details and role</small>
        </div>
        <a href="{{ route('admin.users.users') }}"
           class="btn btn-sm btn-light border rounded-3 px-3">← Back</a>
    </div>

    <form method="POST"
          action="{{ route('admin.users.update', $user->id) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- ── Profile Photo ── --}}
        <div class="mb-4 text-center">
            <div class="avatar-wrap">

                {{-- ✅ Check if photo exists in storage, else show generated avatar --}}
                @if($user->profile_photo && Storage::disk('public')->exists($user->profile_photo))
                    <img id="avatarPreview"
                         src="{{ $user->profile_photo 
                         ? asset(''.$user->profile_photo) 
                         : asset('images/default.png') }}"
                         alt="Profile Photo">
                @else
                    <img id="avatarPreview"
                         src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=667eea&color=fff&size=90"
                         alt="Profile Photo">
                @endif

                <label class="avatar-cam" title="Change photo">
                    <i class="bi bi-camera-fill"></i>
                    <input type="file" name="profile_photo" id="photoInput" accept="image/*">
                </label>
            </div>
            <small class="text-muted d-block">Click camera to change photo</small>
        </div>

        {{-- Name --}}
        <div class="mb-3">
            <label class="fw-semibold">Full Name</label>
            <input type="text"
                   name="name"
                   value="{{ old('name', $user->name) }}"
                   class="form-control rounded-3"
                   required>
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label class="fw-semibold">Email Address</label>
            <input type="email"
                   name="email"
                   value="{{ old('email', $user->email) }}"
                   class="form-control rounded-3"
                   required>
        </div>

        {{-- Role --}}
        <div class="mb-4">
            <label class="fw-semibold">Role</label>
            <select name="role" class="form-select rounded-3" required>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user"  {{ $user->role == 'user'  ? 'selected' : '' }}>User</option>
            </select>
        </div>

        {{-- Buttons --}}
        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.users.users') }}"
               class="btn btn-light border rounded-3 px-4">Cancel</a>
            <button type="submit"
                    class="btn text-white rounded-pill px-4"
                    style="background:linear-gradient(135deg,#667eea,#764ba2);">
                Update User
            </button>
        </div>

    </form>
</div>

@endsection

@push('scripts')
<script>
document.getElementById('photoInput').addEventListener('change', function () {
    const r = new FileReader();
    r.onload = e => document.getElementById('avatarPreview').src = e.target.result;
    r.readAsDataURL(this.files[0]);
});
</script>
@endpush