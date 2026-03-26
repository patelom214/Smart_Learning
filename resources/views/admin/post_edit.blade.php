@extends('layouts.admin')

@section('title','Edit Post')
@section('page-title','Edit Post')

@section('content')

<div class="card shadow-sm border-0 rounded-4 p-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-0">Edit Post</h5>
            <small class="text-muted">Update post details</small>
        </div>

        <a href="{{ route('admin.posts') }}"
           class="btn btn-light border rounded-3 px-4">
            ← Back
        </a>
    </div>

    <form method="POST" action="{{ route('admin.posts.update',$post->id) }}">
        @csrf
        @method('PUT')

        {{-- Title --}}
        <div class="mb-4">
            <label class="fw-semibold mb-2">Post Title</label>
            <input type="text"
                   name="title"
                   value="{{ old('title',$post->title) }}"
                   class="form-control rounded-3"
                   required>
        </div>

        {{-- Content --}}
        <div class="mb-4">
            <label class="fw-semibold mb-2">Post Content</label>
            <textarea name="content"
                      rows="6"
                      class="form-control rounded-3"
                      required>{{ old('content',$post->content) }}</textarea>
        </div>

        {{-- Category --}}
       <div class="mb-3">
                    <label class="fw-semibold">Type</label>
                    <select name="type" class="form-select rounded-3">
                        <option value="public">public</option>
                        <option value="friends">friends</option>
                    </select>
                </div>

        {{-- Tags --}}
        <div class="mb-4">
            <label class="fw-semibold mb-2">Tags</label>
            <input type="text"
                   name="tags"
                   value="{{ old('tags',$post->tags) }}"
                   class="form-control rounded-3"
                   placeholder="laravel, backend, php">
        </div>

        <div class="d-flex justify-content-end gap-2">

            <a href="{{ route('admin.posts') }}"
               class="btn btn-light border rounded-3 px-4">
                Cancel
            </a>

            <button type="submit"
                class="btn text-white rounded-3 px-4"
                style="background:linear-gradient(135deg,#667eea,#764ba2);">
                Update Post
            </button>

        </div>

    </form>

</div>

@endsection