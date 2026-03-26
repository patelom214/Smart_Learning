<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\RoadmapController;
use App\Http\Controllers\ContactController;
use App\Providers\ViewServiceProvider;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\SkillController as AdminSkillController;
use App\Http\Controllers\Admin\RoadmapController as AdminRoadmapController;
use App\Http\Controllers\Admin\RoadmapTaskController as AdminRoadmapTaskController;
use Laravel\Socialite\Socialite;
use App\Http\Controllers\ApiController;

Route::get('/', function () {
    // If user is logged in → go to home/feed
    if (Auth::check()) {
        return redirect()->route('home');
    }
    // If guest → show welcome page
    return view('welcome');
})->name('welcome');

Route::get('/index', function () {
    return view('index');
})->name('home')->middleware('auth');

Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/register_send', [AuthController::class, 'store'])->name('register.store');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/auth/google', [GoogleController::class, 'redirect']);
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

Route::get('/forgot-password', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'reset'])->name('password.update');

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    // View other user's profile
    Route::get('/user/{id}', [ProfileController::class, 'index'])->name('user.profile');
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
});



Route::middleware('auth')->group(function () {
    Route::get('/feed', [PostController::class, 'feed'])->name('feed');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::post('/posts/{post}/like', [PostController::class, 'like'])->name('posts.like');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/my-posts', [PostController::class, 'myPosts'])->name('posts.my');
    Route::get('/posts/{post}/likes', [PostController::class, 'likes'])->name('posts.likes');
    Route::get('/posts/{post}/comments', [PostController::class, 'getComments'])->name('posts.getcomments');
    Route::post('/posts/{post}/comment', [PostController::class, 'comment'])->name('posts.comment');
    Route::post('/posts/{post}/comment/{comment}/reply', [PostController::class, 'reply'])->name('comments.reply');
    Route::post('/posts/{post}/share/{user}', [PostController::class, 'shareWithFriend'])->name('posts.share.friend');
});

Route::middleware('auth')->group(function () {
    Route::post('/follow/{user}', [FollowController::class, 'toggle'])->name('follow.toggle');
});


Route::middleware('auth')->group(function () {
    Route::get('/friends', [FriendController::class, 'index'])->name('friends.index');
    Route::get('/friends/search', [FriendController::class, 'search'])->name('friend.search');
    Route::post('/friend-request/{user}', [FriendController::class, 'sendRequest'])->name('friend.request');
    Route::post('/friend-request/{request}/accept', [FriendController::class, 'acceptRequest'])->name('friend.accept');
    Route::post('/friend-request/{request}/decline', [FriendController::class, 'declineRequest'])->name('friend.decline');
    Route::delete('/friend/{user}/remove', [FriendController::class, 'removeFriend'])->name('friend.remove');
});

Route::get('/feed', [PostController::class, 'feed'])->name('feed')->middleware('auth');
Route::middleware('auth')->group(function () {
    Route::get('/skills', [SkillController::class, 'index'])->name('skills.skill');
    Route::post('/skills/toggle/{id}', [SkillController::class, 'toggle'])->name('skills.toggle');
    Route::get('/roadmaps', [RoadmapController::class, 'index'])->name('roadmap.index');
    Route::get('/roadmap/{skill}', [RoadmapController::class, 'show'])->name('roadmap.show');
    // Toggle task complete
    Route::patch('/roadmap/task/{task}/toggle', [RoadmapController::class, 'toggleTask'])->name('roadmap.task.toggle');
    // Roadmap tasks
    Route::get('/roadmap/tasks/{roadmap}', [RoadmapController::class, 'tasks'])->name('roadmap.tasks');
});

Route::get('/notifications', function () {

    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $notifications = ViewServiceProvider::getUserNotifications(Auth::id());

    return view('notifications', compact('notifications'));
})->middleware('auth')->name('notifications');

// View single post
Route::get('/post/{post}', [PostController::class, 'show'])->name('post.show');

// View user profile from notification or anywhere
Route::get('/profile/{user}', [ProfileController::class, 'showNotificationProfile'])
    ->name('profile.show');

Route::middleware('auth')->group(function () {
    Route::view('/about', 'static.about_us')->name('about');
    Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
    Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
    Route::view('/privacy', 'static.privacy')->name('privacy');
    Route::view('/terms', 'static.terms')->name('terms');
});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/users', [UserController::class, 'index'])->name('admin.users.users');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');

        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.delete');
        Route::put('/admin/users/{user}/block', [UserController::class, 'block'])->name('admin.users.block');
        Route::put('/admin/users/{user}/unblock', [UserController::class, 'unblock'])->name('admin.users.unblock');

        Route::get('/posts', [PostsController::class, 'index'])->name('admin.posts');
        Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');

        Route::get('/posts/create', [PostsController::class, 'create'])->name('admin.posts.create');
        Route::post('/posts', [PostsController::class, 'store'])->name('admin.posts.store');

        Route::get('/comments', [PostsController::class, 'comments'])->name('admin.comments');
        Route::delete('/comments/{id}', [PostsController::class, 'deleteComment'])->name('admin.comments.delete');
        Route::get('/analytics', [DashboardController::class, 'analytics'])->name('admin.analytics');
        Route::get('/notifications', [DashboardController::class, 'allNotifications'])->name('admin.notifications');
        Route::get('/likes', [DashboardController::class, 'likes'])->name('admin.likes');
        Route::delete('/likes/{id}', [DashboardController::class, 'deleteLike'])->name('admin.likes.delete');
        Route::get('/posts/{post}/edit', [PostsController::class, 'edit'])->name('admin.posts.edit');
        Route::put('/posts/{post}', [PostsController::class, 'update'])->name('admin.posts.update');
        Route::delete('/posts/{post}', [PostsController::class, 'destroy'])->name('admin.posts.delete');

        Route::resource('skills', AdminSkillController::class);
        Route::resource('skills.roadmaps', AdminRoadmapController::class);
        Route::resource('roadmaps.tasks', AdminRoadmapTaskController::class);
    });
    // Route::get('/posts', [ApiController::class, 'randomUsers']);
    // Route::get('/posts/{id}', [ApiController::class, 'show']);
    // Route::get('/hello', [ApiController::class, 'hello']);