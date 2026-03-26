@extends('layouts.admin')

@section('title', 'Likes')
@section('page-title', 'All Likes')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="rounded-4 p-4 mb-4 text-white"
        style="background:var(--gradient); box-shadow:0 10px 30px rgba(102,126,234,.35);">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold mb-1">All Likes</h4>
                <p class="mb-0 opacity-75 small">
                    Manage all user post likes
                </p>
            </div>

            <a href="{{ route('admin.dashboard') }}"
                class="btn btn-light btn-sm rounded-pill px-3 fw-semibold">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
    <div class="alert alert-success rounded-3 shadow-sm">
        {{ session('success') }}
    </div>
    @endif

    {{-- Likes List --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">User</th>
                            <th>Post</th>
                            <th>Date</th>
                            <th class="text-end pe-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse($likes as $like)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-2">
                                    @if($like->user->profile_photo)
                                    <img src="{{ asset('storage/'.$like->user->profile_photo) }}"
                                        width="35" height="35"
                                        class="rounded-circle">
                                    @else
                                    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center"
                                        style="width:35px;height:35px;font-size:13px;">
                                        {{ strtoupper(substr($like->user->name,0,1)) }}
                                    </div>
                                    @endif
                                    <span class="fw-semibold">
                                        {{ $like->user->name }}
                                    </span>
                                </div>
                            </td>

                            <td>
                                <span class="text-muted small">
                                    {{ Str::limit($like->post->title ?? 'No Title', 40) }}
                                </span>
                            </td>

                            <td>
                                <small class="text-muted">
                                    {{ $like->created_at->diffForHumans() }}
                                </small>
                            </td>

                            <td class="text-end pe-4">
                                <form method="POST"
                                    action="{{ route('admin.likes.delete', $like->id) }}"
                                    onsubmit="return confirm('Remove this like?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="bi bi-heart fs-3"></i>
                                <p class="mt-2 mb-0">No likes found</p>
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4">
        {{ $likes->links() }}
    </div>

</div>

@endsection