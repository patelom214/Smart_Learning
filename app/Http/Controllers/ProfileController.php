<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\User;
 use Cloudinary\Cloudinary;

class ProfileController extends Controller
{
    // public function edit()
    // {
    //     return view('editProfile', [
    //         'user' => Auth::user()
    //     ]);
    // }

public function update(Request $request)
{
    $user = Auth::user();

    if ($request->hasFile('profile_photo')) {

        // Cloudinary config (PUT YOUR VALUES HERE)
        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => 'djn6trzl7',
                'api_key'    => '677882441651463',
                'api_secret' => 'lfZ8IQzl9MJ6aVmfscpnugIOwaU',
            ],
            'url' => [
                'secure' => true
            ]
        ]);

        // upload
        $upload = $cloudinary->uploadApi()->upload(
            $request->file('profile_photo')->getRealPath()
        );

        // get URL
        $imageUrl = $upload['secure_url'];

        // save in DB
        $user->profile_photo = $imageUrl;
    }

    $user->save();

    return back()->with('success', 'Profile updated!');
}
    public function show()
    {
        $user = Auth::user();

        $friends = $user->friends()->get();

        $followers = $friends;   // mutual friends
        $following = $friends;   // same count

        return view('viewProfile', compact('user', 'followers', 'following'));
    }


    /**
     * Show the form for editing the profile.
     */
    public function edit($id)
    {
        $user = Auth::user();

        // Security check
        if ($user->id != $id) {
            abort(403, 'Unauthorized action.');
        }

        return view('editProfile', compact('user'));
    }
    public function index($id)
    {
        $user = User::findOrFail($id);

        $friends = $user->friends()->get();
         $followers = $friends;   // mutual friends
        $following = $friends;   // same count

        // If user is viewing their own profile
        if (Auth::user()->id == $user->id) {
            return redirect()->route('profile'); // your own profile page
        }

        return view('friends.user_profile', compact('user', 'followers', 'following'));
    }
  public function showNotificationProfile(User $user)
{
    $authUser = Auth::user();

    // Get friends of the viewed user
    $friends = $user->friends()->get();

    // Followers and following (same in your system)
    $followers = $friends;
    $following = $friends;

    // Check if logged-in user follows this profile
    $isFriend = $authUser
        ? $authUser->friends()->where('id', $user->id)->exists()
        : false;

    return view('viewProfile', compact(
        'user',
        'followers',
        'following',
        'isFriend'
    ));
}

}
