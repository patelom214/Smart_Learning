<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }
  // 👇 THIS METHOD must be OUTSIDE boot()
    public static function getUserNotifications($userId)
    {
        $notifications = collect();

        // Likes
        $likes = DB::table('likes')
            ->join('posts', 'likes.post_id', '=', 'posts.id')
            ->join('users', 'likes.user_id', '=', 'users.id')
            ->where('posts.user_id', $userId)
            ->select(
                'users.name',
                'users.profile_photo',
                'likes.post_id',
                'likes.created_at',
                DB::raw("'like' as type")
            )
            ->latest()
            ->get();

        foreach ($likes as $like) {
            $notifications->push((object)[
                'type' => 'like',
                'name' => $like->name,
                'profile_photo' => $like->profile_photo,
                'created_at' => $like->created_at,
                'url' => route('post.show', $like->post_id),
            ]);
        }

        // Comments
        $comments = DB::table('comments')
            ->join('posts', 'comments.post_id', '=', 'posts.id')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->where('posts.user_id', $userId)
            ->select(
                'users.name',
                'users.profile_photo',
                'comments.post_id',
                'comments.created_at',
                DB::raw("'comment' as type")
            )
            ->latest()
            ->get();

        foreach ($comments as $comment) {
            $notifications->push((object)[
                'type' => 'comment',
                'name' => $comment->name,
                'profile_photo' => $comment->profile_photo,
                'created_at' => $comment->created_at,
                'url' => route('post.show', $comment->post_id),
            ]);
        }

        // Follows
        $follows = DB::table('friend_requests')
            ->join('users', 'friend_requests.sender_id', '=', 'users.id')
            ->where('friend_requests.receiver_id', $userId)
            ->where('friend_requests.status', 'accepted')
            ->select(
                'users.id as user_id',
                'users.name',
                'users.profile_photo',
                'friend_requests.created_at'
            )
            ->latest()
            ->get();

        foreach ($follows as $follow) {
            $notifications->push((object)[
                'type' => 'follow',
                'name' => $follow->name,
                'profile_photo' => $follow->profile_photo,
                'created_at' => $follow->created_at,
                'url' => route('profile.show', $follow->user_id),
            ]);
        }

        return $notifications->sortByDesc('created_at')->values();
    }
    public function boot(): void
    {
        View::composer('*', function ($view) {

            if (!Auth::check()) {
                return;
            }

            $notifications = self::getUserNotifications(Auth::id())->take(10);

            $view->with('notifications', $notifications);
        });
    }
}
