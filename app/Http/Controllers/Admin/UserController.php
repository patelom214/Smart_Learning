<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\FriendRequest;
use App\Models\Follower;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.users', compact('users'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:5120'
        ], [
            'name.required' => 'Name is required.',
            'email.unique'  => 'This email is already taken.',
            'password.min'  => 'Password must be at least 6 characters.',
        ]);

        $profilePath = null;

        // 🔥 FIXED IMAGE UPLOAD
        if ($request->hasFile('profile_photo')) {

            $file = $request->file('profile_photo');

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $destination = public_path('profiles');

            if (!file_exists($destination)) {
                mkdir($destination, 0777, true);
            }

            $file->move($destination, $filename);

            $profilePath = 'profiles/' . $filename;
        }

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
            'profile_photo' => $profilePath,
        ]);

        return redirect()
            ->route('admin.users.users')
            ->with('success', 'User created successfully');
    }
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'bio'   => 'nullable|max:500',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        // 🔥 IMAGE UPLOAD FIX (public folder)
        if ($request->hasFile('profile_photo')) {

            // delete old image
            if ($user->profile_photo && file_exists(public_path($user->profile_photo))) {
                unlink(public_path($user->profile_photo));
            }

            $file = $request->file('profile_photo');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $destination = public_path('profiles');

            if (!file_exists($destination)) {
                mkdir($destination, 0777, true);
            }

            $file->move($destination, $filename);

            $user->profile_photo = 'profiles/' . $filename;
        }

        // update other fields
        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'bio'   => $request->bio,
            'role'  => $request->role,
            'profile_photo' => $user->profile_photo,
        ]);

        return redirect()->route('admin.users.users')
            ->with('success', 'User updated successfully');
    }
    public function block(User $user)
    {
        DB::beginTransaction();

        try {
            // Change status
            $user->status = 'inactive';
            $user->save();

            // Remove friend requests
            FriendRequest::where('sender_id', $user->id)
                ->orWhere('receiver_id', $user->id)
                ->delete();

            // Remove followers
            Follower::where('follower_id', $user->id)
                ->orWhere('following_id', $user->id)
                ->delete();

            DB::commit();

            return back()->with('success', 'User blocked successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong.');
        }
    }
    public function unblock(User $user)
    {
        $user->status = 'active';
        $user->save();

        return back()->with('success', 'User unblocked successfully.');
    }
}
