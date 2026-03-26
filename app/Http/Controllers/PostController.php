<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Share;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\FriendRequest;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('posts.create');
    }

    public function myPosts()
    {
        $userId = Auth::id();

        $posts = Post::with([
            'user',
            'comments.user',
            'comments.replies.user'
        ])
            ->where('user_id', $userId)
            ->latest()
            ->paginate(10);

        // 🔥 Add Friends (same logic as feed)
        $sent = FriendRequest::where('sender_id', $userId)
            ->where('status', 'accepted')
            ->pluck('receiver_id');

        $received = FriendRequest::where('receiver_id', $userId)
            ->where('status', 'accepted')
            ->pluck('sender_id');

        $friendIds = $sent->merge($received)->unique();

        $friends = User::whereIn('id', $friendIds)->get();

        // 🔥 Add Tags also (since feed uses it)
        $allTags = Post::whereNotNull('tags')
            ->pluck('tags')
            ->flatMap(fn($tags) => explode(',', $tags))
            ->map(fn($tag) => trim($tag))
            ->unique()
            ->values();

        return view('feed.index', compact('posts', 'friends', 'allTags'));
    }

    public function show($id)
    {
        $post = Post::with('user', 'comments.user')
            ->findOrFail($id);

        return view('feed.show', compact('post'));
    }

    public function feed(Request $request)
    {
        $userId = Auth::id();

        $sent = FriendRequest::where('sender_id', $userId)
            ->where('status', 'accepted')
            ->pluck('receiver_id');

        $received = FriendRequest::where('receiver_id', $userId)
            ->where('status', 'accepted')
            ->pluck('sender_id');

        $friendIds = $sent->merge($received)->unique();
        $friendIds->push($userId);

        $query = Post::with([
            'user',
            'comments.user',
            'comments.replies.user'
        ])
            ->withCount(['likes', 'comments'])
            ->where(function ($q) use ($friendIds) {
                $q->whereIn('user_id', $friendIds)   // My + friends posts
                    ->orWhere('type', 'public');      // OR any public post
            });
        // 🔍 SEARCH
        if ($request->filled('search')) {

            $search = $request->search;

            // Move matching posts to top
            $query->orderByRaw("CASE 
        WHEN title LIKE ? THEN 0
        ELSE 1
    END", ["%{$search}%"]);

            $query->where('title', 'LIKE', "%{$search}%");
        }

        // 🏷 TAG FILTER (safer version)
        if ($request->filled('tag')) {
            $tag = trim(strtolower($request->tag));

            $query->where(function ($q) use ($tag) {
                $q->whereRaw("FIND_IN_SET(?, REPLACE(tags, ' ', ''))", [$tag]);
            });
        }

        $posts = $query->latest()->paginate(10)->withQueryString();

        // Collect tags only from visible posts (optional improvement)
        $allTags = Post::whereNotNull('tags')
            ->pluck('tags')
            ->flatMap(function ($tags) {
                return explode(',', $tags);
            })
            ->map(fn($tag) => trim(strtolower($tag)))
            ->unique()
            ->values();

        $friends = User::whereIn('id', $friendIds)
            ->where('id', '!=', $userId)
            ->get();

        return view('feed.index', compact('posts', 'friends', 'allTags'));
    }
    public function store(Request $request)
    {
        //  dd($request->all());
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

        // If validation fails
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('form_type', 'create');
        }

        Post::create([
            'user_id' => Auth::id(),
            'title'   => $request->title,
            'content' => $request->content,
            'type'    => $request->type,
            'tags'    => $request->tags,
        ]);

        return back()->with('success', 'Post created!');
    }
    // // Store new post
    // public function store(Request $request)
    // {

    //     dd($request->all(), $request->file('media'));

    //     // return redirect()->back()->with('success', 'Post created!');
    // }

    //like and Unkike post
    // Add comment (main comment on a post)
    public function comment(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        $comment = $post->comments()->create([
            'user_id'   => Auth::id(),
            'comment'   => $request->comment,
            'parent_id' => null,
        ]);

        $comment->load('user');

        return response()->json([
            'id'         => $comment->id,
            'comment'    => $comment->comment,
            'created_at' => $comment->created_at->diffForHumans(),
            'user' => [
                'name'    => $comment->user->name,
                'photo'   => $comment->user->profile_photo,
                'initial' => strtoupper(substr($comment->user->name, 0, 1)),
            ],
        ]);
    }

    // Reply to a comment
    public function reply(Request $request, $postId, $commentId)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        $comment = Comment::create([
            'user_id'   => Auth::id(),
            'post_id'   => $postId,
            'parent_id' => $commentId,
            'comment'   => $request->comment,
        ]);

        $comment->load('user');

        return response()->json([
            'id'         => $comment->id,
            'comment'    => $comment->comment,
            'created_at' => $comment->created_at->diffForHumans(),
            'user' => [
                'name'    => $comment->user->name,
                'photo'   => $comment->user->profile_photo,
                'initial' => strtoupper(substr($comment->user->name, 0, 1)),
            ],
        ]);
    }
    // GET comments for a post (AJAX)
    public function getComments(Post $post)
    {
        $comments = $post->comments()
            ->whereNull('parent_id')
            ->with(['user', 'replies.user'])
            ->latest()
            ->get()
            ->map(function ($comment) {
                return [
                    'id'         => $comment->id,
                    'comment'    => $comment->comment,
                    'created_at' => $comment->created_at->diffForHumans(),
                    'user' => [
                        'name'    => $comment->user->name,
                        'photo'   => $comment->user->profile_photo,
                        'initial' => strtoupper(substr($comment->user->name, 0, 1)),
                    ],
                    'replies' => $comment->replies->map(function ($reply) {
                        return [
                            'id'         => $reply->id,
                            'comment'    => $reply->comment,
                            'created_at' => $reply->created_at->diffForHumans(),
                            'user' => [
                                'name'    => $reply->user->name,
                                'photo'   => $reply->user->profile_photo,
                                'initial' => strtoupper(substr($reply->user->name, 0, 1)),
                            ],
                        ];
                    }),
                ];
            });

        return response()->json([
            'comments'       => $comments,
            'comments_count' => $post->comments()->count(),
        ]);
    }
    public function like(Post $post)
    {
        $like = $post->likes()->where('user_id', Auth::id())->first();

        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            $post->likes()->create([
                'user_id' => Auth::id()
            ]);
            $liked = true;
        }

        $post->load('likes.user');

        $likeCount = $post->likes->count();
        $topUsers = $post->likes->take(2)->pluck('user.name');
        $remaining = $likeCount - 2;

        return response()->json([
            'liked' => $liked,
            'likes_count' => $likeCount,
            'top_users' => $topUsers,
            'remaining' => max($remaining, 0),
        ]);
    }
    //liked users list
    public function likes($postId)
    {
        $post = Post::with('likes.user')->findOrFail($postId);

        $users = $post->likes->map(function ($like) {
            return [
                'id' => $like->user->id,
                'name' => $like->user->name,
                'photo' => $like->user->profile_photo,
            ];
        });

        return response()->json($users);
    }
    public function share(Post $post)
    {
        Post::create([
            'user_id' => Auth::id(),
            'content' => 'Shared a post',
            'shared_post_id' => $post->id,
        ]);

        return back()->with('success', 'Post shared successfully!');
    }

    public function shareWithFriend(Post $post, User $user)
    {
        Share::create([
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'shared_to' => $user->id,
        ]);

        return back()->with('success', 'Post shared successfully!');
    }
    public function update(Request $request, Post $post)
    { // Only owner or admin
        if (Auth::id() !== $post->user_id &&  Auth::user()->role !== 'admin') {
            abort(403);
        }
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'content' => 'required',
            'title'   => 'required|string|max:255',
            'tags'    => 'nullable|string|max:255',
        ], [
            'title.required' => 'Title is required.',
            'title.max' => 'Title cannot exceed 255 characters.',
            'tags.max' => 'Tags cannot exceed 255 characters.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('form_type', 'edit')              // ← ADD THIS
                ->with('edit_post_id', $post->id);       // ← ADD THIS
        }
        $data = [
            'content' => $request->content,
            'title'   => $request->title,
            'type'    => $request->type,
            'tags'    => $request->tags
        ];

        $post->update($data);

        return back()->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        if (Auth::id() !== $post->user_id && Auth::user()->role !== 'admin') {
            abort(403);
        }

        $post->delete();
        return back()->with('success', 'Post deleted successfully.');
    }
}
