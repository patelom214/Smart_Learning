@extends('layouts.admin')

@section('title', 'Comments')
@section('page-title', 'All Comments')

@section('content')

<div class="container-fluid py-4">

    {{-- Gradient Header --}}
    <div class="rounded-4 p-4 mb-4 text-white"
        style="background:var(--gradient); box-shadow:0 10px 30px rgba(102,126,234,.35);">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold mb-1">All Comments</h4>
                <p class="mb-0 opacity-75 small">
                    Manage user comments across the platform
                </p>
            </div>

            <a href="{{ route('admin.dashboard') }}"
                class="btn btn-light btn-sm rounded-pill px-3 fw-semibold">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>

    {{-- Comments Card --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">User</th>
                            <th>Comment</th>
                            <th>Post</th>
                            <th>Date</th>
                            <th class="text-end pe-4">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($comments as $comment)
                        <tr>

                            {{-- User --}}
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-2">
                                    @if($comment->user->profile_photo)
                                    <img src="{{ asset('storage/'.$comment->user->profile_photo) }}"
                                        width="35" height="35"
                                        class="rounded-circle">
                                    @else
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                        style="width:35px;height:35px;font-size:13px;">
                                        {{ strtoupper(substr($comment->user->name,0,1)) }}
                                    </div>
                                    @endif

                                    <span class="fw-semibold">
                                        {{ $comment->user->name }}
                                    </span>
                                </div>
                            </td>

                            {{-- Comment Text --}}
                            <td>
                                <span class="text-muted small">
                                    {{ \Illuminate\Support\Str::limit($comment->comment, 60) }}
                                </span>
                            </td>

                            {{-- Post --}}
                            <td>
                                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill">
                                    Post #{{ $comment->post->id }}
                                </span>
                            </td>

                            {{-- Date --}}
                            <td>
                                <small class="text-muted">
                                    {{ $comment->created_at->diffForHumans() }}
                                </small>
                            </td>

                            {{-- Action --}}
                            <td class="text-end pe-4">
                                <form method="POST"
                                    action="{{ route('admin.comments.delete', $comment->id) }}"
                                    onsubmit="return confirm('Delete this comment?')">
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
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-chat-dots fs-3"></i>
                                <p class="mt-2 mb-0">No comments found</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $comments->links() }}
    </div>

</div>
@endsection