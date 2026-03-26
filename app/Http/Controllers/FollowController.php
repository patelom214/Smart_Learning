<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Notifications\NewFollowerNotification;

class FollowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

public function toggle(User $user)
{
    if (Auth::id() === $user->id) {
        return back()->with('error', 'You cannot follow yourself!');
    }

    $currentUserId = Auth::id();

    $friend = DB::table('friend_requests')
        ->where(function ($query) use ($currentUserId, $user) {
            $query->where('sender_id', $currentUserId)
                  ->where('receiver_id', $user->id);
        })
        ->orWhere(function ($query) use ($currentUserId, $user) {
            $query->where('sender_id', $user->id)
                  ->where('receiver_id', $currentUserId);
        })
        ->first();

    if ($friend) {
        DB::table('friend_requests')
            ->where('id', $friend->id)
            ->delete();

        return back()->with('success', 'Unfollowed ' . $user->name);
    } else {
        DB::table('friend_requests')->insert([
            'sender_id' => $currentUserId,
            'receiver_id' => $user->id,
            'status' => 'accepted',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Send notification
        $receiver = User::findOrFail($user->id);
        $receiver->notify(new NewFollowerNotification(Auth::user()));

        return back()->with('success', 'Now following ' . $user->name);
    }
}




    public function following()
    {
        $following = Auth::user()->following()->get();
        return view('profile.following', compact('following'));
    }

    public function followers()
    {
        $followers = Auth::user()->follower()->get();
        return view('profile.followers', compact('followers'));
    }
}
