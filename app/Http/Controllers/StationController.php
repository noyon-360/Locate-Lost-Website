<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Stations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StationController extends Controller
{
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::guard('station')->id(),
            'station_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Stations::find(Auth::guard('station')->id());
        $user->station_name = $request->name;
        $user->email = $request->email;

        // echo '<pre>';
        // print_r($user);

        // Note: If you want to update the profile picture, you can uncomment the following line

        if ($request->hasFile('station_picture')) {
            $path = $request->file('station_picture')->store('station_pictures', 'public');
            $user->station_picture = $path;
        }

        $user->save();

        return redirect()->route('station.dashboard')->with('success', 'Profile updated successfully.');
    }

    public function deleteAccount()
    {
        $user = Stations::find(Auth::id());

        // Delete related SubmittedInfo and MissingPerson records
        $user->missingPersons()->delete();
        $user->submittedInfos()->delete();

        // Delete the user
        $user->delete();

        return redirect('/')->with('success', 'Account deleted successfully.');
    }
}
