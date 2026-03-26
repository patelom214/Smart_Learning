@extends('layouts.admin')

@section('title', 'Manage Posts')
@section('page-title', 'Posts')

@push('styles')
<style>
    :root {
        --gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    /* ── Post card ── */
    .post-card {
        border-radius: 16px;
        transition: transform .22s, box-shadow .22s;
    }

    .post-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, .09) !important;
    }

    /* ── Author avatar ── */
    .post-avatar {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: var(--gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 700;
        font-size: .82rem;
        flex-shrink: 0;
    }

    /* ── Post content preview (clamp to 3 lines) ── */
    .post-preview {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        font-size: .875rem;
        color: #6c757d;
        line-height: 1.6;
    }

    /* ── Search focus ── */
    #postSearch:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 .2rem rgba(102, 126, 234, .2);
    }

    /* ── View modal post content ── */
    #modalPostContent img {
        max-width: 100%;
        border-radius: 8px;
    }

    #modalPostContent p {
        margin-bottom: .75rem;
    }

    /* ── Fade-up ── */
    .fu {
        animation: fadeUp .4s ease both;
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(12px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .d1 {
        animation-delay: .05s
    }

    .d2 {
        animation-delay: .10s
    }

    .d3 {
        animation-delay: .15s
    }
</style>
@endpush

@section('content')

{{-- ── Page header ── --}}
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h5 class="fw-bold mb-0">All Posts</h5>
        <small class="text-muted">Review, view and remove platform posts</small>
    </div>

    <!-- RIGHT SIDE GROUP -->
    <div class="d-flex align-items-center gap-3">

        <a href="{{ route('admin.posts.create') }}"
           class="btn text-white rounded-pill px-4 py-2 fw-semibold"
           style="background:var(--gradient); box-shadow:0 4px 15px rgba(102,126,234,.35);">
            Create Post
        </a>

        <span class="badge rounded-pill px-3 py-2 text-white"
              style="background:var(--gradient); font-size:.78rem;">
            {{ $posts->count() }} Posts
        </span>

    </div>
</div>

{{-- ── Search bar ── --}}
<div class="card border-0 shadow-sm rounded-4 p-3 mb-4 fu d2">
    <div class="row g-2 align-items-center">
        <div class="col-md-6">
            <div class="input-group input-group-sm">
                <span class="input-group-text bg-light border-end-0 text-muted">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" id="postSearch"
                    class="form-control border-start-0 bg-light"
                    placeholder="Search by author, title, or content…"
                    oninput="filterPosts()">
            </div>
        </div>
        <div class="col-md-6 text-md-end">
            <span class="text-muted small" id="postCount">{{ $posts->count() }} posts</span>
        </div>
    </div>
</div>

{{-- ── Posts list ── --}}
<div id="postsContainer" class="d-flex flex-column gap-3 fu d3">

    @forelse($posts as $post)
    <div class="post-card card border-0 shadow-sm p-3 post-row"
        data-author="{{ strtolower($post->user->name ?? '') }}"
        data-content="{{ strtolower(strip_tags($post->content)) }}"
        data-title="{{ strtolower($post->title ?? '') }}">

        <div class="d-flex align-items-start justify-content-between">

            {{-- LEFT SIDE --}}
            <div class="d-flex gap-3 flex-grow-1">

                {{-- Profile Photo --}}
                @if($post->user && $post->user->profile_photo)
                <img src="{{ asset('storage/' . $post->user->profile_photo) }}"
                    class="rounded-circle"
                    width="48" height="48"
                    style="object-fit:cover;">
                @else
                <div class="post-avatar">
                    {{ strtoupper(substr($post->user->name ?? 'U', 0, 1)) }}
                </div>
                @endif

                {{-- Content Area --}}
                <div class="flex-grow-1">

                    {{-- Title --}}
                    @if($post->title)
                    <h5 class="fw-bold mb-1">{{ $post->title }}</h5>
                    @endif

                    {{-- Meta --}}
                    <div class="text-muted small mb-2">
                        Posted by <strong>{{ $post->user->name ?? 'Unknown' }}</strong>
                        • {{ $post->created_at->diffForHumans() }}
                    </div>

                    {{-- Content Preview --}}
                    <div class="text-muted small">
                        {!! \Illuminate\Support\Str::limit(strip_tags($post->content), 120) !!}
                    </div>

                    {{-- Tags --}}
                    @if($post->tags)
                    <div class="mt-2">
                        @foreach(explode(',', $post->tags) as $tag)
                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill">
                            #{{ trim($tag) }}
                        </span>
                        @endforeach
                    </div>
                    @endif

                </div>
            </div>

            {{-- RIGHT SIDE --}}
            <div class="text-end d-flex flex-column align-items-end gap-2">

                {{-- Stats --}}
                <div class="small text-muted">
                    <i class="bi bi-heart text-danger"></i>
                    {{ $post->likes_count ?? 0 }}

                    <span class="mx-2">|</span>

                    <i class="bi bi-chat text-primary"></i>
                    {{ $post->comments_count ?? 0 }}
                </div>

                {{-- Buttons --}}
                <div class="d-flex gap-2">

                    <button type="button"
                        class="btn btn-sm btn-light border rounded-3 btn-view-post"
                        data-id="{{ $post->id }}"
                        data-author="{{ $post->user->name ?? 'Unknown' }}"
                        data-date="{{ $post->created_at->format('M d, Y \a\t h:i A') }}"
                        data-photo="{{ $post->user && $post->user->profile_photo 
                        ? asset('storage/'.$post->user->profile_photo) 
                        : '' }}">
                        <i class="bi bi-eye text-primary"></i>
                    </button>
                      {{-- Edit Button --}}
                    <a href="{{ route('admin.posts.edit',$post->id) }}"
                        class="btn btn-sm btn-light border rounded-3 d-flex align-items-center justify-content-center"
                        style="width:34px;height:34px;">
                        <i class="bi bi-pencil-square text-primary"></i>
                    </a>

                    <button type="button"
                        class="btn btn-sm btn-light border rounded-3 btn-delete-post"
                        data-id="{{ $post->id }}"
                        data-author="{{ $post->user->name ?? 'Unknown' }}">
                        <i class="bi bi-trash text-danger"></i>
                    </button>

                </div>
            </div>

        </div>

    </div>

    {{-- 🔥 IMPORTANT: Hidden Template For Modal --}}
    <template id="post-content-{{ $post->id }}">
        @if($post->title)
        <h4 class="fw-bold mb-3">{{ $post->title }}</h4>
        @endif

        {!! $post->content !!}

        @if($post->media)
        <div class="mt-3 text-center">
            <img src="{{ asset('storage/' . $post->media) }}"
                class="img-fluid rounded-3">
        </div>
        @endif
    </template>

    @empty
    <div class="text-center py-5">
        <div style="font-size:3rem;">📭</div>
        <p class="text-muted mt-2">No posts found.</p>
    </div>
    @endforelse

</div>

{{-- Empty search state ── --}}
<div id="emptySearch" class="text-center py-5 d-none">
    <div style="font-size:2.5rem;">🔍</div>
    <p class="text-muted mt-2 mb-0">No posts match your search.</p>
</div>

{{-- Pagination ── --}}
@if($posts instanceof \Illuminate\Pagination\LengthAwarePaginator)
<div class="d-flex justify-content-between align-items-center mt-4">
    <small class="text-muted">
        Showing {{ $posts->firstItem() }}–{{ $posts->lastItem() }} of {{ $posts->total() }} posts
    </small>
    {{ $posts->links('pagination::bootstrap-5') }}
</div>
@endif


{{-- ════════ VIEW POST MODAL ════════ --}}
<div class="modal fade" id="viewPostModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow rounded-4">

            <div class="modal-header border-bottom px-4 py-3"
                style="background:var(--gradient);">
                <div class="d-flex align-items-center gap-2">
                    <img id="modalProfilePhoto"
                        src=""
                        class="rounded-circle"
                        width="42"
                        height="42"
                        style="object-fit:cover; display:none;">

                    <div class="post-avatar" id="modalAvatar" style="display:none;">U</div>
                    <div>
                        <h6 class="modal-title fw-bold text-white mb-0" id="modalAuthorName">Author</h6>
                        <small class="text-white opacity-75" id="modalPostDate">Date</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body px-4 py-4">
                <div id="modalPostContent" style="font-size:.9rem; line-height:1.7;"></div>
            </div>

            <div class="modal-footer border-top px-4 py-3 d-flex justify-content-between">
                <span class="text-muted small" id="modalPostId"></span>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-light border rounded-3" data-bs-dismiss="modal">Close</button>
                    <button type="button"
                        class="btn btn-sm btn-danger rounded-3 px-3"
                        id="modalDeleteBtn">
                        <i class="bi bi-trash me-1"></i> Delete Post
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>


{{-- ════════ DELETE CONFIRM MODAL ════════ --}}
<div class="modal fade" id="deletePostModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow rounded-4">
            <div class="modal-body text-center p-4">
                <div style="font-size:2.5rem;">🗑️</div>
                <h6 class="fw-bold mt-2 mb-1">Delete Post?</h6>
                <p class="text-muted small mb-3" id="deletePostModalText">
                    This action cannot be undone.
                </p>
                <div class="d-flex gap-2 justify-content-center">
                    <button class="btn btn-sm btn-light border rounded-3 px-3"
                        data-bs-dismiss="modal">Cancel</button>
                    <form id="deletePostForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger rounded-3 px-3">
                            <i class="bi bi-trash me-1"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    /* ── View post modal ── */
    document.addEventListener('click', function(e) {

        // View button
        const viewBtn = e.target.closest('.btn-view-post');
        if (viewBtn) {
            const id = viewBtn.dataset.id;
            const author = viewBtn.dataset.author;
            const date = viewBtn.dataset.date;

            // Read raw HTML from the hidden <template> tag — no escaping issues
            const tmpl = document.getElementById('post-content-' + id);
            let content = tmpl ? tmpl.innerHTML : '<p class="text-muted">No content.</p>';

            // Fix relative image paths → absolute URL
            // Handles: storage/... and /storage/... and uploads/...
            content = content.replace(
                /(<img[^>]+src=["'])((?!https?:\/\/|\/\/)[^"']*)(["'])/gi,
                function(match, before, path, after) {
                    const clean = path.replace(/^\/+/, '');
                    return before + window.location.origin + '/' + clean + after;
                }
            );

            // Make all images responsive in modal
            content = content.replace(/<img /gi, '<img style="max-width:100%;border-radius:8px;margin:8px 0;" ');

            const photo = viewBtn.dataset.photo;

            if (photo && photo !== '') {
                document.getElementById('modalProfilePhoto').src = photo;
                document.getElementById('modalProfilePhoto').style.display = 'block';
                document.getElementById('modalAvatar').style.display = 'none';
            } else {
                document.getElementById('modalAvatar').textContent = author.charAt(0).toUpperCase();
                document.getElementById('modalAvatar').style.display = 'flex';
                document.getElementById('modalProfilePhoto').style.display = 'none';
            }
            document.getElementById('modalAuthorName').textContent = author;
            document.getElementById('modalPostDate').textContent = date;
            document.getElementById('modalPostContent').innerHTML = content;
            document.getElementById('modalPostId').textContent = 'Post #' + id;

            // Wire the delete button inside view modal
            document.getElementById('modalDeleteBtn').dataset.id = id;
            document.getElementById('modalDeleteBtn').dataset.author = author;

            new bootstrap.Modal(document.getElementById('viewPostModal')).show();
            return;
        }

        // Delete button inside view modal
        const modalDelBtn = e.target.closest('#modalDeleteBtn');
        if (modalDelBtn) {
            bootstrap.Modal.getInstance(document.getElementById('viewPostModal')).hide();
            setTimeout(() => openDeleteModal(modalDelBtn.dataset.id, modalDelBtn.dataset.author), 300);
            return;
        }

        // Delete button on card
        const deleteBtn = e.target.closest('.btn-delete-post');
        if (deleteBtn) {
            openDeleteModal(deleteBtn.dataset.id, deleteBtn.dataset.author);
        }
    });

    function openDeleteModal(id, author) {
        document.getElementById('deletePostModalText').textContent =
            'Delete post by "' + author + '"? This cannot be undone.';
        document.getElementById('deletePostForm').action = '/admin/posts/' + id;
        new bootstrap.Modal(document.getElementById('deletePostModal')).show();
    }

    /* ── Live search ── */
    function filterPosts() {
        const search = document.getElementById('postSearch').value.toLowerCase();
        const rows = document.querySelectorAll('.post-row');
        let visible = 0;

        rows.forEach(row => {
            const match =
                row.dataset.author.includes(search) ||
                row.dataset.content.includes(search) ||
                row.dataset.title.includes(search);
            row.style.display = match ? '' : 'none';
            if (match) visible++;
        });

        document.getElementById('postCount').textContent = visible + ' posts';
        document.getElementById('emptySearch').classList.toggle('d-none', visible > 0);
        document.getElementById('postsContainer').classList.toggle('d-none', visible === 0);
    }
</script>
@endpush