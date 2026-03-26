<?php

namespace App\Models;

use App\Models\Skill;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;




class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_photo',
        'bio',
        'reputation_points',
        'status',
        'google_id',
        'google_name',
        'google_token',
        'google_refresh_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function index()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('users.index', compact('users'));
    }

    public function sentFriendRequests()
    {
        return $this->hasMany(FriendRequest::class, 'sender_id');
    }

    public function receivedFriendRequests()
    {
        return $this->hasMany(FriendRequest::class, 'receiver_id');
    }

   public function friends()
{
    $friendIds = DB::table('friend_requests')
        ->where('status', 'accepted')
        ->where(function ($query) {
            $query->where('sender_id', $this->id)
                  ->orWhere('receiver_id', $this->id);
        })
        ->get()
        ->map(function ($row) {
            return $row->sender_id == $this->id
                ? $row->receiver_id
                : $row->sender_id;
        })
        ->unique()
        ->values();

    return User::whereIn('id', $friendIds);
}
public function isFriendWith($userId)
{
    return DB::table('friend_requests')
        ->where(function ($q) use ($userId) {
            $q->where('sender_id', $this->id)
              ->where('receiver_id', $userId);
        })
        ->orWhere(function ($q) use ($userId) {
            $q->where('sender_id', $userId)
              ->where('receiver_id', $this->id);
        })
        ->where('status', 'accepted')
        ->exists();
}

    // User has many skills
    public function skills()
{
    return $this->belongsToMany(
        Skill::class,
        'user_skills',
        'user_id',   // foreign key in user_skills
        'skill_id'   // related key
    )
    ->withPivot('roadmap_id', 'level', 'progress_percentage', 'completed_tasks')
    ->withTimestamps();
}
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'provider_token',
        'provider_refresh_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
}
