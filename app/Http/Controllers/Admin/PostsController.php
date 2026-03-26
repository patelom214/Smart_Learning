<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::withCount(['likes', 'comments'])
            ->latest()
            ->get();
        return view('admin.posts', compact('posts'));
    }
    public function create()
    {
        return view('admin.post_create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required',
            'title'   => 'required|string|max:255',
            'type'    => 'required|in:public,friends',
            'tags'    => 'nullable|string|max:255',
        ], [
            'title.required' => 'Title is required.',
            'title.max' => 'Title cannot exceed 255 characters.',
            'type.required' => 'Post type is required.',
            'type.in' => 'Post type must be either public or friends.',
            'tags.max' => 'Tags cannot exceed 255 characters.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Post::create([
            'user_id' => Auth::id(),
            'title'   => $request->title,
            'content' => $request->content,
            'type'    => $request->type,
            'tags'    => $request->tags,
        ]);

        return redirect()->route('admin.posts')->with('success', 'Post created successfully');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success', 'Post deleted');
    }
    public function comments()
    {
        $comments = Comment::with(['user', 'post'])
            ->latest()
            ->paginate(15);

        return view('admin.comments', compact('comments'));
    }
    public function edit(Post $post)
    {
        return view('admin.post_edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required',
            'title'   => 'required|string|max:255',
            'type'    => 'required|in:public,friends',
            'tags'    => 'nullable|string|max:255',
        ], [
            'title.required' => 'Title is required.',
            'title.max' => 'Title cannot exceed 255 characters.',
            'type.required' => 'Post type is required.',
            'type.in' => 'Post type must be either public or friends.',
            'tags.max' => 'Tags cannot exceed 255 characters.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $post->update([
            'title'    => $request->title,
            'content'  => $request->content,
            'type'     => $request->type,
            'tags'     => $request->tags,
        ]);

        return redirect()->route('admin.posts')
            ->with('success', 'Post updated successfully.');
    }
    // Delete comment
    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully');
    }
}
