<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as PasswordRule;

class AuthController extends Controller
{
    /* =========================
       SHOW REGISTER PAGE
    ==========================*/
    public function register()
    {
        return view('auth.register');
    }

    /* =========================
       HANDLE REGISTER FORM
    ==========================*/
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|max:150|unique:users',
            'password' => 'required|min:6|confirmed',
            'bio'      => 'nullable|string',
        ]);

        $user = User::create([
            'name'              => $data['name'],
            'email'             => $data['email'],
            'password'          => Hash::make($data['password']),
            'role'              => 'user',          // default
            'bio'               => $data['bio'] ?? null,
            'reputation_points' => 0,               // default
            'status'            => 'active',        // default
        ]);

        return redirect()->route('login')
            ->with('success', 'Welcome to Smart Learning Platform!');
    }

    /* =========================
       SHOW LOGIN PAGE
    ==========================*/
    public function login()
    {
        return view('auth.login');
    }

    /* =========================
       HANDLE LOGIN FORM
    ==========================*/
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            if (Auth::user()->status === 'inactive') {
                Auth::logout();
                return back()->with('error', 'Your account is blocked by admin.');
            }
            return redirect()->route('home')
                ->with('success', 'Logged in successfully');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password',
        ])->onlyInput('email');
    }

    /* =========================
       LOGOUT
    ==========================*/
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')
            ->with('success', 'Logged out successfully');
    }
    /* =========================
       SHOW FORGOT PASSWORD PAGE
    ==========================*/
    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', PasswordRule::min(8)],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
