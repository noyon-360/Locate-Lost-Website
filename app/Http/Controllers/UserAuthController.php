<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MissingPerson;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserAuthController extends Controller
{
    public function login_view()
    {
        return view('auth.login');
    }

    public function register_view()
    {
        return view('auth.register');
    }

    public function dashboard()
    {
        $user = Auth::user(); // Get the currently authenticated user
        $missing = MissingPerson::where('user_email', Auth::user()->email)->get();
        return view('auth.user_dashboard', compact('user', 'missing'));
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);


        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {

            $user = Auth::guard('web')->user();

            if ($user->status !== 'approved') {
                Auth::guard('web')->logout();
                return back()->withErrors([
                    'email' => 'The provided credentials do not match our records.',
                ]);
            }

            User::where('email', $request->email)->update([
                'last_login_at' => now(),
            ]);
            return redirect()->route('user.dashboard')->with('success', 'Welcome to the User Dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email', // Corrected the validation rule
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'user',
            'password' => Hash::make($request->password),
            'last_login_at' => now(),
            'status' => 'pending',
        ]);

        // Create a notification for the admin
        Notification::create([
            'user_id' => $user->id,
            'type' => 'New User Registration',
            'data' => json_encode([
                'name' => $user->name,
                'email' => $user->email,
            ]),
        ]);


        return redirect()->route('login')->with('success', 'You have been registered successfully.')->withInput(['email' => $user->email]);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have been logged out.');
    }
}
