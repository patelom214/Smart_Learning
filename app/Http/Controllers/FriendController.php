<?php
// app/Http/Controllers/FriendController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FriendRequest;
use App\Models\Follower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Exception;

class FriendController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', Auth::id())
            ->where('status', 'active')
            ->withCount(['sentFriendRequests', 'receivedFriendRequests'])
            ->get();

        $pendingRequests = FriendRequest::where('receiver_id', Auth::id())
            ->where('status', 'pending')
            ->with('sender')
            ->whereHas('sender', function ($q) {
                $q->where('status', 'active');
            })
            ->get();

        $myFriends = $this->getMyFriends();

        return view('friends.list_friends', compact('users', 'pendingRequests', 'myFriends'));
    }
public function sendRequest($userId)
{
    $authId = Auth::id();
    $user = User::findOrFail($userId);

    if ($user->status !== 'active') {
        return back()->with('error', 'You cannot send request to this user.');
    }

    // Check if already friends
    $accepted = FriendRequest::where(function ($q) use ($authId, $userId) {
        $q->where('sender_id', $authId)
          ->where('receiver_id', $userId);
    })->orWhere(function ($q) use ($authId, $userId) {
        $q->where('sender_id', $userId)
          ->where('receiver_id', $authId);
    })
    ->where('status', 'accepted')
    ->exists();

    if ($accepted) {
        return back()->with('error', 'You are already friends!');
    }

    // Remove old declined or pending requests
    FriendRequest::where(function ($q) use ($authId, $userId) {
        $q->where('sender_id', $authId)
          ->where('receiver_id', $userId);
    })->orWhere(function ($q) use ($authId, $userId) {
        $q->where('sender_id', $userId)
          ->where('receiver_id', $authId);
    })->delete();

    // Create new request
    FriendRequest::create([
        'sender_id' => $authId,
        'receiver_id' => $userId,
        'status' => 'pending'
    ]);

    return back()->with('success', 'Friend request sent!');
}



    public function acceptRequest($requestId)
    {
        DB::beginTransaction();
        
        try {
            $request = FriendRequest::findOrFail($requestId);
            
            if ($request->receiver_id != Auth::id()) {
                return back()->with('error', 'Unauthorized action!');
            }

            // Update request status to accepted
            $request->update(['status' => 'accepted']);

            // Create follower entry: Receiver (me) follows Sender
            Follower::firstOrCreate([
                'follower_id' => $request->receiver_id, // I follow them
                'following_id' => $request->sender_id
            ]);

            // Check if there's a reverse request that's also accepted
            $reverseRequest = FriendRequest::where('sender_id', $request->receiver_id)
                ->where('receiver_id', $request->sender_id)
                ->where('status', 'accepted')
                ->first();

            // If both have accepted each other's requests, create second follower entry
            if ($reverseRequest) {
                Follower::firstOrCreate([
                    'follower_id' => $request->sender_id, // They follow me
                    'following_id' => $request->receiver_id
                ]);
                
                DB::commit();
                return back()->with('success', 'Friend request accepted! You are now following each other.');
            }

            DB::commit();
            return back()->with('success', 'Friend request accepted! You are now following them.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function declineRequest($requestId)
    {
        $request = FriendRequest::findOrFail($requestId);
        
        if ($request->receiver_id != Auth::id()) {
            return back()->with('error', 'Unauthorized action!');
        }

        $request->update(['status' => 'declined']);

        return back()->with('success', 'Friend request declined!');
    }

    public function removeFriend($userId)
    {
        DB::beginTransaction();
        
        try {
            // Delete friend requests
            FriendRequest::where(function($query) use ($userId) {
                $query->where('sender_id', Auth::id())
                      ->where('receiver_id', $userId);
            })->orWhere(function($query) use ($userId) {
                $query->where('sender_id', $userId)
                      ->where('receiver_id', Auth::id());
            })->delete();

            // Remove mutual following from followers table
            Follower::where(function($query) use ($userId) {
                $query->where('follower_id', Auth::id())
                      ->where('following_id', $userId);
            })->orWhere(function($query) use ($userId) {
                $query->where('follower_id', $userId)
                      ->where('following_id', Auth::id());
            })->delete();

            DB::commit();
            return back()->with('success', 'Friend removed and unfollowed!');

        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Get all friends of the authenticated user
     */
    private function getMyFriends()
    {
        $friendIds = FriendRequest::where('status', 'accepted')
            ->where(function($query) {
                $query->where('sender_id', Auth::id())
                      ->orWhere('receiver_id', Auth::id());
            })
            ->get()
            ->map(function($request) {
                return $request->sender_id == Auth::id() 
                    ? $request->receiver_id 
                    : $request->sender_id;
            });

       return User::whereIn('id', $friendIds)
            ->where('status', 'active')
            ->get();
    }
 public function search(Request $request)
{
    $query = $request->q;

    $users = User::where('id', '!=', Auth::id())
        ->where('name', 'LIKE', "{$query}%") // first letter search
        ->get()
        ->map(function ($user) {

            $sentRequest = FriendRequest::where('sender_id', Auth::id())
                ->where('receiver_id', $user->id)
                ->first();

            $receivedRequest = FriendRequest::where('sender_id', $user->id)
                ->where('receiver_id', Auth::id())
                ->first();

            // check if already friends
            if (($sentRequest && $sentRequest->status == 'accepted') ||
                ($receivedRequest && $receivedRequest->status == 'accepted')) {
                return null;
            }

            // check pending
            $user->is_pending =
                ($sentRequest && $sentRequest->status == 'pending') ||
                ($receivedRequest && $receivedRequest->status == 'pending');

            return $user;
        })
        ->filter()
        ->values();

    return response()->json($users);
}
}