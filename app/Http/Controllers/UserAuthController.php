<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MissingPerson;
use App\Models\MissingReports;
use App\Models\Notification;
use App\Models\StationNamesLocations;
use App\Models\SubmittedInfo;
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
        $stations = StationNamesLocations::all();
        return view('auth.register', compact('stations'));
    }

    public function dashboard()
    {
        $user = Auth::user(); // Get the currently authenticated user
        // $missing = MissingPerson::where('submitted_by', Auth::user()->email)->get();
        $submittedInfo = MissingReports::where('submitted_by', Auth::user()->email)->get();
        return view('auth.user_dashboard', compact('user', 'submittedInfo'));
    }

    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to authenticate the user
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {

            // Get the authenticated user
            $user = Auth::guard('web')->user();

            // Check the user's status
            switch ($user->status) {
                case 'pending':
                    Auth::guard('web')->logout(); // Log out the user
                    return back()->withErrors([
                        'errors' => 'Your account is still pending approval. Please contact the administrator.',
                    ]);

                case 'rejected':
                    Auth::guard('web')->logout(); // Log out the user
                    return back()->withErrors([
                        'errors' => 'Your account has been rejected. Please contact the administrator for further assistance.',
                    ]);

                case 'approved':
                    // Update last login time
                    User::where('email', $request->email)->update([
                        'last_login_at' => now(),
                    ]);

                    // Redirect to the intended page
                    return redirect()->intended()->with('success', 'Welcome to the User Dashboard');

                default:
                    Auth::guard('web')->logout(); // Log out the user
                    return back()->withErrors([
                        'email' => 'Your account status is invalid. Please contact the administrator.',
                    ]);
            }
        }

        // If authentication fails
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required|min:6',
    //     ]);


    //     if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {

    //         $user = Auth::guard('web')->user();

    //         if ($user->status !== 'approved') {
    //             Auth::guard('web')->logout();
    //             return back()->withErrors([
    //                 'email' => 'The provided credentials do not match our records.',
    //             ]);
    //         }

    //         User::where('email', $request->email)->update([
    //             'last_login_at' => now(),
    //         ]);

    //         return redirect()->intended()->with('success', 'Welcome to the User Dashboard');
    //     }

    //     return back()->withErrors([
    //         'email' => 'The provided credentials do not match our records.',
    //     ]);
    // }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email', // Corrected the validation rule
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone_number' => 'required|numeric',
            'station_name' => 'required',
        ]);

        $data = $request->only('name', 'email', 'password', 'phone_number', 'station_name');
        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'user';
        $data['last_login_at'] = now();
        $data['status'] = 'pending';

        // Handle the profile picture upload
        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $data['profile_picture'] = $profilePicture->store('uploads/profile_pictures', 'public');
        }

        echo '<pre>';
        print_r($data);

        $user = User::create($data);

        // // Create a notification for the admin
        Notification::create([
            'type' => 'user',
            'data' => json_encode([
                'name' => $user->name,
                'email' => $user->email,
                'image' => $user->image,
            ]),
        ]);


        return redirect()->route('login')->with('success', 'You have been registered successfully.')->withInput(['email' => $user->email]);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->intended()->with('success', 'You have been logged out.');
    }
}
