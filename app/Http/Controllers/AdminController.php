<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Admin;
use App\Models\MissingPerson;
use App\Models\Notification;
use App\Models\Stations;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:admin');
    // }
    public function login_view()
    {
        return view('admin.admin_login');
    }

    public function dashboard(Request $request)
    {
        // $user_data = User::where('email')->get();

        $users = User::get();
        $stations = Stations::get();

        // count total account the users and stations
        $total_users = User::count();
        $total_stations = Stations::count();

        // This is to get the count of the new users who have not been approved yet
        $pendingUsersCount = User::where('status', 'pending')->count();
        $pendingStationsCount = Stations::where('status', 'pending')->count();

        $totalCount = $pendingUsersCount + $pendingStationsCount;

        // echo '<pre>';
        // print_r($pendingStationsCount);

        return view('admin.admin_dashboard', compact('users', "total_users", "total_stations", "stations", 'totalCount'));
    }

    // public function userProfile($id)
    // {
    //     $user = User::with('reports')->findOrFail($id); // Get user with their missing reports

    //     // echo '<pre>';
    //     // print_r($user->toArray());

    //     return view('profile.user_profile', compact('user'));
    // }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin.dashboard')->with('success', 'Welcome to the Admin Dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login.view')->with('success', 'You have been logged out.');
    }


    public function pendingAccounts()
    {
        $pendingUsers = User::where('status', 'pending')->get();
        $pendingStations = Stations::where('status', 'pending')->get();

        // count total account the users and stations
        $total_pending_users = User::where('status', 'pending')->count();
        $total_pending_stations = Stations::where('status', 'pending')->count();

        // echo '<pre>';
        // print_r($pendingUsers);
        return view('admin.pending_accounts', compact('pendingUsers', 'pendingStations', 'total_pending_users', 'total_pending_stations'));
    }

    public function approveUser($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'approved';
        $user->save();

        // Mark the notification as read
        // Notification::where('data->user_id', $id)->update(['read_at' => now()]);

        // Mark the notification as read by updating the 'read_at' timestamp
        $notification = Notification::where('data', 'LIKE', '%' . $user->id . '%')
            ->whereNull('read_at')  // Optional, ensures only unread notifications are updated
            ->first();

        if ($notification) {
            $notification->read_at = now(); // Set the read_at timestamp to the current time
            $notification->save();
        }


        return redirect()->route('admin.pending_accounts')->with('success', 'User approved successfully.');
    }

    // Reject a user
    public function rejectUser($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'rejected';
        $user->save();

        return redirect()->route('admin.pending_accounts')->with('success', 'User rejected successfully.');
    }

    // Approve a Station request
    public function approveStation($id)
    {
        $station = Stations::findOrFail($id);
        $station->status = 'approved';
        $station->save();

        // Mark the notification as read
        // Notification::where('data->user_id', $id)->update(['read_at' => now()]);

        $notification = Notification::where('data', 'LIKE', '%' . $station->id . '%')
            ->whereNull('read_at')  // Optional, ensures only unread notifications are updated
            ->first();

        if ($notification) {
            $notification->read_at = now(); // Set the read_at timestamp to the current time
            $notification->save();
        }

        return redirect()->route('admin.pending_accounts')->with('success', 'Station approved successfully.');
    }
}
