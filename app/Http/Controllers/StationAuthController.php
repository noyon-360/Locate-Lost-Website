<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MissingPerson;
use App\Models\MissingReports;
use App\Models\Notification;
use App\Models\StationNamesLocations;
use App\Models\Stations;
use App\Models\SubmittedInfo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StationAuthController extends Controller
{
    public function login_view()
    {
        return view('stations.station_login');
    }

    public function register_view()
    {
        $stations = StationNamesLocations::all();
        // echo "<pre>";
        // print_r($stations);
        return view('stations.station_register', compact('stations'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // echo "<pre>";
        // print_r($request->all());

        if (Auth::guard('station')->attempt(['email' => $request->email, 'password' => $request->password])) {

            $user = Auth::guard('station')->user();


            if ($user->status !== 'approved') {
                Auth::guard('station')->logout();
                return back()->withErrors([
                    'email' => 'The provided credentials do not match our records.',
                ]);
            }

            Stations::where('email', $request->email)->update([
                'last_login_at' => now(),
            ]);

            return redirect()->intended()->with('success', 'Welcome to the Station Dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'station_name' => 'required',
            'email' => 'required|email|unique:stations,email',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            'station_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only('station_name', 'email', 'password');
        $data['password'] = Hash::make($data['password']);
        $data['last_login_at'] = now();
        $data['status'] = 'pending';

        // Handle the profile picture upload
        if ($request->hasFile('station_picture')) {
            $profilePicture = $request->file('station_picture');
            $data['station_picture'] = $profilePicture->store('uploads/station_pictures', 'public');
        }

        echo '<pre>';
        print_r($data);

        $station = Stations::create($data);

        Notification::create([
            'type' => 'station',
            'data' => json_encode([
                'name' => $station->station_name,
                'email' => $station->email,
                'image' => $station->station_picture,
            ]),
        ]);

        return redirect()->route('station.login')->with('success', 'You have been registered as a station. Please wait for approval.');
    }

    // Station Dashboard
    public function dashboard()
    {
        $station = Auth::guard('station')->user(); // Get the currently authenticated user
        $missing = MissingPerson::where('submitted_by', $station->email)->withCount('reports')->get();
        $submittedInfo = MissingReports::where('submitted_by', $station->email)->get();

        // Fetch users under this station
        // $users = $station->users;
        $users = User::where('station_name', $station->station_name)->get();

        // echo "<pre>";
        // print_r($users->toArray());
        
        return view('stations.station_dashboard', compact('station', 'users', 'missing', 'submittedInfo'));
    }

    // logout
    public function logout(Request $request)
    {
        Auth::guard('station')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome')->with('success', 'You have been logged out.');
    }
}
