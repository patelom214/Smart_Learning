<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Skill;
use App\Models\FriendRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalPosts = Post::count();
        $totalLikes = Like::count();
        $totalComments = Comment::count();
        $totalSkills = Skill::count();

        // Latest 3 posts
        $recentPosts = Post::with('user')
            ->latest()
            ->take(3)
            ->get();

        // Latest 2 users
        $recentUsers = User::latest()
            ->take(2)
            ->get();

        // Trending post (most likes)
        $trendingPost = Post::withCount('likes')
            ->orderByDesc('likes_count')
            ->first();

        return view('admin.dashboard', compact('totalUsers', 'totalPosts', 'totalSkills', 'totalComments', 'totalLikes', 'recentPosts', 'recentUsers', 'trendingPost'));
    }
   public function analytics(Request $request)
{
    /* ───────── PERIOD (7 / 30 / 90) ───────── */
    $period = $request->get('period', 7);

    /* ───────── TOTAL COUNTS ───────── */
    $totalUsers    = User::count();
    $totalPosts    = Post::count();
    $totalComments = Comment::count();
    $totalLikes    = Like::count();
    $totalSkills   = Skill::count();
    $totalFriends  = FriendRequest::count();


    /* ───────── LABELS ───────── */
    $days = collect(range($period - 1, 0));

   $labels = $days->map(
    fn($d) => now()->subDays($d)->format('M d')
)->toArray();

$userGrowthData = $days->map(
    fn($d) => User::whereDate('created_at', now()->subDays($d))->count()
)->toArray();

$postActivityData = $days->map(
    fn($d) => Post::whereDate('created_at', now()->subDays($d))->count()
)->toArray();

$likesData = $days->map(
    fn($d) => Like::whereDate('created_at', now()->subDays($d))->count()
)->toArray();

$commentsData = $days->map(
    fn($d) => Comment::whereDate('created_at', now()->subDays($d))->count()
)->toArray();

    /* ───────── ROLE DISTRIBUTION ───────── */
    $adminCount = User::where('role', 'admin')->count();
    $userCount  = User::where('role', 'user')->count();
    $modCount   = User::where('role', 'moderator')->count();


    /* ───────── SKILL POPULARITY ───────── */
    $skills = Skill::withCount('users')
    ->orderBy('users_count', 'desc')
    ->take(6)
    ->get();

$skillLabels = $skills->pluck('skill_name')->values()->toArray();
$skillData   = $skills->pluck('users_count')->values()->toArray();

    /* ───────── TOP USERS + RECENT ───────── */
    $topUsers    = User::withCount('posts')
        ->orderByDesc('posts_count')
        ->take(6)
        ->get();

    $recentUsers = User::latest()->take(6)->get();


    return view('admin.analytics', compact(
        'totalUsers',
        'totalPosts',
        'totalComments',
        'totalLikes',
        'totalSkills',
        'totalFriends',

        'labels',
        'userGrowthData',
        'postActivityData',
        'likesData',
        'commentsData',

        'adminCount',
        'userCount',
        'modCount',

        'skillLabels',
        'skillData',

        'topUsers',
        'recentUsers'
    ));
}
    public function allNotifications()
    {
        $activities = collect();

        // New Users
        $users = User::latest()->take(10)->get();
        foreach ($users as $user) {
            $activities->push([
                'type' => 'user',
                'name' => $user->name,
                'message' => 'registered a new account',
                'time' => $user->created_at,
                'url' => route('admin.users.create')
            ]);
        }

        // New Posts
        $posts = Post::with('user')->latest()->take(10)->get();
        foreach ($posts as $post) {
            $activities->push([
                'type' => 'post',
                'name' => $post->user->name,
                'message' => 'published a new post',
                'time' => $post->created_at,
                'url' => route('admin.posts')
            ]);
        }

        // Likes
        $likes = Like::with('user')->latest()->take(10)->get();
        foreach ($likes as $like) {
            $activities->push([
                'type' => 'like',
                'name' => $like->user->name,
                'message' => 'liked a post',
                'time' => $like->created_at,
                'url' => route('admin.posts')
            ]);
        }

        // Comments
        $comments = Comment::with('user')->latest()->take(10)->get();
        foreach ($comments as $comment) {
            $activities->push([
                'type' => 'comment',
                'name' => $comment->user->name,
                'message' => 'commented on a post',
                'time' => $comment->created_at,
                'url' => route('admin.posts')
            ]);
        }

        // Sort by latest
        $activities = $activities->sortByDesc('time')->values();

        return view('admin.notifications', compact('activities'));
    }
    public function likes()
    {
        $likes = Like::with(['user', 'post'])
            ->latest()
            ->paginate(15);

        return view('admin.likes', compact('likes'));
    }

    public function deleteLike($id)
    {
        $like = Like::findOrFail($id);
        $like->delete();

        return back()->with('success', 'Like removed successfully');
    }
}
